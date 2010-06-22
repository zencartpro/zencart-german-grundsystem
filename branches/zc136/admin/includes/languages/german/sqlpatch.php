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
//  $Id: sqlpatch.php 4138 2006-08-14 05:56:44Z drbyte $
//
define('HEADING_TITLE', 'SQL Query Executor');
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



?>