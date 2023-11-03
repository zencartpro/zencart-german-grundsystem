<?php
/** 
 * Zen Cart German Specific
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: dsgvo_kundenxport.php 2023-11-03 16:24:51Z webchills $
 */
require('includes/application_top.php');

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$group_array = array();

$action = (isset($_GET['action']) ? $_GET['action'] : '');
$customers_id = isset($_GET['cID']) ? (int)$_GET['cID'] : 0;
if (isset($_POST['cID'])) $customers_id = (int)$_POST['cID'];
if (!isset($_GET['page'])) $_GET['page'] = '';
if (!isset($_GET['list_order'])) $_GET['list_order'] = '';

$error = false;
$processed = false;

if (zen_not_null($action)) {
  switch ($action) {
    case 'list_addresses':
      $addresses_query = "SELECT address_book_id, entry_firstname as firstname, entry_lastname as lastname,
                                 entry_company as company, entry_street_address as street_address,
                                 entry_suburb as suburb, entry_city as city, entry_postcode as postcode,
                                 entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id
                          FROM   " . TABLE_ADDRESS_BOOK . "
                          WHERE  customers_id = :customersID
                          ORDER BY firstname, lastname";

      $addresses_query = $db->bindVars($addresses_query, ':customersID', $_GET['cID'], 'integer');

      $zco_notifier->notify('NOTIFY_ADMIN_CUSTOMERS_LIST_ADDRESSES', $addresses_query);

      $addresses = $db->Execute($addresses_query);
      $addressArray = array();
      foreach ($addresses as $address) {
        $format_id = zen_get_address_format_id($address['country_id']);

        $addressArray[] = array(
          'firstname' => $address['firstname'],
          'lastname' => $address['lastname'],
          'address_book_id' => $address['address_book_id'],
          'format_id' => $format_id,
          'address' => $address);
      }
      break;
      
   
 
?>


<?php
die();
break;
case 'list_addresses_done':
$action = '';
zen_redirect(zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, 'cID=' . (int)$_GET['cID'] . '&page=' . $_GET['page'], 'NONSSL'));
break;
      
case 'dsgvoexport':    
$output = fopen("php://output",'w') or die("Can't open php://output");
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition:attachment; filename=dsgvo_kundendatensatz_kundennummer_".$_GET['cID'].".csv"); 

$dsgvo_export_array = $db->Execute("SELECT 
											c.customers_gender, 
											c.customers_firstname, 
											c.customers_lastname, 
											c.customers_email_address, 
											c.customers_dob,
											ab.entry_company, 											
											ab.entry_street_address, 
											ab.entry_postcode, 
											ab.entry_city, 											
											co.countries_name, 
											c.customers_telephone, 
											c.customers_fax ,
											ci.customers_info_date_account_created,
											ci.customers_info_date_of_last_logon
											FROM ".TABLE_CUSTOMERS." c 
											JOIN ".TABLE_CUSTOMERS_INFO." ci 
											ON c.customers_id = ci.customers_info_id 
											JOIN ".TABLE_ADDRESS_BOOK." ab 
											ON c.customers_id = ab.customers_id 
											JOIN ".TABLE_COUNTRIES." co
											ON co.countries_id = ab.entry_country_id 
											WHERE c.customers_id = ".$_GET['cID']);
											

    fputcsv($output, array(DSGVO_CUSTOMERDATA_HEADING),';');
    fputcsv($output, array(''),';');

    foreach ($dsgvo_export_array->fields as $key=>$value) {
        if ($key == 'customers_gender') {
            if ($value == 'm') {
                $value = MALE;
            
            } else if ($value == 'f') {
            	$value = FEMALE;
            }  else {
            	$value = NONE;
            	
            } 
                       
        }
        if ($key == 'customers_dob') {
            if ($value == '0001-01-01 00:00:00') {
                $value = '';
            
            
            }  else {
            	$value = $dsgvo_export_array->fields['customers_dob'];
            	
            } 
                       
        }
        
        fputcsv($output, array(constant('DSGVO_'.strtoupper($key)),$value),';');           
    }     
    fputcsv($output, array(''),';');

    $dsgvo_export_reviews_array = $db->Execute("SELECT 
											r.date_added, 
											rd.reviews_text, 
											pd.products_name 
											FROM ".TABLE_REVIEWS." r 
											JOIN ".TABLE_REVIEWS_DESCRIPTION." rd 
											ON r.reviews_id = rd.reviews_id 
											JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd 
											ON pd.products_id = r.products_id 
											WHERE customers_id =".$_GET['cID']." 
											AND pd.language_id = ".$_SESSION['languages_id']);
											
		if ($dsgvo_export_reviews_array->RecordCount() > 0) { 											
			
        $rNum = 1;
        fputcsv($output, array(DSGVO_REVIEWS_HEADING),';');
        fputcsv($output, array(''),';');
        while (!$dsgvo_export_reviews_array->EOF) {
       
            fputcsv($output, array(DSGVO_REVIEW_HEADING." ".$rNum,),';'); 
            fputcsv($output, array(DSGVO_DATE,date('d.m.Y', strtotime($dsgvo_export_reviews_array->fields['date_added']))),';');
            fputcsv($output, array(DSGVO_PRODUCT_NAME,$dsgvo_export_reviews_array->fields['products_name']),';');
            fputcsv($output, array(DSGVO_REVIEWS_TEXT,$dsgvo_export_reviews_array->fields['reviews_text']),';');
            fputcsv($output, array(''),';');

            $rNum++;
            $dsgvo_export_reviews_array->MoveNext();
        }
    }

    $dsgvo_orders_array = $db->Execute("SELECT *
										FROM ".TABLE_ORDERS." o 
										WHERE customers_id = ".$_GET['cID']);
										
		if ($dsgvo_orders_array->RecordCount() > 0) { 	    

        fputcsv($output, array(DSGVO_ORDERS_HEADING),';');
        fputcsv($output, array(''),';');  

        $oNum = 1;

while (!$dsgvo_orders_array->EOF) {        

            fputcsv($output, array(DSGVO_ORDER_HEADING." ".$oNum),';'); 
            fputcsv($output, array(DSGVO_ORDER_ID,$dsgvo_orders_array->fields['orders_id']),';'); 
            fputcsv($output, array(DSGVO_ORDER_DATE,$dsgvo_orders_array->fields['date_purchased']),';'); 
            fputcsv($output, array(DSGVO_ORDER_IP_ADDRESS,$dsgvo_orders_array->fields['ip_address']),';'); 
                            
            fputcsv($output, array(DSGVO_CUSTOMER_ADDRESS,$dsgvo_orders_array->fields['customers_name'],$dsgvo_orders_array->fields['customers_street_address'],$dsgvo_orders_array->fields['customers_postcode'].' '.$dsgvo_orders_array->fields['customers_city'],$dsgvo_orders_array->fields['customers_country']),';'); 
            fputcsv($output, array(DSGVO_SHIPPING_ADDRESS,$dsgvo_orders_array->fields['delivery_name'],$dsgvo_orders_array->fields['delivery_street_address'],$dsgvo_orders_array->fields['delivery_postcode'].' '.$dsgvo_orders_array->fields['delivery_city'],$dsgvo_orders_array->fields['delivery_country']),';'); 
            fputcsv($output, array(DSGVO_BILLING_ADDRESS,$dsgvo_orders_array->fields['billing_name'],$dsgvo_orders_array->fields['billing_street_address'],$dsgvo_orders_array->fields['billing_postcode'].' '.$dsgvo_orders_array->fields['billing_city'],$dsgvo_orders_array->fields['billing_country']),';'); 
            
            fputcsv($output, array(DSGVO_PAYMENT_METHOD,$dsgvo_orders_array->fields['payment_method']),';'); 
            $dsgvo_orders_array->MoveNext();
            $dsgvo_product_array = $db->Execute("SELECT op.orders_id, op.orders_products_id, op.products_quantity, op.products_name, op.products_model, op.products_id FROM ".TABLE_ORDERS_PRODUCTS." op WHERE op.orders_id = ".$dsgvo_orders_array->fields['orders_id']);

            $first_product = true;
            
            while (!$dsgvo_product_array->EOF) {           
                
                $attribute_query = $db->Execute ("SELECT opa.products_options, opa.products_options_values FROM ".TABLE_ORDERS_PRODUCTS_ATTRIBUTES." opa WHERE opa.orders_id = ".$dsgvo_product_array->fields['orders_id']." AND opa.orders_products_id = ".$dsgvo_product_array->fields['orders_products_id']);

                $attr_string = '';

             if ($attribute_query->RecordCount() > 0) { 	
                    
while (!$attribute_query->EOF) {
                       
                          $attr_string.= ' / '.$attribute_query->fields['products_options'].': '.$attribute_query->fields['products_options_values'];   
                          $attribute_query->MoveNext();                         
                        }   
                                                      
                    }

                    if ($first_product) {
                        fputcsv($output, array(DSGVO_ORDER_HEADING,$dsgvo_product_array->fields['products_quantity']." x ".$dsgvo_product_array->fields['products_name']." ".$attr_string,DSGVO_PRODUCT_NUMBER.": ".$dsgvo_product_array->fields['products_model']),';');  
                        $first_product = false;
                    } else {
                        fputcsv($output, array('',$dsgvo_product_array->fields['products_quantity']." x ".$dsgvo_product_array->fields['products_name']." ".$attr_string,DSGVO_PRODUCT_NUMBER.": ".$dsgvo_product_array->fields['products_model']),';'); 
                    }  
                   
             $dsgvo_product_array->MoveNext();         
            }                 

            $dsgvo_order_total_array = $db->Execute ("SELECT ot.text, ot.value, ot.title FROM ".TABLE_ORDERS_TOTAL." ot WHERE ot.orders_id = ".$dsgvo_orders_array->fields['orders_id'] ." ORDER BY ot.sort_order ASC");               

            while (!$dsgvo_order_total_array->EOF) {
                fputcsv($output, array('','','', strip_tags(html_entity_decode($dsgvo_order_total_array->fields['title'])).strip_tags($dsgvo_order_total_array->fields['text'])),';');
            $dsgvo_order_total_array->MoveNext();
            }
            fputcsv($output, array(''),';');
            $oNum++;
        }
         
    }
    
    fclose($output) or die("Can't close php://output");
    exit();
  
        break;
      default:
        $customers = $db->Execute("select c.customers_id, c.customers_gender, c.customers_firstname,
                                          c.customers_lastname, c.customers_dob, c.customers_email_address,
                                          a.entry_company, a.entry_street_address, a.entry_suburb,
                                          a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id,
                                          a.entry_country_id, c.customers_telephone, c.customers_fax,
                                          c.customers_newsletter, c.customers_default_address_id,
                                          c.customers_email_format, c.customers_group_pricing,
                                          c.customers_authorization, c.customers_referral
                                  from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a
                                  on c.customers_default_address_id = a.address_book_id
                                  where a.customers_id = c.customers_id
                                  and c.customers_id = '" . (int)$customers_id . "'");

        $cInfo = new objectInfo($customers->fields);
    }
  }
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>

</head>
<body onLoad="init()">
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->

    <!-- body //-->
    <div class="container-fluid">
      <!-- body_text //-->
      <h1><?php echo HEADING_TITLE; ?></h1>
            <span class="overview"><?php echo DSGVO_KUNDENEXPORT_OVERVIEW; ?></span>
           <div class="row text-right">
            <?php echo zen_draw_form('search', FILENAME_DSGVO_KUNDENEXPORT, '', 'get', '', true); ?>
         
            <?php
// show reset search
            if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
              echo '<a href="' . zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, '', 'NONSSL') . '" class="btn btn-default" role="button">' . IMAGE_RESET . '</a>&nbsp;&nbsp;';
            }
            echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search') . zen_hide_session_id();
            if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
              $keywords = zen_db_prepare_input($_GET['search']);
              echo '<br>' . TEXT_INFO_SEARCH_DETAIL_FILTER . zen_output_string_protected($keywords);
            }
            ?>
            <?php echo '</form>'; ?>
        </div>
        <?php
// Sort Listing
        switch ($_GET['list_order']) {
          case 'id-asc':
            $disp_order = "ci.customers_info_date_account_created";
            break;
          case 'firstname':
            $disp_order = "c.customers_firstname";
            break;
          case 'firstname-desc':
            $disp_order = "c.customers_firstname DESC";
            break;
         
          case 'lastname':
            $disp_order = "c.customers_lastname, c.customers_firstname";
            break;
          case 'lastname-desc':
            $disp_order = "c.customers_lastname DESC, c.customers_firstname";
            break;
          case 'company':
            $disp_order = "a.entry_company";
            break;
          case 'company-desc':
            $disp_order = "a.entry_company DESC";
            break;
          case 'login-asc':
            $disp_order = "ci.customers_info_date_of_last_logon";
            break;
          case 'login-desc':
            $disp_order = "ci.customers_info_date_of_last_logon DESC";
            break;
              
          default:
            $disp_order = "ci.customers_info_date_account_created DESC";
        }
        ?>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
            <table class="table table-hover">
              <thead>
                <tr class="dataTableHeadingRow">
                  <th class="dataTableHeadingContent text-right">
                      <?php echo TABLE_HEADING_ID; ?>
                  </th>
                  <th class="dataTableHeadingContent">
                    <?php echo (($_GET['list_order'] == 'lastname' or $_GET['list_order'] == 'lastname-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_LASTNAME . '</span>' : TABLE_HEADING_LASTNAME); ?><br>
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=lastname', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'lastname' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=lastname-desc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'lastname-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                  </th>
                  <th class="dataTableHeadingContent">
                    <?php echo (($_GET['list_order'] == 'firstname' or $_GET['list_order'] == 'firstname-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_FIRSTNAME . '</span>' : TABLE_HEADING_FIRSTNAME); ?><br>
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=firstname', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'firstname' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=firstname-desc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'firstname-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                  </th>
                  <th class="dataTableHeadingContent">
                    <?php echo (($_GET['list_order'] == 'company' or $_GET['list_order'] == 'company-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_COMPANY . '</span>' : TABLE_HEADING_COMPANY); ?><br>
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=company', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'company' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=company-desc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'company-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                  </th>
                  <th class="dataTableHeadingContent">
                    <?php echo (($_GET['list_order'] == 'id-asc' or $_GET['list_order'] == 'id-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_ACCOUNT_CREATED . '</span>' : TABLE_HEADING_ACCOUNT_CREATED); ?><br>
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=id-asc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'id-asc' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=id-desc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'id-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                  </th>

                  <th class="dataTableHeadingContent">
                    <?php echo (($_GET['list_order'] == 'login-asc' or $_GET['list_order'] == 'login-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_LOGIN . '</span>' : TABLE_HEADING_LOGIN); ?><br>
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=login-asc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'login-asc' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</span>'); ?></a>&nbsp;
                    <a href="<?php echo zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('list_order', 'page')) . 'list_order=login-desc', 'NONSSL'); ?>"><?php echo ($_GET['list_order'] == 'login-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                  </th>
                  
                  

                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $search = '';
                  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
                    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
                    $parts = explode(" ", trim($keywords));
                    $search = 'where ';
                    foreach ($parts as $k => $v) {
                      $sql_add = " (c.customers_lastname like '%:part%'
                         or c.customers_firstname like '%:part%'
                         or c.customers_email_address like '%:part%'
                         or c.customers_telephone rlike ':keywords:'
                         or a.entry_company rlike ':keywords:'
                         or a.entry_street_address rlike ':keywords:'
                         or a.entry_city rlike ':keywords:'
                         or a.entry_postcode rlike ':keywords:')";
                      if ($k != 0) {
                        $sql_add = ' and ' . $sql_add;
                      }
                      $sql_add = $db->bindVars($sql_add, ':part', $v, 'noquotestring');
                      $sql_add = $db->bindVars($sql_add, ':keywords:', $v, 'regexp');
                      $search .= $sql_add;
                    }
                  }
                  $new_fields = '';

                  $zco_notifier->notify('NOTIFY_ADMIN_CUSTOMERS_LISTING_NEW_FIELDS', array(), $new_fields, $disp_order);

                  $customers_query_raw = "SELECT c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_group_pricing, c.customers_telephone, c.customers_authorization, c.customers_referral, c.customers_secret,
                                           a.entry_country_id, a.entry_company, a.entry_street_address, a.entry_city, a.entry_postcode,
                                           ci.customers_info_date_of_last_logon, ci.customers_info_date_account_created
                                           " . $new_fields . ",
                                           cgc.amount
                                    from " . TABLE_CUSTOMERS . " c
                                    left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id= ci.customers_info_id
                                    left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id " . "
                                    left join " . TABLE_COUPON_GV_CUSTOMER . " cgc on c.customers_id = cgc.customer_id
                                    " . $search . "
                                    order by " . $disp_order;

// Split Page
// reset page when page is unknown
                  if (($_GET['page'] == '' || $_GET['page'] == '1') && !empty($_GET['cID'])) {
                    $check_page = $db->Execute($customers_query_raw);
                    $check_count = 1;
                    if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER) {
                      foreach ($check_page as $item) {
                        if ($item['customers_id'] == $_GET['cID']) {
                          break;
                        }
                        $check_count++;
                      }
                      $_GET['page'] = round((($check_count / MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER) + (fmod_round($check_count, MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER) != 0 ? .5 : 0)), 0);
//    zen_redirect(zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, 'cID=' . $_GET['cID'] . (isset($_GET['page']) ? '&page=' . $_GET['page'] : ''), 'NONSSL'));
                    } else {
                      $_GET['page'] = 1;
                    }
                  }

                  $customers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER, $customers_query_raw, $customers_query_numrows);
                  $customers = $db->Execute($customers_query_raw);
                  foreach ($customers as $customer) {
                    $sql = "SELECT customers_info_date_account_created as date_account_created,
                             customers_info_date_account_last_modified as date_account_last_modified,
                             customers_info_date_of_last_logon as date_last_logon,
                             customers_info_number_of_logons as number_of_logons
                      FROM " . TABLE_CUSTOMERS_INFO . "
                      WHERE customers_info_id = " . (int)$customer['customers_id'];
                    $info = $db->Execute($sql);

                    // if no record found, create one to keep database in sync
                    if ($info->RecordCount() == 0) {
                      $insert_sql = "INSERT INTO " . TABLE_CUSTOMERS_INFO . " (customers_info_id)
                               VALUES ('" . (int)$customer['customers_id'] . "')";
                      $db->Execute($insert_sql);
                      $info = $db->Execute($sql);
                    }

                    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $customer['customers_id']))) && !isset($cInfo)) {
                      $country = $db->Execute("SELECT countries_name
                                         FROM " . TABLE_COUNTRIES . "
                                         WHERE countries_id = " . (int)$customer['entry_country_id']);

                      $reviews = $db->Execute("SELECT COUNT(*) AS number_of_reviews
                                         FROM " . TABLE_REVIEWS . "
                                         WHERE customers_id = " . (int)$customer['customers_id']);

                      $customer_info = array_merge($country->fields, $info->fields, $reviews->fields);

                      $cInfo_array = array_merge($customer, $customer_info);
                      $cInfo = new objectInfo($cInfo_array);
                    }

                    
                    if (isset($cInfo) && is_object($cInfo) && ($customer['customers_id'] == $cInfo->customers_id)) {
                      echo '          <tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href=\'' . zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, zen_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit', 'NONSSL') . '\'" role="button">' . "\n";
                    } else {
                      echo '          <tr class="dataTableRow" onclick="document.location.href=\'' . zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, zen_get_all_get_params(array('cID', 'action')) . 'cID=' . $customer['customers_id'], 'NONSSL') . '\'" role="button">' . "\n";
                    }

                    $zc_address_book_count_list = zen_get_customers_address_book($customer['customers_id']);
                  
                    ?>
                <td class="dataTableContent text-right"><?php echo $customer['customers_id']; ?></td>
                <td class="dataTableContent"><?php echo zen_output_string($customer['customers_lastname']); ?></td>
                <td class="dataTableContent"><?php echo zen_output_string($customer['customers_firstname']); ?></td>
                <td class="dataTableContent"><?php echo zen_output_string($customer['entry_company']); ?></td>
                
                
              
                <td class="dataTableContent"><?php echo zen_date_short($info->fields['date_account_created']); ?></td>
                <td class="dataTableContent"><?php echo zen_date_short($customer['customers_info_date_of_last_logon']); ?></td>
                
                
               
                </tr>
                <?php
              }
              ?>
              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 configurationColumnRight">
              <?php
              $heading = array();
              $contents = array();

              switch ($action) {
                default:
                  if (isset($_GET['search'])) {
                    $_GET['search'] = zen_output_string_protected($_GET['search']);
                  }
                  if (isset($cInfo) && is_object($cInfo)) {

                    $heading[] = array('text' => '<h4>' . TABLE_HEADING_ID . $cInfo->customers_id . ' ' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</h4>' . '<br>' . $cInfo->customers_email_address);

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, zen_get_all_get_params(array('cID', 'action', 'search')) . 'cID=' . $cInfo->customers_id . '&action=dsgvoexport', 'NONSSL') . '">' . zen_image_button('button_dsgvoexport.png', IMAGE_DSGVOEXPORT) . '</a>');
        
                    }
        $zco_notifier->notify('NOTIFY_ADMIN_CUSTOMERS_MENU_BUTTONS', $cInfo, $contents);
                  
                  
                  break;
             } 
              $zco_notifier->notify('NOTIFY_ADMIN_CUSTOMERS_MENU_BUTTONS_END', (isset($cInfo) ? $cInfo : new stdClass), $contents);

              if ((zen_not_null($heading)) && (zen_not_null($contents))) {
                $box = new box;
                echo $box->infoBox($heading, $contents);
              }
              ?>
          </div>
        </div>
        <div class="row">
          <table class="table">
            <tr>
              <td><?php echo $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
              <td class="text-right"><?php echo $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
            </tr>
            <?php
            if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
              ?>
              <tr>
                <td class="text-right" colspan="2"><?php echo '<a href="' . zen_href_link(FILENAME_DSGVO_KUNDENEXPORT, '', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
              </tr>
              <?php
            }
            ?>
          </table>
        </div>
        
      <!-- body_text_eof //-->
    </div>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
