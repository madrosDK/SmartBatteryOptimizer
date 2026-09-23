# v1.9.50 / Build 121

- Persistenz der Sichtbarkeit der PV-Debug-Quellen korrigiert.
- Der in IP-Symcon gespeicherte Zustand ist beim Neuaufbau des Highcharts jetzt maßgeblich.
- Veraltete localStorage-Werte dürfen einen bereits serverseitig gespeicherten Zustand (z. B. Open-Meteo sichtbar) nicht mehr überschreiben.
- localStorage dient nur noch als Fallback für Quellen, für die serverseitig noch kein Zustand vorhanden ist.
