# Batterie und Einspeiseplanung

## Grundidee

Das Modul soll nicht einfach beim höchsten Preis den gesamten Speicher entladen. Zuerst wird Energie für Mindest-SoC, erwarteten Nachtverbrauch und Sicherheitsreserven zurückgehalten. Nur die darüber hinaus verfügbare Energie wird auf attraktive Preisfenster verteilt.

## Speicherkapazität

Nutzbare bzw. für die Berechnung anzusetzende Gesamtkapazität des Batteriespeichers in kWh.

## SoC Variable

Normale IP-Symcon-Variable mit dem aktuellen Ladezustand des Speichers in Prozent, z. B. 73,5 %.

## Mindest-SoC

Unter diesen Ladezustand soll die Optimierung den Speicher nicht gezielt entladen.

## Max. Einspeise-/Entladeleistung

Maximale Leistung in Watt, mit der das Modul eine geplante Batterieentladung ansetzen darf. Dieser Wert sollte die zulässige Dauerleistung des Speichers/Wechselrichters nicht überschreiten.

## Nachtverbrauch

Aus den Archivdaten der normalen IP-Symcon-Hausverbrauchsvariable wird geschätzt, wie viel Energie bis zum nächsten ausreichenden PV-Ertrag benötigt wird. Diese Energie wird vor der Börseneinspeisung reserviert.

## Sicherheitsaufschlag Nachtverbrauch

Erhöht die gelernte Nachtverbrauchsreserve.

Beispiel: gelernter Nachtverbrauch 4,0 kWh und Sicherheitsaufschlag 20 % ergibt 4,8 kWh Reserve.

## PV-Prognose morgen

Eine gute PV-Prognose erlaubt eher, am Vorabend mehr Batterieenergie zu verkaufen, weil der Speicher am Folgetag voraussichtlich wieder geladen werden kann. Eine schlechte Prognose führt zu mehr Reserve oder – je nach Einstellung – zu einer vollständigen Einspeisesperre.

## Mindest-Einspeisepreis

Unterhalb dieses effektiven Preises wird kein Einspeisefenster gewählt, selbst wenn es zu den teuersten Stunden des Tages gehört.
