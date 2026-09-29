# SmartBatteryOptimizer v1.9.97 / Build 168

- pvnode Flächenzuordnung verwendet jetzt direkt `string_index` aus `strings[]`.
- Bestehende Konfigurationswerte 0/1 bleiben erhalten; interner Property-Name wird aus Kompatibilitätsgründen nicht geändert.
- Konfigurationsspalte heißt jetzt „pvnode String-Index“.
- Index 0 und Index 1 werden aus dem getrennten pvnode-Stringcache ausgewertet und den konfigurierten PV-Flächen zugeordnet.
- `string_id` wird weiterhin intern gespeichert und im Debug zur Kontrolle zusammen mit dem Index ausgegeben.
- Keine Änderungen an Open-Meteo, Forecast.Solar, Einspeisestatistik oder sonstigen Diagrammen.
