# SmartBatteryOptimizer


### Neu in 1.2.4
- Standard-Marktdaten: **echte EPEX SPOT AT 15-Minuten-Preise** über die kostenlose smartENERGY-API (`https://apis.smartenergy.at/market/v1/price`).
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


## AlphaESS Dispatch und PV-Speicherfreihaltung (ab 1.2.7)

Für AlphaESS-Systeme kann die Batterie direkt über die Dispatch-Register gesteuert werden. Im IP-Symcon-Modbus-TCP-Modul werden dafür Register 2176 (UINT16/FC06), 2177 (INT32/FC16), 2181 (UINT16/FC06), 2182 (UINT16/FC06) und 2183 (UINT32/FC16) als schreibbare Variablen angelegt und anschließend in SmartBatteryOptimizer ausgewählt. Das Modul verwendet Dispatch Mode 2 (SoC-Steuerung), setzt die Entladeleistung mit dem AlphaESS-Offset 32000 und beendet den Dispatch nach dem geplanten Preisfenster bzw. spätestens am Mindest-SoC.

Zusätzlich kann das Modul vor einer starken PV-Phase gezielt Speicherplatz schaffen. Es berücksichtigt den erwarteten morgendlichen Speicherinhalt, die PV-Prognose, einen konfigurierbaren Anteil der Prognose als möglichen Batterieüberschuss und den gewünschten maximalen PV-Ziel-SoC. Reichen die normalen Preisfenster nicht aus, werden weitere bestmögliche Zeitfenster zur Speicherfreihaltung gewählt. Diese erscheinen im Diagramm gelb.


## Neu in 1.2.7

Die Einspeiseplanung arbeitet mit einem **15-Minuten-Raster**. Die integrierte smartENERGY-API liefert dafür echte EPEX-SPOT-AT-Viertelstundenpreise. Eine eigene JSON-Quelle wird bei Bedarf auf 15-Minuten-Slots normalisiert. Dadurch kann insbesondere die AlphaESS-Dispatch-Steuerung viertelstundengenau starten, stoppen und die notwendige Energiemenge verteilen.

Die **PV-Autokalibrierung kann bei aktiver Einspeisebegrenzung pausiert werden**. Dazu wird eine Variable für die aktuelle Netzeinspeisung gewählt. Bei einer Einspeisegrenze von 10.000 W und einer Toleranz von 500 W werden ab 9.500 W keine neuen Kalibrierwerte gespeichert. So wird eine technisch richtige PV-Prognose nicht nach unten korrigiert, nur weil der Wechselrichter wegen der Netzgrenze abregelt. Falls die Netzeinspeisung mit negativem Vorzeichen geliefert wird, kann das Vorzeichen in der Konfiguration invertiert werden.


## Änderungen v1.3.1
- Highcharts-Diagramm robust auf direkte Zeitstempel umgestellt: Stundenmittel als Balken, echte 15-Minuten-Werte als Linie.
- Bei fehlendem oder fehlerhaftem Highcharts wird automatisch die Fallback-Grafik eingeblendet.
- Der Einspeiseplan ist über „Einspeiseplan anzeigen / ausblenden“ auf- und zuklappbar.


## Änderungen v1.3.2
- Börsenpreis-Diagramm als vollständiges eigenständiges HTML-Dokument ausgegeben, passend zum bewährten IP-Symcon/IPSView-Highcharts-Aufbau.
- Highcharts wird nach dem lokalen Laden direkt initialisiert; die fehleranfällige DOMContentLoaded-Nachinitialisierung wurde entfernt.
- Automatischer Reflow nach dem Laden ergänzt.
- Bei einem Highcharts-Laufzeitfehler wird die HTML/CSS-Fallback-Grafik eingeblendet und der Fehlertext sichtbar ausgegeben.
