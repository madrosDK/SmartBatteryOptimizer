# v1.9.55 / Build 126

- pvnode-Liveabruf blockiert den Prognoselauf nicht mehr: eigener kurzer HTTP-Timeout (8 s, Connect max. 4 s).
- Vor `next_poll_at` oder bei erreichtem Tageslimit wird ohne HTTP-Aufruf sofort der pvnode-Cache verwendet.
- Bei Timeout/Verbindungsfehler wird sofort auf vorhandenen pvnode-Cache zurückgefallen.
- Open-Meteo, Forecast.Solar und das normale PV-Prognoseintervall bleiben unverändert.
