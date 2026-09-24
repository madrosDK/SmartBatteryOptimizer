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


## Debug-Modus (ab 1.5.7)
Über `Debug-Ausgaben aktivieren` kann eine ausführliche Diagnose zugeschaltet werden. Protokolliert werden unter anderem Aktualisierungsläufe, Prognosequellen und empfangene Datenmengen, PV-Quellengewichtung inklusive Anzahl historischer Vergleichswerte und MAE, PV-/Verbrauchslernen, Preisabruf, Einspeiseplanung, Steuerentscheidung und AlphaESS-Befehle. Zugangsschlüssel werden nicht ins Debug geschrieben.

Bei aktivem Debug enthält das PV-Prognosediagramm zusätzlich je aktive Quelle eine separat über die Legende einblendbare Prognoseserie. Die Anbieterreihen sind standardmäßig ausgeblendet, damit die bisherige kombinierte Prognose übersichtlich bleibt. Beim Namen jeder Anbieterreihe wird die aktuell gelernte Gewichtung in Prozent angezeigt. Vergangene Stundenwerte stammen weiterhin aus den eingefrorenen Quellprognosen und werden nicht nachträglich geändert.

### Debug-Modus anwenden
Ab Version 1.5.8 wird ein Wechsel des Debug-Modus beim Klick auf **Übernehmen** sofort erkannt. Das Modul führt dann eine vollständige Neuberechnung durch und baut die HTML-Ausgaben und Diagramme unmittelbar neu auf. Dadurch werden die zusätzlichen Einzelprognosen der Anbieter beim Aktivieren sofort eingeblendet bzw. beim Deaktivieren sofort wieder entfernt; ein Warten auf den nächsten Aktualisierungstimer ist nicht erforderlich.

### Debug-Umschaltung ohne Wartezeit
Ab Version 1.5.9 führt `ApplyChanges()` beim Ein- oder Ausschalten des Debug-Modus keine externen API-Abfragen mehr synchron aus. Stattdessen wird ein kurzer One-Shot-Timer gestartet. Der Übernehmen-Dialog kann dadurch sofort beendet werden; die HTMLBoxen werden danach im Timer-Kontext neu aufgebaut und anschließend werden die Prognosequellen vollständig aktualisiert.

Im Debug-PV-Diagramm werden alle in der Konfiguration aktivierten Prognoseanbieter als einzeln schaltbare Serien angeboten. Forecast.Solar, Open-Meteo oder pvnode verschwinden nicht mehr aus der Legende, nur weil ein einzelner API-Abruf temporär fehlschlägt. Die Legende zeigt die zuletzt gelernte Gewichtung.

### Automatische Tag-/Nachtbestimmung
Ab Version 1.6.0 kann die Nachtzeit automatisch aus IP-Symcon-Variablen für Sonnenaufgang und Sonnenuntergang bestimmt werden. Standardmäßig beginnt die Nacht 60 Minuten vor Sonnenuntergang und endet 60 Minuten nach Sonnenaufgang; beide Werte sind getrennt einstellbar.

Ist der Automatikmodus aktiviert, zeigt die Konfiguration nur Sonnenaufgang, Sonnenuntergang und die beiden Zeitversätze. Die manuellen Felder für Nachtbeginn und Nachtende werden ausgeblendet. Bei deaktivierter Automatik ist es genau umgekehrt.

Die Sonnenvariablen können Unix-Zeitstempel, Sekunden seit Mitternacht oder Uhrzeiten als Text enthalten. Beim Lernen historischer Nächte werden nach Möglichkeit archivierte Werte der Sonnenvariablen verwendet. Fehlt ein verwertbarer Wert, fällt das Modul auf die manuell gespeicherten Nachtzeiten zurück.

### Korrektur Tag/Nacht-Konfigurationsformular 1.6.1
Die dynamische Sichtbarkeit der Tag-/Nacht-Felder wird direkt über die Formularbedingung `AutomaticDayNight` gesteuert. Dadurch wird beim Umschalten kein `RequestAction` mit einer nicht definierten Formularvariable mehr ausgeführt. Die Automatikfelder erscheinen unmittelbar beim Einschalten; die manuellen Felder werden gleichzeitig ausgeblendet und umgekehrt.

### Verbrauchsaufteilung Tag/Nacht ab 1.6.2
Die morgige Gesamtverbrauchsprognose ist die feste Obergrenze für alle Teilverbräuche. Der gelernte Nachtverbrauch wird höchstens bis zur Gesamtprognose angesetzt. Der verbleibende Tagesverbrauch wird anhand des gelernten Stundenprofils auf **Verbrauch während prognostizierter PV-Zeit** und **übrigen Tagverbrauch** verteilt.

Damit gilt immer:
`Nachtverbrauch + Verbrauch während PV-Zeit + übriger Tagverbrauch = Gesamtverbrauch morgen`

Die PV-Zeit wird aus der stündlichen PV-Prognose des nächsten Tages bestimmt. Die automatische bzw. manuelle Tag-/Nachtgrenze wird berücksichtigt, sodass sich Nacht- und Tagesverbrauch nicht überschneiden.

### Debug-Serien im PV-Diagramm
Der Ein-/Ausblendzustand der einzelnen Anbieterlinien wird im Browser gespeichert. Open-Meteo, Forecast.Solar und pvnode bleiben deshalb nach Aktualisierung, Navigation oder Neuaufbau der HTMLBox so sichtbar bzw. unsichtbar, wie sie zuletzt über die Highcharts-Legende eingestellt wurden.

### Übersicht / Debug-Navigation 1.6.3
Die Übersicht ist kompakter in Batterie, Verbrauch morgen, PV morgen und Optimierung gegliedert. Doppelte Nachtverbrauchsangaben wurden entfernt. Die drei Verbrauchsteile werden in einer Zeile als Summe der Gesamtprognose dargestellt.

Vor jedem Highcharts-Tageswechsel wird der aktuelle Sichtbarkeitszustand der Debug-Quellen gesichert und anschließend wieder geladen. Zusätzlich speichern `show`/`hide` die Auswahl unmittelbar. Damit bleibt die Auswahl beim Vor- und Zurückblättern erhalten.

### Korrektur Debug-Serien beim Tageswechsel 1.6.4
Die Sichtbarkeit der Debug-Quellen wird beim Klick auf einen Legendeneintrag sofort in einem JavaScript-Zustandsobjekt aktualisiert. Beim Vor-/Zurückblättern wird genau dieses aktuelle Objekt weiterverwendet. Es wird nicht mehr bei jedem Tageswechsel erneut aus `localStorage` geladen, wodurch ein noch nicht synchronisierter älterer Zustand die Auswahl überschreiben konnte.

`localStorage` wird weiterhin verwendet, um die Auswahl nach einem vollständigen Neuaufbau der HTMLBox wiederherzustellen.

### Übersicht 1.6.5
Die HTML-Übersicht wurde als kompakte Tabelle mit den Bereichen Batterie, Verbrauch morgen, PV-Prognose und Optimierung neu aufgebaut. Doppelte Nachtverbrauchsangaben wurden entfernt.

Unter Verbrauch morgen wird zusätzlich das tatsächlich verwendete Nachtfenster angezeigt. Im Automatikmodus ist dies `Sonnenuntergang − Vorlauf` bis `Sonnenaufgang + Nachlauf`; im manuellen Modus werden die festen Uhrzeiten angezeigt.

### Übersicht 1.6.6
Das Nachtfenster wird nun zusätzlich als konkrete Uhrzeit der nächsten Nacht angezeigt, z. B. `18:42 – 07:11 Uhr`. Bei automatischer Tag-/Nachtbestimmung steht die verwendete Regel klein dahinter.

Die interne Anzeige `Profil: Archiv gelernt – X Tage, Stundenprofil` wurde verständlicher benannt. Angezeigt wird nun z. B. `Tagesprofil: aus Archiv · 6 gültige Tage · stündliches Profil`. Damit ist klar, dass aus den archivierten Hausverbrauchswerten ein 24-Stunden-Verbrauchsmuster gelernt wurde.

### Planung bis zum Abend 1.6.8
Die Einspeiseplanung berücksichtigt für spätere Einspeisefenster am selben Tag nun auch die noch erwartete PV-Erzeugung bis zum Nachtbeginn sowie den bis dahin prognostizierten Hausverbrauch. Dadurch wird nicht mehr ausschließlich der momentan im Speicher vorhandene Energieinhalt als Grundlage für ein abendliches Einspeisefenster verwendet.

Die Schutzreserve bleibt bewusst erhalten: Nachtverbrauch inklusive Sicherheitsaufschlag plus der benötigte Speicherstand am nächsten PV-Morgen. Die Übersicht zeigt diese beiden Bestandteile getrennt sowie den erwarteten Speicherstand bei Nachtbeginn und die daraus voraussichtlich frei verfügbare Energie.

### Korrektur Nachtfenster 1.6.9
Die automatische Nachtzeit wird eindeutig als **Sonnenuntergang des Abends minus Vorlauf** bis **Sonnenaufgang des Folgetages plus Nachlauf** berechnet.

Für historische Lerntage wird nicht mehr irgendein Änderungswert der archivierten Sonnenzeitvariable innerhalb des Tages verwendet. Stattdessen wird der letzte gültige Archivwert bis 12:00 Uhr des jeweiligen Kalendertages ausgewertet. Damit wird verhindert, dass ein unpassender alter oder bereits weitergeschalteter Sonnenzeitwert das Nachtfenster verfälscht.

Im Debug wird für jede gelernte Nacht nun Start, Ende, Dauer, Verbrauch und mittlere Leistung ausgegeben.

### Netzlimit-Schutz / PV-Leistungsprognose 1.7.0
Der Optimierer wertet zusätzlich zur PV-Energie nun die prognostizierte PV-Leistung aus. Konfigurierbar sind maximale Netzeinspeisung, Sicherheitsabstand zur Grenze und maximale Batterieladeleistung.

Für morgen wird intern in 15-Minuten-Slots gerechnet. Die vorhandenen stündlichen Prognosewerte werden dabei als mittlere Leistung auf vier Viertelstunden verteilt. Pro Slot gilt sinngemäß:

`mögliche Netzeinspeisung = PV-Leistung - erwarteter Hausverbrauch`

Wenn die mögliche Netzeinspeisung oberhalb von `Netzlimit - Sicherheitsabstand` liegt, berechnet das Modul, wie viel Batterie-Aufnahmeleistung und Speicherplatz nötig sind. Der notwendige Speicherplatz wird als Mindestanforderung in die bestehende PV-Speicherfreihaltung übernommen und muss vor dem ersten kritischen Slot geschaffen sein.

Neue Ausgaben:
- PV Spitzenleistung morgen Prognose
- Max. erwartete Netzeinspeisung morgen ohne Batterie
- Speicherbedarf Netzlimit-Schutz

Wichtig: Bei Open-Meteo und den zusammengeführten Anbieterwerten handelt es sich um Stundenmittel. Die angezeigte Spitzenleistung ist daher die höchste prognostizierte Stundenleistung, keine garantierte kurzfristige Wechselrichterspitze. Der einstellbare Sicherheitsabstand zur 10-kW-Grenze dient dazu, diese Unsicherheit abzufangen.

### Frontend-Steuerung Netzlimit-Schutz 1.7.1
Alle für den PV-/Netzlimit-Schutz relevanten Betriebswerte sind als bedienbare IP-Symcon-Variablen verfügbar. Dazu gehören Ein/Aus, maximale Netzeinspeisung, Sicherheitsabstand, maximale Batterieladeleistung, maximaler Ziel-SoC bei starker PV, Anteil der PV-Prognose als möglicher Batterieüberschuss und Mindestpreis für notwendige Speicherfreihaltung.

Die Instanzkonfiguration liefert beim ersten Anlegen der Variablen nur die Startwerte. Danach sind die Frontend-Variablen für die laufende Optimierung maßgeblich. Eine Änderung löst unmittelbar eine neue Planung mit den bereits geladenen Prognose- und Preisdaten aus.

### Frontend-Profile 1.7.2
Die editierbaren Laufzeitvariablen verwenden nun eigene, typkorrekte IP-Symcon-Profile. Leistungswerte sind Integer mit Einheit W, Prozentwerte und Preise sind Float-Profile. Dadurch wird die WebFront-/Tile-Fehlermeldung `Invalid profile type` vermieden.

### Preislogik für notwendige Speicherfreihaltung 1.7.3
Die normale Einspeisung nutzt weiterhin den normalen Mindest-Einspeisepreis. Reicht die dadurch geschaffene Speicherkapazität für den PV-/Netzlimit-Schutz nicht aus, wählt der Optimierer zusätzlich die bestbezahlten noch freien Zeitfenster vor dem kritischen PV-Zeitpunkt. Die separate Preisuntergrenze für notwendige Speicherfreihaltung ist dabei eine harte Untergrenze. Standard ist nun 0 ct/kWh; negative Preise werden damit nicht verwendet, sofern der Benutzer die Grenze nicht bewusst negativ einstellt.

### Entladetest und Steuerdiagnose 1.7.4
Für die Diagnose der Batterieansteuerung gibt es zwei neue bedienbare Frontend-Variablen: `Test Entladeleistung` und `Test Entladung / Einspeisung`. Der Test umgeht bewusst Einspeiseplan, Preisprüfung und Lernfreigabe, respektiert aber Mindest-SoC und maximale Entladeleistung. Er läuft maximal 120 Sekunden und wird anschließend automatisch beendet.

Während des Tests hat die manuelle Ansteuerung Vorrang vor dem minütlichen Control-Timer. Zusätzlich protokolliert der Debug-Modus nun jeden Schreibversuch auf die Batterievariablen und Steuerfehler werden im Optimierungsstatus sichtbar.

### Direkter AlphaESS-Dispatch-Test 1.7.5
Der manuelle Entladetest umgeht nun vollständig `BatteryControlMode` und die normale Einspeiserouting-Logik. Er ruft AlphaESS Dispatch direkt auf. Im Teststatus und Debug werden die fünf konfigurierten IP-Symcon-Variablen-IDs für Start, Active Power, Mode, SoC und Time sowie die RAW-Schreibwerte ausgegeben.

Bei 1000 W Testleistung wird Active Power als 33000 geschrieben. Danach folgen Mode 2, SoC-Ziel, Testdauer und zuletzt Start 1. Der Test läuft maximal 120 Sekunden. Stop schreibt Dispatch Start unabhängig vom internen Active-Status explizit auf 0.

### AlphaESS Dispatch-Schreibfolge 1.7.6
Die Dispatch-Ansteuerung schreibt die Parameter nun strikt in der Reihenfolge Active Power, Mode, SoC, Time und zuletzt Start. Für 1000 W Entladung wird Active Power 33000 geschrieben. Dispatch Mode ist 2. SoC wird mit 0,4 % pro Bit aus dem konfigurierten Mindest-SoC berechnet; die Zeit enthält die verbleibende Dispatch-/Testdauer.

Ein fehlgeschlagenes `RequestAction` wird nicht mehr durch `SetValue` kaschiert. `SetValue` würde bei einer Modbus-Schreibvariable lediglich den lokalen IP-Symcon-Wert verändern. Schreibfehler werden deshalb jetzt abgebrochen und im Test-/Debugstatus sichtbar.

### Dispatch Mode 1.7.7
Für die AlphaESS-Entladeansteuerung wird wieder Dispatch Mode 2 verwendet. Die Schreibreihenfolge bleibt Active Power, Mode, SoC, Time und zuletzt Start. Alle Diagnose- und Fehlerbehandlungen aus 1.7.6 bleiben unverändert.

### Dynamische PV-Abregelungsvermeidung 1.7.8
PV-Istwerte und PV-Prognose werden jetzt im gleichen Intervall aktualisiert. Maßgeblich ist `PVActualRefreshMinutes`; der separate Prognose-Timer ist deaktiviert, damit keine doppelten Prognoseabrufe entstehen.

Bei jedem dieser Zyklen werden Prognose, aktueller Batterie-SoC und Einspeiseplan neu berechnet. Wird der eingestellte maximale PV-Ziel-SoC früher als prognostiziert erreicht oder überschritten, wird die reale Überschreitung sofort als zusätzlicher benötigter Speicherplatz berücksichtigt. Die eigentliche Steuerprüfung läuft weiterhin jede Minute.

### Sofortiger Netzlimit-Schutz bei erreichtem PV-Ziel-SoC 1.7.9
Sobald der aktuelle Batterie-SoC den eingestellten PV-Ziel-SoC überschreitet, beginnt der Abregelungsschutz sofort. Der Status zeigt dann `Netzlimit-Schutz JETZT` statt weiterhin nur den späteren prognostizierten kritischen Zeitpunkt. Der prognostizierte Netzlimit-Zeitpunkt wird zusätzlich informativ angezeigt.

Der über dem Ziel-SoC liegende Energieinhalt wird als unmittelbar freizumachender Speicherplatz in die Planung übernommen. Prognose und Istwerte werden weiterhin gemeinsam im PV-Ist-Intervall aktualisiert; die Steuerung prüft jede Minute.

### Netzlimit-Schutz steuert AlphaESS sofort 1.8.0
Der Status `Netzlimit-Schutz JETZT` ist nicht mehr nur Planungsinformation. Sobald der aktuelle Batterie-SoC über dem eingestellten PV-Ziel-SoC liegt, erzeugt die minütliche Steuerprüfung unmittelbar einen Entladebefehl. Der Sofortschutz läuft vor Lernfreigabe und normalem Preisplan.

Die Entladeleistung wird aus dem aktuellen SoC-Überschuss berechnet und auf die konfigurierte maximale Entladeleistung begrenzt. Bei AlphaESS wird die bestehende Dispatch-Sequenz verwendet: Active Power, Mode 2, SoC, Time und zuletzt Start. Alle zwei Minuten wird der Dispatch durch die minütliche Steuerprüfung anhand des aktuellen SoC erneuert, solange der Ziel-SoC überschritten ist.

### Netzlimit-Dispatch 1.8.1
Die in 1.8.0 versehentlich verwendete, nicht vorhandene Eigenschaft `BatterySOCVariable` wurde auf die vorhandene `SOCVariable` korrigiert.

Im AlphaESS-Modus ruft der sofortige Netzlimit-Schutz nun `SetAlphaESSDispatch()` direkt auf. Damit werden beim Entladen zwingend alle Dispatch-Werte in dieser Reihenfolge geschrieben: Active Power = 32000 + Entladeleistung, Mode = 2, Dispatch SoC aus dem konfigurierten Mindest-SoC, Dispatch Time aus der aktuellen Schutzdauer und zuletzt Dispatch Start = 1.

### AlphaESS Dispatch ohne Cache-Unterdrückung 1.8.2
Die AlphaESS-Schreibsequenz wird bei jedem aktiven Steuerzyklus vollständig neu gesendet. Ein intern als aktiv gespeicherter identischer Befehl darf die Registerschreibvorgänge nicht mehr überspringen.

Die Reihenfolge bleibt: Active Power = 32000 + Entladeleistung, Mode = 2, Dispatch SoC, Dispatch Time und zuletzt Dispatch Start = 1. Nach jedem Schreibversuch wird der lokale IP-Symcon-Wert im Debug als Readback protokolliert. Dadurch ist für jedes der fünf Register einzeln sichtbar, welcher Sollwert geschrieben wurde und welcher Wert unmittelbar danach in IP-Symcon anliegt.

### Zentraler AlphaESS-Dispatchblock 1.8.3
Die AlphaESS-Ansteuerung wurde auf einen einzigen zentralen Dispatchblock reduziert. Einspeisetest, Netzlimit-Schutz und normale Einspeiseautomatik verwenden denselben Block.

Bei Entladung wird zuerst Dispatch Start auf 0 gesetzt. Danach werden Active Power = 32000 + Watt, Mode = 2, Dispatch SoC und Dispatch Time geschrieben. Dispatch Start = 1 wird immer zuletzt gesendet. Für jeden Dispatchwert wird der Sollwert lokal gesetzt und anschließend die Aktion der konfigurierten IP-Symcon-Schreibvariable ausgelöst. Fehler werden nicht unterdrückt.

### AlphaESS Dispatch 1.8.4
Direkte Wertänderungen der read-only Modbusvariablen wurden aus dem Dispatch entfernt. Geschrieben wird ausschließlich über die jeweilige IP-Symcon-Aktion. Die zentrale Sequenz lautet Start 0, Active Power = 32000 + Entladeleistung, Mode 2, Dispatch SoC, Dispatch Time und zuletzt Start 1. Zwischen den Befehlen wird kurz serialisiert.

### Gestufter AlphaESS-Diagnosetest 1.8.5
Der manuelle Einspeisetest schreibt die sechs Schritte mit jeweils etwa drei Sekunden Abstand: Start=0, Active Power, Mode=2, SOC, Time und zuletzt Start=1. Vor und direkt nach jedem Schritt werden die sichtbaren Werte protokolliert. Nach Start=1 werden keine Dispatchwerte mehr geschrieben; der Test beobachtet nur noch alle drei Sekunden Power, Mode, SOC, Time und Start. Der Verlauf erscheint in `Test Entladung Status`.

### AlphaESS Mode-2-Test 1.8.6
Der manuelle Einspeisetest wurde auf die Mode-2-Parameter reduziert. Er schreibt mit etwa drei Sekunden Abstand ausschließlich `Active Power = 32000 + Entladeleistung`, `Mode = 2` und den Ziel-SOC mit 0,4 % pro Bit. `Dispatch Time` und `Dispatch Start` werden während dieses Tests nicht verändert. Anschließend werden Power, Mode, SOC, Time und Start nur beobachtet und im Teststatus protokolliert.

### Nachtentladung und Intervalle 1.8.7
Die automatische Speicherentladung ist wieder strikt auf das Nachtfenster begrenzt. Tagsüber wird kein Dispatch zum vorsorglichen Freimachen des Speichers gestartet. Die für die Nacht verfügbare Einspeiseenergie wird aus aktuellem Speicherinhalt, Mindest-SOC, gelerntem Nachtverbrauch und der PV-/Verbrauchsprognose für den Folgetag bestimmt. Preisoptimierte Einspeiseslots werden ausschließlich innerhalb des Nachtfensters ausgewählt.

Das Intervall `PV-Prognose aktualisieren (Minuten)` ist wieder separat einstellbar. PV-Prognose und PV-Istwerte besitzen wieder getrennte Timer; ein PV-Ist-Update verwendet die zuletzt gespeicherte Prognose und löst keinen zusätzlichen Prognoseabruf aus.

### AlphaESS Dispatch-Reihenfolge 1.8.8
Für dieses AlphaESS-System wird `Dispatch Start = 1` vor allen weiteren Dispatchparametern geschrieben. Erst danach folgen Active Power, Mode 2, SOC und beim normalen zentralen Dispatchblock die Dispatch Time. Ein vorheriges Zurücksetzen von Start auf 0 entfällt. Der manuelle Mode-2-Test verwendet zur Diagnose ausschließlich die Reihenfolge Start=1, Active Power, Mode=2 und SOC; Time bleibt dabei unangetastet.

### Direkte 3-Sekunden-Testsequenz 1.8.9
Der manuelle AlphaESS-Test wird nun vollständig innerhalb eines einzigen Aufrufs ausgeführt. Zwischen Start=1, Active Power, Mode=2 und SOC liegen tatsächlich jeweils drei Sekunden. Der 60-Sekunden-Control-Timer schaltet die Teststufen nicht mehr weiter und schreibt während des laufenden Tests keine Dispatchparameter nach.

### Getrennte Steuerfunktionen 1.9.0
Die preisoptimierte Einspeiseautomatik und „PV-Abregelung vermeiden“ sind jetzt logisch getrennt. Die Einspeiseautomatik plant Batterieentladung ausschließlich im Nachtfenster nach den wirtschaftlich besten verfügbaren Preisen und der Energie-/PV-Prognose. „PV-Abregelung vermeiden“ arbeitet unabhängig davon ausschließlich tagsüber: Überschreitet der Batterie-SoC den eingestellten PV-Headroom-Ziel-SoC, darf die Batterie tagsüber ins Netz entladen werden, um wieder Speicherplatz für PV-Leistung zu schaffen. Diese Tagesfunktion funktioniert auch dann, wenn die preisoptimierte Einspeiseautomatik deaktiviert ist. Die bestätigte AlphaESS-Reihenfolge Start=1 → Active Power → Mode 2 → SOC bleibt erhalten.

### Einspeisedauer und Zeitfenster 1.9.1
Die geplante Einspeisemenge wird jetzt mit der konfigurierten maximalen Entladeleistung in eine reale Laufzeit umgesetzt. Ein nur teilweise benötigtes letztes 15-Minuten-Intervall wird zeitlich verkürzt, statt die Leistung über das volle Intervall zu reduzieren. Beispiel: 16 kWh bei 20 kW entsprechen 48 Minuten. Direkt aufeinanderfolgende interne 15-Minuten-Slots werden beim „Nächsten Einspeisefenster“ zu einem durchgehenden Zeitraum zusammengefasst; die interne preisabhängige Slotsteuerung bleibt erhalten.

### PV-Faktor: Abregelung erkennen 1.9.2
Für die PV-Faktorberechnung kann zusätzlich die IP-Symcon-Variable der Batterieleistung ausgewählt werden. Dabei gilt: Laden ist negativ, Entladen positiv. Ein PV-Lernwert wird nur dann wegen möglicher Einspeiseabregelung verworfen, wenn die Netzeinspeisung innerhalb der eingestellten Toleranz an der Einspeisegrenze liegt und die Batterie gleichzeitig nicht mehr lädt (Batterieleistung >= 0 W). Bei 10.000 W Grenze und 500 W Toleranz beginnt die Prüfung ab 9.500 W. Lädt die Batterie noch (Batterieleistung < 0 W), bleibt der Messwert für die Faktorberechnung gültig.

### Stündliche PV-Korrekturfaktoren 1.9.3
Die PV-Autokalibrierung lernt zusätzlich zum Gesamtfaktor für jede Tagesstunde einen eigenen Faktor. Messwerte der jeweiligen Stunde werden über den eingestellten Kalibrierzeitraum energetisch zusammengefasst. Ist für eine Stunde noch kein eigener Lernwert vorhanden, wird automatisch der bisherige Gesamtfaktor verwendet. Die Open-Meteo-Prognose wird bereits vor der Weiterverarbeitung mit dem jeweiligen Stundenfaktor korrigiert; damit zeigen auch die Prognosebalken im PV-Highcharts-Diagramm die korrigierte Prognose. Die bestehende Abregelungssperre gilt auch für diese stündlichen Lernwerte.

Azimut-Konvention in der Konfiguration: Süd 0°, Ost −90°, West +90°, Nord −180° bzw. +180°.

### 1.9.4 – Lastprofil und Rest-SoC
Eigenes Highcharts-Diagramm für das gelernte 24-Stunden-Lastprofil mit Ist-Verbrauch und Navigation über die letzten sieben Tage. Zusätzlich kann ein gewünschter Rest-SoC nach der Nacht-Einspeisung eingestellt werden (Standard 30 %). Kann die korrigierte PV-Prognose den erwarteten Tagesverbrauch decken, darf bis zu diesem Ziel entladen werden; bei zu wenig PV wird automatisch mehr Energie reserviert. Der Minimum-SoC bleibt absolute Untergrenze.

### 1.9.5 – Mindest-SoC als Laufzeitvariable
Der zusätzliche 30-%-Rest-SoC aus 1.9.4 wurde wieder entfernt. Für die Einspeiseplanung gilt ausschließlich der konfigurierte Mindest-SoC als absolute Untergrenze. Der Mindest-SoC steht zusätzlich als beschreibbare IP-Symcon-Variable `Mindest-SoC` zur Verfügung und kann damit direkt im Frontend bzw. per Skript geändert werden. Die Laufzeitvariable wird in Planung, Steuerung, Testentladung und AlphaESS-Dispatch verwendet.

### 1.9.6 – Stundenfaktor-Fallback und Forecast.Solar Public
Fehlt für eine Prognosestunde ein eigener PV-Korrekturfaktor, z. B. weil das Lernen wegen der Einspeisebegrenzung gesperrt war, verwendet die Prognose nun den Mittelwert der übrigen gültigen Stundenfaktoren. Nur wenn noch keine Stundenfaktoren vorhanden sind, wird auf den langfristigen Gesamtfaktor zurückgegriffen. Die Faktor-Minimum-/Maximumgrenzen gelten auch für den Fallback. Ersatzwerte werden nicht in die Lerndaten zurückgeschrieben.

Forecast.Solar Public wird pro aktiver PV-Fläche separat über `estimate/{lat}/{lon}/{Neigung}/{Azimut}/{kWp}` abgefragt. Die stündlichen Ergebnisse der Flächen werden danach zur Forecast.Solar-Gesamtprognose summiert. pvnode V2 bleibt unverändert.

### 1.9.7 – Manuelle Aktionen und direkte Rückmeldung
Alle Konfigurations-Buttons schreiben jetzt sofort den Status der manuellen Aktion in die Variable `Letzte manuelle Aktion` und geben nach Abschluss eine sichtbare Rückmeldung im Konfigurationsformular aus. Nachtverbrauch und Verbrauchsprofil aktualisieren anschließend unmittelbar die abhängigen Anzeigen und den Plan. Das Zurücksetzen der PV-Kalibrierung löscht die Auto-Faktoren und berechnet PV-Prognose, Highcharts, Diagnose und Einspeiseplan sofort neu; ein Warten auf den nächsten 1-Minuten-Steuerlauf ist nicht mehr nötig. Für den manuellen Stopp gibt es einen eigenen Button-Handler, damit interne Stop-Aufrufe keine Formularausgabe erzeugen.

### 1.9.8 – Diagrammtag merken und Forecast.Solar Mehrflächenprüfung
PV- und Verbrauchs-Highcharts merken den aktuell ausgewählten Kalendertag im Browser. Wird die HTMLBox durch eine Prognose-/Istwert-Aktualisierung neu aufgebaut, bleibt derselbe Tag ausgewählt, sofern er weiterhin im verfügbaren Zeitraum liegt.

Forecast.Solar Public wird pro aktiver PV-Fläche separat abgefragt. Die Ergebnisse werden zuerst flächenweise gesammelt und erst nach erfolgreicher Auflösung aller aktiven Flächen zur Gesamtanlage addiert. Ein Fehler oder HTTP-429 bei einer Fläche kann dadurch nicht mehr unbemerkt eine zu niedrige Teilanlagen-Prognose erzeugen. Erfolgreiche Flächenantworten werden bis zu sechs Stunden zwischengespeichert; fällt ein einzelner Live-Abruf aus, kann dessen letzte gültige Flächenprognose verwendet werden. Fehlt auch dieser Cache, wird Forecast.Solar für diesen Berechnungslauf komplett aus der Quellenmischung genommen statt nur eine Teilfläche zu verwenden. Die Variable `Forecast.Solar Flächenstatus` zeigt je Fläche die morgige kWh-Prognose, Live/Cache und die Gesamtsumme.

### 1.9.9 – Asynchrone manuelle Neuberechnung
Der Button `Prognose & Plan berechnen` startet die vollständige Berechnung jetzt über einen einmaligen Modul-Timer und gibt das Konfigurationsformular sofort wieder frei. `Letzte manuelle Aktion` zeigt den aktuellen Provider/Schritt sowie Abschluss oder Fehler. Der Worker schaltet seinen Timer vor der Berechnung wieder aus, damit Fehler keine Wiederholung auslösen.

### 1.9.10 – Lastprofil-Highcharts korrigiert
Die in 1.9.8 ergänzte Speicherung des ausgewählten Lastprofil-Tages enthielt in der erzeugten JavaScript-Zeile einen fehlerhaften PHP/JavaScript-String für den localStorage-Schlüssel. Nach einer Neuberechnung konnte das Lastprofil-Diagramm deshalb nicht mehr initialisiert werden. Der Schlüssel wird jetzt serverseitig korrekt als JSON/JavaScript-String erzeugt. Die Tagesauswahl bleibt bei HTMLBox-Aktualisierungen weiterhin erhalten.

### 1.9.11 – PV-Debug-Sichtbarkeit bleibt auch bei HTMLBox-Aktualisierung erhalten
Die Sichtbarkeit der einzelnen Debug-Prognosequellen wird nicht mehr ausschließlich im JavaScript/localStorage der aktuellen Highcharts-Instanz gehalten. Bei einem Legend-Klick wird der Zustand zusätzlich über `RequestAction` im Modul gespeichert. Beim vollständigen Neuaufbau der PV-HTMLBox wird dieser Zustand wieder als Startwert in Highcharts übernommen. Dadurch bleiben aktivierte/deaktivierte Debug-Profile sowohl beim Blättern als auch nach Prognose-, Istwert- und HTMLBox-Aktualisierungen erhalten.

### 1.9.12 – Lastprofil: keine Ist-Werte aus der Zukunft
Im Verbrauchs-/Lastprofil-Diagramm werden für den heutigen Tag Ist-Balken nur noch für bereits begonnene Stunden erzeugt. Zukünftige Stunden erhalten `null` und werden von Highcharts nicht gezeichnet. Die angezeigte Ist-Tagessumme summiert ebenfalls nur die bis jetzt dargestellten Ist-Stunden. Historische Tage bleiben vollständig.

### 1.9.13 – Vollständige Aktualisierung bei Modulupdate und per Button
Bei einem echten Versionswechsel des Moduls wird nach `ApplyChanges()` automatisch ein einmaliger Vollrefresh gestartet. Dieser lernt Nachtverbrauch und Verbrauchsprofil erneut aus den vorhandenen Archivdaten (ohne Kalibrierwerte zurückzusetzen), ruft die aktuellen Prognose-/Preisquellen ab, berechnet Planung und Statuswerte neu und rendert sämtliche abhängigen HTMLBoxen/Diagramme neu. Ein normales erneutes `Übernehmen` innerhalb derselben Version löst keinen zusätzlichen automatischen Vollrefresh aus.

Im Konfigurationsformular gibt es zusätzlich den Button `ALLES AKTUALISIEREN`. Er startet denselben vollständigen Ablauf jederzeit manuell und läuft über einen Worker-Timer, damit der Button nicht auf externe Provider warten muss. Der Fortschritt und der Abschluss werden in `Letzte manuelle Aktion` angezeigt.

### 1.9.14 – Aktualisieren ohne erneutes Archiv-Lernen
Der automatische Lauf nach einem Modulupdate und der Button `ALLES AKTUALISIEREN` lernen Nachtverbrauch und Verbrauchsprofil nicht mehr neu aus dem Archiv. Die bereits gespeicherten Lernwerte bleiben unverändert. Aktualisiert werden die aktuellen externen Daten/Preise, die daraus abhängige aktuelle Planung sowie alle Werte, HTMLBoxen und Highcharts-Anzeigen. Die separaten Buttons `Nur Nachtverbrauch neu lernen` und `Verbrauchsprofil neu lernen` bleiben die einzigen manuellen Funktionen, die diese Lernwerte gezielt neu aus dem Archiv bestimmen.

### 1.9.15 – PV-Reset setzt auch Prognoseanbieter-Gewichtung zurück
`PV-Kalibrierung / Auto-Faktoren zurücksetzen` löscht jetzt zusätzlich die gelernte Anbietergewichtung und deren Fehlerhistorie. Alle aktuell aktivierten Prognosequellen erhalten unmittelbar eine neutrale Gleichgewichtung (bei drei Quellen je 33,3 %). Die Historie muss ebenfalls gelöscht werden, da die Gewichte sonst bei der nächsten Berechnung sofort wieder aus den alten Prognosefehlern rekonstruiert würden.

Der Reset führt keine externen Forecast-Abfragen mehr aus und wartet daher nicht auf Forecast.Solar, Open-Meteo oder pvnode. Vorhandene Prognosedaten bleiben bis zur nächsten regulären Aktualisierung bestehen; Diagramm und Diagnose werden unmittelbar mit Auto-Faktor 1,000 und neutralen Anbietergewichten neu gerendert. Danach beginnt das automatische Gewichtslernen mit neuen Daten von vorne.

### 1.9.16 – PV-Reset Fehler und Debug-Quellenlinien korrigiert
Der Reset-Aufruf der PV-Kalibrierungsdiagnose übergibt wieder die erforderliche Forecast-Struktur; dadurch tritt der Fehler `Too few arguments ... RenderPVCalibrationDiagnosisHTML()` nicht mehr auf.

Beim Zurücksetzen der Anbietergewichtung wird `PVSourceForecastHistoryJSON` nicht mehr gelöscht, da diese Historie zugleich die Open-Meteo-, Forecast.Solar- und pvnode-Debug-Linien im PV-Highcharts versorgt. Stattdessen wird ein Lern-Reset-Zeitstempel gespeichert. Die vorhandenen Debug-Linien bleiben dadurch sichtbar, während alte Vergleichstage nicht erneut zur Berechnung der Anbietergewichtung herangezogen werden. Direkt nach Reset starten alle aktiven Quellen weiterhin neutral gleichgewichtet.

### 1.9.17 – Reale Netzeinspeisemenge steuert die Batterieeinspeisung
Die Preis-Einspeiseautomatik beendet einen geplanten Verkauf nicht mehr ausschließlich anhand `MaxDischargePowerW × Zeit`. Die im Plan vorgesehene Energie wird als Zielmenge gespeichert und während der Ausführung aus der bereits vorhandenen Variable `PVCalibrationFeedInVariable` gemessen. Bei einer typischen Netzbezug-Variable mit negativer Einspeisung muss `PVCalibrationFeedInInvert` aktiviert sein. Hausverbrauch wird dadurch automatisch berücksichtigt: 20 kW Batterieentladung bei 3 kW Hausverbrauch ergeben nur etwa 17 kW gemessene Netzeinspeisung. Die Automatik läuft weiter, bis die geplante Netzenergie erreicht ist, Mindest-SoC oder Nachtende greifen. Der AlphaESS-Time-Wert dient währenddessen nur als 120-s-Watchdog und wird vom 1-Minuten-Control erneuert.

Außerdem prüft `Control()` geplante Preisslots jetzt vor der zusätzlichen aktuellen Tag/Nacht-Verzweigung. Der Einspeiseplan ist bereits mit denselben Nachtgrenzen erstellt; dadurch kann ein gültiger geplanter Slot am Startzeitpunkt nicht mehr durch eine zweite Tagesprüfung blockiert werden. Neue Variablen zeigen Ziel- und tatsächlich gemessene Einspeisemenge des laufenden Vorgangs.

### 1.9.20 – Forecast.Solar HTTPS-Abruf und Fehlerdiagnose
Forecast.Solar wird bevorzugt über cURL abgerufen. Dadurch werden HTTPS-, DNS-, Timeout- und Verbindungsfehler mit konkretem cURL-Fehlercode und Fehlertext sichtbar. Die Debug-HTML zeigt zusätzlich Abrufmethode, effektive URL, HTTP-Status, Antwortdauer und Response-Header. Falls cURL in der IP-Symcon-PHP-Umgebung nicht verfügbar ist, wird weiterhin der PHP-Stream verwendet; dessen tatsächliche Fehlermeldung aus `error_get_last()` wird nun ebenfalls protokolliert.

### 1.9.21 – Forecast.Solar Rate-Limit-Schutz
Forecast.Solar-Ergebnisse werden pro PV-Fläche mindestens 15 Minuten wiederverwendet; auch manuelle Gesamtaktualisierungen lösen innerhalb dieser Zeit keinen neuen Forecast.Solar-Request aus. Antwortet Forecast.Solar mit HTTP 429, wird `x-ratelimit-retry-at` gespeichert. Bis zu diesem Zeitpunkt werden keine weiteren Forecast.Solar-Anfragen gesendet. Stattdessen nutzt das Modul vorhandene Flächen-Caches. Nach Ablauf der Sperre darf die nächste reguläre Aktualisierung wieder anfragen.

### 1.9.25 – PV-Kalibrierung im 30-Sekunden-Takt
Die PV-Kalibrierung und die Diagnose-HTMLBox werden alle 30 Sekunden aus lokalen IP-Symcon-Werten aktualisiert. Eine erkannte Einspeiseabregelung bleibt verriegelt und wird erst aufgehoben, wenn die Einspeisung fünf Minuten durchgehend unter der konfigurierten Sperrschwelle liegt. Ein einzelner Messwert unterhalb der Schwelle hebt die Sperre nicht auf. Externe Prognoseanbieter werden dadurch nicht häufiger abgefragt.

### 1.9.28 – Mehrheitsbasierte Abregelung
Die PV-Lernsperre wertet ein rollendes 2-Minuten-Fenster aus. Standardmäßig schaltet sie bei mindestens 75 % Messwerten an/über der Sperrschwelle ein und bei mindestens 75 % Messwerten darunter wieder aus. Der Prozentsatz ist konfigurierbar. Bei Aktivierung werden ausschließlich der Sperrzeitraum sowie zwei Minuten vor dem ersten hohen Messwert verworfen; nach Freigabe werden neue Werte sofort wieder zur Kalibrierung verwendet.

### Datenexport
Über **Gespeicherte Modul-Daten als JSON exportieren** werden alle internen Lern-, Kalibrierungs-, Prognose-, Cache-, Preis-, Plan- und Statusattribute sowie die aktuellen Modulvariablen in eine JSON-Datei geschrieben. Die Datei liegt unter `user/SmartBatteryOptimizer/` im IP-Symcon-Kernelverzeichnis. API-Schlüssel werden nicht exportiert. Historische Rohwerte der referenzierten IP-Symcon-Variablen bleiben im normalen IP-Symcon-Archiv und werden nicht dupliziert.


## Einspeiseplanung mit Lastprofil (v1.9.48)

Bei der Preis-Einspeisung wird die theoretische Batterie-/Wechselrichterleistung nicht mehr 1:1 als mögliche Netzeinspeisung angesetzt. Für den jeweiligen Zeitpunkt wird das gelernte stündliche Lastprofil abgezogen. Zusätzlich werden die konfigurierte maximale Entladeleistung und die effektive Netzeinspeisegrenze berücksichtigt.

Während einer aktiven Einspeisung bleibt die tatsächlich am Netzanschluss gemessene exportierte Energie maßgeblich. Alle 5 Minuten wird aus der noch fehlenden Zielenergie und dem Lastprofil eine neue Restlaufzeit berechnet. Die AlphaESS Dispatch Time wird auf diese Restlaufzeit zuzüglich 30 % Sicherheitsreserve gesetzt.


## pvnode Abruflimit (v1.9.54)
Das Feld **pvnode maximale API-Abrufe pro Tag** begrenzt ausschließlich Live-Aufrufe an pvnode (1–144, Standard 1). Das allgemeine PV-Prognoseintervall wird dadurch nicht verändert. Bis zum von pvnode gemeldeten `next_poll_at` sowie nach Erreichen des Tageslimits verwendet das Modul den internen pvnode-Cache.
