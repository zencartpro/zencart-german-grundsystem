<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
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
//  $Id: whos_online.php 4 2006-03-31 16:38:40Z hugo13 $
//

define('HEADING_TITLE','Wer ist online');

define('TABLE_HEADING_ONLINE','Online');
define('TABLE_HEADING_CUSTOMER_ID','ID');
define('TABLE_HEADING_FULL_NAME','Name');
define('TABLE_HEADING_IP_ADDRESS','IP Adresse');
define('TABLE_HEADING_SESSION_ID', 'Session'); // new 1.3.0  
define('TABLE_HEADING_ENTRY_TIME','Zugangszeit');
define('TABLE_HEADING_LAST_CLICK','Letzter Klick');
define('TIME_PASSED_LAST_CLICKED', '!!!TRANSLATE!!! <strong>Time Since Clicked:</strong> ');     // new 1.3.0  
define('TABLE_HEADING_LAST_PAGE_URL','Letzte URL');
define('TABLE_HEADING_ACTION','Aktion');
define('TABLE_HEADING_SHOPPING_CART','Warenkorb der Benutzer');
define('TEXT_SHOPPING_CART_SUBTOTAL','Zwischensumme');
define('TEXT_NUMBER_OF_CUSTOMERS','Derzeit sind %s Kunden online');

// Additional Definitions for whos_online.php
define('WHOS_ONLINE_REFRESH_LIST_TEXT','LISTE AKTUALISIEREN');
define('WHOS_ONLINE_LEGEND_TEXT','Legende:');
define('WHOS_ONLINE_ACTIVE_TEXT','Aktiver Warenkorb');
define('WHOS_ONLINE_INACTIVE_TEXT','Inaktiver Warenkorb');
define('WHOS_ONLINE_ACTIVE_NO_CART_TEXT','Aktiv ohne Warenkorb');
define('WHOS_ONLINE_INACTIVE_NO_CART_TEXT','Inaktiv ohne Warenkorb');
define('WHOS_ONLINE_INACTIVE_LAST_CLICK_TEXT','Inaktiv ist letzter Klick >=');
define('WHOS_ONLINE_INACTIVE_ARRIVAL_TEXT','Inaktiv seit Ankunft >');
define('WHOS_ONLINE_REMOVED_TEXT','wird entfernt');

// whos_online.php
define('WHOIS_TIMER_REMOVE',1200); // Sekunden bis zur L&ouml;schung aus der Tabelle - 1200 default = 20 minutes
define('WHOIS_TIMER_INACTIVE',180); // seconds when considered inactive - 180 default = 3 minutes
define('WHOIS_TIMER_DEAD',540); // seconds when considered dead - 540 default = 9 minutes
define('WHOIS_SHOW_HOST','1'); // show Last Clicked time and host name - 1 default
define('WHOIS_REPEAT_LEGEND_BOTTOM','12'); // show legend on bottom when more than how many entries - 12 default
define('TEXT_SESSION_ID', '<strong>Session ID:</strong> '); // new 1.3.0  
define('TEXT_HOST', '<strong>Host:</strong> ');// new 1.3.0  
define('TEXT_USER_AGENT', '<strong>User Agent:</strong> '); // new 1.3.0  
define('TEXT_EMPTY_CART', '<strong>Leerer Warenkorb</strong>'); // new 1.3.0  
?>