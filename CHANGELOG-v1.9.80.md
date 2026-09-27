# SmartBatteryOptimizer 1.9.80 / Build 151

## Open-Meteo Stundenlage korrigiert

- `global_tilted_irradiance` von Open-Meteo ist ein Mittelwert der **vorhergehenden Stunde**. Der API-Zeitstempel kennzeichnet damit das Intervallende.
- Open-Meteo wird nun bereits beim Einlesen zentral auf den **Beginn des Stundenintervalls** normalisiert (`API-Zeitstempel - 1 Stunde`).
- Die korrigierte Zeitbasis gilt dadurch gleichzeitig für Provider-Debuglinie, Quellengewichtung, kombinierte PV-Prognose und PV-Kalibrierung.
- Vorhandene Kalibrierdaten werden beim Update übernommen. Bei Installationen mit dem Archivspeicher aus 1.9.79 wird die Prognose-Zeitreihe einmalig aus der JSON-Sicherheitskopie mit korrigierter Stundenlage neu aufgebaut; die gemessene Ist-Zeitreihe bleibt zeitlich unverändert.
- Gespeicherte Open-Meteo-Quellenhistorie wird ebenfalls einmalig um eine Stunde auf den Intervallbeginn verschoben. Die Provider-Gewichtung startet anschließend neu, damit keine Vergleiche aus der alten Zeitbasis weiterwirken.

## Schrift auf iPhone/iPad

- HTMLBoxen und Highcharts verwenden jetzt durchgängig den Font-Stack `Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif`.
- Windows verwendet weiterhin bevorzugt Tahoma. Auf iPhone/iPad fällt die Darstellung automatisch auf eine native Apple-Systemschrift zurück, wenn Tahoma nicht installiert ist.
