SALES REPORT
Version 2.0
By Frank Koehl (PM: BlindSide)

Sponsored by Destination ImagiNation, Inc.
www.destinationimagination.org

Color scheme and icons by Kim
www.templates-for-zen-cart.com

This script is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.

Released under the General Public License (see LICENSE.txt)

Always backup your files and database before making changes!



=====================================
  Find a bug?  Have a feature idea?
=====================================
LET ME KNOW!
All questions, comments, concerns, and wisecracks are welcome.

Zen Forum PM: BlindSide
Forum thread:
http://www.zen-cart.com/forum/showthread.php?p=253173#post253173

Bei Fragen zu deutschen Übersetzung bitte eine Mail an 
MaleBorg@gmx.de oder postet im Forum von www.zen-cart.at

===========
Einführung
===========

Dieser Verkaufsbericht bietet euch jede Menge Daten, die für den alltäglichen Bedarf sowie die 
weitere Planung des Verkaufs nützlich sind.

Der Verkaufsbericht kann dank einiger Einstellmöglichkeiten den Bedürfnissen angepasst werden und 
bietet ausserdem die Möglichkeit einer Voreinstellung.


==============
 INSTALLATION
==============

1. Downloaden der Erweiterung und entpacken.

2. OPTIONAL: Konfigurieren der Verkaufsbericht Voreinstellungen.
             Näheres unter REPORT DEFAULTS weiter unten.

3. Kopiert den kompletten ADMIN Ordner aus dem Verzeichnis Deutscher_Adminbereich in euren Zencart Ordner
   Es werden dabei keine Dateien überschrieben, abgesehen von einer älteren Sales Report Installation

   WICHTIG: Bitte nicht den Ordner English_Adminpanel in euren Zencart Order kopieren!


4. OPTIONAL:  Ändere admin/includes/general.js um eine Rollover Animation anzuzeigen.
              Näheres unter ROLLOVER weiter unten.

5. Das wars! Aufgerufen wird der Verkaufsbericht unter STASTISTIKEN --> VERKAUFSBERICHT




 REPORT DEFAULTS
-------------------
Der Verkaufsbericht bietet die Möglichkeit, stets wiederkehrende Berichte vorzukonfigurieren.
Bespielsweise ihr schaut regelmäßig nach den Verkäufen im aktuellen Monat, so könnt ihr dieses festlegen
ohne immer alles wieder neu einzustellen.


1. Öffnet die Datei admin/includes/languages/german/stats_sales_report.php
2. In Zeilen 23 - 148 könnt ihr eure Einstellungen treffen. Nähere Erklärungen über die
   verschiedenen Einstellungen findet ihr an Ort und Stelle.
3. Die veränderte Datei abspeichern und neu hochladen.


 ROLLOVER
------------
1. Öffnet die Datei admin/includes/general.js

2. Finde folgenden Eintrag:
        if (object.className == 'dataTableRow') object.className = 'dataTableRowOver';

3. Füge darunter folgende 2 Zeilen ein:
        if (object.className == 'totalRow') object.className = 'totalRowOver';
        if (object.className == 'lineItemRow') object.className = 'lineItemRowOver';

4. Finde folgenden Eintrag:
        if (object.className == 'dataTableRowOver') object.className = 'dataTableRow';

5. Füge darunter folgende 2 Zeilen ein:
        if (object.className == 'totalRowOver') object.className = 'totalRow';
        if (object.className == 'lineItemRowOver') object.className = 'lineItemRow';



============
 FEATURES
============

 Zeitraum
--------------
  - Auswahlmöglichkeit zwischen benutzerdefinierten und Praxisüblichen Zeiträumen
  - Der angegebene Zeitraum gilt für ...
        > das Bestelldatum
        > einen auszuwählenden Bestellstatus

 Filter
-----------
  - Bestellungen filtern nach Zahlungsmethode
  - Bestellungen filtern nach aktuellem Bestellstatus
  - Bestellungen filtern nach Herstellern


 Daten im Bericht
-----------------
  - Summen pro Zeitraum
  - Summen pro Zeitraum inkl Anzeige bestellter Produkte
  - Summen pro Zeitraum inkl Anzeige der einzelnen Bestellungen
  - Zeitraum Statistik Matrix

 Sortiermöglichkeiten
-----------------------
  - Gruppiere ausgewählte Zeiträume: Täglich, Wöchentlich, Monatlich, Jährlich
  - Zeiträume auf- oder absteigend sortiert

 Anzeige Format
------------------
  - Bildschirmausgabe
  - Druckausgabe
  - CSV Export

"Can I make a donation?"
-----
Absolutely, your support really does help!

PayPal donations can be directed to fkoehl@gmail.com.

//////////////////////////////////////////////////////////////////////////////////////
README version:
$Id: README.txt 95 2006-11-30 MaleBorg $