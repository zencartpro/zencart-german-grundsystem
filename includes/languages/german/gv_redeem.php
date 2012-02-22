<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id: gv_redeem.php 628 2012-02-22 09:05:14Z webchills $
 */

define('NAVBAR_TITLE', 'Geschenkgutschein einlösen ');
define('HEADING_TITLE', 'Geschenkgutschein einlösen ');
define('TEXT_INFORMATION', 'Weitere Informationen zum Thema Geschenkgutscheine erhalten Sie in unserer <br /><br /><strong><a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a></strong>');
define('TEXT_INVALID_GV','Der Gutscheincode ist ungültig oder wurde bereits eingelöst. Wenn Sie Fragen haben, kontaktieren Sie uns bitte über unser Kontaktformular hier im Shop');
define('TEXT_VALID_GV','Herzlichen Glückwunsch, Sie haben einen Geschenkgutschein im Wert von %s eingelöst.');