<?php
/**
 * bmz_image_handler_update.php
 * manage automatic patching of the database for image-handler
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: functions_bmz_image_handler_update.php,v 1.7 2006/05/01 12:12:08 tim Exp $
 * @version $Id: functions_bmz_image_handler_update.php,v 1.8 2008/11/14 08:05:00 webchills $
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
        "configuration_key =  'SMALL_IMAGE_HOTZONE' OR " .
				"configuration_key = 'SMALL_IMAGE_QUALITY' OR " .
				"configuration_key = 'MEDIUM_IMAGE_FILETYPE' OR " .
				"configuration_key = 'MEDIUM_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_MEDIUM_IMAGES' OR " .
				"configuration_key = 'ZOOM_MEDIUM_IMAGES' OR " .
        "configuration_key =  'MEDIUM_IMAGE_HOTZONE' OR " .
				"configuration_key = 'MEDIUM_IMAGE_QUALITY' OR " .
				"configuration_key = 'LARGE_IMAGE_FILETYPE' OR " .
				"configuration_key = 'LARGE_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_LARGE_IMAGES' OR " .
				"configuration_key = 'LARGE_IMAGE_QUALITY' OR " .
				"configuration_key = 'WATERMARK_GRAVITY' OR " .
				"configuration_key = 'ZOOM_GRAVITY' OR " .
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
					"('IH - Bildgrösse ändern', 'IH_RESIZE', '$ih_resize', 'Entweder ''No'' für normales Zen-Cart Verhalten oder ''Yes'' um die automatische Grössenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''yes'', ''no''),', now());";
		$db->Execute($sql_query);
		define(IH_RESIZE, $ih_resize);
	}
	

	//-----------------------------------------
	// SMALL_IMAGE_FILETYPE configuration entry
	//-----------------------------------------
	$sql_query = '';
	if (!defined('SMALL_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', 'no_change', 'Wähle ''jpg'', ''gif'' oder ''png''. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser ''gif'' für die Transparenz oder ''jpg'' für größere Bilder. ''no_change'' bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet''s.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		define(SMALL_IMAGE_FILETYPE, 'no_change');
	}

	//-------------------------------------------
	// SMALL_IMAGE_BACKGROUND configuration entry
	//-------------------------------------------
	$sql_query = '';
	if (!defined('SMALL_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', '255:255:255', 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		define(SMALL_IMAGE_BACKGROUND, '255:255:255');
	}

	//-------------------------------------------
	// WATERMARK_SMALL_IMAGES configuration entry
	//-------------------------------------------
	$watermark_small_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_SMALL_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';";
		if (WATERMARK_SMALL_IMAGES == 'True') $watermark_small_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Kleine Bilder - Wasserzeichen', 'WATERMARK_SMALL_IMAGES', '$watermark_small_images', 'Stellen Sie auf ''yes'', wenn Sie mit Wasserzeichen versehene kleine Bilder anzeigen wollen.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

	//--------------------------------------
	// ZOOM_SMALL_IMAGES configuration entry
	//--------------------------------------
	$zoom_small_images = 'yes';
	$sql_query = '';
	if (defined('ZOOM_SMALL_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ZOOM_SMALL_IMAGES';";
		if (ZOOM_SMALL_IMAGES == 'yes') $zoom_small_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Kleine Bilder - Zoom', 'ZOOM_SMALL_IMAGES', '$zoom_small_images', 'Stellen Sie auf ''yes'', falls Sie den Zoom-Effekt bei Mouseover für die kleinen Bilder aktivieren wollen.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

  //--------------------------------------
  // SMALL_IMAGE_HOTZONE configuration entry
  //--------------------------------------
  $small_image_hotzone = 'no';
  $sql_query = '';
  if (defined('SMALL_IMAGE_HOTZONE')) {
    $sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SMALL_IMAGE_HOTZONE';";
    if (SMALL_IMAGE_HOTZONE == 'yes') $small_image_hotzone = 'yes';
    $db->Execute($sql_query);
  }
  $sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
        "('IH - Kleine Bilder - Hotzone', 'SMALL_IMAGE_HOTZONE', '$small_image_hotzone', 'Stellen Sie auf ''yes'', wenn im kleinen Bildern bei Mouseover eine Hotzone angezeigt werden soll. Der Zoom erfolgt dann nur beim Mouseover über die Hotzone und nicht über das ganze Bild.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
  $db->Execute($sql_query);

	//----------------------------------------
	// SMALL_IMAGE_QUALITY configuration entry
	//----------------------------------------
	$small_image_quality = '85';
	$sql_query = '';
	if (defined('SMALL_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SMALL_IMAGE_QUALITY';";
		$small_image_quality = SMALL_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', '$small_image_quality', 'Geben Sie die gewünschte Bildqualität für kleine jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);


	//------------------------------------------
	// MEDIUM_IMAGE_FILETYPE configuration entry
	//------------------------------------------
	$sql_query = '';
	if (!defined('MEDIUM_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Mittlere Bilder - Dateityp', 'MEDIUM_IMAGE_FILETYPE', 'no_change', 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die mittleren Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.''s.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		define(MEDIUM_IMAGE_FILETYPE, 'no_change');
	}

	//--------------------------------------------
	// MEDIUM_IMAGE_BACKGROUND configuration entry
	//--------------------------------------------
	$sql_query = '';
	if (!defined('MEDIUM_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Mittlere Bilder - Hintergrund', 'MEDIUM_IMAGE_BACKGROUND', '255:255:255', 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		define(MEDIUM_IMAGE_BACKGROUND, '255:255:255');
	}

	//--------------------------------------------
	// WATERMARK_MEDIUM_IMAGES configuration entry
	//--------------------------------------------
	$watermark_medium_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_MEDIUM_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';";
		if (WATERMARK_MEDIUM_IMAGES == 'True') $watermark_medium_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Wasserzeichen', 'WATERMARK_MEDIUM_IMAGES', '$watermark_medium_images', 'Stellen Sie auf ''yes'', wenn Sie mittlere Bilder mit Wasserzeichen versehen anzeigen lassen wollen.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

	//---------------------------------------
	// ZOOM_MEDIUM_IMAGES configuration entry
	//---------------------------------------
	$zoom_medium_images = 'no';
	$sql_query = '';
	if (defined('ZOOM_MEDIUM_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES';";
		if (ZOOM_MEDIUM_IMAGES == 'yes') $zoom_medium_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Zoom', 'ZOOM_MEDIUM_IMAGES', '$zoom_medium_images', 'Stellen Sie auf ''yes'', wenn Sie beim Mouseover über mittlere Bilder einen Zoomeffekt anzeigen lassen wollen.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

  //-----------------------------------------
  // MEDIUM_IMAGE_HOTZONE configuration entry
  //-----------------------------------------
  $medium_image_hotzone = 'no';
  $sql_query = '';
  if (defined('MEDIUM_IMAGE_HOTZONE')) {
    $sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE';";
    if (MEDIUM_IMAGE_HOTZONE == 'yes') $medium_image_hotzone = 'yes';
    $db->Execute($sql_query);
  }
  $sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
        "('IH - Mittlere Bilder - Hotzone', 'MEDIUM_IMAGE_HOTZONE', '$medium_image_hotzone', 'Stellen Sie auf ''yes'', wenn im kleinen Bildern bei Mouseover eine Hotzone angezeigt werden soll. Der Zoom erfolgt dann nur beim Mouseover über die Hotzone und nicht über das ganze Bild.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
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
				"('IH - Mittlere Bilder - Qualität', 'MEDIUM_IMAGE_QUALITY', '$medium_image_quality', 'Geben Sie die gewünschte Bildqualität für mittlere jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);


	//-----------------------------------------
	// LARGE_IMAGE_FILETYPE configuration entry
	//-----------------------------------------
	$sql_query = '';
	if (!defined('LARGE_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Grosse Bilder - Dateityp', 'LARGE_IMAGE_FILETYPE', 'no_change', 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die grossen Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.''s.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_FILETYPE, 'no_change');
	}

	//-------------------------------------------
	// LARGE_IMAGE_BACKGROUND configuration entry
	//-------------------------------------------
	$sql_query = '';
	if (!defined('LARGE_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Grosse Bilder - Hintergrund', 'LARGE_IMAGE_BACKGROUND', '255:255:255', 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_BACKGROUND, '255:255:255');
	}

	//-------------------------------------------
	// WATERMARK_LARGE_IMAGES configuration entry
	//-------------------------------------------
	$watermark_large_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_LARGE_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';";
		if (WATERMARK_LARGE_IMAGES == 'True') $watermark_large_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Grosse Bilder - Wasserzeichen', 'WATERMARK_LARGE_IMAGES', '$watermark_large_images', 'Stellen Sie auf ''yes'', wenn Sie grosse Bilder mit Wasserzeichen versehen anzeigen wollen.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

	//----------------------------------------
	// LARGE_IMAGE_QUALITY configuration entry
	//----------------------------------------
	$large_image_quality = '85';
	$sql_query = '';
	if (defined('LARGE_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'LARGE_IMAGE_QUALITY';";
		$large_image_quality = LARGE_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH - Grosse Bilder - Qualität', 'LARGE_IMAGE_QUALITY', '$large_image_quality', 'Geben Sie die gewünschte Bildqualität für grosse jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);


	//------------------------------------------
	// LARGE_IMAGE_MAX_WIDTH configuration entry
	//------------------------------------------
	$sql_query = '';
	$large_image_max_width = '750';
	if (!defined('LARGE_IMAGE_MAX_WIDTH')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Grosse Bilder - Maximale Breite', 'LARGE_IMAGE_MAX_WIDTH', '" . $large_image_max_width . "', 'Geben Sie eine maximale Breite für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now())";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_MAX_WIDTH, $large_image_max_width);
	}
	
	//-------------------------------------------
	// LARGE_IMAGE_MAX_HEIGHT configuration entry
	//-------------------------------------------
	$sql_query = '';
	$large_image_max_height = '550';
	if (!defined('LARGE_IMAGE_MAX_HEIGHT')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Grosse Bilder - Maximale Höhe', 'LARGE_IMAGE_MAX_HEIGHT', '" . $large_image_max_height . "', 'Geben Sie eine maximale Höhe für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now())";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_MAX_HEIGHT, $large_image_max_height);
	}
	

	//--------------------------------------
	// WATERMARK_GRAVITY configuration entry
	//--------------------------------------
	$sql_query = '';
	if (!defined('WATERMARK_GRAVITY')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Wasserzeichen - Position', 'WATERMARK_GRAVITY', 'Center', 'Wählen Sie die Position für das Wasserzeichen. Voreingestellt ist <strong>Center (Zentriert)</Strong>.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''NorthWest''), array(''id''=>''North'', ''text''=>''North''), array(''id''=>''NorthEast'', ''text''=>''NorthEast''), array(''id''=>''West'', ''text''=>''West''), array(''id''=>''Center'', ''text''=>''Center''), array(''id''=>''East'', ''text''=>''East''), array(''id''=>''SouthWest'', ''text''=>''SouthWest''), array(''id''=>''South'', ''text''=>''South''), array(''id''=>''SouthEast'', ''text''=>''SouthEast'')),', now());";
		$db->Execute($sql_query);
		define(WATERMARK_GRAVITY, 'Center');
	}


	//---------------------------------
	// ZOOM_GRAVITY configuration entry
	//---------------------------------
	$sql_query = '';
	if (!defined('ZOOM_GRAVITY')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH - Zoom - Position', 'ZOOM_GRAVITY', 'SouthEast', 'Wählen Sie die Position der Anzeige für den Zoom. Voreingestellt ist <strong>SouthEast (SüdOst)</Strong>.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''NorthWest''), array(''id''=>''North'', ''text''=>''North''), array(''id''=>''NorthEast'', ''text''=>''NorthEast''), array(''id''=>''West'', ''text''=>''West''), array(''id''=>''Center'', ''text''=>''Center''), array(''id''=>''East'', ''text''=>''East''), array(''id''=>''SouthWest'', ''text''=>''SouthWest''), array(''id''=>''South'', ''text''=>''South''), array(''id''=>''SouthEast'', ''text''=>''SouthEast'')),', now());";
		$db->Execute($sql_query);
		define(ZOOM_GRAVITY, 'SouthEast');
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
				"('Image Handler Version', 'IH_VERSION', '" . $ihConf['version'] . "', 'Wird von Image Handler verwendet, um zu prüfen, ob die Datenbank up to date mit den hochgeladenen Image Handler Dateien ist.', 0, 100, 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);
  if (!defined('IH_VERSION')) define(IH_VERSION, $ihConf['version']);

}

// do we need to perform one or more updates?
function update_image_handler() {
  global $db;
	// check out what updates we need to perform starting
	// with old updates proceding to recent updates.
	
  // 2.0 UPDATE
  $version = '2.0';
  if (bmz_needs_update($version, IH_VERSION)) {
    $sql_query = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='" . $version . "' WHERE configuration_key = 'IH_VERSION';";
    $db->Execute($sql_query);
  }
}
 