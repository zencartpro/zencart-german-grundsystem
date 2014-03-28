<?php
/**
 * @package Google Analytics
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * Portions Copyright (c) 2003 osCommerce 
 * Portions Copyright (c) 2005-2006 Andrew Berezin	
 * Portions Copyright (c) 2006 Dayne Larsen	
 * Portions Copyright (c) 2007-2010 Eric Leuenberger	
 * Portions Copyright (c) 2013 Numinix
 * @version $Id: google_analytics.php 2014-03-12 07:45:57Z webchills $
 */

if ($request_type == 'NONSSL') {
	$google_conversion_url 			= "http://www.googleadservices.com/pagead/conversion.js";
	$google_conversion_image_url 	= "http://www.googleadservices.com/pagead/conversion/";
} else {
	$google_conversion_url 			= "https://www.googleadservices.com/pagead/conversion.js";
	$google_conversion_image_url 	= "https://www.googleadservices.com/pagead/conversion/";	
}

switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
	case 'ga.js':
?>
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
  </script>
  <script type="text/javascript">
		var pageTracker = _gat._getTracker("<?php echo GOOGLE_ANALYTICS_UACCT ?>");
<?php			
			if (GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED == 'Enable') {
				echo GOOGLE_ANALYTICS_CUSTOM_CODE;	
			}			
?>	
		pageTracker._trackPageview();
<?php
	break;
	case 'ga.js asynchronous':
?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount'], '<?php echo GOOGLE_ANALYTICS_UACCT ?>']);
			<?php
				if (GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED == 'Enable') {
					echo GOOGLE_ANALYTICS_CUSTOM_CODE;	
				}
			?>
			_gaq.push(['_trackPageview']);
			_gaq.push(['_trackPageLoadTime']);
			<?php
				if ($page_directory == 'includes/modules/pages/checkout_success') {
					// Do not close script as we still need to add transaction details.	
				} else {
					?>
						(function() {
							var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
							ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
						})();	
					<?php
				}
			?>
<?php	
	break;
	case 'universal': 
	default:
?>
			<!-- Google Analytics -->
			<script type="text/javascript">
			(function(i,s,o,g,r,a,m) {i['GoogleAnalyticsObject']=r;i[r]=i[r]||function() {
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			<?php 
				if (GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED == 'Enable') {
					echo GOOGLE_ANALYTICS_CUSTOM_CODE;	
				} 
			?>
			ga('create', '<?php echo GOOGLE_ANALYTICS_UACCT ?>', 'auto'); 
			ga('send', 'pageview');
<?php
}
if ($_GET['main_page'] != FILENAME_CHECKOUT_SUCCESS) {
?> 
	</script> 
<?php
} else {
	$order_query = "select orders_id, " . GOOGLE_ANALYTICS_TARGET . "_city as city, " . GOOGLE_ANALYTICS_TARGET . "_state as state, " . GOOGLE_ANALYTICS_TARGET . "_country as country from " . TABLE_ORDERS . " where customers_id = :customersID order by date_purchased desc limit 1";
	$order_query = $db->bindVars($order_query, ':customersID', $_SESSION['customer_id'], 'integer');	
	$order = $db->Execute($order_query);
	
	$google_analytics = array();
	
	$totals = $db->Execute("select value, class from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order->fields['orders_id'] . "' and (class = 'ot_total' or class = 'ot_tax' or class = 'ot_shipping')");
	
	while(!$totals->EOF) {
		$google_analytics[$totals->fields['class']] = number_format($totals->fields['value'], 2, '.', '');	
		$totals->MoveNext();
	}
	
	switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
		case 'ga.js': 
?>
	  pageTracker._addTrans(
	    "<?php echo $order->fields['orders_id'] ?>",
	    "<?php echo GOOGLE_ANALYTICS_AFFILIATION ?>",
	    "<?php echo $google_analytics['ot_total'] ?>",
	    "<?php echo $google_analytics['ot_tax'] ?>",
	    "<?php echo $google_analytics['ot_shipping'] ?>",
	    "<?php echo $order->fields['city'] ?>",
	    "<?php echo $order->fields['state'] ?>",
	    "<?php echo $order->fields['country'] ?>"
	  );   
<?php 
		break;
		case 'ga.js asynchronous':
?>
    _gaq.push(['_addTrans',
			"<?php echo $order->fields['orders_id'] ?>",
			"<?php echo GOOGLE_ANALYTICS_AFFILIATION ?>",
			"<?php echo $google_analytics['ot_total'] ?>",
			"<?php echo $google_analytics['ot_tax'] ?>",
			"<?php echo $google_analytics['ot_shipping'] ?>",
			"<?php echo $order->fields['city'] ?>",
			"<?php echo $order->fields['state'] ?>",
			"<?php echo $order->fields['country'] ?>"
		]);            	
<?php
		break;
		case 'universal': default:
?>
		ga('require', 'ecommerce', 'ecommerce.js');
		ga('ecommerce:addTransaction', {
			"id": 			"<?php echo $order->fields['orders_id'] ?>",
			"affiliation": 	"<?php echo GOOGLE_ANALYTICS_AFFILIATION ?>",
			"revenue":		"<?php echo $google_analytics['ot_total'] ?>",
			"tax":			"<?php echo $google_analytics['ot_tax'] ?>",
			"shipping":		"<?php echo $google_analytics['ot_shipping'] ?>"
		});
<?php
		break;
	}
	$products = $db->Execute("select products_id, " . GOOGLE_ANALYTICS_SKU_CODE . " as skucode, products_name, final_price, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $order->fields['orders_id'] . "'");
	$items = "";
	while(!$products->EOF) {
		$category_query = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $products->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
		$category_query = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
		$category = $db->Execute($category_query);
		switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
			case 'ga.js':
?>
    pageTracker._addItem(                
			"<?php echo $order->fields['orders_id'] ?>",
			"<?php echo addslashes($products->fields['skucode']) ?>",
			"<?php echo addslashes($products->fields['products_name']) ?>",
			"<?php echo addslashes($products->fields['categories_name']) ?>",
			"<?php echo number_format($products->fields['final_price'], 2, '.', '') ?>",
			"<?php echo $products->fields['products_quantity'] ?>"                
    );
<?php
			break;
			case 'ga.js asynchronous':
?>
    _gaq.push(['_addItem',                 
			"<?php echo $order->fields['orders_id'] ?>",
			"<?php echo addslashes($products->fields['skucode']) ?>",
			"<?php echo addslashes($products->fields['products_name']) ?>",
			"<?php echo addslashes($products->fields['categories_name']) ?>",
			"<?php echo number_format($products->fields['final_price'], 2, '.', '') ?>",
			"<?php echo $products->fields['products_quantity'] ?>"                
    ]);          
<?php
			break;
			case 'universal': 
			default:
?>
		ga('ecommerce:addItem', {
			"id": 				"<?php echo $order->fields['orders_id'] ?>",
			"name":				"<?php echo addslashes($products->fields['products_name']) ?>",
			"sku":				"<?php echo addslashes($products->fields['skucode']) ?>",
			"category":		"<?php echo addslashes($products->fields['categories_name']) ?>",
			"price":			"<?php echo number_format($products->fields['final_price'], 2, '.', '') ?>",
			"quantity":		"<?php echo $products->fields['products_quantity'] ?>"                     
		});
<?php
			break;				
		}
		$products->MoveNext();
	}
	switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
		case 'ga.js':
	?>
	  pageTracker._trackTrans();    
<?php
		break;
		case 'ga.js asynchronous':
?>
		_gaq.push(['_trackTrans']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();	
<?php
		break;
		case 'universal': 
		default:
?>
		ga('ecommerce:send');
<?php
		break;
	}
?> 
	</script> 
<?php
	if (GOOGLE_CONVERSION_ACTIVE == "Yes") { 
?>
	<!-- Google Code for purchase Conversion Page -->
	<script type="text/javascript">
		var google_conversion_id 				=  <?php echo GOOGLE_CONVERSION_IDNUM ?>;
		var google_conversion_language 	= "<?php echo GOOGLE_CONVERSION_LANG  ?>";
		var google_conversion_format 		= "1";
		var google_conversion_color 		= "FFFFFF";
<?php
	if ($google_analytics['ot_total'] != "") {
	?>
	if (<?php echo  $google_analytics['ot_total'] ?>) {
		var google_conversion_value = <?php echo $google_analytics['ot_total'] ?>;	
	} else {
		var google_conversion_value = 1.0;	
	}
<?php	
	} else {
		echo 'var google_conversion_value = 1.0;';
	}
?>
		var google_conversion_label = "<?php echo (GOOGLE_CONVERSION_LABEL != '' ? GOOGLE_CONVERSION_LABEL : 'purchase'); ?>";
	</script>
	<script src="<?php echo $google_conversion_url ?>"></script>
	<noscript>
		<?php
			$gen_img_url = $google_conversion_image_url . GOOGLE_CONVERSION_IDNUM . '/?value=' . (($google_analytics['ot_total'] != "") ? $google_analytics['ot_total'] : "1")						
		?>
		<img height="1" width="1" border="0" src="<?php echo $gen_img_url ?>&label=<?php echo (GOOGLE_CONVERSION_LABEL != '' ? GOOGLE_CONVERSION_LABEL : 'purchase'); ?>&script=0"/>
	</noscript>
<?php 
	}
}