# Changelog

## [0.2.0] - 2026-04-16 - [Unreleased]
### Added
- SHWD V1 Website-Prototyp bereitgestellt
- PHP-basiertes Kontaktformular eingeführt
- Versandlogik über `kontakt-senden.php` ergänzt
- Wartungsseite `wartung.html` hinzugefügt
- Zentrales Stylesheet `assets/styles.css` eingebunden

### Changed
- Kontaktseite von `kontakt.html` auf `kontakt.php` umgestellt
- Seitenstruktur für die V1 des Webauftritts vereinheitlicht

### Included
- `index.html`
- `leistungen.html`
- `betreuung.html`
- `zielgruppen.html`
- `arbeitsweise.html`
- `ueber.html`
- `kontakt.php`
- `kontakt-senden.php`
- `impressum.html`
- `datenschutz.html`
- `wartung.html`
- `assets/styles.css`

### Notes
- Das Kontaktformular versendet Anfragen per PHP `mail()` an `support@shwd.de`
- Die Datenschutzerklärung ist auf eine schlanke V1 ohne Tracking und ohne Marketing-Cookies ausgelegt
- Vor dem Livegang sollten Hosting, PHP-Mail-Funktion und die endgültigen Rechtstexte geprüft werden

## [0.1.0] - 2026-04-16 - [Unreleased]
### Added
- Statische HTML-Seiten für den Webauftritt angelegt:
  - index.html
  - leistungen.html
  - betreuung.html
  - zielgruppen.html
  - arbeitsweise.html
  - ueber.html
  - kontakt.html
  - impressum.html
  - datenschutz.html
- Gemeinsames CSS für die statischen Seiten eingebunden

### Notes
- Kontaktdaten sind derzeit Platzhalter
- Impressum und Datenschutz enthalten Platzhalter
- Cookie-Einstellungen sind noch nicht umgesetzt
- Fonts werden über Google Fonts geladen
