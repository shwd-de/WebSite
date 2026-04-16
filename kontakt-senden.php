<?php
declare(strict_types=1);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: kontakt.php'); exit; }
$honeypot = trim((string)($_POST['website'] ?? ''));
if ($honeypot !== '') { header('Location: kontakt.php?status=ok'); exit; }
$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$telefon = trim((string)($_POST['telefon'] ?? ''));
$nachricht = trim((string)($_POST['nachricht'] ?? ''));
if ($name === '' || $nachricht === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { header('Location: kontakt.php?status=error'); exit; }
$to = 'support@shwd.de';
$subject = 'Neue Anfrage über shwd.de';
$body = "Neue Anfrage über das Kontaktformular von shwd.de

Name: $name
E-Mail: $email
Telefon: " . ($telefon !== '' ? $telefon : '-') . "

Nachricht:
$nachricht
";
$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
$headers[] = 'From: SHWD Kontaktformular <support@shwd.de>';
$headers[] = 'Reply-To: ' . $email;
$success = mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("
", $headers));
header('Location: kontakt.php?status=' . ($success ? 'ok' : 'error'));
exit;
