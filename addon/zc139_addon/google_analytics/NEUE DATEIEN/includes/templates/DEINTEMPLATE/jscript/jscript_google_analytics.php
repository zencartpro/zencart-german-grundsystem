<?php
/* Begin Simple Google Analytics */
  if (in_array($current_page_base,explode(",",'popup_image,popup_image_additional,popup_cvv_help,popup_coupon_help,popup_attributes_qty_prices,popup_search_help,popup_shipping_estimator,popup_print_invoice')) ) {
	//Skip outputting the tracking code as this is a pop-up window
  } else { // Print tracking code to page
	if (GOOGLE_ANALYTICS_TRACKING_TYPE == "Asynchronous") {
	require(DIR_WS_TEMPLATE . 'google_analytics/google_analytics.php');
	}
  } // end if for page determination
/* End Simple Google Analytics */
?>