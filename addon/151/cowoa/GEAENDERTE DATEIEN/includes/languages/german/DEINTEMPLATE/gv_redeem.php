<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_redeem.php for COWOA 3.1 ZC151 2013-02-21 10:10:40Z webchills $
 */

define('NAVBAR_TITLE', TEXT_GV_NAME .' einlösen ');
define('HEADING_TITLE', TEXT_GV_NAME .' einlösen ');
define('TEXT_INFORMATION', 'Weitere Informationen zum Thema ' . TEXT_GV_NAME . ' erfahren Sie in unserer <br /><br /><strong><a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a></strong>');
define('TEXT_INVALID_GV','Der ' . TEXT_GV_NAME . 'code ist ungültig oder wurde bereits eingelöst. Wenn Sie Fragen haben, kontaktieren Sie uns bitte über unser Kontaktformular hier im Shop');
define('TEXT_VALID_GV','Herzlichen Glückwunsch, Sie haben einen ' . TEXT_GV_NAME . ' im Wert von %s eingelöst.');
define('ERROR_GV_CREATE_ACCOUNT', 'Um einen Geschenkgutschein einzulösen, müssen Sie eine Bestellung tätigen.');