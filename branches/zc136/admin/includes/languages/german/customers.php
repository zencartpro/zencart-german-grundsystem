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
//  $Id: customers.php 4 2006-03-31 16:38:40Z hugo13 $
//

define('HEADING_TITLE', 'Kunden');

define('TABLE_HEADING_ID', 'ID#');
define('TABLE_HEADING_FIRSTNAME', 'Vorname');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Konto erstellt');
define('TABLE_HEADING_LOGIN', 'Letzte Anmeldung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_PRICING_GROUP', 'Preisgruppe');
define('TABLE_HEADING_AUTHORIZATION_APPROVAL', 'Autorisiert');

define('TEXT_DATE_ACCOUNT_CREATED', 'Konto erstellt:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Letzte &Auml;nderung:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Letzte Anmeldung:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Anzahl der Anmeldungen:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Anzahl der &Uuml;berpr&uuml;fungen:');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Kunden l&ouml;schen wollen?');
define('TEXT_DELETE_REVIEWS', 'L&ouml;sche %s &Uuml;berpr&uuml;fung(en)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'L&ouml;sche Kunde');
define('TYPE_BELOW', 'Geben Sie unten ein');
define('PLEASE_SELECT', 'W&auml;hlen Sie');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Anzahl der Bestellungen:');
define('TEXT_INFO_LAST_ORDER', 'Letzte Bestellung:');
define('TEXT_INFO_ORDERS_TOTAL', 'Summe:');
define('CUSTOMERS_REFERRAL', 'Kundenverweis (Referal)<br />Erster Geschenkgutschein');

define('ENTRY_NONE', 'Kein');

define('TABLE_HEADING_COMPANY', 'Firma');

define('CUSTOMERS_AUTHORIZATION', 'Kunden - Autorisierungsstatus');
define('CUSTOMERS_AUTHORIZATION_0', 'gepr&uuml;ft');
define('CUSTOMERS_AUTHORIZATION_1', 'Anstehende Autorisierung - Muss zum Browsen im Shop authorisiert sein');
define('CUSTOMERS_AUTHORIZATION_2', 'Anstehende Autorisierung - darf im Shop browsen, aber keine Preise sehen');
define('CUSTOMERS_AUTHORIZATION_3', 'Anstehende Autorisierung - darf im Shop browsen und Preise sehen, aber nicht kaufen');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION1', 'Warnung: Ihr Shop ist auf "Autorisierung ohne browsen" eingestellt. Der Kunde wurde auf " anstehende Genehmigung - ohne browsen im Shop" gesetzt');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION2', 'Warnung: Ihr Shop ist auf "Autorisierung mit browsen ohne Preisanzeige" eingestellt. Der Kunde wurde auf " anstehende Genehmigung - browsen im Shop ohne Preisanzeige" gesetzt');

define('EMAIL_CUSTOMER_STATUS_CHANGE_MESSAGE', 'Ihr Kundenstatus ist aktualisiert worden. F&uuml;r Ihren Einkauf bei uns danken wir Ihnen. Wir h&ouml;ren gerne wieder von Ihnen.');
define('EMAIL_CUSTOMER_STATUS_CHANGE_SUBJECT', 'Kundenstatus ist aktualisiert');
?>
