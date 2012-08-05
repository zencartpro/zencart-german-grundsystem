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
//  $Id: subscription_manager.php,v 1.1 2006/06/16 01:46:12 Owner Exp $
//
  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $current_ns_version = 205;
  
  if(($action=='install') || ($action=='update_contrib')) {
    install_newsonly_subscriptions();
    zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER));
  }

  if($action=='remove_confirmed') {
    remove_newsonly_subscriptions();
    zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER));
  }

  // this can be called by typing action in address bar if needed.
  if($action=='transfer_subscriptions') { 
    transfer_subscriptions();
    zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER));
  }

  if($action=='import_file') {
    list($imported,$error) = import_subscriptions($_POST['record_delim'], $_POST['field_encl'], $_POST['record_sample'], $_POST['default_format'], $_POST['record_header']);
    if(!empty($error)) {
      $action='import';
      $messageStack->add($error, 'warning');
    } elseif(!empty($imported)) {
      zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'imported='.$imported));
    }
  }

  if(!defined('NEWSONLY_SUBSCRIPTION_ENABLED') ) {
    $error = true;
		$messageStack->add(NEWSONLY_SUBSCRIPTION_NOT_INSTALLED, 'install');
  } else {
    if(NEWSONLY_SUBSCRIPTION_ENABLED == 'false'){
      $error = true;
		$messageStack->add(NEWSONLY_SUBSCRIPTION_NOT_ENABLED, 'warning');
    }
    if(!empty($_REQUEST['imported']) && is_numeric($_REQUEST['imported'])) {
      $messageStack->add( sprintf(TEXT_INFO_SUBSCRIPTIONS_IMPORTED,$_REQUEST['imported']), 'success');
    }

	$extra_args = isset($_GET['filter']) ? '&filter='.$_GET['filter'] : '';
	if (isset($_GET['list_order'])) $extra_args .= '&list_order='.$_GET['list_order'];
  
    if (zen_not_null($action)) {
      switch ($action) {
        case 'insert':
          $email_address = zen_db_prepare_input($_POST['email_address']);
          $email_format = zen_db_prepare_input($_POST['email_format']);

          // check if email address exists in CUSTOMERS table or in SUBSCRIBERS table
          $check_cust_email_query = "select count(*) as total from " . TABLE_CUSTOMERS .
          " where customers_email_address = '" . zen_db_input($email_address) . "'";
          $check_cust_email = $db->Execute($check_cust_email_query);
          
          $check_news_email_query = "select count(*) as total from " . TABLE_SUBSCRIBERS .
          " where email_address = '" . zen_db_input($email_address) . "'";
          $check_news_email = $db->Execute($check_news_email_query);
          
          if ($check_cust_email->fields['total'] > 0) {
            $error = true;
            $messageStack->add( SUBSCRIBE_DUPLICATE_CUSTOMERS_ERROR, 'error');
          } elseif ($check_news_email->fields['total'] > 0) {
            $error = true;
            $messageStack->add( SUBSCRIBE_DUPLICATE_NEWSONLY_ERROR, 'error');
          } else {
            $db->Execute("insert into " . TABLE_SUBSCRIBERS . "
                      (email_address, email_format, confirmed, subscribed_date)
                      values ('" . zen_db_input($email_address) . "', '" . 
                                   zen_db_input($email_format) . "', '1', now() )");
            zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER));
          }
          break;
        case 'save':
          $subscriber_id = zen_db_prepare_input($_GET['tID']);
          $email_address = zen_db_prepare_input($_POST['email_address']);
          $email_format = zen_db_prepare_input($_POST['email_format']);
          $email_confirmed = empty($_POST['email_confirmed']) ? 0 : 1;
  
          $db->Execute("update " . TABLE_SUBSCRIBERS . "
                        set subscriber_id = '" . (int)$subscriber_id . "',
                            email_address = '" . zen_db_input($email_address) . "',
                            email_format = '" . zen_db_input($email_format) . "',
                            confirmed = '" . zen_db_input($email_confirmed) . "'
                        where subscriber_id = '" . (int)$subscriber_id . "'");
  
          zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $subscriber_id . $extra_args));
          break;
        case 'deleteconfirm':
          // demo active test
          if (zen_admin_demo()) {
            $_GET['action']= '';
            $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
            zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page']));
          }
          $subscriber_id = zen_db_prepare_input($_GET['tID']);
          $customers_id = zen_db_prepare_input($_GET['cID']);
  
          $db->Execute("delete from " . TABLE_SUBSCRIBERS . "
                        where subscriber_id = '" . (int)$subscriber_id . "'");
          if(!empty($customers_id)) {
            $sql = "UPDATE " . TABLE_CUSTOMERS . " set customers_newsletter = '0'
                        where customers_id = '" . (int)$customers_id . "'";
            $db->Execute($sql);                        
          }
  
          zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . $extra_args));
          break;
        case 'purgeunconfirmed':
          // demo active test
          if (zen_admin_demo()) {
            $_GET['action']= '';
            $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
            zen_redirect(zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page']));
          }
  
          $db->Execute('delete from ' . TABLE_SUBSCRIBERS . '
                        where confirmed != 1 
                        and (customers_id IS NULL or customers_id = 0)
                        and DATE_SUB(CURDATE(),INTERVAL 30 DAY) > subscribed_date ');
          
          $messageStack->add(TEXT_INFO_SUBSCRIPTIONS_PURGED, 'success');
          break;
      }
    }
  }
  
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  
  function dpop() {

  if(document.getElementById('dpophelp')) { return false; }
  var e=document.createElement('div'); var mom;
  
  e.id='dpophelp'; e.style.border='3px #c00 double'; e.style.padding='5px 5px';
  e.style.background='#fff';
  e.style.margin='5px'; e.style.textAlign='left'; e.style.position='absolute';
  e.style.right='20%'; e.style.zIndex='3';
  e.style.width='50%'; e.style.top='10%'; 
  e.appendChild(document.createTextNode('Special search keywords:'));
  e.appendChild(document.createElement('br'));
  e.appendChild(document.createElement('br'));
  e.appendChild(document.createTextNode('customers - shows customers only'));
  e.appendChild(document.createElement('br'));
  e.appendChild(document.createElement('br'));
  e.appendChild(document.createTextNode('newsonly - shows non-pending newsletter-only subscribers'));
  e.appendChild(document.createElement('br'));
  e.appendChild(document.createElement('br'));
  e.appendChild(document.createTextNode('pending - shows pending newsletter-only subscribers'));
  mom = document.getElementById('searchbox');
  
  var Ce=document.createElement('p');
  Ce.style.textDecoration = 'underline'; Ce.style.cursor = 'pointer'; Ce.style.margin = '5px'; Ce.style.textAlign = 'right';
  Ce.style.color = '#c00'; Ce.onclick = dpopbye; Ce.appendChild(document.createTextNode('Close'));
  e.appendChild(Ce);
  if(mom) { mom.appendChild(e); }
  return false;

  }

  function dpopbye() { var fsw = document.getElementById('dpophelp'); fsw.parentNode.removeChild(fsw); }

  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->

<table style="border:none;width:100%;border-spacing:2px;cell-padding:2px;">
  <tr>
<!-- body_text //-->
    <td style="width:100%;vertical-align:top;">
    <table style="border:none;width:100%;border-collapse:collapse;border-collapse:collapse;border-spacing:0px;cell-padding:2px;">
      <tr>
        <td>
<?php if($action=='remove') { ?>
<p>
		<?php echo sprintf(TEXT_NEWSONLY_REMOVE_CONFIRM, zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=remove_confirmed'), zen_href_link(FILENAME_SUBSCRIPTION_MANAGER) ); ?>
</p>
<?php } ?>

        <table style="border:none;width:100%; border-spacing:0;cell-padding:0;">
          <tr style="padding-top:10px;">
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" colspan="2" style="text-align:right;vertical-align:top;padding-bottom:10px;">
<?php if(!defined('NEWSONLY_SUBSCRIPTION_ENABLED') ) { ?>
              <a href="<?php echo zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=install'); ?>"><?php echo zen_image_button('button_install.gif', TEXT_INSTALL); ?></a>
<?php } elseif($action != 'remove') { ?>
<?php   if(!defined('NEWSONLY_SUBSCRIPTION_VERSION') || (NEWSONLY_SUBSCRIPTION_VERSION < $current_ns_version ) ) { ?>
              <a href="<?php echo zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=update_contrib'); ?>"><?php echo zen_image_button('button_update.gif', TEXT_UPDATE); ?></a>
<?php } ?>
              <a href="<?php echo zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=remove'); ?>"><?php echo zen_image_button('button_remove.gif', TEXT_REMOVE); ?></a>
<?php } ?>
            </td>
          </tr>
          <tr>
            <td class="pageHeading" colspan="2" style="text-align:left;vertical-align:top;">
<?php if(defined('NEWSONLY_SUBSCRIPTION_ENABLED') &&
         (NEWSONLY_SUBSCRIPTION_ENABLED == 'true')) { ?>
              <a href="<?php echo zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=new'); ?>"><?php echo zen_image_button('button_new_subscription.gif', TEXT_INFO_HEADING_NEW_SUBSCRIPTION); ?></a> &nbsp; &nbsp; &nbsp; 
              <a href="<?php echo zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=purgeunconfirmed'); ?>"><?php echo zen_image_button('button_purge_subscriptions.gif', TEXT_PURGE_SUBSCRIPTIONS); ?></a> &nbsp; &nbsp; &nbsp; 
              <a href="<?php echo zen_href_link(FILENAME_SUBSCRIPTION_MANAGER,'action=import'); ?>"><?php echo zen_image_button('button_import.gif', TEXT_IMPORT); ?></a> 
<?php } ?>
            </td>
          </tr>
<?php if(defined('NEWSONLY_SUBSCRIPTION_ENABLED') ) { ?>
          
          <tr style="padding-top:10px;vertical-align:bottom;">
            <td><?php echo TABLE_HEADING_SUBSCRIPTION_STATUS.': '.
                substr(TEXT_SUBSCRIPTION_STATUS_CUSTOMER,0,1).'=' . TEXT_SUBSCRIPTION_STATUS_CUSTOMER . '&nbsp;&nbsp;&nbsp;' .
                substr(TEXT_SUBSCRIPTION_STATUS_CONFIRMED,0,1).'=' . TEXT_SUBSCRIPTION_STATUS_CONFIRMED . '&nbsp;&nbsp;&nbsp;'.
                substr(TEXT_SUBSCRIPTION_STATUS_UNCONFIRMED,0,1).'=' . TEXT_SUBSCRIPTION_STATUS_UNCONFIRMED;
            ?>
            </td>
            <td id="searchbox" class="smallText" style="vertical-align:middle;text-align:right;">
<?php echo zen_draw_form('search', FILENAME_SUBSCRIPTION_MANAGER, '', 'get', '', true); ?>
<?php
// show reset search
    if (isset($_GET['filter']) && zen_not_null($_GET['filter'])) {
      echo '<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, '', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
    }
    echo HEADING_TITLE_SEARCH_DETAIL . '<span style="cursor:pointer;" onclick="dpop();">[?]</span> ' . zen_draw_input_field('filter') . zen_hide_session_id() . '&nbsp;&nbsp;' . zen_image_submit('button_search.gif', IMAGE_SEARCH);
    if (isset($_GET['filter']) && zen_not_null($_GET['filter'])) {
      $keywords = zen_db_input(zen_db_prepare_input($_GET['filter']));
      echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
    }
?>
          </form>
            </td>
          </tr>
        </table></td>
      </tr>
<?php
  // Sort Listing
  $list_order = empty($_GET['list_order']) ? 'id-desc' : $_GET['list_order'];
  switch ($list_order) {
    case 'id-asc': $disp_order = 'subscriber_id'; break;
    case 'id-desc': $disp_order = 'subscriber_id DESC'; break;
    case 'subscribed': $disp_order = 'subscribed_date'; break;
    case 'subscribed-desc': $disp_order = 'subscribed_date DESC'; break;
    case 'email': $disp_order = 'email_address'; break;
    case 'email-desc': $disp_order = 'email_address DESC'; break;
    case 'format': $disp_order = 'email_format'; break;
    case 'format-desc': $disp_order = 'email_format DESC'; break;
    case 'status': $disp_order = 'confirmed'; break;
    case 'status-desc': $disp_order = 'confirmed DESC'; break;
    default: $list_order='id-desc'; $disp_order = 'subscriber_id DESC';
  }
  $filter = empty($_GET['filter']) ? '' : $_GET['filter'];
  $filter= zen_db_prepare_input($filter);
  $filter_str='';
  if(!empty($filter)) {
    switch($filter) {
      case 'customers' : $filter_str = ' where customers_id <> 0'; break;
      case 'news-only' : 
      case 'newsonly' : $filter_str = ' where customers_id = 0 or customers_id IS NULL '; break;
      case 'pending' : $filter_str = ' where confirmed != 1 '; break;
      default: $filter_str = " where email_address LIKE '%".$filter."%' or email_format LIKE '%".$filter."%' "; break;
    }
  }
  
    $classes_query_raw = 
      "select subscriber_id, customers_id, email_address, email_format, confirmed, subscribed_date from " . TABLE_SUBSCRIBERS . $filter_str .
      " order by ".$disp_order;
    $classes_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $classes_query_raw, $classes_query_numrows);
    $classes = $db->Execute($classes_query_raw);
    
?>
      <tr>
        <td>
        <table style="border:none;width:100%;border-collapse:collapse;border-collapse:collapse;border-spacing:0px;cell-padding:0px;">
          <tr>
            <td style="vertical-align:top;"><table style="border:none;width:100%;border-collapse:collapse;border-spacing:0px;cell-padding:2px;">
              <tr class="dataTableHeadingRow">
              
                <td class="dataTableHeadingContent" style="text-align:left;">
                  <?php echo (($list_order=='email' or $list_order=='email-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_EMAIL . '</span>' : TABLE_HEADING_EMAIL); ?><br />
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=email' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='email' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=email-desc' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='email-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                </td>

                <td class="dataTableHeadingContent" style="text-align:left;">
                  <?php echo (($list_order=='format' or $list_order=='format-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_PREFERENCE . '</span>' : TABLE_HEADING_PREFERENCE); ?><br />
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=format' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='format' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=format-desc' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='format-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                </td>

                <td class="dataTableHeadingContent" style="text-align:left;">
                  <?php echo (($list_order=='status' or $list_order=='status-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_SUBSCRIPTION_STATUS . '</span>' : TABLE_HEADING_SUBSCRIPTION_STATUS); ?><br />
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=status' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='status' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=status-desc' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='status-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                </td>

                <td class="dataTableHeadingContent" style="text-align:left;">
                  <?php echo (($list_order=='subscribed' or $list_order=='subscribed-desc') ? '<span class="SortOrderHeader">' . TEXT_SUBSCRIPTION_DATE . '</span>' : TEXT_SUBSCRIPTION_DATE); ?><br />
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=subscribed' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='subscribed' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=subscribed-desc' . (empty($filter) ? '' : '&amp;filter=' . $filter), '', 'NONSSL'); ?>"><?php echo ($list_order=='subscribed-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                </td>
                
                <td colspan="2" class="dataTableHeadingContent" style="text-align:center;"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>


<?php
  if(!empty($classes)) {
    while (!$classes->EOF) {
      if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $classes->fields['subscriber_id']))) && !isset($tcInfo) && (substr($action, 0, 3) != 'new')) {
        $tcInfo = new objectInfo($classes->fields);
      }
  
      if (isset($tcInfo) && is_object($tcInfo) && ($classes->fields['subscriber_id'] == $tcInfo->subscriber_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . '&amp;action=edit' . $extra_args) . '\'">' . "\n";
      } else {
        echo'              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $classes->fields['subscriber_id'] . $extra_args ) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $classes->fields['email_address']; ?></td>
                <td class="dataTableContent"><?php echo $classes->fields['email_format']; ?></td>
                <td class="dataTableContent">
                    <?php
                      if (!empty($classes->fields['customers_id'])) { echo '<span title="' . TEXT_SUBSCRIPTION_STATUS_CUSTOMER .'" >'.substr(TEXT_SUBSCRIPTION_STATUS_CUSTOMER,0,1).'</span>'; }
                      elseif ($classes->fields['confirmed'] == 1) { echo '<span title="' . TEXT_SUBSCRIPTION_STATUS_CONFIRMED .'" >'.substr(TEXT_SUBSCRIPTION_STATUS_CONFIRMED,0,1).'</span>'; }
                      else { echo '<span title="' . TEXT_SUBSCRIPTION_STATUS_UNCONFIRMED .'" >'.substr(TEXT_SUBSCRIPTION_STATUS_UNCONFIRMED,0,1).'</span>'; }
                    ?>
                    </td>
                <td class="dataTableContent"><?php echo zen_date_short($classes->fields['subscribed_date']); ?></td>
                    
                <td class="dataTableContent" style="text-align:right;">
                <?php if (isset($tcInfo) && is_object($tcInfo) && 
                ($classes->fields['subscriber_id'] == $tcInfo->subscriber_id) && $action=='edit') {
                echo '&nbsp;'; } else { echo '<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $classes->fields['subscriber_id'] . '&amp;action=edit'.$extra_args) . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', IMAGE_ICON_EDIT) . '</a>'; } ?> </td>
                <td class="dataTableContent" style="text-align:right;"><?php if (isset($tcInfo) && is_object($tcInfo) && ($classes->fields['subscriber_id'] == $tcInfo->subscriber_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $classes->fields['subscriber_id'].$extra_args) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
      $classes->MoveNext();
    }
?>
              <tr>
                <td colspan="2"><table style="border:none;width:100%;border-collapse:collapse;border-collapse:collapse;border-spacing:0px;cell-padding:2px;">
                  <tr>
                    <td class="smallText" style="vertical-align:top;"></td>
                    <td class="smallText" style="text-align:right;"><?php echo $classes_split->display_links($classes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], $extra_args == '' ? '' : substr($extra_args,1)); ?></td>
                  </tr>
<?php
    if (empty($action)) {
?>
                  <tr>
                    <td colspan="2" style="text-align:right;"></td>
                  </tr>
<?php
    }
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

         
  $email_pref_text = (empty($tcInfo->email_format) || ($tcInfo->email_format == 'TEXT')) ? true : false;
  $email_pref_html = (empty($email_pref_text) ? true : false );

  switch ($action) {
    case 'import':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_IMPORT_SUBSCRIPTION . '</b>');

      $contents = array('form' => zen_draw_form('classes', FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;action=import_file','post','enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_IMPORT_INTRO);
      $contents[] = array('text' =>  zen_draw_hidden_field('MAX_FILE_SIZE','100000'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_IMPORT_FILE . '<br />' . zen_draw_file_field('subscriber_import_file',true));
      $contents[] = array('text' => '<br />' . TEXT_INFO_IMPORT_SAMPLE . ' ' . zen_draw_input_field('record_sample', 'email NULL format NULL', 'size="100%"'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_IMPORT_DELIM . ' ' . zen_draw_input_field('record_delim', '', 'size="5"'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_IMPORT_ENCL . ' ' . zen_draw_input_field('field_encl', '', 'size="5"'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_IMPORT_HEADER_ROW . ' ' . zen_draw_checkbox_field('record_header', '1'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_IMPORT_FORMAT . ' ' . 
                                             zen_draw_radio_field('default_format','TEXT',true) . ENTRY_EMAIL_TEXT_DISPLAY . ' &nbsp; '. 
                                             zen_draw_radio_field('default_format','HTML',true) . ENTRY_EMAIL_HTML_DISPLAY  );
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_upload.gif', IMAGE_UPLOAD) . '&nbsp;<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
  
  
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_SUBSCRIPTION . '</b>');

      $contents = array('form' => zen_draw_form('classes', FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_SUBSCRIBERS, 'email_address')));
      $contents[] = array('text' => '<br />' . TABLE_HEADING_PREFERENCE . '<br />' . 
                    zen_draw_radio_field('email_format', 'HTML', $email_pref_html) . '&nbsp;' . ENTRY_EMAIL_HTML_DISPLAY . '&nbsp;&nbsp;&nbsp;' . 
                    zen_draw_radio_field('email_format', 'TEXT', $email_pref_text) . '&nbsp;' . ENTRY_EMAIL_TEXT_DISPLAY);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_SUBSCRIPTION . '</b>');

      $contents = array('form' => zen_draw_form('classes', FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . '&amp;action=save'.$extra_args));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLASS_TITLE . '<br />' . zen_draw_input_field('email_address', $tcInfo->email_address, zen_set_field_length(TABLE_SUBSCRIBERS, 'email_address')));
      $contents[] = array('text' => '<br />' . TABLE_HEADING_PREFERENCE . '<br />' . 
                    zen_draw_radio_field('email_format', 'HTML', $email_pref_html) . '&nbsp;' . ENTRY_EMAIL_HTML_DISPLAY . '&nbsp;&nbsp;&nbsp;' . 
                    zen_draw_radio_field('email_format', 'TEXT', $email_pref_text) . '&nbsp;' . ENTRY_EMAIL_TEXT_DISPLAY
      );
      if(empty($tcInfo->customers_id)) {
        $contents[] = array('text' => '<br />' . TEXT_INFO_CONFIRMED . ' ' . zen_draw_checkbox_field('email_confirmed', '1', ((empty($tcInfo->confirmed)||($tcInfo->confirmed != 1)) ? '0' : '1')));
      }
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . $extra_args) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_EMAIL . '</b>');

      $contents = array('form' => zen_draw_form('classes', FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . '&amp;cID=' . $tcInfo->customers_id . '&amp;action=deleteconfirm' . $extra_args));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $tcInfo->email_address . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . $extra_args) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($tcInfo) && is_object($tcInfo)) {
        $heading[] = array('text' => '<b>' . $tcInfo->email_address . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . '&amp;action=edit'.$extra_args) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_SUBSCRIPTION_MANAGER, 'page=' . $_GET['page'] . '&amp;tID=' . $tcInfo->subscriber_id . '&amp;cID=' . $tcInfo->customers_id .'&amp;action=delete'.$extra_args) . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        if(!empty($tcInfo->customers_id) || ($tcInfo->confirmed==1)) {
          $contents[] = array('align' => 'center',
            'text' => 
              ' <a href="' . zen_href_link(FILENAME_MAIL, 'origin=customers.php&mode=NONSSL&selected_box=tools&customer=' .
              $tcInfo->email_address.'&amp;cID=' . $tcInfo->customers_id, 'NONSSL') . '">' . 
              zen_image_button('button_email.gif', IMAGE_EMAIL) . '</a>'
          );
        } else {
        $contents[] = array('text' => '<br />' .
        TEXT_INFO_SUBSCRIPTION_STATUS_UNCONFIRMED);
        }
        $contents[] = array('text' => '<br />' . TEXT_SUBSCRIPTION_DATE . ': ' .$tcInfo->subscribed_date . '<br />');
        $contents[] = array('text' => '<br />' . TABLE_HEADING_PREFERENCE . ': ' . $tcInfo->email_format);
      }
      break;
  }
  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td style="width:25%;vertical-align:top;">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php } ?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
