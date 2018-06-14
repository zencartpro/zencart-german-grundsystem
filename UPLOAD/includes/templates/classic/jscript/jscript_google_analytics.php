<?php
/* Begin Easy Google Analytics */
if(GOOGLE_ANALYTICS_ENABLED == "Enabled"){
    switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
        case 'ga.js':
?>
    <script type="text/javascript"><!--//

    <?php
    if( GADIR == 'Enabled' ){ ?>
        var gaJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
        document.write(unescape("%3Cscript src='" + gaJsHost + "stats.g.doubleclick.net/dc.js' type='text/javascript'%3E%3C/script%3E"));
    <?php }    else { ?>
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    <?php }    ?>
  //--></script>
  <script type="text/javascript"><!--//
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
        <script type="text/javascript"><!--//
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo GOOGLE_ANALYTICS_UACCT ?>']);
            <?php
                if (GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED == 'Enable') {
                    echo GOOGLE_ANALYTICS_CUSTOM_CODE;
                }
            ?>
            _gaq.push(['_trackPageview']);
            _gaq.push(['_trackPageLoadTime']);
            <?php
                if ($_GET['main_page'] == FILENAME_CHECKOUT_SUCCESS) {
                    // Do not close script as we still need to add transaction details.
                } else {
                    ?>
                        (function() {
                            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                            <?php
                            if( GADIR == 'Enabled' ){ ?>
                                ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
                            <?php }    else { ?>
                                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                            <?php }    ?>
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
            <script type="text/javascript"><!--//
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
            <?php
            if( GADIR == 'Enabled' ){ ?>
    			ga('require', 'displayfeatures');
			<?php }	?>
			ga('send', 'pageview');
<?php
    }
    if ($_GET['main_page'] != FILENAME_CHECKOUT_SUCCESS) {
?>
    //--></script>
<?php
    } else {
        $order_query = "select orders_id, " . GOOGLE_ANALYTICS_TARGET . "_city as city, " . GOOGLE_ANALYTICS_TARGET . "_state as state, " . GOOGLE_ANALYTICS_TARGET . "_country as country from " . TABLE_ORDERS . " where customers_id = :customersID order by date_purchased desc limit 1";
        $order_query = $db->bindVars($order_query, ':customersID', $_SESSION['customer_id'], 'integer');
        $ga_order = $db->Execute($order_query);

        $google_analytics = array();

        $totals = $db->Execute("select value, class from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$ga_order->fields['orders_id'] . "' and (class = 'ot_total' or class = 'ot_tax' or class = 'ot_shipping')");

        while(!$totals->EOF) {
            $google_analytics[$totals->fields['class']] = number_format($totals->fields['value'], 2, '.', '');
            $totals->MoveNext();
        }

        switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
            case 'ga.js':
?>
      pageTracker._addTrans(
        "<?php echo $ga_order->fields['orders_id']; ?>",
        "<?php echo GOOGLE_ANALYTICS_AFFILIATION; ?>",
        "<?php echo $google_analytics['ot_total']; ?>",
        "<?php echo $google_analytics['ot_tax']; ?>",
        "<?php echo $google_analytics['ot_shipping']; ?>",
        "<?php echo $ga_order->fields['city']; ?>",
        "<?php echo $ga_order->fields['state']; ?>",
        "<?php echo $ga_order->fields['country']; ?>"
      );
<?php
        break;
        case 'ga.js asynchronous':
?>
    _gaq.push(['_addTrans',
            "<?php echo $ga_order->fields['orders_id']; ?>",
            "<?php echo GOOGLE_ANALYTICS_AFFILIATION; ?>",
            "<?php echo $google_analytics['ot_total']; ?>",
            "<?php echo $google_analytics['ot_tax']; ?>",
            "<?php echo $google_analytics['ot_shipping']; ?>",
            "<?php echo $ga_order->fields['city']; ?>",
            "<?php echo $ga_order->fields['state']; ?>",
            "<?php echo $ga_order->fields['country']; ?>"
        ]);
<?php
        break;
        case 'universal': default:
?>
		ga('require', 'ecommerce', 'ecommerce.js');
		ga('ecommerce:addTransaction', {
			"id": 			"<?php echo $ga_order->fields['orders_id']; ?>",
			"affiliation": 	"<?php echo GOOGLE_ANALYTICS_AFFILIATION; ?>",
			"revenue":		"<?php echo $google_analytics['ot_total']; ?>",
			"tax":			"<?php echo $google_analytics['ot_tax']; ?>",
			"shipping":		"<?php echo $google_analytics['ot_shipping']; ?>"
		});
<?php
		    break;
	    }
	    $products = $db->Execute("select products_id, " . (defined('GOOGLE_ANALYTICS_SKU_CODE') ?  GOOGLE_ANALYTICS_SKU_CODE : 'products_id') . " as skucode, products_name, final_price, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $ga_order->fields['orders_id'] . "'");
	    $items = "";
	    while(!$products->EOF) {
		    $category_query = "select cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on (cd.categories_id = p2c.categories_id) where p2c.products_id = '" . $products->fields['products_id'] . "' and cd.language_id = :languagesID limit 1";
		    $category_query = $db->bindVars($category_query, ':languagesID', $_SESSION['languages_id'], 'integer');
		    $category = $db->Execute($category_query);
		    switch(GOOGLE_ANALYTICS_TRACKING_TYPE) {
			    case 'ga.js':
?>
    pageTracker._addItem(
			"<?php echo $ga_order->fields['orders_id']; ?>",
			"<?php echo addslashes($products->fields['skucode']); ?>",
			"<?php echo addslashes($products->fields['products_name']); ?>",
			"<?php echo addslashes($products->fields['categories_name']); ?>",
			"<?php echo number_format($products->fields['final_price'], 2, '.', ''); ?>",
			"<?php echo $products->fields['products_quantity']; ?>"
    );
<?php
			    break;
			    case 'ga.js asynchronous':
?>
    _gaq.push(['_addItem',
			"<?php echo $ga_order->fields['orders_id']; ?>",
			"<?php echo addslashes($products->fields['skucode']); ?>",
			"<?php echo addslashes($products->fields['products_name']); ?>",
			"<?php echo addslashes($category->fields['categories_name']); ?>",
			"<?php echo number_format($products->fields['final_price'], 2, '.', ''); ?>",
			"<?php echo $products->fields['products_quantity']; ?>"
    ]);
<?php
			    break;
			    case 'universal':
			    default:
?>
		ga('ecommerce:addItem', {
			"id": 				"<?php echo $ga_order->fields['orders_id']; ?>",
			"name":				"<?php echo addslashes($products->fields['products_name']); ?>",
			"sku":				"<?php echo addslashes($products->fields['skucode']); ?>",
			"category":		"<?php echo addslashes($category->fields['categories_name']); ?>",
			"price":			"<?php echo number_format($products->fields['final_price'], 2, '.', ''); ?>",
			"quantity":		"<?php echo $products->fields['products_quantity']; ?>"
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
			<?php
			if( GADIR == 'Enabled' ){ ?>
				ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
			<?php }	else { ?>
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			<?php }	?>
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
	//--></script>
<?php
    }
}
?>