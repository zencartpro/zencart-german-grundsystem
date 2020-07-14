<?php
/**
 * jscript_braintree
 * show braintree cc input fields only when braintree cc is selected
 * @package page
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: jscript_braintree.php 1 2020-07-14 10:22:16Z webchills $
 */
?>
<script type="text/javascript"><!--
    $(function() {
   $("input[name='payment']").click(function() {
     if ($("#pmt-braintree_api").is(":checked")) {
       $(".ccinfobraintree").show();
     } else {
       $(".ccinfobraintree").hide();
     }
   });
 });
//--></script>
