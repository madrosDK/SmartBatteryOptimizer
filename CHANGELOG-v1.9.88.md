# SmartBatteryOptimizer v1.9.88 / Build 159

- Neuer Diagnose-Button **pvnode API testen – Rohdaten anzeigen**.
- Führt einen separaten Live-Abruf von `/v2/forecast/{site_id}?forecast_days=1&timezone=utc&include=strings` aus.
- Zeigt HTTP-Status, Response-Header, unveränderten Response-Body und eine kurze Strukturauswertung an.
- `values`, `strings`, `available`, `included`, `string_index` und `string_id` können damit direkt geprüft werden.
- Der API-Key wird in der Ausgabe nicht angezeigt.
- Der Test verändert weder pvnode-Prognosecache noch Abrufzähler, Tageslimit oder laufende Prognosedaten.
