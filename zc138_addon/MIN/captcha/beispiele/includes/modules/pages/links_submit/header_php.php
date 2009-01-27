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
//  Original contrib by Vijay Immanuel for osCommerce, converted to zen by dave@open-operations.com - http://www.open-operations.com
//  $Id: links_manager.php 2006-12-22 Clyde Jones
//
// BOF Captcha
  require(DIR_WS_MODULES . 'require_languages.php');
  require(DIR_WS_FUNCTIONS . 'links.php');
  
if (REGISTERED_LINK == 'true'){
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
}

  $process = false;
// BOF Captcha
if(CAPTCHA_LINKS_SUBMIT != 'false') {
	require(DIR_WS_CLASSES . 'captcha.php');
	$captcha = new captcha();
}
// EOF Captcha
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    $process = true;
    $links_title = zen_db_prepare_input($_POST['links_title']);
    $links_url = zen_db_prepare_input($_POST['links_url']);
    $links_category = zen_db_prepare_input($_POST['links_category']);
    $links_description = zen_db_prepare_input($_POST['links_description']);
    $links_image = zen_db_prepare_input($_POST['links_image']);
    $links_contact_name = zen_db_prepare_input($_POST['links_contact_name']);
    $links_contact_email = zen_db_prepare_input($_POST['links_contact_email']);
if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') {
    $links_reciprocal_url = zen_db_prepare_input($_POST['links_reciprocal_url']);
}
    $error = false;
// BOF Captcha
  if (is_object($captcha) && !$captcha->validateCaptchaCode()) {
    $error = true;
    $messageStack->add('submit_link', ERROR_CAPTCHA);
  }
// EOF Captcha
    if (strlen($links_title) < ENTRY_LINKS_TITLE_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_TITLE_ERROR);
    }
    if (strlen($links_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_URL_ERROR);
    }
    if (strlen($links_description) < ENTRY_LINKS_DESCRIPTION_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_DESCRIPTION_ERROR);
    }
    if (strlen($links_contact_name) < ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_CONTACT_NAME_ERROR);
    }
    if (strlen($links_contact_email) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (zen_validate_email($links_contact_email) == false) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') {
    if (strlen($links_reciprocal_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_RECIPROCAL_URL_ERROR);
    }
}
    if ($error == false) {
      if($links_image == 'http://') {
        $links_image = '';
      }
      // default values
      $links_date_added = 'now()';
      $links_status = '1'; // Pending approval
      $sql_data_array = array('links_url' => $links_url,
                              'links_image_url' => $links_image,
                              'links_contact_name' => $links_contact_name,
                              'links_contact_email' => $links_contact_email,
                              'links_reciprocal_url' => $links_reciprocal_url, 
                              'links_date_added' => $links_date_added, 
                              'links_status' => $links_status);

      zen_db_perform(TABLE_LINKS, $sql_data_array);
      $links_id = zen_db_insert_id();
      $categories = $db->Execute("select link_categories_id from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_name = '" . $links_category . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
      $link_categories_id = $categories->fields['link_categories_id'];
      $db->Execute("insert into " . TABLE_LINKS_TO_LINK_CATEGORIES . " (links_id, link_categories_id) values ('" . (int)$links_id . "', '" . (int)$link_categories_id . "')");
      $language_id = (int)$_SESSION['languages_id'];
      $sql_data_array = array('links_id' => $links_id, 
                              'language_id' => $language_id, 
                              'links_title' => $links_title,
                              'links_description' => $links_description);
      zen_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array);
// build the message content
      $name = $links_contact_name;
      $email_text = sprintf(EMAIL_GREET_NONE, $name);
      $email_text .= EMAIL_WELCOME;
      $email_text .= EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
	  $email_store_text = EMAIL_OWNER_TEXT . $links_title . "\n\n" . $links_url . "\n\n" . $links_description;
// Prepare HTML-portion of message
      $html_msg['EMAIL_GREETING'] = str_replace('\n','',$email_text);
	  $html_msg['EMAIL_WELCOME'] = str_replace('\n','',EMAIL_WELCOME);
      $html_msg['EMAIL_MESSAGE_HTML'] =  str_replace('\n','',EMAIL_TEXT);
      $html_msg['CONTACT_US_OFFICE_FROM'] = OFFICE_FROM . ' ' . $name . '<br />' . OFFICE_EMAIL . '(' . $links_contact_email . ')';
      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];

      zen_mail($name, $links_contact_email, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $html_msg, 'Link Exchange');

      zen_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_OWNER_SUBJECT, $email_store_text, $name, $links_contact_email, $html_msg, 'Link Exchange');
	  
      zen_redirect(zen_href_link(FILENAME_LINKS_SUBMIT, 'action=success'));
  }
  // links breadcrumb
    if($_SESSION['customer_id']) {
      $check_customer = $db->Execute("select customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
      $email= $check_customer->fields['customers_email_address'];
      $name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
  }
  
  // include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_LINKS_SUBMIT, 'false');
  
  $breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_LINKS, '', 'NONSSL'));
  if (isset($HTTP_GET_VARS['lPath'])) {
    $link_categories_value = $db->Execute("select * from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id = '" . (int)$HTTP_GET_VARS['lPath'] . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
    $breadcrumb->add($link_categories_value->fields['link_categories_name'], zen_href_link(FILENAME_LINKS, 'lPath=' . $link_categories_value->fields['link_categories_id'], 'NONSSL'));
  } 
  $breadcrumb->add(NAVBAR_TITLE_2);
?>