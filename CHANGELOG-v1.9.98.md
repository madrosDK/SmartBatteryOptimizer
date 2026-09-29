# SmartBatteryOptimizer v1.9.98 / Build 169

- PV-Kalibrierung auf echte Stundenpaare umgestellt.
- Forecast einer Stunde wird intern beim ersten verfügbaren Wert eingefroren, nicht mehr als Zukunftswert ins Archiv geschrieben.
- Nach Ende der Stunde werden Prognose und Ist gemeinsam mit demselben Stunden-Endzeitstempel archiviert.
- PV Kalibrierung Ist Haus/Nebengebäude wird wieder verwendet und sichtbar geführt.
- Bei Abregelung/Sperrzeit wird für die betroffene Stunde weder Prognose noch Ist als Kalibrierpaar geschrieben.
- Faktorberechnung verwendet ausschließlich Zeitstempel, für die Prognose UND Ist vorhanden sind.
- Neuer Button „PV-Kalibrierung aus vorhandenen Daten nachtragen“: ergänzt fehlende Istwerte aus PV-String-Archiven, sofern ein echter historischer Prognosewert vorhanden ist.
- Fehlende historische Prognosen werden nicht aus aktuellen Forecasts rekonstruiert.
- pvnode String-Index-Zuordnung aus v1.9.97 bleibt erhalten.
