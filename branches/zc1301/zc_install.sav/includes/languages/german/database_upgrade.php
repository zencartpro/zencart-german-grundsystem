<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// $Id: database_upgrade.php 2 2006-03-31 09:55:33Z rainer $
//

define('PAGE_HEADING', 'Zen Cart Setup - Datenbankupdate');
define('UPDATE_DATABASE_NOW','Datenbank jetzt updaten');//this comes before TEXT_MAIN

define('TEXT_MAIN', '<em>Warnung: </em> Dieses Update ist nur f&uuml;r Aktualisierungen innerhalb des Datenbankschemas f&uuml;r die angef&uuml;hrten Versionen.<br /><br />
                         <span class="emphasis"><strong>Es ist SEHR EMPFEHLENSWERT, VOR der Aktualisierung eine Sicherung der Datenbank durchzuf&uuml;hren!</strong></span>');
define('TEXT_MAIN_2','<span class="emphasis">Überpr&uuml;fen Sie sorgf&auml;ltig die nachstehenden Informationen, die aus der Datei "configure.php" ausgelesen wurden</span>.<br />' .
                      'Fahren Sie erst mit der Aktualisierung fort, wenn Sie alle notwendigen Einstellungen auf ihre Richtigkeit gepr&uuml;ft haben - Sie riskieren sonst eine Zerst&ouml;rung der Datenbank.');

define('DATABASE_INFORMATION', 'Database Information');
define('DATABASE_INFORMATION', 'Datenbankinformationen');
define('DATABASE_TYPE', 'Datenbanktyp');
define('DATABASE_USERNAME', 'Datenbank Benutzername');
define('DATABASE_PASSWORD', 'Datenbank Passwort');
define('DATABASE_NAME', 'Name der Datenbank');
define('DATABASE_PREFIX', 'Datenbank Pr&auml;fix');

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

define('UPDATE_DATABASE_WARNING_DO_NOT_INTERRUPT','<span class="emphasis">Bitte unterbrechen Sie die Prozedur KEINESFALLS, nachdem Sie auf den unten stehenden Button geklickt haben!!! Bitte warten Sie, bis die Aktualisierung abgeschlossen ist.</span><br />');
define('SKIP_UPDATES','&uuml;berspringen');
?>
