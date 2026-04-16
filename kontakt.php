<?php
declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$status = $_GET['status'] ?? null;
$statusMap = [
    'ok' => ['type' => 'success', 'text' => 'Vielen Dank. Ihre Nachricht wurde versendet.'],
    'invalid' => ['type' => 'error', 'text' => 'Bitte prüfen Sie Ihre Eingaben und versuchen Sie es erneut.'],
    'spam' => ['type' => 'error', 'text' => 'Die Nachricht konnte nicht verarbeitet werden.'],
    'error' => ['type' => 'error', 'text' => 'Beim Versand ist ein Fehler aufgetreten. Bitte schreiben Sie uns direkt an support@shwd.de.'],
];

$message = $statusMap[$status] ?? null;
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SHWD – Kontakt</title>
  <meta name="description" content="Kontakt zur SHWD – Silvia Hofmann Web Design aus Kleve." />
  <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
  <div class="page-shell">
    <div class="container">
      <div class="page-card">
        <header>
          <div class="nav">
            <a class="logo" href="index.html">SHWD</a>
            <nav class="nav-links" aria-label="Hauptnavigation">
              <a href="index.html">Startseite</a>
              <a href="leistungen.html">Leistungen</a>
              <a href="betreuung.html">Betreuung &amp; Wartung</a>
              <a href="zielgruppen.html">Für wen wir arbeiten</a>
              <a href="arbeitsweise.html">Beispiele &amp; Arbeitsweise</a>
              <a href="ueber.html">Über SHWD</a>
              <a href="kontakt.php" class="active">Kontakt</a>
            </nav>
            <a class="nav-cta" href="kontakt.php">Kontakt</a>
          </div>
        </header>
        <main>
          <section class="page-hero small">
            <div class="eyebrow">Kontakt</div>
            <h1>Einfach anfragen. Ruhig besprechen.</h1>
            <p class="lead">Ob neue Website, Überarbeitung oder laufende Betreuung: SHWD ist bewusst auf direkte, verständliche Kommunikation ausgelegt.</p>
          </section>
          <section>
            <div class="split contact-split">
              <div>
                <?php if ($message): ?>
                  <div class="flash flash-<?php echo htmlspecialchars($message['type'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8'); ?>
                  </div>
                <?php endif; ?>
                <form class="contact-form" action="kontakt-senden.php" method="post" novalidate>
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                  <div class="form-grid">
                    <div>
                      <label for="name">Name</label>
                      <input id="name" name="name" type="text" maxlength="120" required>
                    </div>
                    <div>
                      <label for="email">E-Mail</label>
                      <input id="email" name="email" type="email" maxlength="160" required>
                    </div>
                  </div>
                  <div class="form-grid">
                    <div>
                      <label for="telefon">Telefon (optional)</label>
                      <input id="telefon" name="telefon" type="text" maxlength="60">
                    </div>
                    <div>
                      <label for="betreff">Betreff</label>
                      <input id="betreff" name="betreff" type="text" maxlength="160" required>
                    </div>
                  </div>
                  <div>
                    <label for="nachricht">Nachricht</label>
                    <textarea id="nachricht" name="nachricht" rows="8" maxlength="4000" required></textarea>
                  </div>
                  <div class="honeypot" aria-hidden="true">
                    <label for="website">Website</label>
                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                  </div>
                  <p class="form-note">Mit dem Absenden des Formulars erklären Sie sich damit einverstanden, dass Ihre Angaben zur Bearbeitung Ihrer Anfrage verarbeitet werden. Weitere Informationen finden Sie in der <a href="datenschutz.html">Datenschutzerklärung</a>.</p>
                  <button class="btn btn-primary" type="submit">Nachricht senden</button>
                </form>
              </div>
              <aside class="info-box">
                <h3>Direkter Kontakt</h3>
                <p class="mt-small">E-Mail: <a href="mailto:support@shwd.de">support@shwd.de</a></p>
                <p class="mt-small">Telefon: <a href="tel:+492821970343">+49 2821 970343</a></p>
                <p class="mt-small">Adresse: Feldstr. 2, 47533 Kleve</p>
                <p class="mt">Falls Sie lieber telefonisch starten möchten, ist das völlig in Ordnung. SHWD arbeitet bewusst ohne unnötige Hürden.</p>
              </aside>
            </div>
          </section>
        </main>
        <footer>
          <div class="footer-wrap">
            <div class="footer-top">
              <div class="logo">SHWD</div>
              <p>Webdesign und Betreuung für Handwerk, kleine Firmen und Vereine in Kleve und Umgebung.</p>
              <p>Wir gestalten ruhige, verständliche Internetauftritte für Menschen und Organisationen, die eine verlässliche Lösung suchen – ohne Agenturtheater und ohne unnötige Umwege.</p>
            </div>
            <div class="footer-links">
              <div class="footer-col">
                <h4>Leistungen &amp; SHWD</h4>
                <a href="leistungen.html">Leistungen</a>
                <a href="betreuung.html">Betreuung &amp; Wartung</a>
                <a href="zielgruppen.html">Für wen wir arbeiten</a>
                <a href="arbeitsweise.html">Beispiele &amp; Arbeitsweise</a>
                <a href="ueber.html">Über SHWD</a>
                <a href="kontakt.php">Kontakt</a>
              </div>
              <div class="footer-col">
                <h4>Rechtliches</h4>
                <a href="impressum.html">Impressum</a>
                <a href="datenschutz.html">Datenschutz</a>
                <a href="cookies.html">Cookie-Hinweis</a>
                <a href="wartung.html">Wartungsseite</a>
              </div>
            </div>
            <div class="footer-bottom">
              <span>© SHWD – Webdesign und Betreuung für Kleve und Umgebung</span>
              <span>Stand: V1-Grundlage</span>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</body>
</html>
