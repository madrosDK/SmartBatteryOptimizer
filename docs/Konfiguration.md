# SmartBatteryOptimizer – Konfiguration

Diese Seite beschreibt alle Einstellungen des SmartBatteryOptimizer. Stand: **Version 1.1.2**.

## Standort & PV-Prognose

**Breitengrad / Längengrad:** Geografische Position der PV-Anlage in Dezimalgrad. Sie wird für die Einstrahlungsprognose verwendet.

**Globaler PV-Korrekturfaktor:** Korrektur für die gesamte Anlage. `1,00` = unverändert, `0,95` = -5 %, `1,05` = +5 %. Empfehlung zum Start: `1,00`.

**Systemwirkungsgrad:** Berücksichtigt Wechselrichter-, Kabel-, Temperatur- und weitere Systemverluste. `0,86` entspricht 86 %. Empfehlung: etwa `0,85–0,90`.

**Lernzeitraum PV-Flächenfaktor:** Zeitraum, aus dem Messwerte für den automatisch gelernten Flächenfaktor verwendet werden. Empfehlung: 14 Tage.

**Lernphase bei unbekannter Ausrichtung:** Ist bei einer aktiven Fläche `Ausrichtung bekannt` deaktiviert, bleibt die Batterie-Automatik gesperrt, bis ausreichend viele gültige Lerntage vorhanden sind. Standard: 30 Tage. Es zählen gültige Messtage, nicht nur Kalendertage.

**Kalibrierung erst ab erwarteter Leistung:** Unterhalb dieser erwarteten Flächenleistung wird kein Lernwert erzeugt. Das verhindert instabile Faktoren bei Dämmerung und sehr geringer Einstrahlung. Empfehlung: 300 W.

**Minimaler / maximaler Auto-Faktor:** Sicherheitsgrenzen für den automatisch gelernten Faktor. Empfehlung: 0,50 bis 1,50.

## PV-Flächen

Eine Zeile entspricht einer Modulgruppe mit gleicher oder ähnlicher Ausrichtung und Neigung. Ost-, Süd- und Westflächen getrennt anlegen.

**Aktiv:** Fläche in Prognose und Kalibrierung verwenden.

**Name:** Frei wählbare Bezeichnung, z. B. `Süd`, `Ost Garage`, `West Halle`. Nach Beginn des Lernens möglichst nicht mehr ändern.

**Leistung:** Installierte Modulleistung dieser Fläche in kWp. Beispiel: 20 × 500 W = 10,00 kWp. Nicht die Wechselrichterleistung eintragen.

**Ausrichtung bekannt:** Aktivieren, wenn Azimut und Neigung bekannt sind. Bei unbekannter Ausrichtung deaktivieren und mindestens eine String-/MPPT-Leistungsvariable zuordnen. Die automatische Einspeisung bleibt dann während der Lernphase gesperrt.

**Azimut:** Kompassrichtung: Nord = 0°/360°, Ost = 90°, Süd = 180°, West = 270°.

**Neigung:** Winkel gegenüber der Horizontalen: 0° = waagrecht, 30° = typische Dachneigung, 90° = senkrecht.

**Faktor:** Manueller Korrekturfaktor dieser Fläche. `1,00` = keine Korrektur. Der effektive Flächenfaktor setzt sich aus manuellem Faktor und gelerntem Auto-Faktor zusammen; zusätzlich wirkt der globale PV-Faktor.

**Auto:** Aktiviert die automatische Flächenkalibrierung. Dafür mindestens eine PV-Stringvariable zuordnen.

**PV String 1 / 2 / 3:** Bis zu drei normale IP-Symcon-Variablen mit der aktuellen Leistung in **Watt** der zu dieser Fläche gehörenden Strings oder MPPTs. Das Modul addiert die Werte. Energiezähler in Wh oder kWh sind hier nicht geeignet.

## Batterie

**SoC Variable (%):** Variable mit dem aktuellen Batterieladezustand von 0 bis 100 %.

**Speicherkapazität:** Für die Optimierung nutzbare Speicherkapazität in kWh.

**Mindest-SoC:** Unter diesen Ladezustand darf die geplante Börseneinspeisung die Batterie nicht entladen.

**Max. Einspeise-/Entladeleistung:** Maximale vom Optimierer angeforderte Batterieentladung in Watt.

**Variable Einspeisung EIN/AUS:** Boolesche bzw. schaltbare IP-Symcon-Variable zur Freigabe der Batterieeinspeisung.

**Sollleistung Entladung (optional):** Variable für die gewünschte Entladeleistung in Watt. Leer lassen, wenn dein System nur eine EIN/AUS-Freigabe benötigt.

**Sollleistung negativ schreiben:** Aktivieren, wenn dein Batteriesystem Entladung als negativen Wert erwartet. 5.000 W werden dann als `-5000` geschrieben.

## Eigenverbrauch lernen

**Hausverbrauch Leistung (W):** Normale IP-Symcon-Variable mit dem tatsächlichen Hausverbrauch in Watt. Diese Variable muss archiviert werden. Es gibt keine separate Archivvariable: Das Modul findet das Archiv selbst und liest die Historie der ausgewählten Variablen-ID.

**PV-Istleistung (W) (optional):** Gesamt-PV-Leistung in Watt. Damit wird rückwirkend erkannt, wann morgens wieder ausreichend PV-Leistung vorhanden war.

**Lernzeitraum:** Anzahl vergangener Tage für die Nachtverbrauchsauswertung. Empfehlung: 30 Tage.

**Mindestens gültige Nächte zum Lernen:** Mindestzahl verwertbarer Nächte für einen neuen Lernwert. Bei zu wenigen Daten wird ein vorhandener alter Lernwert oder der Ersatzwert verwendet.

**Ersatzwert Nachtverbrauch:** Fallback in kWh, falls Archivdaten fehlen oder noch nicht ausreichen.

**Nacht-Auswertung beginnt:** Uhrzeit, ab der der Nachtverbrauch gezählt wird, z. B. 18 Uhr.

**Morgenende ohne PV-Istvariable:** Fallback-Uhrzeit für das Ende der Nachtperiode, wenn keine brauchbare PV-Istleistung vorhanden ist. Empfehlung zum Start: 8 Uhr.

**PV-Schwelle für Morgenende:** Bei vorhandener PV-Istvariable endet die Nachtperiode, sobald morgens diese PV-Leistung erreicht wird, z. B. 300 W.

**Sicherheitsaufschlag Nachtverbrauch:** Zusätzliche Reserve auf den gelernten Nachtverbrauch. Beispiel: 4,0 kWh + 10 % = 4,4 kWh.

**Ausreißergrenze um Median:** Filtert ungewöhnliche Nächte. Ein höherer Prozentwert lässt größere Abweichungen zu. Standard 70 % ist bewusst tolerant.

## Börsenpreis & Optimierung

**Preisquelle:** `aWATTar Österreich / EPEX Spot` ruft die Marktpreise automatisch ab. Alternativ kann eine eigene JSON-Stringvariable verwendet werden.

**JSON-Preisvariable:** Nur bei eigener Preisquelle erforderlich. Beispiel:

```json
[
  {"start": 1788886800, "end": 1788890400, "priceCt": 12.5},
  {"start": "2026-09-08 19:00:00", "end": "2026-09-08 20:00:00", "priceCt": 18.2}
]
```

`priceCt` wird in ct/kWh erwartet.

**Faktor bei positivem Marktpreis:** Multiplikator für positive Börsenpreise.

**Faktor bei negativem Marktpreis:** Separater Multiplikator für negative Börsenpreise.

**Fixe Tarifanpassung:** Fester Auf-/Abschlag in ct/kWh. Formel: `effektiver Preis = Marktpreis × Faktor + Tarifanpassung`.

**Mindest-Einspeisepreis:** Zeitfenster unter diesem effektiven Preis werden nicht zur Batterieeinspeisung verwendet.

**Min. PV-Prognose morgen für normale Freigabe:** Unterhalb dieses Tagesertrags wird die Nachtreserve erhöht.

**Zusatzreserve bei schlechter PV-Prognose:** Prozentualer Zuschlag auf die Nachtreserve bei schwacher Prognose.

**Bei sehr schlechter PV-Prognose Einspeisung sperren:** Verhindert bei sehr schwacher Prognose jede geplante Börseneinspeisung.

**Sehr schlechte PV-Prognose unter:** kWh-Grenze für diese vollständige Sperre.

## Automatik

**Automatische Einspeisung aktiv:** Master-Schalter für die tatsächliche Batteriesteuerung. Prognose und Plan können auch bei ausgeschalteter Automatik berechnet werden. Bei unbekannter PV-Ausrichtung bleibt die Steuerung zusätzlich bis zum Abschluss der Lernphase gesperrt.

**Daten/Plan aktualisieren alle:** Intervall für automatischen Prognose-/Preisabruf und Planneuberechnung. Empfehlung: 30 Minuten.

## Schaltflächen

**Jetzt Prognose & Plan berechnen:** Lernt Nachtverbrauch, ruft PV-Prognose und Preise ab und berechnet den Plan neu.

**Nur Nachtverbrauch neu lernen:** Führt nur die Archivauswertung des Nachtverbrauchs aus.

**Einspeisung sofort stoppen:** Setzt den Entlade-Sollwert auf 0 und deaktiviert die Einspeisefreigabe.

## Ausgabevariablen

Das Modul legt u. a. `PV Prognose morgen`, `PV Kalibrierung`, `Automatikfreigabe`, `Prognose Nachtverbrauch`, `Quelle Nachtverbrauch`, `Gültige Nächte`, `Für Einspeisung verfügbar`, `Aktueller Einspeisepreis`, `Höchster geplanter Einspeisepreis`, `Einspeisung aktiv`, `Geplante Einspeiseleistung`, `Nächstes Einspeisefenster`, `Erwarteter Erlös`, `Optimierungsstatus` und den HTML-`Einspeiseplan` an.

## Empfohlene Inbetriebnahme

1. Automatische Einspeisung zunächst deaktiviert lassen.
2. Standort eintragen.
3. PV-Flächen und kWp korrekt aufteilen.
4. Azimut/Neigung eintragen oder bei unbekannter Ausrichtung Stringvariablen zuweisen.
5. SoC, Kapazität und Mindest-SoC konfigurieren.
6. Hausverbrauchsvariable auswählen und Archivierung prüfen.
7. Einspeisefreigabe und optional Sollleistung auswählen.
8. `Jetzt Prognose & Plan berechnen` ausführen und Ergebnisse auf Plausibilität prüfen.
9. Erst danach die automatische Einspeisung aktivieren.
