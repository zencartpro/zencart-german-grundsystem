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
// 2011-09-17 webchills
define('VERSION', 'Version: 1.4');
if ($request_type == 'NONSSL') {
	$google_analytics_url = "http://www.google-analytics.com/urchin.js"; // used only for old urchin tracking code. new tracking code auto detects protocol
	$google_conversion_url = "http://www.googleadservices.com/pagead/conversion.js";
	$google_conversion_image_url = "http://www.googleadservices.com/pagead/conversion/";
} else {
	$google_analytics_url = "https://ssl.google-analytics.com/urchin.js"; // used only for old urchin tracking code. new tracking code auto detects protocol
	$google_conversion_url = "https://www.googleadservices.com/pagead/conversion.js";
	$google_conversion_image_url = "https://www.googleadservices.com/pagead/conversion/";
	
}

//The following elements will be used in a later release of Simple Google Analytics
//Additional tracking elements for Google Analytics (Optional Parameters)
//Track Virtual URL (change the URI that appears in your reports)
//echo "pageTracker._trackPageview(\"" . GOOGLE_ANALYTICS_URI . "\");"; //If this is present, it REPLACES the default code of "pageTracker._trackPageview();

//Tracking Downloaded files
//<a href="mydoc.pdf" onclick="pageTracker._trackPageview('/mydoc.pdf');">Download a PDF</a> // Example link URL

//Tracking a single page in multiple GA accounts
/*
echo "<script type=\"text/javascript\">
var firstTracker = _gat._getTracker(\"" . GOOGLE_ANALYTICS_UACCT1 . "\");
firstTracker._initData();
firstTracker._trackPageview();
var secondTracker = _gat._getTracker(\"" . GOOGLE_ANALYTICS_UACCT2 . "\");
secondTracker._initData();
secondTracker._trackPageview();
</script>
";
*/

//Tracking Subdomains
//echo "pageTracker._setDomainName(\"" . GOOGLE_ANALYTICS_SUBDOMAIN . "\");"; //see example to the rigbht ------> pageTracker._setDomainName("example.com");

//***********************************************************************
If (GOOGLE_ANALYTICS_TRACKING_TYPE == "Urchin") { // Use Original Urchin Tracking Code
//***************************Old tracking code using "urchin.js"******************************
echo '<script src="' . $google_analytics_url . '" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "' . GOOGLE_ANALYTICS_UACCT . '";
urchinTracker();
</script>';
//********************************************************************************************
} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "ga.js") { // Default to new GA.js Tracking Code
//*****************************New ga.js Tracking Code****************************************
echo "<script type=\"text/javascript\">
var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
</script>
<script type=\"text/javascript\">
var pageTracker = _gat._getTracker(\"" . GOOGLE_ANALYTICS_UACCT . "\");
pageTracker._initData();
";
if (GOOGLE_ANALYTICS_CUSTOM_AFTER == 'Enable') { //custom tracking code should be added so add it.
	echo GOOGLE_ANALYTICS_AFTER_CODE;
} // end if for adding any addiitonal custom tracking code
echo "
pageTracker._trackPageview();
";
	if($page_directory == 'includes/modules/pages/checkout_success') {
	// Do not close script because it is closed at the end of the transaction tracking section
	} else {
	// Close script as this is just a normal tracking script
	echo "</script>";
	};
//********************************************************************************************
} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "Asynchronous") { // Default to asyncronus Tracking Code
//*****************************Async Tracking Code****************************************

echo "<script type=\"text/javascript\">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '" . GOOGLE_ANALYTICS_UACCT . "']);
  ";
if (GOOGLE_ANALYTICS_CUSTOM_AFTER == 'Enable') { //custom tracking code should be added so add it.
	echo GOOGLE_ANALYTICS_AFTER_CODE;
} // end if for adding any additonal custom tracking code
echo "
  _gaq.push(['_trackPageview']);
  ";
/*
echo "
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
";
*/
	if($page_directory == 'includes/modules/pages/checkout_success') {
	// Do not close script because it is closed at the end of the transaction tracking section
	} else {
	// Close script as this is just a normal tracking script
echo "
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
";
	echo "</script>";
	};
//********************************************************************************************
} // End if to determine whether to use new ga.js tracking or older urchin.js tracking

//check to see if current page is checkout_success and include google analytics for order if it is
if($page_directory == 'includes/modules/pages/checkout_success')
{

$order_query = "select orders_id, " . GOOGLE_ANALYTICS_TARGET . "_city as city, " . GOOGLE_ANALYTICS_TARGET . "_state as state, " . GOOGLE_ANALYTICS_TARGET . "_country as country from " . TABLE_ORDERS . " where customers_id = :customersID order by date_purchased desc limit 1";
$order_query = $db->bindVars($order_query, ':customersID', $_SESSION['customer_id'], 'integer');
$order = $db->Execute($order_query);

$google_analytics = array();

$totals = $db->Execute("select value, class from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order->fields['orders_id'] . "'  and (class = 'ot_total' or class = 'ot_tax' or class = 'ot_shipping')");
while (!$totals->EOF) {
	$google_analytics[$totals->fields['class']] = number_format($totals->fields['value'], 2, '.', '');
	$totals->MoveNext();
}
If (GOOGLE_ANALYTICS_TRACKING_TYPE == "Urchin") {
//UTM:T|[order-id]|[affiliation]|[total]|[tax]|[shipping]|[city]|[state]|[country]
$transaction = 'UTM:T|' . $order->fields['orders_id'] . '|' . GOOGLE_ANALYTICS_AFFILIATION . '|' . $google_analytics['ot_total'] . '|' . $google_analytics['ot_tax'] . '|' . $google_analytics['ot_shipping'] . '|' . $order->fields['city'] . '|' . $order->fields['state'] . '|' . $order->fields['country'];

} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "ga.js") { // Default to new ga.js tracking
echo "
pageTracker._addTrans(
\"" . $order->fields['orders_id'] . "\",
\"". GOOGLE_ANALYTICS_AFFILIATION ."\",
\"". $google_analytics['ot_total'] ."\",
\"". $google_analytics['ot_tax'] ."\",
\"". $google_analytics['ot_shipping'] ."\",
\"". $order->fields['city'] ."\",
\"". $order->fields['state'] ."\",
\"". $order->fields['country']."\"
);
";

} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "Asynchronous") { //Use Async Tracking

echo "
_gaq.push(['_addTrans',
\"" . $order->fields['orders_id'] . "\",
\"". GOOGLE_ANALYTICS_AFFILIATION ."\",
\"". $google_analytics['ot_total'] ."\",
\"". $google_analytics['ot_tax'] ."\",
\"". $google_analytics['ot_shipping'] ."\",
\"". $order->fields['city'] ."\",
\"". $order->fields['state'] ."\",
\"". $order->fields['country']."\"
]);
";

} // End if to determine which tracking code should be used.

$products = $db->Execute("select products_id, " . GOOGLE_ANALYTICS_SKUCODE . " as skucode, products_name, final_price, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $order->fields['orders_id'] . "'");
$items = "";
while (!$products->EOF) {
	$category_query = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $products->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
	$category_query = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
	$category = $db->Execute($category_query);
If (GOOGLE_ANALYTICS_TRACKING_TYPE == "Urchin") {
// UTM:I|[order-id]|[sku/code]|[productname]|[category]|[price]|[quantity]
	$items .= ' UTM:I|' . $order->fields['orders_id'] . '|' . $products->fields['skucode'] . '|' . $products->fields['products_name'] . '|' . $category->fields['categories_name'] . '|' . number_format($products->fields['final_price'], 2, '.', '') . '|' . $products->fields['products_quantity'];

} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "ga.js") { // New ga.js tracking code should be used

echo "
pageTracker._addItem(
\"". $order->fields['orders_id'] ."\",
\"". $products->fields['skucode'] ."\",
\"". $products->fields['products_name'] ."\",
\"". $category->fields['categories_name'] ."\",
\"". number_format($products->fields['final_price'], 2, '.', '') ."\",
\"". $products->fields['products_quantity'] . "\"
);
";

} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "Asynchronous") { // Asynchronous tracking code should be used

echo "
_gaq.push(['_addItem',
\"". $order->fields['orders_id'] ."\",
\"". $products->fields['skucode'] ."\",
\"". $products->fields['products_name'] ."\",
\"". $category->fields['categories_name'] ."\",
\"". number_format($products->fields['final_price'], 2, '.', '') ."\",
\"". $products->fields['products_quantity'] . "\"
]);
";

} // End if to determine if new tracking code or previous "urchin" code is used.

	$products->MoveNext();
}
If (GOOGLE_ANALYTICS_TRACKING_TYPE == "Urchin") {
//echo transaction data (OLD "urchin.js" code. not used in new ga.js version)
//echo '<body onLoad="javascript:__utmSetTrans()">';
echo '<form style="display:none;" name="utmform">
<textarea id="utmtrans">' 
. addslashes($transaction) . ' ' 
. addslashes(trim($items))
. '</textarea>
</form>';
echo '<script type="text/javascript">
__utmSetTrans();
</script>"';
} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "ga.js") { // Use new ga.js tracking code
echo "pageTracker._trackTrans();";
echo "</script>";
} elseif (GOOGLE_ANALYTICS_TRACKING_TYPE == "Asynchronous") { // Use Async tracking 
echo "_gaq.push(['_trackTrans']);";
echo "
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
";
echo "</script>";
} // End if to determine which tracking code to use.


If (GOOGLE_ANALYTICS_CONVERSION_ACTIVE == "Yes") { // Adwords Conversion Tracking is enabled and should be tracked
echo '<!-- Google Code for purchase Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = ' . GOOGLE_ANALYTICS_CONVERSION_IDNUM . ';
var google_conversion_language = "' . GOOGLE_ANALYTICS_CONVERSION_LANG . '";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";';
if ($google_analytics['ot_total'] != "") { // Order total is not blank. Used to track actual revenue amounts.
	echo '
	if (' . $google_analytics['ot_total'] .') {
	  var google_conversion_value = ' . $google_analytics['ot_total'] .';
	}
	';
} else { 
	echo '
	if (1.0) {
		var google_conversion_value = 1.0;
	}
	';
} // End if
echo 'var google_conversion_label = "purchase";
//-->
</script>
<script language="JavaScript" src="' . $google_conversion_url . '">
</script>
<noscript>
<img height=1 width=1 border=0 src="' . $google_conversion_image_url . '' . GOOGLE_ANALYTICS_CONVERSION_IDNUM . '/?value=';
if ($google_analytics['ot_total'] !="") { echo $google_analytics['ot_total']; } else { echo "1"; }
echo '&label=purchase&script=0">
</noscript>';
} // End if to determine whether Conversion Tracking should be enabled or not.
} // End if to determine if this is the checkout success page.
?>
