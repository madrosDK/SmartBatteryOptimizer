# SmartBatteryOptimizer 1.9.79 – Archivbasierter Datenspeicher

- PV-Kalibrierungs-Zeitreihen werden pro PV-Fläche in eigenen, archivierten IP-Symcon-Variablen gespeichert (Prognoseleistung und Istleistung).
- Einspeise-Statistik der Preisautomatik wird ebenfalls in archivierten Modulvariablen geführt.
- Bestehende Daten aus `PVCalibrationJSON` und `FeedInStatisticsJSON` werden beim ersten Start einmalig automatisch in das IP-Symcon Archiv übernommen.
- Bereits saisonal verdichtete PV-Lerndaten werden so migriert, dass Energieverhältnis, Stunden-/Saisonfaktoren und vorhandene Lerntage erhalten bleiben.
- Die bisherigen JSON-Daten bleiben nach der Migration als Sicherheitskopie/Kompatibilitätscache erhalten, sind aber nicht mehr die primäre Zeitreihenquelle.
- `PV-Kalibrierdaten löschen ...` bereinigt nun zusätzlich die archivierten Prognose-/Ist-Zeitreihen und reaggregiert sie.
- `PV-Kalibrierung zurücksetzen` löscht auch die archivierten PV-Lernzeitreihen; die Einspeise-Statistik bleibt erhalten.
- Neue Statusvariable `Archiv-Datenspeicher` zeigt, ob Archive Control aktiv ist und wie viele bestehende Datensätze bei der Migration übernommen wurden.
