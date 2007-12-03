<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo                                         |
// | Date of Translation:  16.08.04                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
// $Id: database_setup.php 94 2006-09-18 18:42:45Z wflohr $
//
  
define('SAVE_DATABASE_SETTINGS', 'Datenbankeinstellungen speichern');//this comes before TEXT_MAIN
define('TEXT_MAIN',' Geben Sie hier bitte die Informationen zu Ihrer Datenbankanbindung ein. Tragen Sie auch hier bitte jede Option sorgf&auml;ltig ein - anschlie&szlig;end klicken Sie auf <em>Datenbankeinstellungen speichern</em> und folgen Sie den Anweisungen im n&auml;chsten Schritt.');
define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Datenbankanbindung');
define('DATABASE_INFORMATION', 'Datenbankinformationen');
define('DATABASE_TYPE', 'Datenbanktyp');
define('DATABASE_TYPE_INSTRUCTION', 'W&auml;hlen Sie hier den Datenbanktyp aus, den Sie verwenden wollen.');
define('DATABASE_HOST', 'Datenbank-Host');
define('DATABASE_HOST_INSTRUCTION', 'Wie lautet der Hostname der Datenbank?<br>(z.B. \'sql.myserver.at\' oder \'192.168.0.1\')');
define('DATABASE_USERNAME', 'Datenbank Benutzername');
define('DATABASE_USERNAME_INSTRUCTION', 'Wie lautet der Benutzername f&uuml;r den Datenbankzugriff (z.B. \'root\')?');
define('DATABASE_PASSWORD', 'Datenbank Passwort');
define('DATABASE_PASSWORD_INSTRUCTION', 'Wie lautet das Passwort f&uuml;r den Datenbankzugriff?');
define('DATABASE_NAME', 'Name der Datenbank');
define('DATABASE_NAME_INSTRUCTION', 'Geben Sie her den Namen der Datenbank an, die die Daten Ihres Zen Cart Shops beinhalten soll (z.B. \'zencart\')');
define('DATABASE_PREFIX', 'Tabellenpr&auml;fix (F&uuml;r Datenbank-Shareing)');
define('DATABASE_PREFIX_INSTRUCTION', 'Wie soll das Tabellenpr&auml;fix lauten?  Dies ist zu empfehlen, wenn mehrere Programme auf die selbe Datenbank zugreifen. Beispiel: zen_<br /> Lassen Sie dieses Feld leer, wenn Sie kein Pr&auml;fix verwenden m&ouml;chten.');
define('DATABASE_CREATE', 'Datenbank erstellen?');
define('DATABASE_CREATE_INSTRUCTION', 'M&ouml;chten Sie, dass Zen Cart versucht, die Datenbank zu erstellen)<br>(Rechte f&uuml;r ROOT-Zugriff erforderlich!)');
define('DATABASE_CONNECTION', 'Dauerhafte Datenbankverbindung');
define('DATABASE_CONNECTION_INSTRUCTION', 'M&ouml;chten Sie die Option "Dauerhafte Datenbankverbindung" aktivieren?<br>(W&auml;hlen Sie \'NEIN\' wenn Sie sich nicht sicher sind)');
define('DATABASE_SESSION', 'Datenbanksitzungen');
define('DATABASE_SESSION_INSTRUCTION', 'M&ouml;chten Sie Sitzungen in Ihrer Datenbank speichern?<br>(W&auml;hlen Sie \'JA\' wenn Sie sich nicht sicher sind)');
define('CACHE_TYPE', 'SQL Cache Methode');
define('CACHE_TYPE_INSTRUCTION', 'W&auml;hlen Sie eine Methoden zum Speichern von SQL Abfragen.');
define('SQL_CACHE', 'Sitzungs/SQL Cache Verzeichnis');
define('SQL_CACHE_INSTRUCTION', 'Geben Sie das Verzeichnis zum Datei-basierten Speichern von SQL Abfragen.');
define('ONLY_UPDATE_CONFIG_FILES','Nur Konfigurationsdateien aktualisieren');



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

?>
