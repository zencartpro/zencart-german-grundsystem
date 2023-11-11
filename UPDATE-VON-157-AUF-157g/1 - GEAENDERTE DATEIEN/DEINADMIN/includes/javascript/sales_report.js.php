<?php
/**
 * SALES REPORT 4.0.0
 *
 * All the javascript code specific to the Sales Report resides in this file. Covers the reports
 * on-screen dynamic abilities and pre-launch form checking. 
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @updated by stellarweb to work with version 1.5.0 02-29-12 
 * @updated by lat9, converting to use jQuery
 * @copyright  Portions Copyright 2003-2023 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 *  
 * author Czech translation :  Josef Zahradník
 * web:                        www.magic-shop.cz   
 */

?>
<script>
// -----
// Main processing section, starts when the browser has finished and the page is "ready" ...
//
$(document).ready(function(){
    // -----
    // Common (onload and onchange) function to "manage" the sort-dropdowns based on
    // the currently-selected detail-level.
    //
    function updateDetailLevelSorts()
    {
        switch ($('#detail_level').val()) {
            case 'order':
                $('#li-sort-a-product option, #li-sort-b-product option').prop('disabled', true);
                $('#li-sort-title-product, #li-sort-a-product, #li-sort-b-product').hide();
                $('#li-sort-title-order, #li-sort-a-order, #li-sort-b-order').show();
                $('#order-total-validation').srVisible();

                $('#li-sort-a-order option, #li-sort-b-order option').prop('disabled', false);
                $('#div_li_table_a :input, #div_li_table_b :input').prop('disabled', false);
                $('#div_li_table_a').srVisible();
                $('#div_li_table_b').srVisible();
                updateEmailSorts();
                break;
            case 'product':
                $('#li-sort-title-order, #li-sort-a-order, #li-sort-b-order').hide();
                $('#order-total-validation').srInvisible();
                $('#li-sort-title-product, #li-sort-a-product, #li-sort-b-product').show();
                $('#li-sort-a-product option, #li-sort-b-product option').prop('disabled', false);
                $('#li-sort-a-order option, #li-sort-b-order option').prop('disabled', true);
                $('#div_li_table_a :input, #div_li_table_b :input').prop('disabled', false);
                $('#div_li_table_a').srVisible();
                $('#div_li_table_b').srVisible();
                break;
            default:
                $('#div_li_table_a, #div_li_table_b, #order-total-validation').srInvisible();
                $('#div_li_table_a :input, #div_li_table_a select, #div_li_table_b :input, #div_li_table_b select').prop('disabled', true);
                break;
        }
    }

    // -----
    // Common (onload and onchange) function to enable/disable the order detail-level's
    // sorting selections based on whether/not the customer's email address is to be
    // included in the report.
    //
    function updateEmailSorts()
    {
        if ($('#display-email-address').is(':checked')) {
            $('#li-sort-a-order option[value="email"], #li-sort-b-order option[value="email"]').show();
        } else {
            if ($('#li-sort-a-order option:selected').val() === 'email') {
                $('#li-sort-a-order').val('oID');
            }
            if ($('#li-sort-b-order option:selected').val() === 'email') {
                $('#li-sort-b-order').val('oID');
            }
            $('#li-sort-a-order option[value="email"], #li-sort-b-order option[value="email"]').hide();
        }
    }

    // -----
    // Common (onload and onchange) function to "manage" the print-/csv-specific settings.
    //
    function updatePrintCsvSelections()
    {
        switch ($('#output-format').val()) {
            case 'print':
                $('#span-auto-print').show();
                $('#span-csv-header').hide();
                break;
            case 'csv':
                $('#span-auto-print').hide();
                $('#span-csv-header').show();
                break;
            default:
                $('#span-auto-print, #span-csv-header').hide();
                break;
        }
    }

    // -----
    // jQuery function overrides to enable 'easy' setting of an element's visibility.
    //
    (function($) {
        $.fn.srInvisible = function(){
            return this.css("visibility", "hidden");
        };
        $.fn.srVisible = function(){
            return this.css("visibility", "visible");
        };
    })(jQuery);

    // -----
    // On initial entry, see which options have been chosen and adjust the to-be-displayed
    // portions accordingly.
    //
    if ($('#date-custom').val() == '0') {
        $('#tbl_date_custom').hide();
    } else {
        $('#tbl_date_preset').hide();
    }

    if ($('input[name=date_target]:checked').val() === 'purchased') {
        $('#td_date_status').hide();
    } else {
        $('#td_date_status').show();
    }

    if (!$('#do-prod-inc').prop('checked')) {
        $('#td_prod_includes').hide();
    }

    if (!$('#do-cust-inc').prop('checked')) {
        $('#td_cust_includes').hide();
    }

    updateDetailLevelSorts();
    updatePrintCsvSelections();

    // -----
    // Start on click/change functions ...
    //
    $('#choose-custom').on('click', function(){
        $('#tbl_date_custom').show();
        $('#tbl_date_preset').hide();
        $('#date-custom').val('1');
    });

    $('#choose-preset').on('click', function(){
        $('#tbl_date_custom').hide();
        $('#tbl_date_preset').show();
        $('#date-custom').val('0');
    });

    $('input[name=date_target]').on('change', function(){
        if (this.value === 'purchased') {
            $('#td_date_status').hide();
        } else {
            $('#td_date_status').show();
        }
    });

    $('#do-prod-inc').on('change', function(){
        if (this.checked) {
            $('#td_prod_includes').show();
        } else {
            $('#td_prod_includes').hide();
        }
    });

    $('#do-cust-inc').on('change', function(){
        if (this.checked) {
            $('#td_cust_includes').show();
        } else {
            $('#td_cust_includes').hide();
        }
    });

    $('#detail_level').on('change', function(){
        updateDetailLevelSorts();
    });

    $('#output-format').on('change', function(){
        updatePrintCsvSelections();
    });
    
    $('#display-email-address').on('change', function(){
        updateEmailSorts();
    });

    $('#btn-submit').on('click', function(){
        var messages = '';

        if ($('#detail_level').val() === 'matrix' && $('#output-format').val() === 'csv') {
            messages += '<?php echo ALERT_CSV_CONFLICT; ?>'+'\n';
        }

        if (messages === '') {
            if ($('#new-window').prop('checked')) {
                $('form[name=search]').attr('target', '_blank');
            }
            $('form[name=search]').submit();
        } else {
            alert('<?php echo ALERT_MSG_START; ?>'+'\n\n'+messages+'\n\n'+'<?php echo ALERT_MSG_FINISH; ?>');
        }
    });
});
</script>
