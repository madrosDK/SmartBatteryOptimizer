# SmartBatteryOptimizer 1.9.74 / Build 145

- Einspeise-Statistik: Highcharts-Initialisierung auf den robusten Aufbau der bestehenden PV-/Lastprofil-Diagramme umgestellt.
- Chart-Container wird direkt an `Highcharts.chart()` übergeben und bei noch nicht vollständig aufgebauter HTMLBox kurz verzögert erneut initialisiert.
- Datenpunkte enthalten Tooltip-Daten direkt als `custom`-Werte.
- Bei einem JavaScript-/Highcharts-Laufzeitfehler wird die konkrete Fehlermeldung im Diagrammbereich angezeigt, statt eine leere Fläche zu hinterlassen.
- Statistik bleibt ausschließlich auf Preis-Einspeisefenster der Einspeiseautomatik beschränkt; PV-Abregelungsschutz bleibt ausgeschlossen.
