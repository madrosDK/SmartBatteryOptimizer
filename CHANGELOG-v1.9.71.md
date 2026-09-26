# SmartBatteryOptimizer v1.9.71 / Build 142

- Navigation in PV-Prognose und Lastprofil: `Heute` steht jetzt rechts neben dem rechten Pfeil; Datumsanzeige bleibt unverändert.
- Anbieterübersicht trägt einheitlich den Titel `PV-Prognose Anbieter`.
- pvnode wird in der Anbieterübersicht als Standort-Gesamtprognose gekennzeichnet, solange die pvnode-Site-API keine getrennten SBO-PV-Flächen liefert.
- Neue Einspeise-Statistik: tatsächlich gemessene Netzeinspeisung je abgeschlossenem geplantem Einspeisefenster, Erlös, Tarif sowie Summen für Heute/Monat/Jahr/Gesamt.
- Highcharts-Balkendiagramm für die Einspeisemengen der letzten 30 Tage; Tooltip zeigt kWh, Erlös und Tarif.
- Statistik verwendet die vorhandene Netzbezug/Netzeinspeisungsvariable und speichert abgeschlossene Einspeisefenster kompakt.
