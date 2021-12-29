<?php
/**
 * @package page
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: jscript_onload_helper.php 2021-12-28 17:56:29Z webchills $
 */
?>

<script type="text/javascript">
function onloadFocus() {
<?php
  if (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0) {
?>
 var x=document.getElementsByName('multiple_products_cart_quantity');
 if (x.length > 0) {
   document.forms['multiple_products_cart_quantity'].elements[1].focus();
 }
<?php } ?>
}
</script>