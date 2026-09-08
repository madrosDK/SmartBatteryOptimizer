# SmartBatteryOptimizer – Konfiguration

Diese Seite beschreibt alle Einstellungen des SmartBatteryOptimizer. Die Angaben beziehen sich auf Version **1.1.2**.

## 1. Standort & PV-Prognose

### Breitengrad / Längengrad
Geografische Position der PV-Anlage in Dezimalgrad. Diese Werte werden für die Wetter- und Einstrahlungsprognose verwendet.

Beispiel für Kärnten: `46,62` / `14,31`.

### Globaler PV-Korrekturfaktor
Korrektur für die komplette PV-Anlage. `1,00` bedeutet keine Korrektur. `0,95` reduziert die gesamte Prognose um 5 %, `1,05` erhöht sie um 5 %.

Empfehlung zum Start: **1,00**. Feinkorrekturen sollten bevorzugt über die einzelnen PV-Flächen bzw. deren Auto-Kalibrierung erfolgen.

### Systemwirkungsgrad
Berücksichtigt typische Verluste zwischen theoretischer Einstrahlung und nutzbarer AC-Leistung, z. B. Wechselrichter-, Kabel- und Temperaturverluste.

Beispiel: `0,86` entspricht 86 %.

Empfehlung zum Start: **0,85–0,90**.

### Lernzeitraum PV-Flächenfaktor
Zeitraum, aus dem Messwerte für den automatisch gelernten PV-Flächenfaktor verwendet werden. Ältere Werte werden verworfen.

Empfehlung: **14 Tage**. Bei stark saisonaler Verschattung kann ein kürzerer Wert sinnvoll sein.

### Lernphase bei unbekannter Ausrichtung
Wenn bei mindestens einer aktiven PV-Fläche **Ausrichtung bekannt** deaktiviert ist, bleibt die automatische Batterieeinspeisung gesperrt, bis für diese Fläche ausreichend viele gültige Lerntage vorliegen.

Empfehlung: **30 Tage**.

Wichtig: Es zählen gültige Lerntage mit verwertbaren PV-Messwerten, nicht nur verstrichene Kalendertage.

### Kalibrierung erst ab erwarteter Leistung
Die Auto-Kalibrierung wird nur durchgeführt, wenn die theoretisch erwartete Leistung der Fläche mindestens diesen Wert erreicht. Dadurch werden instabile Faktoren bei Nacht, Dämmerung oder sehr geringer Einstrahlung vermieden.

Empfehlung: **300 W**.

### Minimaler / maximaler Auto-Faktor
Grenzen für den automatisch gelernten Faktor. Dadurch kann ein Messfehler oder eine falsche Variable die Prognose nicht beliebig stark verändern.

Empfehlung: **0,50 bis 1,50**.

## 2. PV-Flächen

Eine Zeile entspricht einer Modulgruppe mit gleicher oder ähnlicher Ausrichtung und Neigung. Ost-, Süd- und Westflächen sollten als getrennte Zeilen angelegt werden.

### Aktiv
Legt fest, ob die Fläche in Prognose und Kalibrierung einbezogen wird.

### Name
Frei wählbare Bezeichnung, z. B. `Süd`, `Ost Garage`, `West Halle`.

Hinweis: Der Name sollte nach Beginn der Lernphase möglichst nicht mehr geändert werden, da der Lernspeicher die Fläche über Position und Namen zuordnet.

### Leistung
Installierte Modulleistung dieser Fläche in **kWp**. Nicht die Wechselrichterleistung eintragen.

Beispiel: 20 Module mit je 500 W = **10,00 kWp**.

### Ausrichtung bekannt
Aktivieren, wenn Azimut und Neigung bekannt sind. Dann verwendet die Prognose diese Geometrie direkt.

Deaktivieren, wenn die Ausrichtung nicht zuverlässig bekannt ist. In diesem Fall nutzt das Modul zunächst eine neutrale Referenz und lernt über die zugeordneten PV-Stringvariablen. Die automatische Einspeisung bleibt bis zum Ende der eingestellten Lernphase gesperrt.

### Azimut
Kompassrichtung der Modulfläche in Grad:

| Richtung | Azimut |
|---|---:|
| Nord | 0° bzw. 360° |
| Ost | 90° |
| Süd | 180° |
| West | 270° |

Das Modul rechnet diese Angabe intern in die von der Prognosequelle erwartete Definition um.

### Neigung
Neigung der Module gegenüber der Horizontalen:

- `0°` = waagrecht
- `30°` = typische Dachneigung
- `90°` = senkrechte Fassade

### Faktor
Manueller Korrekturfaktor nur für diese Fläche. `1,00` = keine Korrektur. Sinnvoll bei bekannter dauerhafter Verschattung oder abweichender realer Modulleistung.

Der effektive Faktor ist:

`manueller Faktor × Auto-Faktor × globaler PV-Korrekturfaktor`

### Auto
Aktiviert die automatische Kalibrierung für diese Fläche. Dafür muss mindestens eine der drei PV-Stringvariablen zugeordnet sein.

### PV String 1 / PV String 2 / PV String 3
Bis zu drei normale IP-Symcon-Variablen mit der **aktuellen Leistung in Watt** für die zu dieser Fläche gehörenden Strings oder MPPTs.

Das Modul addiert die eingetragenen Variablen und vergleicht die Summe mit der erwarteten Leistung dieser Fläche.

Beispiel:

- PV String 1 = MPPT 1 Leistung
- PV String 2 = MPPT 2 Leistung
- PV String 3 = nicht benötigt → leer lassen

Die Variablen müssen Momentanleistung in **W** liefern. Energiezähler in Wh/kWh sind hier nicht geeignet.

## 3. Batterie

### SoC Variable (%)
Normale IP-Symcon-Variable mit dem aktuellen Ladezustand des Speichers in Prozent von 0 bis 100.

### Speicherkapazität
Nutzbare bzw. für die Optimierung anzusetzende Speicherkapazität in kWh.

Beispiel: Speicher mit 15 kWh nutzbarer Kapazität → `15,00`.

### Mindest-SoC
Unter diesen Ladezustand darf der Optimierer die Batterie durch geplante Einspeisung nicht entladen.

Beispiel: `15 %`.

### Max. Einspeise-/Entladeleistung
Maximale Leistung in Watt, mit der der Optimierer Energie aus der Batterie einspeisen darf. Der Wert sollte die zulässige Entladeleistung von Speicher, Wechselrichter und Netzanschluss nicht überschreiten.

### Variable Einspeisung EIN/AUS
Boolesche IP-Symcon-Variable bzw. Aktionsvariable, mit der die Batterieeinspeisung freigegeben oder gesperrt wird.

Das Modul versucht zuerst `RequestAction()`. Falls die Variable keine Aktion unterstützt, wird direkt geschrieben.

### Sollleistung Entladung (optional)
Variable für die gewünschte Entlade-/Einspeiseleistung in Watt. Wenn der Speicher nur EIN/AUS benötigt, kann dieses Feld leer bleiben.

### Sollleistung negativ schreiben
Aktivieren, wenn dein Batteriesystem Entladung als negativen Leistungswert erwartet.

Beispiel: geplante Einspeisung 5.000 W → es werden `-5000 W` geschrieben.

Deaktiviert: es werden `+5000 W` geschrieben.

## 4. Eigenverbrauch lernen

### Hausverbrauch Leistung (W)
Normale IP-Symcon-Variable mit der aktuellen Hausverbrauchsleistung in Watt. **Diese Variable muss im IP-Symcon Archiv protokolliert werden.**

Es wird keine separate Archivvariable ausgewählt. Das Modul findet die Archiv-Control-Instanz selbst und liest die Historie der gewählten Variablen-ID.

Wichtig: Hier sollte der tatsächliche Verbrauch des Hauses stehen, nicht nur der Netzbezug. Ein negativer Netzfluss oder eine reine Einspeisevariable ist nicht geeignet.

### PV-Istleistung (W) (optional)
Gesamt-PV-Leistung der Anlage in Watt. Diese Variable wird verwendet, um rückwirkend zu erkennen, wann morgens wieder ausreichend PV-Leistung vorhanden war.

Wenn sie nicht angegeben wird, verwendet das Modul die Einstellung **Morgenende ohne PV-Istvariable**.

### Lernzeitraum
Anzahl der vergangenen Tage, aus denen Nachtverbräuche berechnet werden.

Empfehlung: **30 Tage**.

### Mindestens gültige Nächte zum Lernen
So viele verwertbare Nächte müssen vorhanden sein, bevor ein neuer Nachtverbrauch gelernt wird.

Sind noch nicht genügend Werte vorhanden, verwendet das Modul zuerst einen bereits früher gelernten Wert und andernfalls den Ersatzwert.

Empfehlung: **3 Nächte** zum Start; später sind höhere Werte möglich.

### Ersatzwert Nachtverbrauch bei fehlenden Archivdaten
Fallback in kWh, falls noch keine ausreichenden Archivwerte vorhanden sind oder die ausgewählte Variable nicht archiviert wird.

Dieser Wert verhindert, dass die komplette Optimierung wegen fehlender Historie ausfällt.

### Nacht-Auswertung beginnt
Uhrzeit, ab der der Nachtverbrauch eines Tages gezählt wird.

Beispiel: `18 Uhr` bedeutet, dass ab 18:00 Uhr bis zum ermittelten Morgenende integriert wird.

### Morgenende ohne PV-Istvariable
Fallback-Uhrzeit für das Ende der Nachtperiode, wenn keine Gesamt-PV-Istleistungsvariable angegeben wurde oder keine brauchbaren PV-Archivdaten vorliegen.

Empfehlung zum Start: **8 Uhr**.

### PV-Schwelle für Morgenende
Wenn eine PV-Istleistungsvariable vorhanden ist, endet die Nachtperiode beim ersten archivierten Zeitpunkt am Morgen, an dem die PV-Leistung mindestens diesen Wert erreicht.

Beispiel: **300 W**.

### Sicherheitsaufschlag Nachtverbrauch
Zusätzliche Reserve auf den gelernten Nachtverbrauch.

Beispiel: Nachtverbrauch 4,0 kWh und Sicherheitsaufschlag 10 % → 4,4 kWh Reserve.

### Ausreißergrenze um Median
Filter für ungewöhnliche Nächte. Werte außerhalb des erlaubten Bereichs um den Median werden nach Möglichkeit aus der Lernberechnung entfernt.

Ein höherer Wert lässt größere Abweichungen zu. Der Standard `70 %` ist bewusst tolerant.

## 5. Börsenpreis & Optimierung

### Preisquelle
Aktuell stehen zwei Varianten zur Verfügung:

1. **aWATTar Österreich / EPEX Spot** – automatischer Abruf der österreichischen Marktpreise.
2. **JSON-Variable** – eigene Preisquelle über eine Stringvariable.

### JSON-Preisvariable
Nur erforderlich, wenn als Preisquelle die JSON-Variable gewählt wurde.

Erwartetes Format:

```json
[
  {"start": 1788886800, "end": 1788890400, "priceCt": 12.5},
  {"start": "2026-09-08 19:00:00", "end": "2026-09-08 20:00:00", "priceCt": 18.2}
]
```

`start` und `end` können Unix-Zeitstempel oder von PHP erkennbare Datum-/Zeittexte sein. `priceCt` ist in ct/kWh.

### Faktor bei positivem Marktpreis
Multiplikator für positive Börsenpreise.

Beispiel: Marktpreis 10 ct/kWh, Faktor `0,90` → 9 ct/kWh vor fixer Tarifanpassung.

### Faktor bei negativem Marktpreis
Separater Multiplikator für negative Marktpreise. Damit lassen sich Tarifmodelle abbilden, die negative Preise anders behandeln.

### Fixe Tarifanpassung
Fester Auf- oder Abschlag in ct/kWh nach Anwendung des Preisfaktors.

Berechnung:

`effektiver Einspeisepreis = Marktpreis × Faktor + fixe Tarifanpassung`

Beispiel: Markt 10 ct, Faktor 0,90, Anpassung -1,0 ct → effektiver Preis 8,0 ct/kWh.

### Mindest-Einspeisepreis
Preisuntergrenze. Zeitfenster mit einem effektiven Preis unter diesem Wert werden nicht für die geplante Batterieeinspeisung verwendet.

### Min. PV-Prognose morgen für normale Freigabe
Liegt die prognostizierte PV-Energie des nächsten Tages unter diesem Wert, wird die Nachtreserve zusätzlich erhöht.

Dadurch wird bei einem schwachen Folgetag vorsichtiger entladen.

### Zusatzreserve bei schlechter PV-Prognose
Prozentualer Zuschlag auf die bereits berechnete Nachtreserve, wenn die PV-Prognose unter der oben eingestellten Mindestprognose liegt.

Beispiel: Reserve 4,4 kWh und Zusatzreserve 40 % → 6,16 kWh.

### Bei sehr schlechter PV-Prognose Einspeisung sperren
Wenn aktiviert, wird bei extrem schlechter Prognose überhaupt keine Batterieenergie für Börseneinspeisung freigegeben.

### Sehr schlechte PV-Prognose unter
Grenzwert in kWh für die vollständige Sperre. Wird nur verwendet, wenn die vorherige Option aktiviert ist.

## 6. Automatik

### Automatische Einspeisung aktiv
Master-Schalter für die tatsächliche Steuerung der Batterie.

Wenn deaktiviert, berechnet das Modul weiterhin Prognosen und Pläne, schaltet aber die Einspeisung aus.

Bei einer PV-Fläche mit unbekannter Ausrichtung bleibt die Automatik trotz aktiviertem Schalter so lange gesperrt, bis die eingestellte Lernphase abgeschlossen ist.

### Daten/Plan aktualisieren alle
Intervall in Minuten für automatischen Abruf von PV-Prognose und Preisen sowie die Neuberechnung des Einspeiseplans.

Empfehlung: **30 Minuten**.

Die eigentliche Kontrolle, ob gerade ein geplantes Einspeisefenster aktiv ist, erfolgt intern häufiger.

## 7. Schaltflächen

### Jetzt Prognose & Plan berechnen
Startet sofort Nachtverbrauchslernen, PV-Prognose, Preisabruf und Planberechnung. Anschließend wird der aktuelle Automatikzustand geprüft.

### Nur Nachtverbrauch neu lernen
Berechnet ausschließlich den erwarteten Nachtverbrauch aus dem Archiv neu.

### Einspeisung sofort stoppen
Setzt den Entlade-Sollwert auf 0 W und deaktiviert die Einspeisefreigabe.

## 8. Wichtige Ausgabevariablen

Das Modul legt unter seiner Instanz unter anderem folgende Variablen an:

- **PV Prognose morgen** – prognostizierter PV-Ertrag des Folgetages
- **PV Kalibrierung** – Status der Flächenkalibrierung
- **Automatikfreigabe** – zeigt Lernphase/Freigabe an
- **Prognose Nachtverbrauch** – aktuell verwendeter Nachtverbrauch
- **Quelle Nachtverbrauch** – Archiv, letzter Lernwert oder Fallback
- **Gültige Nächte** – Anzahl verwertbarer Nachtmessungen
- **Für Einspeisung verfügbar** – geplante freigebbare Energie
- **Aktueller Einspeisepreis** – aktuell wirksamer Tarif
- **Höchster geplanter Einspeisepreis** – bester im Plan genutzter Preis
- **Einspeisung aktiv** – aktueller Schaltzustand
- **Geplante Einspeiseleistung** – aktuell angeforderte Leistung
- **Nächstes Einspeisefenster** – nächster geplanter Zeitraum
- **Erwarteter Erlös** – theoretischer Erlös des aktuellen Plans
- **Optimierungsstatus** – Textstatus oder Fehlerhinweis
- **Einspeiseplan** – HTML-Übersicht

## 9. Empfohlene Grundeinstellung zum ersten Test

1. Automatische Einspeisung zunächst **deaktivieren**.
2. Standort eintragen.
3. PV-Flächen anlegen und kWp korrekt aufteilen.
4. Wenn möglich Azimut und Neigung eintragen; andernfalls **Ausrichtung bekannt** deaktivieren und Stringvariablen zuweisen.
5. SoC und Batteriekapazität konfigurieren.
6. Hausverbrauchsvariable auswählen und sicherstellen, dass sie archiviert wird.
7. Einspeisefreigabe und optional Entlade-Sollleistung auswählen.
8. **Jetzt Prognose & Plan berechnen** ausführen und Ausgabevariablen kontrollieren.
9. Erst nach erfolgreicher Plausibilitätsprüfung die automatische Einspeisung aktivieren.
