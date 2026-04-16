<?php
$status = $_GET['status'] ?? '';
$message = '';
$class = 'notice';
if ($status === 'ok') {
  $message = 'Vielen Dank. Ihre Nachricht wurde versendet.';
  $class = 'notice success';
} elseif ($status === 'error') {
  $message = 'Ihre Nachricht konnte im Moment nicht versendet werden. Bitte nutzen Sie vorerst die E-Mail-Adresse support@shwd.de oder rufen Sie an.';
  $class = 'notice error';
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SHWD – Kontakt</title>
  <meta name="description" content="SHWD – Webdesign und Betreuung für Handwerk, kleine Firmen und Vereine in Kleve und Umgebung." />
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
              <a href="betreuung.html">Betreuung & Wartung</a>
              <a href="zielgruppen.html">Für wen wir arbeiten</a>
              <a href="arbeitsweise.html">Beispiele & Arbeitsweise</a>
              <a href="ueber.html">Über SHWD</a>
            </nav>
            <a class="nav-cta" href="kontakt.php">Kontakt</a>
          </div>
        </header>
        <main>
          <section class="page-hero"><div class="page-hero-simple"><div class="hero-copy"><div class="eyebrow">Kontakt</div><h1>Einfach Kontakt aufnehmen.</h1><p class="lead">Ob neue Website, Überarbeitung, bessere Struktur oder laufende Betreuung: Gemeinsam schauen wir, was zu Ihrem Vorhaben passt.</p></div><aside class="side-note"><h3>Direkt erreichbar</h3><p style="margin-top:12px;">SHWD richtet sich an Handwerk, kleine Firmen und Vereine in Kleve und Umgebung. Für den ersten Schritt reicht eine kurze Nachricht oder ein Anruf.</p></aside></div></section><section><div class="contact-grid"><div><div class="section-intro"><div class="eyebrow">Schreiben Sie uns</div><h2>Kontaktformular</h2><p style="margin-top:20px; max-width:42rem;">Das Formular ist für eine direkte Anfrage gedacht. Die Nachricht wird per E-Mail an SHWD übermittelt und nicht zusätzlich in einer Datenbank gespeichert.</p></div><?php if (!empty($message)): ?><div class="<?php echo $class; ?>" style="margin-bottom:18px;"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?><form class="contact-form" action="kontakt-senden.php" method="post"><div class="field"><label for="name">Name</label><input id="name" name="name" type="text" required /></div><div class="field"><label for="email">E-Mail-Adresse</label><input id="email" name="email" type="email" required /></div><div class="field"><label for="telefon">Telefon (optional)</label><input id="telefon" name="telefon" type="text" /></div><div class="field" style="display:none;"><label for="website">Website</label><input id="website" name="website" type="text" autocomplete="off" /></div><div class="field"><label for="nachricht">Nachricht</label><textarea id="nachricht" name="nachricht" required></textarea></div><p class="help">Mit dem Absenden des Formulars stimmen Sie zu, dass Ihre Angaben zur Bearbeitung Ihrer Anfrage verwendet werden. Details dazu finden Sie in der <a href="datenschutz.html" style="color: var(--accent-dark); text-decoration: underline;">Datenschutzerklärung</a>.</p><button class="btn btn-primary" type="submit">Nachricht senden</button></form></div><aside><div class="info-box"><h3>SHWD</h3><p>Feldstr. 2<br />47533 Kleve</p><p style="margin-top:16px;">E-Mail: <a href="mailto:support@shwd.de" style="color: var(--accent-dark); text-decoration: underline;">support@shwd.de</a><br />Telefon: <a href="tel:+492821970343" style="color: var(--accent-dark); text-decoration: underline;">+49 2821 970343</a></p></div><div class="info-box" style="margin-top:22px;"><h3>Hinweis</h3><p>Die Website ist bewusst schlank gehalten: ohne Tracking, ohne Marketing-Cookies und ohne unnötige Drittanbieter-Einbindungen.</p></div></aside></div></section>
        </main>
        <footer>
          <div class="footer-wrap">
            <div class="footer-top">
              <div class="footer-brand">
                <div class="logo">SHWD</div>
                <p>Webdesign und Betreuung für Handwerk, kleine Firmen und Vereine in Kleve und Umgebung.</p>
                <p>Wir gestalten ruhige, verständliche Internetauftritte für Menschen und Organisationen, die eine verlässliche Lösung suchen – ohne Agenturtheater und ohne unnötige Umwege.</p>
              </div>
            </div>
            <div class="footer-links">
              <div class="footer-col">
                <h4>Leistungen &amp; SHWD</h4>
                <a href="leistungen.html">Leistungen</a>
                <a href="betreuung.html">Betreuung & Wartung</a>
                <a href="zielgruppen.html">Für wen wir arbeiten</a>
                <a href="arbeitsweise.html">Beispiele & Arbeitsweise</a>
                <a href="ueber.html">Über SHWD</a>
                <a href="kontakt.php">Kontakt</a>
              </div>
              <div class="footer-col">
                <h4>Rechtliches</h4>
                <a href="impressum.html">Impressum</a>
                <a href="datenschutz.html">Datenschutz</a>
                <a href="wartung.html">Wartungsseite</a>
              </div>
            </div>
            <div class="footer-bottom">
              <span>© SHWD – Webdesign und Betreuung für Kleve und Umgebung</span>
              <span>V1-Prototyp</span>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</body>
</html>