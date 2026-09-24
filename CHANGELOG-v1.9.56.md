# SmartBatteryOptimizer 1.9.56 – Diagnoseversion

Basis ist die unveränderte Abruf- und Berechnungslogik von v1.9.48.

- Diagnosemarken vor und nach den wesentlichen Berechnungsschritten.
- Diagnosemarken unmittelbar vor und nach jedem Open-Meteo-, Forecast.Solar- und pvnode-Abruf.
- Der jeweils letzte Diagnoseschritt wird zusätzlich im Modulstatus angezeigt.
- Provider-Debug zeigt die Diagnosemarken als `DIAG`-Einträge, sofern Debug aktiviert ist.
- HTTP-Diagnose-Timeouts sind begrenzt, damit ein nicht antwortender Provider den Lauf nicht unbegrenzt blockiert.
- Keine pvnode-Limit-, Cache- oder Zeitplanlogik aus den Versionen nach v1.9.48 übernommen.
