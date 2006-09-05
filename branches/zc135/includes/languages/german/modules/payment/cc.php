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
// $Id: cc.php 2 2006-03-31 09:55:33Z rainer $
//


define('MODULE_PAYMENT_CC_TEXT_TITLE','Kreditkarte');
define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION','Kreditkarten Test Info:<br /><br />CC#: 4111111111111111<br />G&uuml;ltig bis: alle');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE','Kreditkarten Typ:');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER','Karteninhaber:');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER','Kartennummer:');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV','Kreditkarensicherheitscode (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . 'More Info' . '</a>)');
define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES','G&uuml;ltig bis:');
define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER','* Der Name des Karteninhabers muss aus mindestens ' . CC_OWNER_MIN_LENGTH . ' characters.\n . Zeichen bestehen!');
define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER','* Die Kartennummer muss aus mindestens ' . CC_NUMBER_MIN_LENGTH . ' characters.\n . Zeichen bestehen!');
define('MODULE_PAYMENT_CC_TEXT_ERROR','Kreditkartenfehler!');
define('MODULE_PAYMENT_CC_TEXT_JS_CC_CVV','* Der Sicherheitscode f&uuml;r Kreditkarten muss aus mindestens ' . CC_CVV_MIN_LENGTH . ' characters.\n . Zeichen bestehen!');
define('MODULE_PAYMENT_CC_TEXT_EMAIL_ERROR', 'Warnung - Konfigurations Fehler: ');  // new 1.3.0  
define('MODULE_PAYMENT_CC_TEXT_EMAIL_WARNING', '!!!TRANSLATE!!! WARNING: You have enabled the CC payment module but have not configured it to send CC information to you by email. As a result, you will not be able to process the CC number for orders placed using this method.  Go to Admin->Modules->Payment->CC->Edit and set the email address for sending CC information.' . "\n\n\n\n");     // new 1.3.0  
?>