<?php

/**
 * SALES REPORT 3.3.3
 *
 * The language file contains all the text that appears on the report. The first set of
 * configuration defines actually impact the report's output and behavior.
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @updated by stellarweb to work with version 1.5.0 02-29-12 
 * @updated by lat9 for continued operation under zc155/zc156, 20190622
 * @copyright  Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 */

//////////////////////////////////////////////////////////
// DISPLAY EMPTY TIMEFRAME LINES
// Setting this define to true will disable displaying
// a timeframe line if that timeframe is empty.  By
// default, an empty timeframe displays the value of the
// define TEXT_NO_DATA.
//
// Be aware, if this is enabled and your search yields
// no results at all, the screen will look as if no search
// was performed (which is why this is disabled by default)
//
define('DISPLAY_EMPTY_TIMEFRAMES', false);

//////////////////////////////////////////////////////////
// REPORTING A SUBSET OF CUSTOMERS / PRODUCTS
// By checking the boxes to 'Only Include Specific customers
// or Products (SEARCH_SPECIFIC_CUSTOMERS/PRODUCTS),
// only orders for those customers / products will be
// included in the result. By default, the included customers/
// products will be printed above the results table. If this
// gets too long, this printout can be disabled with
// the DISPLAY booleans below.
//
// If you often want a specific product, you can set a 
// default here, e.g.:
// define('INCLUDE_PRODUCTS', '10, 15');
//
define('INCLUDE_PRODUCTS', '');
define('INCLUDE_CUSTOMERS', '');
define('DISPLAY_TABLE_HEADING_CUSTOMERS', true);
define('DISPLAY_TABLE_HEADING_PRODUCTS', true);
define('TEXT_CUSTOMER_TABLE_HEADING', ' Orders for: ');  //Prefix used to print before customer name(s) when filtering by customer


//////////////////////////////////////////////////////////
// PRODUCT MANUFACTURERS COLUMN
// Setting this define to true will display the
// manufacturer on each product line item, and will default
// to the value of TEXT_NONE if there is no manufacturer.
// False will remove the manufacturer column from the report.
//
define('DISPLAY_MANUFACTURER', false);


//////////////////////////////////////////////////////////
// ONE-TIME FEES COLUMN
// If your store does not have *any* one-time fees on its
// products, you can disable displaying the column.
//
// Note that this switch does not affect math calculations,
// so if you happen to have a product with fees attached,
// they will still be accounted for and appear in the total.
//
define('DISPLAY_ONE_TIME_FEES', false);


//////////////////////////////////////////////////////////
// DECIMAL PLACES IN AVERAGES
// Sets the number of decimal places displayed in averages
// on timeframe statistics display
//
define('NUM_DECIMAL_PLACES', 2);


//////////////////////////////////////////////////////////
// TIMEFRAME DATE DISPLAY
// Note:  Other constants moved to the main processing file for v3.2.1.
//
define('DATE_SPACER', ' to<br />&nbsp;&nbsp;&nbsp;');

//////////////////////////////////////////////////////////
// EXCLUDE SPECIFIED PRODUCTS
// Prevents specified products from appearing on the sales
// report at all.  **ADDING PRODUCTS TO THIS DEFINE WILL
// IMPACT TOTALS CALCULATIONS!**
//
// The value of the product will be excluded from totals
// for gc_sold, gc_sold_qty, goods, num_products, and
// diff_products.
//
// The values for gc_used, gc_used_qty, discount,
// discount_qty, tax, and shipping all come from the
// orders_total table, and so CANNOT be excluded based
// on product ID.
//
// If an order is made up entirely of excluded products,
// and has no shipping, discounts, tax, or used gift
// certificates, it will have a total of 0.  In this
// situation, the order will not be displayed in the results.
//
// EXAMPLE: define('EXCLUDE_PRODUCTS', serialize(array(25, 14, 43)) );
//
define('EXCLUDE_PRODUCTS', serialize(array( )));



/*
** LANGUAGE DEFINES
*/
// Search menu heading
define('PAGE_HEADING', 'Sales Report');
define('HEADING_TITLE_SEARCH', '1. Gather &amp; Filter Data');
define('HEADING_TITLE_SORT', '2. Sort &amp; Specify Results');
define('HEADING_TITLE_PROCESS', '3. Generate Report');
define('SEARCH_TIMEFRAME', 'Timeframe');
define('SEARCH_TIMEFRAME_DAY', 'Daily');
define('SEARCH_TIMEFRAME_WEEK', 'Weekly');
define('SEARCH_TIMEFRAME_MONTH', 'Monthly');
define('SEARCH_TIMEFRAME_YEAR', 'Annually');
define('SEARCH_TIMEFRAME_SORT', 'Timeframe Sort');
define('SEARCH_DATE_PRESET', 'Preset Date Range');
define('SEARCH_DATE_CUSTOM', 'Custom Date Range');
define('SEARCH_DATE_TODAY', 'Today (%s)');
define('SEARCH_DATE_YESTERDAY', 'Yesterday (%s)');
define('SEARCH_DATE_LAST_MONTH', 'Last Month (%s)');
define('SEARCH_DATE_THIS_MONTH', 'This Month (%s)');
define('SEARCH_DATE_LAST_YEAR', 'Last Year (%s)');
define('SEARCH_DATE_YTD', 'YTD (%s)');
define('SEARCH_START_DATE', 'Start Date');
define('SEARCH_END_DATE', 'End Date (inclusive)');
define('SEARCH_DATE_FORMAT', 'mm/dd/yyyy');
define('SEARCH_DATE_TARGET', 'Search date of...');
define('SEARCH_PAYMENT_METHOD', 'Payment Method');
define('SEARCH_PAYMENT_METHOD_OMIT', 'Payment Method To Omit');
define('SEARCH_CURRENT_STATUS', 'Current Order Status');
define('SEARCH_EXCLUDED_STATUS', 'Order Status to Omit');
define('SEARCH_SPECIFIC_CUSTOMERS', 'Only include specific Customer IDs (comma separated list)');
define('SEARCH_SPECIFIC_PRODUCTS', 'Only include specific Product IDs (comma separated list)');
define('SEARCH_MANUFACTURER', 'Product Manufacturer');
define('SEARCH_DETAIL_LEVEL', 'Displayed Information');
define('SEARCH_OUTPUT_FORMAT', 'Output Format');
define('SEARCH_SORT_PRODUCT', 'Sort products by...');
define('SEARCH_SORT_ORDER', 'Sort orders by...');
define('SEARCH_SORT_THEN', 'Then sort by...');
define('BUTTON_SEARCH', 'Show me the money!');
define('BUTTON_DEFAULT_SEARCH', 'Quick Search');
define('SEARCH_WAIT_TEXT', 'Processing, please wait...');


// Form element text
// radio buttons
define('RADIO_DATE_TARGET_PURCHASED', 'Order purchase');
define('RADIO_DATE_TARGET_STATUS', 'Assigned status (select below)');
define('RADIO_TIMEFRAME_SORT_ASC', 'Oldest on top');
define('RADIO_TIMEFRAME_SORT_DESC', 'Newest on top');
define('RADIO_LI_SORT_ASC', 'Ascending');
define('RADIO_LI_SORT_DESC', 'Descending');

// dropdown menus
define('SELECT_DETAIL_TIMEFRAME', 'Timeframe Totals');
define('SELECT_DETAIL_PRODUCT', '&nbsp;+ Product Line Items');
define('SELECT_DETAIL_ORDER', '&nbsp;+ Order Line Items');
define('SELECT_DETAIL_MATRIX', 'Timeframe Statistics');
define('SELECT_OUTPUT_DISPLAY', 'Screen Display');
define('SELECT_OUTPUT_PRINT', 'Print Format');
define('SELECT_OUTPUT_CSV', 'CSV Export');
define('SELECT_PRODUCT_ID', 'Product ID');
define('SELECT_QUANTITY', 'Quantity');
define('SELECT_LAST_NAME', 'Cust. Last Name');

// checkboxes
define('CHECKBOX_AUTO_PRINT', 'Print report automatically');
define('CHECKBOX_CSV_HEADER', 'Column titles in first row');
define('CHECKBOX_NEW_WINDOW', 'Open results in new window');
define('CHECKBOX_VALIDATE_TOTALS', ' Output Order Total Validation Column');

// Report Column Headings
// Timeframe
define('TABLE_HEADING_TIMEFRAME', 'Timeframe');
define('TABLE_HEADING_NUM_ORDERS', 'Num Orders');
define('TABLE_HEADING_NUM_PRODUCTS', 'Num Products');
define('TABLE_HEADING_TOTAL_GOODS', 'Goods Value');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_GOODS_TAX', 'Goods Tax');
define('TABLE_HEADING_ORDER_RECORDED_TAX', 'Order Rec. Tax');
define('TABLE_HEADING_SHIPPING', 'Shipping');
define('TABLE_HEADING_DISCOUNTS', 'Discounts');
define('TABLE_HEADING_GC_SOLD', 'Gift Cert. Sold');
define('TABLE_HEADING_GC_USED', 'Gift Cert. Used');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_FOOTER_TIMEFRAMES', ' Timeframes');

// Order Line Items
define('TABLE_HEADING_ORDERS_ID', 'Order ID');
define('TABLE_HEADING_CUSTOMER', 'Customer');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total');
define('TABLE_HEADING_ORDER_TOTAL_VALIDATION', 'OT Valid');

// Product Line Items
define('TABLE_HEADING_PRODUCT_ID', 'Prod ID');
define('TABLE_HEADING_PRODUCT_NAME', 'Product Name');
define('TABLE_HEADING_PRODUCT_ATTRIBUTES', 'Attributes');
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
define('TABLE_HEADING_MODEL', 'Model No.');
define('TABLE_HEADING_BASE_PRICE', 'Base Price');
define('TABLE_HEADING_FINAL_PRICE', 'Final Price');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_ONETIME_CHARGES', '1-time Fees');
define('TABLE_HEADING_PRODUCT_TOTAL', 'Product Total');

// Data Matrix
define('MATRIX_GENERAL_STATS', 'General Stats');
define('MATRIX_ORDER_REVENUE', 'Total Revenue');
define('MATRIX_ORDER_PRODUCT_COUNT', 'Total Product Count');
define('MATRIX_LARGEST', 'Largest Order: ');
define('MATRIX_SMALLEST', 'Smallest Order: ');
define('MATRIX_AVERAGES', 'Averages');
define('MATRIX_AVG_ORDER', '&nbsp;order value');
define('MATRIX_AVG_PROD_ORDER', '&nbsp;products per order');
define('MATRIX_AVG_PROD_ORDER_DIFF', '&nbsp;unique products per order');
define('MATRIX_AVG_ORDER_CUST', '&nbsp;orders per customer');
define('MATRIX_ORDER_STATS', 'Order Stats');
define('MATRIX_TOTAL_PAYMENTS', 'Payment Methods');
define('MATRIX_TOTAL_CC', 'Credit Cards');
define('MATRIX_TOTAL_SHIPPING', 'Shipping Methods');
define('MATRIX_TOTAL_CURRENCIES', 'Used Currencies');
define('MATRIX_TOTAL_CUSTOMERS', 'Unique Customers');
define('MATRIX_PRODUCT_STATS', 'Product Stats');
define('MATRIX_PRODUCT_SPREAD', 'Product Spread');
define('MATRIX_PRODUCT_REVENUE_RATIO', 'Total Revenue %');
define('MATRIX_PRODUCT_QUANTITY_RATIO', 'Total Quantity %');


// CSV Export
define('CSV_FILENAME_PREFIX', 'sales_');
define('CSV_HEADING_START_DATE', 'Start Date');
define('CSV_HEADING_END_DATE', 'End Date');
define('CSV_HEADING_LAST_NAME', 'Last Name');
define('CSV_HEADING_FIRST_NAME', 'First Name');
define('CSV_SEPARATOR', ',');
define('CSV_NEWLINE', "\n");


// Print Format
define('PRINT_DATE_TO', ' thru ');
define('PRINT_DATE_TARGET', 'Date of ');
define('PRINT_TIMEFRAMES', '%s timeframes sorted %s');
define('PRINT_DATE_PURCHASED', 'order creation');
define('PRINT_DATE_STATUS', 'assigned status');
define('PRINT_ORDER_STATUS', '%s [%s]');
define('PRINT_PAYMENT_METHOD', 'Payment Method:');
define('PRINT_CURRENT_STATUS', 'Current Order Status:');
define('PRINT_DETAIL_LEVEL', 'Displaying ');

// javascript pop-up alert window
define('ALERT_JS_HIGHLIGHT', '#FF40CF');
define('ALERT_MSG_START', 'There are one or more errors with your selections:');
define('ALERT_DATE_INVALID_LENGTH', '> Dates must be 10 characters in length: ');
define('ALERT_DATE_INVALID', '> This is not a valid date: ');
define('ALERT_CSV_CONFLICT', '> CSV output is not available for ' . SELECT_DETAIL_MATRIX . ' display.');
define('ALERT_MSG_FINISH', 'Please correct the issue(s) and resubmit your search.');

// Other text defines
define('ERROR_MISSING_REQ_INFO', 'Error: Required fields are empty');
define('ERROR_CSV_CONFLICT', 'CSV output is not available for <em>' . SELECT_DETAIL_MATRIX . '</em> display; please re-select the report options.');
define('ALT_TEXT_SORT_ASC', 'Re-sort in ASCENDING order');
define('ALT_TEXT_SORT_DESC', 'Re-sort in DESCENDING order');
define('TEXT_REPORT_TIMESTAMP', 'Report Time: ');
define('TEXT_PARSE_TIME', 'Parse Time: %s sec.');
define('TEXT_EMPTY_SELECT', '(doesn\'t matter)');
define('TEXT_QTY', '| Qty: ');
define('TEXT_DIFF', '| Diff: ');
define('TEXT_SAME', '| (same)');
define('TEXT_SAME_ONE', '| --');
define('TEXT_PRINT_FORMAT', 'display report in print format');
define('TEXT_PRINT_FORMAT_TITLE', 'TIP: click \'' . PAGE_HEADING . '\' to return to display view');
define('TEXT_NO_DATA', '-- NO ORDERS IN TIMEFRAME --');

// Buttons
define('BUTTON_TIMEFRAME_PRESET', 'Choose Preset');
define('BUTTON_TIMEFRAME_CUSTOM', 'Choose Custom');
