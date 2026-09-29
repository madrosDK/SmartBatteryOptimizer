# SmartBatteryOptimizer v1.9.95 / Build 166

- Einspeise-Statistik: Grün wieder exakt #38a169 wie im Diagramm Einspeisevergütung.
- Schmale gelbe Erlösüberlagerungen bleiben unverändert.
- Neuer Konfigurationsbutton „Alle Prognoseanbieter jetzt abfragen (Force-Refresh)“.
- Force-Refresh umgeht die internen Cache-, Tageslimit- und Retry-Sperren des Moduls für die aktivierten Prognoseanbieter.
- Erfolgreiche Live-Antworten werden als aktuelle Prognosedaten übernommen und die abhängigen Anzeigen/Planung neu berechnet.
- Externe serverseitige Provider-Limits können nicht umgangen werden und werden als Fehler/Debug protokolliert.
