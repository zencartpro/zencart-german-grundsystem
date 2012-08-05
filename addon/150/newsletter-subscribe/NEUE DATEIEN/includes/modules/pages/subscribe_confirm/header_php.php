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
// $Id: header_php.php,v 1.1 2006/06/16 01:46:16 Owner Exp $  dmcl1
//

   $_SESSION['navigation']->remove_current_page();

   require(DIR_WS_MODULES . 'require_languages.php');

// include template specific file name defines
   $definedpage = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_SUBSCRIBE, 'false');

   $subscribe = false;
  $error = false;
	$email_address = !empty($_REQUEST['email']) ? $_REQUEST['email'] : '';
	$confirm = !empty($_REQUEST['confirm']) ? $_REQUEST['confirm'] : '';
	
  $email_address = zen_db_prepare_input($email_address);
  $confirm = zen_db_prepare_input($confirm);

      if(!defined('NEWSONLY_SUBSCRIPTION_ENABLED') ||
			(NEWSONLY_SUBSCRIPTION_ENABLED=='false')) {
            $error = true;
            $messageStack->add('subscribe', TEXT_NEWSONLY_SUBSCRIPTIONS_DISABLED);
      } elseif ( !$email_address || (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH)) {
         $error = true;
         $messageStack->add('subscribe', ENTRY_EMAIL_ADDRESS_ERROR);
      } elseif (zen_validate_email($email_address) == false) {
         $error = true;
         $messageStack->add('subscribe', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
      } else {
      // check if email address exists in SUBSCRIBERS table
    $check_cust_email_query = "select confirmed from " . TABLE_SUBSCRIBERS .
            " where email_address = '" . zen_db_input($email_address) . "'";
    $check_cust_email = $db->Execute($check_cust_email_query);
    
    if ($check_cust_email->RecordCount() > 1) {
     // should not happen!
      $error = true;
      $messageStack->add('subscribe', SUBSCRIBE_MULTIPLE_EMAIL_ERROR);
    } elseif ($check_cust_email->RecordCount() < 1) {
      $error = true;
      $messageStack->add('subscribe', SUBSCRIBE_NONEXISTANT_EMAIL_ERROR);
    } elseif ($check_cust_email->fields['confirmed'] == '1') {
      $error = true;
      $messageStack->add('subscribe', SUBSCRIBE_DUPLICATE_CONFIRM_ERROR);
    } elseif ($check_cust_email->fields['confirmed'] != $confirm) {
            $error = true;
            $messageStack->add('subscribe', SUBSCRIBE_NONEXISTANT_EMAIL_ERROR);
         } else {
      $subscribe = true;
				$db->Execute("update " . TABLE_SUBSCRIBERS . " set confirmed = '1' where email_address = '" . zen_db_input($email_address) . "'");
         }
      }

  $breadcrumb->add(NAVBAR_TITLE);

?>
