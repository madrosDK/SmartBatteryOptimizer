# SmartBatteryOptimizer 1.9.76 / Build 147

- `Mindestpreis notwendige Speicherfreihaltung` in `Mindestpreis Einspeisung` umbenannt und als zentrale Preisuntergrenze für jede Netzeinspeisung verwendet.
- Preis-Einspeiseautomatik plant keine Intervalle unterhalb des Mindestpreises mehr.
- PV-Abregelungsschutz/Speicherfreihaltung wird während Preisperioden unterhalb des Mindestpreises ebenfalls gesperrt.
- Neue Konfiguration `Variable Einspeisefaktor (%)`: aktueller Prozentwert wird vor der Sperre gespeichert, während der Sperre auf 0 % gesetzt und danach wiederhergestellt.
- Änderungen des Einspeisefaktors außerhalb einer Sperre werden automatisch als neuer Rückstellwert übernommen.
- Neue Statusvariable `Einspeisepreis-Sperre` zeigt aktuellen Tarif, Mindestpreis, Sperrzeitraum und Einspeisefaktor.
- Einspeise-Statistik: gelber Erlös-Balken liegt vor dem blauen kWh-Balken; Hover hebt die aktive Serie hervor und blendet die andere ab.
- Börsenpreis-Diagramm verwendet die zentrale Laufzeit-Preisgrenze.
- Wiki auf den Stand 1.9.76 aktualisiert.
