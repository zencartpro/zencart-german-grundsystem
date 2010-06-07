<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
/**
 * defining language components for the page
 */
  define('SAVE_DATABASE_SETTINGS', 'Datenbankeinstellungen speichern');//this comes before TEXT_MAIN
  define('TEXT_MAIN',' Geben Sie hier bitte die Informationen zu Ihrer Datenbankanbindung ein. Tragen Sie auch hier bitte jede Option sorgfältig ein - anschließend klicken Sie auf <em>Datenbankeinstellungen speichern</em> und folgen den Anweisungen im nächsten Schritt.');
  define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Datenbankanbindung');
  define('DATABASE_INFORMATION', 'Datenbankinformationen');
  define('DATABASE_OPTIONAL_INFORMATION', 'Datenbank - OPTIONALE Einstellungen');
  define('DATABASE_OPTIONAL_INSTRUCTION', 'Wir empfehlen, diese Einstellungen so zu lassen wie sie sind, außer Sie haben einen bestimmten Grund Sie zu ändern.');
  define('DATABASE_TYPE', 'Datenbanktyp');
  define('DATABASE_TYPE_INSTRUCTION', 'Wählen Sie hier den Datenbanktyp aus, den Sie verwenden wollen.');

define('DATABASE_CHARSET', 'Database Character Set / Collation');
define('DATABASE_CHARSET_INSTRUCTION', 'Choose the database collation to be used.');
  
  define('DATABASE_HOST', 'Datenbank-Host');
  define('DATABASE_HOST_INSTRUCTION', 'Wie lautet der Hostname der Datenbank?<br>(z.B. \'sql.myserver.at\' oder \'192.168.0.1\' oder \'localhost\')');
  define('DATABASE_USERNAME', 'Datenbank Benutzername');
  define('DATABASE_USERNAME_INSTRUCTION', 'Wie lautet der Benutzername für den Datenbankzugriff (z.B. \'root\')?');
  define('DATABASE_PASSWORD', 'Datenbank Passwort');
  define('DATABASE_PASSWORD_INSTRUCTION', 'Wie lautet das Passwort für den Datenbankzugriff?');
  define('DATABASE_NAME', 'Name der Datenbank');
  define('DATABASE_NAME_INSTRUCTION', 'Geben Sie her den Namen der Datenbank an, die die Daten Ihres Zen Cart Shops beinhalten soll (z.B. \'zencart\')');
  define('DATABASE_PREFIX', 'Tabellenpräfix (Für Datenbank-Sharing)');
  define('DATABASE_PREFIX_INSTRUCTION', 'Wie soll das Tabellenpräfix lauten?  Dies ist zu empfehlen, wenn mehrere Programme auf die selbe Datenbank zugreifen. Beispiel: zen_<br /> Lassen Sie dieses Feld leer, wenn Sie kein Präfix verwenden möchten.');
  define('DATABASE_CREATE', 'Datenbank erstellen?');
  define('DATABASE_CREATE_INSTRUCTION', 'Möchten Sie, dass Zen Cart versucht, die Datenbank zu erstellen)<br>(Rechte für ROOT-Zugriff erforderlich!)');
  define('DATABASE_CONNECTION', 'Dauerhafte Datenbankverbindung');
  define('DATABASE_CONNECTION_INSTRUCTION', 'Möchten Sie die Option "Dauerhafte Datenbankverbindung" aktivieren?<br>(Wählen Sie \'NEIN\' wenn Sie sich nicht sicher sind)');
  define('DATABASE_SESSION', 'Datenbanksitzungen');
  define('DATABASE_SESSION_INSTRUCTION', 'Möchten Sie Sitzungen (Sessions) in Ihrer Datenbank speichern?<br>(Wählen Sie \'JA\' wenn Sie sich nicht sicher sind)');
  define('CACHE_TYPE', 'SQL Cache Methode');
  define('CACHE_TYPE_INSTRUCTION', 'Wählen Sie eine Methoden zum Zwischenspeichern (cachen) von SQL Abfragen.');
  define('SQL_CACHE', 'Sitzungs/SQL Cache Verzeichnis');
  define('SQL_CACHE_INSTRUCTION', 'Geben Sie das Verzeichnis zum dateibasierten Speichern von SQL Abfragen an.');
  define('ONLY_UPDATE_CONFIG_FILES','Nur Konfigurationsdateien aktualisieren');


  define('REASON_TABLE_ALREADY_EXISTS','Kann Tabelle %s nicht erzeugen, da sie bereits vorhanden ist');
  define('REASON_TABLE_DOESNT_EXIST','Kann Tabelle %s nicht löschen, da sie nicht vorhanden ist.');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','Kann den configuration_key "%s" nicht einfügen, da er bereits vorhanden ist.');
  define('REASON_COLUMN_ALREADY_EXISTS','Kann Spalte(Column) %s nicht hinzufügen, da sie bereits vorhanden ist.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','Kann Spalte(Column) %s nicht löschen, da sie nicht vorhanden ist.');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','Kann Spalte(Column) %s nicht ändern, da sie nicht vorhanden ist.');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','Kann prod-type-layout configuration_key "%s" nicht einfügen, da er bereits vorhanden ist.');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','Kann Index %s in Tabelle %s nicht löschen, da er nicht vorhanden ist.');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','Kann den primary key in Tabelle %s nicht löschen, da er nicht vorhanden ist.');
  define('REASON_INDEX_ALREADY_EXISTS','Kann Index %s in Tabelle %s nicht anlegen, da er bereits vorhanden ist.');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','Kann den primary key in Tabelle %s nicht anlegen, da bereits ein primary_key vorhanden ist.');
  define('REASON_NO_PRIVILEGES','User %s@%s hat keine %s Rechte für diese Datenbank.');
