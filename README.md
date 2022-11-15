# wordpress-yt2c
YouTube Two-Click-Solution Wordpress Plugin

# Changelog

## v0.5

Checkbox, um Entscheidung zu merken;
zusätzliche Checkbox, um Zustimmung jederzeit widerrufen zu können

### Geplante Updates:

- Einstellungsseite für Auswahl "als (nocookie) iframe einbinden" / "Link anzeigen"
- Shortcode

## v0.4

YouTube-Videos werden - nach Bestätigung - datensparsam eingebettet (über youtube-nocookie.com)
Video-iframe wird responsiv eingebunden

### Geplante Updates:

- Checkbox "immer anzeigen" (dieses Cookie ist technisch notwendig, damit auch weiterhin kein Cookie-Banner oder besonderer Hinweistext notwendig)
- Einstellungsseite für Auswahl "als (nocookie) iframe einbinden" / "Link anzeigen"
- Shortcode

## v0.3

YouTube URL in oembed_html Hook mit \<tt> tag umschließen, um wptexturize Filter zu umgehen (macht z.B. aus zwei Bindestrichen einen Gedankenstrich)

## v0.2

Zusätzlich zu Buchstaben und Zahlen auch Binde- und Unterstrich in Video-ID berücksichtigen

## v0.1

Basis-Variante: YouTube-Videos werden nicht mehr eingebettet sondern stattdessen ein Link angezeigt, der das Video auf YouTube in einem neuen Fenster/Tab öffnet.

### Geplante Updates:

- statt dem Video ein Platzhalter-Bild anzeigen mit Hinweistext, dass bei Klick Daten an YouTube gesendet werden => Video in iframe anzeigen (datensparsam über youtube-nocookie.com)
- Checkbox "immer anzeigen" (dieses Cookie ist technisch notwendig)
