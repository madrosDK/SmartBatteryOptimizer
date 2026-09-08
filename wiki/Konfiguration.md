# Konfiguration – alle Einstellungen erklärt

Diese Seite beschreibt, **was in jedes Feld eingetragen werden soll und welchen Einfluss es auf die Berechnung hat**.

## Standort & PV-Prognose

### Breitengrad / Längengrad
Standort der PV-Anlage. Die Koordinaten werden für die Wetter- und Strahlungsprognose verwendet. Es sollen die Koordinaten der Anlage eingetragen werden, nicht die des Stromanbieters oder Netzbetreibers.

### Globaler PV-Korrekturfaktor
Korrigiert ausschließlich die **berechnete PV-Erzeugungsprognose der gesamten Anlage**. `1,00` verändert nichts; `0,95` reduziert die prognostizierte PV-Leistung/-Energie um 5 %; `1,05` erhöht sie um 5 %. Er verändert weder Börsenpreis noch Verbrauch noch Batterie-SoC. **Zum Start 1,00 verwenden.** Details: [[PV-Prognose-und-Korrekturfaktoren]].

### Systemwirkungsgrad
Bildet allgemeine Verluste zwischen theoretisch möglicher Solarleistung und real nutzbarer elektrischer AC-Leistung ab, z. B. Wechselrichter-, Kabel- und sonstige Systemverluste. `0,90` bedeutet, dass 90 % der theoretischen Leistung angesetzt werden. Nicht gleichzeitig ohne Grund Systemwirkungsgrad und globalen Faktor stark reduzieren.

### Lernzeitraum PV-Flächenfaktor
Zeitraum, aus dem Vergleichswerte zwischen prognostizierter und tatsächlicher PV-Leistung zur automatischen Flächenkalibrierung verwendet werden. Länger = stabiler, kürzer = reagiert schneller.

### Lernphase bei unbekannter Ausrichtung
Anzahl gültiger Lerntage, die bei einer Fläche ohne bekannte Ausrichtung gesammelt werden müssen, bevor automatische Batterieeinspeisung freigegeben werden darf. Empfehlung: 30 Tage.

### Kalibrierung erst ab erwarteter Leistung
Mindest-Prognoseleistung einer Fläche, ab der ein Soll/Ist-Vergleich zum Lernen verwendet werden darf. Verhindert unbrauchbare Faktoren bei Dämmerung und sehr kleiner Leistung.

### Minimaler Auto-Faktor / Maximaler Auto-Faktor
Sicherheitsgrenzen für den automatisch gelernten Flächenfaktor. Sie verhindern extreme Werte durch Messfehler, falsche Variablen oder einzelne unpassende Wetterprognosen. Es sind keine Sollwerte.

## PV-Flächen

Für jede unterschiedliche Ausrichtung/Neigung eine eigene Zeile anlegen, sofern sie separat beschrieben werden kann.

### Aktiv
Nur aktive Zeilen fließen in die PV-Prognose ein.

### Name
Freie Bezeichnung, z. B. `Süddach`, `Ost Halle`, `West Garage`.

### Leistung
Installierte Modulleistung **dieser Fläche** in kWp. Nicht die Gesamtleistung der Anlage eintragen, wenn mehrere Flächen vorhanden sind.

Beispiel: 20 kWp gesamt, davon 12 kWp Süd und 8 kWp West → zwei Zeilen mit 12 und 8 kWp.

### Ausrichtung bekannt
Aktivieren, wenn Azimut und Neigung bekannt sind. Deaktivieren, wenn diese Daten nicht bekannt sind. Bei unbekannter Ausrichtung bleibt die Einspeiseautomatik während der Lernphase gesperrt.

### Azimut
Kompassrichtung der Modulfläche: `0° = Nord`, `90° = Ost`, `180° = Süd`, `270° = West`. Südwest wäre z. B. etwa 225°.

### Neigung
Winkel der Module gegenüber der Horizontalen: `0° = flach/waagrecht`, `90° = senkrecht`.

### Faktor
Manueller Korrekturfaktor **nur für diese PV-Fläche**. `1,00` = unverändert. `0,90` = diese Fläche 10 % niedriger prognostizieren. Sinnvoll z. B. bei bekannter dauerhafter Verschattung. Zum Start normalerweise `1,00`.

### Auto
Erlaubt dem Modul, aus den zugeordneten PV-String-/MPPT-Variablen einen automatischen Faktor für diese Fläche zu lernen.

### PV String 1 / 2 / 3
Normale IP-Symcon-Variablen mit der aktuellen Leistung in **Watt** der Strings bzw. MPPTs, die zu genau dieser Fläche gehören. Bis zu drei Variablen werden addiert. Nicht erforderlich, wenn keine automatische Flächenkalibrierung gewünscht ist. Bei unbekannter Ausrichtung ist mindestens eine passende Messvariable erforderlich.

## Batterie

### SoC Variable (%)
IP-Symcon-Variable mit aktuellem Batterieladezustand in Prozent.

### Speicherkapazität
Für die Optimierung anzusetzende Batteriekapazität in kWh. Bei einem 15-kWh-Speicher z. B. `15,0`.

### Mindest-SoC
Ladezustand, der durch gezielte Börseneinspeisung nicht unterschritten werden soll. Dieser Anteil bleibt als technische/gewünschte Reserve im Speicher.

### Max. Einspeise-/Entladeleistung
Maximale geplante Batterieentladeleistung in Watt. Muss zur zulässigen Leistung von Batterie und Wechselrichter passen.

### Variable Einspeisung EIN/AUS
IP-Symcon-Variable/Aktion, über die die externe Batterieeinspeisung freigegeben bzw. beendet wird. Vor Aktivierung der Automatik unbedingt manuell prüfen, welche Werte dein Batteriesystem erwartet.

### Sollleistung Entladung (optional)
Falls dein Batteriesystem zusätzlich einen Leistungssollwert akzeptiert, hier die entsprechende IP-Symcon-Variable wählen. Wenn nur EIN/AUS nötig ist, leer lassen.

### Sollleistung negativ schreiben
Aktivieren, wenn dein Batteriesystem Entladung mit negativem Vorzeichen erwartet, z. B. `-5000 W` statt `5000 W`.

## Eigenverbrauch lernen

### Hausverbrauch Leistung (W)
Normale IP-Symcon-Leistungsvariable des Hausverbrauchs in Watt. **Keine separate Archivvariable auswählen.** Das Modul liest die Archivwerte derselben Variablen-ID über das IP-Symcon-Archiv.

### PV-Istleistung (W) (optional)
Gesamtleistung der PV-Anlage in Watt. Damit kann das Modul erkennen, wann morgens wieder nennenswerte PV-Erzeugung beginnt. Ohne diese Variable wird die eingestellte Ersatz-Uhrzeit verwendet.

### Lernzeitraum
Anzahl vergangener Tage/Nächte, aus denen der typische Nachtverbrauch bestimmt wird.

### Mindestens gültige Nächte zum Lernen
Erst ab dieser Anzahl brauchbarer Nächte wird der gelernte Wert als ausreichend belastbar verwendet. Bis dahin greift der Ersatzwert bzw. ein bereits früher gelernter Wert.

### Ersatzwert Nachtverbrauch bei fehlenden Archivdaten
Reserve in kWh, die verwendet wird, wenn noch nicht genügend verwertbare Archivdaten vorhanden sind. Dieser Wert verhindert, dass die gesamte Optimierung wegen fehlender Historie ausfällt.

### Nacht-Auswertung beginnt
Uhrzeit, ab der der Verbrauch der Nacht zugerechnet wird, z. B. 18 Uhr.

### Morgenende ohne PV-Istvariable
Ersatz-Uhrzeit für das Ende der Nachtverbrauchsperiode, falls keine PV-Istleistungsvariable vorhanden ist.

### PV-Schwelle für Morgenende
Wenn eine PV-Istvariable vorhanden ist, gilt der Morgen ab Überschreiten dieser PV-Leistung als ausreichend gestartet. Beispiel 300 W: Sobald die PV-Erzeugung über 300 W liegt, endet die Nachtverbrauchsbetrachtung.

### Sicherheitsaufschlag Nachtverbrauch
Prozentuale zusätzliche Reserve auf den gelernten Nachtverbrauch. Beispiel: 4,0 kWh gelernt + 20 % = 4,8 kWh reserviert.

### Ausreißergrenze um Median
Filtert ungewöhnliche Nächte heraus, damit z. B. eine einmalige große Nachtlast den typischen Verbrauch nicht stark verfälscht. Der Median dient als robuste Vergleichsbasis.

## Börsenpreis & Optimierung

### Preisquelle
Legt fest, woher die Börsenpreise kommen. `aWATTar Österreich / EPEX Spot` nutzt die integrierte Quelle. `JSON-Variable` ist für eine eigene Preisquelle vorgesehen.

### JSON-Preisvariable
Nur bei eigener JSON-Preisquelle relevant. Hier die IP-Symcon-Variable auswählen, welche die Preisdaten im erwarteten JSON-Format enthält.

### Faktor bei positivem Marktpreis
Multiplikator für positive Börsenpreise, um den tatsächlich vergüteten Tarif abzubilden. Beispiel: Marktpreis 10 ct/kWh und Faktor 0,80 → 8 ct/kWh vor fixer Tarifanpassung.

### Faktor bei negativem Marktpreis
Separater Multiplikator für negative Börsenpreise, weil manche Tarife negative Preise anders behandeln als positive.

### Fixe Tarifanpassung
Fester Auf- oder Abschlag in ct/kWh nach der Multiplikation. Beispiel: `-1,5` zieht 1,5 ct/kWh vom berechneten Tarif ab.

### Mindest-Einspeisepreis
Unterhalb dieses **effektiven** Einspeisepreises plant das Modul keine Batterieeinspeisung. So kann verhindert werden, dass Speicherzyklen für wirtschaftlich uninteressante Preise genutzt werden.

### Min. PV-Prognose morgen für normale Freigabe
Ab dieser prognostizierten PV-Energie für morgen gilt die Folgetagsprognose als ausreichend gut für die normale Reserveberechnung. Darunter kann zusätzliche Energie im Speicher zurückgehalten werden.

### Zusatzreserve bei schlechter PV-Prognose
Zusätzlicher prozentualer Reserveaufschlag, wenn die morgige PV-Prognose unter der Grenze für normale Freigabe liegt.

### Bei sehr schlechter PV-Prognose Einspeisung sperren
Wenn aktiviert, wird bei extrem schlechter PV-Prognose gar keine automatische Börseneinspeisung zugelassen.

### Sehr schlechte PV-Prognose unter
Grenzwert in kWh für die oben genannte vollständige Einspeisesperre.

## Automatik

### Automatische Einspeisung aktiv
Master-Schalter für echte Batterie-Steuerbefehle. Prognose und Plan können auch bei deaktivierter Automatik berechnet werden. **Zum Einrichten zunächst deaktiviert lassen.**

### Daten/Plan aktualisieren alle
Zeitabstand, in dem Prognose, Preise, Reserven und Einspeiseplan neu bewertet werden. Kürzere Intervalle reagieren schneller, erzeugen aber mehr Abrufe und Berechnungen.

## Schaltflächen

### Jetzt Prognose & Plan berechnen
Startet sofort einen vollständigen Abruf und eine Neuberechnung.

### Nur Nachtverbrauch neu lernen
Berechnet den erwarteten Nachtverbrauch erneut aus vorhandenen Archivdaten, ohne dass dies als vollständiger manueller Planlauf gedacht ist.

### Einspeisung sofort stoppen
Beendet die vom Modul gesteuerte Einspeisung unmittelbar. Diese Funktion ist als manuelle Sicherheits-/Stop-Funktion vorgesehen.
