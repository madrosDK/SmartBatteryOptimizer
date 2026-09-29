# SmartBatteryOptimizer v1.9.89 / Build 160

- pvnode-Flächenzuordnung auf stabile `string_id` umgestellt.
- Neues Feld `pvnode string_id` je PV-Fläche.
- Korrekte 15-Minuten-Energieintegration aus `strings[].pv_power`.
- Gesamtprognose wird bei fehlendem `values[].pv_power` aus den Strings gebildet.
- `daily[].pv_energy_kwh` wird als Plausibilitätscheck protokolliert.
- Positionsfallback bleibt für bestehende Konfigurationen erhalten.
