<?php
declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';
require __DIR__ . '/app/mailer.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function redirect_to(string $status): never
{
    header('Location: kontakt.php?status=' . urlencode($status));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$csrfToken = (string)($_POST['csrf_token'] ?? '');
if ($csrfToken === '' || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
    redirect_to('invalid');
}

if (!empty($_POST['website'] ?? '')) {
    redirect_to('spam');
}

$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$phone = trim((string)($_POST['telefon'] ?? ''));
$subject = trim((string)($_POST['betreff'] ?? ''));
$message = trim((string)($_POST['nachricht'] ?? ''));

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    redirect_to('invalid');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_to('invalid');
}

if (mb_strlen($message) > 4000 || mb_strlen($name) > 120 || mb_strlen($subject) > 160) {
    redirect_to('invalid');
}

$to = env('MAIL_TO', 'support@shwd.de');
$from = env('MAIL_FROM', 'support@shwd.de');
$fromName = env('MAIL_FROM_NAME', 'SHWD');
$prefix = env('MAIL_SUBJECT_PREFIX', '[SHWD]');

$mailSubject = trim($prefix . ' Kontaktanfrage: ' . $subject);
$bodyLines = [
    'Neue Anfrage über das Kontaktformular von shwd.de',
    '',
    'Name: ' . $name,
    'E-Mail: ' . $email,
    'Telefon: ' . ($phone !== '' ? $phone : '-'),
    'Betreff: ' . $subject,
    '',
    'Nachricht:',
    $message,
    '',
    'Zeitpunkt: ' . date('Y-m-d H:i:s'),
    'IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unbekannt'),
];
$body = implode("
", $bodyLines);

try {
    shwd_send_mail([
        'to_email' => $to,
        'from_email' => $from,
        'from_name' => $fromName,
        'reply_email' => $email,
        'reply_name' => $name,
        'subject' => $mailSubject,
        'body' => $body,
    ]);
} catch (Throwable $exception) {
    error_log('SHWD Kontaktformular: ' . $exception->getMessage());
    redirect_to('error');
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
redirect_to('ok');
