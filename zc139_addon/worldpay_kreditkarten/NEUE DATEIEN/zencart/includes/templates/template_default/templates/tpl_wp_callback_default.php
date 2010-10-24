<?php
/**
 * @copyright Copyright (c) 2008 Philip Clarke
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com    
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */



// If the card transaction was successful display the WorldPay Checkout Success page

if($transStatus == "Y")
	{
	require($template->get_template_dir('tpl_modules_wp_checkout_success.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_wp_checkout_success.php');
    }
    else
	{
	require($template->get_template_dir('tpl_modules_wp_checkout_cancelled.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_wp_checkout_cancelled.php');
    }
?>
