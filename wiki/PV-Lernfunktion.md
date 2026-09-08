# PV-Lernfunktion

## Zweck

Die Lernfunktion soll die theoretische PV-Prognose an die reale Anlage anpassen. Dazu vergleicht SmartBatteryOptimizer für jede PV-Fläche die erwartete Leistung mit der tatsächlich gemessenen String-/MPPT-Leistung.

## PV String 1 bis PV String 3

Hier werden normale IP-Symcon-Variablen ausgewählt, deren aktueller Wert die Leistung des betreffenden Strings oder MPPTs in **Watt** enthält.

Bis zu drei Variablen können einer Fläche zugeordnet werden. Das Modul addiert sie.

Beispiel:

- PV String 1 = 1.800 W
- PV String 2 = 1.750 W
- PV String 3 = 1.900 W
- tatsächliche Leistung der Fläche = 5.450 W

Nur Variablen eintragen, die wirklich zu der betreffenden PV-Fläche gehören. Nicht dieselbe Stringvariable mehreren Flächen zuordnen.

## Auto

Aktiviert die automatische Kalibrierung dieser PV-Fläche. Ohne Auto bleiben die Messvariablen ohne Einfluss auf den gelernten Flächenfaktor.

## Lernzeitraum PV-Flächenfaktor

Bestimmt, wie weit zurück gültige Vergleichsdaten für die Berechnung des Auto-Faktors berücksichtigt werden.

Ein längerer Zeitraum reagiert ruhiger, aber langsamer auf Veränderungen. Ein kürzerer Zeitraum reagiert schneller, kann aber stärker schwanken.

## Kalibrierung erst ab erwarteter Leistung

Unterhalb dieser erwarteten Leistung wird kein Lernwert erzeugt.

Grund: Bei sehr geringer Leistung führen schon kleine Messfehler zu extremen Verhältnissen. Beispiel: 20 W Abweichung bei erwarteten 50 W wären bereits 40 %.

Ein Wert von z. B. 300 W bedeutet: Nur wenn die Fläche laut Prognose mindestens 300 W liefern sollte, darf dieser Zeitpunkt zur Kalibrierung beitragen.

## Minimaler und maximaler Auto-Faktor

Diese Grenzen verhindern, dass fehlerhafte Messungen oder unpassende Prognosen einen unrealistischen Korrekturfaktor erzeugen.

Beispiel mit 0,50 bis 1,50:

- kleiner als 0,50 wird nicht zugelassen
- größer als 1,50 wird nicht zugelassen

Diese Grenzen sind Schutzgrenzen und keine Zielwerte.

## Ausrichtung bekannt

Ist Azimut und Neigung bekannt, aktivieren. Das Modul kann dann aus der Wetter-/Strahlungsprognose eine geometrisch passende Prognose für diese Fläche erstellen.

Ist die Ausrichtung unbekannt, deaktivieren. Dann sind String-/MPPT-Messwerte besonders wichtig.

## Lernphase bei unbekannter Ausrichtung

Bei unbekannter Ausrichtung wird die automatische Batterieeinspeisung erst nach der eingestellten Anzahl **gültiger Lerntage** freigegeben. Standardmäßig sind 30 Tage vorgesehen.

Ein gültiger Lerntag muss verwertbare PV-Messdaten liefern. 30 Kalendertage ohne brauchbare Messwerte reichen daher nicht automatisch aus.

Während der Lernphase dürfen Prognose, Börsenpreisabruf und Planberechnung bereits laufen. Nur die automatische Einspeisung bleibt gesperrt.
