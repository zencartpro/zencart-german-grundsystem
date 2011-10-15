<?php
/**
 * @copyright Copyright (c) 2008 Philip Clarke
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com    
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */



// If the card transaction was successful display the WorldPay Checkout Success page

  require(DIR_WS_MODULES . zen_get_module_directory('wp_checkout_success.php'));

?>
<div class="centerColumn" id="checkoutSuccess">



<h1 id="checkoutSuccessHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
if ( intval( $testMode ) != 0) {echo "<h2>" . WP_TEST_HEADING . "</h2>";}
?>


<div id="worldpay">
<h3><?php echo WP_TEXT_HEADING; ?></h3>
<WPDISPLAY ITEM=banner>
</div>

<div id="checkoutSuccessOrderNumber"><?php echo TEXT_YOUR_ORDER_NUMBER . $zv_orders_id; ?></div>

<!--bof -product downloads module-->
<?php
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>
<!--eof -product downloads module-->

<div id="checkoutSuccessOrderLink"><?php echo TEXT_SEE_ORDERS;?></div>

<div id="checkoutSuccessContactLink"><?php echo TEXT_CONTACT_STORE_OWNER;?></div>

<h3 id="checkoutSuccessThanks" class="centeredContent"><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3>

</div>


