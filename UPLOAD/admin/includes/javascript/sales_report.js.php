<?php
/**
 * SALES REPORT 3.3.0
 *
 * All the javascript code specific to the Sales Report resides in this file. Covers the reports
 * on-screen dynamic abilities and pre-launch form checking. 
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @updated by stellarweb to work with version 1.5.0 02-29-12 
 * @updated by lat9, converting to use jQuery
 * @copyright  Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 *  
 * author Czech translation :  Josef Zahradník
 * web:                        www.magic-shop.cz   
 */

?>
<script><!--
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
                $('#li-sort-title-product, #li-sort-a-product, #li-sort-b-product').hide();
                $('#li-sort-title-order, #li-sort-a-order, #li-sort-b-order').show();
                $('#order-total-validation').srVisible();
                $('#li-sort-a-product, #li-sort-b-product').prop('disabled', true);
                $('#li-sort-a-order, #li-sort-b-order').prop('disabled', false);
                $('#div_li_table_a :input, #div_li_table_b :input').prop('disabled', false);
                $('#div_li_table_a').srVisible();
                $('#div_li_table_b').srVisible();
                break;
            case 'product':
                $('#li-sort-title-order, #li-sort-a-order, #li-sort-b-order').hide();
                $('#order-total-validation').srInvisible();
                $('#li-sort-title-product, #li-sort-a-product, #li-sort-b-product').show();
                $('#li-sort-a-product, #li-sort-b-product').prop('disabled', false);
                $('#li-sort-a-order, #li-sort-b-order').prop('disabled', true);
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
    
    if ($('input[name=date_target]:checked').val() == 'purchased') {
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
        if (this.value == 'purchased') {
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
    
    function isDate(day, month, year) {
        var today = new Date();

        year = ((!year) ? today.getFullYear() : year);
        month = ((!month) ? today.getMonth() : month - 1);
        // subtract 1 because date.getMonth() numbers months 0 - 11
        if (!day) {
            return false;
        }

        var test = new Date(year, month, day);
        return (year == test.getFullYear() && month == test.getMonth() && day == test.getDate());
    }
    
    $('#btn-submit').on('click', function(){
        var messages = '';
        if ($('#date-custom').val() == '1') {
            var date_valid = true;
            var sd = $('input[name=start_date]').val();
            var ed = $('input[name=end_date]').val();

            if (sd.length != 10) {
                date_valid = false;
                messages += '<?php echo ALERT_DATE_INVALID_LENGTH; ?>'+sd+'\n';
            }
            if (ed.length != 10) {
                date_valid = false;
                messages += '<?php echo ALERT_DATE_INVALID_LENGTH; ?>'+ed+'\n';
            }
            
            if (date_valid) {
                var date_delim = sd.charAt(2);
                var sd_elements = sd.split(date_delim);
                var ed_elements = ed.split(date_delim);
<?php
$us_date_format = (strtolower(DATE_FORMAT) == 'm/d/y');
?>
                var month_index = <?php echo ($us_date_format) ? 0 : 1; ?>;
                var day_index = <?php echo ($us_date_format) ? 1 : 0; ?>;
                
                if (sd_elements.length != 3 || !isDate(sd_elements[day_index], sd_elements[month_index], sd_elements[2])) {
                    date_valid = false;
                    messages += '<?php echo ALERT_DATE_INVALID; ?>'+sd+'\n';
                }
                if (ed_elements.length != 3 || !isDate(ed_elements[day_index], ed_elements[month_index], ed_elements[2])) {
                    date_valid = false;
                    messages += '<?php echo ALERT_DATE_INVALID; ?>'+ed+'\n';
                }
            }
        }
        
        if ($('#detail_level').val() == 'matrix' && $('#output-format').val() == 'csv') {
            messages += '<?php echo ALERT_CSV_CONFLICT; ?>'+'\n';
        }
            
        if (messages == '') {
            if ($('#new-window').prop('checked')) {
                $('form[name=search]').attr('target', '_blank');
            }
            $('form[name=search]').submit();
        } else {
            alert('<?php echo ALERT_MSG_START; ?>'+'\n\n'+messages+'\n\n'+'<?php echo ALERT_MSG_FINISH; ?>');
        }
    });
});
--></script>
