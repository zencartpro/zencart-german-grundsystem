<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: adresskorrektur.php 2023-11-13 19:34:51Z webchills $
 */
  
require 'includes/application_top.php';

// Use the normal order class instead of the admin one
require DIR_FS_CATALOG . DIR_WS_CLASSES . 'order.php';

$oID = zen_db_prepare_input($_GET['oID']);
  

  $action = (isset($_GET['action']) ? $_GET['action'] : 'edit');

  if (zen_not_null($action)) {
    

    switch ($action) {

	// Update Order
	case 'update_order':
		

		$order_updated = false;
		$sql_data_array = [
			'customers_name' => zen_db_prepare_input($_POST['update_customer_name']),
			'customers_company' => zen_db_prepare_input($_POST['update_customer_company']),
			'customers_street_address' => zen_db_prepare_input($_POST['update_customer_street_address']),
			'customers_suburb' => zen_db_prepare_input($_POST['update_customer_suburb']),
			'customers_city' => zen_db_prepare_input($_POST['update_customer_city']),
			'customers_state' => zen_db_prepare_input($_POST['update_customer_state']),
			'customers_postcode' => zen_db_prepare_input($_POST['update_customer_postcode']),
			'customers_country' => zen_db_prepare_input($_POST['update_customer_country']),
			'customers_telephone' => zen_db_prepare_input($_POST['update_customer_telephone']),
			'customers_email_address' => zen_db_prepare_input($_POST['update_customer_email_address']),
			

			'billing_name' => zen_db_prepare_input($_POST['update_billing_name']),
			'billing_company' => zen_db_prepare_input($_POST['update_billing_company']),
			'billing_street_address' => zen_db_prepare_input($_POST['update_billing_street_address']),
			'billing_suburb' => zen_db_prepare_input($_POST['update_billing_suburb']),
			'billing_city' => zen_db_prepare_input($_POST['update_billing_city']),
			'billing_state' => zen_db_prepare_input($_POST['update_billing_state']),
			'billing_postcode' => zen_db_prepare_input($_POST['update_billing_postcode']),
			'billing_country' => zen_db_prepare_input($_POST['update_billing_country']),

			'delivery_name' => zen_db_prepare_input($_POST['update_delivery_name']),
			'delivery_company' => zen_db_prepare_input($_POST['update_delivery_company']),
			'delivery_street_address' => zen_db_prepare_input($_POST['update_delivery_street_address']),
			'delivery_suburb' => zen_db_prepare_input($_POST['update_delivery_suburb']),
			'delivery_city' => zen_db_prepare_input($_POST['update_delivery_city']),
			'delivery_state' => zen_db_prepare_input($_POST['update_delivery_state']),
			'delivery_postcode' => zen_db_prepare_input($_POST['update_delivery_postcode']),
			'delivery_country' => zen_db_prepare_input($_POST['update_delivery_country'])
			
		];

		

		

		zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = \'' . (int)$oID . '\'');
		unset($sql_data_array);
$order_updated = true;
	
		       

		if($order_updated) {
			$messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
		}
		else {
			$messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
		}

        

    zen_redirect(zen_href_link(FILENAME_ADRESSKORREKTUR, zen_get_all_get_params(array('action')) . 'action=edit', 'NONSSL'));
     break;

   
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $orders_query = $db->Execute("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!$orders_query->RecordCount()) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    } else {
        $order = adresskorrektur_get_order_by_id($oID);

        
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
<style>
.eo-label { font-weight: bold; text-align:right;margin-right:3px;white-space: nowrap; }
</style>
</head>
<body onLoad="init()">
<!-- header //-->
<div class="header-area">
<?php
    require DIR_WS_INCLUDES . 'header.php';
?>
</div>
<!-- header_eof //-->

    <!-- body //-->
    <div class="container-fluid">
<?php
  if (($action == 'edit') && ($order_exists == true)) {

?>
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
 


      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?> #<?php echo $oID; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="pageHeading" align="right">
	    <?php echo '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?>
	    <?php echo '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_ORDER_DETAILS) . '</a>'; ?>
	    </td>
         </tr>
        </table></td>
      </tr>


<!-- Begin Addresses Block -->
      <tr>
      <td><?php echo zen_draw_form('adresskorrektur', FILENAME_ADRESSKORREKTUR, zen_get_all_get_params(array('action')) . 'action=update_order'); ?>
      <table width="100%" border="0">
	  <tr>
	  <td>
      <table width="100%" border="0">
 <tr>
    <td>&nbsp;</td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER; ?></strong></td>
    <td>&nbsp;</td>
    <td valign="top"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
    <td>&nbsp;</td>
    <td valign="top"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
  </tr>
 <tr>
    <td>&nbsp;</td>
    <td valign="top"><?php echo zen_image(DIR_WS_IMAGES . 'icon_adresskorrektur_kunde.png', ENTRY_CUSTOMER); ?></td>
    <td>&nbsp;</td>
    <td valign="top"><?php echo zen_image(DIR_WS_IMAGES . 'icon_adresskorrektur_rechnungsadresse.png', ENTRY_BILLING_ADDRESS); ?></td>
    <td>&nbsp;</td>
    <td valign="top"><?php echo zen_image(DIR_WS_IMAGES . 'icon_adresskorrektur_lieferadresse.png', ENTRY_SHIPPING_ADDRESS); ?></td>
  </tr>

  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_NAME, 'entry_name', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_name" size="35" value="<?php echo zen_output_string_protected($order->customer['name']); ?>"></td>
   <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_NAME, 'entry_name', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_name" size="35" value="<?php echo zen_output_string_protected($order->billing['name']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_NAME, 'entry_name', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_name" size="35" value="<?php echo zen_output_string_protected($order->delivery['name']); ?>"></td>
  </tr>
  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_COMPANY, 'entry_company', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_company" size="35" value="<?php echo zen_output_string_protected($order->customer['company']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_COMPANY, 'entry_company', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_company" size="35" value="<?php echo zen_output_string_protected($order->billing['company']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_COMPANY, 'entry_company', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_company" size="35" value="<?php echo zen_output_string_protected($order->delivery['company']); ?>"></td>
  </tr>
  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_ADDRESS, 'entry_address', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_street_address" size="35" value="<?php echo zen_output_string_protected($order->customer['street_address']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_ADDRESS, 'entry_address', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_street_address" size="35" value="<?php echo zen_output_string_protected($order->billing['street_address']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_ADDRESS, 'entry_address', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_street_address" size="35" value="<?php echo zen_output_string_protected($order->delivery['street_address']); ?>"></td>
  </tr>
  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_SUBURB, 'entry_suburb', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_suburb" size="35" value="<?php echo zen_output_string_protected($order->customer['suburb']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_SUBURB, 'entry_suburb', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_suburb" size="35" value="<?php echo zen_output_string_protected($order->billing['suburb']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_SUBURB, 'entry_suburb', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_suburb" size="35" value="<?php echo zen_output_string_protected($order->delivery['suburb']); ?>"></td>
  </tr>
  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_CITY, 'entry_city', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_city" size="35" value="<?php echo zen_output_string_protected($order->customer['city']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_CITY, 'entry_city', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_city" size="35" value="<?php echo zen_output_string_protected($order->billing['city']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_CITY, 'entry_city', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_city" size="35" value="<?php echo zen_output_string_protected($order->delivery['city']); ?>"></td>
  </tr>
  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_STATE, 'entry_state', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_state" size="35" value="<?php echo zen_output_string_protected($order->customer['state']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_STATE, 'entry_state', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_state" size="35" value="<?php echo zen_output_string_protected($order->billing['state']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_STATE, 'entry_state', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_state" size="35" value="<?php echo zen_output_string_protected($order->delivery['state']); ?>"></td>
  </tr>
  <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_POSTCODE, 'entry_postcode', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_postcode" size="35" value="<?php echo zen_output_string_protected($order->customer['postcode']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_POSTCODE, 'entry_postcode', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_postcode" size="35" value="<?php echo zen_output_string_protected($order->billing['postcode']); ?>"></td>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_POSTCODE, 'entry_postcode', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_postcode" size="35" value="<?php echo zen_output_string_protected($order->delivery['postcode']); ?>"></td>
  </tr>
         <tr>
    <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_COUNTRY, 'entry_country', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_customer_country" size="35" value="<?php echo $order->customer['country']['title']; ?>"></td>
  <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_COUNTRY, 'entry_country', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_billing_country" size="35" value="<?php echo $order->billing['country']['title']; ?>"></td>
      <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_CUSTOMER_COUNTRY, 'entry_country', 'class="col-sm-3 control-label"'); ?></label></td>
    <td valign="top"><input class="form-control" name="update_delivery_country" size="35" value="<?php echo $order->delivery['country']['title']; ?>"></td>
        </tr>

</table>
</td></tr></table>
<!-- End Addresses Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Phone/Email Block -->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
      		<tr>
      		
      		  <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_TELEPHONE_NUMBER, 'entry_telephone', 'class="col-sm-3 control-label"'); ?></label></td>
      		  		
      		 <td><input class="form-control" name='update_customer_telephone' size='35' value='<?php echo zen_output_string_protected($order->customer['telephone']); ?>'></td>
      		</tr>
      		<tr>
      		 <td class="eo-label"><label><?php echo zen_draw_label(ENTRY_EMAIL_ADDRESS, 'entry_email_address', 'class="col-sm-3 control-label"'); ?></label></td>
     <td>
      		  	<input class="form-control" name='update_customer_email_address' size='35' value='<?php echo zen_output_string_protected($order->customer['email_address']); ?>'>
      		 
      		  	</td>
      		</tr>
      	</table></td>
      </tr>
<!-- End Phone/Email Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>


<!-- bof Update Button -->
      <tr>
	<td valign="top"><div align="center"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></div></td>
      </tr>
<!-- eof Update Button -->

    


     

      
     
      
     
      
      



     
       
     

      
  </form>


    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
</div>
<?php } ?>
<!-- body_eof //-->

<!-- footer //-->
<?php 
require DIR_WS_INCLUDES . 'footer.php'; 
?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php
unset ($_SESSION['customer_id']);
require DIR_WS_INCLUDES . 'application_bottom.php';
