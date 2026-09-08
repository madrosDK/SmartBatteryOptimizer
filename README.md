# SmartBatteryOptimizer


### Neu in 1.2.4
- Standard-Marktdaten auf **EPEX SPOT AT** ausgerichtet; technische Abfrage über den aWATTar-EPEX-AT-Datenfeed.
- Eigene Auswahl **Einspeisetarif / Anbieter**: KELAG Sonnenplus Smart, EPEX SPOT AT 1:1, aWATTar SUNNY Spot 60min oder benutzerdefiniert.
- KELAG Sonnenplus Smart verwendet den EPEX-SPOT-AT-Stundenpreis 1:1.
- aWATTar SUNNY Spot 60min berücksichtigt automatisch den aktuellen 19-%-Abschlag auf den absoluten Marktpreis.
- Highcharts und Fallback-Grafik zeigen jetzt den **effektiven Einspeisepreis** als Balken; der reine EPEX-Marktpreis bleibt im Tooltip sichtbar.
- Tariflogik ist separat von der Marktdatenquelle aufgebaut, damit weitere Anbieter leicht ergänzt werden können.
IP-Symcon-Modul zur börsenpreisabhängigen Batterieeinspeisung mit PV-Prognose, lernendem Nachtverbrauch und Unterstützung mehrerer PV-Flächen.

## Version

**1.2.4**

## Neu in 1.2.3

- Keine Dateien werden mehr beim Anwenden in den Modulordner geschrieben. Dadurch entstehen durch das Modul selbst keine lokalen Git-Änderungen mehr.
- Highcharts wird, falls vorhanden, nur noch gelesen: zuerst optional aus `libs/highcharts/highcharts.js`, danach aus dem IP-Symcon-Systempfad. Fehlt Highcharts, bleibt die HTML/CSS-Fallback-Grafik aktiv.
- Der bisherige Unterordner `SmartBatteryOptimizer/highcharts/` wurde entfernt und durch den von IP-Symcon vorgesehenen Repository-Ordner `libs/highcharts/` ersetzt.
- `locale.json` ergänzt, damit Modulname und Alias unter IP-Symcon 7+ sauber lokalisiert werden.

## Neu in 1.2.2


- HTML-Ausgabe in drei eigene IP-Symcon-HTMLBox-Variablen aufgeteilt: `Übersicht`, `Börsenpreis Diagramm` und `Einspeiseplan`.
- Das Highcharts-Diagramm liegt damit vollständig in der eigenen Variable `Börsenpreis Diagramm`.
- Sämtliche Highcharts-Beschriftungen werden in weißer Schrift und Tahoma dargestellt.
- Über jedem Preisbalken wird der effektive Einspeisepreis direkt in ct angezeigt.
- Fallback-Balkengrafik ohne Highcharts: Wenn `highcharts.js` fehlt oder nicht lesbar ist, bleibt die Anzeige funktionsfähig und zeigt die Einspeisevergütung als reine HTML/CSS-Balkengrafik.
- Einspeisevergütung als Highcharts-Balkendiagramm in einer eigenen HTMLBox.
- Geplante Einspeisefenster werden im Diagramm hervorgehoben.
- Negative Börsenpreise werden unterhalb der Nulllinie dargestellt.
- Mindest-Einspeisepreis wird als Referenzlinie angezeigt.
- Azimut-Eingabe jetzt direkt von -180° bis +180°: 0° Süd, -90° Ost, +90° West, ±180° Nord.
- Highcharts wird lokal aus der IP-Symcon-Installation über `/highcharts/highcharts.js` geladen; kein CDN-Aufruf notwendig.

## Dokumentation

Die Wiki-Dateien werden im Release-ZIP separat im Ordner `Wiki/` bereitgestellt.


## Börsenpreis-Darstellung

Das Preisdiagramm und die Preistabelle zeigen rollierend die **nächsten 24 Stunden**, soweit vom Datenanbieter bereits Preise vorliegen. Die eigentliche Batterie-Einspeiseplanung bleibt bewusst auf den Zeitraum bis zum Beginn der nächsten PV-Phase begrenzt. Dadurch sind auch nach dem morgendlichen PV-Beginn weiterhin die verfügbaren Marktpreise des restlichen 24-Stunden-Fensters sichtbar.
