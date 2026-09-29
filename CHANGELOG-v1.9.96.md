# SmartBatteryOptimizer v1.9.96 / Build 167

- Force-Refresh: pvnode verwendet jetzt tatsächlich den direkten Live-Abruf und umgeht den internen pvnode Cache, das Tageslimit und next_poll.
- pvnode Live-Antwort speichert stringHoursByID/stringIDsByIndex und wird danach den konfigurierten PV-Flächen über PVNodeStringID zugeordnet.
- PV-Kalibrierarchiv: keine zukünftigen Zeitstempel mehr an AC_AddLoggedValues.
- Laufende Prognosestunde wird nur einmal eingefroren; Zukunftsprognosen bleiben in der Prognosehistorie und werden erst bei Erreichen der Stunde archiviert.
- Zusätzlicher zentraler Schutz verwirft versehentliche zukünftige Archivwerte.
- Einspeise-Statistik bleibt unverändert mit Grün #38a169 und schmaler gelber Erlösüberlagerung.
