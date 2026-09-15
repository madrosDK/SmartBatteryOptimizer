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
