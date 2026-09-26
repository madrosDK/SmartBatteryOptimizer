# SmartBatteryOptimizer v1.9.72 / Build 143

- Einspeise-Statistik erfasst ausschließlich Preis-Einspeisefenster der Einspeiseautomatik.
- PV-Speicherfreihaltung / PV-Abregelungsschutz wird aus Statistik, Summen und Diagramm ausgeschlossen.
- Einspeise-Statistik enthält jetzt immer ein echtes Highcharts-Balkendiagramm, auch solange noch keine abgeschlossenen Einspeisefenster vorhanden sind.
- Balken zeigen die tatsächlich gemessene Netzeinspeisung je Einspeisefenster; Tooltip zeigt Zeitraum, kWh, Erlös und Tarif.
- Bestehende Statistikdaten werden bei der Anzeige nach dem Grund `price` gefiltert, damit frühere PV-Speicherfreihaltungs-Datensätze nicht einfließen.
- Wiki auf den aktuellen Stand der Einspeise-Statistik nachgeführt.
