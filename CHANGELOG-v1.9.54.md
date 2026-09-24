# v1.9.54 / Build 125

Basis: v1.9.48.

- Neues Konfigurationsfeld `pvnode maximale API-Abrufe pro Tag` (1–144, Standard 1).
- Das bestehende PV-Prognose-Abfrageintervall bleibt unverändert.
- pvnode wird nur dann live abgefragt, wenn `next_poll_at` erreicht ist und das konfigurierte Tagesmaximum noch nicht ausgeschöpft ist.
- Dazwischen werden die zuletzt erfolgreich empfangenen pvnode-Prognosedaten aus dem internen Cache verwendet.
- Bei Standard 1 Abruf/Tag erfolgt der Live-Abruf damit zum nächsten von pvnode gemeldeten Verfügbarkeitszeitpunkt; alle übrigen SBO-Durchläufe verwenden den Cache.
- Open-Meteo, Forecast.Solar, Timer und sonstige Abruflogik entsprechen wieder v1.9.48.
