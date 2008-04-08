<?php
/**
 * @package map_shop
 * @desc map_shop generates google_map entries at http://shops.zen-cart.at
 * @copyright Copyright 2006-2007 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com> <http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id$
 */

  define('MAP_SHOP_MENU', 'map_shop');
  define('MAP_SHOP_FILENAME', 'map_shop.php');
  define('MAP_SHOP_BTN_UPDATE', 'collectData');
  define('MAP_SHOP_BTN_GOOGLE', 'detect lat/lng ');
  define('MAP_SHOP_BTN_GOOGLEMAP', 'GoogleMap display');
  define('MAP_SHOP_INFO1', 'EN::letzter export & hingeschoben zur map_shop');
  
  define('MAP_FSTORE_NAME', 'Name of the shop');
  define('MAP_HINT_STORE_NAME', 'to edit');
  define('MAP_FSTORE_NAME_ADDRESS', 'The store\'s address');
  define('MAP_HINT_STORE_NAME_ADDRESS', 'to edit');

  define('MAP_FCATEGORY', 'Kategorie');
  define('MAP_HINT_CATEGORY', 'select main category');

  define('MAP_FHTML', 'shop web-address');
  define('MAP_HINT_HTML', 'to edit: admin/includes/configure.php aendern');

  define('MAP_FDESCRIPTION', 'Description');
  define('MAP_HINT_DESCRIPTION', 'Describe your shop');
  
  define('MAP_FCOUNTRY', 'Country');
  define('MAP_HINT_COUNTRY', 'to edit');
  
  define('MAP_FZIP', 'PLZ');
  define('MAP_HINT_ZIP', 'Enter the ZIP');
  
  define('MAP_FSTREET', 'Street');
  define('MAP_HINT_STREET', 'insert the road including house number');
  
?>