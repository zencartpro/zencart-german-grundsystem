<?php

/**
 * SALES REPORT 4.0.0
 *
 * This is where everything starts and ends. This file builds the HTML display, calls the class file
 * to build the data, then displays that data for the user.
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @author     Carl Peach <carlvt88 at zen-cart.com/forum>
 * @updated by stellarweb to work with version 1.5.0 02-29-12 
 * @updated by lat9, for continued operation for zc155/zc156, 20190622
 * @copyright  Portions Copyright 2003-2023 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 */


//_TODO popup confirm box when report date range is very large
//_TODO option to load report into new window (can continue with other tasks)
//_TODO save report data to session var or temp file to redisplay without rebuilding
//_TODO "Help Me" link at the top to give basic usage instructions
//_TODO make presence of hidden back button on print display more obvious somehow...
//_TODO option to "count" sorting element on order/product line item views
//_TODO ability filter results by manufacturer (not just sort!)
//_TODO Matrix -> checkboxes for "per manufacturer" / "per product" / "per customer" stats


require 'includes/application_top.php';

require DIR_WS_CLASSES . 'currencies.php';
$currencies = new currencies();

//////////////////////////////////////////////////////////
// TIMEFRAME DATE DISPLAY
// These control the display format of the start and end
// dates of each timeframe line.  Each define corresponds
// to the timeframe of its namesake.  See the PHP manual
// entry on the date() function for a table on the accepted
// formatting characters: http://us2.php.net/date
//
// Moved here from the report's language file for v3.2.1 to provide zc156 interoperation,
// given that that version has changed the loading order of admin language files.
//
$time_display = (strtolower(DATE_FORMAT) === 'd/m/y') ? 'n-j-Y' : 'jS-M-y';
zen_define_default('TIME_DISPLAY_DAY', $time_display);
zen_define_default('TIME_DISPLAY_WEEK', $time_display);
zen_define_default('TIME_DISPLAY_MONTH', $time_display);
zen_define_default('TIME_DISPLAY_YEAR', $time_display);
  
// we ramp up the execution time to make sure those
// really big reports don't time out
ini_set('max_execution_time', 300);

// possible scenarios: open clean             ($output_format = false)
//                     display report         ($output_format = 'display')
//                     print report           ($output_format = 'print')
//                     csv report             ($output_format = 'csv')
//                     criteria but no search ($output_format = 'none')
$output_format = $_GET['output_format'] ?? false;

$status_array = [];
$status_key = [];
$orders_status = $db->Execute(
    "SELECT orders_status_id AS `id`, orders_status_name AS `text`
       FROM " . TABLE_ORDERS_STATUS . "
      WHERE language_id = " . (int)$_SESSION['languages_id'] . "
   ORDER BY orders_status_id ASC"
);
foreach ($orders_status as $next_status) {
    $status_array[] = [
        'id' => $next_status['id'],
        'text' => $next_status['text'] . ' [' . $next_status['id'] . ']'
    ];
    $status_key[$next_status['id']] = $next_status['text'];
}
unset($orders_status, $next_status);

$payment_key = [];
$payments_array[] = [
    'id' => '0',
    'text' => TEXT_EMPTY_SELECT
];
$payments = $db->Execute(
    "SELECT DISTINCT payment_method, payment_module_code 
       FROM " . TABLE_ORDERS
);
foreach ($payments as $next_payment) {
    $payments_array[] = [
        'id' => $next_payment['payment_module_code'],
        'text' => $next_payment['payment_method'] . ' [' . $next_payment['payment_module_code'] . ']'
    ];
    $payment_key[$next_payment['payment_module_code']] = $next_payment['payment_method'];
}
unset($payments, $next_payment);

$show_country_and_state = false; 
// -----
// Build arrays for dropdowns in search menu
//
if ($output_format !== 'print') {
    $manufacturers = $db->Execute(
        "SELECT manufacturers_id, manufacturers_name
           FROM " . TABLE_MANUFACTURERS . " 
       ORDER BY manufacturers_name ASC"
    );
    $manufacturer_array = [];
    $manufacturer_key = [];
    if (!$manufacturers->EOF) {
        $manufacturer_array[] = [
            'id' => 0,
            'text' => TEXT_EMPTY_SELECT
        ];
        foreach ($manufacturers as $next_manufacturer) {
            $manufacturer_array[] = [
                'id' => $next_manufacturer['manufacturers_id'],
                'text' => $next_manufacturer['manufacturers_name']
            ];
            $manufacturer_key[] = $next_manufacturer['manufacturers_id'];
        }
    }
    unset($manufacturers, $next_manufacturer);

    $output_array = [
        ['id' => 'display', 'text' => SELECT_OUTPUT_DISPLAY],
        ['id' => 'print', 'text' => SELECT_OUTPUT_PRINT],
        ['id' => 'csv', 'text' => SELECT_OUTPUT_CSV],
    ];
} else {
    $manufacturer_key = [];
    $detail_key = [
        'timeframe' => SELECT_DETAIL_TIMEFRAME,
        'product' => SELECT_DETAIL_PRODUCT,
        'order' => SELECT_DETAIL_ORDER,
        'matrix' => SELECT_DETAIL_MATRIX,
    ];

    $timeframe_key = [
        'day' => SEARCH_TIMEFRAME_DAY,
        'week' => SEARCH_TIMEFRAME_WEEK,
        'month' => SEARCH_TIMEFRAME_MONTH,
        'year' => SEARCH_TIMEFRAME_YEAR,
    ];
}

$detail_types = ['timeframe', 'product', 'order', 'matrix'];
$detail_array = [
    ['id' => 'timeframe', 'text' => SELECT_DETAIL_TIMEFRAME],
    ['id' => 'product', 'text' => SELECT_DETAIL_PRODUCT],
    ['id' => 'order', 'text' => SELECT_DETAIL_ORDER],
    ['id' => 'matrix', 'text' => SELECT_DETAIL_MATRIX],
];
    
$order_sorts = ['oID', 'last_name', 'email', 'num_products', 'goods', 'shipping', 'discount', 'gc_sold', 'gc_used', 'grand'];
$order_sorts_array = [
    ['id' => 'oID', 'text' => TABLE_HEADING_ORDERS_ID],
    ['id' => 'last_name', 'text' => SELECT_LAST_NAME],
    ['id' => 'email', 'text' => TABLE_HEADING_EMAIL_ADDRESS],
    ['id' => 'num_products', 'text' => TABLE_HEADING_NUM_PRODUCTS],
    ['id' => 'goods', 'text' => TABLE_HEADING_TOTAL_GOODS],
    ['id' => 'shipping', 'text' => TABLE_HEADING_SHIPPING],
    ['id' => 'discount', 'text' => TABLE_HEADING_DISCOUNTS],
    ['id' => 'gc_sold', 'text' => TABLE_HEADING_GC_SOLD],
    ['id' => 'gc_used', 'text' => TABLE_HEADING_GC_USED],
    ['id' => 'grand', 'text' => TABLE_HEADING_ORDER_TOTAL],
];

$product_sorts = ['pID', 'name', 'manufacturer', 'model', 'base_price', 'quantity', 'onetime_charges', 'grand'];
$product_sorts_array = [
    ['id' => 'pID', 'text' => SELECT_PRODUCT_ID],
    ['id' => 'name', 'text' => TABLE_HEADING_PRODUCT_NAME],
    ['id' => 'manufacturer', 'text' => TABLE_HEADING_MANUFACTURER],
    ['id' => 'model', 'text' => TABLE_HEADING_MODEL],
    ['id' => 'base_price', 'text' => TABLE_HEADING_BASE_PRICE],
    ['id' => 'quantity', 'text' => SELECT_QUANTITY],
    ['id' => 'onetime_charges', 'text' => TABLE_HEADING_ONETIME_CHARGES],
    ['id' => 'grand', 'text' => TABLE_HEADING_PRODUCT_TOTAL],
];

// the sheer number of options for date range requires some extra checking...
$date_preset = (!empty($_GET['date_preset'])) ? $_GET['date_preset'] : 'YTD';
$date_custom = (isset($_GET['date_custom']) && $_GET['date_custom'] === '1') ? '1' : '0';
$today_timestamp = strtotime('today midnight');
$datepicker_format = zen_datepicker_format_fordate();
if ($date_custom === '1') {
    // defaults to beginning of the month when not set
    $start_date = (!empty($_GET['start_date'])) ? $_GET['start_date'] : date($datepicker_format, strtotime('first day of this month', $today_timestamp));
    $end_date = (!empty($_GET['end_date'])) ? $_GET['end_date'] : $start_date;
} else {
    switch ($date_preset) {
        case 'today':
            $start_date = date($datepicker_format, $today_timestamp);
            $end_date = $start_date;
            break;
        case 'yesterday':
            $start_date = date($datepicker_format, strtotime('yesterday', $today_timestamp));
            $end_date = $start_date;
            break;
        case 'last_month':
            $start_date = date($datepicker_format, strtotime('first day of last month', $today_timestamp));
            $end_date = date($datepicker_format, strtotime('last day of last month', $today_timestamp));
            break;
        case 'this_month':
            $start_date = date($datepicker_format, strtotime('first day of this month', $today_timestamp));
            $end_date = date($datepicker_format, $today_timestamp);
            break;
        case 'last_year':
            $start_date = date($datepicker_format, strtotime('last year January 1st', $today_timestamp));
            $end_date = date($datepicker_format, strtotime('last year December 31st', $today_timestamp));
            break;
        case 'last_12_months':
            $start_date = date($datepicker_format, strtotime('1 year ago', $today_timestamp));
            $end_date = date($datepicker_format, $today_timestamp);
            break;
        default:
            $_GET['date_preset'] = 'YTD';
            $start_date = date($datepicker_format, strtotime('first day of January this year', $today_timestamp));
            $end_date = date($datepicker_format, $today_timestamp);
            break;
    }
}

$dt = DateTime::createFromFormat($datepicker_format, $start_date);
if ($dt === false) {
    $dt = DateTime::createFromFormat($datepicker_format, date($datepicker_format, strtotime('first day of this month', $today_timestamp)));
}

$dt = DateTime::createFromFormat($datepicker_format, $end_date);
$end_date = ($dt === false) ? $start_date : $end_date;

$date_target = (isset($_GET['date_target']) && in_array($_GET['date_target'], ['purchased', 'status'])) ? $_GET['date_target'] : 'purchased';
if ($date_target === 'status') {
    $date_status = (isset($_GET['date_status']) && array_key_exists((int)$_GET['date_status'], $status_key)) ? (int)$_GET['date_status'] : DEFAULT_ORDERS_STATUS_ID;
} else {
    $date_status = false;
}

$payment_method = (isset($_GET['payment_method']) && array_key_exists($_GET['payment_method'], $payment_key)) ? $_GET['payment_method'] : '0';
$payment_method_omit = (isset($_GET['payment_method_omit']) && array_key_exists($_GET['payment_method_omit'], $payment_key)) ? $_GET['payment_method_omit'] : '0';
$current_status = (isset($_GET['current_status']) && array_key_exists((int)$_GET['current_status'], $status_key)) ? (int)$_GET['current_status'] : 0;
$excluded_status = (isset($_GET['excluded_status']) && array_key_exists((int)$_GET['excluded_status'], $status_key)) ? (int)$_GET['excluded_status'] : 0;
$manufacturer = (isset($_GET['manufacturer']) && in_array((int)$_GET['manufacturer'], $manufacturer_key)) ? (int)$_GET['manufacturer'] : 0;
$detail_level = (isset($_GET['detail_level']) && in_array($_GET['detail_level'], $detail_types)) ? $_GET['detail_level'] : 'order';
switch ($detail_level) {
    case 'order':
        $valid_sorts = $order_sorts;
        $li_sort_a =  (isset($_GET['li_sort_a']) && in_array($_GET['li_sort_a'], $valid_sorts)) ? $_GET['li_sort_a'] : 'oID';
        $li_sort_a_order = $li_sort_a;
        $li_sort_b = (isset($_GET['li_sort_b']) && in_array($_GET['li_sort_a'], $valid_sorts)) ? $_GET['li_sort_b'] : 'oID';
        $li_sort_b_order = $li_sort_b;
        $li_sort_a_product = 'pID';
        $li_sort_b_product = 'pID';
        $sort_default = 'oID';
        break;
    case 'product':
        $valid_sorts = $product_sorts;
        $li_sort_a = (isset($_GET['li_sort_a']) && in_array($_GET['li_sort_a'], $valid_sorts)) ? $_GET['li_sort_a'] : 'pID';
        $li_sort_a_product = $li_sort_a;
        $li_sort_b = (isset($_GET['li_sort_b']) && in_array($_GET['li_sort_a'], $valid_sorts)) ? $_GET['li_sort_b'] : 'pID';
        $li_sort_b_product = $li_sort_b;
        $li_sort_a_order = 'oID';
        $li_sort_b_order = 'oID';
        $sort_default = 'pID';
        break;
    default:
        // -----
        // The 'csv' output format is not compatible with the 'matrix' detail level.  This 'should' be prevented
        // by the report's jQuery processing, but just in case the output format will be changed to 'order' and the
        // report's form-entry re-entered with message.
        //
        if ($detail_level === 'matrix' && $output_format === 'csv') {
            $_GET['output_format'] = 'order';
            $messageStack->add_session(ERROR_CSV_CONFLICT, 'error');
            zen_redirect(zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params()));
        }
        $valid_sorts = [];
        $sort_default = false;
        $li_sort_a = 'oID';
        $li_sort_a_order = 'oID';
        $li_sort_b = 'oID';
        $li_sort_b_order = 'oID';
        $li_sort_a_product = 'pID';
        $li_sort_b_product = 'pID';
        break;
}

// -----
// Initialize variables for the report and/or display, sanitizing where needed.
//
$valid_sort_orders = ['asc', 'desc'];

// process the search criteria
$timeframe = (isset($_GET['timeframe']) && in_array($_GET['timeframe'], ['year', 'month', 'week', 'day'])) ? $_GET['timeframe'] : 'year';
$timeframe_sort = (isset($_GET['timeframe_sort']) && in_array($_GET['timeframe_sort'], $valid_sort_orders)) ? $_GET['timeframe_sort'] : 'asc';

$li_sort_a = (isset($_GET['li_sort_a']) && in_array($_GET['li_sort_a'], $valid_sorts)) ? $_GET['li_sort_a'] : $sort_default;
$li_sort_order_a = (isset($_GET['li_sort_order_a']) && in_array($_GET['li_sort_order_a'], $valid_sort_orders)) ? $_GET['li_sort_order_a'] : 'asc';

$li_sort_b = (isset($_GET['li_sort_b']) && in_array($_GET['li_sort_b'], $valid_sorts)) ? $_GET['li_sort_b'] : $sort_default;
$li_sort_order_b = (isset($_GET['li_sort_order_b']) && in_array($_GET['li_sort_order_b'], $valid_sort_orders)) ? $_GET['li_sort_order_b'] : 'asc';

$auto_print = !empty($_GET['auto_print']);
$csv_header = !empty($_GET['csv_header']);

$doCustInc = !empty($_GET['doCustInc']);
$cust_includes = (isset($_GET['cust_includes'])) ? (string)$_GET['cust_includes'] : '';
if ($cust_includes !== '') {
    $cia = [];
    $ci = explode(',', str_replace(' ', '', $cust_includes));
    foreach ($ci as $c) {
        $c = (int)$c;
        if ($c === 0) {
            continue;
        }
        $cia[] = $c;
    }
    $cust_includes = implode(',', array_unique($cia));
    $_GET['cust_includes'] = $cust_includes;
    unset($cia, $ci, $c);
}
$doProdInc = !empty($_GET['doProdInc']);
$prod_includes = $_GET['prod_includes'] ?? '';
if ($prod_includes !== '') {
    $pia = [];
    $pi = explode(',', str_replace(' ', '', $prod_includes));
    foreach ($pi as $p) {
        $p = (int)$p;
        if ($p === 0) {
            continue;
        }
        $pia[] = $p;
    }
    $prod_includes = implode(',', array_unique($pia));
    $_GET['prod_includes'] = $prod_includes;
    unset($pia, $pi, $p);
}

$order_total_validation = (isset($_GET['order_total_validation']));
$display_email_address = (isset($_GET['display_email']));

require DIR_WS_CLASSES . 'sales_report.php';

// -----
// Keep track of the admin's current choice for 'new_window' for their current session, recording that
// selection in the session once they've requested a report to be generated.
//
if ($output_format === false) {
    $new_window = $_SESSION['sales_report_new_window'] ?? true;

// -----
// If this is not the initial page-entry for the report, i.e. the admin has chosen some
// options to display, display the report.
//
} else {
    // -----
    // Save the admin's current selection for the 'new_window' setting into the session.
    //
    $new_window = isset($_GET['new_window']);
    $_SESSION['sales_report_new_window'] = $new_window;

    // start the page parsing timer
    $parse_start = get_microtime();

    // if any required field is empty, cancel the report and alert the user
    // JavaScript checks should usually catch these, this is "just in case"
    if (!$start_date || !$end_date || !$date_target || !$detail_level || !$output_format) {
        $messageStack->add_session(ERROR_MISSING_REQ_INFO . '<br>' . $_GET['start_date'] . '<br>' . $_GET['end_date'], 'error');
        zen_redirect(zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(['output_format']), 'NONSSL'));
    }

    // build the report array
    if ($output_format !== 'none') {
        $sr_parms = [
            'timeframe' => $timeframe,
            'timeframe_sort' => $timeframe_sort,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'date_target' => $date_target,
            'date_status' => $date_status,
            'payment_method' => $payment_method,
            'payment_method_omit' => $payment_method_omit,
            'current_status' => $current_status,
            'excluded_status' => $excluded_status,
            'manufacturer' => $manufacturer,
            'detail_level' => $detail_level,
            'output_format' => $output_format,
            'order_total_validation' => $order_total_validation,
            'display_email' => $display_email_address,
            'li_sort_a' => $li_sort_a,
            'li_sort_order_a' => $li_sort_order_a,
            'li_sort_b' => $li_sort_b,
            'li_sort_order_b' => $li_sort_order_b,
            'doCustInc' => $doCustInc,
            'cust_includes' => $cust_includes,
            'doProdInc' => $doProdInc,
            'prod_includes' => $prod_includes,
        ];
        $sr = new sales_report($sr_parms);
    
        if ($output_format === 'csv') {
            // we have to pass the sorting values of the form since
            // the class instantiation does not require them
            $sr->output_csv($csv_header);
            zen_exit();
        }
    }  // END if ($output_format != 'none')
}
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
    <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
</head>
<?php
// display the print header
if ($output_format === 'print') {
    if ($auto_print === true) {
        echo '<body onload="print();">';
    }
?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <!-- PRINT HEADER -->
    <tr>
        <td class="text-center" colspan="2">
            <a href="<?php echo zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(['output_format']) . 'output_format=none', 'NONSSL'); ?>">
                <span class="pageHeading"><?php echo PAGE_HEADING; ?></span>
            </a><br>
        </td>
    </tr>
    <tr>
        <td class="text-center" colspan="2">
            <a href="<?php echo zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(['output_format']) . 'output_format=none', 'NONSSL'); ?>">
                <span class="pageHeading"><?php echo $start_date . PRINT_DATE_TO . $end_date; ?></span>
            </a><br>
        </td>
    </tr>
    <tr class="v-top">
        <td><table>
            <tr>
<?php
    $date_target_heading = PRINT_DATE_TARGET;
    if ($date_target === 'purchased') {
        $date_target_heading .= PRINT_DATE_PURCHASED;
    } elseif ($date_target === 'status') {
        $date_target_heading .= (PRINT_DATE_STATUS . ' (' . $status_key[$date_status] . ')');
    }
?>
                <td class="smalltext"><?php echo $date_target_heading; ?></td>
            </tr>
            <tr>
                <td class="smallText"><?php echo sprintf(PRINT_TIMEFRAMES, $timeframe_key[$timeframe], $timeframe_sort); ?></td>
            </tr>
            <tr>
                <td class="smalltext"><?php echo PRINT_DETAIL_LEVEL . $detail_key[$detail_level]; ?></td>
            </tr>
        </table></td>
        <td class="text-right"><table>
<?php 
    if ($payment_method !== '0') {
?>
            <tr>
                <td class="smalltext"><?php echo PRINT_PAYMENT_METHOD; ?></td>
                <td class="smalltext"><?php echo $payment_key[$payment_method]; ?></td>
            </tr>
<?php 
    }

    if ($payment_method_omit !== '0') {
?>
            <tr>
                <td class="smalltext"><?php echo PRINT_PAYMENT_METHOD; ?></td>
                <td class="smalltext"><?php echo $payment_key[$payment_method]; ?></td>
            </tr>
<?php 
    }
    
    if ($current_status !== 0) {
?>
            <tr>
                <td class="smalltext"><?php echo PRINT_CURRENT_STATUS; ?></td>
                <td class="smalltext"><?php echo sprintf(PRINT_ORDER_STATUS, $status_key[$current_status], $current_status); ?></td>
            </tr>
<?php 
}
?>
        </table><td/>
    </tr>
    <tr>
        <td colspan="2"><?php echo zen_black_line(); ?></td>
    </tr>
<!-- END PRINT HEADER -->
<?php
} elseif (!$output_format || $output_format !== 'print') { // display the normal search header
?>
<body>
    <?php require DIR_WS_INCLUDES . 'header.php'; ?>
    <?php echo zen_draw_form('search', FILENAME_STATS_SALES_REPORT, '', 'get', '', true) .
               zen_draw_hidden_field('date_custom', $date_custom, 'id="date-custom"'); ?>
    <table class="table">
        <tr>
            <td class="pageHeading"><?php echo PAGE_HEADING; ?></td>
            <td class="pageHeading text-right">
                <?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <fieldset><legend><?php echo HEADING_TITLE_SEARCH; ?></legend>
                <table class="table">
                    <tr class="v-top">
                        <td><table id="tbl_date_preset">
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_DATE_PRESET; ?></strong>&nbsp;
                                    <button id="choose-custom" type="button"><?php echo BUTTON_TIMEFRAME_CUSTOM; ?></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_today">
                                    <?php echo zen_draw_radio_field('date_preset', 'today', ($date_preset === 'today')) . sprintf(SEARCH_DATE_TODAY, date('M. j', $today_timestamp)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_yesterday">
                                    <?php echo zen_draw_radio_field('date_preset', 'yesterday', ($date_preset === 'yesterday')) . sprintf(SEARCH_DATE_YESTERDAY, date('M. j', strtotime('-1 day', $today_timestamp))); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_last_month">
                                    <?php echo zen_draw_radio_field('date_preset', 'last_month', ($date_preset === 'last_month')) . sprintf(SEARCH_DATE_LAST_MONTH, date("F \'y", strtotime('-1 month', $today_timestamp))); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_this_month">
                                    <?php echo zen_draw_radio_field('date_preset', 'this_month', ($date_preset === 'this_month')) . sprintf(SEARCH_DATE_THIS_MONTH, date("F \'y")); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_last_year">
                                    <?php echo zen_draw_radio_field('date_preset', 'last_year', ($date_preset === 'last_year')) . sprintf(SEARCH_DATE_LAST_YEAR, date('Y') - 1); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_last_12_months">
                                    <?php echo zen_draw_radio_field('date_preset', 'last_12_months', ($date_preset === 'last_12_months')) . SEARCH_DATE_LAST_12_MONTHS; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_YTD">
                                    <?php echo zen_draw_radio_field('date_preset', 'YTD', ($date_preset === 'YTD' || !empty($date_custom))) . sprintf(SEARCH_DATE_YTD, 'Jan 1 to ' . date('M. j Y', $today_timestamp)); ?>
                                </td>
                            </tr>
                        </table>
                        <table id="tbl_date_custom">
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_DATE_CUSTOM; ?></strong>&nbsp;
                                    <button id="choose-preset" type="button"><?php echo BUTTON_TIMEFRAME_PRESET; ?></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <?php echo SEARCH_START_DATE; ?>
                                    <div class="date">
                                        <?php echo zen_draw_input_field('start_date', $start_date, 'id="start-date" autocomplete="off"'); ?>
                                    </div>
                                    <span class="help-block errorText">(<?php echo zen_datepicker_format_full(); ?>)</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <?php echo SEARCH_END_DATE; ?>
                                    <div class="date">
                                        <?php echo zen_draw_input_field('end_date', $end_date, 'id="end-date" autocomplete="off"'); ?>
                                    </div>
                                    <span class="help-block errorText">(<?php echo zen_datepicker_format_full(); ?>)</span>
                                </td>
                            </tr>
                        </table></td>
                        <td><table>
                            <tr>
                                <td class="smallText"><strong><?php echo SEARCH_DATE_TARGET; ?></strong></td>
                            </tr>
                            <tr>
                                <td class="smallText"><?php
                                    echo zen_draw_radio_field('date_target', 'purchased', ($date_target === 'purchased')) . ' ' . RADIO_DATE_TARGET_PURCHASED . '<br>' .
                                         zen_draw_radio_field('date_target', 'status', ($date_target !== 'purchased')) . ' ' . RADIO_DATE_TARGET_STATUS;
                                ?></td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_date_status">
                                    <?php echo zen_draw_pull_down_menu('date_status', $status_array, $date_status, 'id="date_status"'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <?php echo zen_draw_checkbox_field('doProdInc', '1', $doProdInc, '', 'id="do-prod-inc"') . ' ' . SEARCH_SPECIFIC_PRODUCTS; ?>
                                </td>
                            </tr>
                            <tr>
<?php
    $temp_prods = $_GET['prod_includes'] ?? INCLUDE_PRODUCTS;
    $temp_cust = $_GET['cust_includes'] ?? INCLUDE_CUSTOMERS;
?>
                                <td class="smallText" id="td_prod_includes">
                                    <?php echo zen_draw_input_field('prod_includes', $temp_prods); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <?php echo zen_draw_checkbox_field('doCustInc', '1', $doCustInc, '', 'id="do-cust-inc"') . ' ' . SEARCH_SPECIFIC_CUSTOMERS; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText" id="td_cust_includes">
                                    <?php echo zen_draw_input_field('cust_includes', $temp_cust);?>
                                </td>
                            </tr>
                        </table></td>
                        <td><table>
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_PAYMENT_METHOD; ?></strong>
                                    <br>
                                    <?php echo zen_draw_pull_down_menu('payment_method', $payments_array, $payment_method, 'id="payment_method"'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_PAYMENT_METHOD_OMIT; ?></strong>
                                    <br>
                                    <?php echo zen_draw_pull_down_menu('payment_method_omit', $payments_array, $payment_method_omit, 'id="payment_method_omit"'); ?>
                                </td>
                            </tr>
<?php
    $empty_select = [['id' => '0', 'text' => TEXT_EMPTY_SELECT]];
?>
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_CURRENT_STATUS; ?></strong>
                                    <br>
                                    <?php echo zen_draw_pull_down_menu('current_status', array_merge($empty_select, $status_array), $current_status, 'id="current_status"'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_EXCLUDED_STATUS; ?></strong>
                                    <br>
                                    <?php echo zen_draw_pull_down_menu('excluded_status', array_merge($empty_select, $status_array), $excluded_status, 'id="excluded-status"'); ?>
                                </td>
                            </tr>
<?php 
    if (count($manufacturer_array) !== 0) {
?>
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_MANUFACTURER; ?></strong>
                                    <br>
                                    <?php echo zen_draw_pull_down_menu('manufacturer', $manufacturer_array, $manufacturer, 'id="manufacturer"'); ?>
                                </td>
                            </tr>
<?php 
}
?>
                        </table></td>
                    </tr>
                </table></fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <fieldset><legend><?php echo HEADING_TITLE_SORT; ?></legend>
                <table class="table">
                    <tr class="v-top">
        <!-- nested table to show/hide sort options without shifting entire row-->
                        <td><table>
                            <tr>
                                <td class="smallText"><strong><?php echo SEARCH_TIMEFRAME; ?></strong></td>
                            </tr>
                            <tr>
                                <td class="smallText"><?php echo
                                    zen_draw_radio_field('timeframe', 'day', $timeframe === 'day') . SEARCH_TIMEFRAME_DAY . '<br>' .
                                    zen_draw_radio_field('timeframe', 'week', $timeframe === 'week') . SEARCH_TIMEFRAME_WEEK . '<br>' .
                                    zen_draw_radio_field('timeframe', 'month', $timeframe === 'month') . SEARCH_TIMEFRAME_MONTH . '<br>' .
                                    zen_draw_radio_field('timeframe', 'year', $timeframe === 'year') . SEARCH_TIMEFRAME_YEAR; ?>
                                </td>
                            </tr>
                        </table></td>
                        <td><table>
                            <tr>
                                <td class="smallText"><strong><?php echo SEARCH_TIMEFRAME_SORT; ?></strong></td>
                            </tr>
                            <tr>
                                <td class="smallText"><?php echo
                                    zen_draw_radio_field('timeframe_sort', 'asc', $timeframe_sort === 'asc') . sales_report::getUpArrowIcon() . RADIO_TIMEFRAME_SORT_ASC . '<br>' .
                                    zen_draw_radio_field('timeframe_sort', 'desc', $timeframe_sort !== 'asc') . sales_report::getDownArrowIcon() . RADIO_TIMEFRAME_SORT_DESC; ?>
                                </td>
                            </tr>
                        </table></td>
                        <td><table>
                            <tr>
                                <td class="smallText">
                                    <strong><?php echo SEARCH_DETAIL_LEVEL; ?></strong>
                                    <br>
                                    <?php echo zen_draw_pull_down_menu('detail_level', $detail_array, $detail_level, 'id="detail_level"'); ?>
                                </td>
                            </tr>
                        </table></td>
        <!-- end table nesting -->
                        <td><div id="div_li_table_a"><table>
                            <tr class="v-top">
                                <td class="smallText" id="li-sort-title-order">
                                    <strong><?php echo SEARCH_SORT_ORDER; ?></strong>
                                </td>
                                <td class="smallText" id="li-sort-title-product">
                                    <strong><?php echo SEARCH_SORT_PRODUCT; ?></strong>
                                </td>
                            </tr>
                            <tr class="v-top">
                                <td class="smallText">
                                    <?php echo zen_draw_pull_down_menu('li_sort_a', $order_sorts_array, $li_sort_a_order, 'id="li-sort-a-order"') .
                                               zen_draw_pull_down_menu('li_sort_a', $product_sorts_array, $li_sort_a_product, 'id="li-sort-a-product"'); ?>
                                    <br>
                                    <?php echo
                                        zen_draw_radio_field('li_sort_order_a', 'asc', $li_sort_order_a === 'asc') . sales_report::getUpArrowIcon() . RADIO_LI_SORT_ASC .
                                        '<br>' .
                                        zen_draw_radio_field('li_sort_order_a', 'desc', $li_sort_order_a !== 'asc') . sales_report::getDownArrowIcon() . RADIO_LI_SORT_DESC;
                                    ?>
                                 </td>
                                 <td>
                                 </td>
                            </tr>
                        </table></div></td>
                        <td><div id="div_li_table_b"><table>
                            <tr>
                                <td class="smallText"><strong><?php echo SEARCH_SORT_THEN; ?></strong></td>
                            </tr>
                            <tr>
                                <td class="smallText">
                                    <?php echo zen_draw_pull_down_menu('li_sort_b', $order_sorts_array, $li_sort_b_order, 'id="li-sort-b-order"') .
                                               zen_draw_pull_down_menu('li_sort_b', $product_sorts_array, $li_sort_b_product, 'id="li-sort-b-product"'); ?>
                                    <br>
                                    <?php echo
                                    zen_draw_radio_field('li_sort_order_b', 'asc', $li_sort_order_b === 'asc') . sales_report::getUpArrowIcon() . RADIO_LI_SORT_ASC . '<br>' .
                                    zen_draw_radio_field('li_sort_order_b', 'desc', $li_sort_order_b !== 'asc') . sales_report::getDownArrowIcon() . RADIO_LI_SORT_DESC; ?>
                                </td>
                            </tr>
                        </table></div></td>
                    </tr>
                </table></fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <fieldset><legend><?php echo HEADING_TITLE_PROCESS; ?></legend>
                <table class="table">
                    <tr class="v-bot">
                        <td class="smallText">
                            <strong><?php echo SEARCH_OUTPUT_FORMAT; ?></strong>
                            <br>
                            <?php echo zen_draw_pull_down_menu('output_format', $output_array, $output_format, 'id="output-format"'); ?>
                        </td>
                        <td class="smallText">
                            <?php echo zen_draw_separator('pixel_trans.gif', 175, 1); ?>
                            <br>
                            <span id="span-auto-print"><?php echo zen_draw_checkbox_field('auto_print', '1', false) . CHECKBOX_AUTO_PRINT; ?></span>
                            <span id="span-csv-header"><?php echo zen_draw_checkbox_field('csv_header', '1', false) . CHECKBOX_CSV_HEADER; ?></span>
                        </td>
                        <td class="smallText" id="order-total-validation">
                            <?php echo zen_draw_checkbox_field('order_total_validation', '1', $order_total_validation) . CHECKBOX_VALIDATE_TOTALS; ?>
                            <br>
                            <?php echo zen_draw_checkbox_field('display_email', '1', $display_email_address, '', 'id="display-email-address"') . CHECKBOX_DISPLAY_EMAIL_ADDRESS; ?>
                        </td>
                        <td class="smallText text-right">
                            <?php echo zen_draw_checkbox_field('new_window', '1', $new_window, '', 'id="new-window"') . CHECKBOX_NEW_WINDOW; ?>
                            <br>
                            <button type="button" id="btn-submit"><?php echo BUTTON_SEARCH; ?></button>
                        </td>
                    </tr>
                </table></fieldset>
            </td>
        </tr>
        <tr class="v-top">
            <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 15); ?></td>
            <td id="td_wait_text" class="alert text-right"><?php echo SEARCH_WAIT_TEXT; ?>&nbsp;&nbsp;</td>
        </tr>
<?php 
}  // END <?php if ( (!$output_format || $output_format = 'display') && $output_format != 'print')
    
if ($output_format === 'print' || $output_format === 'display') {
    // timeframes are in ascending order by default, so we only
    // need to make changes if the user requests descending order
    if ($timeframe_sort === 'desc') {
        krsort($sr->timeframe);
    }

    // determine whether or not there are taxes
    $display_tax =  ($sr->grand_total['goods_tax'] > 0);

    if ($output_format === 'display') {
?>
        <tr>
<?php 
        if ($doCustInc === true || $doProdInc === true) {
            // if reporting for a specific product, build up a string of product descriptions
            $i = 0;
            $header_string = '';
            if ($doProdInc === true && DISPLAY_TABLE_HEADING_PRODUCTS) {
                $include_products = explode(',', $prod_includes);
                foreach ($include_products as $pID) {
                    if (empty((int)$pID)) {
                        continue; 
                    }
                    $tempAry = $db->Execute(
                        "SELECT DISTINCT pd.products_name 
                           FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                          WHERE products_id = " . (int)$pID
                    );
                    if ($i === 0) {
                        $header_string = $tempAry->fields['products_name'] ;
                    } else {
                        $header_string .= ', ' . $tempAry->fields['products_name'];
                    }
                    $i++;
                }
            }
            // if reporting for a specific customer, replace the first number in the string of IDs
            // with the actual customer fname,lname
            $i = 0;
            if ($doCustInc === true && DISPLAY_TABLE_HEADING_CUSTOMERS) {
                $include_customers = explode(',', $cust_includes);
                foreach ($include_customers as $cID) {
                    if (empty((int)$cID)) {
                        continue;
                    }
                    $tempAry = $db->Execute(
                        "SELECT DISTINCT c.customers_firstname, c.customers_lastname 
                           FROM " . TABLE_CUSTOMERS . " c 
                          WHERE customers_id = " . (int)$cID
                    );
                    if ($i === 0) {
                        $header_string .= TEXT_CUSTOMER_TABLE_HEADING . $tempAry->fields['customers_firstname'] . " " . $tempAry->fields['customers_lastname'];
                    } else {
                        $header_string .= ", " . $tempAry->fields['customers_firstname'] . ' ' . $tempAry->fields['customers_lastname'];
                    }
                    $i++;
                }
            }
?>
            <td><?php echo $header_string; ?> </td>
<?php
            $colspan = '';
        } else {
            $colspan = ' colspan="2"';
        }
        $sr_link = zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(['output_format', 'auto_print']) . 'output_format=print&auto_print=1');
        $icon_print = '<i class="fa fa-2x fa-print" aria-hidden="true"></i>';
?>
            <td class="text-right"<?php echo $colspan; ?>>
                <a href="<?php echo $sr_link; ?>" title="<?php echo TEXT_PRINT_FORMAT_TITLE; ?>">
                    <span class="smallText"><?php echo $icon_print . TEXT_PRINT_FORMAT; ?></span>
                </a>
            </td>
        </tr>
<?php
    }  // END if ($output_format == 'display')
?>
        <tr>
            <td colspan="2"><table class="table">
<?php
    if ($sr->detail_level === 'timeframe') {
      // timeframe header line is coded twice because we only call it
      // once if we're displaying just totals, but repeats when
      // displaying the line item breakouts
?>
      <!--TIMEFRAME TOTAL HEADER-->
                <tr class="totalHeadingRow">
                    <td class="totalHeadingContent"><?php echo TABLE_HEADING_TIMEFRAME; ?></td>
                    <td class="totalHeadingContent"><?php echo TABLE_HEADING_NUM_ORDERS; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_NUM_PRODUCTS; ?></td>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL_GOODS; ?></td>
<?php 
        if ($display_tax === true) {
?>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_GOODS_TAX; ?></td>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_ORDER_RECORDED_TAX; ?></td>
<?php 
        }
?>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_SHIPPING; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_DISCOUNTS; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_GC_SOLD; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_GC_USED; ?></td>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL; ?></td>
                </tr>
<?php
    }
    // loop through each timeframe, displaying data according to the detail level
    foreach ($sr->timeframe as $id => $timeframe) {
        // generate the timeframe date display
        switch ($sr->timeframe_group) {
            case 'day':
                $time_display = date(TIME_DISPLAY_DAY, $timeframe['sd']);
                break;
            case 'week':
                $time_display = date(TIME_DISPLAY_WEEK, $timeframe['sd']) . DATE_SPACER . date(TIME_DISPLAY_WEEK, $timeframe['ed']);
                break;
            case 'month':
                $time_display = date(TIME_DISPLAY_MONTH, $timeframe['sd']) . DATE_SPACER . date(TIME_DISPLAY_MONTH, $timeframe['ed']);
                break;
            case 'year':
                $time_display = date(TIME_DISPLAY_YEAR, $timeframe['sd']) . DATE_SPACER . date(TIME_DISPLAY_YEAR, $timeframe['ed']);
                break;
        }

        // display the timeframe totals line, if necessary
        if ($sr->detail_level !== 'timeframe' && (isset($timeframe['total']) || DISPLAY_EMPTY_TIMEFRAMES === true)) {
?>
      <!--TIMEFRAME TOTAL HEADER-->
                <tr class="totalHeadingRow">
                    <td class="totalHeadingContent"><?php echo TABLE_HEADING_TIMEFRAME; ?></td>
                    <td class="totalHeadingContent"><?php echo TABLE_HEADING_NUM_ORDERS; ?></td>
                    <td class="totalHeadingContent text-center" colspan="<?php echo ($display_email_address === true) ? 3 : 2; ?>"><?php echo TABLE_HEADING_NUM_PRODUCTS; ?></td>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL_GOODS; ?></td>
<?php 
            if ($display_tax === true) {
?>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_GOODS_TAX; ?></td>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_ORDER_RECORDED_TAX; ?></td>
<?php 
            }
?>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_SHIPPING; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_DISCOUNTS; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_GC_SOLD; ?></td>
                    <td class="totalHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_GC_USED; ?></td>
                    <td class="totalHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL; ?></td>
<?php 
            if ($sr->detail_level === 'order' && $order_total_validation === true) {
?>
                    <td class="totalHeadingContent text-right">&nbsp;</td>
<?php 
            }
?>
                </tr>
<?php
        }

        if (isset($timeframe['total'])) {
?>
                <tr class="totalRow">
                    <td class="totalContent"><?php echo $time_display; ?></td>
                    <td class="totalContent"><?php echo $timeframe['total']['num_orders']; ?></td>
                    <td class="totalContent text-center" colspan="<?php echo ($display_email_address === true) ? 3 : 2; ?>">
                        <?php echo $timeframe['total']['num_products'] . TEXT_DIFF . count($timeframe['total']['diff_products']); ?>
                    </td>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['goods']); ?></td>
<?php 
            if ($display_tax) {
?>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['goods_tax']); ?></td>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['order_recorded_tax']); ?></td>
<?php 
            }
?>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['shipping']); ?></td>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['discount']); ?></td>
                    <td class="totalContent no-wrap"><?php echo TEXT_QTY . $timeframe['total']['discount_qty']; ?></td>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['gc_sold']); ?></td>
                    <td class="totalContent no-wrap"><?php echo TEXT_QTY . $timeframe['total']['gc_sold_qty']; ?></td>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['gc_used']); ?></td>
                    <td class="totalContent no-wrap"><?php echo TEXT_QTY . $timeframe['total']['gc_used_qty']; ?></td>
                    <td class="totalContent text-right"><?php echo $currencies->format($timeframe['total']['grand']); ?></td>
<?php 
            if ($sr->detail_level === 'order' && $order_total_validation === true) {
?>
                    <td class="totalContent text-right">&nbsp;</td>
<?php 
            }
?>
                </tr>
<?php
        } elseif (DISPLAY_EMPTY_TIMEFRAMES === true) {
            // display the "no data" line
            $colspan = 12;
            if ($display_tax === true) {
                $colspan += 2;
            }
            if ($order_total_validation === true) {
                $colspan++;
            }
?>
                <tr class="totalRow">
                    <td class="totalContent"><?php echo $time_display; ?></td>
                    <td class="totalContent text-center" colspan="<?php echo $colspan; ?>"><?php echo TEXT_NO_DATA; ?></td>
                </tr>
<?php
        }

        // display order line items, if necessary
        if ($sr->detail_level === 'order' && isset($timeframe['orders']) && is_array($timeframe['orders']) ) {
            // sort the orders according to requested sort options
            $dataset1 = [];
            $dataset2 = [];
            foreach ($timeframe['orders'] as $oID => $o_data) {
                $dataset1[$oID] = $o_data[$li_sort_a];
                $dataset2[$oID] = $o_data[$li_sort_b];
            }

            // set the sorting arrays to all-lowercase so that the data
            // is sorted independent of any capitalization
            $dataset1 = array_map('strtolower', $dataset1);
            $dataset2 = array_map('strtolower', $dataset2);

            $sort1 = ($li_sort_order_a === 'asc') ? SORT_ASC : SORT_DESC;
            $sort2 = ($li_sort_order_b === 'asc') ? SORT_ASC : SORT_DESC;
            array_multisort($dataset1, $sort1, $dataset2, $sort2, $timeframe['orders']);
?>
      <!--ORDER LINE ITEM HEADER-->
                <tr class="lineItemHeadingRow">
                    <td class="lineItemHeadingContent text-center">
                        <?php echo TABLE_HEADING_ORDERS_ID . show_arrow('oID'); ?>
                    </td>
                    <td class="lineItemHeadingContent">
                        <?php echo TABLE_HEADING_CUSTOMER . show_arrow('last_name'); ?>
                    </td>
<?php
            if ($display_email_address === true) {
?>
                    <td class="lineItemHeadingContent">
                        <?php echo TABLE_HEADING_EMAIL_ADDRESS . show_arrow('email'); ?>
                    </td>
<?php
            }
            if ($show_country_and_state === true) {
?>
                    <td class="lineItemHeadingContent">
                        <?php echo TABLE_HEADING_COUNTRY . show_arrow('country'); ?>
                    </td>
                    <td class="lineItemHeadingContent">
                        <?php echo TABLE_HEADING_STATE . show_arrow('state'); ?>
                    </td>
<?php
            }
?>
                    <td class="lineItemHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_NUM_PRODUCTS . show_arrow('num_products'); ?>
                    </td>
                    <td class="lineItemHeadingContent text-right">
                        <?php echo TABLE_HEADING_TOTAL_GOODS . show_arrow('goods'); ?>
                    </td>
<?php 
            if ($display_tax === true) {
?>
                    <td class="lineItemHeadingContent text-right">
                        <?php echo TABLE_HEADING_GOODS_TAX; ?>
                    </td>
                    <td class="lineItemHeadingContent text-right">
                        <?php echo TABLE_HEADING_ORDER_RECORDED_TAX; ?>
                    </td>
<?php 
            }
?>
                    <td class="lineItemHeadingContent text-right">
                        <?php echo TABLE_HEADING_SHIPPING . show_arrow('shipping'); ?>
                    </td>
                    <td class="lineItemHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_DISCOUNTS . show_arrow('discount'); ?>
                    </td>
                    <td class="lineItemHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_GC_SOLD . show_arrow('gc_sold'); ?>
                    </td>
                    <td class="lineItemHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_GC_USED . show_arrow('gc_used'); ?>
                    </td>
                    <td class="lineItemHeadingContent text-right">
                        <?php echo TABLE_HEADING_ORDER_TOTAL . show_arrow('grand'); ?>
                    </td>
<?php 
            if ($order_total_validation === true) {
?>
                    <td class="lineItemHeadingContent ValidationColumnHeader text-right">
                        <?php echo TABLE_HEADING_ORDER_TOTAL_VALIDATION; ?>
                    </td>
<?php 
            }
?>
                </tr>
<?php
            foreach ($timeframe['orders'] as $key => $o_data) {
                // skip order if it has no value
                // search 'has_no_value' in class file to see how it is set
                if ($o_data['has_no_value']) {
                    continue;
                }
?>
                <tr class="lineItemRow">
                    <td class="lineItemContent text-center">
                        <strong>
                            <a href="<?php echo zen_href_link(FILENAME_ORDERS, 'oID=' . $o_data['oID'] . '&action=edit'); ?>">
                                <?php echo $o_data['oID']; ?>
                            </a>
                        </strong>
                    </td>
                    <td class="lineItemContent">
                        <?php echo $o_data['last_name'] . ', ' . $o_data['first_name']; ?>
                    </td>
<?php
                if ($display_email_address === true) {
?>
                    <td class="lineItemContent">
                        <?php echo $o_data['email']; ?>
                    </td>
<?php
                }

                if ($show_country_and_state === true) {
?>
                    <td class="lineItemContent">
                        <?php echo $o_data['country']; ?>
                    </td>
                    <td class="lineItemContent">
                        <?php echo $o_data['state']; ?>
                    </td>
<?php
                }
?>
                    <td class="lineItemContent text-right">
                        <?php echo $o_data['num_products']; ?>
                    </td>
                    <td class="lineItemContent no-wrap">
                        <?php echo (count($o_data['diff_products']) > 1 ? TEXT_DIFF . count($o_data['diff_products']) : ($o_data['num_products'] > 1 ? TEXT_SAME : TEXT_SAME_ONE)); ?>
                    </td>
                    <td class="lineItemContent rtext-ight">
                        <?php echo $currencies->format($o_data['goods']); ?>
                    </td>
<?php 
                if ($display_tax === true) {
?>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['goods_tax']); ?>
                    </td>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['order_recorded_tax']); ?>
                    </td>
<?php 
                }
?>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['shipping']); ?>
                    </td>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['discount']); ?>
                    </td>
                    <td class="lineItemContent no-wrap">
                        <?php echo TEXT_QTY . $o_data['discount_qty']; ?>
                    </td>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['gc_sold']); ?>
                    </td>
                    <td class="lineItemContent no-wrap">
                        <?php echo TEXT_QTY . $o_data['gc_sold_qty']; ?>
                    </td>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['gc_used']); ?>
                    </td>
                    <td class="lineItemContent no-wrap">
                        <?php echo TEXT_QTY . $o_data['gc_used_qty']; ?>
                    </td>
                    <td class="lineItemContent text-right">
                        <?php echo $currencies->format($o_data['grand']); ?>
                    </td>
<?php 
                if ($order_total_validation === true) {
?>
                    <td class="lineItemContent ValidationColumnContent text-right">
                        <?php echo $o_data['order_total_validation']; ?>
                    </td>
<?php 
                }
?>
                </tr>
<?php
            }
        } elseif ($sr->detail_level === 'product' && !empty($timeframe['products'])) { // display product line items, if necessary
            // sort the products according to requested sort options
            $dataset1 = [];
            $dataset2 = [];
            foreach ($timeframe['products'] as $pID => $p_data) {
                $dataset1[$pID] = $p_data[$li_sort_a];
                $dataset2[$pID] = $p_data[$li_sort_b];
            }
            // set the sorting arrays to all-lowercase so that the data
            // is sorted independent of any capitalization
            $dataset1 = array_map('strtolower', $dataset1);
            $dataset2 = array_map('strtolower', $dataset2);

            $sort1 = ($li_sort_order_a === 'asc') ? SORT_ASC : SORT_DESC;
            $sort2 = ($li_sort_order_b === 'asc') ? SORT_ASC : SORT_DESC;
            array_multisort($dataset1, $sort1, $dataset2, $sort2, $timeframe['products']);

            // we have to nest tables for product line items
            // because the displayed data is so different from timeframe
            // totals, otherwise column layout is a nightmare :)
            $colspan = 13;
            if ($display_tax === true) {
                $colspan += 2;
            }
            if ($order_total_validation === true) {
                $colspan += 1;
            }
?>
                <tr class="lineItemHeadingRow">
                    <td colspan="<?php echo $colspan; ?>"><table class="table">
      <!--PRODUCT LINE ITEM HEADER -->
                        <tr class="lineItemHeadingRow">
                            <td class="lineItemHeadingContent">
                                <?php echo TABLE_HEADING_PRODUCT_ID . show_arrow('pID'); ?>
                            </td>
                            <td class="lineItemHeadingContent">
                                <?php echo TABLE_HEADING_PRODUCT_NAME . show_arrow('name'); ?>
                            </td>
                            <td class="lineItemHeadingContent">
                                <?php echo TABLE_HEADING_PRODUCT_ATTRIBUTES . show_arrow('attributes'); ?>
                            </td>
<?php 
            if (DISPLAY_MANUFACTURER) {
?>
                            <td class="lineItemHeadingContent">
                                <?php echo TABLE_HEADING_MANUFACTURER . show_arrow('manufacturer'); ?>
                            </td>
<?php 
            }
?>
                            <td class="lineItemHeadingContent">
                                <?php echo TABLE_HEADING_MODEL . show_arrow('model'); ?>
                            </td>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_BASE_PRICE . show_arrow('base_price'); ?>
                            </td>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_FINAL_PRICE . show_arrow('final_price'); ?>
                            </td>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_QUANTITY . show_arrow('quantity'); ?>
                            </td>
<?php 
            if ($display_tax === true) {
?>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_TAX; ?>
                            </td>
<?php 
            }
            if (DISPLAY_ONE_TIME_FEES) {
?>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_ONETIME_CHARGES . show_arrow('onetime_charges'); ?>
                            </td>
<?php 
            }
            if ($display_tax === true) {
?>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_TOTAL; ?>
                            </td>
<?php 
            }
?>
                            <td class="lineItemHeadingContent text-right">
                                <?php echo TABLE_HEADING_PRODUCT_TOTAL . show_arrow('grand'); ?>
                            </td>
                        </tr>
<?php
            foreach ($timeframe['products'] as $key => $p_data) {
?>
                        <tr class="lineItemRow">
                            <td class="lineItemContent">
                                <strong><?php echo $p_data['pID']; ?></strong>
                            </td>
                            <td class="lineItemContent">
                                <?php echo $p_data['name']; ?>
                            </td>
                            <td class="lineItemContent">
                                <?php echo $p_data['attributes']; ?>
                            </td>
<?php 
                if (DISPLAY_MANUFACTURER) {
?>
                            <td class="lineItemContent">
                                <?php echo $p_data['manufacturer']; ?>
                            </td>
<?php 
                }
?>
                            <td class="lineItemContent">
                                <?php echo $p_data['model']; ?>
                            </td>
                            <td class="lineItemContent text-right">
                                <?php echo $currencies->format($p_data['base_price']); ?>
                            </td>
                            <td class="lineItemContent text-right">
                                <?php echo $currencies->format($p_data['final_price']); ?>
                            </td>
                            <td class="lineItemContent text-right">
                                <?php echo $p_data['quantity']; ?>
                            </td>
<?php 
                if ($display_tax === true) {
?>
                            <td class="lineItemContent text-right">
                                <?php echo $currencies->format($p_data['tax']); ?>
                            </td>
<?php 
                }
                if (DISPLAY_ONE_TIME_FEES) {
?>
                            <td class="lineItemContent text-right">
                                <?php echo $currencies->format($p_data['onetime_charges']); ?>
                            </td>
<?php 
                }
                if ($display_tax === true) {
?>
                            <td class="lineItemContent text-right">
                                <?php echo $currencies->format($p_data['total']); ?>
                            </td>
<?php 
                }
?>
                            <td class="lineItemContent text-right">
                                <?php echo $currencies->format($p_data['grand']); ?>
                            </td>
                        </tr>
<?php
            }  // END foreach($timeframe['products'] as $pID => $p_data) {
?>
                    </table></td>
                </tr>
<?php
        } elseif ($sr->detail_level === 'matrix' && isset($timeframe['orders']) && isset($timeframe['products'])) {  // display the data matrix
            $colspan = 13;
            if ($display_tax === true) {
                $colspan += 2;
            }
            if ($order_total_validation === true) {
                $colspan += 1;
            }
?>
                <tr class="lineItemHeadingRow">
                    <td class="lineItemHeadingContent text-center" colspan="<?php echo $colspan; ?>">
                        <?php echo MATRIX_GENERAL_STATS; ?>
                    </td>
                </tr>
                <tr class="lineItemRow">
                    <td colspan="<?php echo $colspan; ?>"><table>
                        <tr class="lineItemRow v-top">
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="3">
                                        <strong><?php echo MATRIX_ORDER_REVENUE; ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_LARGEST; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo $timeframe['matrix']['biggest_per_revenue']; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo '(' . $currencies->format($timeframe['orders'][ $timeframe['matrix']['biggest_per_revenue'] ]['goods']) . ')'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_SMALLEST; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo $timeframe['matrix']['smallest_per_revenue']; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo '(' . $currencies->format($timeframe['orders'][ $timeframe['matrix']['smallest_per_revenue'] ]['goods']) . ')'; ?>
                                    </td>
                                </tr>
                            </table></td>
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="3">
                                        <strong><?php echo MATRIX_ORDER_PRODUCT_COUNT; ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_LARGEST; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo $timeframe['matrix']['biggest_per_product']; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo '(' . $timeframe['orders'][ $timeframe['matrix']['biggest_per_product'] ]['num_products'] . ')'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_SMALLEST; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo $timeframe['matrix']['smallest_per_product']; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo '(' . $timeframe['orders'][ $timeframe['matrix']['smallest_per_product'] ]['num_products'] . ')'; ?>
                                    </td>
                                </tr>
                            </table></td>
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="2">
                                        <strong><?php echo MATRIX_AVERAGES; ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent text-right">
                                        <strong><?php echo $currencies->format($timeframe['matrix']['avg_order_value']); ?></strong>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_AVG_ORDER; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent text-right">
                                        <strong><?php echo number_format($timeframe['matrix']['avg_products_per_order'], NUM_DECIMAL_PLACES); ?></strong>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_AVG_PROD_ORDER; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent text-right">
                                        <strong><?php echo number_format($timeframe['matrix']['avg_diff_products_per_order'], NUM_DECIMAL_PLACES); ?></strong>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_AVG_PROD_ORDER_DIFF; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lineItemContent text-right">
                                        <strong><?php echo number_format($timeframe['matrix']['avg_orders_per_customer'], NUM_DECIMAL_PLACES); ?></strong>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo MATRIX_AVG_ORDER_CUST; ?>
                                    </td>
                                </tr>
                            </table></td>
                        </tr>
                    </table></td>
                </tr>
                <tr class="lineItemHeadingRow">
                    <td class="lineItemHeadingContent text-center" colspan="<?php echo $colspan; ?>">
                        <?php echo MATRIX_ORDER_STATS; ?>
                    </td>
                </tr>
                <tr class="lineItemRow">
                    <td colspan="<?php echo $colspan; ?>"><table>
                        <tr class="lineItemRow v-top">
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="3">
                                        <strong><?php echo MATRIX_TOTAL_PAYMENTS; ?></strong>
                                    </td>
                                </tr>
<?php 
            foreach ($timeframe['matrix']['payment_methods'] as $key => $payment) {
?>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo $payment['method']; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo '&nbsp;[' . $payment['module_code'] . ']'; ?>
                                    </td>
                                    <td class="lineItemContent" align="text-right">
                                        <?php echo $payment['count']; ?>
                                    </td>
                                </tr>
<?php 
            }
?>
                            </table></td>
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="2">
                                        <strong><?php echo MATRIX_TOTAL_CC; ?></strong>
                                    </td>
                                </tr>
 <?php 
            foreach ($timeframe['matrix']['credit_cards'] as $key => $cc) {
 ?>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo $cc['type']; ?>
                                    </td>
                                    <td class="lineItemContent text-right">
                                        <?php echo $cc['count']; ?>
                                    </td>
                                </tr>
<?php 
            }
?>
                            </table></td>
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="3">
                                        <strong><?php echo MATRIX_TOTAL_SHIPPING; ?></strong>
                                    </td>
                                </tr>
<?php 
            foreach ($timeframe['matrix']['shipping_methods'] as $key => $shipping) {
?>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo $shipping['method']; ?>
                                    </td>
                                    <td class="lineItemContent">
                                        <?php echo '&nbsp;[' . $shipping['module_code'] . ']'; ?>
                                    </td>
                                    <td class="llineItemContent text-right">
                                        <?php echo $shipping['count']; ?>
                                    </td>
                                </tr>
<?php 
            }
?>
                            </table></td>
<?php 
            if (count($timeframe['matrix']['currencies']) !== 0) {
?>
                            <td><table class="table">
                                <tr>
                                    <td class="lineItemContent" colspan="2">
                                        <strong><?php echo MATRIX_TOTAL_CURRENCIES; ?></strong>
                                    </td>
                                </tr>
<?php 
                foreach ($timeframe['matrix']['currencies'] as $key => $currency) {
?>
                                <tr>
                                    <td class="lineItemContent">
                                        <?php echo $currency['type']; ?>
                                    </td>
                                    <td class="lineItemContent text-right">
                                        <?php echo $currency['count']; ?>
                                    </td>
                                </tr>
<?php 
                }
?>
                            </table></td>
<?php 
            }
?>
                        </tr>
                    </table></td>
                </tr>
                <tr class="lineItemHeadingRow">
                    <td class="lineItemHeadingContent text-center" colspan="<?php echo $colspan; ?>">
                        <?php echo MATRIX_PRODUCT_STATS; ?>
                    </td>
                </tr>
                <tr class="lineItemRow">
                    <td colspan="<?php echo $colspan; ?>"><table class="table">
                        <tr class="lineItemRow">
                            <td class="lineItemContent">
                                <strong><?php echo TABLE_HEADING_PRODUCT_ID; ?></strong>
                            </td>
                            <td class="lineItemContent">
                                <strong><?php echo TABLE_HEADING_PRODUCT_NAME; ?></strong>
                            </td>
                            <td class="lineItemContent text-center">
                                <strong><?php echo MATRIX_PRODUCT_SPREAD; ?></strong>
                            </td>
                            <td class="lineItemContent text-right">
                                <strong><?php echo MATRIX_PRODUCT_REVENUE_RATIO; ?></strong>
                            </td>
                            <td class="lineItemContent text-right">
                                <strong><?php echo MATRIX_PRODUCT_QUANTITY_RATIO; ?></strong>
                            </td>
                        </tr>
<?php
            foreach ($timeframe['products'] as $pID => $p_data) {
?>
                        <tr class="lineItemRow">
                            <td class="lineItemContent">
                                <?php echo $pID; ?>
                            </td>
                            <td class="lineItemContent">
                                <?php echo $p_data['name'] . $p_data['attributes']; ?>
                            </td>
                            <td class="lineItemContent text-center">
                                <?php echo $timeframe['matrix']['product_spread'][$pID]; ?>
                            </td>
                            <td class="lineItemContent text-right">
                                <?php echo $timeframe['matrix']['product_revenue_ratio'][$pID]; ?>
                            </td>
                            <td class="lineItemContent text-right">
                                <?php echo $timeframe['matrix']['product_quantity_ratio'][$pID]; ?>
                            </td>
                        </tr>
<?php
            }
?>
                    </table></td>
                </tr>
<?php
        }  // END elseif ($sr->detail_level == 'matrix' && is_array($timeframe['matrix']) )

    }  // END for ($i = 0; $i < sizeof($sr->timeframe); $i++)

    // now display the grand total line (if necessary)
    // the totals don't change with only 1 timeframe, so we
    // require that there be more than one to display it
    if (count($sr->timeframe) > 1) {
?>
                <tr>
                    <td><!-- spacer cell --></td>
                </tr>
<?php 
        if ($sr->detail_level !== 'timeframe') {
?>
                <tr class="totalHeadingRow">
                    <td class="totalHeadingContent">
                        <?php echo TABLE_HEADING_TIMEFRAME; ?>
                    </td>
                    <td class="totalHeadingContent">
                        <?php echo TABLE_HEADING_NUM_ORDERS; ?>
                    </td>
                    <td class="totalHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_NUM_PRODUCTS; ?>
                    </td>
                    <td class="totalHeadingContent text-right">
                        <?php echo TABLE_HEADING_TOTAL_GOODS; ?>
                    </td>
<?php 
            if ($display_tax === true) {
?>
                    <td class="totalHeadingContent text-right">
                        <?php echo TABLE_HEADING_GOODS_TAX; ?>
                    </td>
                    <td class="totalHeadingContent text-right">
                        <?php echo TABLE_HEADING_ORDER_RECORDED_TAX; ?>
                    </td>
<?php 
            }
?>
                    <td class="totalHeadingContent text-right">
                        <?php echo TABLE_HEADING_SHIPPING; ?>
                    </td>
                    <td class="totalHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_DISCOUNTS; ?>
                    </td>
                    <td class="totalHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_GC_SOLD; ?>
                    </td>
                    <td class="totalHeadingContent text-center" colspan="2">
                        <?php echo TABLE_HEADING_GC_USED; ?>
                    </td>
                    <td class="totalHeadingContent text-right">
                        <?php echo TABLE_HEADING_TOTAL; ?>
                    </td>
<?php 
            if ($sr->detail_level === 'order' && $order_total_validation === true) {
?>
                    <td class="totalHeadingContent text-right">&nbsp;</td>
<?php 
            }
?>
                </tr>
<?php 
        }
?>
      <!-- GRAND TOTAL LINE -->
                <tr class="footerRow">
                    <td class="footerContent">
                        <?php echo count($sr->timeframe) . TABLE_FOOTER_TIMEFRAMES; ?>
                    </td>
                    <td class="footerContent">
                        <?php echo $sr->grand_total['num_orders']; ?>
                    </td>
                    <td class="footerContent text-center" colspan="2">
                        <?php echo $sr->grand_total['num_products']; ?>
                    </td>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['goods']); ?>
                    </td>
<?php 
        if ($display_tax === true) {
?>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['goods_tax']); ?>
                    </td>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['order_recorded_tax']); ?>
                    </td>
<?php 
        }
?>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['shipping']); ?>
                    </td>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['discount']); ?>
                    </td>
                    <td class="footerContent no-wrap">
                        <?php echo TEXT_QTY . $sr->grand_total['discount_qty']; ?>
                    </td>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['gc_sold']); ?>
                    </td>
                    <td class="footerContent no-wrap">
                        <?php echo TEXT_QTY . $sr->grand_total['gc_sold_qty']; ?>
                    </td>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['gc_used']); ?>
                    </td>
                    <td class="footerContent no-wrap">
                        <?php echo TEXT_QTY . $sr->grand_total['gc_used_qty']; ?>
                    </td>
                    <td class="footerContent text-right">
                        <?php echo $currencies->format($sr->grand_total['grand']); ?>
                    </td>
<?php 
        if ($sr->detail_level === 'order' && $order_total_validation === true) {
?>
                    <td class="footerContent">&nbsp;</td>
<?php 
        }
?>
                </tr>
      <!-- END GRAND TOTAL LINE -->
<?php
    }  // END if (sizeof($sr->timeframe) > 1)
?>
            </table></td>
        </tr>
<?php
    if ($output_format === 'print') {
?>
        <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', 30, 20); ?></td>
            <td class="smallText text-right">
                <?php echo TEXT_REPORT_TIMESTAMP . zen_datetime_short(date('Y-m-d H:i:s')); ?>
            </td>
        </tr>
<?php
    } elseif ($output_format === 'display') {
        $parse_end = get_microtime();
        $parse_time = $parse_end - $parse_start;
?>
        <tr>
            <td colspan="2" class="text-right">
                <a href="<?php echo zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(['output_format', 'auto_print']) . 'output_format=print&auto_print=1', 'NONSSL'); ?>" title="<?php echo TEXT_PRINT_FORMAT_TITLE; ?>">
                    <span class="smallText"><i class="fa fa-2x fa-print" aria-hidden="true"></i><?php echo TEXT_PRINT_FORMAT; ?></span>
                </a>
            </td>
        </tr>
        <tr>
            <td class="smallText">
                <?php printf(TEXT_PARSE_TIME, number_format($parse_time, 5) ); ?>
            </td>
            <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 20); ?></td>
        </tr>
<?php
    }
}  // END if ($output_format == 'print' || $output_format == 'display')
?>
    </table><?php echo '</form>'; ?>
<?php 
require DIR_WS_INCLUDES . 'javascript/sales_report.js.php'; 
if ($output_format !== 'print') {
    require DIR_WS_INCLUDES . 'footer.php';
?>
    <script>
    $(function() {
        $('#start-date').datepicker();
        $('#end-date').datepicker();
    });
    </script>
<?php
}
?>
</body>
</html>
<?php
require DIR_WS_INCLUDES . 'application_bottom.php';

// used to show the page parse time
// look for $parse_start and $parse_end to see how it works
function get_microtime()
{
    list($usec, $sec) = explode(' ', microtime());
    return ((float)$usec + (float)$sec);
}

// controls the sorting arrows that appear next to the sorted
// columns with order/product line item displays
function show_arrow($report_field)
{
    global $li_sort_a, $li_sort_order_a, $li_sort_b, $li_sort_order_b, $output_format;

    $down_arrow = sales_report::getDownArrowIcon();
    $up_arrow = sales_report::getUpArrowIcon();

    if ($report_field == $li_sort_a) {
        $link_parms = zen_get_all_get_params(['li_sort_order_a']) . 'li_sort_order_a=';
        $arrow_id = 'img_sort_a';
        $span_value = '1';
        $sort_order = $li_sort_order_a;
    } elseif ($report_field == $li_sort_b) {
        $link_parms = zen_get_all_get_params(['li_sort_order_b']) . 'li_sort_order_b=';
        $arrow_id = 'img_sort_b';
        $span_value = '2';
        $sort_order = $li_sort_order_b;
    }

    $formatted_arrow = null;
    if (isset($sort_order)) {
        if ($sort_order == 'asc') {
            $mouseover = $down_arrow;
            $mouseout = $up_arrow;
            $arrow_image = $up_arrow;
            $arrow_alt = ALT_TEXT_SORT_DESC;
            $link_parms .= 'desc';
         } else {
            $mouseover = $up_arrow;
            $mouseout = $down_arrow;
            $arrow_image = $down_arrow;
            $arrow_alt = ALT_TEXT_SORT_ASC;
            $link_parms .= 'asc';
        }
        $arrow = $arrow_image . ' <span class="lineItemHeadingContent">' . $span_value . '</span>';

        if ($output_format === 'display') {
            $link = '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, $link_parms, 'NONSSL') . '">';
            $formatted_arrow = '&nbsp;' . $link . $arrow . '</a>';
        } else {
            $formatted_arrow = '&nbsp;' . $arrow;
        }
    }
    return $formatted_arrow;
}
