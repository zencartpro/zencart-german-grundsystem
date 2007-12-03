<?php
/**
 * Header code file for the Advanced Search Input page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4673 2006-10-03 01:37:07Z drbyte $
 */
  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $breadcrumb->add(NAVBAR_TITLE_1);

//test:
//&keyword=die+hard&categories_id=10&inc_subcat=1&manufacturers_id=4&pfrom=1&pto=50&dfrom=01%2F01%2F2003&dto=12%2F20%2F2005

  $sData['keyword'] =  (isset($_GET['keyword']) ? zen_output_string($_GET['keyword']) : zen_output_string(KEYWORD_FORMAT_STRING));
  $sData['search_in_description'] = (isset($_GET['search_in_description']) ? zen_output_string($_GET['search_in_description']) : 1);
  $sData['categories_id'] = (isset($_GET['categories_id'])    ? zen_output_string($_GET['categories_id']) : 0);
  $sData['inc_subcat'] = (isset($_GET['inc_subcat'])       ? zen_output_string($_GET['inc_subcat']) : 1);
  $sData['manufacturers_id'] = (isset($_GET['manufacturers_id']) ? zen_output_string($_GET['manufacturers_id']) : 0);
  $sData['dfrom'] =    (isset($_GET['dfrom']) ? zen_output_string($_GET['dfrom']) : zen_output_string(DOB_FORMAT_STRING));
  $sData['dto'] =      (isset($_GET['dto'])   ? zen_output_string($_GET['dto']) : zen_output_string(DOB_FORMAT_STRING));
  $sData['pfrom'] =    (isset($_GET['pfrom']) ? zen_output_string($_GET['pfrom']) : '');
  $sData['pto'] =      (isset($_GET['pto'])   ? zen_output_string($_GET['pto']) : '');

?>