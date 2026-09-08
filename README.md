# SmartBatteryOptimizer für IP-Symcon

Version 1.1.0

Funktionen:
- Börsenpreise Österreich über aWATTar / EPEX Spot AT
- Mehrere PV-Flächen mit eigener kWp-Leistung, Azimut, Neigung und Korrekturfaktor
- Open-Meteo Global Tilted Irradiance als stündliche PV-Prognose
- Globaler PV-Korrekturfaktor und Systemwirkungsgrad
- Lernender Nachtverbrauch aus IP-Symcon Archivdaten
- Optional PV-Istleistung zur Erkennung des morgendlichen PV-Starts
- Ausreißerfilter für Nachtverbrauch
- Reserve abhängig von PV-Prognose des Folgetags
- Auswahl der teuersten Preisfenster bis zum erwarteten PV-Start am nächsten Morgen
- Automatische Freigabe und optionale Sollleistung für Batteriespeicher
- HTML-Einspeiseplan und Diagnosevariablen

## Installation
Den Inhalt des ZIP in den IP-Symcon Modulordner entpacken. Das ZIP enthält direkt:
- SmartBatteryOptimizer/
- library.json
- README.md

Danach Modul neu laden bzw. IP-Symcon neu starten und eine Instanz "Börsenpreis Speicheroptimierung" anlegen.

## PV-Azimut
In der Konfiguration wird die übliche Kompassangabe verwendet:
- 0° = Nord
- 90° = Ost
- 180° = Süd
- 270° = West

Das Modul rechnet die Werte intern in die Open-Meteo-Konvention um.

## Preisformel
Der aWATTar-Marktpreis wird von EUR/MWh in ct/kWh umgerechnet.
Effektiver Einspeisetarif = Marktpreis * Faktor + fixe Tarifanpassung.
Positive und negative Preise haben getrennte Faktoren.

Beispiel Sunny Spot ähnlich abbilden:
- PositivePriceFactor = 0.81
- NegativePriceFactor = 1.19
- PriceAdjustmentCt = 0

## Nachtverbrauch
Im Konfigurationsformular wird die normale IP-Symcon-Hausverbrauchsvariable ausgewählt. Es ist keine separate Archivvariable erforderlich. Das Modul findet die Archiv-Control-Instanz selbst und liest die Historie der ausgewählten Variablen-ID.

Ist die Variable noch nicht archiviert oder sind noch nicht genügend gültige Nächte vorhanden, läuft die Prognose mit dem konfigurierbaren Ersatzwert weiter. Ein bereits gelernter Wert wird dabei gegenüber dem Ersatzwert bevorzugt. Sobald genügend Archivdaten vorhanden sind, wechselt das Modul automatisch auf den aus dem Archiv gelernten Nachtverbrauch. Die Hausverbrauchsvariable muss eine Leistung in Watt enthalten. Weil AC_GetLoggedValues nur Änderungen speichert, wird der letzte bekannte Wert vor Beginn des Zeitfensters mit berücksichtigt.

## Wichtiger Sicherheitshinweis
Vor Aktivierung der Automatik zuerst mit deaktivierter Automatik den Plan kontrollieren. Speicher-Hersteller unterscheiden sich bei Freigabevariablen, Vorzeichen und Leistungs-Sollwerten. Die Option "Sollleistung negativ schreiben" ist für Systeme vorgesehen, die Entladung mit negativem Vorzeichen erwarten.


## Änderungen 1.1.0
- Nachtverbrauch blockiert Prognose und Preisplanung bei fehlenden Archivdaten nicht mehr.
- Konfigurierbarer Ersatzwert für den Nachtverbrauch.
- Konfigurierbare Mindestanzahl gültiger Nächte.
- Automatische Erkennung, ob die ausgewählte normale Variable archiviert wird.
- Anzeige der Quelle des verwendeten Nachtverbrauchswerts und Anzahl gültiger Nächte.
- Zeitgewichtete Auswertung der Archivnächte.


## PV-Flächenkalibrierung
Je PV-Fläche können bis zu drei IP-Symcon-Leistungsvariablen für Strings/MPPTs gewählt werden. Die Istleistungen werden addiert und mit der erwarteten Leistung dieser Fläche verglichen. Aus mehreren gültigen Messpunkten wird ein eigener Auto-Faktor pro Fläche gelernt. Der manuelle Faktor bleibt unverändert und wird mit dem Auto-Faktor kombiniert.

## Unbekannte PV-Ausrichtung
Ist Azimut/Neigung einer PV-Fläche nicht bekannt, kann in der Flächentabelle `Ausrichtung bekannt` deaktiviert werden. Für diese Fläche werden die zugeordneten String-/MPPT-Leistungsvariablen zum Lernen verwendet. Die automatische Batterieeinspeisung bleibt standardmäßig bis 30 gültige Lerntage erreicht sind gesperrt. Prognose, Preisabruf und Planberechnung laufen während der Lernphase weiter.
