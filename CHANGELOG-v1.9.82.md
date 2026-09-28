# SmartBatteryOptimizer 1.9.82 / Build 153

## PV-Auto-Kalibrierung

- Stundenfaktoren werden nicht mehr für die PV-Prognose verwendet.
- Die Korrektur erfolgt wieder mit einem generellen Faktor je PV-Fläche; die Anzeige ordnet ihn der aktuellen Jahreszeit zu.
- Bis der konfigurierte Lernzeitraum erstmals vollständig mit gültigen Lerntagen erreicht ist, bleibt der Faktor exakt 1,000.
- Danach wird der Faktor rollierend aus den neuesten N gültigen Lerntagen berechnet: neuer Tag hinein, ältester Tag heraus.
- Rohfaktor = Summe Ist-Energie / Summe Prognose-vor-Auto über exakt dieses Fenster.
- Erst der fertige Rohfaktor wird auf die konfigurierten Min-/Max-Werte begrenzt (z. B. 0,75 bis 1,25).
- Änderungen am Lernzeitraum werden aus dem IP-Symcon-Archiv neu berechnet; vorhandene Archivdaten bleiben erhalten.
- Kalibriersperren/Abregelungszeiten bleiben ausgeschlossen.
- Die Diagnose zeigt keine Aktuell-/Nächste-Stundenfaktoren mehr.
