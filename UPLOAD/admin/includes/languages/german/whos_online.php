<?php
/**

 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: whos_online.php 2022-03-02 20:07:14Z webchills $
 */

define('HEADING_TITLE','Wer ist online');
define('TABLE_HEADING_ONLINE','Online');
define('TABLE_HEADING_CUSTOMER_ID','ID');
define('TABLE_HEADING_FULL_NAME','Name');
define('TABLE_HEADING_IP_ADDRESS','IP Adresse');
define('TABLE_HEADING_SESSION_ID', 'Session');
define('TABLE_HEADING_ENTRY_TIME','Zugangszeit');
define('TABLE_HEADING_LAST_CLICK','Letzter Klick');
define('TIME_PASSED_LAST_CLICKED', '<strong>Zeit seit letztem Klick:</strong> ');
define('TABLE_HEADING_LAST_PAGE_URL','Letzte URL');
define('TABLE_HEADING_ACTION','Aktion');
define('TABLE_HEADING_SHOPPING_CART','Warenkorb der Benutzer');
define('TEXT_SHOPPING_CART_SUBTOTAL','Zwischensumme');
define('TEXT_NUMBER_OF_CUSTOMERS','Derzeit sind %s Kunden online');

define('WHOS_ONLINE_REFRESH_LIST_TEXT','LISTE AKTUALISIEREN');
define('WHOS_ONLINE_LEGEND_TEXT','Legende:');
define('WHOS_ONLINE_ACTIVE_TEXT','Aktiver Warenkorb');
define('WHOS_ONLINE_INACTIVE_TEXT','Inaktiver Warenkorb');
define('WHOS_ONLINE_ACTIVE_NO_CART_TEXT','Aktiv ohne Warenkorb');
define('WHOS_ONLINE_INACTIVE_NO_CART_TEXT','Inaktiv ohne Warenkorb');
define('WHOS_ONLINE_INACTIVE_LAST_CLICK_TEXT','Inaktiv ist letzter Klick >=');
define('WHOS_ONLINE_INACTIVE_ARRIVAL_TEXT','Inaktiv seit Ankunft >');
define('WHOS_ONLINE_REMOVED_TEXT','wird entfernt');

define('TEXT_SESSION_ID', '<strong>Session ID:</strong> ');
define('TEXT_HOST', '<strong>Host:</strong> ');
define('TEXT_USER_AGENT', '<strong>User Agent:</strong> ');
define('TEXT_EMPTY_CART', '<strong>Leerer Warenkorb</strong>');
define('TEXT_WHOS_ONLINE_FILTER_SPIDERS', 'Spiders ausschliessen');
define('TEXT_WHOS_ONLINE_FILTER_ADMINS', 'Admin IP Addressen ausschliessen?');

// show Last Clicked time and host name - 1 both(default), 0=time-only
if (!defined('WHOIS_SHOW_HOST')) define('WHOIS_SHOW_HOST', '1');

define('TEXT_DUPLICATE_IPS', 'Doppelte IP Adressen: ');
define('TEXT_TOTAL_UNIQUE_USERS', 'Einzigartige User gesamt: ');

define('TEXT_WHOS_ONLINE_TIMER_UPDATING', 'Aktualisiere ');
define('TEXT_WHOS_ONLINE_TIMER_EVERY', 'alle %s Sekunden.&nbsp;&nbsp;');
define('TEXT_WHOS_ONLINE_TIMER_DISABLED', 'Manuell');
define('TEXT_WHOS_ONLINE_TIMER_FREQ0', 'AUS');
define('TEXT_WHOS_ONLINE_TIMER_FREQ1', '5 sec');
define('TEXT_WHOS_ONLINE_TIMER_FREQ2', '15 sec');
define('TEXT_WHOS_ONLINE_TIMER_FREQ3', '30 sec');
define('TEXT_WHOS_ONLINE_TIMER_FREQ4', '1 min');
define('TEXT_WHOS_ONLINE_TIMER_FREQ5', '5 min');
define('TEXT_WHOS_ONLINE_TIMER_FREQ6', '10 min');
define('TEXT_WHOS_ONLINE_TIMER_FREQ7', '14 min');

