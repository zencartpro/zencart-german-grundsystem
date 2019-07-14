<?php
/**
 * jscript_main
 *
 * @package page
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: jscript_main.php 732 2016-07-29 18:49:16Z webchills $
 */
?>
<script type="text/javascript"><!--
var selected;
var submitter = null;

function concatExpiresFields(fields) {
    return $(":input[name=" + fields[0] + "]").val() + $(":input[name=" + fields[1] + "]").val();
}


function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
}
function couponpopupWindow(url) {
  window.open(url,'couponpopupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
}
function submitFunction($gv,$total) {
  if ($gv >=$total) {
    submitter = 1;
  }
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

//--></script>
