<?php
/*
  $Id: germanbanktransfer.php 157 2005-04-07 20:33:35Z dogu $

  OSC German Banktransfer
  (http://www.oscommerce.com/community/contributions,826)

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2001 - 2003 osCommerce

  Released under the GNU General Public License
*/
  define('MODULE_PAYMENT_GERMANBT_TEXT_TITLE', 'Direct debiting');
  define('MODULE_PAYMENT_GERMANBT_TEXT_DESCRIPTION', 'Direct debiting');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK', 'Direct debit');
  define('MODULE_PAYMENT_GERMANBT_TEXT_EMAIL_FOOTER', 'Note: You can download our fax form at ' . HTTP_SERVER . DIR_WS_CATALOG . MODULE_PAYMENT_GERMANBT_URL_NOTE . ' and return it to us.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_INFO', 'Please note that direct debiting requires a <b>German bank account.</b>');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_OWNER', 'Account holder:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_NUMBER', 'Account number:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_BLZ', 'Bank code:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_NAME', 'Bank:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_FAX', 'Direct debit authorization will be confirmed by fax');

  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR', 'ERROR:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_1', 'Account number and bank code do not fit! Please check again.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_2', 'No plausibility check method available for this bank code!');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_3', 'Account number cannot be verified!');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_4', 'Account number cannot be verified! Please check again.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_5', 'Bank code not found! Please check again.');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_8', 'Incorrect bank code or no bank code entered!');
  define('MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_9', 'No account number indicated!');

  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE', 'Note:');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE2', 'If you have security concerns to provide the bank details via internet, you may download our');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE3', 'fax form');
  define('MODULE_PAYMENT_GERMANBT_TEXT_NOTE4', ' and return it completed to us.');

  define('JS_GERMANBT_BLZ', 'Please enter the code number of your bank!\n');
  define('JS_GERMANBT_NAME', 'Please enter the name of your bank!\n');
  define('JS_GERMANBT_NUMBER', 'Please enter your account number!\n');
  define('JS_GERMANBT_OWNER', 'Please enter the account holders name!\n');
?>
