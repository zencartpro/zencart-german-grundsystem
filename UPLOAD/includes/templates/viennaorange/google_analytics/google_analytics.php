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
 * Portions Copyright (c) 2013-2014 Numinix
 * @version $Id: google_analytics.php 2014-08-07 12:45:57Z webchills $
 */

if (GOOGLE_CONVERSION_ACTIVE == "Yes" && GOOGLE_ANALYTICS_ENABLED == "Enabled" && $_GET['main_page'] == FILENAME_CHECKOUT_SUCCESS) {
    if ($request_type == 'NONSSL') {
        $google_conversion_url             = "http://www.googleadservices.com/pagead/conversion.js";
        $google_conversion_image_url     = "http://www.googleadservices.com/pagead/conversion/";
    } else {
        $google_conversion_url             = "https://www.googleadservices.com/pagead/conversion.js";
        $google_conversion_image_url     = "https://www.googleadservices.com/pagead/conversion/";
    }
?>
	<!-- Google Code for purchase Conversion Page -->
	<script type="text/javascript">
		var google_conversion_id 				=  <?php echo GOOGLE_CONVERSION_IDNUM; ?>;
		var google_conversion_language 	= "<?php echo GOOGLE_CONVERSION_LANG;  ?>";
		var google_conversion_format 		= "1";
		var google_conversion_color 		= "FFFFFF";
<?php
	if ($google_analytics['ot_total'] != "") {
?>
	if (<?php echo $google_analytics['ot_total']; ?>) {
		var google_conversion_value = <?php echo $google_analytics['ot_total']; ?>;
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
	<script src="<?php echo $google_conversion_url; ?>"></script>
	<noscript>
		<?php
			$gen_img_url = $google_conversion_image_url . GOOGLE_CONVERSION_IDNUM . '/?value=' . (($google_analytics['ot_total'] != "") ? $google_analytics['ot_total'] : "1")
		?>
		<img height="1" width="1" border="0" src="<?php echo $gen_img_url; ?>&label=<?php echo (GOOGLE_CONVERSION_LABEL != '' ? GOOGLE_CONVERSION_LABEL : 'purchase'); ?>&script=0"/>
	</noscript>
<?php
}
?>