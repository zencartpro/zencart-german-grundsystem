<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: sqlpatch.php 4138 2006-08-14 05:56:44Z drbyte $
//
define('HEADING_TITLE', 'SQL Query Executor');
define('HEADING_WARNING', 'Stellen Sie sicher, dass Sie VOR DEM AUSF&Uuml;HREN DIESES SCRIPTS eine VOLLST&Auml;NDIGE SICHERUNG IHRER DATENBANK erstellt haben!');
define('HEADING_WARNING2', 'Wenn Sie 3rd-Party Kontributionen installieren, bedenken Sie bitte, dass Sie dies auf eigenen Gefahr machen.<br />Zen Cart&trade; gibt keine Garantie f&uuml;r die Sicherheit oder Funktion von 3rd-Party Kontributionen. Testen Sie die Kontributionen, bevor Sie diese auf eimen Live-System einsetzen!');
define('HEADING_WARNING_INSTALLSCRIPTS', 'HINWEIS: Zen Cart Datenbank-Upgrade Scripts sollen NICHT &uuml;ber diese Seite ausgef&uuml;hrt werden.<br />Bitte laden Sie den neuen <strong>zc_install</strong> Ordner hoch und f&uuml;hren das Update dort durch um ein besseres Ergebnis zu erzielen.');
define('TEXT_QUERY_RESULTS', 'Abfrageergebnisse:');
define('TEXT_ENTER_QUERY_STRING', 'SQL-Befehl(e) ausf&uuml;hren:&nbsp;&nbsp;<br />(Abschliessen<br />mit ;)');
define('TEXT_QUERY_FILENAME', '<br />oder Datei:');
define('ERROR_NOTHING_TO_DO', 'Fehler: Kein SQL-Befehl bzw. keine Datei gew&auml;hlt.');
define('TEXT_CLOSE_WINDOW', '<br />[ Fenster schliessen ]');
define('SQLPATCH_HELP_TEXT', 'Das Tool &quot;SQLPATCH&quot; gibt Ihnen die M&ouml;glichkeit, SQL Codes direkt in das Textfeld einzugeben, ' .
     'oder eigene (.SQL) - Dateien hochzuladen.<br />' .
     'SQL Skripts f&uuml;r dieses Tool <strong>d&uuml;rfen kein</strong> Tabellen Pr&auml;fix enthalten z.B. &quot;zen_&quot;, da das Pr&auml;fix automatisch ' .
     'f&uuml;r die verwendete Datenbank hinzugef&uuml;gt wird, basierend auf den Einstellungen in der Datei ' .
     'admin/includes/configure.php (DB_PREFIX Definition).<br /><br />' .
     'Es werden nur die folgenden SQL Befehle unterst&uuml;tzt (Bitte Gro&szlig;buchstaben verwenden):' .
     '<br /><ul><li>DROP TABLE IF EXISTS</li><li>CREATE TABLE</li><li>INSERT INTO</li><li>ALTER TABLE</li>' .
     '<li>UPDATE (just a single table)</li><li>DELETE FROM</li><li>DROP INDEX</li><li>CREATE INDEX</li>' .
     '<br /><li>SELECT </li></ul>' .
    '<h2>Erweiterte Funktionen</h2>Damit einzelne SQL Befehle in einem Block von MySQL ausgef&uuml;hrt werden, muss folgende Zeile am Beginn eines Blockes stehen &quot;<code>#NEXT_X_ROWS_AS_ONE_COMMAND:xxx</code>&quot;.  Der Parser wird daraufhin die n&auml;chsten X Zeilen als einen Befehl interpretieren.<br />
Wird dieses Skript in phpMyAdmin od. anderen Programmen ausgef&uuml;hrt, so wird die Zeile &quot;#NEXT...&quot; ignoriert.<br />
<br /><strong>Anmerkung: </strong>SELECT.... FROM... und LEFT JOIN Befehle setzen voraus, dass &quot;FROM&quot; oder &quot;LEFT JOIN&quot; in einer eigenen Zeile stehen.<br /><br />
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
define('REASON_TABLE_ALREADY_EXISTS', 'Tabelle(Table) %s kann nicht erstellt werden, da sie bereits vorhanden ist.');
define('REASON_TABLE_DOESNT_EXIST', 'Tabelle(Table) %s kann nicht gedroppt werden, da sie nicht vorhanden ist.');
define('REASON_TABLE_NOT_FOUND', 'Kann nicht ausgef&uuml;hrt werden, da Tabelle(Table) %s nicht vorhanden ist.');
define('REASON_CONFIG_KEY_ALREADY_EXISTS', 'Kann configuration_key &quot;%s&quot; nicht einf&uuml;gen, da er bereits vorhanden ist.');
define('REASON_COLUMN_ALREADY_EXISTS', 'Kann column %s nicht hinzuf&uuml;gen, da sie bereits vorhanden ist.');
define('REASON_COLUMN_DOESNT_EXIST_TO_DROP', 'Kann column %s nicht droppen, da diese nicht existiert.');
define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE', 'Kann column %s nicht aktualisieren, da diese nicht existiert.');
define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS', 'Kann prod-type-layout configuration_key %s nicht einf&uuml;gen, da er bereits existiert.');
define('REASON_INDEX_DOESNT_EXIST_TO_DROP', 'Kann index %s in table %s nicht droppen, da er nicht existiert.');
define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP', 'Kann primary key on table %s nicht droppen, da er nicht existiert.');
define('REASON_INDEX_ALREADY_EXISTS', 'Kann index %s in table %s nicht hinzuf&uuml;gen, da er bereits vorhanden ist.');
define('REASON_PRIMARY_KEY_ALREADY_EXISTS', 'Kann primary key in table %s nicht hinzuf&uuml;gen, da er bereits vorhanden ist.');
define('REASON_NO_PRIVILEGES', 'User ' . DB_SERVER_USERNAME . '@' . DB_SERVER . ' hat nicht die %s Rechte f&uuml;r Datenbank ' . DB_DATABASE . '.');



?>