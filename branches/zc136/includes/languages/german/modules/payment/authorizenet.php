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
// $Id: authorizenet.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE', 'Authorize.net');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE', 'Kreditkarte'); // Payment option title as displayed to the customer
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION','Kreditkartentest Info:<br /><br />CC#: 4111111111111111<br />Ablaufdatum: jedes');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE','Kreditkarten Typ:');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER','Karteninhaber:');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER','Kartennummer:');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES','G&uuml;ltig bis:');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER','* Der Name des Karteninhabers muss mindestens ' . CC_OWNER_MIN_LENGTH . ' characters.\n. Zeichen haben!');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER','* Die Kartennummer muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' characters.\n. Zeichen haben!');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE','Ein Fehler ist bei der &Uuml;berpr&uuml;fung der Kreditkarte aufgetreten. Bitte versuchen Sie es noch einmal.');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE','Ihre Kreditkarte wurde abgelehnt. F&uuml;r weitere Informationen kontaktieren Sie bitte Ihre Bank');define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR','Kreditkartenfehler!');


?>