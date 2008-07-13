<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:
//////////////////////////////////////////////////////////
// $Id: super_customers.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('HEADING_TITLE', 'Kunde');

define('TABLE_HEADING_ID', 'ID#');
define('TABLE_HEADING_FIRSTNAME', 'Vorname');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Bisherige Bestellungen');
define('TABLE_HEADING_LOGIN', 'Letzter Login');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_PRICING_GROUP', 'Preisgruppe');
define('TABLE_HEADING_AUTHORIZATION_APPROVAL', 'Authorisiert');

define('TEXT_DATE_ACCOUNT_CREATED', 'Bisherige Rechnungen:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Letzt Aktualisierung:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Letzter Besuch:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Anzahl der Besuche:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Anzahl der Prüfung:');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie den Kunden l&ouml;schen m&ouml;chten?');
define('TEXT_DELETE_REVIEWS', 'L&ouml;sche %s Prüfung(en)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'L&ouml;sche Kunden');
define('TYPE_BELOW', 'Typ unten');
define('PLEASE_SELECT', 'W&auml;hlen Sie einen aus');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Anzahl der Bestellungen:');
define('TEXT_INFO_LAST_ORDER','Letzte Bestellung:');
define('TEXT_INFO_ORDERS_TOTAL', 'Summe:');
define('CUSTOMERS_REFERRAL', 'Kunden Referenz<br />1. Geschenkgutschein');

define('ENTRY_NONE', 'Keine');

define('TABLE_HEADING_COMPANY','Firma');

define('CUSTOMERS_AUTHORIZATION', 'Kunden Autorisierungs Status');
define('CUSTOMERS_AUTHORIZATION_0', 'Genehmigt');
define('CUSTOMERS_AUTHORIZATION_1', 'Anstehende Authorisierung - Muss zum Browsen im Shop authorisiert sein');
define('CUSTOMERS_AUTHORIZATION_2', 'Anstehende Authorisierung - Darf im Shop browsen, aber keine Preise sehen');
define('CUSTOMERS_AUTHORIZATION_3', 'Anstehende Authorisierung - Darf im Shop browsen und Preise sehen, aber nicht kaufen');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION1', 'Warnung: Ihr Shop ist eingestellt auf nicht browsen. Der Kunde ist dazu gesetzt worden Anstehende Authorisierung - Nicht browsen');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION2', 'Warnung: Ihr Shop ist eingestellt auf browsen, aber keine Preise. Der Kunde ist dazu gesetzt worden Anstehende Authorisierung - Browsen kein Preis');
?>