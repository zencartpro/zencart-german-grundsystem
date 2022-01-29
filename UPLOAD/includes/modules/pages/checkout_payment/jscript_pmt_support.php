<?php
/**
 * jscript_pmt_support.php
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: jscript_pmt_support.php 2022-01-28 22:59:16Z webchills $
 */
?>
<script type="text/javascript">

function concatExpiresFields(fields) {
    return $(":input[name=" + fields[0] + "]").val() + $(":input[name=" + fields[1] + "]").val();
}

function methodSelect(theMethod) {
  if (document.getElementById(theMethod)) {
    document.getElementById(theMethod).checked = 'checked';
  }
}

function doesCollectsCardDataOnsite(paymentValue)
{
    if ($('#'+paymentValue+'_collects_onsite').val()) {
        if($('#pmt-'+paymentValue).is(':checked')) {
            return true;
        }
        if ($("[name='payment']").length == 1) {
          return true;
        }
    }
    return false;
}

function doCollectsCardDataOnsite()
{
   var str = $('form[name="checkout_payment"]').serializeArray();

   zcJS.ajax({
    url: "ajax.php?act=ajaxPayment&method=prepareConfirmation",
    data: str
  }).done(function( response ) {
   $('#checkoutPayment').hide();
   $('#navBreadCrumb').html(response.breadCrumbHtml);
   $('#checkoutPayment').before(response.confirmationHtml);
   $(document).attr('title', response.pageTitle);
 });
}

$(document).ready(function(){
  $('form[name="checkout_payment"]').submit(function() {
      $('#paymentSubmit').attr('disabled', true);
    <?php if ($flagOnSubmit) { ?>
      formPassed = check_form();
      if (formPassed == false) {
          $('#paymentSubmit').attr('disabled', false);
      }
      return formPassed;
    <?php } ?>
  });
});

</script>
