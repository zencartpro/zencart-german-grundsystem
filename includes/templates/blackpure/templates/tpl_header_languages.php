<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services

 * languages sidebox - allows customer to select from available languages installed on your site
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: languages.php 2718 2005-12-28 06:42:39Z drbyte $
 */

// test if box should display
  $show_languages= true;


  if ($show_languages == true) {
    if (!isset($lng) || (isset($lng) && !is_object($lng))) {
      $lng = new language;
    }

    reset($lng->catalog_languages);
  }
  
      $lang_array = array();
	  while (list($key, $value) = each($lng->catalog_languages)) {
        $lang_array[] = array('id' => $key, 'text' => $value['name']);
      }
      $hidden_get_variables = '';
      reset($_GET);

      while (list($key, $value) = each($_GET)) {
        if ( ($key != 'language') && ($key != zen_session_name()) && ($key != 'x') && ($key != 'y') ) {
          $hidden_get_variables .= zen_draw_hidden_field($key, $value);
        }
      }

	$content = "";
    $content .= zen_draw_form('lang_form', zen_href_link(basename(ereg_replace('.php','', $PHP_SELF)), '', $request_type, false), 'get');
    $content .= zen_draw_pull_down_menu('language', $lang_array, $_SESSION['languages_code'], 'onchange="this.form.submit();"') . $hidden_get_variables . zen_hide_session_id();
    $content .= '</form>';



?>