<?php
declare(strict_types=1);

function shwd_send_mail(array $message): void
{
    $transport = strtolower((string) env('MAIL_TRANSPORT', 'mail'));

    if ($transport === 'smtp') {
        shwd_send_via_smtp($message);
        return;
    }

    shwd_send_via_mail_function($message);
}

function shwd_send_via_mail_function(array $message): void
{
    $headers = [];
    $headers[] = 'From: ' . mb_encode_mimeheader((string) $message['from_name'], 'UTF-8') . ' <' . (string) $message['from_email'] . '>';
    $headers[] = 'Reply-To: ' . (string) $message['reply_name'] . ' <' . (string) $message['reply_email'] . '>';
    $headers[] = 'Content-Type: text/plain; charset=UTF-8';
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    $sent = @mail(
        (string) $message['to_email'],
        mb_encode_mimeheader((string) $message['subject'], 'UTF-8'),
        (string) $message['body'],
        implode("\r\n", $headers)
    );

    if (!$sent) {
        throw new RuntimeException('mail() konnte die Nachricht nicht versenden.');
    }
}

function shwd_send_via_smtp(array $message): void
{
    $host = (string) env('SMTP_HOST', '');
    $port = (int) env('SMTP_PORT', '465');
    $secure = strtolower((string) env('SMTP_SECURE', 'ssl'));
    $username = (string) env('SMTP_USERNAME', '');
    $password = (string) env('SMTP_PASSWORD', '');
    $timeout = 20;

    if ($host === '' || $username === '' || $password === '') {
        throw new RuntimeException('SMTP-Konfiguration unvollständig.');
    }

    $remote = ($secure === 'ssl') ? 'ssl://' . $host . ':' . $port : $host . ':' . $port;
    $socket = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT);

    if (!is_resource($socket)) {
        throw new RuntimeException('SMTP-Verbindung fehlgeschlagen: ' . $errstr . ' (' . $errno . ')');
    }

    stream_set_timeout($socket, $timeout);

    try {
        shwd_smtp_expect($socket, [220]);
        shwd_smtp_command($socket, 'EHLO shwd.de', [250]);

        if ($secure === 'tls' || $secure === 'starttls') {
            shwd_smtp_command($socket, 'STARTTLS', [220]);
            if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new RuntimeException('STARTTLS konnte nicht aktiviert werden.');
            }
            shwd_smtp_command($socket, 'EHLO shwd.de', [250]);
        }

        shwd_smtp_command($socket, 'AUTH LOGIN', [334]);
        shwd_smtp_command($socket, base64_encode($username), [334]);
        shwd_smtp_command($socket, base64_encode($password), [235]);

        shwd_smtp_command($socket, 'MAIL FROM:<' . (string) $message['from_email'] . '>', [250]);
        shwd_smtp_command($socket, 'RCPT TO:<' . (string) $message['to_email'] . '>', [250, 251]);
        shwd_smtp_command($socket, 'DATA', [354]);

        $headers = [];
        $headers[] = 'From: ' . shwd_encode_header_name((string) $message['from_name']) . ' <' . (string) $message['from_email'] . '>';
        $headers[] = 'To: <' . (string) $message['to_email'] . '>';
        $headers[] = 'Reply-To: ' . shwd_encode_header_name((string) $message['reply_name']) . ' <' . (string) $message['reply_email'] . '>';
        $headers[] = 'Subject: ' . mb_encode_mimeheader((string) $message['subject'], 'UTF-8');
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'Content-Transfer-Encoding: 8bit';
        $headers[] = 'Date: ' . date(DATE_RFC2822);
        $headers[] = 'Message-ID: <' . bin2hex(random_bytes(8)) . '@shwd.de>';
        $headers[] = 'X-Mailer: SHWD SMTP Mailer';

        $body = shwd_dot_stuff((string) $message['body']);
        $data = implode("\r\n", $headers) . "\r\n\r\n" . $body . "\r\n.\r\n";
        fwrite($socket, $data);
        shwd_smtp_expect($socket, [250]);
        shwd_smtp_command($socket, 'QUIT', [221]);
    } finally {
        fclose($socket);
    }
}

function shwd_smtp_command($socket, string $command, array $expectedCodes): void
{
    fwrite($socket, $command . "\r\n");
    shwd_smtp_expect($socket, $expectedCodes);
}

function shwd_smtp_expect($socket, array $expectedCodes): void
{
    $response = shwd_smtp_read_response($socket);
    $code = (int) substr($response, 0, 3);

    if (!in_array($code, $expectedCodes, true)) {
        throw new RuntimeException('SMTP-Fehler: ' . trim($response));
    }
}

function shwd_smtp_read_response($socket): string
{
    $response = '';

    while (($line = fgets($socket, 515)) !== false) {
        $response .= $line;
        if (strlen($line) < 4 || $line[3] === ' ') {
            break;
        }
    }

    if ($response === '') {
        throw new RuntimeException('Leere Antwort vom SMTP-Server.');
    }

    return $response;
}

function shwd_dot_stuff(string $body): string
{
    $body = str_replace(["\r\n", "\r"], "\n", $body);
    $lines = explode("\n", $body);

    foreach ($lines as &$line) {
        if (str_starts_with($line, '.')) {
            $line = '.' . $line;
        }
    }

    return implode("\r\n", $lines);
}

function shwd_encode_header_name(string $value): string
{
    return mb_encode_mimeheader($value, 'UTF-8');
}
