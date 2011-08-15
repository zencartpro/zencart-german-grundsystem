<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
/**
 * defining language components for the page
 */
  define('TEXT_PAGE_HEADING', 'Zen Cart Setup - Datenbankupdate');
  define('UPDATE_DATABASE_NOW','Datenbank jetzt updaten');//this comes before TEXT_MAIN

  define('TEXT_MAIN', '<em>WARNUNG: </em> Dieses Update ist nur für Aktualisierungen innerhalb des Datenbankschemas für die angeführten Versionen.<br /><br /><span class="emphasis"><strong>Es ist SEHR EMPFEHLENSWERT, VOR der Aktualisierung eine Sicherung der Datenbank durchzuführen!</strong></span>');
  define('TEXT_MAIN_2','<span class="emphasis">Überprüfen Sie sorgfältig die nachstehenden Informationen, die aus der Datei "configure.php" ausgelesen wurden</span>.<br />Fahren Sie erst mit der Aktualisierung fort, wenn Sie alle notwendigen Einstellungen auf ihre Richtigkeit geprüft haben - Sie riskieren sonst eine Zerstörung der Datenbank.');

  define('DATABASE_INFORMATION', 'Datenbank Informationen');
  define('DATABASE_TYPE', 'Datenbank Typ');
  define('DATABASE_HOST', 'Datenbank Host');
  define('DATABASE_USERNAME', 'Datenbank Benutzername');
  define('DATABASE_PASSWORD', 'Datenbank Passwort');
  define('DATABASE_NAME', 'Name der Datenbank');
  define('DATABASE_PREFIX', 'Datenbank Präfix');
  define('DATABASE_PRIVILEGES', 'Datenbank Rechte');

  define('SNIFFER_PREDICTS','<em>Upgrade Sniffer</em> Voraussage: ');
  define('CHOOSE_UPGRADES','Bitte wählen Sie Ihre bevorzugten Schritte der Aktualisierung');
  define('TITLE_DATABASE_PREFIX_CHANGE','Präfix der Datenbanktabelle ändern');
  define('ERROR_PREFIX_CHANGE_NEEDED','<span class="errors">Es konnten keine Zen Cart Tabellen in der Datenbank gefunden werden.<br />Haben Sie eventuell einen falschen Präfix angegeben?</span><br />Wenn sie das Problem nicht lösen können, vergleichen Sie bitte die Einstellungen Ihrer configure.php mit Ihrer aktuellen Datenbank.');
  define('TEXT_DATABASE_PREFIX_CHANGE','Wenn Sie das Präfix der Tabellen ändern wollen, geben Sie unten das neue Präfix ein. <span class="emphasis"><br />HINWEIS: Bitte stellen Sie sicher, dass das neue Präfix noch nicht in der Datenbank existiert</span>, da das Programm keine Überprüfung für doppelte Präfixe durchführt.');
  define('TEXT_DATABASE_PREFIX_CHANGE_WARNING','<span class="errors"><strong>WARNUNG: ÄNDERN SIE DAS PRÄFIX DER TABELLE ERST WENN SIE EINE SICHERUNG DER DATENBANK DURCHGEFüHRT HABEN. Bei einem Fehler während der Änderung müssen Sie ggf. eine Wiederherstellung der Datenbank durchführen.</strong></span>');
  define('DATABASE_OLD_PREFIX','Altes Tabellen Präfix');
  define('DATABASE_OLD_PREFIX_INSTRUCTION','Geben Sie bitte das alte Präfix ein');
  define('ENTRY_NEW_PREFIX','Neues Tabellen Präfix ');
  define('DATABASE_NEW_PREFIX_INSTRUCTION','Geben Sie bitte das neue Präfix ein');
  define('ENTRY_ADMIN_ID','Adminstrator Benutzername (vom Zen-Cart Adminbereich)');
  define('ENTRY_ADMIN_PASSWORD','Adminstrator Password (vom Zen-Cart Adminbereich)');
  define('ADMIN_PASSSWORD_INSTRUCTION','Ihr Adminstrator Benutzername und Passwort, welche Sie zum Anmelden im Zen-Cart Adminbereich benutzen, werden benötigt, um die Änderungen an der Datenbank vorzunehmen. <em>(Dieses ist NICHT Ihr MYSQL Passwort)</em>');
  define('TITLE_SECURITY','Datenbank Sicherheit');

  define('UPDATE_DATABASE_WARNING_DO_NOT_INTERRUPT','<span class="emphasis">Bitte unterbrechen Sie die Prozedur KEINESFALLS, nachdem Sie auf den unten stehenden Button geklickt haben!!! Bitte warten Sie, bis die Aktualisierung abgeschlossen ist.</span><br />');
  define('SKIP_UPDATES','Updates abgeschlossen');


  define('REASON_TABLE_ALREADY_EXISTS','Kann Tabelle %s nicht erzeugen, da sie bereits vorhanden ist.');
  define('REASON_TABLE_DOESNT_EXIST','Kann Tabelle %s nicht löschen, da sie nicht vorhanden ist.');
  define('REASON_TABLE_NOT_FOUND', 'Kann Tabelle %s nicht verändern, einfügen oder ersetzen, da sie nicht vorhanden ist.');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','Kann configuration_key "%s" nicht hinzufügen, da er bereits vorhanden ist.');
  define('REASON_COLUMN_ALREADY_EXISTS','Kann Spalte (Column) %s nicht hinzufügen, da sie bereits vorhanden ist.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','Kann Spalte(Column) %s nicht löschen, da sie nicht vorhanden ist.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','Kann Spalte(Column) %s nicht ändern, da sie nicht vorhanden ist.');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','Kann prod-type-layout configuration_key "%s" nicht einfügen, da er bereits vorhanden ist.');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','Kann Index %s in Tabelle %s nicht löschen, da er nicht vorhanden ist.');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','Kann den primary key in Tabelle %s nicht löschen, da er nicht vorhanden ist.');
  define('REASON_INDEX_ALREADY_EXISTS','Kann Index %s in Tabelle %s nicht hinzufügen, da er bereits vorhanden ist.');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','Kann den primary key in Tabelle %s nicht hinzufügen, da bereits ein primary key vorhanden ist.');
  define('REASON_NO_PRIVILEGES','User %s@%s hat keine %s Rechte für die Datenbank.');
  define('REASON_CONFIGURATION_GROUP_KEY_ALREADY_EXISTS','Kann configuration_group_title "%s" nicht hinzufügen, da er bereits vorhanden ist.');
  define('REASON_CONFIGURATION_GROUP_ID_ALREADY_EXISTS','Kann configuration_group_id "%s" nicht hinzufügen, da er bereits vorhanden ist.');
