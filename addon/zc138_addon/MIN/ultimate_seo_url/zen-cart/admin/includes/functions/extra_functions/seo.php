<?php
// Function to reset SEO URLs database cache entries 
// Ultimate SEO URLs v2.1
function zen_reset_cache_data_seo_urls($action) {
	switch ($action){
		case 'reset':
			$GLOBALS['db']->Execute("DELETE FROM " . TABLE_SEO_CACHE . " WHERE cache_name LIKE '%seo_urls%'");
			$GLOBALS['db']->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='false' WHERE configuration_key='SEO_URLS_CACHE_RESET'");
			break;
		default:
			break;
	}
	# The return value is used to set the value upon viewing
	# It's NOT returining a false to indicate failure!!
	return 'false';
}
?>