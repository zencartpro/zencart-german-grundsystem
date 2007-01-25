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
// $Id: cc.php 4027 2006-07-26 05:27:41Z drbyte $
//

define('MODULE_PAYMENT_CC_TEXT_TITLE','Kreditkarte');
define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION','Kreditkarten Test Info:<br /><br />CC#: 4111111111111111<br />G&uuml;ltig bis: alle');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE','Kreditkarte:');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER','Karteninhaber:');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER','Kartennummer:');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV','Kreditkartensicherheitscode (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'More Info' . '</a>)');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES','G&uuml;ltig bis:');
define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER','* Der Name des Karteninhabers muss aus mindestens ' . CC_OWNER_MIN_LENGTH . ' characters.\n . Zeichen bestehen!');
define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER','* Die Kartennummer muss aus mindestens ' . CC_NUMBER_MIN_LENGTH . ' characters.\n . Zeichen bestehen!');
define('MODULE_PAYMENT_CC_TEXT_ERROR','Kreditkartenfehler!');
define('MODULE_PAYMENT_CC_TEXT_JS_CC_CVV','* Der Sicherheitscode f&uuml;r Kreditkarten muss aus mindestens ' . CC_CVV_MIN_LENGTH . ' characters.\n . Zeichen bestehen!');
define('MODULE_PAYMENT_CC_TEXT_EMAIL_ERROR', 'Warnung - Konfigurations Fehler: ');
define('MODULE_PAYMENT_CC_TEXT_EMAIL_WARNING','WARNUNG: Sie haben das Kreditkarten Zahlungsmodul nicht richtig konfiguriert, damit Kreditkarten Informationen per E-Mail an Sie verschickt werden k&ouml;nnen. Infolge dessen werden Auftr&auml;ge nicht verarbeitet, die mit dieser Methode erteilt werden. Bitte geben Sie unter Module->Zahlungsarten->Kreditkarte die gew&uuml;nschte E-Mail Adresse an.' . "\n\n\n\n");
define('MODULE_PAYMENT_CC_TEXT_MIDDLE_DIGITS_MESSAGE', 'Diese E-Mail an die Buchhaltung senden, damit sie zusammen mit dem Online-Auftrag eingeordnet werden kann, auf den sie sich bezieht: ' . "\n\n" . 'Auftrag: %s' . "\n\n" . 'Mittlere Stellen: %s' . "\n\n");


?>
