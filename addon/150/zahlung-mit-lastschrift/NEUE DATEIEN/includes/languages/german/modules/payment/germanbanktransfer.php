<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: germanbanktransfer.php 667 2010-10-09 17:48:05Z maleborg/webchills $
 */
  define('MODULE_PAYMENT_GERMANBT_TEXT_TITLE', 'Lastschriftverfahren');
  define('MODULE_PAYMENT_GERMANBT_TEXT_DESCRIPTION', 'Lastschriftverfahren');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK', 'Bankeinzug');
  define('MODULE_PAYMENT_GERMANBT_TEXT_EMAIL_FOOTER', 'Hinweis: Sie können sich unser Faxformular unter ' . HTTP_SERVER . DIR_WS_CATALOG . MODULE_PAYMENT_GERMANBT_URL_NOTE . ' herunterladen und es ausgefüllt an uns zurücksenden.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_INFO', 'Bitte beachten Sie, dass das Lastschriftverfahren <b>nur</b> von einem <b>deutschen Girokonto</b> aus möglich ist.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ACCEPTANCE', 'Hiermit ermächtige ich/wir die den unten genannten Verkäufer widerruflich, die von mir/uns zu entrichtenden Zahlungen aus diesem Vorgang, zu Lasten meines/unseres unten genanten Girokontos durch Lastschrift einzuziehen. Ich erkläre mich ausdrücklich damit einverstanden, diese Einzugsermächtigung auf elektronischem Wege zu erteilen.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_OWNER', 'Kontoinhaber: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_NUMBER', 'Kontonummer: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_BLZ', 'BLZ: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_NAME', 'Bank: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_BIC', 'BIC: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_FAX', 'Einzugsermächtigung wird per Fax bestätigt');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR', 'FEHLER: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_1', 'Kontonummer passt nicht zur Bankleitzahl');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_2', 'Für diese Kontonummer ist kein Prüfziffernverfahren definiert');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_3', 'Kontonummer nicht prüfbar');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_4', 'Kontonummer nicht prüfbar');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_5', 'Bankleitzahl nicht gefunden');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_8', 'Bankleitzahl nicht gefunden');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_9', 'Keine Kontonummer angegeben');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE', '<b>Hinweis:</b>');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE2', 'Wenn Sie aus Sicherheitsbedenken keine Bankdaten über das Internet übertragen wollen, können Sie sich unser ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE3', 'Faxformular (hier)');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE4', ' herunterladen und uns ausgefüllt zusenden. Bitte bestätigen Sie uns das mit der folgenden Checkbox:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ACCEPTANCE_NOTE', '<b>Einzugsermächtigung:</b>');
  define('JS_GERMANBT_BLZ', 'Bitte geben Sie die BLZ Ihrer Bank ein!\n');
  define('JS_GERMANBT_NAME', 'Bitte geben Sie den Namen Ihrer Bank ein!\n');
  define('JS_GERMANBT_NUMBER', 'Bitte geben Sie Ihre Kontonummer ein!\n');
  define('JS_GERMANBT_OWNER', 'Bitte geben Sie den Namen des Kontobesitzers ein!\n');
  ?>