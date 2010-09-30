<?php
/**
 * sanitize the REQUEST parameters
 *
 * @package initSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_sanitize.php 17576 2010-09-17 19:10:32Z wilt $
 * @todo move the array process to security class
 */

  if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
  }
/**
 * process all $_POST terms
 * Notes to contribution developers. 
 * If you need to add your own override for the whitelist, you should not just simply set
 * $global_xss_whitelist but merge it with any possible previous values, in order to honour other 
 * contributions.
 * 
 * eg. create an override file in the admin/includes/extra_configures directory  containing
 * 
 * $global_xss_whitelist = isset($global_xss_whitelist) ? $global_xss_whitelist : array();
 * $my_whitelist  = array('some_field_name');
 * $global_xss_whitelist = array_merge($whitelist, $global_xss_whitelist); 
 */
  $whitelist  = array('configuration_value', 'products_description', 'products_name', 'pages_html_text', 'categories_name', 'categories_description');
  if (isset($global_xss_whitelist))
  {
    $whitelist = array_merge($whitelist, $global_xss_whitelist); 
  }
  if (isset($_POST) && count($_POST) > 0) 
  {
    foreach($_POST as $key=>$value)
    {
      if (!in_array($key, $whitelist))
      {
        $_POST[$key] = sanitizeXSS($value);
      }
    }
  }
  function sanitizeXSS($value)
  {
    if (is_array($value))
    {
      foreach ($value as $key=>$value1 )
      {
        $value[$key] = sanitizeXSS($value1);  
      }
    } else 
    {
      $value = zen_output_string_protected($value); 
    }
    return $value;
  }  