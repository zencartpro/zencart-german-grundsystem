<?php
// Function to reset SEO URLs database cache entries
function usu_reset_cache_data($action) {
	global $db;
	switch($action){
		case 'false':
			// Do nothing
			break;
		case 'true':
			// Update the value to false to disable
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => 'false'), 'update', '`configuration_key`=\'SEO_URLS_CACHE_RESET\'');

		default:
			// Reset the cache
			$db->Execute("DELETE FROM " . TABLE_SEO_CACHE . " WHERE cache_name LIKE '%seo_urls%'");

	}
	// The return value is used to set the value upon viewing
	// It's NOT returining a false to indicate failure!!
	return 'false';
}

// Function to check the category directory format
function usu_check_cpath_option($action) {
	switch($action) {
		case 'disable':
			$action = 'off';
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_URL_CPATH\'');
			usu_reset_cache_data('true');
			break;

		case 'enable-auto':
			$action = substr($action, 7);
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_URL_CPATH\'');
			usu_reset_cache_data('true');

		default:
	}

	return $action;
}

// Function to check the URL format
function usu_check_url_format_option($action) {
	switch($action) {
		case 'enable-parent':
			if(SEO_URL_CATEGORY_DIR == 'full') {
				zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => 'short'), 'update', '`configuration_key`=\'SEO_URL_CATEGORY_DIR\'');
				echo '<div><span class="alert">' . sprintf(SEO_CONFIG_ADJUSTED, SEO_URL_FORMAT_TITLE, SEO_URL_CATEGORY_DIR_TITLE, 'short') . '</span></div>';
			}
		case 'enable-original':
			// Update with the correct setting and reset the cache
			$action = substr($action, 7);
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_URL_FORMAT\'');
			usu_reset_cache_data('true');

		default:
	}

	return $action;
}

// Function to check the category directory
function usu_check_category_dir_option($action) {
	switch($action) {
		case 'disable':
			$action = 'off';
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_URL_CATEGORY_DIR\'');
			usu_reset_cache_data('true');
			break;

		case 'enable-full':
			if(SEO_URL_FORMAT == 'parent') {
				zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => 'original'), 'update', '`configuration_key`=\'SEO_URL_FORMAT\'');
				echo '<div><span class="alert">' . sprintf(SEO_CONFIG_ADJUSTED, SEO_URL_CATEGORY_DIR_TITLE, SEO_URL_FORMAT_TITLE, 'original') . '</span></div>';
			}
		case 'enable-short':
			$action = substr($action, 7);
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_URL_CATEGORY_DIR\'');
			usu_reset_cache_data('true');

		default:
	}

	return $action;
}

// Function to check the URL format
function usu_check_remove_chars_option($action) {
	switch($action) {
		case 'enable-non-alphanumerical':
		case 'enable-punctuation':
			$action = substr($action, 7);
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_URLS_REMOVE_CHARS\'');
			usu_reset_cache_data('true');

		default:
	}

	return $action;
}

// Function to check the global cache settings
function usu_check_cache_options($action) {
	$temp = explode('-', $action);
	if(sizeof($temp) < 2) $temp[] = 'global';
	$temp[1] = strtoupper($temp[1]);

	switch($temp[0]) {
		case 'enable':
			$action = 'true';
			if(SEO_USE_CACHE_GLOBAL == 'false' && $temp[1] != 'GLOBAL') {
				zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_USE_CACHE_GLOBAL\'');
				echo '<div><span class="alert">' . sprintf(SEO_CONFIG_ADJUSTED, constant('SEO_USE_CACHE_' . $temp[1] . '_TITLE'), SEO_USE_CACHE_GLOBAL_TITLE, $action) . '</span></div>';
			}
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_USE_CACHE_' . $temp[1] . '\'');
			usu_reset_cache_data('true');
			break;

		case 'disable':
			$action = 'false';
			zen_db_perform(TABLE_CONFIGURATION, array('configuration_value' => $action), 'update', '`configuration_key`=\'SEO_USE_CACHE_' . $temp[1] . '\'');
			usu_reset_cache_data('true');
			break;

		default:
	}

	return $action;
}