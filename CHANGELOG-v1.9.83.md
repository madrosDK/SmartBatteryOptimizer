# SmartBatteryOptimizer v1.9.83 / Build 154

- PV-Kalibrierung auf stündliche Energiepaare umgestellt.
- Prognose je PV-Fläche wird für die begonnene Stunde als kWh festgeschrieben und später nicht rückwirkend ersetzt.
- Ist-Energie wird nicht mehr in separaten Kalibrier-Istvariablen dupliziert, sondern direkt aus den in der PV-Fläche zugewiesenen PV-String-Variablen im IP-Symcon-Archiv berechnet.
- Das Modul aktiviert die Archivierung der zugewiesenen PV-String-Variablen automatisch, falls nötig.
- Gesperrte Kalibrierzeiträume werden stundenweise ausgeschlossen; übrige Stunden eines Tages bleiben nutzbar.
- Keine Stundenfaktoren mehr: die Prognose verwendet ausschließlich den rollierenden saisonalen PV-Auto-Faktor.
- Bis zum Erreichen des konfigurierten Lernzeitraums bleibt der Auto-Faktor 1,000; danach rollierende Neuberechnung, begrenzt durch die konfigurierten Min-/Max-Werte.
- Hinweistext zur Kalibrierdaten-Bereinigung angepasst.
