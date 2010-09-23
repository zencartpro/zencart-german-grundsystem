<?php
/**
 * functions_bmz_image_handler_update.php
 * manage automatic patching of the database for image-handler
 *
 * @author  Tim Kroeger (original author)
 * @copyright Copyright 2005-2006
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: functions_bmz_image_handler_update.php,v 2.0 Rev 8 2010-05-31 23:46:5 DerManoMann Exp $
 * Last modified by DerManoMann 2010-05-31 23:46:50 
 *
 * webchills 2010-08-08 - Added multilanguage install for Zen-Cart german.  
 * NOTE: This version is to use in the german Zen-Cart 1.3.9 version from zen-cart.at ONLY
 * Version number changed to 2.3
 */

global $messageStack;
global $db;

function remove_image_handler() {
	global $db;
	$error = false;
	
	$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH' OR " .
				"configuration_key = 'LARGE_IMAGE_MAX_HEIGHT' OR " .
				"configuration_key = 'SMALL_IMAGE_FILETYPE' OR " .
				"configuration_key = 'SMALL_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_SMALL_IMAGES' OR " .
				"configuration_key = 'ZOOM_SMALL_IMAGES' OR " .
				"configuration_key = 'SMALL_IMAGE_QUALITY' OR " .
				"configuration_key = 'MEDIUM_IMAGE_FILETYPE' OR " .
				"configuration_key = 'MEDIUM_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_MEDIUM_IMAGES' OR " .
				"configuration_key = 'MEDIUM_IMAGE_QUALITY' OR " .
				"configuration_key = 'LARGE_IMAGE_FILETYPE' OR " .
				"configuration_key = 'LARGE_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_LARGE_IMAGES' OR " .
				"configuration_key = 'LARGE_IMAGE_QUALITY' OR " .
				"configuration_key = 'WATERMARK_GRAVITY' OR " .
				"configuration_key = 'IH_RESIZE' OR " .
				"configuration_key = 'SHOW_UPLOADED_IMAGES';";
	$db->Execute($sql_query);
	$sql_query = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH' OR " .
				"configuration_key = 'LARGE_IMAGE_MAX_HEIGHT' OR " .
				"configuration_key = 'SMALL_IMAGE_FILETYPE' OR " .
				"configuration_key = 'SMALL_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_SMALL_IMAGES' OR " .
				"configuration_key = 'ZOOM_SMALL_IMAGES' OR " .
				"configuration_key = 'SMALL_IMAGE_QUALITY' OR " .
				"configuration_key = 'MEDIUM_IMAGE_FILETYPE' OR " .
				"configuration_key = 'MEDIUM_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_MEDIUM_IMAGES' OR " .
				"configuration_key = 'MEDIUM_IMAGE_QUALITY' OR " .
				"configuration_key = 'LARGE_IMAGE_FILETYPE' OR " .
				"configuration_key = 'LARGE_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_LARGE_IMAGES' OR " .
				"configuration_key = 'LARGE_IMAGE_QUALITY' OR " .
				"configuration_key = 'WATERMARK_GRAVITY' OR " .
				"configuration_key = 'IH_RESIZE' OR " .
				"configuration_key = 'SHOW_UPLOADED_IMAGES';";
	$db->Execute($sql_query);
	$sql_query = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='REMOVED' WHERE configuration_key = 'IH_VERSION';";
	$db->Execute($sql_query);
	return $error;
}

function install_image_handler() {
	global $db;
    global $ihConf;
  $sort_order_offset = 100;
	$i = 0;
	
	if (defined('IH_VERSION')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'IH_VERSION';";
		$db->Execute($sql_query);
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'IH_VERSION';";
		$db->Execute($sql_query);
	}

	//------------------------------
	// IH_RESIZE configuration entry
	//------------------------------
	$ih_resize = 'yes';
	if (defined('IMAGE_MANAGER_HANDLER')) {
		// ok, some image handler has been installed
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'IMAGE_MANAGER_HANDLER';";
		if (IMAGE_MANAGER_HANDLER == 'none') $ih_resize = 'no';
		$db->Execute($sql_query);
	}
	if (!defined('IH_RESIZE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH resize images', 'IH_RESIZE', '$ih_resize', 'Select either ''no'' which is old Zen-Cart behaviour or ''yes'' to activate automatic resizing and caching of images. If you want to use ImageMagick you have to specify the location of the <strong>convert</strong> binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em>.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''yes'', ''no''),', now());";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Bildgrösse ändern', 'IH_RESIZE', '43', 'Entweder ''No'' für normales Zen-Cart Verhalten oder ''Yes'' um die automatische Grössenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', now(), now());";
		$db->Execute($sql_query);
		define(IH_RESIZE, $ih_resize);
	}
	

	//-----------------------------------------
	// SMALL_IMAGE_FILETYPE configuration and configuration_language entry
	//-----------------------------------------
	$sql_query = '';
	if (!defined('SMALL_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH small image filetype', 'SMALL_IMAGE_FILETYPE', 'no_change', 'Select one of ''jpg'', ''gif'' or ''png''. Internet Explorer has still issues displaying png-images with transparent areas. You better stick to ''gif'' for transparency or ''jpg'' for larger images. ''no_change'' is old zen-cart behavior, use the same file extension for small images as uploaded image''s.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		
		$db->Execute($sql_query);
			$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', '43', 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser ''gif'' für die Transparenz oder ''jpg'' für größere Bilder. ''no_change'' bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet.', now(), now());";
		$db->Execute($sql_query);
		define(SMALL_IMAGE_FILETYPE, 'no_change');
	}

	//-------------------------------------------
	// SMALL_IMAGE_BACKGROUND configuration and configuration language entry
	//-------------------------------------------
	$sql_query = '';
	if (!defined('SMALL_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH small image background', 'SMALL_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to ''transparent'' to keep transparency.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', '43', 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now());";
		$db->Execute($sql_query);
		define(SMALL_IMAGE_BACKGROUND, '255:255:255');
	}

	//-------------------------------------------
	// WATERMARK_SMALL_IMAGES configuration and configuration language entry
	//-------------------------------------------
	$watermark_small_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_SMALL_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';";
		if (WATERMARK_SMALL_IMAGES == 'True') $watermark_small_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH watermark small images', 'WATERMARK_SMALL_IMAGES', '$watermark_small_images', 'Set to ''yes'', if you want to show watermarked small images instead of unmarked small images.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Wasserzeichen', 'WATERMARK_SMALL_IMAGES', '43', 'Stellen Sie auf ''yes'', wenn Sie mit Wasserzeichen versehene kleine Bilder anzeigen wollen.', now(), now());";
	$db->Execute($sql_query);

	//--------------------------------------
	// ZOOM_SMALL_IMAGES configuration and configuration language entry
	//--------------------------------------
	$zoom_small_images = 'yes';
	$sql_query = '';
	if (defined('ZOOM_SMALL_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ZOOM_SMALL_IMAGES';";
		if (ZOOM_SMALL_IMAGES == 'yes') $zoom_small_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH zoom small images', 'ZOOM_SMALL_IMAGES', '$zoom_small_images', 'Set to ''yes'', if you want to enable a nice zoom overlay while hovering the mouse pointer over small images.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Zoom', 'ZOOM_SMALL_IMAGES', '43', 'Stellen Sie auf ''yes'', falls Sie den Zoom-Effekt bei Mouseover für die kleinen Bilder aktivieren wollen.', now(), now());";
	$db->Execute($sql_query);

  

	//----------------------------------------
	// SMALL_IMAGE_QUALITY configuration and configuration language entry
	//----------------------------------------
	$small_image_quality = '85';
	$sql_query = '';
	if (defined('SMALL_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SMALL_IMAGE_QUALITY';";
		$small_image_quality = SMALL_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH small image compression quality', 'SMALL_IMAGE_QUALITY', '$small_image_quality', 'Specify the desired image quality for small jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', '43', 'Geben Sie die gewünschte Bildqualität für kleine jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now());";
	$db->Execute($sql_query);


	//------------------------------------------
	// MEDIUM_IMAGE_FILETYPE configuration and configuration language entry
	//------------------------------------------
	$sql_query = '';
	if (!defined('MEDIUM_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH medium image filetype', 'MEDIUM_IMAGE_FILETYPE', 'no_change', 'Select one of ''jpg'', ''gif'' or ''png''. Internet Explorer has still issues displaying png-images with transparent areas. You better stick to ''gif'' for transparency or ''jpg'' for larger images. ''no_change'' is old zen-cart behavior, use the same file extension for medium images as uploaded image''s.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Dateityp', 'MEDIUM_IMAGE_FILETYPE', '43', 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die mittleren Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now());";
	$db->Execute($sql_query);
		define(MEDIUM_IMAGE_FILETYPE, 'no_change');
	}

	//--------------------------------------------
	// MEDIUM_IMAGE_BACKGROUND configuration and configuration language entry
	//--------------------------------------------
	$sql_query = '';
	if (!defined('MEDIUM_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH medium image background', 'MEDIUM_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to ''transparent'' to keep transparency.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Hintergrund', 'MEDIUM_IMAGE_BACKGROUND', '43', 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now());";
	$db->Execute($sql_query);
		define(MEDIUM_IMAGE_BACKGROUND, '255:255:255');
	}

	//--------------------------------------------
	// WATERMARK_MEDIUM_IMAGES configuration and configuration language entry
	//--------------------------------------------
	$watermark_medium_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_MEDIUM_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';";
		if (WATERMARK_MEDIUM_IMAGES == 'True') $watermark_medium_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH watermark medium images', 'WATERMARK_MEDIUM_IMAGES', '$watermark_medium_images', 'Set to ''yes'', if you want to show watermarked medium images instead of unmarked medium images.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Wasserzeichen', 'WATERMARK_MEDIUM_IMAGES', '43', 'Stellen Sie auf ''yes'', wenn Sie mittlere Bilder mit Wasserzeichen versehen anzeigen lassen wollen.', now(), now());";
	$db->Execute($sql_query);

	

  
	//-----------------------------------------
	// MEDIUM_IMAGE_QUALITY configuration entry
	//-----------------------------------------
	$medium_image_quality = '85';
	$sql_query = '';
	if (defined('MEDIUM_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';";
		$medium_image_quality = MEDIUM_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH medium image compression quality', 'MEDIUM_IMAGE_QUALITY', '$medium_image_quality', 'Specify the desired image quality for medium jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Qualität', 'MEDIUM_IMAGE_QUALITY', '43', 'Geben Sie die gewünschte Bildqualität für mittlere jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now());";
	$db->Execute($sql_query);


	//-----------------------------------------
	// LARGE_IMAGE_FILETYPE configuration and configuration language entry
	//-----------------------------------------
	$sql_query = '';
	if (!defined('LARGE_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH large image filetype', 'LARGE_IMAGE_FILETYPE', 'no_change', 'Select one of ''jpg'', ''gif'' or ''png''. Internet Explorer has still issues displaying png-images with transparent areas. You better stick to ''gif'' for transparency or ''jpg'' for larger images. ''no_change'' is old zen-cart behavior, use the same file extension for large images as uploaded image''s.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Dateityp', 'LARGE_IMAGE_FILETYPE', '43', 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die grossen Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now());";
	$db->Execute($sql_query);
		define(LARGE_IMAGE_FILETYPE, 'no_change');
	}

	//-------------------------------------------
	// LARGE_IMAGE_BACKGROUND configuration and configuration language entry
	//-------------------------------------------
	$sql_query = '';
	if (!defined('LARGE_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH large image background', 'LARGE_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to ''transparent'' to keep transparency.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Hintergrund', 'LARGE_IMAGE_BACKGROUND', '43', 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now());";
	$db->Execute($sql_query);
		define(LARGE_IMAGE_BACKGROUND, '255:255:255');
	}

	//-------------------------------------------
	// WATERMARK_LARGE_IMAGES configuration and configuration language entry
	//-------------------------------------------
	$watermark_large_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_LARGE_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';";
		if (WATERMARK_LARGE_IMAGES == 'True') $watermark_large_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH watermark large images', 'WATERMARK_LARGE_IMAGES', '$watermark_large_images', 'Set to ''yes'', if you want to show watermarked large images instead of unmarked large images.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Wasserzeichen', 'WATERMARK_LARGE_IMAGES', '43', 'Stellen Sie auf ''yes'', wenn Sie grosse Bilder mit Wasserzeichen versehen anzeigen wollen.', now(), now());";
	$db->Execute($sql_query);

	//----------------------------------------
	// LARGE_IMAGE_QUALITY configuration and configuration language entry
	//----------------------------------------
	$large_image_quality = '85';
	$sql_query = '';
	if (defined('LARGE_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'LARGE_IMAGE_QUALITY';";
		$large_image_quality = LARGE_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH large image compression quality', 'LARGE_IMAGE_QUALITY', '$large_image_quality', 'Specify the desired image quality for large jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Qualität', 'LARGE_IMAGE_QUALITY', '43', 'Geben Sie die gewünschte Bildqualität für grosse jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now());";
	$db->Execute($sql_query);


	//------------------------------------------
	// LARGE_IMAGE_MAX_WIDTH configuration and configuration language entry
	//------------------------------------------
	$sql_query = '';
	$large_image_max_width = '750';
	if (!defined('LARGE_IMAGE_MAX_WIDTH')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH large image maximum width', 'LARGE_IMAGE_MAX_WIDTH', '" . $large_image_max_width . "', 'Specify a maximum width for your large images. If width and height are empty or set to 0, no resizing of large images is done.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now())";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Maxinale Breite', 'LARGE_IMAGE_MAX_WIDTH', '43', 'Geben Sie eine maximale Breite für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', now(), now());";
	$db->Execute($sql_query);
		define(LARGE_IMAGE_MAX_WIDTH, $large_image_max_width);
	}
	
	//-------------------------------------------
	// LARGE_IMAGE_MAX_HEIGHT configuration and configuration language entry
	//-------------------------------------------
	$sql_query = '';
	$large_image_max_height = '550';
	if (!defined('LARGE_IMAGE_MAX_HEIGHT')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH large image maximum height', 'LARGE_IMAGE_MAX_HEIGHT', '" . $large_image_max_height . "', 'Specify a maximum height for your large images. If width and height are empty or set to 0, no resizing of large images is done.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now())";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Maximale Höhe', 'LARGE_IMAGE_MAX_HEIGHT', '43', 'Geben Sie eine maximale Höhe für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', now(), now());";
	$db->Execute($sql_query);
		define(LARGE_IMAGE_MAX_HEIGHT, $large_image_max_height);
	}
	

	//--------------------------------------
	// WATERMARK_GRAVITY configuration and configuration language entry
	//--------------------------------------
	$sql_query = '';
	if (!defined('WATERMARK_GRAVITY')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH watermark gravity', 'WATERMARK_GRAVITY', 'Center', 'Select the position for the watermark relative to the image''s canvas. Default is <strong>Center</Strong>.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''NorthWest''), array(''id''=>''North'', ''text''=>''North''), array(''id''=>''NorthEast'', ''text''=>''NorthEast''), array(''id''=>''West'', ''text''=>''West''), array(''id''=>''Center'', ''text''=>''Center''), array(''id''=>''East'', ''text''=>''East''), array(''id''=>''SouthWest'', ''text''=>''SouthWest''), array(''id''=>''South'', ''text''=>''South''), array(''id''=>''SouthEast'', ''text''=>''SouthEast'')),', now());";
		$db->Execute($sql_query);
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Wasserzeichen - Position', 'WATERMARK_GRAVITY', '43', 'Wählen Sie die Position für das Wasserzeichen. Voreingestellt ist <strong>Center (Zentriert)</strong>.', now(), now());";
	$db->Execute($sql_query);
		define(WATERMARK_GRAVITY, 'Center');
	}


	//----------------------------------------------
	// ADDITIONAL_IMAGE_FILETYPE configuration entry
	//----------------------------------------------
	$sql_query = '';
	if (defined('ADDITIONAL_IMAGE_FILETYPE')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE';";
		$db->Execute($sql_query);
	}


	//------------------------------------------------
	// ADDITIONAL_IMAGE_BACKGROUND configuration entry
	//------------------------------------------------
	$sql_query = '';
	if (defined('ADDITIONAL_IMAGE_BACKGROUND')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND';";
		$db->Execute($sql_query);
	}

	// set to first image-handler version which supported automatic updates
	// and update database	
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('Image Handler Version', 'IH_VERSION', '" . $ihConf['version'] . "', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('Image Handler Version', 'IH_VERSION', '43', 'Wird von Image Handler verwendet, um zu prüfen, ob die Datenbank up to date mit den hochgeladenen Image Handler Dateien ist.', now(), now());";
	$db->Execute($sql_query);
  if (!defined('IH_VERSION')) define(IH_VERSION, $ihConf['version']);

}

// do we need to perform one or more updates?
function update_image_handler() {
  global $db;
	// check out what updates we need to perform starting
	// with old updates proceding to recent updates.
	
  // 2.3 UPDATE
  $version = '2.3';
  if (bmz_needs_update($version, IH_VERSION)) {
    $sql_query = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='" . $version . "' WHERE configuration_key = 'IH_VERSION';";
    $db->Execute($sql_query);
  }
}
