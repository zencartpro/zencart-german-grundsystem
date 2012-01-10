<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: germanbanktransfer.php 667 2010-10-09 17:48:05Z maleborg/webchills $
 */
  define('MODULE_PAYMENT_GERMANBT_TEXT_TITLE', 'Direct debiting');
  define('MODULE_PAYMENT_GERMANBT_TEXT_DESCRIPTION', 'Direct debiting');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK', 'Direct debit');
  define('MODULE_PAYMENT_GERMANBT_TEXT_EMAIL_FOOTER', 'Note: You can download our fax form at ' . HTTP_SERVER . DIR_WS_CATALOG . MODULE_PAYMENT_GERMANBT_URL_NOTE . ' and return it to us.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_INFO', 'Please note that direct debiting requires a <b>German bank account.</b>');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ACCEPTANCE', 'I/we authorize revocably the salesman named down below to debit my/our payments from this procedure from my/our bank account named down below. I explain myself expressly in agreement to give this direct debit authorization on electronic way.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_OWNER', 'Name on Account: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_BLZ', 'Bank code: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_NAME', 'Bank: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_BIC', 'BIC: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_NUMBER', 'Account number: ');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_FAX', 'Direct debit authorization will be confirmed by fax');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR', 'ERROR:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_1', 'Account number and bank code do not fit');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_2', 'No plausibility check method available for this bank code');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_3', 'Account number cannot be verified');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_4', 'Account number cannot be verified');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_5', 'Bank code not found');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_8', 'Incorrect bank code');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_9', 'No account number indicated!');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE', 'Note:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE2', 'If you have security concerns to provide the bank details via internet, you may download our');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE3', 'fax form');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE4', ' and return it completed to us.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ACCEPTANCE_NOTE', '<b>Direct debit authorization:</b>');
  define('JS_GERMANBT_BLZ', 'Please enter the code number of your bank!\n');
  define('JS_GERMANBT_NAME', 'Please enter the name of your bank!\n');
  define('JS_GERMANBT_NUMBER', 'Please enter your account number!\n');
  define('JS_GERMANBT_OWNER', 'Please enter the account holders name!\n');