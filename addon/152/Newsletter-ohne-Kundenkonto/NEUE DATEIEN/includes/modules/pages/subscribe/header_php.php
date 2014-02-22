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
// $Id: header_php.php,v 1.1 2006/06/16 01:46:15 Owner Exp $  dmcl1/notgoddess
//
	if ($_SESSION['customer_id'])
		zen_redirect(zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS));

	$_SESSION['navigation']->remove_current_page();

	require(DIR_WS_MODULES . 'require_languages.php');

// include template specific file name defines
  $definedpage = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_SUBSCRIBE, 'false');

  $subscribe = false;
	
	$error = false;

	$email_address = empty($_POST['email']) ? '' : $_POST['email'];
	$email_format = empty($_POST['email_format']) ? 'HTML' : $_POST['email_format'];

	$email_address = zen_db_prepare_input($email_address);
	$email_format = zen_db_prepare_input($email_format);
	if(!defined('NEWSONLY_SUBSCRIPTION_ENABLED') ||	(NEWSONLY_SUBSCRIPTION_ENABLED=='false')) {
		$error = true;
		$messageStack->add('subscribe', TEXT_NEWSONLY_SUBSCRIPTIONS_DISABLED);
	} elseif ((preg_match("/".$email_address."/i", HEADER_SUBSCRIBE_DEFAULT_TEXT)) || (empty($email_address))) {
		$error = true;
		$messageStack->add('subscribe', '');
		//$email_address = 'what the fuck';
	} elseif ( !$email_address || (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH)) {
		$error = true;
		$messageStack->add('subscribe', ENTRY_EMAIL_ADDRESS_ERROR);
	} elseif (zen_validate_email($email_address) == false) {
		$error = true;
		$messageStack->add('subscribe', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
	} else {
		// check if email address exists in CUSTOMERS table or in SUBSCRIBERS table
		$check_cust_email_query = "select count(*) as total from " . TABLE_CUSTOMERS .
			" where customers_email_address = '" . zen_db_input($email_address) . "'";
		$check_cust_email = $db->Execute($check_cust_email_query);

		$check_news_email_query = "select count(*) as total from " . TABLE_SUBSCRIBERS .
			" where email_address = '" . zen_db_input($email_address) . "'";
		$check_news_email = $db->Execute($check_news_email_query);
		
		if ($check_cust_email->fields['total'] > 0) {
			$error = true;
			$messageStack->add('subscribe', SUBSCRIBE_DUPLICATE_CUSTOMERS_ERROR);
		//} elseif (($check_news_email->fields['total'] > 0) && ($check_news_email_status->fields['total'] > 1)) {
			//echo $check_news_email_status;
			//$error = true;
			//$messageStack->add('subscribe', SUBSCRIBE_DUPLICATE_NEWSONLY_ERROR);
		} elseif ($check_news_email->fields['total'] > 0) {
			echo $check_news_email_status;
			$error = true;
			$messageStack->add('subscribe', SUBSCRIBE_DUPLICATE_NEWSONLY_ACCT);
		} else {
			$subscribe = true;
			// we generate a random confirmation code so we can use it as an 
			// extra security measure to prevent spoofs/scams.
				
			$confirm_code = substr(base64_encode(crypt(str_shuffle(time()))),4,6);

			$db->Execute('insert into ' . TABLE_SUBSCRIBERS . 
				' (email_address, email_format, subscribed_date, confirmed) ' .
				"VALUES ('".zen_db_input($email_address)."', '".zen_db_input($email_format)."', now(), '".$confirm_code."')"
			);

      // Send confirmation request.
      // get the proper uri
			$confirm_uri = zen_href_link(FILENAME_SUBSCRIBE_CONFIRM, 'confirm='.$confirm_code.'&email=' . $email_address, 'NONSSL');
			
			// initial welcome
			$email_text .=  EMAIL_WELCOME;
			$html_msg['EMAIL_WELCOME'] = str_replace('\n','',EMAIL_WELCOME);
			
			// add in regular email welcome text
			$email_text .= "\n\n" . EMAIL_TEXT . sprintf(EMAIL_CONFIRMATION_TEXT, $confirm_uri ). EMAIL_CONTACT . EMAIL_CLOSURE;
			
			$html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT );
			$html_msg['EMAIL_CONFIRMATION_LINK']  = str_replace('\n','', sprintf(EMAIL_CONFIRMATION_TEXT, '<a href="'.$confirm_uri.'">'.$confirm_uri.'</a>' ));
			$html_msg['EMAIL_CONTACT_OWNER'] = str_replace('\n','',EMAIL_CONTACT);
			$html_msg['EMAIL_CLOSURE']       = nl2br(EMAIL_CLOSURE);
			
			// include create-account-specific disclaimer
			$email_text .= "\n\n" . sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, STORE_OWNER_EMAIL_ADDRESS). "\n\n";
			$html_msg['EMAIL_DISCLAIMER'] = sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');
			
			// send welcome email
			zen_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, $html_msg, 'newsletter_subscription');
			
			if(defined('NEWSONLY_SUBSCRIPTION_CC_STATUS') &&
   			defined('NEWSONLY_SUBSCRIPTION_CC') &&
			(NEWSONLY_SUBSCRIPTION_CC_STATUS == 1) &&
			(strlen(NEWSONLY_SUBSCRIPTION_CC) > 4)) {
				// send email to notify store owner of new subscriber
				$email_text = 'A Newsletter-Only Subscriber using the address ' . $email_address . "\n" .
											'was added on ' . strftime(DATE_FORMAT_LONG) . '.';
				mail(EMAIL_FROM, 'Subscriber Notification', $email_text, "From: ".STORE_NAME."\r\nReply-to: ".EMAIL_FROM."\r\n");
			}
		}
	}

  $breadcrumb->add(NAVBAR_TITLE);

?>
