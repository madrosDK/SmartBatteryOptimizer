# SmartBatteryOptimizer v1.9.85 / Build 156

- pvnode-V2-Abfrage fordert jetzt die optionale Gruppe `strings` an.
- pvnode-Solarflächen werden aus `string_index`/`pv_power` getrennt zu Stundenwerten verarbeitet.
- Bei eindeutiger 1:1-Anzahl werden die pvnode-Flächen positionsstabil den aktiven SBO-PV-Flächen zugeordnet.
- Haus und Nebengebäude fließen damit getrennt in Anbieterübersicht, Provider-Mix und PV-Kalibrierprognose ein.
- Der pvnode-Cache enthält jetzt neben dem Standortgesamtwert auch die getrennten Flächenzeitreihen.
- Keine künstliche kWp-Aufteilung bei fehlenden oder nicht eindeutig zuordenbaren pvnode-Stringdaten.
