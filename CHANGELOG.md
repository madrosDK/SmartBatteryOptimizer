## 1.10.21 / Build 192

- Preisfenster-Neuoptimierung vor dem Start fehlertolerant gemacht.
- Die optionale Beibehaltung der alten Zielmenge innerhalb +/-10 % kann den normalen Aktualisierungslauf nicht mehr abbrechen.
- Bei einem Fehler der Zusatz-Neuoptimierung werden Werte und Grafiken mit dem bereits gültigen Standardplan weiter aktualisiert.

# Changelog

## 1.10.20 (Build 191)
- Zukünftige Einspeisefenster werden bis zum tatsächlichen Start bei jeder Planberechnung mit den neuesten Preisen neu optimiert, damit immer die erlösstärksten verfügbaren Zeitfenster genutzt werden.
- Die +/-10-%-Toleranz gilt weiterhin nur für die geplante Energiemenge: Liegt die bisherige Zielmenge innerhalb der Toleranz zur aktuellen Freigabe, bleibt diese kWh-Menge bestehen, wird aber auf die aktuell besten Preisfenster neu verteilt.
- Erst ein tatsächlich laufender Einspeisevorgang wird zeitlich verbindlich und nicht mehr durch neue Preise verschoben.

## 1.10.19 (Build 190)
- Netzbezug-/Netzeinspeisungsvariable wird beim ApplyChanges automatisch im IP-Symcon Archive Control aktiviert, falls Logging noch aus ist.
- Aggregation der Netzvariable wird für die Einspeise-Statistik auf Standard/Rohwertbasis gesetzt, damit die Tagesintegration zuverlässig aus dem Archiv berechnet werden kann.

## 1.10.18 (Build 189)
- Verbindliche Einspeisepläne: Innerhalb der +/-10-%-Toleranz bleibt der komplette Plan unverändert, einschließlich geplanter Energiemenge und Zeitfenster.
- Erst bei einer Abweichung von mehr als 10 % zur aktuell freigegebenen Energiemenge wird der verbindliche Plan angepasst.

## 1.10.17 (Build 188)
- Verbindliche Einspeisepläne: Innerhalb der +/-10-%-Toleranz bleibt das Preisfenster zeitlich unverändert, die Zielenergiemenge wird aber auf die aktuell freigegebene Energiemenge nachgeführt.
- `Geplante Einspeisemenge aktuell` entspricht damit auch innerhalb der Toleranz der aktuellen Freigabe; die +/-10 % dienen nur noch als Hysterese gegen unnötige Neuberechnung des Fensters.
- Einspeise-Statistik: responsive Balken etwas schmaler eingestellt, ohne feste Pixelbreite einzuführen.

## 1.10.16 (Build 187)
- Provider-Caching optimiert: Open-Meteo und Forecast.Solar werden im Normalbetrieb maximal einmal pro Stunde je PV-Fläche extern abgefragt.
- EPEX/smartENERGY-Preise werden eine Stunde gecacht; interne Planberechnungen können weiterhin beliebig oft laufen.
- pvnode behält die bestehende Tageslimit-/Cache-Logik (typisch ein Live-Abruf pro Tag).
- Force-Refresh der Prognoseanbieter umgeht die PV-Provider-Caches weiterhin bewusst.
- Einspeise-Statistik wird im laufenden Betrieb maximal einmal pro Minute neu gerendert, damit der heutige Balken mitläuft.
- Einspeise-Statistik reagiert per ResizeObserver/Highcharts-Reflow dynamisch auf die verfügbare Breite.


## 1.10.14 (Build 185)
- Normaler Aufruf „Prognose & Plan“ startet die Berechnung jetzt direkt statt über den unzuverlässigen 1-Sekunden-One-Shot-Worker.
- Dadurch bleibt die Aktion nicht mehr bei „Auftrag angenommen“ stehen; Provider, Preise, Plan und Diagramme werden im selben Aufruf aktualisiert.
- Der bisherige Worker bleibt nur aus Kompatibilitätsgründen registriert, wird vom normalen Aufruf aber nicht mehr verwendet.

## 1.10.13 / Build 184

- Automatische PV-Prognose aktualisiert jetzt direkt, statt nur den manuellen One-Shot-Worker anzustoßen.
- Bei gleichzeitiger Preis-/Planberechnung wird der PV-Abruf nach 30 Sekunden automatisch nachgeholt, statt auszufallen.
- Force-Refresh und automatischer PV-Refresh verwenden damit denselben eigentlichen Berechnungspfad; der Force-Refresh umgeht weiterhin bewusst Provider-Caches.

## 1.10.12 / Build 183
- Berechnungssperre wird jetzt garantiert per finally geloest; Fehler in Control() blockieren Prognose-/Preisupdates nicht mehr.
- Fehler beim PV-Prognoseabruf stoppen die Preis-/Planaktualisierung nicht mehr, sofern ein letzter gueltiger Forecast vorhanden ist.
- Status zeigt in diesem Fall eine Warnung, waehrend Preise, Planung und Diagramme weiter aktualisiert werden.

## v1.10.11 / Build 182
- Update-Erkennung korrigiert: der automatische Vollrefresh nach Modulupdates wird jetzt zuverlässig in `ApplyChanges()` ausgelöst und ist nicht mehr vom Debug-Modus abhängig.
- Veraltete interne Versionskennung `1.10.06` entfernt; neue Modulversion `1.10.11` wird korrekt erkannt.
- Dadurch werden nach dem Update PV-Quellen, Status, Prognose und Einspeiseplanung automatisch neu eingelesen bzw. aufgebaut.

## v1.10.10 / Build 181

- Veraltete aktive Einspeisezustände werden automatisch erkannt und bereinigt, wenn tatsächlich keine Einspeisung läuft.
- `Geplante Einspeisemenge aktuell` wird dadurch nicht mehr von einem hängen gebliebenen `ActiveFeedInPlanKey` auf einem alten Wert festgehalten.
- Die ±10-%-Anpassung des verbindlichen Plans kann danach die Anzeige und Zielmenge wieder korrekt aktualisieren.

## v1.10.09 / Build 180

- Sicherheitsabgleich fuer verbindliche Einspeiseplaene wird jetzt auch dann ausgefuehrt, wenn ein PV-Prognose-/Provider-Abruf den normalen Rechenlauf vorzeitig abbricht.
- Ein alter Zukunftsplan kann dadurch nicht mehr mit einer veralteten Zielmenge stehen bleiben, obwohl die zuletzt erfolgreich berechnete Freigabemenge bereits deutlich kleiner ist.
- Die +/-10-%-Toleranz aus v1.10.08 bleibt unveraendert; das bereits gewaehlte Preisfenster bleibt erhalten.
- Laufende Einspeisevorgaenge werden vom Fehler-Fallback nicht veraendert.
- Der eigentliche Prognosefehler bleibt weiterhin sichtbar und wird nicht unterdrueckt.

# SmartBatteryOptimizer Changelog

## v1.10.08 / Build 179

- Verbindliche Einspeisepläne behalten weiterhin das bereits gewählte Preisfenster bei, die geplante Energiemenge wird aber mit der aktuell freigegebenen Einspeisemenge abgeglichen.
- ±10-%-Toleranz ergänzt: Liegt die alte Planmenge zwischen 90 % und 110 % der aktuell freigegebenen Menge, bleibt der Plan unverändert.
- Erst bei einer Abweichung von mehr als 10 % wird die Zielmenge auf die aktuell freigegebene Energiemenge angepasst.
- Die erwartete Laufzeit innerhalb des bestehenden Preisfensters wird passend zur angepassten Zielmenge neu berechnet; es wird dafür kein neues Preisfenster gewählt.
- Beispiel: Bei 6,50 kWh Freigabe bleiben 5,85 bis 7,15 kWh unverändert; 19,48 kWh werden auf 6,50 kWh angepasst.

## v1.10.07 / Build 178

- PV-Prognose-Diagramm korrigiert: vollständig vergangene Stunden verwenden für Anbieterlinien und den blauen kombinierten Prognosebalken nun denselben eingefrorenen Prognosestand.
- Der blaue Balken für bereits vergangene Stunden wird beim Rendern nicht mehr nachträglich aus einem neueren Forecast überschrieben.
- Aktuelle und zukünftige Stunden bleiben weiterhin dynamisch und werden bei neuen Prognoseabrufen aktualisiert.
- Keine Änderung an PV-Gewichtung, Kalibrierungsberechnung, Einspeiseplanung oder Dispatch.

## v1.10.06 / Build 177

- Navigationsbuttons der Einspeise-Statistik vollständig an den Stil der übrigen Diagramme angeglichen: Tahoma, identische Schriftgrößen, Mindestbreiten, Innenabstände und Fettschrift für Heute/Woche/Monat.
- Keine Änderung an Einspeiseplanung, Dispatch oder Statistikberechnung.

## v1.10.05 / Build 176
- Navigationsbuttons im Einspeise-Statistik-Chart (`←`, `→`, `Heute`, `Woche`, `Monat`) verwenden jetzt wie die übrigen Charts explizit Tahoma mit identischem Fallback-Fontstack.
- Keine Änderung an Einspeiseplanung, Statistikberechnung oder gespeicherten Daten.

## v1.10.04 / Build 175
- Nacht-Einspeiseplanung verwendet für die Batterie-/Dispatch-Leistung jetzt ausschließlich den Konfigurationswert **„Max. Einspeise-/Entladeleistung“**.
- Bei 20.000 W Konfiguration werden an AlphaESS weiterhin 20.000 W Dispatch-Leistung geschrieben.
- Für die rechnerisch erwartete Netzeinspeisung wird nur der prognostizierte Eigenverbrauch aus dem stündlichen Lastprofil abgezogen: `Netzleistung = Max. Einspeise-/Entladeleistung - Eigenverbrauch`.
- Das separate Netzeinspeiselimit und der Sicherheitsabstand (z. B. 10.000 W - 500 W = 9.500 W) begrenzen die nächtliche Preis-Einspeiseplanung nicht mehr.
- Laufzeit, geplante Energiemenge und Tooltip basieren dadurch auf der korrekten erwarteten Netzleistung.
- Zukunftspläne aus älteren Planner-Versionen werden einmalig neu berechnet; Archivdaten bleiben unangetastet.

## v1.10.03 / Build 174
- `davon für Einspeisung frei` ist wieder die Soll-Netzeinspeisemenge; bei 20,09 kWh frei werden 20,09 kWh geplant.
- Der erwartete Eigenverbrauch verkleinert nicht die Soll-kWh, sondern reduziert die erwartete Netzleistung und verlängert dadurch die Laufzeit.
- Das zusammenhängende Zeitfenster wird aus Soll-kWh und erwarteter Netzleistung berechnet.
- Fehler im Börsenpreisdiagramm behoben: ein kombinierter Plan wird nicht mehr für jeden internen 15-Minuten-Preisslot erneut addiert.
- Dadurch erscheinen keine vervielfachten Werte wie 61,15 kWh mehr.
- Der Tooltip zeigt die je Stunde tatsächlich geplante Energie und die erwartete Netzeinspeiseleistung.
- Zukunftspläne aus v1.10.02 werden einmalig neu berechnet; Archivdaten bleiben unangetastet.

## v1.10.02 / Build 173
- Freie Batterieenergie und geplante Netzeinspeisung werden getrennt berechnet.
- Der erwartete Eigenverbrauch wird während der Entladung aus der Netzleistung herausgerechnet.
- Die freie Batterieenergie ist die harte Obergrenze; die geplante Netzenergie liegt entsprechend darunter.
- Zusammenhängende Preisstunden bleiben ein durchgehender Einspeisevorgang.
- Preisdiagramm und Plantabelle zeigen je Stunde nur ihren eigenen Energieanteil statt die Gesamtenergie des kombinierten Plans in jedem Balken.
- `Geplante Einspeisemenge aktuell` zeigt vor Start den nächsten tatsächlichen Gesamtplan; alte Ist-Mengen werden für den neuen Plan auf 0 gesetzt.
- Zukunftspläne aus v1.10.01 werden einmalig neu berechnet. Archivdaten werden nicht gelöscht.

## v1.10.01 / Build 172
- Zusammenhängende ausgewählte Preisstunden werden zu einem einzigen verbindlichen Einspeisevorgang mit gemeinsamer Ziel-kWh-Menge zusammengeführt.
- Kein planmäßiger STOP/START mehr am Stundenwechsel innerhalb eines zusammenhängenden grünen Preisfensters.
- „Nächstes Einspeisefenster“ verwendet den zusammenhängenden Gesamtplan.
- PV-Flächen erhalten intern eine stabile ID-Zuordnung; Umbenennen und Sortieren behalten die Kalibrierzuordnung bei.
- Neue PV-Flächen erhalten automatisch eigene Prognose-/Ist-Kalibrierungsvariablen.
- Beim Löschen einer PV-Fläche werden nur deren eindeutig zugeordnete interne Kalibrierungsvariablen entfernt.
- Die pauschale Kalibrierarchiv-Löschmigration aus v1.10.00 wurde vollständig entfernt. Updates löschen keine bestehenden Kalibrierarchive mehr.

## v1.10.00 / Build 171
- PV-Kalibrierung Prognose und Ist sind jetzt ausdrücklich Stundenenergie in kWh (`~Electricity`), nicht W.
- `PV Kalibrierung Ist Haus/Nebengebäude` wird als kWh-Variable gepflegt.
- Alle vier internen Kalibrierungsvariablen bleiben versteckt.
- Einmalige Migration entfernt alte Watt-/inkompatible Prognose-/Ist-Archivwerte, damit sie nicht als kWh fehlinterpretiert werden.
- Danach werden ausschließlich neue gültige Prognose/Ist-kWh-Paare abgeschlossener Stunden aufgebaut.
- Changelog bleibt eine einzige fortgeschriebene `CHANGELOG.md`.

# SmartBatteryOptimizer – Changelog

Alle Versionsänderungen werden ab v1.9.99 ausschließlich in dieser Datei fortgeführt.

## v1.9.99 / Build 170

- Einspeise-Statistik: detaillierte Automatikläufe aus `FeedInStatisticsJSON` werden mit den Archivdaten zusammengeführt, statt bei vorhandenem Archiv ignoriert zu werden. Dadurch können bereits vorhandene Läufe – insbesondere die Einspeisung vom Vorabend – wieder korrekt dem grünen Automatikanteil zugeordnet werden.
- Neue Automatikläufe speichern zusätzlich Start- und Endzeit im Statistikarchiv. Die gemessene kWh-Menge und der Erlös bleiben dem realen Automatikfenster eindeutig zugeordnet.
- Archiv- und JSON-Historie werden gegen Doppelzählung abgeglichen.
- Blau bleibt Gesamteinspeisung minus erkannte Automatikmenge; Grün ist die gemessene Einspeisung der Preis-Einspeiseautomatik.
- Versionsdokumentation auf eine einzige `CHANGELOG.md` umgestellt. Frühere Einzel-Changelogs wurden darin zusammengefasst und aus dem Modul entfernt.
- PV-Kalibrierung mit gepaarten Prognose-/Ist-Stundenwerten sowie pvnode `string_index`-Zuordnung aus den vorherigen Versionen bleiben erhalten.

# SmartBatteryOptimizer v1.9.98 / Build 169

- PV-Kalibrierung auf echte Stundenpaare umgestellt.
- Forecast einer Stunde wird intern beim ersten verfügbaren Wert eingefroren, nicht mehr als Zukunftswert ins Archiv geschrieben.
- Nach Ende der Stunde werden Prognose und Ist gemeinsam mit demselben Stunden-Endzeitstempel archiviert.
- PV Kalibrierung Ist Haus/Nebengebäude wird wieder verwendet und sichtbar geführt.
- Bei Abregelung/Sperrzeit wird für die betroffene Stunde weder Prognose noch Ist als Kalibrierpaar geschrieben.
- Faktorberechnung verwendet ausschließlich Zeitstempel, für die Prognose UND Ist vorhanden sind.
- Neuer Button „PV-Kalibrierung aus vorhandenen Daten nachtragen“: ergänzt fehlende Istwerte aus PV-String-Archiven, sofern ein echter historischer Prognosewert vorhanden ist.
- Fehlende historische Prognosen werden nicht aus aktuellen Forecasts rekonstruiert.
- pvnode String-Index-Zuordnung aus v1.9.97 bleibt erhalten.

# SmartBatteryOptimizer v1.9.97 / Build 168

- pvnode Flächenzuordnung verwendet jetzt direkt `string_index` aus `strings[]`.
- Bestehende Konfigurationswerte 0/1 bleiben erhalten; interner Property-Name wird aus Kompatibilitätsgründen nicht geändert.
- Konfigurationsspalte heißt jetzt „pvnode String-Index“.
- Index 0 und Index 1 werden aus dem getrennten pvnode-Stringcache ausgewertet und den konfigurierten PV-Flächen zugeordnet.
- `string_id` wird weiterhin intern gespeichert und im Debug zur Kontrolle zusammen mit dem Index ausgegeben.
- Keine Änderungen an Open-Meteo, Forecast.Solar, Einspeisestatistik oder sonstigen Diagrammen.

# SmartBatteryOptimizer v1.9.96 / Build 167

- Force-Refresh: pvnode verwendet jetzt tatsächlich den direkten Live-Abruf und umgeht den internen pvnode Cache, das Tageslimit und next_poll.
- pvnode Live-Antwort speichert stringHoursByID/stringIDsByIndex und wird danach den konfigurierten PV-Flächen über PVNodeStringID zugeordnet.
- PV-Kalibrierarchiv: keine zukünftigen Zeitstempel mehr an AC_AddLoggedValues.
- Laufende Prognosestunde wird nur einmal eingefroren; Zukunftsprognosen bleiben in der Prognosehistorie und werden erst bei Erreichen der Stunde archiviert.
- Zusätzlicher zentraler Schutz verwirft versehentliche zukünftige Archivwerte.
- Einspeise-Statistik bleibt unverändert mit Grün #38a169 und schmaler gelber Erlösüberlagerung.

# SmartBatteryOptimizer v1.9.95 / Build 166

- Einspeise-Statistik: Grün wieder exakt #38a169 wie im Diagramm Einspeisevergütung.
- Schmale gelbe Erlösüberlagerungen bleiben unverändert.
- Neuer Konfigurationsbutton „Alle Prognoseanbieter jetzt abfragen (Force-Refresh)“.
- Force-Refresh umgeht die internen Cache-, Tageslimit- und Retry-Sperren des Moduls für die aktivierten Prognoseanbieter.
- Erfolgreiche Live-Antworten werden als aktuelle Prognosedaten übernommen und die abhängigen Anzeigen/Planung neu berechnet.
- Externe serverseitige Provider-Limits können nicht umgangen werden und werden als Fehler/Debug protokolliert.

# SmartBatteryOptimizer v1.9.94 / Build 165

- Einspeise-Statistik: Automatik-Grün auf Highcharts-Grün #50B432 angepasst.
- Gelbe Erlösüberlagerungen schmäler und weiterhin mittig auf dem jeweiligen Hauptbalken.
- Wochenansicht: Hauptbalken 54 px, Erlösüberlagerung 30 px.
- Monatsansicht: Hauptbalken unverändert 12 px, Erlösüberlagerung 7 px.
- Änderungen ausschließlich im Renderer der Einspeise-Statistik.

# SmartBatteryOptimizer v1.9.93 / Build 164

- Reparatur auf Basis v1.9.91.
- Änderungen ausschließlich an der Einspeise-Statistik.
- Bestehende Highcharts/Ist-Überlagerungen außerhalb dieser Statistik unverändert.
- Blau: Highcharts-Standardfarbe; Grün: #38a169; beide Erlöse: rgba(255,213,79,.38).

# SmartBatteryOptimizer v1.9.91 / Build 162

- Einspeise-Statistik: Blau = Einspeisung außerhalb der Automatik.
- Grün = Einspeisung während der Automatik.
- Beide Erlösreihen gelb-transparent und exakt über dem jeweils zugehörigen kWh-Balken.
- Wochenansicht mit deutlich breiteren Balken.
- Tooltip, Legende und Zusammenfassung angepasst.

# SmartBatteryOptimizer 1.9.91 / Build 162

- Einspeise-Statistik kann zwischen Wochen- und Monatsansicht umgeschaltet werden.
- Wochenansicht zeigt Montag bis Sonntag mit Tageswerten und breiteren Balken.
- Navigation wechselt abhängig von der Ansicht wochen- bzw. monatsweise; Heute springt in den aktuellen Zeitraum.
- Auswahl Woche/Monat wird in der Visualisierung gespeichert.
- Summenzeile und Zeitraumüberschrift passen sich der gewählten Ansicht an.

# SmartBatteryOptimizer v1.9.89 / Build 160

- pvnode-Flächenzuordnung auf stabile `string_id` umgestellt.
- Neues Feld `pvnode string_id` je PV-Fläche.
- Korrekte 15-Minuten-Energieintegration aus `strings[].pv_power`.
- Gesamtprognose wird bei fehlendem `values[].pv_power` aus den Strings gebildet.
- `daily[].pv_energy_kwh` wird als Plausibilitätscheck protokolliert.
- Positionsfallback bleibt für bestehende Konfigurationen erhalten.

# SmartBatteryOptimizer v1.9.88 / Build 159

- Neuer Diagnose-Button **pvnode API testen – Rohdaten anzeigen**.
- Führt einen separaten Live-Abruf von `/v2/forecast/{site_id}?forecast_days=1&timezone=utc&include=strings` aus.
- Zeigt HTTP-Status, Response-Header, unveränderten Response-Body und eine kurze Strukturauswertung an.
- `values`, `strings`, `available`, `included`, `string_index` und `string_id` können damit direkt geprüft werden.
- Der API-Key wird in der Ausgabe nicht angezeigt.
- Der Test verändert weder pvnode-Prognosecache noch Abrufzähler, Tageslimit oder laufende Prognosedaten.

# SmartBatteryOptimizer v1.9.87 / Build 158

- Einspeiseautomatik bleibt energiegeführt: Abschluss nach tatsächlich gemessener Zielenergie in kWh; höhere reale Netzleistung verkürzt die Restzeit.
- Manueller Stop finalisiert einen laufenden Preis-Einspeisevorgang jetzt vor dem Zurücksetzen, damit kWh und Erlös erhalten bleiben.
- Eigenes einklappbares, scrollbar begrenztes Einspeise-Debugfenster mit Ereignissen der letzten 24 Stunden.
- Debug protokolliert Start, Zielmenge, Tarif, SoC, laufende Ist-/Restmenge, aktuelle Leistung, Restzeit, angepasstes Ende sowie Abschlussgrund, Dauer und Erlös.
- Fortlaufende Messung der gesamten realen Netzeinspeisung mit dem jeweils aktuellen Einspeisetarif.
- Einspeise-Statistik zeigt getrennt Automatik-Einspeisung und sonstige Netzeinspeisung samt getrenntem Erlös; Gesamtwerte werden im Tooltip und in der Monatssumme ausgewiesen.
- Bestehende PV-Prognose, saisonale Kalibrierung und Providerlogik bleiben unverändert.

# SmartBatteryOptimizer v1.9.86 / Build 157

- Berechneten Kalibrierfaktor während der Lernphase sichtbar gemacht.
- Anwendung weiterhin erst nach vollständigem Lernzeitraum.
- Zusätzliche Archivpunkte durch SetValue auf Prognose-Kalibriervariablen entfernt.

# SmartBatteryOptimizer v1.9.85 / Build 156

- pvnode-V2-Abfrage fordert jetzt die optionale Gruppe `strings` an.
- pvnode-Solarflächen werden aus `string_index`/`pv_power` getrennt zu Stundenwerten verarbeitet.
- Bei eindeutiger 1:1-Anzahl werden die pvnode-Flächen positionsstabil den aktiven SBO-PV-Flächen zugeordnet.
- Haus und Nebengebäude fließen damit getrennt in Anbieterübersicht, Provider-Mix und PV-Kalibrierprognose ein.
- Der pvnode-Cache enthält jetzt neben dem Standortgesamtwert auch die getrennten Flächenzeitreihen.
- Keine künstliche kWp-Aufteilung bei fehlenden oder nicht eindeutig zuordenbaren pvnode-Stringdaten.

# SmartBatteryOptimizer v1.9.84 / Build 155

- PV-Kalibrierarchiv korrigiert: gespeichert werden echte stündliche Prognoseenergien in kWh statt momentaner Leistungswerte.
- Prognosewerte werden direkt beim Aufbau der kombinierten Stundenprognose je PV-Fläche archiviert.
- Haus/Nebengebäude werden aus den vorhandenen Flächen- und String-Zuordnungen verwendet; keine doppelte Ist-Datenhaltung.
- Die laufende Prognosestunde wird beim ersten vorhandenen Wert eingefroren; vergangene Stunden werden durch spätere Forecast-Updates nicht verändert.
- Zukünftige Stunden werden bei einem neuen Forecast mit dem aktuellen Prognosestand ersetzt.
- Kalibrierung vergleicht nur Stunden, für die ein archivierter Prognose-kWh-Wert vorhanden ist, mit exakt demselben Ist-Zeitfenster aus den PV-String-Archiven.
- Gesperrte Kalibrierintervalle bleiben ausgeschlossen.
- Fehlerhafte Prognose-Kalibrierdaten aus v1.9.83 werden beim Update einmalig verworfen und anschließend sauber neu aufgebaut.
- Saisonaler rollierender Auto-Faktor bleibt unverändert: bis zum vollständigen Lernzeitraum 1,000, danach innerhalb der konfigurierten Min-/Max-Grenzen.

# SmartBatteryOptimizer v1.9.83 / Build 154

- PV-Kalibrierung auf stündliche Energiepaare umgestellt.
- Prognose je PV-Fläche wird für die begonnene Stunde als kWh festgeschrieben und später nicht rückwirkend ersetzt.
- Ist-Energie wird nicht mehr in separaten Kalibrier-Istvariablen dupliziert, sondern direkt aus den in der PV-Fläche zugewiesenen PV-String-Variablen im IP-Symcon-Archiv berechnet.
- Das Modul aktiviert die Archivierung der zugewiesenen PV-String-Variablen automatisch, falls nötig.
- Gesperrte Kalibrierzeiträume werden stundenweise ausgeschlossen; übrige Stunden eines Tages bleiben nutzbar.
- Keine Stundenfaktoren mehr: die Prognose verwendet ausschließlich den rollierenden saisonalen PV-Auto-Faktor.
- Bis zum Erreichen des konfigurierten Lernzeitraums bleibt der Auto-Faktor 1,000; danach rollierende Neuberechnung, begrenzt durch die konfigurierten Min-/Max-Werte.
- Hinweistext zur Kalibrierdaten-Bereinigung angepasst.

# SmartBatteryOptimizer 1.9.82 / Build 153

## PV-Auto-Kalibrierung

- Stundenfaktoren werden nicht mehr für die PV-Prognose verwendet.
- Die Korrektur erfolgt wieder mit einem generellen Faktor je PV-Fläche; die Anzeige ordnet ihn der aktuellen Jahreszeit zu.
- Bis der konfigurierte Lernzeitraum erstmals vollständig mit gültigen Lerntagen erreicht ist, bleibt der Faktor exakt 1,000.
- Danach wird der Faktor rollierend aus den neuesten N gültigen Lerntagen berechnet: neuer Tag hinein, ältester Tag heraus.
- Rohfaktor = Summe Ist-Energie / Summe Prognose-vor-Auto über exakt dieses Fenster.
- Erst der fertige Rohfaktor wird auf die konfigurierten Min-/Max-Werte begrenzt (z. B. 0,75 bis 1,25).
- Änderungen am Lernzeitraum werden aus dem IP-Symcon-Archiv neu berechnet; vorhandene Archivdaten bleiben erhalten.
- Kalibriersperren/Abregelungszeiten bleiben ausgeschlossen.
- Die Diagnose zeigt keine Aktuell-/Nächste-Stundenfaktoren mehr.

# SmartBatteryOptimizer 1.9.81 / Build 152

## Verbindliche Einspeiseplanung

- Ein einmal geplanter zukünftiger Einspeiseslot bleibt bis zur Ausführung verbindlich.
- Normale Prognose- und Plan-Neuberechnungen dürfen bereits veröffentlichte offene Einspeisefenster nicht mehr entfernen oder zeitlich verschieben.
- Für jeden geplanten Slot wird der erwartete Batterie-SoC am Startzeitpunkt gespeichert.

## SoC-Prüfung beim Start

- Liegt der reale SoC beim Start höchstens 5 Prozentpunkte unter dem erwarteten SoC, wird die geplante Einspeisemenge unverändert ausgeführt.
- Liegt der reale SoC mehr als 5 Prozentpunkte darunter, wird die geplante Einspeisemenge um die zur SoC-Abweichung passende Batterieenergie reduziert.
- Beispiel: erwartet 80 %, tatsächlich 70 % -> Einspeisung findet weiterhin statt, die Zielenergie wird aber reduziert.
- Ein höherer SoC als erwartet erhöht die ursprünglich geplante Einspeisemenge nicht.
- Mindest-SoC, Mindestpreis-Einspeisesperre und technische Schutzbedingungen bleiben vorrangig.

## Diagnose

- Der Start protokolliert erwarteten und tatsächlichen SoC.
- Eine Mengenanpassung wird mit ursprünglicher und neuer Zielenergie im Debug protokolliert.

# SmartBatteryOptimizer 1.9.80 / Build 151

## Open-Meteo Stundenlage korrigiert

- `global_tilted_irradiance` von Open-Meteo ist ein Mittelwert der **vorhergehenden Stunde**. Der API-Zeitstempel kennzeichnet damit das Intervallende.
- Open-Meteo wird nun bereits beim Einlesen zentral auf den **Beginn des Stundenintervalls** normalisiert (`API-Zeitstempel - 1 Stunde`).
- Die korrigierte Zeitbasis gilt dadurch gleichzeitig für Provider-Debuglinie, Quellengewichtung, kombinierte PV-Prognose und PV-Kalibrierung.
- Vorhandene Kalibrierdaten werden beim Update übernommen. Bei Installationen mit dem Archivspeicher aus 1.9.79 wird die Prognose-Zeitreihe einmalig aus der JSON-Sicherheitskopie mit korrigierter Stundenlage neu aufgebaut; die gemessene Ist-Zeitreihe bleibt zeitlich unverändert.
- Gespeicherte Open-Meteo-Quellenhistorie wird ebenfalls einmalig um eine Stunde auf den Intervallbeginn verschoben. Die Provider-Gewichtung startet anschließend neu, damit keine Vergleiche aus der alten Zeitbasis weiterwirken.

## Schrift auf iPhone/iPad

- HTMLBoxen und Highcharts verwenden jetzt durchgängig den Font-Stack `Tahoma, Arial, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif`.
- Windows verwendet weiterhin bevorzugt Tahoma. Auf iPhone/iPad fällt die Darstellung automatisch auf eine native Apple-Systemschrift zurück, wenn Tahoma nicht installiert ist.

# SmartBatteryOptimizer 1.9.79 – Archivbasierter Datenspeicher

- PV-Kalibrierungs-Zeitreihen werden pro PV-Fläche in eigenen, archivierten IP-Symcon-Variablen gespeichert (Prognoseleistung und Istleistung).
- Einspeise-Statistik der Preisautomatik wird ebenfalls in archivierten Modulvariablen geführt.
- Bestehende Daten aus `PVCalibrationJSON` und `FeedInStatisticsJSON` werden beim ersten Start einmalig automatisch in das IP-Symcon Archiv übernommen.
- Bereits saisonal verdichtete PV-Lerndaten werden so migriert, dass Energieverhältnis, Stunden-/Saisonfaktoren und vorhandene Lerntage erhalten bleiben.
- Die bisherigen JSON-Daten bleiben nach der Migration als Sicherheitskopie/Kompatibilitätscache erhalten, sind aber nicht mehr die primäre Zeitreihenquelle.
- `PV-Kalibrierdaten löschen ...` bereinigt nun zusätzlich die archivierten Prognose-/Ist-Zeitreihen und reaggregiert sie.
- `PV-Kalibrierung zurücksetzen` löscht auch die archivierten PV-Lernzeitreihen; die Einspeise-Statistik bleibt erhalten.
- Neue Statusvariable `Archiv-Datenspeicher` zeigt, ob Archive Control aktiv ist und wie viele bestehende Datensätze bei der Migration übernommen wurden.

# SmartBatteryOptimizer 1.9.78 / Build 149

- PV-Kalibrierdaten werden jetzt ueber einen Popup-Dialog gezielt geloescht.
- Beim Klick auf **PV-Kalibrierdaten loeschen ...** werden Datum sowie Von-/Bis-Zeit direkt ausgewaehlt.
- Datum ist auf heute, Von auf 00:00 und Bis auf die aktuelle Uhrzeit vorbelegt.
- Die bisherigen dauerhaft sichtbaren Bereinigungsfelder wurden aus der Konfiguration entfernt.
- Erst der Dialog-Button **Loeschen** fuehrt die Bereinigung aus; anschliessend werden Gesamt- und Stundenfaktoren sofort neu berechnet.
- Die automatische Kalibriersperre bei Einspeisefaktor 0 % aus 1.9.77 bleibt unveraendert aktiv.
- Wiki und README aktualisiert.

# SmartBatteryOptimizer 1.9.77 / Build 148

- PV-Autokalibrierung wird automatisch gesperrt, sobald die konfigurierte Einspeisefaktor-Variable 0 % liefert.
- Die Sperre gilt sowohl fuer die zentrale Preisuntergrenze `Mindestpreis Einspeisung` als auch fuer manuell auf 0 % gesetzte Einspeisefreigaben.
- Beginn und Ende der Kalibriersperre werden protokolliert; beim Wiederfreigeben startet die Energieintegration neu, sodass kein Intervall ueber eine Sperrzeit hinweg gelernt wird.
- Bereits gespeicherte ungueltige PV-Kalibrierintervalle koennen ueber Datum/Von/Bis gezielt geloescht werden. Leeres Datum = heute; Standardzeit 10:00 bis 23:59.
- Nach einer Bereinigung werden Gesamt- und Stundenfaktoren sofort aus den verbleibenden gueltigen Intervallen neu berechnet.
- Wiki und Konfigurationsdokumentation aktualisiert.

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

# SmartBatteryOptimizer 1.9.75 / Build 146

- Einspeise-Statistik auf Monatsansicht mit Tageswerten umgestellt.
- Blaue Balken zeigen die tatsächlich gemessene Einspeisung der Einspeiseautomatik in kWh je Kalendertag.
- Transparente gelbe Balken zeigen den tatsächlich erzielten Erlös in Euro auf einer eigenen €-Achse.
- Mehrere Einspeisefenster eines Tages werden automatisch zusammengefasst.
- Tooltip zeigt Datum, Einspeisung, Erlös, energiegewichteten Durchschnittstarif, Anzahl der Einspeisefenster und geplante Energiemenge.
- Monatsnavigation ergänzt: ← Monat/Jahr → Heute; der aktuelle Monat wird mit „– Heute“ gekennzeichnet.
- Zusammenfassung unter dem Diagramm zeigt Monat, Jahr und Gesamt.
- Bestehende Statistik-Historie bleibt erhalten; PV-Abregelungsschutz bleibt vollständig von der Statistik ausgeschlossen.
- Wiki auf den Stand 1.9.75 aktualisiert.

# SmartBatteryOptimizer 1.9.74 / Build 145

- Einspeise-Statistik: Highcharts-Initialisierung auf den robusten Aufbau der bestehenden PV-/Lastprofil-Diagramme umgestellt.
- Chart-Container wird direkt an `Highcharts.chart()` übergeben und bei noch nicht vollständig aufgebauter HTMLBox kurz verzögert erneut initialisiert.
- Datenpunkte enthalten Tooltip-Daten direkt als `custom`-Werte.
- Bei einem JavaScript-/Highcharts-Laufzeitfehler wird die konkrete Fehlermeldung im Diagrammbereich angezeigt, statt eine leere Fläche zu hinterlassen.
- Statistik bleibt ausschließlich auf Preis-Einspeisefenster der Einspeiseautomatik beschränkt; PV-Abregelungsschutz bleibt ausgeschlossen.

# SmartBatteryOptimizer v1.9.73 / Build 144

- Einspeise-Statistik vollständig als Highcharts-Balkendiagramm aufgebaut; die bisherige Statistik-Tabelle wurde entfernt.
- Jeder Balken zeigt die tatsächlich gemessene Einspeiseenergie eines Preis-Einspeisefensters der Einspeiseautomatik. PV-Abregelungsschutz / Speicherfreihaltung bleibt ausgeschlossen.
- Tooltip ergänzt um Zeitraum, Ist-Einspeisung, geplante Energiemenge, Erlös und durchschnittlichen Tarif.
- Summen für Heute, Monat, Jahr und Gesamt stehen kompakt unter dem Diagramm.
- Verbrauchs-/Lastprofil-Diagramm: Summenzeile wie bei der PV-Prognose; Ist-Wert wird gelb hervorgehoben.
- Wiki auf den Stand von v1.9.73 nachgeführt.

# SmartBatteryOptimizer v1.9.72 / Build 143

- Einspeise-Statistik erfasst ausschließlich Preis-Einspeisefenster der Einspeiseautomatik.
- PV-Speicherfreihaltung / PV-Abregelungsschutz wird aus Statistik, Summen und Diagramm ausgeschlossen.
- Einspeise-Statistik enthält jetzt immer ein echtes Highcharts-Balkendiagramm, auch solange noch keine abgeschlossenen Einspeisefenster vorhanden sind.
- Balken zeigen die tatsächlich gemessene Netzeinspeisung je Einspeisefenster; Tooltip zeigt Zeitraum, kWh, Erlös und Tarif.
- Bestehende Statistikdaten werden bei der Anzeige nach dem Grund `price` gefiltert, damit frühere PV-Speicherfreihaltungs-Datensätze nicht einfließen.
- Wiki auf den aktuellen Stand der Einspeise-Statistik nachgeführt.

# SmartBatteryOptimizer v1.9.71 / Build 142

- Navigation in PV-Prognose und Lastprofil: `Heute` steht jetzt rechts neben dem rechten Pfeil; Datumsanzeige bleibt unverändert.
- Anbieterübersicht trägt einheitlich den Titel `PV-Prognose Anbieter`.
- pvnode wird in der Anbieterübersicht als Standort-Gesamtprognose gekennzeichnet, solange die pvnode-Site-API keine getrennten SBO-PV-Flächen liefert.
- Neue Einspeise-Statistik: tatsächlich gemessene Netzeinspeisung je abgeschlossenem geplantem Einspeisefenster, Erlös, Tarif sowie Summen für Heute/Monat/Jahr/Gesamt.
- Highcharts-Balkendiagramm für die Einspeisemengen der letzten 30 Tage; Tooltip zeigt kWh, Erlös und Tarif.
- Statistik verwendet die vorhandene Netzbezug/Netzeinspeisungsvariable und speichert abgeschlossene Einspeisefenster kompakt.

# v1.9.70 / Build 141

- Istwert-Aktualisierung der PV-Prognose- und Lastprofil-Diagramme wieder entkoppelt von der Berechnungssperre.
- Beide Diagramme werden im PV-Ist-Aktualisierungsintervall direkt aus Archivdaten neu aufgebaut.
- Heute-Schaltflaeche in beiden Diagrammen deutlich sichtbar und direkt anwählbar.
- Aufraeumungen aus v1.9.69 bleiben erhalten.

# SmartBatteryOptimizer 1.9.69

- Einspeiseautomatik: konfigurierte maximale Entladeleistung wird als Dispatch-Leistung gesetzt; Planung und 5-Minuten-Korrektur rechnen weiterhin mit der realistisch erwartbaren Netzeinspeisung und begrenzen diese auf die konfigurierte Leistung.
- Börsenpreis-Diagramm: Beschreibung gekürzt.
- Letzte Aktionen: HTMLBox, letzte 5 Einträge, neueste oben, persistent ein-/ausklappbar.
- PV-Prognose Anbieter: kompakte HTMLBox mit Anbieterprognosen für morgen, persistent ein-/ausklappbar.
- Prognose Provider Debug: Ein-/Ausklappzustand bleibt über HTML-Aktualisierungen erhalten.
- PV-Prognose- und Lastprofil-Diagramm: zusätzlicher Button „Heute“.
- Oberfläche neu sortiert: Diagramme zusammen, Debug-/Diagnose-HTMLBoxen ganz unten.

# SmartBatteryOptimizer v1.9.57 DIAG

- Reine Diagnose-Erweiterung auf Basis der v1.9.56 DIAG / ursprünglichen v1.9.48-Logik.
- PV-Kalibrierung in Einzelschritte instrumentiert: Attribute, Feed-In-Gate, jede PV-Fläche, Energiesamples, Diagnoseberechnung, Attribut-Schreibvorgänge und HTML-Rendering.
- Keine Änderung an Forecast-, Provider-, Cache- oder Berechnungslogik.

# SmartBatteryOptimizer 1.9.56 – Diagnoseversion

Basis ist die unveränderte Abruf- und Berechnungslogik von v1.9.48.

- Diagnosemarken vor und nach den wesentlichen Berechnungsschritten.
- Diagnosemarken unmittelbar vor und nach jedem Open-Meteo-, Forecast.Solar- und pvnode-Abruf.
- Der jeweils letzte Diagnoseschritt wird zusätzlich im Modulstatus angezeigt.
- Provider-Debug zeigt die Diagnosemarken als `DIAG`-Einträge, sofern Debug aktiviert ist.
- HTTP-Diagnose-Timeouts sind begrenzt, damit ein nicht antwortender Provider den Lauf nicht unbegrenzt blockiert.
- Keine pvnode-Limit-, Cache- oder Zeitplanlogik aus den Versionen nach v1.9.48 übernommen.

# v1.9.48 / Build 119

- Preisoptimierte Einspeiseplanung berücksichtigt nun das gelernte Lastprofil. Die erwartbare Netzeinspeisung wird aus Batterieleistung minus erwarteter Last berechnet und zusätzlich auf die konfigurierte Netzeinspeisegrenze begrenzt.
- Control-Timer auf 15 Sekunden verkürzt, damit geplante Startzeiten zuverlässiger getroffen werden.
- Während aktiver Einspeisung wird alle 5 Minuten aus Zielenergie minus tatsächlich gemessener Netzeinspeiseenergie die notwendige Restlaufzeit neu berechnet und das aktive Einspeisefenster angepasst.
- AlphaESS Dispatch Time wird nicht mehr als 120-s-Watchdog behandelt, sondern aus der berechneten Restlaufzeit plus 30 % Reserve gesetzt.
- AlphaESS-Schreibreihenfolge: Start -> Active Power -> Mode 2 -> SOC -> Dispatch Time, jeweils mit den bewährten Pausen.
- Der Diagnose-Test setzt ebenfalls Dispatch Time nach SOC.

Prüfung: PHP-Lint, JSON-Prüfung, Versions-/Build-Abgleich und ZIP-Struktur geprüft.

# v1.9.47 / Build 118

- Fälligen gespeicherten Einspeiseplan vor dem Abruf neuer Daten und einer Neuberechnung ausführen.
- Gleichzeitige Control-Aufrufe mit einer instanzbezogenen Sperre verhindern.
- AlphaESS: Watchdog-Time vorab setzen, danach Start, ActivePower, Mode und SOC mit jeweils 3 Sekunden Abstand entsprechend dem Diagnoseablauf schreiben. Der 120-Sekunden-Watchdog bleibt erhalten.
- Wenn keine gültige allgemeine Leistungsvariable, aber alle AlphaESS-Variablen vorhanden sind, AlphaESS automatisch als Steuerweg verwenden. Eine gültige allgemeine Leistungsvariable behält Vorrang im allgemeinen Modus.
- Ohne gültigen Steuerweg einen Fehler melden, statt Einspeisung aktiv zu melden.

Prüfung: Quelltext-Prüfungen der Aufrufreihenfolge, Sperrfreigabe, Zeitbedingung, Stop-Befehle und JSON-Dateien; ZIP-Integrität geprüft. Keine PHP-Laufzeit und keine Verbindung zur Anlage verfügbar. Der tatsächliche Gerätebetrieb ist noch nicht verifiziert.
