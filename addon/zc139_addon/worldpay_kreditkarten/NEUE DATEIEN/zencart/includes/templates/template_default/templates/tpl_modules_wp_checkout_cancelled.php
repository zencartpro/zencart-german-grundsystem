<?php
/**
 * @copyright Copyright (c) 2008 Philip Clarke
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com    
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */


// If payment cancelled inform customer and provide option to try again

      require(DIR_WS_MODULES . 'wp_checkout_cancelled.php');
?>
<table>
  <tr>
    <td>
<?php
	  echo "<h2>" . WP_TEXT_FAILURE . "</h2>";
	  if ( intval( $testMode ) != 0) {echo "<h2>" . WP_TEST_HEADING . "</h2>";}
?>
  </td></tr>
  <tr align="center">
    <td class="worldpay">
<?php 
	  echo WP_TEXT_HEADING;
?>
          <br /><br />
<?php 
	  echo '<WPDISPLAY ITEM=banner>';
	  if ($testMode !== "0") {echo WP_TEST_HEADING . "<br /><br />";}
	  echo WP_CANCELLED_HEADING . "<br /><br />";	  
	  echo "Our ref: " . $cartId . "<br />";
?>
          <br />
<?php 
	  echo WP_CONTACT_INFO;
?>   
	</td>
  </tr>
  <tr align="right">	
    <td>
<?php
	  echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>';
?>
    <td>
  </tr>
</table>
