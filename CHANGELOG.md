# Changelog

Alle relevanten Änderungen an der SHWD-Website werden in dieser Datei dokumentiert.

## [0.3.1] - 2026-04-16

### Added
- Dezenter Hinweis im Kopfbereich mehrerer Seiten ergänzt:
  - „Hinweis: Wir übernehmen zur Zeit keine Aufträge.“

### Changed
- README sprachlich leicht bereinigt und gestrafft.
- Zentrales Stylesheet um die Darstellung des neuen Hinweisbanners erweitert.
- Mehrere sichtbare Seiten um einen kleinen, bewusst unaufdringlichen Hinweis ergänzt.

### Notes
- Dieser Stand ist inhaltlich nur ein kleiner Feinschliff auf dem bestehenden V1-Auftritt.

---

## [0.3.0] - 2026-04-16

### Added
- SHWD-V1 als zusammenhängende Website-Struktur weiter ausgebaut.
- PHP-Kontaktformular und Versandlogik integriert.
- `kontakt-senden.php` ergänzt.
- `app/bootstrap.php` ergänzt.
- `.env.example` für Konfiguration vorbereitet.
- `cookies.html` ergänzt.
- `maintenance.html` im Projekt enthalten.
- `.gitignore` für Umgebungs- und Build-Dateien erweitert.

### Changed
- Website-Struktur in Richtung einer veröffentlichbaren V1 vereinheitlicht.
- Rechtliche Seiten und Kontaktbereich weiter ausgebaut.
- Projektstruktur und Dokumentation im README aktualisiert.

### Notes
- Diese Version bildet die technische und inhaltliche Grundlage für den SHWD-V1-Auftritt.
- Die Konfiguration ist auf eine schlanke, rechtlich zurückhaltende erste Version ausgelegt.

---

## [0.2.0] - 2026-04-16

### Added
- SHWD Website-Prototyp bereitgestellt.
- PHP-basierte Kontaktseite eingeführt.
- Versandlogik über `kontakt-senden.php` ergänzt.
- Wartungsseite `wartung.html` hinzugefügt.
- Zentrales Stylesheet `assets/styles.css` eingebunden.

### Changed
- Kontaktseite von `kontakt.html` auf `kontakt.php` umgestellt.
- Seitenstruktur für die erste funktionsfähige Website-Version vereinheitlicht.

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
- Das Kontaktformular versendet Anfragen serverseitig.
- Die Datenschutzerklärung ist auf eine schlanke Version ohne Tracking und ohne Marketing-Cookies ausgelegt.
- Vor dem Livegang sollten Hosting, Mailversand und Rechtstexte final geprüft werden.

---

## [0.1.0] - 2026-04-16

### Added
- Erste statische HTML-Seiten für den Webauftritt angelegt:
  - `index.html`
  - `leistungen.html`
  - `betreuung.html`
  - `zielgruppen.html`
  - `arbeitsweise.html`
  - `ueber.html`
  - `kontakt.html`
  - `impressum.html`
  - `datenschutz.html`
- Gemeinsames CSS für die statischen Seiten eingebunden.
- Erste `CHANGELOG.md` angelegt.

### Notes
- Kontaktdaten waren zu diesem Zeitpunkt noch Platzhalter.
- Impressum und Datenschutz enthielten noch Platzhalter.
- Cookie-Einstellungen waren noch nicht umgesetzt.
- Fonts wurden zunächst extern geladen.

---

## [0.0.1] - 2026-04-16

### Added
- Repository initialisiert.
- Erstes `README.md` angelegt.
- README deutlich erweitert.
- Proprietäre `LICENSE` ergänzt.
- Erste `index.html` ergänzt.
- `.gitignore` ergänzt.
- Erste `maintenance.html` ergänzt.

### Notes
- Dieser Stand markiert die Repository- und Projektinitialisierung vor dem eigentlichen Website-Ausbau.