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
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
//  $Id: sqlpatch.php 4 2006-03-31 16:38:40Z hugo13 $
//
define('HEADING_TITLE', 'SQL Query Executor');
 define('HEADING_WARNING', 'Stellen Sie sicher, dass Sie VOR DEM AUSF&Uuml;HREN DIESES SCRIPTS eine VOLLST&Auml;NDIGE SICHERUNG IHRER DATENBANK erstellt haben!');
 define('HEADING_WARNING2', 'Wenn Sie 3rd-Party Kontributionen installieren, bedenken Sie bitte, dass Sie dies auf eigenen Gefahr machen.<br />Zen Cart&trade; gibt keine Garantie f&uuml;r die Sicherheit oder Funktion von 3rd-Party Kontributionen. Testen Sie die Kontributionen, bevor Sie diese auf eimen Live-System einsetzen!');
 define('TEXT_QUERY_RESULTS', 'Abfrageergebnisse:');
 define('TEXT_ENTER_QUERY_STRING', 'SQL-Befehl(e) ausf&uuml;hren:&nbsp;&nbsp;<br />(Abschliessen<br />mit ;)');
 define('TEXT_QUERY_FILENAME', '<br />oder Datei:');
 define('ERROR_NOTHING_TO_DO', 'Fehler: Kein SQL-Befehl bzw. keine Datei gew&auml;hlt.');
 define('TEXT_CLOSE_WINDOW', '<br />[ Fenster schliessen ]');
 define('SQLPATCH_HELP_TEXT', 'Das Tool "SQLPATCH" gibt Ihnen die M&ouml;glichkeit, SQL Codes direkt in das Textfeld einzugeben, ' .
     'oder eigene (.SQL) - Dateien hochzuladen.<br />' .
     'SQL Skripts f&uuml;r dieses Tool <strong>d&uuml;rfen kein</strong> Tabellen Pr&auml;fix enthalten z.B. "zen_", da das Pr&auml;fix automatisch ' .
     'f&uuml;r die verwendete Datenbank hinzugef&uuml;gt wird, basierend auf den Einstellungen in der Datei ' .
     'admin/includes/configure.php (DB_PREFIX Definition).<br /><br />' .
     'Es werden nur die folgenden SQL Befehle unterst&uuml;tzt (Bitte Gro&szlig;buchstaben verwenden):' .
     '<br /><ul><li>DROP TABLE IF EXISTS</li><li>CREATE TABLE</li><li>INSERT INTO</li><li>ALTER TABLE</li>' .
     '<li>UPDATE (just a single table)</li><li>DELETE FROM</li><li>DROP INDEX</li><li>CREATE INDEX</li>' .
     '<br /><li>SELECT </li></ul>' .
    '<h2>Erweiterte Funktionen</h2>Damit einzelne SQL Befehle in einem Block von MySQL ausgef&uuml;hrt werden, muss folgende Zeile am Beginn eines Blockes stehen "<code>#NEXT_X_ROWS_AS_ONE_COMMAND:xxx</code>".  Der Parser wird daraufhin die n&auml;chsten X Zeilen als einen Befehl interpretieren.<br />
Wird dieses Skript in phpMyAdmin od. anderen Programmen ausgef&uuml;hrt, so wird die Zeile "#NEXT..." ignoriert.<br />
<br /><strong>Anmerkung: </strong>SELECT.... FROM... und LEFT JOIN Befehle setzen voraus, dass "FROM" oder "LEFT JOIN" in einer eigenen Zeile stehen.<br /><br />
<em><strong>Examples:</strong></em>
<ul><li><code>#NEXT_X_ROWS_AS_ONE_COMMAND:4<br />
SET @t1=0;<br />
SELECT (@t1:=configuration_value) as t1 <br />
FROM configuration <br />
WHERE configuration_key = \'KEY_NAME_HERE\';<br />
UPDATE product_type_layout SET configuration_value = @t1 WHERE configuration_key = \'KEY_NAME_TO_CHECK_HERE\';<br />
DELETE FROM configuration WHERE configuration_key = \'KEY_NAME_HERE\';<br />&nbsp;</li>

<li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />
INSERT INTO tablename <br />
(col1, col2, col3, col4)<br />
SELECT col_a, col_b, col_3, col_4<br />
FROM table2;<br />&nbsp;</li>

<li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />
INSERT INTO table1 <br />
(col1, col2, col3, col4 )<br />
SELECT p.othercol_a, p.othercol_b, po.othercol_c, pm.othercol_d<br />
FROM table2 p, table3 pm<br />
LEFT JOIN othercol_f po<br />
ON p.othercol_f = po.othercol_f<br />
WHERE p.othercol_f = pm.othercol_f;</li>
</ul></code>');
 define('REASON_TABLE_ALREADY_EXISTS', 'Cannot create table %s because it already exists');
 define('REASON_TABLE_DOESNT_EXIST', 'Cannot drop table %s because it does not exist.');
 define('REASON_TABLE_NOT_FOUND', 'Cannot execute because table %s does not exist.');
 define('REASON_CONFIG_KEY_ALREADY_EXISTS', 'Cannot insert configuration_key "%s" because it already exists');
 define('REASON_COLUMN_ALREADY_EXISTS', 'Cannot ADD column %s because it already exists.');
 define('REASON_COLUMN_DOESNT_EXIST_TO_DROP', 'Cannot DROP column %s because it does not exist.');
 define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE', 'Cannot CHANGE column %s because it does not exist.');
 define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS', 'Cannot insert prod-type-layout configuration_key "%s" because it already exists');
 define('REASON_INDEX_DOESNT_EXIST_TO_DROP', 'Cannot drop index %s on table %s because it does not exist.');
 define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP', 'Cannot drop primary key on table %s because it does not exist.');
 define('REASON_INDEX_ALREADY_EXISTS', 'Cannot add index %s to table %s because it already exists.');
 define('REASON_PRIMARY_KEY_ALREADY_EXISTS', 'Cannot add primary key to table %s because a primary key already exists.');
 define('REASON_NO_PRIVILEGES', 'User ' . DB_SERVER_USERNAME . '@' . DB_SERVER . ' does not have %s privileges to database ' . DB_DATABASE . '.');


?>
