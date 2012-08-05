<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_setup.php 793 2011-10-10 06:24:50Z hugo13 $
 */
/**
 * defining language components for the page
 */
define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Administrationszugang');
define('SAVE_ADMIN_SETTINGS', 'Zugangsdaten speichern');//this comes before TEXT_MAIN
define('TEXT_MAIN', 'Um Ihren Zen Cart Shop administrieren zu können, benötigen Sie ein Administratorenkonto. Bitte geben Sie einen Benutzernamen sowie ein Passwort an. Ebenso benötigen Sie eine gültige E-Mail Adresse, an die Sie sich Ihr Passwort (falls Sie es einmal vergessen haben sollten) zusenden lassen können. Überprüfen Sie Ihre Angaben gewissenhaft und klicken Sie auf <em>'.SAVE_ADMIN_SETTINGS.'</em> sobald Sie fertig sind.');
define('ADMIN_INFORMATION', 'Administrator Informationen');
define('ADMIN_USERNAME', 'Benutzername des Administrators');
define('ADMIN_USERNAME_INSTRUCTION', 'Tragen Sie hier den gewünschten Benutzernamen für die Anmeldung im Adminbereich ein.');
define('ADMIN_PASS', 'Übergangspasswort des Administrators');
define('ADMIN_PASS_INSTRUCTION', 'Tragen Sie hier das gewünschte temporäre Passwort für die Anmeldung im Adminbereich ein. WICHTIG: Das Passwort muss mindestens 7 Zeichen haben und mindestens eine Ziffer enthalten. <b>Verwenden Sie an dieser Stelle ein Übergangspasswort, z.B. demo1234. Denn Sie müssen dieses Passwort beim ersten Einloggen in den Adminbereich sofort wieder ändern.</b>');
define('ADMIN_PASS_CONFIRM', 'Passwortbestätigung');
define('ADMIN_PASS_CONFIRM_INSTRUCTION', 'Bitte bestätigen Sie das Passwort (um Tippfehler zu vermeiden).');
define('ADMIN_EMAIL', 'E-Mail Adresse des Administrators');
define('ADMIN_EMAIL_INSTRUCTION', 'Geben Sie hier eine gültige E-Mail Adresse ein. Diese wird zwingend benötigt, damit Sie sich ein vergessenes Passwort für den Adminbereich erneut zusenden lassen können.');
define('UPGRADE_DETECTION','Prüfung auf neuere Zen-Cart Versionen');
define('UPGRADE_INSTRUCTION_TITLE','Bei jeder Anmeldung im Admin Bereich auf Aktualisierungen prüfen');
define('UPGRADE_INSTRUCTION_TEXT','Lassen Sie diese Option aktiviert, wenn Sie bei jeder Anmeldung im Admin Bereich eine Echtzeitabfrage am Zen Cart&reg; Versions-Server auf neuere Versionen, Patches etc. durchführen wollen.<br />Sollten neuere Aktualisierungen vorhanden sein, wird Ihnen dies als Mitteilung im Header des Admin Bereichs angezeigt.<br />Es werden dabei KEINE automatische Aktualisierungen durchgeführt, es dient lediglich der Information.<br />Sie können diese Option jederzeit im Admin Bereich unter "Admin->Konfiguration->Mein Shop->Auf neuere Version prüfen" deaktivieren oder aktivieren.');