<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_music_extras_dhtml.php - amendment for Admin Profiles 2006-04-17 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$options = array( array('box' => BOX_CATALOG_RECORD_ARTISTS, 'page' => FILENAME_RECORD_ARTISTS),
					array('box' => BOX_CATALOG_RECORD_COMPANY, 'page' => FILENAME_RECORD_COMPANY),
					array('box' => BOX_CATALOG_MUSIC_GENRE, 'page' => FILENAME_MUSIC_GENRE),
					array('box' => BOX_CATALOG_MEDIA_MANAGER, 'page' => FILENAME_MEDIA_MANAGER),
					array('box' => BOX_CATALOG_MEDIA_TYPES, 'page' => FILENAME_MEDIA_TYPES)
				);

foreach ($options as $key => $value)
	if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
?>
