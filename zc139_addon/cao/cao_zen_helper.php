<?php
/**
 *
 * @package admin tools
 * @copyright Copyright 2005-2010 langheiter og
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author rainer AT langheiter DOT com  http://edv.langheiter.com
 * @version $Id$
 */


class cao {
    public $version_nr;
    public $version_datum;
    public $debug_types;
    public $sizes;
    public $action;
    public $userfieldMapping;
    private $db;
    function __construct() {
        global $db;
        require ('cao_config.php');
        $this->db = $db;
        $this->action = NULL;
        $this->version_nr = $version_nr;
        $this->version_datum = $version_datum;
        $this->debug_types = $debug_types;
        $this->sizes = $sizes;
        $this->userfieldMapping = $userfieldMapping;
        set_time_limit(0);
    }
    function SendXMLHeader() {
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // immer geändert
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache"); // HTTP/1.0
        header("Content-type: text/xml");
    }
    function xmlStatus($code = "0", $msg = "OK", $mode = "UPDATE", $param = "") {
        $status = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n";
        $status.= "<STATUS>\n";
        $status.= "<STATUS_DATA>\n";
        $status.= '<ACTION>' . $this->action . "</ACTION>\n";
        $status.= '<CODE>' . $code . '</CODE>' . "\n";
        $status.= '<MESSAGE>' . 'OK' . '</MESSAGE>' . "\n";
        $status.= '<MODE>' . $mode . '</MODE>' . "\n";
        //$status .= '<MANUFACTURERS_ID>' . $mID . '</MANUFACTURERS_ID>' . "\n";
        $status.= $param . "\n";
        $status.= '</STATUS_DATA>' . "\n";
        $status.= '</STATUS>' . "\n\n";
        return $status;
    }
    function writeXML($somecontent, $dtype = 'all', $filename = "./temp/debug.txt") {
        if ($dtype == 'all' || $this->debug_types[$dtype] == 1) {
            $somecontent = date('Y-m-d h:i:s') . ' - ' . strtoupper($dtype) . ':: ' . $somecontent . "\n";
            // Sichergehen, dass die Datei existiert und beschreibbar ist
            if (is_writable($filename)) {
                if (!$handle = fopen($filename, "a+")) {
                    print "Kann die Datei $filename nicht öffnen";
                    exit;
                }
                // Schreibe $somecontent in die geöffnete Datei.
                if (!fwrite($handle, $somecontent)) {
                    print "Kann in die Datei $filename nicht schreiben";
                    exit;
                }
                fclose($handle);
            } else {
                print "Die Datei $filename ist nicht schreibbar";
            }
        }
    }
    
    function caoLogin() {
        global $db;
        $loginOK = false;
        $admin_name = zen_db_prepare_input($_GET['user']);
        $admin_pass = zen_db_prepare_input($_GET['password']);
        $sql = "select admin_id, admin_name, admin_pass from " . TABLE_ADMIN . " where admin_name = '" . zen_db_input($admin_name) . "'";
        $result = $db->Execute($sql);
        if (!($admin_name == $result->fields['admin_name'])) {
            $message = true;
            $pass_message = ERROR_WRONG_LOGIN;
            writeXML('LOGIN_2', 'logon');
        }
        if ($admin_pass != $result->fields['admin_pass']) {
            $message = true;
            $pass_message = ERROR_WRONG_LOGIN;
            writeXML('LOGIN_3', 'logon');
        }
        if ($message == false) {
            $loginOK = true;
        }
        return $loginOK;
    }    
    function getDefaultLanguageID($db) {
        $sql = "SELECT * FROM " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_LANGUAGE'";
        $res = $db->Execute($sql);
        $sql = "SELECT * FROM " . TABLE_LANGUAGES . " WHERE code='" . $res->fields['configuration_value'] . "'";
        $res2 = $db->Execute($sql);
        return $res2->fields['languages_id'];
    }
    function zen_get_languages() {
        global $db;
        $sql = "SELECT languages_id FROM " . TABLE_LANGUAGES;
        $res = $db->Execute($sql);
        while (!$res->EOF) {
            $ret[] = $res->fields;
            $res->MoveNext();
        }
        return $ret;
    }
    
    function SendScriptVersion() {
        $this->SendXMLHeader();
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<STATUS>' . "\n" . '<STATUS_DATA>' . "\n" . '<ACTION>' . $_GET['action'] . '</ACTION>' . "\n" . '<CODE>' . '111' . '</CODE>' . "\n" . '<SCRIPT_VER>' . $this->version_nr . '</SCRIPT_VER>' . "\n" . '<SCRIPT_DATE>' . $this->version_datum . '</SCRIPT_DATE>' . "\n" . '</STATUS_DATA>' . "\n" . '</STATUS>' . "\n\n";
        echo $schema;
        // $this->writeXML($schema, __FUNCTION__);
        $this->writeXML(__FUNCTION__, __FUNCTION__);
    }
    function SendProducts() {
        $this->SendXMLHeader();
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<PRODUCTS>' . "\n";
        $sql = "select products_id, products_quantity, products_model, products_image, products_price, " . "products_date_added, products_last_modified, products_date_available, products_weight, " . "products_status, products_tax_class_id, manufacturers_id, products_ordered from products";
        $from = $_GET['products_from'];
        $anz = $_GET['products_count'];
        if (isset($from)) {
            if (!isset($anz)) $anz = 1000;
            $sql.= " limit " . $from . "," . $anz;
        }
        $orders_query = mysql_query($sql);
        while ($products = mysql_fetch_array($orders_query)) {
            $schema.= '<PRODUCT_INFO>' . "\n" . '<PRODUCT_DATA>' . "\n" . '<PRODUCT_ID>' . $products['products_id'] . '</PRODUCT_ID>' . "\n" . '<PRODUCT_QUANTITY>' . $products['products_quantity'] . '</PRODUCT_QUANTITY>' . "\n" . '<PRODUCT_MODEL>' . htmlspecialchars($products['products_model']) . '</PRODUCT_MODEL>' . "\n" . '<PRODUCT_IMAGE>' . htmlspecialchars($products['products_image']) . '</PRODUCT_IMAGE>' . "\n" . '<PRODUCT_PRICE>' . $products['products_price'] . '</PRODUCT_PRICE>' . "\n" . '<PRODUCT_WEIGHT>' . $products['products_weight'] . '</PRODUCT_WEIGHT>' . "\n" . '<PRODUCT_STATUS>' . $products['products_status'] . '</PRODUCT_STATUS>' . "\n" . '<PRODUCT_TAX_CLASS_ID>' . $products['products_tax_class_id'] . '</PRODUCT_TAX_CLASS_ID>' . "\n" . '<MANUFACTURERS_ID>' . $products['manufacturers_id'] . '</MANUFACTURERS_ID>' . "\n" . '<PRODUCT_DATE_ADDED>' . $products['products_date_added'] . '</PRODUCT_DATE_ADDED>' . "\n" . '<PRODUCT_LAST_MODIFIED>' . $products['products_last_modified'] . '</PRODUCT_LAST_MODIFIED>' . "\n" . '<PRODUCT_DATE_AVAILABLE>' . $products['products_date_available'] . '</PRODUCT_DATE_AVAILABLE>' . "\n" . '<PRODUCTS_ORDERED>' . $products['products_ordered'] . '</PRODUCTS_ORDERED>' . "\n";
            $detail_query = mysql_query("select products_id, language_id, products_name, " . TABLE_PRODUCTS_DESCRIPTION . ".products_description, products_url, name as language_name, code as language_code " . "from " . TABLE_PRODUCTS_DESCRIPTION . ", " . TABLE_LANGUAGES . " where " . TABLE_PRODUCTS_DESCRIPTION . ".language_id=" . TABLE_LANGUAGES . ".languages_id " . "and " . TABLE_PRODUCTS_DESCRIPTION . ".products_id=" . $products['products_id']);
            while ($details = mysql_fetch_array($detail_query)) {
                $schema.= "<PRODUCT_DESCRIPTION ID='" . $details["language_id"] . "' CODE='" . $details["language_code"] . "' NAME='" . $details["language_name"] . "'>\n";
                if ($details["products_name"] != 'Array') {
                    $schema.= "<NAME>" . htmlspecialchars($details["products_name"]) . "</NAME>" . "\n";
                }
                $schema.= "<URL>" . htmlspecialchars($details["products_url"]) . "</URL>" . "\n";
                $prod_details = $details["products_description"];
                if ($prod_details != 'Array') {
                    $schema.= "<DESCRIPTION>" . htmlspecialchars($prod_details) . "</DESCRIPTION>" . "\n";
                }
                $schema.= "</PRODUCT_DESCRIPTION>\n";
            }
            $schema.= '</PRODUCT_DATA>' . "\n" . '</PRODUCT_INFO>' . "\n";
            #echo $schema;
            
        }
        $schema.= '</PRODUCTS>' . "\n\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function SendCustomersNewsletter() {
        global $db;
        $this->SendXMLHeader();
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<CUSTOMERS>' . "\n" . $from = zen_db_prepare_input($_GET['customers_from']);
        $anz = zen_db_prepare_input($_GET['customers_count']);
        $address_query = "select *
                      from " . TABLE_CUSTOMERS . " 
                      where customers_newsletter = 1
                     ";
        if (isset($from)) {
            if (!isset($anz)) $anz = 1000;
            $address_query.= " limit " . $from . "," . $anz;
        }
        $address_result = $db->Execute($address_query);
        while (!$address_result->EOF) {
            $address = $address_result->fields;
            $schema.= '<CUSTOMERS_DATA>' . "\n";
            $schema.= '<CUSTOMERS_ID>' . $address['customers_id'] . '</CUSTOMERS_ID>' . "\n";
            $schema.= '<CUSTOMERS_GENDER>' . $address['customers_gender'] . '</CUSTOMERS_GENDER>' . "\n";
            $schema.= '<CUSTOMERS_FIRSTNAME>' . $address['customers_firstname'] . '</CUSTOMERS_FIRSTNAME>' . "\n";
            $schema.= '<CUSTOMERS_LASTNAME>' . $address['customers_lastname'] . '</CUSTOMERS_LASTNAME>' . "\n";
            $schema.= '<CUSTOMERS_EMAIL_ADDRESS>' . $address['customers_email_address'] . '</CUSTOMERS_EMAIL_ADDRESS>' . "\n";
            $schema.= '</CUSTOMERS_DATA>' . "\n";
            $address_result->MoveNext();
        }
        $schema.= '</CUSTOMERS>' . "\n\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function SendCategories() {
        $this->SendXMLHeader();
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<CATEGORIES>' . "\n";
        $sql = "select categories_id, categories_image, parent_id, sort_order, date_added, last_modified FROM " . TABLE_CATEGORIES . " order by parent_id, categories_id";
        $cat_query = mysql_query("select categories_id, categories_image, parent_id, sort_order, date_added, last_modified " . " from " . TABLE_CATEGORIES . " order by parent_id, categories_id");
        $cat_query = mysql_query($sql);
        while ($cat = mysql_fetch_array($cat_query)) {
            $schema.= '<CATEGORIES_DATA>' . "\n" . '<ID>' . $cat['categories_id'] . '</ID>' . "\n" . '<PARENT_ID>' . $cat['parent_id'] . '</PARENT_ID>' . "\n" . '<IMAGE_URL>' . htmlspecialchars($cat['categories_image']) . '</IMAGE_URL>' . "\n" . '<SORT_ORDER>' . $cat['sort_order'] . '</SORT_ORDER>' . "\n" . '<DATE_ADDED>' . $cat['date_added'] . '</DATE_ADDED>' . "\n" . '<LAST_MODIFIED>' . $cat['last_modified'] . '</LAST_MODIFIED>' . "\n";
            $sql = "select categories_id, language_id, categories_name, " . TABLE_LANGUAGES . ".code as lang_code, " . TABLE_LANGUAGES . ".name as lang_name from " . TABLE_CATEGORIES_DESCRIPTION . "," . TABLE_LANGUAGES . " where " . TABLE_CATEGORIES_DESCRIPTION . ".categories_id=" . $cat['categories_id'] . " and " . TABLE_LANGUAGES . ".languages_id=" . TABLE_CATEGORIES_DESCRIPTION . ".language_id";
            $detail_query = mysql_query($sql);
            while ($details = mysql_fetch_array($detail_query)) {
                $schema.= "<CATEGORIES_DESCRIPTION ID='" . $details["language_id"] . "' CODE='" . $details["lang_code"] . "' NAME='" . $details["lang_name"] . "'>\n";
                $schema.= "<NAME>" . htmlspecialchars($details["categories_name"]) . "</NAME>" . "\n";
                $schema.= "</CATEGORIES_DESCRIPTION>\n";
            }
            // Produkte in dieser Categorie auflisten
            $sql2 = "select categories_id, products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id='" . $cat['categories_id'] . "'";
            $prod2cat_query = mysql_query($sql2);
            while ($prod2cat = mysql_fetch_array($prod2cat_query)) {
                $schema.= "<PRODUCTS ID='" . $prod2cat["products_id"] . "'></PRODUCTS>" . "\n";
            }
            $schema.= '</CATEGORIES_DATA>' . "\n";
            // echo $schema;
            
        }
        $schema.= '</CATEGORIES>' . "\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function SendManufacturers() {
        global $db;
        $this->SendXMLHeader();
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<MANUFACTURERS>' . "\n";
        #echo $schema;
        $cat_query = mysql_query("select manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified " . " from " . TABLE_MANUFACTURERS . " order by manufacturers_id");
        while ($cat = mysql_fetch_array($cat_query)) {
            $schema.= '<MANUFACTURERS_DATA>' . "\n" . '<ID>' . $cat['manufacturers_id'] . '</ID>' . "\n" . '<NAME>' . htmlspecialchars($cat['manufacturers_name']) . '</NAME>' . "\n" . '<IMAGE>' . htmlspecialchars($cat['manufacturers_image']) . '</IMAGE>' . "\n" . '<DATE_ADDED>' . $cat['date_added'] . '</DATE_ADDED>' . "\n" . '<LAST_MODIFIED>' . $cat['last_modified'] . '</LAST_MODIFIED>' . "\n";
            $detail_query = mysql_query("select manufacturers_id, " . TABLE_MANUFACTURERS_INFO . ".languages_id, manufacturers_url, url_clicked, date_last_click, " . TABLE_LANGUAGES . ".code as lang_code, " . TABLE_LANGUAGES . ".name as lang_name from " . TABLE_MANUFACTURERS_INFO . "," . TABLE_LANGUAGES . " where " . TABLE_MANUFACTURERS_INFO . ".manufacturers_id=" . $cat['manufacturers_id'] . " and " . TABLE_LANGUAGES . ".languages_id=" . TABLE_MANUFACTURERS_INFO . ".languages_id");
            while ($details = mysql_fetch_array($detail_query)) {
                $schema.= "<MANUFACTURERS_DESCRIPTION ID='" . $details["languages_id"] . "' CODE='" . $details["lang_code"] . "' NAME='" . $details["lang_name"] . "'>\n";
                $schema.= "<URL>" . htmlspecialchars($details["manufacturers_url"]) . "</URL>" . "\n";
                $schema.= "<URL_CLICK>" . $details["url_clicked"] . "</URL_CLICK>" . "\n";
                $schema.= "<DATE_LAST_CLICK>" . $details["date_last_click"] . "</DATE_LAST_CLICK>" . "\n";
                $schema.= "</MANUFACTURERS_DESCRIPTION>\n";
            }
            $schema.= '</MANUFACTURERS_DATA>' . "\n";
            #echo $schema;
            
        }
        $schema.= '</MANUFACTURERS>' . "\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function SendCustomers() {
        $this->SendXMLHeader();
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<CUSTOMERS>' . "\n";
        $from = $_GET['customers_from'];
        $anz = $_GET['customers_count'];
        $address_query = "select c.customers_gender, c.customers_id, c.customers_firstname, c.customers_lastname,c.customers_dob, c.customers_email_address, c.customers_telephone, c.customers_fax,
                            ci.customers_info_date_account_created  as customers_date_account_created,
                            a.entry_firstname as firstname, a.entry_lastname as lastname, a.entry_company as company, a.entry_street_address as street_address, a.entry_city as city, a.entry_postcode as postcode,
                            co.countries_iso_code_2 as country
                            from " . TABLE_CUSTOMERS . " c, " . TABLE_CUSTOMERS_INFO . " ci, " . TABLE_ADDRESS_BOOK . " a , " . TABLE_COUNTRIES . " co
                            where c.customers_id = ci.customers_info_id
                            AND c.customers_id = a.customers_id
                            AND c.customers_default_address_id = a.address_book_id
                            AND a.entry_country_id  = co.countries_id";
        if (isset($from)) {
            if (!isset($anz)) $anz = 1000;
            $address_query.= " limit " . $from . "," . $anz;
        }
        $address_result = mysql_query($address_query);
        while ($address = mysql_fetch_array($address_result, MYSQL_ASSOC)) {
            $schema.= '<CUSTOMERS_DATA>' . "\n" . '<CUSTOMERS_ID>' . htmlspecialchars($address['customers_id']) . '</CUSTOMERS_ID>' . "\n" . '<CUSTOMERS_CID>' . htmlspecialchars($address['customers_id']) . '</CUSTOMERS_CID>' . "\n" . '<GENDER>' . htmlspecialchars($address['customers_gender']) . '</GENDER>' . "\n" . '<COMPANY>' . htmlspecialchars($address['company']) . '</COMPANY>' . "\n" . '<FIRSTNAME>' . htmlspecialchars($address['firstname']) . '</FIRSTNAME>' . "\n" . '<LASTNAME>' . htmlspecialchars($address['lastname']) . '</LASTNAME>' . "\n" . '<STREET>' . htmlspecialchars($address['street_address']) . '</STREET>' . "\n" . '<POSTCODE>' . htmlspecialchars($address['postcode']) . '</POSTCODE>' . "\n" . '<CITY>' . htmlspecialchars($address['city']) . '</CITY>' . "\n" . '<SUBURB>' . htmlspecialchars($address['customers_suburb']) . '</SUBURB>' . "\n" . '<STATE>' . htmlspecialchars($address['customers_state']) . '</STATE>' . "\n" . '<COUNTRY>' . htmlspecialchars($address['countries_iso_code_2']) . '</COUNTRY>' . "\n" . '<TELEPHONE>' . htmlspecialchars($address['customers_telephone']) . '</TELEPHONE>' . "\n" . // JAN
            '<FAX>' . htmlspecialchars($address['customers_fax']) . '</FAX>' . "\n" . // JAN
            '<EMAIL>' . htmlspecialchars($address['customers_email_address']) . '</EMAIL>' . "\n" . // JAN
            '<BIRTHDAY>' . htmlspecialchars($address['customers_dob']) . '</BIRTHDAY>' . "\n" . '<VAT_ID>' . htmlspecialchars($address['vat_id']) . '</VAT_ID>' . "\n" . '<DATE_ACCOUNT_CREATED>' . htmlspecialchars($address['customers_info_date_account_created']) . '</DATE_ACCOUNT_CREATED>' . "\n";
            $schema.= '</CUSTOMERS_DATA>' . "\n";
        }
        $schema.= '</CUSTOMERS>' . "\n\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function SendOrders() {
        $this->SendXMLHeader();
        $order_from = $_GET['order_from'];
        $order_to = $_GET['order_to'];
        $order_status = $_GET['order_status'];
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<ORDER>' . "\n";
        $sql = "select * from " . TABLE_ORDERS . " where orders_id >= '" . $order_from . "'";
        if (!isset($order_status) && !isset($order_from)) {
            $order_status = 1;
            $sql.= "and orders_status = " . $order_status;
        }
        $orders_query = mysql_query($sql);
        while ($orders = mysql_fetch_array($orders_query)) {
            // Geburtsdatum laden
            $cust_sql = "select * from " . TABLE_CUSTOMERS . " where customers_id=" . $orders['customers_id'];
            $cust_query = mysql_query($cust_sql);
            if ((mysql_fetch_array($cust_query)) && ($cust_data = mysql_fetch_array($cust_query))) {
                $cust_dob = $cust_data['customers_dob'];
            }
            $schema.= '<ORDER_INFO>' . "\n" . '<ORDER_HEADER>' . "\n" . '<ORDER_ID>' . $orders['orders_id'] . '</ORDER_ID>' . "\n" . '<CUSTOMER_ID>' . $orders['customers_id'] . '</CUSTOMER_ID>' . "\n" . '<ORDER_DATE>' . $orders['date_purchased'] . '</ORDER_DATE>' . "\n" . '<ORDER_STATUS>' . $orders['orders_status'] . '</ORDER_STATUS>' . "\n" . '<ORDER_CURRENCY>' . htmlspecialchars($orders['currency']) . '</ORDER_CURRENCY>' . "\n" . '<ORDER_CURRENCY_VALUE>' . $orders['currency_value'] . '</ORDER_CURRENCY_VALUE>' . "\n" . '</ORDER_HEADER>' . "\n" . '<BILLING_ADDRESS>' . "\n" . '<COMPANY>' . htmlspecialchars($orders['billing_company']) . '</COMPANY>' . "\n" . '<NAME>' . htmlspecialchars($orders['billing_name']) . '</NAME>' . "\n" . '<STREET>' . htmlspecialchars($orders['billing_street_address']) . '</STREET>' . "\n" . '<ZIP>' . htmlspecialchars($orders['billing_postcode']) . '</ZIP>' . "\n" . '<CITY>' . htmlspecialchars($orders['billing_city']) . '</CITY>' . "\n" . '<SUBURB>' . htmlspecialchars($orders['billing_suburb']) . '</SUBURB>' . "\n" . '<STATE>' . htmlspecialchars($orders['billing_state']) . '</STATE>' . "\n" . '<COUNTRY>' . htmlspecialchars($orders['billing_country']) . '</COUNTRY>' . "\n" . '<TELEPHONE>' . htmlspecialchars($orders['customers_telephone']) . '</TELEPHONE>' . "\n" . // JAN
            '<EMAIL>' . htmlspecialchars($orders['customers_email_address']) . '</EMAIL>' . "\n" . // JAN
            '<BIRTHDAY>' . htmlspecialchars($cust_dob) . '</BIRTHDAY>' . "\n" . '</BILLING_ADDRESS>' . "\n" . '<DELIVERY_ADDRESS>' . "\n" . '<COMPANY>' . htmlspecialchars($orders['delivery_company']) . '</COMPANY>' . "\n" . '<NAME>' . htmlspecialchars($orders['delivery_name']) . '</NAME>' . "\n" . '<STREET>' . htmlspecialchars($orders['delivery_street_address']) . '</STREET>' . "\n" . '<ZIP>' . htmlspecialchars($orders['delivery_postcode']) . '</ZIP>' . "\n" . '<CITY>' . htmlspecialchars($orders['delivery_city']) . '</CITY>' . "\n" . '<SUBURB>' . htmlspecialchars($orders['delivery_suburb']) . '</SUBURB>' . "\n" . '<STATE>' . htmlspecialchars($orders['delivery_state']) . '</STATE>' . "\n" . '<COUNTRY>' . htmlspecialchars($orders['delivery_country']) . '</COUNTRY>' . "\n" . '</DELIVERY_ADDRESS>' . "\n" . '<PAYMENT>' . "\n" . '<PAYMENT_METHOD>' . htmlspecialchars($orders['payment_method']) . '</PAYMENT_METHOD>' . "\n" . '<PAYMENT_CLASS>' . htmlspecialchars($orders['payment_class']) . '</PAYMENT_CLASS>' . "\n";
            switch ($orders['payment_class']) {
                case 'banktransfer':
                    // Bankverbindung laden, wenn aktiv
                    $bank_name = '';
                    $bank_blz = '';
                    $bank_kto = '';
                    $bank_inh = '';
                    $bank_stat = - 1;
                    $bank_sql = "select * from banktransfer where orders_id = " . $orders['orders_id'];
                    $bank_query = mysql_query($bank_sql);
                    if ((mysql_fetch_array($bank_query)) && ($bankdata = mysql_fetch_array($bank_query))) {
                        $bank_name = $bankdata['banktransfer_bankname'];
                        $bank_blz = $bankdata['banktransfer_blz'];
                        $bank_kto = $bankdata['banktransfer_number'];
                        $bank_inh = $bankdata['banktransfer_owner'];
                        $bank_stat = $bankdata['banktransfer_status'];
                    }
                    $schema.= '<PAYMENT_BANKTRANS_BNAME>' . htmlspecialchars($bank_name) . '</PAYMENT_BANKTRANS_BNAME>' . "\n" . '<PAYMENT_BANKTRANS_BLZ>' . htmlspecialchars($bank_blz) . '</PAYMENT_BANKTRANS_BLZ>' . "\n" . '<PAYMENT_BANKTRANS_NUMBER>' . htmlspecialchars($bank_kto) . '</PAYMENT_BANKTRANS_NUMBER>' . "\n" . '<PAYMENT_BANKTRANS_OWNER>' . htmlspecialchars($bank_inh) . '</PAYMENT_BANKTRANS_OWNER>' . "\n" . '<PAYMENT_BANKTRANS_STATUS>' . htmlspecialchars($bank_stat) . '</PAYMENT_BANKTRANS_STATUS>' . "\n";
                break;
            }
            $schema.= '</PAYMENT>' . "\n" . '<SHIPPING>' . "\n" . '<SHIPPING_METHOD>' . htmlspecialchars($orders['shipping_method']) . '</SHIPPING_METHOD>' . "\n" . '<SHIPPING_CLASS>' . htmlspecialchars($orders['shipping_class']) . '</SHIPPING_CLASS>' . "\n" . '</SHIPPING>' . "\n" . '<ORDER_PRODUCTS>' . "\n";
            $products_query = mysql_query("select orders_products_id, products_id, products_model, products_name, final_price, products_tax, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $orders['orders_id'] . "'");
            while ($products = mysql_fetch_array($products_query)) {
                $schema.= '<PRODUCT>' . "\n" . '<PRODUCTS_ID>' . $products['products_id'] . '</PRODUCTS_ID>' . "\n" . '<PRODUCTS_QUANTITY>' . $products['products_quantity'] . '</PRODUCTS_QUANTITY>' . "\n" . '<PRODUCTS_MODEL>' . htmlspecialchars($products['products_model']) . '</PRODUCTS_MODEL>' . "\n" . '<PRODUCTS_NAME>' . htmlspecialchars($products['products_name']) . '</PRODUCTS_NAME>' . "\n" . '<PRODUCTS_PRICE>' . $products['final_price'] . '</PRODUCTS_PRICE>' . "\n" . '<PRODUCTS_TAX>' . $products['products_tax'] . '</PRODUCTS_TAX>' . "\n";
                $attributes_query = mysql_query("select products_options, products_options_values, options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . $orders['orders_id'] . "' and orders_products_id = '" . $products['orders_products_id'] . "'");
                if (mysql_num_rows($attributes_query)) {
                    while ($attributes = mysql_fetch_array($attributes_query)) {
                        $schema.= '<OPTION>' . "\n" . '<PRODUCTS_OPTIONS>' . htmlspecialchars($attributes['products_options']) . '</PRODUCTS_OPTIONS>' . "\n" . '<PRODUCTS_OPTIONS_VALUES>' . htmlspecialchars($attributes['products_options_values']) . '</PRODUCTS_OPTIONS_VALUES>' . "\n" . '<PRODUCTS_OPTIONS_PRICE>' . $attributes['price_prefix'] . ' ' . $attributes['options_values_price'] . '</PRODUCTS_OPTIONS_PRICE>' . "\n" . '</OPTION>' . "\n";
                    }
                }
                $schema.= '</PRODUCT>' . "\n";
            }
            $schema.= '</ORDER_PRODUCTS>' . "\n";
            $schema.= '<ORDER_TOTAL>' . "\n";
            $totals_query = mysql_query("select title, value, class, sort_order from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $orders['orders_id'] . "' order by sort_order");
            while ($totals = mysql_fetch_array($totals_query)) {
                $total_prefix = "";
                $total_tax = "";
                $total_prefix = $order_total_class[$totals['class']]['prefix'];
                $total_tax = $order_total_class[$totals['class']]['tax'];
                $schema.= '<TOTAL>' . "\n" . '<TOTAL_TITLE>' . htmlspecialchars($totals['title']) . '</TOTAL_TITLE>' . "\n" . '<TOTAL_VALUE>' . htmlspecialchars($totals['value']) . '</TOTAL_VALUE>' . "\n" . '<TOTAL_CLASS>' . htmlspecialchars($totals['class']) . '</TOTAL_CLASS>' . "\n" . '<TOTAL_SORT_ORDER>' . htmlspecialchars($totals['sort_order']) . '</TOTAL_SORT_ORDER>' . "\n" . '<TOTAL_PREFIX>' . htmlspecialchars($total_prefix) . '</TOTAL_PREFIX>' . "\n" . '<TOTAL_TAX>' . htmlspecialchars($total_tax) . '</TOTAL_TAX>' . "\n" . '</TOTAL>' . "\n";
            }
            $schema.= '</ORDER_TOTAL>' . "\n";
            $comments_query = mysql_query("select comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . $orders['orders_id'] . "' and orders_status_id = '" . $orders['orders_status'] . "' ");
            if ($comments = mysql_fetch_array($comments_query)) {
                $schema.= '<ORDER_COMMENTS>' . htmlspecialchars($comments['comments']) . '</ORDER_COMMENTS>' . "\n";
            }
            $schema.= '</ORDER_INFO>' . "\n\n";
        }
        $schema.= '</ORDER>' . "\n\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function ProductsUpdate() {
        global $db;
        $products_id = zen_db_prepare_input($_POST['pID']);
        // product laden
        $query = "select products_quantity,products_model,products_image,products_price,products_date_available,products_weight,products_status,products_tax_class_id,manufacturers_id from " . TABLE_PRODUCTS . " where products_id='" . $products_id . "'";
        $count_query = $db->Execute($query);
        if ($count_query->RecordCount()) {
            $exists = 1;
            // aktuelle Produktdaten laden
            $products_quantity = $count_query->fields['products_quantity'];
            $products_model = $count_query->fields['products_model'];
            $products_image = $count_query->fields['products_image'];
            $products_price = $count_query->fields['products_price'];
            $products_date_available = $count_query->fields['products_date_available'];
            $products_weight = $count_query->fields['products_weight'];
            $products_status = $count_query->fields['products_status'];
            $products_tax_class_id = $count_query->fields['products_tax_class_id'];
            $manufacturers_id = $count_query->fields['manufacturers_id'];
        } else $exists = 0;
        // Variablen nur ueberschreiben wenn als Parameter vorhanden !!!
        if (isset($_POST['products_quantity'])) $products_quantity = zen_db_prepare_input($_POST['products_quantity']);
        if (isset($_POST['products_model'])) $products_model = zen_db_prepare_input($_POST['products_model']);
        if (isset($_POST['products_image'])) $products_image = zen_db_prepare_input($_POST['products_image']);
        if (isset($_POST['products_price'])) $products_price = zen_db_prepare_input($_POST['products_price']);
        if (isset($_POST['products_date_available'])) $products_date_available = zen_db_prepare_input($_POST['products_date_available']);
        if (isset($_POST['products_weight'])) $products_weight = zen_db_prepare_input($_POST['products_weight']);
        if (isset($_POST['products_status'])) $products_status = zen_db_prepare_input($_POST['products_status']);
        if (isset($_POST['products_tax_class_id'])) $products_tax_class_id = zen_db_prepare_input($_POST['products_tax_class_id']);
        if (isset($_POST['manufacturers_id'])) $manufacturers_id = zen_db_prepare_input($_POST['manufacturers_id']);
        $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : 'null';
        // r.l. :: $products_image anpassen & bilder ezeugen
        $l = strlen($products_model); // $minModel
        if (CHANGE2PRODUCT_MODELL) {
            $newProductsImage = str_repeat('_', $minModel - $l) . $products_model . '.jpg';
            $ex = 'cp ' . DIR_FS_CATALOG_IMAGES . ORIGINAL . $products_image . ' ' . DIR_FS_CATALOG_IMAGES . ORIGINAL . $newProductsImage;
            exec($ex);
            #$newProductsImage = $x;
            #$newProductsImage = $products_image;
            
        } else {
            $newProductsImage = $products_image;
        }
        writeXML("IM_1: $minModel - $l - $products_model" . $newProductsImage . ' // ' . $ex, 'im');
        if (USE_IMAGERESIZE) {
            foreach ($this->sizes as $key => $val) {
                list($small_width, $small_height, $resize_small) = zen_calculate_image_size(DIR_FS_CATALOG_IMAGES . ORIGINAL . $newProductsImage, $val['width'], $val['height']);
                $size = $small_width . "x" . $small_height;
                $xxx = DIR_FS_CATALOG_IMAGES . ORIGINAL . $newProductsImage . ' // ' . DIR_FS_CATALOG_IMAGES . $val['folder'] . $newProductsImage . ' // ' . $size;
                if (USE_IMAGERESIZE) {
                    #zen_imagemagick_resize_image(DIR_FS_CATALOG_IMAGES . ORIGINAL . $newProductsImage, DIR_FS_CATALOG_IMAGES . $val['folder'] . $newProductsImage, 'transparent', $size);
                    $mm = zen_gd_resize_image(DIR_FS_CATALOG_IMAGES . ORIGINAL . $newProductsImage, DIR_FS_CATALOG_IMAGES . $val['folder'] . $newProductsImage, 'transparent', $small_width, $small_height);
                    #zen_gd_resize_image($source_name, $destination_name, $background, $newwidth = -1, $newheight = -1, $quality = 75)
                    writeXML('ORI:' . $mm . DIR_FS_CATALOG_IMAGES . ORIGINAL . $newProductsImage . ' :: NEW: ' . DIR_FS_CATALOG_IMAGES . $val['folder'] . $newProductsImage, 'im');
                }
            }
        }
        $sql_data_array = array('products_id' => $products_id, 'products_quantity' => $products_quantity, 'products_model' => $products_model, 'products_image' => ($products_image == 'none') ? '' : $newProductsImage, 'products_price' => $products_price, 'products_date_available' => $products_date_available, 'products_weight' => $products_weight, 'products_status' => $products_status, 'products_tax_class_id' => $products_tax_class_id, 'manufacturers_id' => $manufacturers_id);
        foreach ($this->userfieldMapping as $key => $val) {
            if (isset($_POST['products_userfield'][$key])) {
                $vTmp = zen_db_prepare_input($_POST['products_userfield'][$key]);
                $sql_data_array[$val] = $vTmp;
            }
        }
        if ($exists == 0) { // Neuanlage (ID wird an CAO zurueckgegeben !!!)
            $mode = 'APPEND';
            $insert_sql_data = array('products_date_added' => 'now()');
            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            $xx = zen_db_perform(TABLE_PRODUCTS, $sql_data_array);
            $products_id = $db->insert_ID();
        } elseif ($exists == 1) { // Update
            $mode = 'UPDATE';
            $update_sql_data = array('products_last_modified' => 'now()');
            $sql_data_array = array_merge($sql_data_array, $update_sql_data);
            zen_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', 'products_id = \'' . zen_db_input($products_id) . '\'');
        }
        $languages = zen_get_languages();
        unset($sql_data_array);
        for ($i = 0, $n = sizeof($languages);$i < $n;$i++) {
            $language_id = $languages[$i]['languages_id'];
            $xxx = 'LANGUAGE::' . print_r($languages, true);
            $this->writeXML($xxx, __FUNCTION__);
            // Bestehende Daten laden
            $desc_query = $db->Execute("select products_id,products_name,products_description,products_url,products_viewed,language_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id='" . $products_id . "' and language_id='" . $language_id . "'");
            if ($desc_query->recordCount()) {
                $products_name = $desc_query->fields['products_name'];
                $products_description = $desc_query->fields['products_description'];
                $products_url = $desc_query->fields['products_url'];
            }
            // uebergebene Daten einsetzen
            if (isset($_POST['products_name'][$language_id])) $products_name = zen_db_prepare_input($_POST['products_name'][$language_id]);
            if (isset($_POST['products_description'][$language_id])) $products_description = zen_db_prepare_input($_POST['products_description'][$language_id]);
            if (isset($_POST['products_url'][$language_id])) $products_url = zen_db_prepare_input($_POST['products_url'][$language_id]);
            // r.l. cao üübergibt immer 2 als language
            if (isset($_POST['products_name'][2])) $products_name = zen_db_prepare_input($_POST['products_name'][2]);
            if (isset($_POST['products_description'][2])) $products_description = zen_db_prepare_input($_POST['products_description'][2]);
            if (isset($_POST['products_url'][2])) $products_url = zen_db_prepare_input($_POST['products_url'][2]);
            if (!isset($products_name)) {
                $products_name = $products_id . '_ArtText';
            }
            $xxx = print_r($_POST, true);
            $sql_data_array = array('products_name' => $products_name, 'products_description' => $products_description, 'products_url' => $products_url);
            if ($exists == 0) { // Insert
                $insert_sql_data = array('products_id' => $products_id, 'language_id' => $language_id);
                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
                # $sql_data_array['products_description'] = $xxx;
                zen_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
            } elseif ($exists == 1) { // Update
                zen_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', 'products_id = \'' . zen_db_input($products_id) . '\' and language_id = \'' . $language_id . '\'');
            }
            $xxx = '$sql_data_array::' . $language_id . print_r($sql_data_array, true);
            $xxx.= 'POST::' . $language_id . print_r($_POST, true);
            $this->writeXML($xxx, __FUNCTION__);
        }
        $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<STATUS>' . "\n" . '<STATUS_DATA>' . "\n" . '<ACTION>' . $_POST['action'] . '</ACTION>' . "\n" . '<CODE>' . '0' . '</CODE>' . "\n" . '<MESSAGE>' . 'OK' . '</MESSAGE>' . "\n" . '<MODE>' . $mode . '</MODE>' . "\n" . '<PRODUCTS_ID>' . $products_id . '</PRODUCTS_ID>' . "\n" . '</STATUS_DATA>' . "\n" . '</STATUS>' . "\n\n";
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function ManufacturersUpdate() {
        global $db;
        $this->SendXMLHeader();
        $manufacturers_id = zen_db_prepare_input($_POST['mID']);
        $xxx = print_r($_POST, true);
        writeXML($xxx, 'hersteller');
        if (isset($manufacturers_id)) {
            // Hersteller laden
            $count_query = $db->Execute("select manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified from " . TABLE_MANUFACTURERS . " where manufacturers_id='" . $manufacturers_id . "'");
            if ($count_query->recordCount()) {
                $exists = 1;
                // aktuelle Herstellerdaten laden
                $manufacturers_name = $count_query->fields['manufacturers_name'];
                $manufacturers_image = $count_query->fields['manufacturers_image'];
                $date_added = $count_query->fields['date_added'];
                $last_modified = $count_query->fields['last_modified'];
            } else $exists = 0;
            // Variablen nur ueberschreiben wenn als Parameter vorhanden !!!
            if (isset($_POST['manufacturers_name'])) $manufacturers_name = zen_db_prepare_input($_POST['manufacturers_name']);
            if (isset($_POST['manufacturers_image'])) $manufacturers_image = zen_db_prepare_input($_POST['manufacturers_image']);
            $sql_data_array = array('manufacturers_id' => $manufacturers_id, 'manufacturers_name' => $manufacturers_name, 'manufacturers_image' => $manufacturers_image);
            if ($exists == 0) { // Neuanlage (ID wird von CAO vorgegeben !!!)
                $mode = 'APPEND';
                $insert_sql_data = array('date_added' => 'now()');
                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
                zen_db_perform(TABLE_MANUFACTURERS, $sql_data_array);
                $products_id = $db->insert_id();
            } elseif ($exists == 1) { // Update
                $mode = 'UPDATE';
                $update_sql_data = array('last_modified' => 'now()');
                $sql_data_array = array_merge($sql_data_array, $update_sql_data);
                zen_db_perform(TABLE_MANUFACTURERS, $sql_data_array, 'update', 'manufacturers_id = \'' . zen_db_input($manufacturers_id) . '\'');
            }
            $languages = zen_get_languages();
            for ($i = 0, $n = sizeof($languages);$i < $n;$i++) {
                $language_id = $languages[$i]['languages_id'];
                // Bestehende Daten laden
                $desc_query = $db->Execute("select manufacturers_id,languages_id,manufacturers_url,url_clicked,date_last_click from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id='" . $manufacturers_id . "' and languages_id='" . $language_id . "'");
                if (!$desc_query->EOF) {
                    $manufacturers_url = $desc_query->fields['manufacturers_url'];
                    $url_clicked = $desc_query->fields['url_clicked'];
                    $date_last_click = $desc_query->fields['date_last_click'];
                }
                // uebergebene Daten einsetzen
                if (isset($_POST['manufacturers_url'][$language_id])) $manufacturers_url = zen_db_prepare_input($_POST['manufacturers_url'][$language_id]);
                if (isset($_POST['url_clicked'][$language_id])) $url_clicked = zen_db_prepare_input($_POST['url_clicked'][$language_id]);
                if (isset($_POST['date_last_click'][$language_id])) $date_last_click = zen_db_prepare_input($_POST['date_last_click'][$language_id]);
                $sql_data_array = array('manufacturers_url' => $manufacturers_url);
                if ($exists == 0) { // Insert
                    $insert_sql_data = array('manufacturers_id' => $products_id, 'languages_id' => $language_id);
                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
                    zen_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array);
                } elseif ($exists == 1) { // Update
                    zen_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array, 'update', 'manufacturers_id = \'' . zen_db_input($manufacturers_id) . '\' and languages_id = \'' . $language_id . '\'');
                }
            }
            $xxx = print_r($sql_data_array, true);
            writeXML($xxx);
            $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<STATUS>' . "\n" . '<STATUS_DATA>' . "\n" . '<ACTION>' . $_POST['action'] . '</ACTION>' . "\n" . '<CODE>' . '0' . '</CODE>' . "\n" . '<MESSAGE>' . 'OK' . '</MESSAGE>' . "\n" . '<MODE>' . $mode . '</MODE>' . "\n" . '<MANUFACTURERS_ID>' . $mID . '</MANUFACTURERS_ID>' . "\n" . '</STATUS_DATA>' . "\n" . '</STATUS>' . "\n\n";
            echo $schema;
            exit;
        } else {
            $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n" . '<STATUS>' . "\n" . '<STATUS_DATA>' . "\n" . '<ACTION>' . $_POST['action'] . '</ACTION>' . "\n" . '<CODE>' . '99' . '</CODE>' . "\n" . '<MESSAGE>' . 'PARAMETER ERROR' . '</MESSAGE>' . "\n" . '</STATUS_DATA>' . "\n" . '</STATUS>' . "\n\n";
            echo $schema;
            exit;
        }
        echo $schema;
        $this->writeXML($schema, __FUNCTION__);
    }
    function allRest() {
        $this->SendXMLHeader();
        echo 'noch offen 626';
        $this->writeXML($schema, __FUNCTION__);
    }
    function ManufacturersImageUpload() {
        $this->SendXMLHeader();
        echo 'noch offen 633';
        $this->writeXML($schema, __FUNCTION__);
    }
    function ProductsImageUpload() {
        $this->SendXMLHeader();
        $products_image_name = 'NIX';
        $x = print_r($_FILES, true);
        $this->writeXML($x, __FUNCTION__);
        #die('::'.__LINE__. $x);
        $products_image = new upload('products_image');
        $products_image->set_destination(DIR_FS_CATALOG_IMAGES . ORIGINAL);
        #$xxx = print_r($_POST, true);
        if ($products_image->parse() && $products_image->save()) {
            $products_image_name = $products_image->filename;
            echo $products_image_name;
        }
        $xxx.= print_r($products_image, true);
        writeXML($xxx, 'upload');
        #echo 'noch offen 650';
        $this->writeXML($products_image_name, __FUNCTION__);
    }
}

#############################################################################################################

function ShowHTMLMenu() {
    global $version_nr, $version_datum, $user, $password, $PHP_SELF;
    SendHTMLHeader;
    $Url = $PHP_SELF . "?user=" . $user . "&password=" . $password;
?>
<html><head></head><body>
<h3><a href="http://www.cao-faktura.de">CAO-Faktura - xt:Commerce Shopanbindung</a></h3>
<h4>Mehr dazu im <a href="http://www.cao-faktura.de/index.php?option=com_forum&Itemid=44">Forum</a></h4>
<h4>Version <?php echo $version_nr; ?> Stand : <?php echo $version_datum; ?></h4>
<br>
<br><b>m&ouml;gliche Funktionen :</b><br><br>
<a href="<?php echo $Url; ?>&action=version">Ausgabe XML Scriptversion</a><br>
<br>
<a href="<?php echo $Url; ?>&action=manufacturers_export">Ausgabe XML Manufacturers</a><br>
<a href="<?php echo $Url; ?>&action=categories_export">Ausgabe XML Categories</a><br>
<a href="<?php echo $Url; ?>&action=products_export">Ausgabe XML Products</a><br>
<a href="<?php echo $Url; ?>&action=customers_export">Ausgabe XML Customers</a><br>
<a href="<?php echo $Url; ?>&action=customers_newsletter_export">Ausgabe XML Customers-Newsletter</a><br>
<br>
<a href="<?php echo $Url; ?>&action=orders_export">Ausgabe XML Orders</a><br>
<br>
<a href="<?php echo $Url; ?>&action=config_export">Ausgabe XML Shop-Config</a><br>
<br>
<a href="<?php echo $Url; ?>&action=update_tables">MySQL-Tabellen aktualisieren</a><br>
<br>
<a href="<?php echo $Url; ?>&action=send_log">aktuelles Transfer-Log ansehen (die le. 100 Eintr&auml;ge)</a><br>
</body>
</html>
<?php
}
function UpdateTables() {
    global $version_nr, $version_datum, $db;
    SendHTMLHeader;
    echo '<html><head></head><body>';
    echo '<h3>Tabellen-Update / Erweiterung für CAO-Faktura</h3>';
    echo '<h4>Version ' . $version_nr . ' Stand : ' . $version_datum . '</h4>';
    $sql[13] = 'ALTER TABLE ' . TABLE_PRODUCTS . ' ADD products_ean VARCHAR(128) AFTER products_id';
    $sql[2] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD payment_class VARCHAR(32) NOT NULL';
    $sql[3] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD shipping_method VARCHAR(32) NOT NULL';
    $sql[4] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD shipping_class VARCHAR(32) NOT NULL';
    $sql[5] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD billing_country_iso_code_2 CHAR(2) NOT NULL AFTER billing_country';
    $sql[6] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD delivery_country_iso_code_2 CHAR(2) NOT NULL AFTER delivery_country';
    $sql[7] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD billing_firstname VARCHAR(32) NOT NULL AFTER billing_name';
    $sql[8] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD billing_lastname VARCHAR(32) NOT NULL AFTER billing_firstname';
    $sql[9] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD delivery_firstname VARCHAR(32) NOT NULL AFTER delivery_name';
    $sql[10] = 'ALTER TABLE ' . TABLE_ORDERS . ' ADD delivery_lastname VARCHAR(32) NOT NULL AFTER delivery_firstname';
    $sql[11] = 'ALTER TABLE ' . TABLE_ORDERS . ' CHANGE payment_method payment_method VARCHAR(255) NOT NULL';
    $sql[12] = 'ALTER TABLE ' . TABLE_ORDERS . ' CHANGE shipping_method shipping_method VARCHAR(255) NOT NULL';
    $sql[1] = 'CREATE TABLE cao_log ( id int(11) NOT NULL auto_increment, date datetime NOT NULL default "0000-00-00 00:00:00",' . 'user varchar(64) NOT NULL default "", pw varchar(64) NOT NULL default "", method varchar(64) NOT NULL default "",' . 'action varchar(64) NOT NULL default "", post_data mediumtext, get_data mediumtext, PRIMARY KEY  (id))';
    $link = 'db_link';
    global $$link, $logger;
    for ($i = 1;$i <= 13;$i++) {
        echo '<b>SQL:</b> ' . $sql[$i] . '<br>';;
        if ($db->execute($sql[$i], $$link)) {
            echo '<b>Ergebnis : OK</b>';
        } else {
            $error = mysql_error();
            $pos = strpos($error, 'Duplicate column name');
            if ($pos === False) {
                $pos = strpos($error, 'already exists');
                if ($pos === False) {
                    echo '<b>Ergebnis : </b><font color="red"><b>' . $error . '</b></font>';
                } else {
                    echo '<b>Ergebnis : OK, Tabelle existierte bereits !</b>';
                }
            } else {
                echo '<b>Ergebnis : OK, Spalte existierte bereits !</b>';
            }
        }
        echo '<br><br>';
    }
    echo '</body></html>';
}

function Xzen_products_attributes_download_delete($product_id) {
    global $db;
    // remove downloads if they exist
    $remove_downloads = $db->Execute("select products_attributes_id from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id= '" . $product_id . "'");
    while (!$remove_downloads->EOF) {
        $db->Execute("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id= '" . $remove_downloads->fields['products_attributes_id'] . "'");
        $remove_downloads->MoveNext();
    }
}
function Xzen_remove_product($product_id, $ptc = 'true') {
    global $db;
    $product_image = $db->Execute("select products_image
                                   from " . TABLE_PRODUCTS . "
                                   where products_id = '" . (int)$product_id . "'");
    $duplicate_image = $db->Execute("select count(*) as total
                                     from " . TABLE_PRODUCTS . "
                                     where products_image = '" . zen_db_input($product_image->fields['products_image']) . "'");
    if ($duplicate_image->fields['total'] < 2 and $product_image->fields['products_image'] != '') {
        $products_image = $product_image->fields['products_image'];
        $products_image_extention = substr($products_image, strrpos($products_image, '.'));
        $products_image_base = ereg_replace($products_image_extention, '', $products_image);
        $filename_medium = 'medium/' . $products_image_base . IMAGE_SUFFIX_MEDIUM . $products_image_extention;
        $filename_large = 'large/' . $products_image_base . IMAGE_SUFFIX_LARGE . $products_image_extention;
        if (file_exists(DIR_FS_CATALOG_IMAGES . $product_image->fields['products_image'])) {
            @unlink(DIR_FS_CATALOG_IMAGES . $product_image->fields['products_image']);
        }
        if (file_exists(DIR_FS_CATALOG_IMAGES . $filename_medium)) {
            @unlink(DIR_FS_CATALOG_IMAGES . $filename_medium);
        }
        if (file_exists(DIR_FS_CATALOG_IMAGES . $filename_large)) {
            @unlink(DIR_FS_CATALOG_IMAGES . $filename_large);
        }
    }
    $db->Execute("delete from " . TABLE_SPECIALS . "
                  where products_id = '" . (int)$product_id . "'");
    $db->Execute("delete from " . TABLE_PRODUCTS . "
                  where products_id = '" . (int)$product_id . "'");
    // if ($ptc == 'true') {
    $db->Execute("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . "
                    where products_id = '" . (int)$product_id . "'");
    // }
    $db->Execute("delete from " . TABLE_PRODUCTS_DESCRIPTION . "
                  where products_id = '" . (int)$product_id . "'");
    zen_products_attributes_download_delete($product_id);
    $db->Execute("delete from " . TABLE_PRODUCTS_ATTRIBUTES . "
                  where products_id = '" . (int)$product_id . "'");
    $db->Execute("delete from " . TABLE_CUSTOMERS_BASKET . "
                  where products_id = '" . (int)$product_id . "'");
    $db->Execute("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                  where products_id = '" . (int)$product_id . "'");
    $product_reviews = $db->Execute("select reviews_id
                                     from " . TABLE_REVIEWS . "
                                     where products_id = '" . (int)$product_id . "'");
    while (!$product_reviews->EOF) {
        $db->Execute("delete from " . TABLE_REVIEWS_DESCRIPTION . "
                    where reviews_id = '" . (int)$product_reviews->fields['reviews_id'] . "'");
        $product_reviews->MoveNext();
    }
    $db->Execute("delete from " . TABLE_REVIEWS . "
                  where products_id = '" . (int)$product_id . "'");
    $db->Execute("delete from " . TABLE_FEATURED . "
                  where products_id = '" . (int)$product_id . "'");
    $db->Execute("delete from " . TABLE_PRODUCTS_DISCOUNT_QUANTITY . "
                  where products_id = '" . (int)$product_id . "'");
}

