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
//  $Id: gv_mail.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', TEXT_GV_NAME . ' an Kunden versenden');define('TEXT_CUSTOMER', 'Kunde:');define('TEXT_SUBJECT', 'Inhalt:');define('TEXT_FROM', 'Absender:');define('TEXT_TO', 'e-Mail an:');define('TEXT_AMOUNT', 'Betrag');define('TEXT_MESSAGE', 'Nur-Text <br />Nachricht:');define('TEXT_RICH_TEXT_MESSAGE', 'Rich-Text <br />Nachricht:');define('TEXT_SINGLE_EMAIL', '<span class="smallText">Verwenden Sie dieses Feld, um eine einzelne e-Mail zu senden</span>');define('TEXT_SELECT_CUSTOMER', 'Kunde w&auml;hlen');define('TEXT_ALL_CUSTOMERS', 'alle Kunden');define('TEXT_NEWSLETTER_CUSTOMERS', 'An alle Newsletter Abonnementen');define('NOTICE_EMAIL_SENT_TO', 'Hinweis: e-Mail wurde versendet an: %s');define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Es wurde kein Kunde ausgew&auml;hlt.');define('ERROR_NO_AMOUNT_SELECTED', 'Fehler: kein Betrag gew&auml;hlt.');define('ERROR_NO_SUBJECT', 'Fehler: Es wurde kein Betreff angegeben.');define('ERROR_GV_AMOUNT', 'Bitte den Wert ohne Symbole angeben. Beispiel: 25.00');define('TEXT_GV_ANNOUNCE', '<font color="#0000ff">Wir freuen uns, Ihnen einen ' . TEXT_GV_NAME . ' schenken zu k&ouml;nnen</font>');define('TEXT_GV_WORTH', 'Der ' . TEXT_GV_NAME . ' hat einen Wert von ');define('TEXT_TO_REDEEM', 'Um den ' . TEXT_GV_NAME . ', einl&ouml;sen zu k&ouml;nnen, klicken Sie bitte auf nachstehenden Link.');define('TEXT_WHICH_IS', ' notieren Sie sich hierf&uuml;r bitte diese Gutscheinnummer: ');define('TEXT_IN_CASE', ' Klicken Sie nun auf den nachstehenden Link: ');define('TEXT_OR_VISIT', 'Alternativ dazu k&ouml;nne Sie uns auf ');define('TEXT_ENTER_CODE', ' besuchen und tragen die Gutscheinnummer w&auml;hrend Ihres Bestellvorgangs ein.');define('TEXT_CLICK_TO_REDEEM', 'Zum Einl&ouml;sen bitte hier klicken');

define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'The value of the  ' . TEXT_GV_NAME . ' was %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'You can now visit our site, login and send the  ' . TEXT_GV_NAME . ' amount to anyone you want.');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");



?>