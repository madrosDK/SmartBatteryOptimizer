# SmartBatteryOptimizer v1.9.84 / Build 155

- PV-Kalibrierarchiv korrigiert: gespeichert werden echte stündliche Prognoseenergien in kWh statt momentaner Leistungswerte.
- Prognosewerte werden direkt beim Aufbau der kombinierten Stundenprognose je PV-Fläche archiviert.
- Haus/Nebengebäude werden aus den vorhandenen Flächen- und String-Zuordnungen verwendet; keine doppelte Ist-Datenhaltung.
- Die laufende Prognosestunde wird beim ersten vorhandenen Wert eingefroren; vergangene Stunden werden durch spätere Forecast-Updates nicht verändert.
- Zukünftige Stunden werden bei einem neuen Forecast mit dem aktuellen Prognosestand ersetzt.
- Kalibrierung vergleicht nur Stunden, für die ein archivierter Prognose-kWh-Wert vorhanden ist, mit exakt demselben Ist-Zeitfenster aus den PV-String-Archiven.
- Gesperrte Kalibrierintervalle bleiben ausgeschlossen.
- Fehlerhafte Prognose-Kalibrierdaten aus v1.9.83 werden beim Update einmalig verworfen und anschließend sauber neu aufgebaut.
- Saisonaler rollierender Auto-Faktor bleibt unverändert: bis zum vollständigen Lernzeitraum 1,000, danach innerhalb der konfigurierten Min-/Max-Grenzen.
