# v1.9.48 / Build 119

- Preisoptimierte Einspeiseplanung berücksichtigt nun das gelernte Lastprofil. Die erwartbare Netzeinspeisung wird aus Batterieleistung minus erwarteter Last berechnet und zusätzlich auf die konfigurierte Netzeinspeisegrenze begrenzt.
- Control-Timer auf 15 Sekunden verkürzt, damit geplante Startzeiten zuverlässiger getroffen werden.
- Während aktiver Einspeisung wird alle 5 Minuten aus Zielenergie minus tatsächlich gemessener Netzeinspeiseenergie die notwendige Restlaufzeit neu berechnet und das aktive Einspeisefenster angepasst.
- AlphaESS Dispatch Time wird nicht mehr als 120-s-Watchdog behandelt, sondern aus der berechneten Restlaufzeit plus 30 % Reserve gesetzt.
- AlphaESS-Schreibreihenfolge: Start -> Active Power -> Mode 2 -> SOC -> Dispatch Time, jeweils mit den bewährten Pausen.
- Der Diagnose-Test setzt ebenfalls Dispatch Time nach SOC.

Prüfung: PHP-Lint, JSON-Prüfung, Versions-/Build-Abgleich und ZIP-Struktur geprüft.
