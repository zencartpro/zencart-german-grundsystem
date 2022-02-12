<?php
/** 
 * Music product Type - Database Name Defines
 *
 * @package classes
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: music_type_database_names.php 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * Database name defines
 *
 */
define('TABLE_RECORD_ARTISTS', DB_PREFIX . 'record_artists');
define('TABLE_RECORD_ARTISTS_INFO', DB_PREFIX . 'record_artists_info');
define('TABLE_RECORD_COMPANY', DB_PREFIX . 'record_company');
define('TABLE_RECORD_COMPANY_INFO', DB_PREFIX . 'record_company_info');
define('TABLE_PRODUCT_MUSIC_EXTRA', DB_PREFIX . 'product_music_extra');
define('TABLE_MUSIC_GENRE', DB_PREFIX . 'music_genre');
define('TABLE_MUSIC_GENRE_INFO', DB_PREFIX . 'music_genre_info');
define('TABLE_MEDIA_MANAGER', DB_PREFIX . 'media_manager');
define('TABLE_MEDIA_TYPES', DB_PREFIX . 'media_types');
define('TABLE_MEDIA_CLIPS', DB_PREFIX . 'media_clips');
define('TABLE_MEDIA_TO_PRODUCTS', DB_PREFIX . 'media_to_products');
?>