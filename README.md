# SmartBatteryOptimizer


### Neu in 1.2.4
- Standard-Marktdaten: **EPEX SPOT AT 60 min**. Die smartENERGY-API liefert 15-Minuten-Rohwerte, aus denen das Modul zuerst arithmetische Stundenmittel bildet.
- Nur noch **ein Auswahlfeld „Preisquelle / Tarif“**: EPEX SPOT AT 60 min, aWATTar SUNNY Spot 60min, Eigene JSON-Quelle oder Benutzerdefiniert.
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

Die Preisbewertung basiert bei EPEX auf **60-Minuten-Stundenpreisen**. Die von smartENERGY gelieferten 15-Minuten-Rohwerte werden zunächst pro Stunde gemittelt. Für die Batterieplanung wird derselbe Stundenpreis anschließend auf vier 15-Minuten-Slots verteilt. Dadurch bleibt die AlphaESS-Dispatch-Steuerung viertelstundengenau, ohne dass innerhalb einer Stunde unterschiedliche Börsenpreise angenommen werden.

Die **PV-Autokalibrierung kann bei aktiver Einspeisebegrenzung pausiert werden**. Dazu wird eine Variable für die aktuelle Netzeinspeisung gewählt. Bei einer Einspeisegrenze von 10.000 W und einer Toleranz von 500 W werden ab 9.500 W keine neuen Kalibrierwerte gespeichert. So wird eine technisch richtige PV-Prognose nicht nach unten korrigiert, nur weil der Wechselrichter wegen der Netzgrenze abregelt. Falls die Netzeinspeisung mit negativem Vorzeichen geliefert wird, kann das Vorzeichen in der Konfiguration invertiert werden.


## Änderungen v1.3.1
- Preisdiagramm wieder auf die bewährte reine Highcharts-Balkengrafik zurückgestellt. Die Balken zeigen Stundenmittel aus den vier echten 15-Minuten-Werten; die Optimierung bleibt 15-minütig.
- Bei fehlendem oder fehlerhaftem Highcharts wird automatisch die Fallback-Grafik eingeblendet.
- Der Einspeiseplan ist über „Einspeiseplan anzeigen / ausblenden“ auf- und zuklappbar.


## Änderungen v1.3.2
- Börsenpreis-Diagramm als vollständiges eigenständiges HTML-Dokument ausgegeben, passend zum bewährten IP-Symcon/IPSView-Highcharts-Aufbau.
- Highcharts wird nach dem lokalen Laden direkt initialisiert; die fehleranfällige DOMContentLoaded-Nachinitialisierung wurde entfernt.
- Automatischer Reflow nach dem Laden ergänzt.
- Bei einem Highcharts-Laufzeitfehler wird die HTML/CSS-Fallback-Grafik eingeblendet und der Fehlertext sichtbar ausgegeben.


## Änderungen v1.4.3

- Highcharts-Diagramm auf den bewährten Aufbau aus Version 1.2.0 zurückgeführt.
- Keine überlagerte 15-Minuten-Linie mehr.
- Anzeige wieder als einfache Stunden-Balkengrafik.
- Stundenpreis = arithmetischer Mittelwert der vier 15-Minuten-Werte.
- Preis wird direkt über jedem Balken angezeigt.
- Die Optimierung und Batteriesteuerung bleiben unverändert im 15-Minuten-Raster.

## Änderungen v1.3.3

- Preisdiagramm bewusst auf die einfache Balkengrafik vor der Viertelstunden-Linienversion zurückgestellt.
- Pro Stunde wird der Mittelwert aus den verfügbaren echten 15-Minuten-EPEX-Werten berechnet.
- Der Stundenpreis steht wieder direkt über jedem Balken.
- Keine überlagerte Liniengrafik.
- Tahoma und weiße Beschriftungen bleiben bestehen.
- Planung und AlphaESS-Dispatch arbeiten weiterhin mit den echten 15-Minuten-Werten.


## Verbrauchsprofil lernen

Ab Version 1.4.3 lernt das Modul aus der archivierten Variable **Hausverbrauch Leistung (W)** zusätzlich zum Nachtverbrauch ein stündliches Lastprofil. Neuere Tage werden stärker gewichtet; Werktage und Wochenenden werden passend zum Folgetag unterschiedlich gewichtet. Auf die gelernte Prognose kann ein Sicherheitsaufschlag gesetzt werden.

Für die Einspeiseentscheidung wird die PV-Prognose des nächsten Tages zeitgleich mit dem erwarteten Eigenverbrauch verrechnet. Nur der erwartete PV-Überschuss kann zum Wiederaufladen des Speichers verwendet werden. Die Einspeisung wird deshalb so begrenzt, dass der konfigurierte **Ziel-SoC nach dem nächsten PV-Tag** erreichbar bleibt und der Nacht-/Eigenverbrauch berücksichtigt ist.

Das Verbrauchsprofil wird höchstens alle sechs Stunden neu aus dem Archiv aufgebaut. Über **Verbrauchsprofil neu lernen** kann die Berechnung jederzeit manuell erzwungen werden.

## Preisdiagramm über 24 Stunden

Das Diagramm zeigt immer ein Zeitfenster von 24 Stunden ab der laufenden Stunde. Die Stundenpreise sind weiterhin das arithmetische Mittel der verfügbaren vier 15-Minuten-Werte. Noch nicht vom Preislieferanten veröffentlichte Day-Ahead-Stunden bleiben leer und werden beim nächsten Preisabruf automatisch ergänzt.

### PV-Autokalibrierung zurücksetzen

Mit **„PV-Kalibrierung / Auto-Faktoren zurücksetzen“** werden alle gespeicherten PV-Kalibrierwerte, Auto-Faktoren und zugehörigen Lernmesspunkte gelöscht. Jede aktive Auto-Kalibrierung startet anschließend wieder bei Faktor **1,000** und lernt ab der nächsten Berechnung neu. Der Lernzeitraum **„Lernzeitraum PV-Auto-Faktor“** ist einstellbar; Standard sind **30 Tage**. Bei unbekannter Ausrichtung beginnt durch das Zurücksetzen auch deren Lerntage-Zählung erneut, wodurch die Einspeiseautomatik bis zum Erreichen der konfigurierten gültigen Lerntage wieder gesperrt sein kann.


## Neu in 1.4.3
- Eigenes Highcharts-Balkendiagramm **PV-Prognose Diagramm** für heute und morgen. Für heute wird die tatsächlich gemessene PV-Produktion als gelber, überlagerter Balken dargestellt.
- Balken zeigen die prognostizierte mittlere PV-Leistung je Stunde in kW; Wert steht über dem Balken.
- Gesamtprognose in kWh und erwarteter Beginn oberhalb der Morgenschwelle werden unter der Grafik angezeigt.



## Neu in 1.4.5 – Ist-Produktion über der PV-Prognose

Im **PV-Prognose Diagramm** wird für den heutigen Tag zusätzlich die tatsächlich gemessene PV-Leistung aus dem IP-Symcon-Archiv dargestellt. Die Ist-Produktion liegt als schmalerer **gelber Balken** direkt über dem Prognosebalken. Unter der Grafik stehen die prognostizierte Tagesenergie heute, die tatsächlich erzeugte Energie heute bis zum aktuellen Zeitpunkt und die Prognose für morgen.

Als Quelle wird bevorzugt die konfigurierte **PV-Istleistung Gesamtvariable** verwendet. Ist diese nicht gesetzt, summiert das Modul die konfigurierten PV-String-/MPPT-Variablen der aktiven Flächen. Die aktuelle Stunde wird als mittlere Ist-Leistung vom Stundenbeginn bis zum aktuellen Zeitpunkt dargestellt. Zukünftige Stunden erhalten keinen Ist-Wert.

## Neu in 1.4.4 – PV-Kalibrierdiagnose und Prognose heute + morgen

Die Instanz stellt zusätzlich **PV Prognose heute** bereit. Das PV-Prognose-Diagramm zeigt nun 48 Stunden als Balken: den kompletten heutigen Tag und den kompletten morgigen Tag. Unter der Grafik werden die prognostizierten Tagesenergien für heute und morgen getrennt angegeben.

Die neue HTMLBox **PV-Kalibrierung Diagnose** zeigt für jede PV-Fläche die aktuelle theoretische Leistung **vor Auto-Faktor**, die daraus mit Auto-Faktor entstehende Prognose, die aktuell gemessene Leistung der zugeordneten PV-Variablen, das momentane Verhältnis Ist/Theorie, die Lern-Summen innerhalb des eingestellten Kalibrierzeitraums, den daraus resultierenden Auto-Faktor, die Zahl der verwendeten Samples und den letzten Sample-Zeitpunkt. Damit lässt sich insbesondere ein unerwarteter Auto-Faktor von z. B. 0,5 nachvollziehen.

Der Auto-Faktor wird aus den gespeicherten Lernwerten berechnet als `Summe Istleistung / Summe theoretische Leistung vor Auto-Faktor`. Die theoretische Leistung enthält kWp, GTI, SystemEfficiency, Flächen-Faktor und GlobalPVFactor, aber noch nicht den Auto-Faktor selbst.


## Historischer Prognosevergleich (v1.4.6)

Die PV-Grafik zeigt die Stundenwerte als **kWh pro Stunde**. Transparente gelbe Balken zeigen die tatsächlich erzeugte Energie aus dem IP-Symcon-Archiv. Mit den Pfeiltasten unter der Grafik kann tageweise zurück- und vorgeblättert werden. Day-Ahead-Prognosen werden gespeichert, damit vergangene Prognosen mit den realen Produktionswerten verglichen werden können. Bereits vergangene Tage vor Installation dieser Version können nicht als ursprüngliche Prognose rekonstruiert werden.


## Stabilisierung PV-Prognose-Diagramm (v1.4.7)

Die Highcharts-Ausgabe wurde wieder auf einen einfachen, IP-Symcon-kompatiblen Aufbau zurückgeführt. Beim Blättern zwischen Tagen wird das Diagramm vollständig neu aufgebaut. Prognose und Ist-Produktion werden weiterhin als kWh je Stunde dargestellt; die Ist-Werte sind transparent gelb überlagert.

## PV-Grafik 06:00–22:00 Uhr und Aktualisierungszeit (v1.4.8)

Das PV-Prognose-Diagramm zeigt zur besseren Lesbarkeit nur noch die Stunden von **06:00 bis 22:00 Uhr**. Die interne PV-Prognose, die Kalibrierung und die angezeigten Tages-Gesamtsummen bleiben unverändert auf den vollständigen Tag bezogen. Sowohl im PV-Prognose-Diagramm als auch im Börsenpreis-Diagramm wird der Zeitpunkt der letzten Diagrammaktualisierung angezeigt.

Die Prognose- und Preisdaten werden über den konfigurierbaren **Aktualisierungsintervall** (`RefreshMinutes`) neu berechnet und abgerufen; Standard sind 30 Minuten, technisch mindestens 5 Minuten. Zusätzlich erfolgt eine Neuberechnung bei manueller Neuberechnung sowie beim Aktivieren der Einspeiseautomatik. Die Batteriesteuerung selbst wird unabhängig davon jede Minute geprüft und verwendet die zuletzt berechneten Daten.


### Aktualisierungsintervalle (v1.4.9)
Die Aktualisierung ist getrennt einstellbar: Preise/Optimierung (Standard 30 min), PV-Prognose/Open-Meteo (Standard 30 min) und PV-Istwerte/PV-Grafik (Standard 5 min). Die Batteriesteuerung wird weiterhin jede Minute geprüft. Die 5-Minuten-PV-Istaktualisierung verwendet lokale IP-Symcon-Archivwerte und löst keinen zusätzlichen Open-Meteo-Abruf aus.

## Änderungen v1.5.0 – PV-Kalibrierung in kWh

Die automatische PV-Kalibrierung arbeitet ab v1.5.0 nicht mehr mit aufsummierten Watt-Momentanwerten. Zwischen aufeinanderfolgenden gültigen Messpunkten werden sowohl die theoretische PV-Leistung vor Auto-Faktor als auch die gemessene String-/MPPT-Leistung zeitlich integriert. Dadurch entstehen für exakt denselben Zeitraum zwei Energiemengen in **kWh**.

`Auto-Faktor = Summe Ist-Erzeugung kWh / Summe Prognose vor Auto-Faktor kWh`

Beispiel: 100,0 kWh theoretische Prognose und 118,0 kWh tatsächliche Erzeugung ergeben einen Auto-Faktor von 1,180. Der Faktor wird anschließend weiterhin durch die konfigurierten Minimal- und Maximalwerte begrenzt. Der einstellbare Lernzeitraum beträgt standardmäßig 30 Tage. Abregelphasen an der konfigurierten Einspeisegrenze werden nicht überbrückt und fließen nicht in die Energieintegration ein.

Da die alten Kalibrierdaten aus früheren Versionen aus Watt-Samples bestehen, werden diese beim ersten Start von v1.5.0 automatisch verworfen. Manuelle PV-Flächenparameter wie kWp, Azimut, Neigung und manueller Faktor bleiben unverändert.

Das gelernte Tagesverbrauchsprofil kann bereits ab **3 gültigen Tagen** verwendet werden. Die Mindestzahl ist über **„Mindestens gültige Tage für Tagesverbrauchsprofil“** einstellbar und steht standardmäßig auf 3 – analog zur Mindestanzahl gültiger Nächte.


## Preisportal und Vorschauhorizont

Es gibt nur noch das Auswahlfeld **Preisquelle / Tarif**. Zur Auswahl stehen **EPEX SPOT AT 60 min**, **aWATTar SUNNY Spot 60min**, **Eigene JSON-Quelle** und **Benutzerdefiniert (Faktoren unten)**. Weitere Portale oder Tarifmodelle können später als zusätzliche Auswahl ergänzt werden.

Die Einstellung **Preisvorschau / Diagramm (Stunden)** legt den sichtbaren Horizont fest. Sie ist von **24 bis 72 Stunden** einstellbar. Bei EPEX werden ausschließlich tatsächlich veröffentlichte Day-Ahead-Werte angezeigt; noch nicht veröffentlichte Stunden bleiben leer und werden bei einem späteren Abruf ergänzt. Die von smartENERGY gelieferten 15-Minuten-Rohwerte werden bereits vor der Tarifberechnung zu arithmetischen 60-Minuten-Mittelwerten zusammengefasst.

### Einspeiseplan
Der sichtbare Einspeiseplan wird ab Version 1.5.3 ausschließlich in Stundenwerten dargestellt. Marktpreis und Tarif sind Stundenmittelwerte; geplante Energie wird je Stunde aufsummiert. Die interne Batteriesteuerung bleibt feiner aufgelöst.

### Historische PV-Prognosen
Ab Version 1.5.4 werden bereits vergangene Prognosestunden nicht mehr nachträglich verändert. Bei einer neuen Wetteraktualisierung werden nur die aktuelle und zukünftige Stunden mit der neuesten Prognose überschrieben. Dadurch bleibt der spätere Vergleich zwischen damaliger Prognose und tatsächlicher PV-Erzeugung nachvollziehbar.

### Zwei PV-Prognosequellen und automatische Gewichtung
Ab Version 1.5.5 können Open-Meteo und Forecast.Solar einzeln oder gemeinsam aktiviert werden. Mindestens eine Quelle muss aktiv sein. Forecast.Solar kann ohne API-Key über die Public API verwendet werden; ein eigener API-Key kann optional eingetragen werden.

Sind beide Quellen aktiv, speichert das Modul die Stundenprognosen jeder Quelle getrennt. Vollständig vergangene Prognosestunden werden nicht mehr verändert. Für den einstellbaren Lernzeitraum wird jede damalige Stundenprognose mit der tatsächlichen PV-Erzeugung aus dem IP-Symcon-Archiv verglichen. Aus dem mittleren absoluten Stundenfehler (MAE) wird automatisch ein Gewicht gebildet: Je kleiner der historische Fehler, desto höher das Gewicht. Solange noch nicht genügend Vergleichswerte vorliegen, starten beide Quellen mit gleicher Gewichtung.

### pvnode als dritte PV-Prognosequelle
Ab Version 1.5.6 kann zusätzlich pvnode V2 verwendet werden. In pvnode wird die PV-Anlage als Standort mit einer Site-ID angelegt. Im Modul werden bei aktivierter Quelle die pvnode Site-ID und der API-Key eingetragen. Die Abfrage erfolgt über den V2-Forecast-Endpunkt und liefert 15-Minuten-PV-Leistungswerte, die für die gemeinsame Prognose zu Stundenwerten zusammengefasst werden.

Sind Open-Meteo, Forecast.Solar und/oder pvnode gemeinsam aktiv, nimmt pvnode an derselben lernenden Quellengewichtung teil. Auch für pvnode werden bereits vergangene Stundenprognosen eingefroren und später mit der tatsächlichen PV-Erzeugung verglichen.

Schutz vor falschen Zugangsdaten: Nur echte API-Ablehnungen wegen Authentifizierung oder ungültiger Site-Konfiguration zählen als Fehlversuch. Nach drei aufeinanderfolgenden Ablehnungen wird `pvnode verwenden` automatisch ausgeschaltet und der Konfigurationshaken entfernt. Erst wenn der Benutzer pvnode erneut anhakt und die Konfiguration übernimmt, werden weitere pvnode-Abfragen zugelassen. Netzwerkfehler, Serverfehler und Rate-Limits lösen diese Sperre nicht aus.
