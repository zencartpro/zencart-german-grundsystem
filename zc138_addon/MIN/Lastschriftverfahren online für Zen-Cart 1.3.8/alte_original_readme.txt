***************************************************************************

  $Id: README 157 2005-04-07 20:33:35Z dogu $

  OSC German Banktransfer
  (http://www.oscommerce.com/community/contributions,826)

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

  Maintainer: Dominik Guder <osc@guder.org> (dogu)
  Extensioncode: Marcel Bossert-Schwab <info@opensourcecommerce.de> (mbs)


http://www.bundesbank.de/zahlungsverkehr/zahlungsverkehr_bankleitzahlen_download.php

--------
--------
ZEN CART
--------
--------

  Angepasst für Zen-Cart by MultimediArts www.zencart-hosting.de

  ein Großer Dank geht an Michael Kreutzer www.mickser.de
  für das Testen und letzte Änderungen.

	29.06.06 wflohr Fixes to run module with register_globals=off zencart (at) cyberflohrs (dot) de

***************************************************************************

Inhalt:
0.) Disclaimer (unbedingt lesen!!!)
1.) Übersicht
2.) Support und weitere Informationen:
3.) Installation
4.) Bankleitzahlenbestand in der DB speichern
5.) Faxbestätigung
6.) Konto-Daten in der E-Mail
7.) Löschen von Bestellungen
8.) Änderung der GermanBanktransfer Tabellennamen
9.) Erläuterungen zu den Fehlercodes

***************************************************************************

zum Upgrade von einer Version <= 0.91 auf 0.92 bitte unbedingt die Hinweise in der Datei
UPGRADE beachten

0.) Disclaimer

  Die Verwendung dieses Zahlungsmoduls erfolgt auf eigenes Risiko.

  Dieses Zahlungsmodul ist unter der GNU General Public License (GPL) veröffentlicht worden.
  Es kann demnach frei und kostenlos von jedermann genutzt werden.
  Gemäß Ziffer 11 und 12 der GPL wird keine Gewährleistung, weder ausdrücklich
  noch implizit, übernommen.


1.) Übersicht
  
  Benötigt wird mindestens PHP 4.3.4
  
  Dieses Paymentmodul ermöglicht das Lastschriftverfahren mit osCommerce MS2

  Beim Checkout kann der Kunde seine Kontodaten angeben, die geprüft und in der
  Datenbank gespeichert werden.
  Ferner kann er ein Dokument downloaden in dem er (offline) schriftlich seine Einwilligung gibt.
  Diese Funktion ist über Schalter einstellbar.

  Das Modul führt eine Plausibilitätsprüfung zwischen BLZ und Kto.Nr. durch.
  Es kann nicht garantieren, dass das angegebene Konto tatsächlich existiert,
  dass dieses Konto dem angegebenen Kontoinhaber zugeordnet ist und ob dieses Konto
  ausreichend Deckung aufweist.

  Die häufigsten Fehler (Zahlendreher, Verständnisprobleme bei der Übermittlung der
  Bankverbindung oder falschen Kundenangaben) können auf diese Art relativ zuverlässig
  vermieden werden.

  Nachdem die Prüfverfahren nicht immer 100%ig funktionieren, ist ein Mechanismus eingebaut,
  der nach eine Fehlermeldung und der (hoffentlich) erneuten Prüfung der Kontodaten durch
  den Kunden die Werte zulässt, auch wenn sie als falsch geprüft werden. Diese erhalten den
  Fehlercode 1 und die Meldung, dass die Kontonummer eine besondere Beobachtung benötigt.

  In Zukunft ist geplant, dass dieses Feature optional implementiert und verfeinert wird.

2.) Support und weitere Informationen:

  http://www.oscommerce.de -> Home von German BankTransfer
  http://www.bundesbank.de -> Zahlungsverker
  http://www.zahlungsverkersfragen.de

  Hinweise, Tipps und Anregungen oder Probleme jederzeit an osc@guder.org

3.) Installation:

  banktransfer_validation.php (classes) wird in /catalog/includes/classes/ kopiert
  blz.cvs (data) wird in /catalog/includes/data/ kopiert
  germanbanktransfer.php (modules) wird in /catalog/includes/modules/payment/ kopiert
  germanbanktransfer.php (languages) wird in /catalog/includes/languages/german/modules/payment/ kopiert

  !!! Bei den Admin-Dateien bitte die Sicherungskopie der alten Dateien nicht vergessen !!!
  !!! Sofern bereits Änderungen in der orders.php gemacht wurden, müssen die Änderungen von !!!
  !!! Hand übertragen werden. Marierung: // begin modification for german banktransfer !!!
  orders.php (admin) wird in /admin/ kopiert
  orders.php (languages) wird in /admin/includes/languages/german/ kopiert

  Das Modul wird über den Admin des Shops aktiviert:
  unter Module -> Zahlungsweise -> Lastschriftverfahren -> installieren.
  BankTransfer wird jetzt installiert, auch entsprechende Änderungen an der Datenbank werden
  automatisch vorgenommen.


4.) Bankleitzahlenbestand in der DB speichern:

  Seit der Version 0.84 ist es möglich, den Bankleitzahlenbestand in der Datenbank zu
  hinterlegen. Dazu müssen lediglich die beiden Dateien banktransfer_blz_split1.sql
  und banktransfer_blz_split2.sql in die catalog-DB (Tabelle 'banktransfer_blz') eingespielt 
  werden (phpMyAdmin). Dabei werden alle existierende Einträge in der Tabelle banktransfer_blz 
  gelöscht und neu angelegt.
  Danach kann im Admin zwischen File- und DB-basierter Abfrage der Bankleitzahl gewählt werden.


5.) Faxbestätigung:

  Im Admin muss der Dateiname der Faxbestätigung (muss sich im catalog-Verzeichnis befinden)
  definiert werden. Es kann entweder eine selbst entworfene html-Datei, oder die Faxvorlage aus
  dem Fax-Verzeichnis verwendet werden (s.u.).

  Faxvorlage:
    Im Verzeichnis 'fax' befindet sich eine Datei fax.html, die in das Catalog-Verzeichnis kopiert
    werden kann. Die Datei fax/images/einzug.gif wird für die Schattierung benötigt und muss in
    catalog/images abgelegt werden. Die Anpassung an den Shop muss in fax.html direkt durchgeführt
    werden.


6.) Konto-Daten in der E-Mail:

  Sicherhei:
  Beim Übertragen der Kontodaten in der Email ist zu bedenken, dass die Emails unverschlüsselt
  über das Internet verschickt werden.


  Da das zum einen dem Modul-Gedanken wiederspricht, und ich nicht davon ausgehen kann, dass das
  jeder möchte, muss das von jedem Selbst in der checkout_process.php geändert werden:

  in der checkout_process.php sind folgende folgende Zeilen für den Versand an den Shop-Admin zuständig:

// send emails to other people
  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }

  Diese können nach belieben ersetzt und erweitert werden:

// send emails to other people
  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
    if ($gbt_array['bt_fax'] != true) {
  		$email_order .= "Kontoinhaber: ". $gbt_array['bt_owner'] . "\n";
  		$email_order .= "BLZ:          ". $gbt_array['bt_blz'] . "\n";
  		$email_order .= "Konto:        ". $gbt_number . "\n";
  		$email_order .= "Bank:         ". $gbt_array['bt_bankname'] . "\n";

  		if ($gbt_array['bt_status'] == 0 || $gbt_array['bt_status'] == 2 || $gbt_array['bt_status'] == 3 || $gbt_array['bt_status'] == 4){
  			$email_order .= "Prüfstatus:   OK\n";
  		}else{
  			$email_order .= "Prüfstatus:   Es ist ein Problem aufgetreten, bitte beobachten!\n";
  		}
  	} else {
  	  $email_order .= "Kontodaten werden per Fax bestätigt!\n";
  	}
    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }

7.) Löschen von Bestellungen

    Um die Tabelle Banktransfer mit der Tabelle Orders konsistent zu halten wurde von mir
    in der Datei admin/orders.php folgender Löschbefehl mit eingefügt.
    Damit werden die Bestellungen nun auch in der Tabelle banktransfer gelöscht.

    ca. Zeile 74ff
        tep_remove_order($oID, $HTTP_POST_VARS['restock']);
        // begin modification for banktransfer
          tep_db_query("DELETE FROM banktransfer WHERE orders_id = '" . (int)$oID . "'");
        // end modification for banktransfer

8.) Änderung der GermanBanktransfer Tabellennamen

	Ab 0.92 ist es möglich die Tabellennamen für das Modul zu ändern.
	Dazu muss eine existierende Tabelle entsprechend umbenannt werden. 

	Für den Catalogbereich in /catalog/includes/modules/payment/germanbanktransfer.php
	Für den Admin Bereich in /admin/includes/languages/german/orders.php


9.) Erläuterungen zu den Fehlercodes:

  1 -> Kontonummer & BLZ passen nicht
    ---> kritischer Fehler
  2 -> Für diese Kontonummer ist kein Prüfziffernverfahren definiert
    ---> Unkritischer Fehler, Bank habe bei der Bundebank kein Prüfverfahren angemeldet
  3 -> Dieses Prüfziffernverfahren ist noch nicht implementiert
    ---> Bitte bei vermehrtem Auftreten eine email mit Kto-Nr., BLZ und Prüfverfahren an mich schicken (osc@guder.org)
  4 -> Diese Kontonummer ist technisch nicht prüfbar
    ---> Unkritischer Fehler, Kontonummer ist laut Spezifikation nicht prüfbar
  5 -> BLZ nicht gefunden eine email mit der BLZ an mich schicken (email siehe oben)
    ---> Bitte bei vermehrtem Auftreten
  8 -> Keine BLZ übergeben oder BLZ zu kurz
  9 -> Keine Kontonummer übergeben
