# v1.9.47 / Build 118

- Fälligen gespeicherten Einspeiseplan vor dem Abruf neuer Daten und einer Neuberechnung ausführen.
- Gleichzeitige Control-Aufrufe mit einer instanzbezogenen Sperre verhindern.
- AlphaESS: Watchdog-Time vorab setzen, danach Start, ActivePower, Mode und SOC mit jeweils 3 Sekunden Abstand entsprechend dem Diagnoseablauf schreiben. Der 120-Sekunden-Watchdog bleibt erhalten.
- Wenn keine gültige allgemeine Leistungsvariable, aber alle AlphaESS-Variablen vorhanden sind, AlphaESS automatisch als Steuerweg verwenden. Eine gültige allgemeine Leistungsvariable behält Vorrang im allgemeinen Modus.
- Ohne gültigen Steuerweg einen Fehler melden, statt Einspeisung aktiv zu melden.

Prüfung: Quelltext-Prüfungen der Aufrufreihenfolge, Sperrfreigabe, Zeitbedingung, Stop-Befehle und JSON-Dateien; ZIP-Integrität geprüft. Keine PHP-Laufzeit und keine Verbindung zur Anlage verfügbar. Der tatsächliche Gerätebetrieb ist noch nicht verifiziert.
