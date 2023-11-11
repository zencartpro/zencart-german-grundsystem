<?php
/**
 * SALES REPORT 4.0.0
 * Zen Cart German Specific (zencartpro adaptations)
 * The class file acts as the engine in the sales report.  All the data displayed is gathered and
 * calculated in here. The logic tree provides a brief summary of the main functions at work every
 * time a report is generated. 
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @author     Carl Peach <carlvt88 at zen-cart.com/forum>
 * @updated by webchills to work with most European configs - 2023-02-05
 * @updated by lat9, for continued operation for zc155/zc156, 20190622
 * @copyright  Portions Copyright 2003-2023 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 *  
 * update:  Josef Zahradník
 * web:     www.magic-shop.cz   
 */


/*
** Logic Tree of class sales_report functions
  sales_report - establishes base class variables, initializes loop for timeframes
   |
   |_build_timeframe - initial oID query for given timeframe
       |_build_li_totals - basic totals for each timeframe
           |_build_li_orders - line item for each order in the timeframe
           |_build_li_products - line item for each product in the timeframe
       |_build_matrix - calculate detailed stats for each timeframe; non-linear display;
                        uses data from build_li_orders and build_li_products
*/

  //_TODO modularize time format code, allowing for other formats

class sales_report extends base
{
    public
        $detail_level,
        $timeframe,
        $timeframe_group,
        $grand_total;

    protected
        $sd,
        $sd_raw,
        $ed,
        $ed_raw,
        $date_target,
        $date_status,
        $current_date,
        $global_sd,

        $payment_method,
        $payment_method_omit,

        $current_status,
        $excluded_status,

        $manufacturer,
        $output_format,
        $order_total_validation,
        $display_email_address,

        $doProdInc,
        $prod_includes,
        $product_filter,

        $doCustInc,
        $cust_includes,
        $customer_filter,

        $order_total_discounts,
        $order_total_surcharges,

        $li_sort_a,
        $li_sort_order_a,
        $li_sort_b,
        $li_sort_order_b,

        $timeframe_id,
        $timeframe_sort;

    // -----
    // Static methods used by the report to display the up- and down-arrow icons.
    //
    public static function getUpArrowIcon()
    {
        return '<i class="fa fa-2x fa-caret-up" aria-hidden="true"></i>';
    }
    public static function getDownArrowIcon()
    {
        return '<i class="fa fa-2x fa-caret-down" aria-hidden="true"></i>';
    }

    public function __construct($parms)
    {
        global $db;

        // place passed variables into class variables
        $this->timeframe_group = $parms['timeframe'];
        $this->timeframe_sort = $parms['timeframe_sort'];
        $this->date_target = $parms['date_target'];
        $this->date_status = $parms['date_status'];
        $this->payment_method = $parms['payment_method'];
        $this->payment_method_omit = $parms['payment_method_omit'];
        $this->current_status = (int)$parms['current_status'];
        $this->excluded_status = (int)$parms['excluded_status'];
        $this->manufacturer = (int)$parms['manufacturer'];
        $this->detail_level = $parms['detail_level'];
        $this->output_format = $parms['output_format'];
        $this->order_total_validation = (bool)$parms['order_total_validation'];
        $this->display_email_address = (bool)$parms['display_email'];

        $this->li_sort_a = $parms['li_sort_a'];
        $this->li_sort_order_a = $parms['li_sort_order_a'];
        $this->li_sort_b = $parms['li_sort_b'];
        $this->li_sort_order_b = $parms['li_sort_order_b'];

        $this->doCustInc = (bool)$parms['doCustInc'];
        $this->cust_includes = $parms['cust_includes'];
        $this->customer_filter = '';

        $this->doProdInc = (bool)$parms['doProdInc'];
        $this->prod_includes = $parms['prod_includes'];
        $this->product_filter = '';

        // -----
        // All date-related calculations are done via timestamps.  Starting with v4.0.0,
        // using the 'datepicker' and the main report has 'sanitized' the dates so that
        // they're submitted to this class in yyyy-mm-dd format!
        //
        $sd = $parms['start_date'];
        $ed = $parms['end_date'];
        $this->sd_raw = strtotime($sd . ' 00:00:00');
        $this->ed_raw = strtotime($ed . ' 00:00:00');

        // run a few checks on the dates
        // avoid dates before the first order
        $first = $db->Execute("SELECT MIN(date_purchased) AS date FROM " . TABLE_ORDERS);
        $this->global_sd = strtotime(substr($first->fields['date'], 0, 10));
        if ($this->sd_raw === false || $this->sd_raw < $this->global_sd) {
            $this->sd_raw = $this->global_sd;
        }
        if ($this->ed_raw === false || $this->ed_raw < $this->global_sd) {
            $this->ed_raw = $this->global_sd;
        }

        // avoid days in the future
        $now = strtotime('today midnight');
        if ($this->sd_raw > $now) {
            $this->sd_raw = $now;
        }
        if ($this->ed_raw > $now) {
            $this->ed_raw = $now;
        }

        // -----
        // Ensure that the ending date is not earlier than the starting date,
        // resetting to the starting date if so.
        //
        if ($this->ed_raw < $this->sd_raw) {
            $this->ed_raw = $this->sd_raw;
        }

        // now that the date checks are out of the way, let's begin
        $this->sd = date('Y-m-d', $this->sd_raw);
        $this->ed = date('Y-m-d', $this->ed_raw);
        $this->current_date = $this->sd_raw;

        $this->timeframe_id = 0;
        $this->timeframe = [];
        $this->grand_total = $this->initializeTotals();

        while ($this->current_date <= $this->ed_raw) {
            $this->build_timeframe();
        }

        // build matrix data if requested
        // By placing it here and adding 'matrix' to the 'if' statements
        // for building order and product line items, we have all
        // the possible data at our disposal
        if ($this->detail_level === 'matrix') {
            $this->build_matrix();
        }
    }  // END class constructor


    //////////////////////////////////////////////////////////
    // Each time this function runs, another timeframe array element is created.
    // The variable $this->current_date acts as the key, used to determine the start and end dates of this
    // particular timeframe.  All other functions are called from within here to build all the requested timeframe
    // information (order line items, product line items, or data matrix).
    //
    protected function build_timeframe()
    {
        global $db;
        $id = $this->timeframe_id;  // we use $id to keep arrays short, easier to read

        // $sd and $ed are local to this function, not to be confused with
        // $this->start_date and $this->end_date, entered by the user
        $sd = $this->current_date;

        switch ($this->timeframe_group) {
            case 'year':
                $ed = strtotime('+1 year', $sd);
                break;
            case 'month':
                $ed = strtotime('+1 month', $sd);
                break;
            case 'week':
                $ed = strtotime('+1 week', $sd);
                break;
            case 'day':
                $ed = strtotime('+1 day', $sd);
                break;
        }

        // dial back $ed if it's beyond the user-specified end date
        // we go 1 day beyond specified end date because end date is exclusive in the query
        if ($ed > $this->ed_raw) {
            $ed = strtotime('+1 day', $this->ed_raw);
        }

        // define the timeframe array
        $this->timeframe[$id] = [];

        // store the start date and end date for this timeframe
        // timestamp format allows us to use whatever display format we want at output
        // we subtract 1 day so that the displayed end date is the actual end date
        $this->timeframe[$id]['sd'] = $sd;
        $this->timeframe[$id]['ed'] = strtotime('-1 day', $ed);

        // build the excluded products array - not really debugged well
        $this->product_filter = '';
        $exclude_products = unserialize(EXCLUDE_PRODUCTS);
        if (is_array($exclude_products) && count($exclude_products) > 0) {
            foreach ($exclude_products as $pID) {
                $this->product_filter .= " AND op.products_id != " . (int)$pID;
            }
        }

        if ($this->doProdInc === true && !empty($this->prod_includes)) {
            $this->product_filter .= " AND op.products_id IN ({$this->prod_includes})" . PHP_EOL;
        }

        if ($this->doCustInc === true && !empty($this->cust_includes)) {
            $this->customer_filter .= " AND o.customers_id IN ({$this->cust_includes})" . PHP_EOL;
        }

        // -----
        // Build conditionally-included fields for the SELECT statement.
        //
        $conditional_fields = '';
        if ($this->display_email_address === true) {
            $conditional_fields .= ', o.customers_email_address';
        }

        // build the SQL query of order numbers within the current timeframe
        $sql =
            'SELECT DISTINCT
                o.orders_id, o.currency, o.order_total, o.customers_id, o.customers_name, o.delivery_country, o.delivery_state,
                o.cc_type, o.payment_method, o.payment_module_code, o.shipping_method, o.shipping_module_code' . $conditional_fields .
             ' FROM ' . TABLE_ORDERS . ' o' . PHP_EOL;
        
        if ($this->manufacturer !== 0 || ($this->doProdInc && !empty($this->prod_includes))) {
            $sql .= ' LEFT JOIN ' . TABLE_ORDERS_PRODUCTS . ' op ON o.orders_id = op.orders_id' . PHP_EOL;
        }

        if ($this->manufacturer !== 0) {
            $sql .= ' LEFT JOIN ' . TABLE_PRODUCTS . ' p ON p.products_id = op.products_id' . PHP_EOL;
        }

        if ($this->date_target === 'status') {
            $sql .=
                'LEFT JOIN ' . TABLE_ORDERS_STATUS_HISTORY . ' osh ON o.orders_id = osh.orders_id' . PHP_EOL .
                "WHERE osh.date_added >= '" . date('Y-m-d H:i:s', $sd) . "' AND osh.date_added < '" . date('Y-m-d H:i:s', $ed) . "'" . PHP_EOL .
                "  AND osh.orders_status_id = {$this->date_status}" . PHP_EOL;
        } else {
            $sql .= " WHERE o.date_purchased >= '" . date('Y-m-d H:i:s', $sd) . "' AND o.date_purchased < '" . date('Y-m-d H:i:s', $ed) . "'" . PHP_EOL;
        }

        if ($this->manufacturer !== 0) {
            $sql .= "AND p.manufacturers_id = {$this->manufacturer}" . PHP_EOL;
        }

        if ($this->payment_method !== '0') {
            $sql .= "AND o.payment_module_code LIKE '{$this->payment_method}'" . PHP_EOL;
        }
        if ($this->payment_method_omit !== '0') {
            $sql .= "AND o.payment_module_code NOT LIKE '{$this->payment_method_omit}'" . PHP_EOL;
        }
        if ($this->current_status !== 0) {
            $sql .= "AND o.orders_status = {$this->current_status}" . PHP_EOL;
        }
        if ($this->excluded_status !== 0) {
            $sql .= "AND o.orders_status != {$this->excluded_status}" . PHP_EOL;
        }
        if ($this->product_filter !== '') {
            $sql .= $this->product_filter . PHP_EOL;
        }
        if ($this->customer_filter !== '') {
            $sql .= $this->customer_filter . PHP_EOL;
        }
        $sql .= " ORDER BY o.orders_id {$this->timeframe_sort}";

        // loop through query and build the arrays for this timeframe
        $sales = $db->Execute($sql);
        $grand_total = 0;

        // make sure we actually have orders to process
        if ($sales->RecordCount() > 0) {
            // initialize the various timeframe arrays
            // by creating them inside the RecordCount() check, we can easily
            // check for an empty timeframe with is_array() in the report
            $totals = $this->initializeTotals();
            $totals['diff_products'] = [];
            $this->timeframe[$id]['total'] = $totals;
            if ($this->detail_level === 'order') {
                $this->timeframe[$id]['orders'] = [];
            } elseif ($this->detail_level === 'product') {
                $this->timeframe[$id]['products'] = [];
            }
            foreach ($sales as $next_sale) {
                $grand_total += $this->build_li_totals($next_sale);
                if (empty($this->timeframe[$id]['orders'])) {
                    $this->timeframe[$id]['orders'] = false;
                }
                if (empty($this->timeframe[$id]['products'])) {
                    $this->timeframe[$id]['products'] = false;
                }
            }
            // calculate the total for the timeframe
            $this->timeframe[$id]['total']['grand'] = $grand_total;
            //_MATHCHECK compare this figure to total of individual orders/products
            // add values to the grand total line at the bottom of the report
            foreach (array_keys($this->grand_total) as $key) {
                $this->grand_total[$key] += $this->timeframe[$id]['total'][$key];
            }
        }
        // Since $sd is inclusive, but $ed is exclusive in our query, we need
        // only set next starting point to the current $ed
        $this->current_date = $ed;
        // increment the id number
        $this->timeframe_id++;
    }  // END function build_timeframe()
    
    protected function initializeTotals()
    {
        return [
            'goods' => 0,
            'num_orders' => 0,
            'num_products' => 0,
            'shipping' => 0,
            'goods_tax' => 0,
            'order_recorded_tax' => 0,
            'discount' => 0,
            'discount_qty' => 0,
            'gc_sold' => 0,
            'gc_sold_qty' => 0,
            'gc_used' => 0,
            'gc_used_qty' => 0,
            'grand' => 0,
        ];
    }

    //////////////////////////////////////////////////////////
    // build_li_totals() actually does the tallying for each
    // order found within the timeframe set and searched in
    // build_timeframe().  It calls build_li_orders() and
    // build_li_products() as needed.
    //
    protected function build_li_totals($next_sale)
    {
        global $db, $currencies;

        $id = $this->timeframe_id;

        // -----
        // Retrieve the information for the current order.
        //
        $oID = $next_sale['orders_id'];
        $sale_currency = $next_sale['currency'];
        $sale_currency_decimal_places = $currencies->currencies[$sale_currency]['decimal_places'] ?? 2;

        // if we have to filter on manufacturer, the SQL is totally different
        if ($this->manufacturer !== 0) {
            $products_sql = 
                "SELECT op.orders_products_id, op.products_id, op.products_price,
                        op.final_price, op.products_quantity, op.products_tax,
                        op.onetime_charges, op.products_model, op.products_name
                   FROM " . TABLE_ORDERS_PRODUCTS . " op
                        INNER JOIN " . TABLE_PRODUCTS . " p
                            ON p.products_id = op.products_id
                  WHERE p.manufacturers_id = {$this->manufacturer}
                    AND op.orders_id = $oID" . $this->product_filter;
        } else {
            $products_sql = 
                "SELECT op.orders_products_id, op.products_id, op.products_price,
                        op.final_price, op.products_quantity, op.products_tax,
                        op.onetime_charges, op.products_model, op.products_name
                   FROM " . TABLE_ORDERS_PRODUCTS . " op
                  WHERE op.orders_id = $oID" . $this->product_filter;
        }
        $products = $db->Execute($products_sql);

        // these "order_" variables are local to the build_li_totals() function.  They
        // are used to determine order total, timeframe grand total, and order count
        $order_goods = 0;
        $order_goods_tax = 0;
        $order_recorded_tax = 0;
        $order_shipping = 0;
        $order_discount = 0;
        $order_gc_sold = 0;
        $order_gc_used = 0;

        foreach ($products as $next_product) {
            // assign key values to shorter variables for clarity
            $pID = $next_product['products_id'];
            $final_price = $next_product['final_price'];
            $quantity = $next_product['products_quantity'];
            $tax = $next_product['products_tax'];
            $onetime_charges = $next_product['onetime_charges'];
            $model = zen_output_string_protected($next_product['products_model']);

            // do the math

            // gift certificates aren't products, so we must separate those out
            if (strpos($model, 'GIFT') === 0) {
                $order_gc_sold += ($final_price * $quantity);
                $this->timeframe[$id]['total']['gc_sold'] += ($final_price * $quantity);
                $this->build_li_orders($next_sale, 'gc_sold', $final_price * $quantity);

                $this->timeframe[$id]['total']['gc_sold_qty'] += $quantity;
                $this->build_li_orders($next_sale, 'gc_sold_qty', $quantity);

                $order_goods += $onetime_charges;
                $this->timeframe[$id]['total']['goods'] += $onetime_charges;
                $this->build_li_orders($next_sale, 'goods', $onetime_charges);
            } else {
                // Round up the final product price in same manner as order class - otherwise the amounts
                // from this report will most likely not agree with the actual final order values!
                $product_price = zen_round(($final_price * $quantity) + $onetime_charges, $sale_currency_decimal_places);
              
                // Get the amount of tax for this product
                $product_tax = zen_calculate_tax($onetime_charges, $tax);
                $product_tax += zen_calculate_tax($final_price * $quantity, $tax);
              
                $order_goods_tax += $product_tax;
              
                // Calculate the subtotal inc tax in the same way that the order class does
                $product_price_inc_tax = (zen_add_tax($final_price, $tax) * $quantity) + zen_add_tax($onetime_charges, $tax);
                $product_price_exc_tax = (DISPLAY_PRICE_WITH_TAX_ADMIN === 'true') ? ($product_price_inc_tax - $product_tax) : $product_price_inc_tax;
                $order_goods += $product_price_exc_tax;

                $this->timeframe[$id]['total']['goods'] += $product_price_exc_tax;
                $this->build_li_orders($next_sale, 'goods', $product_price_exc_tax);
 
                $this->timeframe[$id]['total']['goods_tax'] += $product_tax;
                $this->build_li_orders($next_sale, 'goods_tax', $product_tax );

                $this->timeframe[$id]['total']['num_products'] += $quantity;
                $this->build_li_orders($next_sale, 'num_products', $quantity);
            }

            // build product line items (if requested)
            $uprid = $pID;
            if ($this->detail_level === 'product' || $this->detail_level === 'matrix') {
                // build array of product info so the function already has what it needs, avoiding another query
                $product_tax = zen_calculate_tax($onetime_charges, $tax) + zen_calculate_tax($final_price * $quantity, $tax);
                // get product's attributes to display under product name
                $products_name_with_attributes = $next_product['products_name'] . '<br>';
                $products_attributes = [];
                $products_attributes_display = '';
                $attributes_select = $db->Execute(
                    "SELECT products_options_id, products_options_values_id, products_options, products_options_values
                       FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "
                      WHERE orders_id = $oID
                        AND orders_products_id = {$next_product['orders_products_id']}"
                );
                foreach ($attributes_select as $next_attribute) {
                    $products_attributes_display .= '<small> - ' . $next_attribute['products_options'] . ': ' . $next_attribute['products_options_values'] . '</small><br>';
                    $products_attributes[$next_attribute['products_options_id']] = $next_attribute['products_options_values_id'];
                }

                // unique id for product with attributes
                $uprid = zen_get_uprid($pID, $products_attributes);

                $this_product = [
                    'id' => $pID,
                    'uprid' => $uprid,
                    'name' => $products_name_with_attributes,
                    'attributes' => $products_attributes_display,
                    'model' => $model,
                    'base_price' => $next_product['products_price'],
                    'final_price' => $final_price,
                    'quantity' => $quantity,
                    'tax' => $product_tax,
                    'onetime_charges' => $onetime_charges,
                    'total' => ($final_price * $quantity) + $onetime_charges
                ];
                $this->build_li_products($this_product);
            }

            // check to see if product is unique in this timeframe
            // add to 'diff_products' array if so
            if (!in_array($uprid, $this->timeframe[$id]['total']['diff_products'])) {
                $this->timeframe[$id]['total']['diff_products'][] = $uprid;
            }

            if (empty($this->timeframe[$id]['orders'][$oID]['diff_products']) || !in_array($uprid, $this->timeframe[$id]['orders'][$oID]['diff_products'])) {
                $this->timeframe[$id]['orders'][$oID]['diff_products'][] = $uprid;
            }
        }

        // -----
        // If the class arrays that contain the discount/surcharge order-totals haven't yet
        // been created, create them now.
        //
        if (!isset($this->order_total_discounts)) {
            $this->order_total_discounts = [
                'ot_coupon',
                'ot_group_pricing',
                'ot_better_together',
                'ot_big_chooser',
                'ot_bigspender_discount',
                'ot_bogo_discount',
                'ot_case_discounts',
                'ot_combination_discounts',
                'ot_freegift_chooser',
                'ot_freegift_spender',
                'ot_frequency_discount',
                'ot_giftwrap_checkout',
                'ot_manufacturer_discount',
                'ot_military_discount',
                'ot_newsletter_discount',
                'ot_quantity_discount',
                'ot_table_discounts',
                'ot_rewards',
                'ot_cashback',
            ];
            if (isset($GLOBALS['stats_sales_reports_discounts'])) {
                $this->order_total_discounts = array_merge($this->order_total_discounts, $GLOBALS['stats_sales_reports_discounts']);
            }

            $this->order_total_surcharges = [
                'ot_roundup',
                'ot_cod_fee',
                'ot_loworderfee',
            ];
            if (isset($GLOBALS['stats_sales_reports_surcharges'])) {
                $this->order_total_surcharges = array_merge($this->order_total_surcharges, $GLOBALS['stats_sales_reports_surcharges']);
            }
        }

        // pull shipping, discounts, tax, and gift certificates used from orders_total table
        $totals = $db->Execute(
            "SELECT `class`, `value`
               FROM " . TABLE_ORDERS_TOTAL . "
              WHERE orders_id = $oID"
        );
        foreach ($totals as $next_total) {
            $class = $next_total['class'];
            $value = $next_total['value'];
            switch ($class) {
                case 'ot_total':
                case 'ot_subtotal':
                    break;

                case 'ot_gv':
                    $order_gc_used += $value;
                    $this->timeframe[$id]['total']['gc_used'] += $value;
                    $this->build_li_orders($next_sale, 'gc_used', $value);

                    $this->timeframe[$id]['total']['gc_used_qty']++;
                    $this->build_li_orders($next_sale, 'gc_used_qty', 1);
                    break;

                case 'ot_tax':
                    $order_recorded_tax += $value;
                    $this->timeframe[$id]['total']['order_recorded_tax'] += $value;
                    $this->build_li_orders($next_sale, 'order_recorded_tax', $value);
                    break;

                case 'ot_shipping':
                    $order_shipping += $value;
                    $this->timeframe[$id]['total']['shipping'] += $value;
                    $this->build_li_orders($next_sale, 'shipping', $value);
                    break;

                default:
                    if (in_array($class, $this->order_total_discounts)) {
                        $order_discount += $value;
                        $this->timeframe[$id]['total']['discount'] += $value;
                        $this->build_li_orders($next_sale, 'discount', $value);
                        $this->timeframe[$id]['total']['discount_qty']++;
                        $this->build_li_orders($next_sale, 'discount_qty', 1);
                        break;
                    }
                    if (in_array($class, $this->order_total_surcharges)) {
                        $order_discount -= $value;
                        $this->timeframe[$id]['total']['discount'] -= $value;
                        $this->build_li_orders($next_sale, 'discount', $value);
                        $this->timeframe[$id]['total']['discount_qty']++;
                        $this->build_li_orders($next_sale, 'discount_qty', 1);
                        break;
                    }
                    if ($value < 0) {
                        // this allows for a custom discount, a la Super Orders
                        $order_discount += abs($value);
                        $this->timeframe[$id]['total']['discount'] += abs($value);
                        $this->build_li_orders($next_sale, 'discount', abs($value) );
                        $this->timeframe[$id]['total']['discount_qty']++;
                        $this->build_li_orders($next_sale, 'discount_qty', 1);
                    }
                    break;
            }
        }

        // we want to count an order if it has a value in any category
        $order_values = ($order_goods + $order_goods_tax + $order_shipping + $order_gc_sold + $order_discount + $order_gc_used);
        if ($order_values == 0) {
            $order_total = 0;
            $this->build_li_orders($next_sale, 'has_no_value', true);
        } else {
            $this->timeframe[$id]['total']['num_orders']++;
            $this->build_li_orders($next_sale, 'has_no_value', false);

            // add up stored values for order grand total
            // (goods + tax + shipping + gc_sold) - (discount + gc_used)
            // line 557 may produce wrong totals for most European store configurations so we better use the line 558 below - if 557 works better for you than 558 change it
            // $order_total = ($order_goods + $order_recorded_tax + $order_shipping + $order_gc_sold) - ($order_discount + $order_gc_used);
            $order_total = ($order_goods + $order_goods_tax + $order_shipping + $order_gc_sold) - ($order_discount + $order_gc_used);

            if ($this->detail_level === 'order' || $this->detail_level === 'matrix') {
                $this->build_li_orders($next_sale, 'grand', $order_total);
          
                // Build order total verification column if requested
                if ($this->order_total_validation === true) {
                    // Get the recorded order total
                    $recorded_order_total = number_format((float)$next_sale['order_total'], $sale_currency_decimal_places);

                    if (number_format((float)$order_total, $sale_currency_decimal_places) !== $recorded_order_total) {
                        $order_total_validation = "DON'T MATCH!<br>$order_total : $recorded_order_total";
                    } else {
                        $order_total_validation = 'VALID';
                    }
                    $this->build_li_orders($next_sale, 'order_total_validation', $order_total_validation);
                } 
            }
        }
        return $order_total;
    }  // END function build_li_totals($oID)


    //////////////////////////////////////////////////////////
    // build_li_orders() is called each time a value is added
    // to the 'total' array.  If the customer wishes to
    // display order line items, the value is added to the
    // corresponding 'orders' array.
    //
    protected function build_li_orders($next_sale, $field, $value)
    {
        // first check to see if we even need to do anything
        if ($this->detail_level === 'order' || $this->detail_level === 'matrix') {
            $id = $this->timeframe_id;
            $oID = $next_sale['orders_id'];

            // create the array if it doesn't already exist
            if (!isset($this->timeframe[$id]['orders'][$oID]) ) {
                $this->timeframe[$id]['orders'][$oID] = [
                    'oID' => $oID,
                    // the $oID key will be reset when we sort the array at
                    // display, so we store it as a part of the array as well
                    'goods' => 0,
                    'num_products' => 0,
                    'diff_products' => [],
                    'shipping' => 0,
                    'goods_tax' => 0,
                    'order_recorded_tax' => 0,
                    'discount' => 0,
                    'discount_qty' => 0,
                    'gc_sold' => 0,
                    'gc_sold_qty' => 0,
                    'gc_used' => 0,
                    'gc_used_qty' => 0,
                    'grand' => 0,
                    'order_total_validation' => '',
                    'has_no_value' => 0
                ];

                // -----
                // Get the customer's name from the **order**, recognizing that the order has
                // appended the customer's last name(s) to their first name(s), so the 'unsplitting'
                // won't work for some customers' names, but will work for the majority.
                //
                $this->timeframe[$id]['orders'][$oID]['customers_id'] = $next_sale['customers_id'];

                $pieces = explode(' ', $next_sale['customers_name']);
                $firstname = array_shift($pieces);
                $this->timeframe[$id]['orders'][$oID]['first_name'] = zen_output_string_protected($firstname);
                $this->timeframe[$id]['orders'][$oID]['last_name'] = zen_output_string_protected(implode(' ', $pieces));
                $this->timeframe[$id]['orders'][$oID]['email'] = $next_sale['customers_email_address'] ?? '';
                $this->timeframe[$id]['orders'][$oID]['country'] = $next_sale['delivery_country'];
                $this->timeframe[$id]['orders'][$oID]['state'] = $next_sale['delivery_state'];

                // -----
                // Initialize the remaining elements of this order from the information
                // pulled from the database.
                //
                $this->timeframe[$id]['orders'][$oID]['currency'] = $next_sale['currency'];
                $this->timeframe[$id]['orders'][$oID]['cc_type'] = $next_sale['cc_type'];
                $this->timeframe[$id]['orders'][$oID]['payment_method'] = $next_sale['payment_method'];
                $this->timeframe[$id]['orders'][$oID]['payment_module_code'] = $next_sale['payment_module_code'];
                $this->timeframe[$id]['orders'][$oID]['shipping_method'] = $next_sale['shipping_method'];
                $this->timeframe[$id]['orders'][$oID]['shipping_module_code'] = $next_sale['shipping_module_code'];
            }

            // add the passed $value to the passed $field in the ['orders'] array
            if ($field !== 'order_total_validation') {
                $this->timeframe[$id]['orders'][$oID][$field] += $value;
            } else {
                $this->timeframe[$id]['orders'][$oID][$field] = $value;
            }
        }
    }

    //////////////////////////////////////////////////////////
    // Since product line items don't need to look at the
    // orders_total table, we can just call build_li_products
    // once and build/increment the product array per product
    // (i.e. products are already line items, orders are not).
    //
    protected function build_li_products($product)
    {
        $id = $this->timeframe_id;
        $pID = $product['uprid'];

        // initialize the array for this products_id if it doesn't exist yet
        if (!isset($this->timeframe[$id]['products'][$pID]) ) {
            $this->timeframe[$id]['products'][$pID] = [
                'pID' => $product['id'],
                'name' => $product['name'],
                'attributes' => $product['attributes'],
                'model' => $product['model'],
                'manufacturer' => '',
                'base_price' => $product['base_price'],
                'final_price' => $product['final_price'],
                'quantity' => $product['quantity'],
                'onetime_charges' => $product['onetime_charges'],
                'total' => $product['total'], // 'total' = ( ($final_price * $quantity) + $onetime_charges ) )
                'tax' => $product['tax'],
                'grand' => $product['total'] + $product['tax']
            ];

            // get the manufacturers_id from `products` table
            if (DISPLAY_MANUFACTURER) {
                $manufacturer_name = zen_get_products_manufacturers_name($pID);
                if ($manufacturer_name === '') {
                    $manufacturer_name = TEXT_NONE;
                }
                $this->timeframe[$id]['products'][$pID]['manufacturer'] = $manufacturer_name;
            }
        } else {
            // or add the values of ordered product to existing 'products' array
            // note that the informational fields are only defined once (i.e. the SQL sort order matters!)
            $this->timeframe[$id]['products'][$pID]['quantity'] += $product['quantity'];
            $this->timeframe[$id]['products'][$pID]['onetime_charges'] += $product['onetime_charges'];
            $this->timeframe[$id]['products'][$pID]['total'] += $product['total'];
            $this->timeframe[$id]['products'][$pID]['tax'] += $product['tax'];
            $this->timeframe[$id]['products'][$pID]['grand'] += $product['total'] + $product['tax'];
        }

    }  // END function build_li_products($product)

    //////////////////////////////////////////////////////////
    // Building the data matrix requires data from both the
    // order and product level, so we build both arrays when
    // creating a data matrix.  This saves us from having to
    // run several queries and makes the adding the matrix
    // report a snap, since we can just tack it on after
    // building all the data arrays!
    //
    protected function build_matrix()
    {
        for ($i = 0, $n = count($this->timeframe); $i < $n; $i++) {
            // skip the current timeframe if there isn't any data
            if (!isset($this->timeframe[$i]['orders']) || !isset($this->timeframe[$i]['products'])) {
                continue;
            }

            $this->timeframe[$i]['matrix'] = [
                'diff_customers' => [],
                'payment_methods' => [],
                'shipping_methods' => [],
                'credit_cards' => [],
                'currencies' => [],
                'biggest_per_revenue' => 0,
                'biggest_per_products' => 0,
                'smallest_per_revenue' => 0,
                'smallest_per_products' => 0,
                'avg_order_value' => 0,
                'avg_products_per_order' => 0,
                'avg_diff_products_per_order' => 0,
                'avg_orders_per_customer' => 0,
                'product_spread' => [],
                'product_revenue_ratio' => [],
                'product_quantity_ratio' => [],
            ];

            // gather statistics from orders array
            foreach ($this->timeframe[$i]['orders'] as $oID => $o_data) {
                // place pertinent data in short variables
                $cc_type = $o_data['cc_type'];
                $payment_method = $o_data['payment_method'];
                $payment_module_code = $o_data['payment_module_code'];
                $shipping_method = $o_data['shipping_method'];
                $shipping_module_code = $o_data['shipping_module_code'];
                $currency = $o_data['currency'];

                // Format shipping method to remove the data in parentheses
                $shipping_method = explode(' (', $shipping_method, 2);
                $shipping_method = rtrim($shipping_method[0], ':');

                // Number of unique customers
                $cID = $o_data['customers_id'];
                $new_customer = true;
                foreach ($this->timeframe[$i]['matrix']['diff_customers'] as $this_cID => $c_data) {
                    if ($cID === $this_cID) {
                        $this->timeframe[$i]['matrix']['diff_customers'][$this_cID]['num_orders']++;
                        $new_customer = false;
                        break;
                    }
                }
                if ($new_customer === true) {
                    $this->timeframe[$i]['matrix']['diff_customers'][$cID] = [
                        'first_name' => $o_data['first_name'],
                        'last_name' => $o_data['last_name'],
                        'num_orders' => 1
                    ];
                }

                // Payment methods used, with count
                $new_payment_method = true;
                foreach ($this->timeframe[$i]['matrix']['payment_methods'] as $key => $value) {
                    if ($this->timeframe[$i]['matrix']['payment_methods'][$key]['module_code'] === $payment_module_code) {
                        $this->timeframe[$i]['matrix']['payment_methods'][$key]['count']++;
                        $new_payment_method = false;
                        break;
                    }
                }
                if ($new_payment_method === true) {
                    $this->timeframe[$i]['matrix']['payment_methods'][] = [
                        'method' => $payment_method,
                        'module_code' => $payment_module_code,
                        'count' => 1
                    ];
                }

                // Shipping methods used, with count
                $new_shipping_method = true;
                foreach ($this->timeframe[$i]['matrix']['shipping_methods'] as $key => $value) {
                    if ($this->timeframe[$i]['matrix']['shipping_methods'][$key]['module_code'] === $shipping_module_code) {
                        $this->timeframe[$i]['matrix']['shipping_methods'][$key]['count']++;
                        $new_shipping_method = false;
                        break;
                    }
                }
                if ($new_shipping_method === true) {
                    $this->timeframe[$i]['matrix']['shipping_methods'][] = [
                        'method' => $shipping_method,
                        'module_code' => $shipping_module_code,
                        'count' => 1
                    ];
                }

                // Credit cards used, with count
                $new_credit_card = true;
                foreach ($this->timeframe[$i]['matrix']['credit_cards'] as $key => $value) {
                    if ($this->timeframe[$i]['matrix']['credit_cards'][$key]['type'] === $cc_type) {
                        $this->timeframe[$i]['matrix']['credit_cards'][$key]['count']++;
                        $new_credit_card = false;
                        break;
                    }
                }
                if ($new_credit_card === true && $cc_type !== '') {
                    $this->timeframe[$i]['matrix']['credit_cards'][] = [
                        'type' => $cc_type,
                        'count' => 1
                    ];
                }

                // Currencies used, with count
                // eliminate display on report with "if (sizeof($timeframe['matrix']['currencies']) > 1)"
                $new_currency = true;
                foreach ($this->timeframe[$i]['matrix']['currencies'] as $key => $value) {
                    if ($this->timeframe[$i]['matrix']['currencies'][$key]['type'] === $currency) {
                        $this->timeframe[$i]['matrix']['currencies'][$key]['count']++;
                        $new_currency = false;
                        break;
                    }
                }
                if ($new_currency === true) {
                    $this->timeframe[$i]['matrix']['currencies'][] = [
                        'type' => $currency,
                        'count' => 1
                    ];
                }

                // Biggest order by revenue (display order # and customer name)
                if (empty($this->timeframe[$i]['matrix']['biggest_per_revenue'])) {
                    $this->timeframe[$i]['matrix']['biggest_per_revenue'] = $oID;
                } else {
                    $current_leader = $this->timeframe[$i]['orders'][$this->timeframe[$i]['matrix']['biggest_per_revenue']];
                    if ($o_data['goods'] > $current_leader['goods']) {
                        $this->timeframe[$i]['matrix']['biggest_per_revenue'] = $oID;
                    }
                }

                // Smallest order by revenue (display order # and customer name)
                if (empty($this->timeframe[$i]['matrix']['smallest_per_revenue'])) {
                    $this->timeframe[$i]['matrix']['smallest_per_revenue'] = $oID;
                } else {
                    $current_leader = $this->timeframe[$i]['orders'][$this->timeframe[$i]['matrix']['smallest_per_revenue']];
                    if ($o_data['goods'] < $current_leader['goods']) {
                        $this->timeframe[$i]['matrix']['smallest_per_revenue'] = $oID;
                    }
                }

                // Biggest order by product count (display order # and customer name)
                if (empty($this->timeframe[$i]['matrix']['biggest_per_product'])) {
                    $this->timeframe[$i]['matrix']['biggest_per_product'] = $oID;
                } else {
                    $current_leader = $this->timeframe[$i]['orders'][$this->timeframe[$i]['matrix']['biggest_per_product']];
                    if ($o_data['num_products'] > $current_leader['num_products']) {
                        $this->timeframe[$i]['matrix']['biggest_per_product'] = $oID;
                    }
                }

                // Smallest order by product count (display order # and customer name)
                if (empty($this->timeframe[$i]['matrix']['smallest_per_product'])) {
                    $this->timeframe[$i]['matrix']['smallest_per_product'] = $oID;
                } else {
                    $current_leader = $this->timeframe[$i]['orders'][$this->timeframe[$i]['matrix']['smallest_per_product']];
                    if ($o_data['num_products'] < $current_leader['num_products']) {
                        $this->timeframe[$i]['matrix']['smallest_per_product'] = $oID;
                    }
                }
            }  // END foreach($this->timeframe[$i]['orders'] as $oID => $o_data)

            $orders_in_timeframe = count($this->timeframe[$i]['orders']);

            // Avg order value
            $this->timeframe[$i]['matrix']['avg_order_value'] =
                $this->timeframe[$i]['total']['grand'] / $orders_in_timeframe;

            // Avg number of products in an order
            $this->timeframe[$i]['matrix']['avg_products_per_order'] =
                $this->timeframe[$i]['total']['num_products'] / $orders_in_timeframe;

            // Avg number of unique products in an order
            $this->timeframe[$i]['matrix']['avg_diff_products_per_order'] =
                count($this->timeframe[$i]['total']['diff_products']) / $orders_in_timeframe;

            // Avg # orders per unique customer
            $this->timeframe[$i]['matrix']['avg_orders_per_customer'] =
                count($this->timeframe[$i]['orders']) / count($this->timeframe[$i]['matrix']['diff_customers']);

            // gather statistics from products array
            foreach ($this->timeframe[$i]['products'] as $pID => $p_data) {
                // Per product "spread" (number of orders that a product is a part of)
                foreach ($this->timeframe[$i]['orders'] as $oID => $o_data) {
                    foreach ($o_data['diff_products'] as $ordered_pID) {
                        if ($pID == $ordered_pID) {
                            if (!isset($this->timeframe[$i]['matrix']['product_spread'][$pID])) {
                                $this->timeframe[$i]['matrix']['product_spread'][$pID] = 0;
                            }
                            $this->timeframe[$i]['matrix']['product_spread'][$pID]++;
                            break;
                        }
                    }
                }

                // percentage of all revenue by product BEFORE shipping, tax, discounts, and gc's
                $this->timeframe[$i]['matrix']['product_revenue_ratio'][$pID] =
                    number_format($p_data['total'] / $this->timeframe[$i]['total']['goods'] * 100, 3);

                // percentage of all quantity by product
                $this->timeframe[$i]['matrix']['product_quantity_ratio'][$pID] =
                    number_format($p_data['quantity'] / $this->timeframe[$i]['total']['num_products'] * 100, 3);
            }  // END gathering statistics/product for timeframe
        }  // END gathering statistics for current timeframe
    }  // END function build_matrix()

    //////////////////////////////////////////////////////////
    // This function actually creates the CSV file when CSV
    // output is requested.  The logic and looping structure
    // is nearly identical to that found in the HTML output,
    // but we separate it out for the sake of code clarity and
    // to allow for some differences between the 2 outputs.
    //
    public function output_csv($csv_header)
    {
        $filename = CSV_FILENAME_PREFIX . date('Ymd', $this->sd_raw) . '-' . date('Ymd', $this->ed_raw);
        if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) {
            header('Content-Type: application/octetstream');
            header('Content-Disposition: attachment; filename=' . $filename . '.csv');
            header('Expires: Mon, 26 Jul 2001 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: must_revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Cache-control: private');
        } else {
            header('Content-Type: application/x-octet-stream');
            header('Content-Disposition: attachment; filename=' . $filename . '.csv');
            header('Expires: Mon, 26 Jul 2001 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Pragma: no-cache');
        }

        $display_tax = ($this->grand_total['goods_tax'] > 0);

        if ($csv_header) {
            switch ($this->detail_level) {
                case 'timeframe':
                    $line = [
                        CSV_HEADING_START_DATE,
                        CSV_HEADING_END_DATE,
                        TABLE_HEADING_NUM_ORDERS,
                        TABLE_HEADING_NUM_PRODUCTS,
                        TABLE_HEADING_TOTAL_GOODS
                    ];
                    if ($display_tax === true) {
                        $line[] = TABLE_HEADING_TAX;
                        $line[] = TABLE_HEADING_ORDER_RECORDED_TAX;
                    }
                    $line[] = TABLE_HEADING_SHIPPING;
                    $line[] = TABLE_HEADING_DISCOUNTS;
                    $line[] = TABLE_HEADING_GC_SOLD;
                    $line[] = TABLE_HEADING_GC_USED;
                    $line[] = TABLE_HEADING_TOTAL;
                    break;
                case 'product':
                    $line = [
                        CSV_HEADING_START_DATE,
                        CSV_HEADING_END_DATE,
                        TABLE_HEADING_PRODUCT_ID,
                        TABLE_HEADING_PRODUCT_NAME,
                        TABLE_HEADING_PRODUCT_ATTRIBUTES
                    ];
                    if (DISPLAY_MANUFACTURER) {
                        $line[] = TABLE_HEADING_MANUFACTURER;
                    }
                    $line[] = TABLE_HEADING_MODEL_NO;
                    $line[] = TABLE_HEADING_BASE_PRICE;
                    $line[] = TABLE_HEADING_FINAL_PRICE;
                    $line[] = TABLE_HEADING_QUANTITY;
                    if ($display_tax === true) {
                        $line[] = TABLE_HEADING_TAX;
                    }
                    if (DISPLAY_ONE_TIME_FEES) {
                        $line[] = TABLE_HEADING_ONETIME_CHARGES;
                    }
                    if ($display_tax === true) {
                        $line[] = TABLE_HEADING_TOTAL;
                    }
                    $line[] = TABLE_HEADING_PRODUCT_TOTAL;
                    break;
                default:
                    $line = [
                        CSV_HEADING_START_DATE,
                        CSV_HEADING_END_DATE,
                        TABLE_HEADING_ORDERS_ID,
                        CSV_HEADING_LAST_NAME,
                        CSV_HEADING_FIRST_NAME,
                    ];
                    if ($this->display_email_address === true) {
                        $line[] = TABLE_HEADING_EMAIL_ADDRESS;
                    }
                    $line[] = CSV_HEADING_COUNTRY;
                    $line[] = CSV_HEADING_STATE;
                    $line[] = TABLE_HEADING_NUM_PRODUCTS;
                    $line[] = TABLE_HEADING_TOTAL_GOODS;

                    if ($display_tax === true) {
                        $line[] = TABLE_HEADING_TAX;
                        $line[] = TABLE_HEADING_ORDER_RECORDED_TAX;
                    }
                    $line[] = TABLE_HEADING_SHIPPING;
                    $line[] = TABLE_HEADING_DISCOUNTS;
                    $line[] = TABLE_HEADING_GC_SOLD;
                    $line[] = TABLE_HEADING_GC_USED;
                    $line[] = TABLE_HEADING_ORDER_TOTAL;
                    break;
            }
            $this->outputCsvLine($line);
        }  // END if ($csv_header)

        $same_sorts = ($this->li_sort_a === $this->li_sort_b);
        foreach ($this->timeframe as $id => $timeframe) {
            // format the dates
            switch ($this->timeframe_group) {
                case 'day':
                    $start_date = date(TIME_DISPLAY_DAY, $timeframe['sd']);
                    $end_date = date(TIME_DISPLAY_DAY, $timeframe['ed']);
                    break;
                case 'week':
                    $start_date = date(TIME_DISPLAY_WEEK, $timeframe['sd']);
                    $end_date = date(TIME_DISPLAY_WEEK, $timeframe['ed']);
                    break;
                case 'month':
                    $start_date = date(TIME_DISPLAY_MONTH, $timeframe['sd']);
                    $end_date = date(TIME_DISPLAY_MONTH, $timeframe['ed']);
                    break;
                case 'year':
                    $start_date = date(TIME_DISPLAY_YEAR, $timeframe['sd']);
                    $end_date = date(TIME_DISPLAY_YEAR, $timeframe['ed']);
                    break;
            }
            switch ($this->detail_level) {
                case 'timeframe':
                    $line = [
                        $start_date,
                        $end_date,
                        $timeframe['total']['num_orders'],
                        $timeframe['total']['num_products'],
                        $timeframe['total']['goods']
                    ];
                    if ($display_tax === true) {
                        $line[] = $timeframe['total']['goods_tax'];
                        $line[] = $timeframe['total']['order_recorded_tax'];
                    }
                    $line[] = $timeframe['total']['shipping'];
                    $line[] = $timeframe['total']['discount'];
                    $line[] = $timeframe['total']['gc_sold'];
                    $line[] = $timeframe['total']['gc_used'];
                    $line[] = $timeframe['total']['grand'];
                    
                    $this->outputCsvLine($line);
                    break;

                case 'product':
                    // -----
                    // Depending on the filter choices selected, there might not be products purchased
                    // within a given timeframe.
                    //
                    if (empty($timeframe['products'])) {
                        break;
                    }
                    
                    // sort the products according to requested sort options
                    $dataset1 = [];
                    $dataset2 = [];
                    foreach ($timeframe['products'] as $pID => $p_data) {
                        $dataset1[$pID] = $p_data[$this->li_sort_a];
                        if ($same_sorts === false) {
                            $dataset2[$pID] = $p_data[$this->li_sort_b];
                        }
                    }

                    $sort1 = ($this->li_sort_order_a === 'asc') ? SORT_ASC : SORT_DESC;
                    $sort2 = ($this->li_sort_order_b === 'asc') ? SORT_ASC : SORT_DESC;
                    if ($same_sorts === true) {
                        array_multisort($dataset1, $sort1, $timeframe['products']);
                    } else {
                        array_multisort($dataset1, $sort1, $dataset2, $sort2, $timeframe['products']);
                    }

                    foreach ($timeframe['products'] as $key => $p_data) {
                        $line = [
                            $start_date,
                            $end_date,
                            $p_data['pID'],
                            str_replace(['<small>', '</small>', '<br>', '<br />'], '', $p_data['name']),
                            str_replace(['<small>', '</small>', '<br>', '<br />'], '', $p_data['attributes']),
                        ];
                        if (DISPLAY_MANUFACTURER) {
                            $line[] = $p_data['manufacturer'];
                        }
                        $line[] = $p_data['model'];
                        $line[] = $p_data['base_price'];
                        $line[] = $p_data['final_price'];
                        $line[] = $p_data['quantity'];
                        if ($display_tax === true) {
                            $line[] = $p_data['tax'];
                        }
                        if (DISPLAY_ONE_TIME_FEES) {
                            $line[] = $p_data['onetime_charges'];
                        }
                        if ($display_tax === true) {
                            $line[] = $p_data['total'];
                        }
                        $line[] = $p_data['grand'];

                        $this->outputCsvLine($line);
                    }
                    break;

                default:
                    if (empty($timeframe['orders'])) {
                        break;
                    }

                    $dataset1 = [];
                    $dataset2 = [];
                    foreach ($timeframe['orders'] as $oID => $o_data) {
                        $dataset1[$oID] = $o_data[$this->li_sort_a];
                        if (!$same_sorts) {
                            $dataset2[$oID] = $o_data[$this->li_sort_b];
                        }
                    }

                    $sort1 = ($this->li_sort_order_a === 'asc') ? SORT_ASC : SORT_DESC;
                    $sort2 = ($this->li_sort_order_b === 'asc') ? SORT_ASC : SORT_DESC;
                    if ($same_sorts) {
                        array_multisort($dataset1, $sort1, $timeframe['orders']);
                    } else {
                        array_multisort($dataset1, $sort1, $dataset2, $sort2, $timeframe['orders']);
                    }

                    foreach ($timeframe['orders'] as $key => $o_data) {
                        // skip order if it has no value
                        if ($o_data['has_no_value']) {
                            continue;
                        }

                        $line = [
                            $start_date,
                            $end_date,
                            $o_data['oID'],
                            $o_data['last_name'],
                            $o_data['first_name'],
                        ];
                        if ($this->display_email_address === true) {
                            $line[] = $o_data['email'];
                        }
                        $line[] = $o_data['country'];
                        $line[] = $o_data['state'];
                        $line[] = $o_data['num_products'];
                        $line[] = $o_data['goods'];

                        if ($display_tax) {
                            $line[] = $o_data['goods_tax'];
                            $line[] = $o_data['order_recorded_tax'];
                        }
                        $line[] = $o_data['shipping'];
                        $line[] = $o_data['discount'];
                        $line[] = $o_data['gc_sold'];
                        $line[] = $o_data['gc_used'];
                        $line[] = $o_data['grand'];

                        $this->outputCsvLine($line);
                    }
                    break;
            }  //END switch ($this->detail_level)
        }  // END foreach ($this->timeframe as $id => $timeframe)
        session_write_close();
        exit();
    }  // END function output_csv()

    protected function outputCsvLine($line)
    {
        echo implode(CSV_SEPARATOR, $line) . CSV_NEWLINE;
    }
}
