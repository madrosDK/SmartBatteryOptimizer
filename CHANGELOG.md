## 1.10.59 / Build 230
- Der Wert `Autoladung Plausibilitätswert / feste Ladeleistung` wird nach erkannter Startflanke als konstante Fahrzeug-Ladeleistung verwendet. Nicht mehr die schwankende gemessene Zusatzlast bestimmt den Abzug.
- Neuer Parameter `Max. Energie pro Autoladung`, Standard 14,4 kWh. Pro erkanntem Ladevorgang wird höchstens diese Energiemenge als Fahrzeugladung aus dem Lastprofil herausgerechnet.
- Beispiel: 6,5 kW feste Ladeleistung und 14,4 kWh Maximalenergie ergeben maximal rund 133 Minuten anrechenbare Autoladung.
- Der orange Autolade-Anteil wird stundenweise mit der festen Ladeleistung verteilt; nur der verbleibende Verbrauch wird ins Lastprofil eingelernt.
- Mindestdauer (Standard 20 min), Archivsuche und separat schaltbare zukünftige Autolade-Erkennung bleiben erhalten.
- EV-Treffercache auf Version 12 angehoben, damit vorhandene Treffer mit der neuen festen Ladeleistung und Maximalenergie neu ausgewertet werden.
- Keine Preis-, PV-, Einspeise- oder Dispatch-Logik geändert.

## 1.10.58 / Build 229
- Neuer Parameter `Autoladung Mindestdauer`, Standard 20 Minuten. Eine erkannte Lastflanke wird nur als Fahrzeugladung übernommen, wenn die daraus verfolgte Hochlastphase mindestens so lange anhält. Kurze Lastspitzen werden dadurch verworfen.
- Die Mindestdauer gilt sowohl für die manuelle Archivsuche als auch für die automatische Erkennung neuer Ladevorgänge.
- Neuer Schalter `Zukünftige Autoladungen automatisch erkennen`. Er steuert ausschließlich die automatische Erkennung neuer Ladevorgänge; die manuelle Archivsuche bleibt immer verfügbar.
- Bereits per Archivsuche gespeicherte Ladeanteile bleiben auch bei ausgeschalteter Zukunftserkennung wirksam und werden weiterhin aus dem Lastprofil herausgerechnet sowie orange dargestellt.
- EV-Treffer-/Analysecache auf Version 11 angehoben, damit Änderungen der Mindestdauer sauber neu ausgewertet werden.
- Preis-, PV-, Einspeise-, Dispatch- und sonstige bestehende Logik unverändert.

## 1.10.57 / Build 228
- Autoladungs-Archivsuche nutzt gefundene Roh-Flanken jetzt direkt als Ladebeginn; die nachgelagerte Trefferentscheidung hängt nicht mehr von Minutenaggregaten ab.
- Nach einer Roh-Flanke wird Variable `HousePowerVariable` (z. B. #50354) ausschließlich in kleinen 15-Minuten-Rohwertblöcken vorwärts verfolgt, bis die Zusatzlast mindestens 60 s wieder nahe der vorherigen Grundlast liegt.
- Eindeutige Ladephasen werden nicht mehr durch starre Plateau-/Minutenbedingungen verworfen. Mehrstufige Starts bleiben ein gemeinsamer Ladevorgang.
- Erkannter Zusatzverbrauch wird weiterhin aus dem Lastprofil abgezogen und im historischen Diagramm orange dargestellt; das originale Archiv bleibt unverändert.
- EV-Treffercache auf Version 10 angehoben, damit frühere 0-Treffer neu ausgewertet werden.
- Preis-, PV-, Einspeise-, Dispatch- und sonstige funktionierende Logik unverändert.

## 1.10.56 / Build 227
- Autoladungs-Archivsuche prüft ausdrücklich die konfigurierte `HousePowerVariable` und zeigt deren ID im Suchstatus an; beim Nutzer ist dies Variable 50354.
- Kritischen Frühabbruch behoben: Die direkte Rohwertsuche läuft bei `Autoladungen im Archiv suchen` jetzt immer, auch wenn die 1-Minuten-Aggregation keine verwertbaren Punkte liefert.
- Rohwertsuche von Stundenblöcken mit 5.000er-Limit auf direkte 30-Minuten-Blöcke ohne künstliches 5.000er-Limit umgestellt; Sekundenflanken können dadurch nicht mehr durch eine Vorselektion oder Abfragelimitierung verloren gehen.
- Suchstatus zeigt zusätzlich gelesene Rohwerte und den größten tatsächlich im Archiv gesehenen Leistungsanstieg in kW.
- Lastprofil, Preis-, PV-, Einspeise- und Dispatch-Logik ansonsten unverändert.

## 1.10.55 / Build 226
- Autoladungs-Archivsuche entfernt die fehleranfällige Aggregat-Vorauswahl vollständig: jede Stunde wird einzeln als kleines Rohwertfenster geprüft.
- Direkte Startflanken von mindestens dem konfigurierten Mindestanstieg werden aus den originalen Werten erkannt, z. B. 1,27→7,32 kW, 1,99→7,24 kW und 1,80→7,30 kW innerhalb 1–2 s.
- Mehrstufige Ladebeginne wie 2,53→6,76→11,63 kW innerhalb weniger Sekunden werden als ein gemeinsamer Start zusammengeführt.
- Rohdaten werden weiterhin nur stundenweise (mit kurzer Überlappung) gelesen; es gibt keine Ganz-Tages-Rohwertabfrage und damit keinen Rückfall auf den früheren 32-MB-Speicherfehler.
- Suchstatus zeigt zusätzlich Zeitpunkt der zuletzt gefundenen Roh-Flanke.
- EV-Erkennungs-/Treffercache auf Version 9 angehoben; erkannter Ladeanteil wird weiterhin vollständig aus dem Lastprofil herausgerechnet und orange dargestellt.

## 1.10.54 / Build 225
- Autoladungs-Archivsuche erkennt Ladebeginn jetzt direkt aus den originalen Rohwerten: Stundenaggregate dienen nur zur Vorauswahl auffälliger Stunden; ausschließlich diese kleinen Zeitfenster werden roh gelesen.
- Dadurch wird ein realer Sprung wie ca. 1,25 kW auf 7,3–8,5 kW innerhalb weniger Sekunden direkt erkannt und nicht mehr von Minutenmitteln abhängig gemacht.
- Neue Diagnose in der Archivsuche: Anzahl gefundener `Roh-Flanken`.
- Erkannte Ladeanteile werden weiterhin separat gespeichert, orange dargestellt und vollständig aus dem Lernprofil herausgerechnet; das originale Verbrauchsarchiv bleibt unverändert.
- EV-Erkennungs-/Treffercache auf Version 8 angehoben.

# Changelog

## 1.10.53 (Build 224)
- Autolade-Erkennung vereinfacht und auf den real beobachteten Ladeanstieg ausgerichtet: Primärkriterium ist jetzt die zusätzliche Leistung gegenüber der unmittelbar vorherigen Grundlast.
- Neuer Wert `Autoladung typischer Ladeanstieg`, Standard 6,5 kW, plus `Toleranz typischer Ladeanstieg`, Standard ±2,0 kW. Damit wird z. B. der dokumentierte Sprung von ca. 1,2 kW auf 7,3–8,5 kW direkt als Ladebeginn bewertet.
- Min/Max innerhalb einer Minute werden für die Höhe der Startflanke verwendet, ohne eine bestimmte Reihenfolge von MinTime/MaxTime vorauszusetzen.
- Nach einer erkannten Startflanke wird die Ladephase bis zur Rückkehr Richtung Grundlast verfolgt. Starre Plateau-Quoten können einen ansonsten eindeutigen Ladevorgang nicht mehr nachträglich verwerfen.
- Erkannter Fahrzeug-Ladeanteil wird weiterhin zwingend aus dem Lastprofil herausgerechnet und im Verbrauchsdiagramm orange dargestellt; das originale Verbrauchsarchiv bleibt unverändert.
- Autoladungs-Erkennungscache und gespeicherte Treffer auf Version 7 angehoben. Außerdem Versionsfehler beim Lernen des Autolade-Musters behoben, sodass erkannte Archivtreffer künftig tatsächlich in das Muster einfließen.

# SmartBatteryOptimizer 1.10.52 / Build 223

- Autolade-Erkennung erkennt jetzt auch sehr schnelle Schaltflanken innerhalb einer einzigen Minute anhand der 1-Minuten-Aggregate `Min/Max` und `MinTime/MaxTime`. Damit wird z. B. ein Sprung von ca. 1,2 kW auf 7,3–8,5 kW innerhalb weniger Sekunden als Ladebeginn erkannt.
- Die Minutenaggregation dient nur zur Kandidatensuche. Für erkannte Kandidaten werden anschließend ausschließlich kleine Rohdatenfenster von jeweils ±5 Minuten um Start und Ende gelesen, um die tatsächliche Aufwärts- bzw. Abwärtsflanke sekundengenauer zu bestätigen. Es werden weiterhin keine kompletten Tages-Rohwertlisten geladen.
- Hochlast-Plateau und Rückkehr Richtung Grundlast bleiben Pflicht für historische Ladevorgänge; einzelne kurze Lastspitzen werden dadurch weiterhin nicht als Autoladung klassifiziert.
- Erkennungscache und gespeicherte Autoladungs-Treffer auf Version 6 angehoben, damit ältere Nicht-Treffer mit der neuen Flankenerkennung nicht wiederverwendet werden.
- Erkannter Ladeanteil wird weiterhin orange dargestellt und vollständig aus dem gelernten Lastprofil herausgerechnet; das originale Verbrauchsarchiv bleibt unverändert.
- Keine Preis-, PV-, Einspeise-, Dispatch- oder Statistiklogik geändert.

# SmartBatteryOptimizer 1.10.51 / Build 222

- Autolade-Erkennung grundlegend auf Lastmuster umgestellt: deutlicher kW-Anstieg gegen die vorherige Grundlast, mehrere Minuten Hochlast-Plateau und anschließender deutlicher Lastabfall.
- Neuer einstellbarer Parameter `Autoladung Mindestanstieg`, Standard 4,0 kW. Damit kann z. B. ein Anstieg von 3 kW Grundlast auf 8,5 kW sicher erkannt werden, obwohl die bisherige absolute Schwelle allein nicht ausreichte.
- Die bisherige 6,5-kW-Einstellung bleibt als Plausibilitätsgrenze für den Gesamtverbrauch erhalten, ist aber nicht mehr das primäre Startkriterium.
- Ladeende wird über Rückkehr Richtung Grundlast oder einen deutlichen Abfall gegenüber dem erkannten Lade-Plateau bestätigt. Kurze Schwankungen während des Ladens werden toleriert.
- Aus den im Archiv gefundenen Ladevorgängen wird ein robustes Muster aus typischer Zusatz-Ladeleistung, Dauer und Ladeenergie gelernt. Bei zukünftigen Erkennungen wird dieses Muster zusätzlich zur Anstieg/Plateau/Abfall-Logik verwendet.
- Das gelernte Muster ist nur eine Plausibilisierung und kein hartes Ausschlusskriterium; neue oder abweichende Ladevorgänge können weiterhin erkannt werden.
- Erkennungscache und gespeicherte Treffer auf Version 5 angehoben. Alte Fehlklassifikationen werden nach einem neuen Archiv-Suchlauf nicht weiterverwendet; vorhandene Verbrauchsarchive werden nicht verändert oder gelöscht.
- Orange Darstellung und Abzug aus dem Lastprofil bleiben auf den tatsächlich erkannten Zusatzanteil oberhalb der Grundlast begrenzt.
- Keine Preis-, PV-, Einspeise-, Dispatch- oder Statistiklogik geändert.

# SmartBatteryOptimizer 1.10.50 / Build 221

- Neuer separater Button `Autoladungen im Archiv suchen` für eine nachträgliche Suche in abgeschlossenen Verbrauchstagen.
- Neuer Parameter `Autoladung Archiv-Suchzeitraum`: 0 = gesamtes verfügbares Archiv, ansonsten die gewünschte Anzahl vergangener Tage.
- Die Suche verwendet die bereits konfigurierbare Schwelle `Autoladung erkennen ab Hausverbrauch` und bewertet jeden Tag mit der aktuell eingestellten kW-Grenze neu; alte Negativ-Cacheergebnisse werden dabei nicht übernommen.
- Eigener `EVArchiveSearchWorker` verarbeitet maximal zwei Tage pro Lauf und arbeitet unabhängig von Börsenpreis-, PV- und Lastprofil-Workern.
- Positive Treffer werden dauerhaft mit Tages-/Stundenanteilen und Sitzungsdetails gespeichert. Das originale IP-Symcon-Verbrauchsarchiv bleibt unverändert.
- Nach Abschluss wird das aktuelle Lastprofil-Lernfenster automatisch mit den neu gefundenen Ladeanteilen neu gelernt; Treffer außerhalb des Lernfensters bleiben für spätere Archiv-Neuberechnungen gespeichert.
- Suchstatus zeigt Fortschritt, Anzahl der Ladevorgänge, erkannte kWh sowie den letzten Fund.
- Gleichzeitiger Start von Lastprofil-Archiv-Neuberechnung und Autoladungs-Archivsuche wird verhindert, damit sich die beiden Archiv-Worker nicht gegenseitig belasten.
- Keine Preis-, PV-, Einspeise-, Dispatch-, Statistik- oder Archivdaten werden beim Update zurückgesetzt oder gelöscht.

# SmartBatteryOptimizer 1.10.49 / Build 220

- Autolade-Erkennung auf die tatsächliche Hausverbrauchsleistung umgestellt: Nicht mehr die Größe eines einzelnen Lastsprungs ist entscheidend, sondern ob der gemessene Verbrauch die konfigurierte kW-Schwelle erreicht.
- Neuer einstellbarer Wert `Autoladung erkennen ab Hausverbrauch` im Bereich `Eigenverbrauch lernen`, Standard 6,5 kW.
- Eine Hochlastphase muss mindestens fünf Minuten anliegen; kurze Unterschreitungen bis drei Minuten werden toleriert.
- Der Autolade-Anteil wird als Differenz zwischen gemessenem Verbrauch und der Median-Grundlast der 20 Minuten vor Ladebeginn berechnet. Nur dieser Zusatzanteil wird aus dem Lernprofil abgezogen und im Diagramm orange dargestellt.
- Die Plausibilitätsprüfung für die bekannte 14,4-kWh-Fahrzeugbatterie bleibt erhalten; erkannte Ladeenergie wird nicht in das normale Lastprofil eingelernt.
- Cache-Version der Autolade-Erkennung angehoben und um den konfigurierten kW-Schwellwert erweitert. Dadurch werden frühere `keine Autoladung erkannt`-Cacheeinträge nach dem Update nicht weiterverwendet.
- Keine Preis-, PV-, Einspeise-, Dispatch- oder sonstigen bestehenden Funktionspfade geändert. Keine Archive, Lernwerte, Statistiken oder Konfigurationen werden beim Update gelöscht.

# SmartBatteryOptimizer 1.10.48 / Build 219

- Lastprofil-Diagramm nicht mehr auf sechs Tage Vergangenheit begrenzt: Es kann jetzt über das konfigurierte Verbrauchs-Lernfenster (bis 90 Tage) zurückgeblättert werden; bei kürzerem Archiv beginnt die Anzeige am tatsächlich gelernten Archivbeginn.
- Autoladungen werden im Diagramm separat **orange** dargestellt. Der orange Ladeanteil wird ausschließlich aus dem Lernprofil herausgerechnet; das originale Verbrauchsarchiv bleibt unverändert.
- Die Autolade-Erkennung wurde für 1-Minuten-Aggregate robuster gemacht: Kandidaten werden mit Toleranz für Minutenmittel/wechselnde Grundlast erkannt und zusätzlich über Mindestdauer und plausible Energie der 14,4-kWh-Fahrzeugbatterie geprüft.
- Beim Abzug wird nicht mehr pauschal mit einer konstanten Ladeleistung gerechnet. Stattdessen wird der tatsächlich erkannte Zusatzanteil minutenweise gegen die Grundlast integriert und stündlich abgezogen.
- Das Diagramm zeigt als blaues `Gelerntes Lastprofil` jetzt das reine gelernte Grundprofil ohne Verbrauchs-Sicherheitsaufschlag. Der Sicherheitsaufschlag bleibt in Batterie-/Einspeiseplanung unverändert aktiv.
- Die Quellenzeile im Lastprofil-Diagramm folgt beim Blättern jetzt dem tatsächlich ausgewählten Kalendertag (Wochentag/Saison) statt statisch dem morgigen Profil.
- Wochentags-/Saisonprofile mit erst wenigen Vergleichstagen werden kontrolliert mit dem globalen Stundenprofil gemischt. Dadurch kann ein einzelner ungewöhnlicher Tag das Profil nicht mehr so stark verzerren; mit wachsender Datenbasis steigt das Gewicht des individuellen Wochentags automatisch.
- Historische Ist-Verbrauchswerte des Lastprofil-Diagramms werden ebenfalls über Archiv-Aggregate gelesen; dadurch bleibt die längere Historie speicherschonend und lädt keine kompletten hochfrequenten Tages-Rohwertlisten in PHP.
- Keine vorhandenen Archive, Lernwerte, Statistiken oder Konfigurationen werden beim Update gelöscht oder zurückgesetzt.

# SmartBatteryOptimizer 1.10.47 / Build 218

- Börsenpreis-Refresh entkoppelt: Preise und Börsenpreis-Diagramm werden am Beginn des regulären Rechenlaufs aktualisiert, bevor Nachtverbrauch oder Lastprofil-Lernen ausgeführt werden. Ein langsamer/fehlerhafter Lernlauf kann das Preisdiagramm damit nicht mehr blockieren.
- Nach einem Modulupdate wird ausschließlich ein eventuell durch einen früheren PHP-Fatalfehler zurückgebliebener `CalculationLockUntil` freigegeben; Lernwerte, Archive, Statistiken und Konfigurationen bleiben unverändert.
- Lastprofil-Archiv-Neuberechnung arbeitet ohne Rohwert-Vollabfragen: 24 Stundenwerte kommen aus Archiv-Stundenaggregaten, die Autolade-Erkennung verwendet 1-Minuten-Aggregate. Dadurch bleibt die Datenmenge pro Lerntag begrenzt.
- Der Archiv-Button führt keine synchrone Mehrtagesauswertung mehr aus. Neue Archivläufe beginnen beim jüngsten abgeschlossenen Tag und veröffentlichen bereits nach dem ersten gültigen Tag ein Zwischenprofil.
- Während eine Archiv-Neuberechnung läuft, startet der normale Refresh keinen parallelen Lastprofil-Komplettscan. Nur der Archiv-Worker liest die historischen Tage.
- Bestehende, bereits aktive Archiv-Neuberechnungen aus älteren Versionen werden weitergeführt; es werden keine Archiv- oder Lerndaten automatisch gelöscht.

# SmartBatteryOptimizer 1.10.46 / Build 217

- Lastprofil-Archiv-Neuberechnung speicherschonend gemacht: Rohwerte werden nicht mehr als kompletter Tages-/Randbereich auf einmal in den PHP-Speicher geladen.
- Stündliche Verbrauchsenergie wird bevorzugt aus den vorhandenen Stundenaggregaten des IP-Symcon-Archivs gelesen.
- Für die Autolade-Erkennung werden Rohwerte seitenweise mit begrenzter Datensatzanzahl gelesen und auf eine kompakte Minuten-Zeitreihe verdichtet; die Erkennung des plötzlichen >6,5-kW-Lastanstiegs bleibt erhalten.
- Der Lernpfad fällt nicht mehr auf die alte unbegrenzte Ganz-Tages-Rohwertabfrage zurück.
- Der laufende Archiv-Neuaufbau kann nach dem Update mit dem vorhandenen Zustand fortgesetzt werden; bestehende Archive, Lernwerte, Statistikdaten und Konfigurationen werden nicht gelöscht oder zurückgesetzt.
- Börsenpreis-, PV-, Planungs- und Diagramm-Aktualisierungsroutinen wurden nicht verändert. Durch das Entfernen des wiederkehrenden Speicher-Fatalfehlers werden die normalen Modul-Timer nicht mehr alle 5 Sekunden durch den Archiv-Worker abgebrochen.

## 1.10.45 (Build 216)
- Archiv-Neuberechnung des Lastprofils blockiert die regulären Modul-Timer nicht mehr.
- Archiv-Worker läuft nur noch in kurzen Blöcken mit 5 Sekunden Pause und gibt aktiven Preis-/PV-/Plan-Berechnungen Vorrang.
- Bestehende Preis-, Diagramm-, PV- und Planungslogik unverändert.

## 1.10.44 (Build 215)
- **Lastprofil-Neuberechnung sichtbar wirksam:** Beim Klick auf `Lastprofil neu berechnen (inkl. Archiv)` wird sofort aus den jüngsten abgeschlossenen Archivtagen ein echtes stündliches Startprofil erzeugt und gespeichert. Der vollständige Archivlauf erweitert dieses Profil anschließend blockweise.
- **Kein 45-kWh/24-Fallback trotz vorhandener Daten:** Falls die EV-bereinigte Detailauswertung eines Tages keine verwertbare Stundenkurve liefert, verwendet das Lernen für diesen Tag die bereits bewährte Stundenintegration aus dem Ist-Verbrauchsdiagramm.
- **Diagnose direkt im Diagramm:** Unter der Überschrift wird nun die aktuell verwendete Lastprofil-Quelle angezeigt, damit sofort erkennbar ist, ob Archivprofil, Startprofil oder Fallback aktiv ist.
- Keine anderen Funktionsbereiche geändert; bestehende Archive, Statistikwerte, Konfigurationen und Lernwerte werden beim Update nicht gelöscht oder zurückgesetzt.

## 1.10.43 (Build 214)
- **Lastprofil erweitert:** Eigenes 24-Stunden-Profil für jeden Wochentag statt nur eines gemeinsamen Stundenprofils.
- **Saisonabhängiges Lernen mit sanftem Verlauf:** Winter, Frühling, Sommer und Herbst werden als Stützprofile gelernt und per Cosinus-Interpolation weich ineinander überführt.
- **Archiv-Neuberechnung:** Neuer Button `Lastprofil neu berechnen (inkl. Archiv)` wertet alle verfügbaren abgeschlossenen Verbrauchstage rückwirkend aus. Die Verarbeitung erfolgt blockweise über den bestehenden Modul-Worker.
- **Autolade-Erkennung:** Plötzliche Zusatzlasten ab 6,5 kW mit mindestens fünf Minuten Dauer und plausibler Energie für die bekannte 14,4-kWh-Fahrzeugbatterie werden aus dem Grundlastprofil herausgerechnet. Archiv- und Istwerte bleiben unverändert.
- **Lastprofil zurücksetzen:** Neuer bestätigter Reset löscht ausschließlich intern gelernte Lastprofilwerte. Verbrauchsarchive und andere Modul-Daten werden nicht verändert.
- Das Lastprofil-Diagramm verwendet beim Blättern für jeden Tag das passende Wochentags-/Saisonprofil.
- Keine sonstigen Funktionsbereiche wurden geändert; insbesondere werden keine Daten bei Updates automatisch zurückgesetzt oder entfernt.

## 1.10.42 (Build 213)
- **Einspeise-Statistik um Tagesansicht erweitert:** Neben Woche und Monat steht jetzt `Tag` zur Verfügung.
- Die Tagesansicht zeigt 24 Stunden mit Einspeisung und Erlös je Stunde; Blau = außerhalb Automatik, Grün = während Automatik, gelbe Überlagerung = jeweiliger Erlös.
- Stundenwerte werden direkt aus Einspeise-kWh-/Netzleistungsarchiv und Preisarchiv gebildet und an Stunden-, Tarif- und Automatikgrenzen sauber aufgeteilt.
- Gewählte Ansicht und konkret gewählter Tag bleiben auch nach automatischen HTML-/Chart-Aktualisierungen erhalten.
- Ab dieser Version wird der einmalige Statistik-Reset aus v1.10.41 **nicht mehr aufgerufen**. Zukünftige Updates entfernen oder setzen keine Statistik-/Archivdaten automatisch zurück.

## 1.10.41 (Build 212)
- **Einspeise-Statistik einmalig ab Update-Tag neu gestartet:** Historische abgeleitete Statistikdaten vor dem heutigen Tag werden entfernt, damit Woche/Monat nicht mehr von alten fehlerhaften Werten beeinflusst werden.
- `GridExportDailyJSON` wird beim einmaligen Neustart geleert; die Statistik verwendet für den Neustart die realen Rohdaten aus Einspeise-kWh-Archiv und Preisarchiv.
- Historische interne Automatik-Archivpunkte (`FeedInArchive*`) vor heute werden entfernt; Automatikläufe des heutigen Tages bleiben erhalten.
- **Keine Roharchive werden gelöscht:** Netzeinspeisungs-kWh, Netzleistung, `CurrentPrice`, Verbrauch, PV-Daten und andere Benutzermesswerte bleiben vollständig erhalten.

## 1.10.40 (Build 211)
- Fix: Gezielte Archivimporte aktivieren das Logging der Zielvariable nur waehrend `AC_AddLoggedValues()` und stellen den vorherigen Zustand danach wieder her.
- Dadurch kann die Einspeisepreis-Zeitreihe trotz absichtlich deaktiviertem Auto-Logging rueckwirkend mit exakten Tarif-Startzeiten geschrieben werden.
- Die einmalige Preisarchiv-Ausrichtung aus v1.10.39 wird bei zuvor fehlgeschlagenem Import erneut ausgefuehrt.

## 1.10.39 (Build 210)
- **Preisarchiv auf Tarifzeiten ausgerichtet:** `Aktueller Einspeisepreis` wird im Archiv nicht mehr mit zufälligen Refresh-/Timerzeitpunkten protokolliert, sondern mit dem tatsächlichen Beginn des Tarifintervalls. Bei EPEX 60 min sind das volle Stunden (`HH:00:00`).
- Beim ersten erfolgreichen Lauf wird der von `PricesJSON` noch bekannte historische Zeitraum einmalig bereinigt und mit den dort vorhandenen Preisen rückwirkend auf den korrekten Gültigkeitszeiten neu aufgebaut. Ältere Zeiträume ohne bekannte Preise bleiben unangetastet.
- Das automatische Archive-Control-Logging von `CurrentPrice` ist deaktiviert; die Modulvariable zeigt live weiterhin den aktuellen Tarif, die Historie wird gezielt über `AC_AddLoggedValues` gepflegt.
- Bei späteren Preisupdates werden fehlende bzw. geänderte Tarifpunkte idempotent am korrekten Startzeitpunkt ergänzt/ersetzt. Einspeise-kWh-Archive und sonstige Messarchive werden dabei nicht verändert.

## 1.10.38 (Build 209)
- **Aktueller Einspeisepreis synchronisiert:** Beim Preis-Refresh wird das neue `PricesJSON` jetzt vor `CurrentPrice` gespeichert.
- Ein parallel laufender `ControlTimer` darf während einer aktiven Neuberechnung `CurrentPrice` nicht mehr aus einem noch alten Preisraster zurückschreiben. Dadurch verschwinden kurz aufeinanderfolgende Sprünge zwischen altem und neuem Stundenpreis.
- Keine vorhandenen Archivdaten werden gelöscht oder verändert.

## 1.10.37 (Build 208)

- Die Variable **Aktueller Einspeisepreis** wird nun zuverlässig aus dem geladenen Tarifraster aktualisiert, mit `ct/kWh`-Profil versehen und automatisch im IP-Symcon-Archiv protokolliert.
- Erlöse außerhalb der Einspeiseautomatik werden bei vorhandener kWh-Einspeisevariable bevorzugt direkt aus realen Energie-Zählerdifferenzen und dem zeitlich gültigen archivierten Einspeisetarif berechnet.
- Für historische Zeiträume ohne ausreichende Preis-Historie bleibt die bisherige Erlösbasis als Fallback erhalten; Archivdaten werden nicht gelöscht oder verändert.
- Die Einspeise-Statistik merkt sich neben Woche/Monat nun auch die konkret ausgewählte Kalenderwoche bzw. den ausgewählten Monat. Ein automatischer HTML-/Chart-Refresh springt dadurch nicht mehr auf die aktuelle Periode zurück.
- **Einspeise-Statistik** und **Verbrauch / gelerntes Lastprofil** zeigen zusätzlich `Aktualisiert: TT.MM.JJJJ HH:MM:SS`.

## 1.10.36 (Build 207)

- Die konfigurierte **Netzeinspeisung Energie (kWh)** wird jetzt nicht nur fuer die Tagesstatistik, sondern auch fuer **Tatsaechlich eingespeiste Menge aktuell** verwendet.
- Laufende Automatikfenster messen ihre reale Einspeisemenge damit direkt ueber Zaehlerdifferenzen; Tageszaehler-Resets werden beruecksichtigt.
- Ohne kWh-Variable bleibt die Netzleistungsvariable als Fallback erhalten.
- Die Archiv-Integration der Netzleistungsvariable begrenzt unplausibel lange Messluecken auf 180 Sekunden, damit ein alter Leistungswert nicht ueber Stunden fortgeschrieben wird.
- Keine Archivdaten werden geloescht oder veraendert.

## 1.10.35 (Build 206)

- Neue optionale Konfiguration **Netzeinspeisung Energie (kWh) – für Einspeise-Statistik**.
- Ist eine kWh-Energievariable gewählt, wird sie als maßgebliche Tages-Gesamteinspeisung verwendet; die bisherige Integration der Netzleistung in Watt bleibt nur noch Fallback.
- Kumulative Lebenszeitzähler und täglich zurückgesetzte kWh-Zähler werden unterstützt; positive Zählerdifferenzen werden tageweise ausgewertet, Zähler-Resets werden berücksichtigt.
- Die Archivierung der gewählten kWh-Variable wird beim Anwenden der Instanz automatisch aktiviert; vorhandene Archivdaten und Aggregationseinstellungen werden nicht gelöscht oder überschrieben.
- Steuerung, PV-Lernsperre und laufende Einspeisemessung verwenden weiterhin die bestehende Netzleistungsvariable; geändert wird ausschließlich die Datenquelle der Einspeise-Statistik.

## 1.10.34 (Build 205)

- Nacht-Einspeiseplanung korrigiert: Dispatch bleibt strikt auf `min(Netz-Ziel, Max. Einspeise-/Entladeleistung)` begrenzt.
- Der prognostizierte Eigenverbrauch wird nicht mehr auf den Dispatch aufgeschlagen.
- Für Mengen-/Dauerberechnung bleibt das volle Netz-Ziel erhalten, solange Netz-Ziel + Lastprofil innerhalb der WR-Maximalleistung liegen.
- Nur bei Überschreitung der WR-Maximalleistung wird die rechnerische Netzeinspeisung auf `WR-Maximum - prognostizierter Eigenverbrauch` reduziert.
- Beispiele: 10 kW Ziel + 5 kW Last + 20 kW WR => 10 kW Dispatch / 10 kW Rechenleistung; 20 kW Ziel + 5 kW Last + 20 kW WR => 20 kW Dispatch / 15 kW Rechenleistung.
- Der 500-W-Sicherheitsabstand bleibt ausschließlich Bestandteil des PV-/Netzlimit-Schutzes.
- Alte zukünftige Einspeisepläne werden einmalig verworfen und mit der korrigierten Leistungslogik neu aufgebaut; laufende Einspeisungen bleiben unangetastet.

## 1.10.33 (Build 204)

- Nacht-Einspeiseplanung trennt jetzt sauber zwischen **Netz-Ziel** und physischer **Max. Einspeise-/Entladeleistung**.
- `Maximale Netzeinspeisung` ist das gewünschte Netz-Ziel; der 500-W-Sicherheitsabstand wird bei der Preis-Einspeisung nicht abgezogen.
- Der erwartete Eigenverbrauch aus dem stündlichen Lastprofil wird zum benötigten Batterie-Dispatch addiert, solange die WR-/Batterie-Maximalleistung dies zulässt.
- Beispiel: 10 kW Netz-Ziel + 5 kW Last + 20 kW WR-Maximum => 15 kW Dispatch und 10 kW rechnerische Netzeinspeisung.
- Beispiel: 20 kW Netz-Ziel + 5 kW Last + 20 kW WR-Maximum => 20 kW Dispatch und 15 kW rechnerische Netzeinspeisung.
- Börsenpreis-Tooltip zeigt Netz-Ziel, WR-Dispatch, erwarteten Eigenverbrauch und rechnerische Netzeinspeisung getrennt.
- Alte zukünftige Einspeisepläne werden einmalig verworfen und mit der neuen Leistungslogik neu aufgebaut; laufende Einspeisungen bleiben unangetastet.

## 1.10.32 (Build 203)

- Einspeise-Statistik: Tages-Gesamteinspeisung wird ausschließlich aus dem Archiv der konfigurierten Netzleistungsvariable zeitintegriert.
- Alte `GridExportDailyJSON`-kWh werden nicht mehr als Fallback oder bevorzugte kWh-Quelle verwendet.
- Automatik-kWh werden exakt einmal von der realen Tages-Gesamteinspeisung abgezogen.
- Historischer Erlös außerhalb der Automatik wird proportional auf die korrigierte kWh-Menge umgerechnet; der Automatik-Erlös bleibt unverändert.
- Keine Archivdaten werden gelöscht oder verändert; Woche/Monat, Tooltip, Farben und Layout bleiben unverändert.

## 1.10.31 (Build 202)
- Zu aggressive Laufzeitoptimierungen aus v1.10.30 zurückgenommen.
- Vollrefresh, Providerstatus, PV-/Verbrauchs-Istwerte und Einspeise-Statistik verwenden wieder die vollständigen, bewährten Aktualisierungspfade aus v1.10.29.
- Einspeise-Statistik liest beim vollständigen Rendern wieder das Netzarchiv; keine leeren Tageswerte nach Update/Neustart.
- PVActualTimer führt wieder den vollständigen Ist-/Plan-Aktualisierungspfad aus, damit Ist-Verbrauch und PV-Ist sofort konsistent bleiben.
- RefreshTimer verwendet wieder RecalculateInternal(false); notwendige Datenaufbereitung wird nicht mehr übersprungen.
- Beibehalten werden nur ergebnisneutrale RAM-Caches für bereits abgeschlossene PV- und Verbrauchstage, um wiederholte Archivabfragen zu reduzieren.
- Timerstruktur bleibt unverändert auf dem bewährten Stand mit unabhängigen Modul-Timern.

## 1.10.29 (Build 200)
- Timerstruktur vollständig auf den bewährten Stand aus v1.10.10/v1.10.18 zurückgestellt.
- `ControlTimer` läuft wieder unabhängig alle 15 Sekunden.
- `RefreshTimer`, `PVForecastTimer`, `PVActualTimer` und `PVCalibrationTimer` arbeiten wieder mit ihren eigenen konfigurierten Intervallen.
- Zentralen Scheduler aus den Zwischenversionen entfernt; Scheduler-Statusvariablen und Scheduler-Buffer werden beim Update bereinigt.
- Neuere fachliche Korrekturen (Provider-Caches, Forecast.Solar-Plausibilisierung, Einspeise-Statistik, Archivierung und Planlogik) bleiben erhalten.

## 1.10.28 (Build 199)

## 1.10.26 (Build 197)
- Zentraler Scheduler bereinigt: ein periodischer 15-s-Taktgeber (`ControlTimer`) und ein One-Shot-Worker fuer langsame Aufgaben.
- Scheduler-Diagnose: `Scheduler letzter Lauf`, `Scheduler Zähler` und `Scheduler Status` mit den naechsten Faelligkeiten.
- Scheduler-Faelligkeitspruefung wird auch bei Bestandsinstanzen mit altem `SBO_Control()`-Timer-Callback ausgefuehrt.
- Falsche Manipulation von Modul-Timern ueber `IPS_SetEventScript()` entfernt; Modul-Timer werden nur noch ueber `RegisterTimer()`/`SetTimerInterval()` behandelt.
- Alte Watchdog-Statusvariablen werden entfernt.
- Das veraltete externe PHP-Skript `SmartBatteryOptimizer Scheduler` wird, sofern eindeutig zu dieser Instanz gehoerig, deaktiviert und in den IP-Symcon-deleted-Bereich verschoben.

## 1.10.25 (Build 196)
- Ein zentraler interner Scheduler laeuft alle 15 Sekunden und prueft Steuerung, Preise/Plan, PV-Prognose, PV-Ist und PV-Kalibrierung.
- Der Scheduler bleibt kurz; langsame Prognose-/Preisarbeiten laufen ueber einen einmaligen internen Worker, damit Start/Stop weiterhin alle 15 Sekunden geprueft werden kann.
- Die bisherigen periodischen Einzel-Timer sind als Zeitgeber deaktiviert, um konkurrierende Laeufe zu vermeiden.
- Bestehende Instanzen bekommen Scheduler- und Worker-Callback bei ApplyChanges explizit gesetzt.

## 1.10.24 (Build 195)
- ControlTimer-Updatefix: bestehende Instanzen erhalten in ApplyChanges explizit wieder den bewaehrten Callback `SBO_Control($_IPS['TARGET']);` aus v1.10.18.
- ControlTimer bleibt fest auf 15 Sekunden.
- Irrefuehrende Watchdog-Diagnose entfernt; sie konnte manuelle Control()-Aufrufe nicht von echten Timer-Ticks unterscheiden.
- Alle fachlichen Aenderungen der neueren Versionen bleiben erhalten.

# SmartBatteryOptimizer v1.10.23

- ControlTimer-Callback auf den bewährten Aufruf `SBO_Control()` zurückgestellt. Bestehende IP-Symcon-Instanzen behalten ihren bereits registrierten Timer-Callback bei Updates; dadurch konnte die in v1.10.22 neu eingeführte `ControlTimerTick()`-Diagnose bei Bestandsinstanzen nicht greifen.
- Watchdog-Zeitstempel und Watchdog-Zähler werden jetzt direkt am Anfang von `Control()` und damit vor dem Semaphore aktualisiert. So misst die Diagnose echte Timer-/Control-Aufrufe auch auf bestehenden Instanzen.
- **Watchdog übersprungen** zählt weiterhin nur Aufrufe, die am Control-Semaphore scheitern.
- Interne Versionsstände `AppliedModuleVersion` und Datenexport auf 1.10.23 vereinheitlicht.

# SmartBatteryOptimizer v1.10.22

- Watchdog-Diagnose getrennt: `Watchdog Zähler` zählt jetzt echte 15-s-Timer-Ticks vor dem Control-Lock.
- Neue Variable `Watchdog übersprungen` zählt Timer-Ticks, bei denen `Control()` wegen eines laufenden vorherigen Durchgangs nicht starten konnte.
- ControlTimer ruft jetzt `ControlTimerTick()` auf; damit lässt sich Timerstillstand von blockierter Steuerlogik eindeutig unterscheiden.

# Changelog

## 1.10.21 (Build 192)

- Watchdog-Diagnose ergänzt: sichtbare Variablen **Watchdog letzter Lauf** und **Watchdog Zähler** werden bei jedem `ControlTimer`-Durchlauf aktualisiert.
- Bei aktiviertem Debug-Modus wird maximal einmal pro Minute ein Heartbeat `Watchdog aktiv – ControlTimer läuft (15 s).` in **Letzte Aktionen** protokolliert.
- Der bestehende `ControlTimer` bleibt unverändert auf 15 Sekunden.

## 1.10.20 (Build 191)

- Forecast.Solar: Cache-Zeitstempel wird nur noch nach echtem Live-Abruf erneuert; Cache-Lesen verlängert die Gültigkeit nicht mehr künstlich.
- Forecast.Solar: 0,00-kWh-Prognosen für morgen werden verworfen, wenn eine andere aktive Quelle gleichzeitig eine plausible positive Prognose liefert. Die verbleibenden Quellen werden automatisch neu gewichtet.
- Einspeise-Statistik: Tages-Gesamteinspeisung wird für alle angezeigten Tage direkt aus dem Archiv der konfigurierten Netzbezug-/Netzeinspeisungsvariable rekonstruiert. Alte fehlerhafte Tages-kWh werden dadurch beim Rendern ersetzt.
- Die konfigurierte Vorzeichen-Invertierung der Netzvariable wird auch bei der historischen Archivberechnung berücksichtigt.

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
