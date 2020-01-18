<?php
/**
 * jscript file for the login page
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: jscript_main.php 2020-01-16 11:04:16Z webchills $
 */
?>
<script type="text/javascript">
function session_win() {
  window.open("<?php echo zen_href_link(FILENAME_INFO_SHOPPING_CART); ?>","info_shopping_cart","height=460,width=430,toolbar=no,statusbar=no,scrollbars=yes").focus();
}
</script>