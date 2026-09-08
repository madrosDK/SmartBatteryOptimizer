# SmartBatteryOptimizer

IP-Symcon-Modul zur börsenpreisabhängigen Batterieeinspeisung mit PV-Prognose, lernendem Nachtverbrauch und Unterstützung mehrerer PV-Flächen.

## Version

**1.2.3**

## Neu in 1.2.3

- Keine Dateien werden mehr beim Anwenden in den Modulordner geschrieben. Dadurch entstehen durch das Modul selbst keine lokalen Git-Änderungen mehr.
- Highcharts wird, falls vorhanden, nur noch gelesen: zuerst optional aus `libs/highcharts/highcharts.js`, danach aus dem IP-Symcon-Systempfad. Fehlt Highcharts, bleibt die HTML/CSS-Fallback-Grafik aktiv.
- Der bisherige Unterordner `SmartBatteryOptimizer/highcharts/` wurde entfernt und durch den von IP-Symcon vorgesehenen Repository-Ordner `libs/highcharts/` ersetzt.
- `locale.json` ergänzt, damit Modulname und Alias unter IP-Symcon 7+ sauber lokalisiert werden.

## Neu in 1.2.2


- HTML-Ausgabe in drei eigene IP-Symcon-HTMLBox-Variablen aufgeteilt: `Übersicht`, `Börsenpreis Diagramm` und `Einspeiseplan`.
- Das Highcharts-Diagramm liegt damit vollständig in der eigenen Variable `Börsenpreis Diagramm`.
- Sämtliche Highcharts-Beschriftungen werden in weißer Schrift und Tahoma dargestellt.
- Über jedem Preisbalken wird der Börsenpreis direkt in ct angezeigt.
- Fallback-Balkengrafik ohne Highcharts: Wenn `highcharts.js` fehlt oder nicht lesbar ist, bleibt die HTML-Übersicht funktionsfähig und zeigt die Börsenpreise als reine HTML/CSS-Balkengrafik.
- Börsenpreise als Highcharts-Balkendiagramm in der HTML-Übersicht.
- Geplante Einspeisefenster werden im Diagramm hervorgehoben.
- Negative Börsenpreise werden unterhalb der Nulllinie dargestellt.
- Mindest-Einspeisepreis wird als Referenzlinie angezeigt.
- Azimut-Eingabe jetzt direkt von -180° bis +180°: 0° Süd, -90° Ost, +90° West, ±180° Nord.
- Highcharts wird lokal aus der IP-Symcon-Installation über `/highcharts/highcharts.js` geladen; kein CDN-Aufruf notwendig.

## Dokumentation

Die Wiki-Dateien werden im Release-ZIP separat im Ordner `Wiki/` bereitgestellt.
