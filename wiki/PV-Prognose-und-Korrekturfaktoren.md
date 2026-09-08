# PV-Prognose und Korrekturfaktoren

## Was wird überhaupt prognostiziert?

Für jede eingetragene PV-Fläche berechnet SmartBatteryOptimizer aus Standort, installierter Leistung, Azimut und Neigung eine stündliche erwartete PV-Leistung. Die Flächen werden anschließend zur Prognose der Gesamtanlage addiert.

Die Rohprognose ist eine theoretische Erwartung. Eine reale Anlage erreicht diese Leistung nicht immer, z. B. durch Wechselrichterverluste, Kabelverluste, Temperatur, Verschattung, Verschmutzung, Modulalterung oder weil die tatsächliche Anlagenleistung von der eingetragenen Nennleistung abweicht.

Deshalb gibt es mehrere Faktoren.

## Systemwirkungsgrad

Der **Systemwirkungsgrad** bildet allgemeine technische Verluste der PV-Anlage ab.

Beispiel:

- theoretische Prognose: 10,0 kW
- Systemwirkungsgrad: 0,90
- danach verwendete Leistung: 9,0 kW

`0,90` bedeutet also: Von der theoretisch möglichen PV-Leistung werden 90 % als real nutzbare AC-Leistung angesetzt.

Der Systemwirkungsgrad gilt für die **gesamte Anlage**.

## Globaler PV-Korrekturfaktor

Der **globale PV-Korrekturfaktor** korrigiert die bereits berechnete PV-Prognose der **gesamten Anlage** zusätzlich nach oben oder unten.

Er korrigiert **nicht** den Börsenpreis, den Batteriestand oder den Verbrauch. Er verändert ausschließlich die erwartete PV-Erzeugung.

Beispiel:

- berechnete PV-Prognose nach Systemwirkungsgrad: 30,0 kWh für morgen
- globaler PV-Korrekturfaktor: 0,95
- für die Optimierung verwendete Prognose: 28,5 kWh

Bedeutung:

| Faktor | Wirkung |
|---:|---|
| 1,00 | keine zusätzliche Korrektur |
| 0,95 | PV-Prognose wird um 5 % reduziert |
| 0,90 | PV-Prognose wird um 10 % reduziert |
| 1,05 | PV-Prognose wird um 5 % erhöht |
| 1,10 | PV-Prognose wird um 10 % erhöht |

**Startempfehlung: 1,00.** Erst ändern, wenn die gesamte Prognose dauerhaft zu hoch oder zu niedrig ist.

## Faktor einer einzelnen PV-Fläche

Jede PV-Fläche besitzt zusätzlich einen eigenen **Faktor**. Dieser korrigiert nur diese eine Dachfläche.

Beispiel:

- Süd: 10 kWp, Faktor 1,00
- Ost: 5 kWp, Faktor 0,90
- West: 5 kWp, Faktor 0,80

Damit kann z. B. eine teilweise verschattete Westfläche dauerhaft niedriger bewertet werden, ohne die Südfläche zu verändern.

## Auto-Faktor

Ist **Auto** für eine PV-Fläche aktiviert und sind PV-String-/MPPT-Variablen zugeordnet, kann das Modul die erwartete Leistung mit der tatsächlich gemessenen Leistung dieser Fläche vergleichen.

Beispiel:

- erwartete Leistung der Fläche: 5.000 W
- tatsächliche Summe der Strings: 4.500 W
- Verhältnis: 4.500 / 5.000 = 0,90

Aus vielen solchen gültigen Messungen wird ein stabiler Auto-Faktor gelernt. Ein einzelner bewölkter Messpunkt soll den Faktor nicht bestimmen.

## Zusammenspiel der Faktoren

Vereinfacht wird die Prognose in mehreren Schritten korrigiert:

`theoretische Flächenprognose × Systemwirkungsgrad × Flächenfaktor × Auto-Faktor × globaler PV-Korrekturfaktor`

Beispiel:

- theoretische Leistung: 6.000 W
- Systemwirkungsgrad: 0,90
- Flächenfaktor: 0,95
- Auto-Faktor: 0,92
- globaler Faktor: 1,00

Ergebnis: ca. 4.720 W erwartete reale Leistung.

### Was soll ich am Anfang einstellen?

Wenn die Anlage noch nicht kalibriert ist:

- Systemwirkungsgrad: den im Modul vorgegebenen Standard verwenden
- Globaler PV-Korrekturfaktor: **1,00**
- Faktor je PV-Fläche: **1,00**
- Auto: aktivieren, wenn passende String-/MPPT-Leistungsvariablen vorhanden sind

So vermeidest du, dieselbe Abweichung gleichzeitig über mehrere Faktoren manuell zu korrigieren.
