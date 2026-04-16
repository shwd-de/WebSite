# SHWD Website

Offizielle Website von **SHWD – Silvia Hofmann Web Design** aus Kleve.

Dieses Repository enthält die neue Website von SHWD als ruhigen, modernen und verständlichen Webauftritt für **Handwerk**, **kleine Firmen** und **Vereine** in Kleve und Umgebung.

**Wichtig:** Dieses Projekt steht **in keinem Zusammenhang mit der SASD-GmbH**.

## Ziel des Projekts

Die Website soll:

- professionell und vertrauenswürdig wirken
- lokal und persönlich bleiben
- keine künstliche Agenturgröße vortäuschen
- rechtlich und technisch schlank starten
- später schrittweise erweitert werden können

## Aktueller Stand

Die V1 enthält bzw. plant unter anderem:

- Startseite
- Leistungen
- Betreuung & Wartung
- Für wen wir arbeiten
- Beispiele & Arbeitsweise
- Über SHWD
- Kontakt
- Impressum
- Datenschutz
- Wartungsseite

## Technischer Ansatz

Die Website wird bewusst einfach und robust gehalten:

- HTML
- CSS
- PHP für Kontaktformular und einfache serverseitige Logik
- keine unnötigen Frameworks
- kein Tracking in der ersten Version
- keine unnötigen externen Abhängigkeiten

## Zielgruppe

SHWD richtet sich vor allem an:

- Handwerksbetriebe
- kleine Unternehmen
- Vereine

Nicht im Fokus stehen große Konzerne, stark marketinggetriebene Projekte oder künstlich aufgeblasene Agenturauftritte.

## Gestalterische Richtung

Die Website folgt einer ruhigen und bodenständigen Linie:

- persönlich
- verständlich
- zuverlässig
- professionell
- modern ohne Übertreibung

## Projektstruktur

Eine mögliche Struktur der Website:

```text
/
├── index.html
├── leistungen.html
├── betreuung.html
├── zielgruppen.html
├── arbeitsweise.html
├── ueber.html
├── kontakt.php
├── impressum.html
├── datenschutz.html
├── wartung.html
├── assets/
│   ├── css/
│   ├── img/
│   ├── fonts/
│   └── js/
└── README.md

## Einrichtung

1. Dateien auf den Webspace hochladen
2. `.env` prüfen und ggf. anpassen
3. sicherstellen, dass `support@shwd.de` existiert
4. testen, ob `mail()` auf dem Zielsystem funktioniert
5. Kontaktformular live prüfen

## Hinweise zum Kontaktformular

Die V1 nutzt standardmäßig `mail()` und ist damit für eine schlanke IONOS-Installation gut geeignet.

In der `.env` sind bereits zusätzliche Mail-Variablen für einen späteren SMTP-Ausbau vorbereitet. Diese werden in der V1 noch nicht aktiv verwendet.

## Vor dem Livegang prüfen

- Impressum und Datenschutz noch einmal gegen das tatsächliche Hosting prüfen
- Telefonnummer und Kontaktangaben final abstimmen
- Kontaktformular mit realer Testnachricht testen
- Wartungsseite separat abrufbar halten
- `.env` niemals öffentlich versionieren
