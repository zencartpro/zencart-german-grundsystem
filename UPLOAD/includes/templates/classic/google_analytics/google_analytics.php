<?php
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Portions Copyright (c) 2003 osCommerce                               |
// | Portions Copyright (c) 2004 zen-cart								  |
// | Portions Copyright (c) 2005-2006 Andrew Berezin					  |
// | Portions Copyright (c) 2006 Dayne Larsen							  |
// | Portions Copyright (c) 2007-2010 Eric Leuenberger					  |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | file: google_analytics.php, 2010/12/02							  	  |
// | Adds Google Analytics Capability to Zen Cart						  |
// | Version Information:  v1.2.4 2010.12.02							  |
// | Author: Eric Leuenberger - http://www.TheEcommerceExpert.com	      |
// +----------------------------------------------------------------------+
//

if (GOOGLE_ANALYTICS_ENABLED == "Enabled") {

    switch ($_GET['main_page']) {

        /* **************************************************
         * FILENAME PRODUCT INFO
         * **************************************************/
        case FILENAME_PRODUCT_INFO:

            $myQuantity = $_SESSION['cart']->get_quantity($_GET['products_id']);

            echo ("<!-- ===== Google Enhanced Ecommerce - Product Information ===== -->\n\n");

            echo ("<script><!--\n\n");

            echo ("  var arrInputTags = document.getElementsByTagName('input');\n\n");
            echo ("  var i = 0;\n");
            echo ("  var sFound = \"false\";\n");
            echo ("  var intLength = arrInputTags.length;\n");
            echo ("  while ((sFound == \"false\") && (i < intLength)) {\n");
            echo ("      if (arrInputTags[i].getAttribute(\"title\") == \" Add to Cart \") {\n");
            echo ("          sFound = \"true\";\n");
            echo ("      }\n");
            echo ("      if (sFound == \"false\") { i++ }\n");
            echo ("  }\n");

            echo ("  function geeAddToCart() {\n\n");

            echo ("      var myQuantity  = document.getElementsByName('cart_quantity')[1].value.valueOf();\n\n");

            echo ("      ga('ec:addProduct', {\n");
            echo ("          'id'      : '" . $_GET['products_id'] . "',\n");
            echo ("          'name'    : '" . addslashes($products_name) . "',\n");
            echo ("          'price'   : '" . zen_get_products_base_price((int)$_GET['products_id']) . "',\n");
            echo ("          'quantity':   myQuantity.valueOf()  \n");
            echo ("        });\n");
            echo ("      ga('ec:setAction', 'add');\n");
            echo ("      ga('send', 'event', 'UX', 'click', 'add to cart');     // Send data using an event.\n");
            echo ("  }\n\n");

            echo ("  if (sFound == \"true\") {\n");
            echo ("      arrInputTags[i].addEventListener(\"click\", geeAddToCart);\n");
            echo ("  }\n\n");

            echo ("--></script>\n\n");

            echo ("<script><!--\n");
            echo ("    ga('ec:addProduct', {\n");
            echo ("        'id': '" . $_GET['products_id'] . "', \n");
            echo ("        'name': '" . $products_name . "', \n");
            echo ("        'price': '" . zen_get_products_base_price((int)$_GET['products_id']) . "', \n");
            echo ("    });\n\n");

            echo ("    ga('ec:setAction', 'detail');\n\n");

            echo ("--></script>\n\n");
            break;

        /* **************************************************
         * FILENAME CHECKOUT CHIPPING
         * **************************************************/
        case FILENAME_CHECKOUT_SHIPPING:
            echo ("<!-- ===== Google Enhanced Ecommerce - Checkout Shipping ===== -->\n\n");

            echo ("<script><!--\n\n");

            $geeProducts   = $db->Execute("select products_id, final_price, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . $_SESSION[customer_id] . "'");

            while(!$geeProducts->EOF) {

                $category_query   = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $geeProducts->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
                $category_query   = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
                $category         = $db->Execute($category_query);

                switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
                    case 'universal':
                    default:
                        echo ("  ga('ec:addProduct', {\n");
                        echo ("    'id'       : '" .  $geeProducts->fields['products_id'] . "',\n");
                        echo ("    'name'     : '" .  addslashes(zen_get_products_name($geeProducts->fields['products_id'])) . "',\n");
                        echo ("    'category' : '" .  addslashes(zen_get_category_name(zen_get_products_category_id($geeProducts->fields['products_id']), (int)$_SESSION['languages_id'])) . "',\n");
                        echo ("    'price'    : '" .  number_format(zen_get_products_base_price($geeProducts->fields['products_id']), 2, '.', '') . "',\n");
                        echo ("    'quantity' : '" .  $geeProducts->fields['customers_basket_quantity'] . "'\n");
                        echo ("  });\n");
                    break;
                }
                $geeProducts->MoveNext();
            }
            echo ("  ga('ec:setAction','checkout', { 'step': 1 });\n\n");

            echo ("  var arrInputTags = document.getElementsByTagName('input');\n\n");
            echo ("  var i = 0;\n");
            echo ("  var sFound = \"false\";\n");
            echo ("  var intLength = arrInputTags.length;\n");
            echo ("  while ((sFound == \"false\") && (i < intLength)) {\n");
            echo ("      if (arrInputTags[i].getAttribute(\"title\") == \" Continue \") {\n");
            echo ("          sFound = \"true\";\n");
            echo ("      }\n");
            echo ("      if (sFound == \"false\") { i++ }\n");
            echo ("  }\n");

            echo ("  function geeShippingOption() {\n\n");
            echo ("      var iRadio         = 0;\n");
            echo ("      var sRadioFound    = \"false\";\n");
            echo ("      var intRadioLength = arrInputTags.length;\n");
            echo ("      while ((sRadioFound == \"false\") && (i < intRadioLength)) {\n");

            echo ("          if (arrInputTags[iRadio].getAttribute(\"name\") == \"shipping\") {\n");
            echo ("              if (arrInputTags[iRadio].checked) {\n");
            echo ("                  sRadioFound = \"true\";\n");
            echo ("              }\n");
            echo ("          }\n");

            echo ("          if (sRadioFound == \"false\") { iRadio++ }\n");
            echo ("      }\n\n");

            echo ("      if (sRadioFound == \"true\") {\n");
            echo ("          ga('ec:setAction', 'checkout_option', {\n");
            echo ("             'step'    : 1,\n");
            echo ("             'option'  : arrInputTags[iRadio].value\n");
            echo ("          });\n");
            echo ("      }\n");
            echo ("      ga('send', 'event', 'UX', 'Checkout', 'Shipping');     // Send data using an event.\n\n");

            echo ("  }\n\n");

            echo ("  if (sFound == \"true\") {\n");
            echo ("      arrInputTags[i].addEventListener(\"click\", geeShippingOption);\n");
            echo ("  }\n\n");


            echo ("--></script>\n\n");

            break;

        /* **************************************************
         * FILENAME CHECKOUT PAYMENT
         * **************************************************/
        case FILENAME_CHECKOUT_PAYMENT:

            echo ("<!-- ===== Google Enhanced Ecommerce - Checkout Payment ===== -->\n\n");

            echo ("<script><!--\n\n");

            $geeProducts   = $db->Execute("select products_id, final_price, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . $_SESSION[customer_id] . "'");

            while(!$geeProducts->EOF) {

                $category_query   = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $geeProducts->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
                $category_query   = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
                $category         = $db->Execute($category_query);

                switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
                    case 'universal':
                    default:
                        echo (  "ga('ec:addProduct', {\n");
                        echo ("    'id'       : '" .  $geeProducts->fields['products_id'] . "',\n");
                        echo ("    'name'     : '" .  addslashes(zen_get_products_name($geeProducts->fields['products_id'])) . "',\n");
                        echo ("    'category' : '" .  addslashes(zen_get_category_name(zen_get_products_category_id($geeProducts->fields['products_id']), (int)$_SESSION['languages_id'])) . "',\n");
                        echo ("    'price'    : '" .  number_format(zen_get_products_base_price($geeProducts->fields['products_id']), 2, '.', '') . "',\n");
                        echo ("    'quantity' : '" .  $geeProducts->fields['customers_basket_quantity'] . "'\n");
                        echo ("  });\n");
                    break;
                }
                $geeProducts->MoveNext();
            }
            echo ("  ga('ec:setAction','checkout', { 'step': 2 });\n\n");

            echo ("  var arrInputTags = document.getElementsByTagName('input');\n\n");
            echo ("  var i = 0;\n");
            echo ("  var sFound = \"false\";\n");
            echo ("  var intLength = arrInputTags.length;\n");
            echo ("  while ((sFound == \"false\") && (i < intLength)) {\n");
            echo ("      if (arrInputTags[i].getAttribute(\"title\") == \" Continue \") {\n");
            echo ("          sFound = \"true\";\n");
            echo ("      }\n");
            echo ("      if (sFound == \"false\") { i++ }\n");
            echo ("  }\n");

            echo ("  function geePaymentOption() {\n\n");
            echo ("      var iRadio         = 0;\n");
            echo ("      var sRadioFound    = \"false\";\n");
            echo ("      var intRadioLength = arrInputTags.length;\n");
            echo ("      while ((sRadioFound == \"false\") && (i < intRadioLength)) {\n");

            echo ("          if (arrInputTags[iRadio].getAttribute(\"name\") == \"payment\") {\n");
            echo ("              if (arrInputTags[iRadio].checked) {\n");
            echo ("                  sRadioFound = \"true\";\n");
            echo ("              }\n");
            echo ("          }\n");

            echo ("          if (sRadioFound == \"false\") { iRadio++ }\n");
            echo ("      }\n\n");

            echo ("      if (sRadioFound == \"true\") {\n");
            echo ("          ga('ec:setAction', 'checkout_option', {\n");
            echo ("             'step'    : 2,\n");
            echo ("             'option'  : arrInputTags[iRadio].value\n");
            echo ("          });\n");
            echo ("      }\n");
            echo ("      ga('send', 'event', 'UX', 'Checkout', 'Payment');     // Send data using an event.\n\n");

            echo ("  }\n\n");

            echo ("  if (sFound == \"true\") {\n");
            echo ("      arrInputTags[i].addEventListener(\"click\", geePaymentOption);\n");
            echo ("  }\n\n");


            echo ("--></script>\n\n");
            break;

        /* **************************************************
         * FILENAME CHECKOUT CONFIRMATION
         * **************************************************/
        case FILENAME_CHECKOUT_CONFIRMATION:

            echo ("<!-- ===== Google Enhanced Ecommerce - Checkout Confirmation ===== -->\n\n");

            echo ("<script><!--\n\n");

            $geeProducts   = $db->Execute("select products_id, final_price, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . $_SESSION[customer_id] . "'");

            while(!$geeProducts->EOF) {

                $category_query   = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $geeProducts->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
                $category_query   = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
                $category         = $db->Execute($category_query);

                switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
                    case 'universal':
                    default:
                        echo (  "ga('ec:addProduct', {\n");
                        echo ("    'id'       : '" .  $geeProducts->fields['products_id'] . "',\n");
                        echo ("    'name'     : '" .  addslashes(zen_get_products_name($geeProducts->fields['products_id'])) . "',\n");
                        echo ("    'category' : '" .  addslashes(zen_get_category_name(zen_get_products_category_id($geeProducts->fields['products_id']), (int)$_SESSION['languages_id'])) . "',\n");
                        echo ("    'price'    : '" .  number_format(zen_get_products_base_price($geeProducts->fields['products_id']), 2, '.', '') . "',\n");
                        echo ("    'quantity' : '" .  $geeProducts->fields['customers_basket_quantity'] . "'\n");
                        echo ("  });\n");
                    break;
                }
                $geeProducts->MoveNext();
            }
            echo ("  ga('ec:setAction','checkout', { 'step': 3 });\n\n");

            echo ("  var arrInputTags = document.getElementsByTagName('input');\n\n");
            echo ("  var i = 0;\n");
            echo ("  var sFound = \"false\";\n");
            echo ("  var intLength = arrInputTags.length;\n");
            echo ("  while ((sFound == \"false\") && (i < intLength)) {\n");
            echo ("      if (arrInputTags[i].getAttribute(\"title\") == \" Confirm Order \") {\n");
            echo ("          sFound = \"true\";\n");
            echo ("      }\n");
            echo ("      if (sFound == \"false\") { i++ }\n");
            echo ("  }\n");

            echo ("  function geeConfirmOrder() {\n\n");
            echo ("      ga('send', 'event', 'UX', 'Checkout', 'Confirm');     // Send data using an event.\n");
            echo ("  }\n\n");

            echo ("  if (sFound == \"true\") {\n");
            echo ("      arrInputTags[i].addEventListener(\"click\", geeConfirmOrder);\n");
            echo ("  }\n\n");

            echo ("--></script>\n\n");
            break;

        /* **************************************************
         * FILENAME CHECKOUT SUCCESS
         * **************************************************/
        case FILENAME_CHECKOUT_SUCCESS:

            echo ("<!-- ===== Google Enhanced Ecommerce - Checkout Success ===== -->\n\n");

            echo ("<script><!--\n");
            echo ("    ga('ec:setAction','checkout', { 'step': 4 });\n");
            echo ("    ga('send', 'event', 'UX', 'Checkout', 'Complete');     // Send data using an event.\n");
            echo ("--></script>\n\n");

            $geeOrder_query = "select orders_id, " . GOOGLE_ANALYTICS_TARGET . "_city as city, " . GOOGLE_ANALYTICS_TARGET . "_state as state, " . GOOGLE_ANALYTICS_TARGET . "_country as country from " . TABLE_ORDERS . " where customers_id = :customersID order by date_purchased desc limit 1";
            $geeOrder_query = $db->bindVars($geeOrder_query, ':customersID', $_SESSION['customer_id'], 'integer');
            $geeOrder = $db->Execute($geeOrder_query);

            $google_enhanced_ecommerce = array();

            $totals = $db->Execute("select value, class from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$geeOrder->fields['orders_id'] . "' and (class = 'ot_total' or class = 'ot_tax' or class = 'ot_shipping')");

            while(!$totals->EOF) {
                $google_analytics[$totals->fields['class']] = number_format($totals->fields['value'], 2, '.', '');
                $totals->MoveNext();
            }

            echo ("<script><!--\n\n");
            echo ("    ga('ec:setAction', 'purchase', {\n");
            echo ("       'id'          : '" . $geeOrder->fields['orders_id'] . "',\n");
            echo ("       'affiliation' : '" . GOOGLE_ANALYTICS_AFFILIATION . "',\n");
            echo ("       'revenue'     : '" . $google_analytics['ot_total'] . "',\n");
            echo ("       'tax'         : '" . $google_analytics['ot_tax'] . "',\n");
            echo ("       'shipping'    : '" . $google_analytics['ot_shipping'] . "',\n");
            echo ("    });\n\n");

            $geeProducts = $db->Execute("select products_id,  products_name, final_price, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $geeOrder->fields['orders_id'] . "'");

            while(!$geeProducts->EOF) {

                $category_query = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $geeProducts->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
                $category_query = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
                $category = $db->Execute($category_query);

                switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
                    case 'universal':
                    default:

                        echo ("    ga('ec:addProduct', {\n");
                        echo ("       'id'       : '" .  $geeProducts->fields['products_id'] . "',\n");
                        echo ("       'name'     : '" .  addslashes(zen_get_products_name($geeProducts->fields['products_id'])) . "',\n");
                        echo ("       'category' : '" .  addslashes(zen_get_category_name(zen_get_products_category_id($geeProducts->fields['products_id']), (int)$_SESSION['languages_id'])) . "',\n");
                        echo ("       'price'    : '" .  number_format($geeProducts->fields['final_price'], 2, '.', '') . "',\n");
                        echo ("       'quantity' : '" .  $geeProducts->fields['products_quantity'] . "'\n");
                        echo ("    });\n");

                    break;
                }
                $geeProducts->MoveNext();
            }

            echo ("--></script>\n\n");

            if (GOOGLE_CONVERSION_ACTIVE == "Yes") {

                if ($google_analytics['ot_total'] != "") {
                    $geeConversionValue = $google_analytics['ot_total'];
                } else {
                    $geeConversionValue = 0;
                }

                // If contains only one Conversion Label entered
                if ((strpos(GOOGLE_CONVERSION_IDNUM,',') == false) OR (strpos(GOOGLE_CONVERSION_LABEL,',') == false)) {
                    echo ("<!-- Google Code for ZenCart Google AdWords Conversion Page (Google Enhanced Ecommerce) -->\n");
                    echo ("<script><!--\n");
                    echo ("/* <![CDATA[ */\n");
                    echo ("var google_conversion_id = " . GOOGLE_CONVERSION_IDNUM . ";\n");
                    echo ("var google_conversion_language = \"" . GOOGLE_CONVERSION_LANG . "\";\n");
                    echo ("var google_conversion_format = \"3\";\n");
                    echo ("var google_conversion_color = \"ffffff\";\n");
                    echo ("var google_conversion_label = \"" . GOOGLE_CONVERSION_LABEL . "\";\n");
                    echo ("var google_conversion_value = " . $geeConversionValue . ";\n");
                    echo ("var google_conversion_currency = \"" . $_SESSION['currency'] . "\";\n");
                    echo ("var google_remarketing_only = false;\n");
                    echo ("/* ]]> */\n");
                    echo ("--></script>\n");
                    echo ("<script type=\"text/javascript\" src=\"//www.googleadservices.com/pagead/conversion.js\">\n");
                    echo ("</script>\n\n");
                    echo ("<noscript>\n");
                    echo ("<div style=\"display:inline;\">\n");
                    echo ("<img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"//www.googleadservices.com/pagead/conversion/" . GOOGLE_CONVERSION_IDNUM . "/?value=" . $geeConversionValue . "&amp;currency_code=" . $_SESSION['currency'] . "&amp;label=" . GOOGLE_CONVERSION_LABEL . "&amp;guid=ON&amp;script=0\"/>\n");
                    echo ("</div>\n");
                    echo ("</noscript>\n\n");
                }

                // If contains more than Conversion Label account entered
                else {
                    $GOOGLE_CONVERSION_IDNUM_ARRAY = explode(",", GOOGLE_CONVERSION_IDNUM);
                    //echo $GOOGLE_CONVERSION_IDNUM[0];
                    $GOOGLE_CONVERSION_LABEL_ARRAY = explode(",", GOOGLE_CONVERSION_LABEL);
                    //echo $GOOGLE_CONVERSION_IDNUM[0];

                    if (count($GOOGLE_CONVERSION_IDNUM_ARRAY) == count($GOOGLE_CONVERSION_LABEL_ARRAY)){
                    $y = 0;

                        while ($y != count($GOOGLE_CONVERSION_IDNUM_ARRAY)) {
                            $GOOGLE_CONVERSION_IDNUM_ARRAY[$y] = str_replace(' ','',$GOOGLE_CONVERSION_IDNUM_ARRAY[$y]);
                            $GOOGLE_CONVERSION_LABEL_ARRAY[$y] = str_replace(' ','',$GOOGLE_CONVERSION_LABEL_ARRAY[$y]);
                            echo ("<!-- Google Code for ZenCart Google AdWords Conversion Page (Google Enhanced Ecommerce) -->\n");
                            echo ("<script><!--\n");
                            echo ("/* <![CDATA[ */\n");
                            echo ("var google_conversion_id = " .  $GOOGLE_CONVERSION_IDNUM_ARRAY[$y] . ";\n");
                            echo ("var google_conversion_language = \"" . GOOGLE_CONVERSION_LANG . "\";\n");
                            echo ("var google_conversion_format = \"3\";\n");
                            echo ("var google_conversion_color = \"ffffff\";\n");
                            echo ("var google_conversion_label = \"" . $GOOGLE_CONVERSION_LABEL_ARRAY[$y] . "\";\n");
                            echo ("var google_conversion_value = " . $geeConversionValue . ";\n");
                            echo ("var google_conversion_currency = \"" . $_SESSION['currency'] . "\";\n");
                            echo ("var google_remarketing_only = false;\n");
                            echo ("/* ]]> */\n");
                            echo ("--></script>\n");
                            echo ("<script type=\"text/javascript\" src=\"//www.googleadservices.com/pagead/conversion.js\">\n");
                            echo ("</script>\n\n");
                            echo ("<noscript>\n");
                            echo ("<div style=\"display:inline;\">\n");
                            echo ("<img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"//www.googleadservices.com/pagead/conversion/" . $GOOGLE_CONVERSION_IDNUM_ARRAY[$y] . "/?value=" . $geeConversionValue . "&amp;currency_code=" . $_SESSION['currency'] . "&amp;label=" . $GOOGLE_CONVERSION_LABEL_ARRAY[$y] . "&amp;guid=ON&amp;script=0\"/>\n");
                            echo ("</div>\n");
                            echo ("</noscript>\n\n");
                            $y++;
                        }

                    }

                }

            }

            break;

        default:
            break;
    }

    if ((GOOGLE_CONVERSION_ACTIVE == "Yes") && ($_GET['main_page'] != FILENAME_CHECKOUT_SUCCESS)) {
        echo ("<!-- Google Code for ZenCart Google AdWords Remarketing (Google Enhanced Ecommerce) -->\n");

        if ((strpos(GOOGLE_CONVERSION_IDNUM,',') == false) OR (strpos(GOOGLE_CONVERSION_LABEL,',') == false)) {
            echo ("<!-- Google Code for ZenCart Google AdWords Remarketing (Google Enhanced Ecommerce) -->\n");
            echo ("<script type=\"text/javascript\"><!-- \n");
            echo ("/* <![CDATA[ */\n");
            echo ("var google_conversion_id = " . GOOGLE_CONVERSION_IDNUM . ";\n");
            echo ("var google_custom_params = window.google_tag_params;\n");
            echo ("var google_remarketing_only = true;\n");
            echo ("/* ]]> */\n");
            echo ("--></script>\n");
            echo ("<script type=\"text/javascript\" src=\"//www.googleadservices.com/pagead/conversion.js\">\n");
            echo ("</script>\n\n");
            echo ("<noscript><!--//\n");
            echo ("<div style=\"display:inline;\">\n");
            echo ("<img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"//googleads.g.doubleclick.net/pagead/viewthroughconversion/" . GOOGLE_CONVERSION_IDNUM . "/?value=0&guid=ON&script=0\"/>\n");
            echo ("</div>\n");
            echo ("--></noscript>\n\n");
        }

        else {
            $GOOGLE_CONVERSION_IDNUM_ARRAY = explode(",", GOOGLE_CONVERSION_IDNUM);
            $y = 0;
            while ($y != count($GOOGLE_CONVERSION_IDNUM_ARRAY)) {
                $GOOGLE_CONVERSION_IDNUM_ARRAY[$y] = str_replace(' ','',$GOOGLE_CONVERSION_IDNUM_ARRAY[$y]);
                echo ("<script type=\"text/javascript\"><!-- \n");
                echo ("/* <![CDATA[ */\n");
                echo ("var google_conversion_id = " . $GOOGLE_CONVERSION_IDNUM_ARRAY[$y] . ";\n");
                echo ("var google_custom_params = window.google_tag_params;\n");
                echo ("var google_remarketing_only = true;\n");
                echo ("/* ]]> */\n");
                echo ("--></script>\n");
                echo ("<script type=\"text/javascript\" src=\"//www.googleadservices.com/pagead/conversion.js\">\n");
                echo ("</script>\n\n");
                echo ("<noscript><!--//\n");
                echo ("<div style=\"display:inline;\">\n");
                echo ("<img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"//googleads.g.doubleclick.net/pagead/viewthroughconversion/" . $GOOGLE_CONVERSION_IDNUM_ARRAY[$y] . "/?value=0&guid=ON&script=0\"/>\n");
                echo ("</div>\n");
                echo ("--></noscript>\n\n");
                $y++;
            }

        }

    }
    
}
