# SmartBatteryOptimizer 1.9.77 / Build 148

- PV-Autokalibrierung wird automatisch gesperrt, sobald die konfigurierte Einspeisefaktor-Variable 0 % liefert.
- Die Sperre gilt sowohl fuer die zentrale Preisuntergrenze `Mindestpreis Einspeisung` als auch fuer manuell auf 0 % gesetzte Einspeisefreigaben.
- Beginn und Ende der Kalibriersperre werden protokolliert; beim Wiederfreigeben startet die Energieintegration neu, sodass kein Intervall ueber eine Sperrzeit hinweg gelernt wird.
- Bereits gespeicherte ungueltige PV-Kalibrierintervalle koennen ueber Datum/Von/Bis gezielt geloescht werden. Leeres Datum = heute; Standardzeit 10:00 bis 23:59.
- Nach einer Bereinigung werden Gesamt- und Stundenfaktoren sofort aus den verbleibenden gueltigen Intervallen neu berechnet.
- Wiki und Konfigurationsdokumentation aktualisiert.
