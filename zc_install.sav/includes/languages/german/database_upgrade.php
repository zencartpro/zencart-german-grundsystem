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
define('PAGE_HEADING', 'Zen Cart Setup - Datenbankupdate');
define('UPDATE_DATABASE_NOW','Datenbank jetzt updaten');//this comes before TEXT_MAIN

define('TEXT_MAIN', '<em>Warnung: </em> Dieses Update ist nur f&uuml;r Aktualisierungen innerhalb des Datenbankschemas f&uuml;r die angef&uuml;hrten Versionen.<br /><br />
                         <span class="emphasis"><strong>Es ist SEHR EMPFEHLENSWERT, VOR der Aktualisierung eine Sicherung der Datenbank durchzuf&uuml;hren!</strong></span>');
define('TEXT_MAIN_2','<span class="emphasis">Überpr&uuml;fen Sie sorgf&auml;ltig die nachstehenden Informationen, die aus der Datei "configure.php" ausgelesen wurden</span>.<br />' .
                      'Fahren Sie erst mit der Aktualisierung fort, wenn Sie alle notwendigen Einstellungen auf ihre Richtigkeit gepr&uuml;ft haben - Sie riskieren sonst eine Zerst&ouml;rung der Datenbank.');

define('DATABASE_INFORMATION', 'Database Information');
  define('DATABASE_TYPE', 'Database Type');
  define('DATABASE_HOST', 'Database Host');
define('DATABASE_USERNAME', 'Datenbank Benutzername');
define('DATABASE_PASSWORD', 'Datenbank Passwort');
define('DATABASE_NAME', 'Name der Datenbank');
define('DATABASE_PREFIX', 'Datenbank Pr&auml;fix');
  define('DATABASE_PRIVILEGES', 'Database Privileges');

define('SNIFFER_PREDICTS','<em>Upgrade Sniffer</em> Voraussage: ');
define('CHOOSE_UPGRADES','Bitte w&auml;hlen Sie Ihre bevorzugten Schritte der Aktualisierung');
define('TITLE_DATABASE_PREFIX_CHANGE','Pr&auml;fix der Datenbanktabelle &auml;ndern');
define('ERROR_PREFIX_CHANGE_NEEDED','<span class="errors">Es konnten keine Zen Cart Tabellen in der Datenbank gefunden werden.<br />Haben Sie eventuell einen falschen Pr&auml;fix angegeben?</span><br />Wenn sie das Problem nicht l&ouml;sen k&ouml;nnen, vergleichen Sie bitte die Einstellungen Ihrer configure.php mit Ihrer aktuellen Datenbank.');
define('TEXT_DATABASE_PREFIX_CHANGE','Wenn Sie das Pr&auml;fix der Tabellen &auml;ndern wollen, geben Sie unten das neue Pr&auml;fix ein. <span class="emphasis"><br />HINWEIS: Bitte stellen Sie sicher, dass das neue Pr&auml;fix noch nicht in der Datenbank existiert</span>, da das Programm keine Überpr&uuml;fung f&uuml;r doppelte Pr&auml;fixe durchf&uuml;hrt.');
define('TEXT_DATABASE_PREFIX_CHANGE_WARNING','<span class="errors"><strong>WARNUNG: ÄNDERN SIE DAS PRÄFIX DER TABELLE ERST WENN SIE EINE SICHERUNG DER DATENBANK DURCHGEFÜHRT HABEN. Bei einem Fehler w&auml;hrend der Änderung m&uuml;ssen Sie ggf. eine Wiederherstellung der Datenbank durchf&uuml;hren.</strong></span>');
define('DATABASE_OLD_PREFIX','Altes Tabellen-Pr&auml;fix');
define('DATABASE_OLD_PREFIX_INSTRUCTION','Geben Sie bitte das alte Pr&auml;fix ein');
define('ENTRY_NEW_PREFIX','Neues Tabellen-Pr&auml;fix ');
define('DATABASE_NEW_PREFIX_INSTRUCTION','Geben Sie bitte das neue Pr&auml;fix ein');
  define('ENTRY_ADMIN_ID','Admin Username (from Zen Cart Admin area)');
  define('ENTRY_ADMIN_PASSWORD','Password');
  define('ADMIN_PASSSWORD_INSTRUCTION','Your Administrator username/password (the one that you use to access your shop Admin area) are required in order to make database changes. <em>(This is NOT your MySQL password)</em>');
  define('TITLE_SECURITY','Database Security');

define('UPDATE_DATABASE_WARNING_DO_NOT_INTERRUPT','<span class="emphasis">Bitte unterbrechen Sie die Prozedur KEINESFALLS, nachdem Sie auf den unten stehenden Button geklickt haben!!! Bitte warten Sie, bis die Aktualisierung abgeschlossen ist.</span><br />');
  define('SKIP_UPDATES','Done with Updates');


  define('REASON_TABLE_ALREADY_EXISTS','Cannot create table %s because it already exists');
  define('REASON_TABLE_DOESNT_EXIST','Cannot drop table %s because it does not exist.');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','Cannot insert configuration_key "%s" because it already exists');
  define('REASON_COLUMN_ALREADY_EXISTS','Cannot ADD column %s because it already exists.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','Cannot DROP column %s because it does not exist.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','Cannot CHANGE column %s because it does not exist.');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','Cannot insert prod-type-layout configuration_key "%s" because it already exists');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','Cannot drop index %s on table %s because it does not exist.');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','Cannot drop primary key on table %s because it does not exist.');
  define('REASON_INDEX_ALREADY_EXISTS','Cannot add index %s to table %s because it already exists.');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','Cannot add primary key to table %s because a primary key already exists.');
  define('REASON_NO_PRIVILEGES','User %s@%s does not have %s privileges to database.');
  define('REASON_CONFIGURATION_GROUP_KEY_ALREADY_EXISTS','Cannot insert configuration_group_title "%s" because it already exists');
  define('REASON_CONFIGURATION_GROUP_ID_ALREADY_EXISTS','Cannot insert configuration_group_id "%s" because it already exists');

?>
