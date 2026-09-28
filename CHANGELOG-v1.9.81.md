# SmartBatteryOptimizer 1.9.81 / Build 152

## Verbindliche Einspeiseplanung

- Ein einmal geplanter zukünftiger Einspeiseslot bleibt bis zur Ausführung verbindlich.
- Normale Prognose- und Plan-Neuberechnungen dürfen bereits veröffentlichte offene Einspeisefenster nicht mehr entfernen oder zeitlich verschieben.
- Für jeden geplanten Slot wird der erwartete Batterie-SoC am Startzeitpunkt gespeichert.

## SoC-Prüfung beim Start

- Liegt der reale SoC beim Start höchstens 5 Prozentpunkte unter dem erwarteten SoC, wird die geplante Einspeisemenge unverändert ausgeführt.
- Liegt der reale SoC mehr als 5 Prozentpunkte darunter, wird die geplante Einspeisemenge um die zur SoC-Abweichung passende Batterieenergie reduziert.
- Beispiel: erwartet 80 %, tatsächlich 70 % -> Einspeisung findet weiterhin statt, die Zielenergie wird aber reduziert.
- Ein höherer SoC als erwartet erhöht die ursprünglich geplante Einspeisemenge nicht.
- Mindest-SoC, Mindestpreis-Einspeisesperre und technische Schutzbedingungen bleiben vorrangig.

## Diagnose

- Der Start protokolliert erwarteten und tatsächlichen SoC.
- Eine Mengenanpassung wird mit ursprünglicher und neuer Zielenergie im Debug protokolliert.
