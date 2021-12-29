<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: storepickup.php 657 2019-06-25 07:45:57Z webchills $
 */

define('MODULE_SHIPPING_STOREPICKUP_TEXT_TITLE','Selbstabholung');
define('MODULE_SHIPPING_STOREPICKUP_TEXT_DESCRIPTION','Selbstabholung');
define('MODULE_SHIPPING_STOREPICKUP_TEXT_WAY','Sie holen die Ware in unserem Hause ab');

//Hier haben Sie die Möglichkeit, die Ortsangaben für die Abholung je nach Sprache eigens zu definieren. Das Setting in der Administration bei der Selbstabholung greift nur für die Standardsprache des Shops.
//Beispiele:
// Demogasse 17 in 1010 Wien;Beispielweg 15 in 8020 Graz<br/>
// Demogasse 17 in 1010 Wien,4.00;Beispielweg 15 in 8020 Graz,5.00<br/>
// Demogasse 17 in 1010 Wien,4.00;Beispielweg 15 in 8020 Graz,0.00<br/>
// Wenn Sie den Eintrag leer lassen, dann werden die unter Module > Versandarten > Selbstabholung eingetragenen Werte verwendet
// HINWEIS: Wenn Sie nur eine Sprache verwenden, oder keine multilinguale Darstellung dieser Ortsangaben brauchen, dann tragen Sie hier NICHTS ein, es werden sonst nie die Admineinstellungen verwendet. Was Sie hier eintragen überschreibt Ihre Konfiguration im Versandmodul Selbstabholung!
define('MODULE_SHIPPING_STOREPICKUP_MULTIPLE_WAYS', "");