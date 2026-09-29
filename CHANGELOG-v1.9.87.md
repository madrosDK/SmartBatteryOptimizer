# SmartBatteryOptimizer v1.9.87 / Build 158

- Einspeiseautomatik bleibt energiegeführt: Abschluss nach tatsächlich gemessener Zielenergie in kWh; höhere reale Netzleistung verkürzt die Restzeit.
- Manueller Stop finalisiert einen laufenden Preis-Einspeisevorgang jetzt vor dem Zurücksetzen, damit kWh und Erlös erhalten bleiben.
- Eigenes einklappbares, scrollbar begrenztes Einspeise-Debugfenster mit Ereignissen der letzten 24 Stunden.
- Debug protokolliert Start, Zielmenge, Tarif, SoC, laufende Ist-/Restmenge, aktuelle Leistung, Restzeit, angepasstes Ende sowie Abschlussgrund, Dauer und Erlös.
- Fortlaufende Messung der gesamten realen Netzeinspeisung mit dem jeweils aktuellen Einspeisetarif.
- Einspeise-Statistik zeigt getrennt Automatik-Einspeisung und sonstige Netzeinspeisung samt getrenntem Erlös; Gesamtwerte werden im Tooltip und in der Monatssumme ausgewiesen.
- Bestehende PV-Prognose, saisonale Kalibrierung und Providerlogik bleiben unverändert.
