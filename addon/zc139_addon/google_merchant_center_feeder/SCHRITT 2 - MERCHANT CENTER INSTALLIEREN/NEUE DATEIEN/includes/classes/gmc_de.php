<?php
/**
 * gmc_de.php
 *
 * @package google merchant center deutschland 3.0 for Zen-Cart 1.3.9 german
 * @copyright Copyright 2007 Numinix Technology http://www.numinix.com
 * @copyright Portions Copyright 2011 webchills http://www.webchills.at
 * @copyright Portions Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: google_mcde.php 2011-06-02 23:57:19Z numinix $
 * @version $Id: gmc_de.php 2011-10-02 08:48:54Z webchills $
 */
 
  class google_mcde {
    function additional_images($products_image) {
      if ($products_image != '') {
        $images_array = array();
        // prepare image name
        $products_image_extension = substr($products_image, strrpos($products_image, '.'));
        $products_image_base = str_replace($products_image_extension, '', $products_image);

        // if in a subdirectory
        if (strrpos($products_image, '/')) {
          $products_image_match = substr($products_image, strrpos($products_image, '/')+1);
          $products_image_match = str_replace($products_image_extension, '', $products_image_match) . '_';
          $products_image_base = $products_image_match;
        }

        $products_image_directory = str_replace($products_image, '', substr($products_image, strrpos($products_image, '/')));
        if ($products_image_directory != '') {
          $products_image_directory = DIR_WS_IMAGES . str_replace($products_image_directory, '', $products_image) . "/";
        } else {
          $products_image_directory = DIR_WS_IMAGES;
        }

        // Check for additional matching images
        $file_extension = $products_image_extension;
        $products_image_match_array = array();
        if ($dir = @dir($products_image_directory)) {
          while ($file = $dir->read()) {
            if (!is_dir($products_image_directory . $file)) {
              if (substr($file, strrpos($file, '.')) == $file_extension) {
                if(preg_match("/" . $products_image_base . "/i", $file) == 1) {
                  if ($file != $products_image) {
                    if ($products_image_base . str_replace($products_image_base, '', $file) == $file) {
                      $images_array[] = $this->google_mcde_image_url($file);
                      if (count($images_array) >= 8) break;
                    } else {
                      //  no match
                    }
                  }
                }
              }
            }
          }
          $dir->close();
        }
        return $images_array;
      } else {
        // default
        return false;
      }
    }
   
    // writes out the code into the feed file
    function google_mcde_fwrite($output='', $mode) {
      global $outfile;
      $output = implode("\n", $output);
      if(strtolower(CHARSET) != 'utf-8') {
        $output = utf8_encode($output);
      } else {
        $output = $output;
      }
      $fp = fopen($outfile, $mode);
      $retval = fwrite($fp, $output, GOOGLE_MCDE_OUTPUT_BUFFER_MAXSIZE);
      return $retval;
    }
    
    // gets the Google Merchant Center Deutschland version number from the Module Versions file
    function google_mcde_version() {
      $file = DIR_FS_CATALOG . 'module_version/google_mcde.txt';
      $handle = fopen($file, 'r');
      $version = fread($handle, filesize($file));
      fclose($handle);
      return trim($version);
    }  
    
    // trims the value of each element of an array
    function trim_array($x) {
      if (is_array($x)) {
         return array_map('trim_array', $x);
      } else {
       return trim($x);
      }
    } 

    // determines if the feed should be generated
    function get_feed($feed_parameter) {
      switch($feed_parameter) {
        case 'fy':
          $feed = 'yes';
          break;
        case 'fn':
          $feed = 'no';
          break;
        default:
          $feed = 'no';
          break;
      }
      return $feed;
    }

    // determines if the feed should be automatically uploaded to Google Base
    function get_upload($upload_parameter) {
      switch($upload_parameter) {
        case 'uy':
          $upload = 'yes';
          break;
        case 'un':
          $upload = 'no';
          break;
        default:
          $upload = 'no';
          break;
      }
      return $upload;
    }
    
    // returns the type of feed
    function get_type($type_parameter) {
      switch($type_parameter) {
        case 'tp':
          $type = 'products';
          break;
        case 'td':
          $type = 'documents';
          break;
        case 'tn':
          $type = 'news';
          break;
        default:
          $type = 'products';
          break;
      }
      return $type;
    }
    
    // performs a set of functions to see if a product is valid
    function check_product($products_id) {
      if ($this->included_categories_check(GOOGLE_MCDE_POS_CATEGORIES, $products_id) && !$this->excluded_categories_check(GOOGLE_MCDE_NEG_CATEGORIES, $products_id) && $this->included_manufacturers_check(GOOGLE_MCDE_POS_MANUFACTURERS, $products_id) && !$this->excluded_manufacturers_check(GOOGLE_MCDE_NEG_MANUFACTURERS, $products_id)) {
        return true;
      } else {
        return false;
      }
    }
    
    // check to see if a product is inside an included category
    function included_categories_check($categories_list, $products_id) {
      if ($categories_list == '') {
        return true;
      } else {
        $categories_array = split(',', $categories_list);
        $match = false;
        foreach($categories_array as $category_id) {
          if (zen_product_in_category($products_id, $category_id)) {
            $match = true;
            break;
          }
        }
        if ($match == true) {
          return true;
        } else {
          return false;
        }
      }
    }
    
    // check to see if a product is inside an excluded category
    function excluded_categories_check($categories_list, $products_id) {
      if ($categories_list == '') {
        return false;
      } else {
        $categories_array = split(',', $categories_list);
        $match = false;
        foreach($categories_array as $category_id) {
          if (zen_product_in_category($products_id, $category_id)) {
            $match = true;
            break;
          }
        }
        if ($match == true) {
          return true;
        } else {
          return false;
        }
      }
    }
    
    // check to see if a product is from an included manufacturer
    function included_manufacturers_check($manufacturers_list, $products_id) {
      if ($manufacturers_list == '') {
        return true;
      } else {
        $manufacturers_array = split(',', $manufacturers_list);
        $products_manufacturers_id = zen_get_products_manufacturers_id($products_id);
        if (in_array($products_manufacturers_id, $manufacturers_array)) {
          return true;
        } else {
          return false;
        }
      }
    }
    
    function excluded_manufacturers_check($manufacturers_list, $products_id) {
      if ($manufacturers_list == '') {
        return false;
      } else {
        $manufacturers_array = split(',', $manufacturers_list);
        $products_manufacturers_id = zen_get_products_manufacturers_id($products_id);
        if (in_array($products_manufacturers_id, $manufacturers_array)) {
          return true;
        } else {
          return false;
        }
      }
    }
    
    // returns an array containing the category name and cPath
    function google_mcde_get_category($products_id) {
      global $categories_array, $db;
      static $p2c;
      if(!$p2c) {
        $q = $db->Execute("SELECT *
                          FROM " . TABLE_PRODUCTS_TO_CATEGORIES);
        while (!$q->EOF) {
          if(!isset($p2c[$q->fields['products_id']]))
            $p2c[$q->fields['products_id']] = $q->fields['categories_id'];
          $q->MoveNext();
        }
      }
      if(isset($p2c[$products_id])) {
        $retval = $categories_array[$p2c[$products_id]]['name'];
        $cPath = $categories_array[$p2c[$products_id]]['cPath'];
      } else {
        $cPath = $retval =  "";
      }
      return array($retval, $cPath);
    }
    
    // builds the category tree
    function google_mcde_category_tree($id_parent=0, $cPath='', $cName='', $cats=array()){
      global $db, $languages;
      $cat = $db->Execute("SELECT c.categories_id, c.parent_id, cd.categories_name
                           FROM " . TABLE_CATEGORIES . " c
                             LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd on c.categories_id = cd.categories_id
                           WHERE c.parent_id = '" . (int)$id_parent . "'
                           AND cd.language_id='" . (int)$languages->fields['languages_id'] . "'
                           AND c.categories_status= '1'",
                           '', false, 150);
      while (!$cat->EOF) {
        $cats[$cat->fields['categories_id']]['name'] = (zen_not_null($cName) ? $cName . ', ' : '') . trim($cat->fields['categories_name']); // previously used zen_froogle_sanita instead of trim
        $cats[$cat->fields['categories_id']]['cPath'] = (zen_not_null($cPath) ? $cPath . ',' : '') . $cat->fields['categories_id'];
        if (zen_has_category_subcategories($cat->fields['categories_id'])) {
          $cats = $this->google_mcde_category_tree($cat->fields['categories_id'], $cats[$cat->fields['categories_id']]['cPath'], $cats[$cat->fields['categories_id']]['name'], $cats);
        }
        $cat->MoveNext();
      }
      return $cats;
    }
    
    function google_mcde_sanita($str, $rt=false) {
      //global $products;
      
      $str = str_replace(array("\t" , "\n", "\r", "&nbsp;", "<li>", "</li>", "<p>", "</p>", "<br />", "<blockquote>", "</blockquote>", "<tr>", "</tr>", "•"), ' ', $str);
      $str = strip_tags($str);
      $str = preg_replace('/\s\s+/', ' ', $str);
      // if (phpversion() >= 5) $str = htmlspecialchars_decode($str);
      // $str = htmlentities(html_entity_decode($str));
      // keep quotes as char
      $str = str_replace("&quot;", "\"", $str);
      $str = str_replace("ä", "ä", $str);
      $str = str_replace("ü", "ü", $str);
	  $str = str_replace("ö", "ö", $str);
      // preserve &amp;
      
      $str = str_replace(array("&amp;", "&"), "AMPERSAN", $str);
      
      $str = preg_replace('/AMPERSAN[A-Za-z0-9#]{1,10};/', '', $str); // remove all entities, shouldn't be longer than 10 characters?
      
      // readd &amp;
      $str = str_replace("AMPERSAN", "&", $str);
     
      $_cleaner_array = array(">" => "> ", "®" => "(r)", "™" => "(tm)", "©" => "(c)", "‘" => "'", "’" => "'", "—" => "-", "–" => "-", "&" => "&amp;", "&amp;amp;" => "&amp;", "“" => "\"", "”" => "\"", "…" => "...");
      $str = strtr($str, $_cleaner_array);
      return $str;
    }
    
    function google_mcde_taxonomysanita($str, $rt=false) {
      //for taxonomy
      
      $str = str_replace(array("\t" , "\n", "\r", "&nbsp;", "<li>", "</li>", "<p>", "</p>", "<br />", "<blockquote>", "</blockquote>", "<tr>", "</tr>", "•"), ' ', $str);
      $str = strip_tags($str);
      $str = preg_replace('/\s\s+/', ' ', $str);
      // if (phpversion() >= 5) $str = htmlspecialchars_decode($str);
      // $str = htmlentities(html_entity_decode($str));
      // keep quotes as char
      $str = str_replace("&quot;", "\"", $str);
      $str = str_replace("ä", "ä", $str);
      $str = str_replace("ü", "ü", $str);
	  $str = str_replace("ö", "ö", $str);
      // preserve &amp;
      
      $str = str_replace(array("&amp;", "&"), "AMPERSAN", $str);
      
      $str = preg_replace('/AMPERSAN[A-Za-z0-9#]{1,10};/', '', $str); // remove all entities, shouldn't be longer than 10 characters?
     
      // readd &amp;
      $str = str_replace("AMPERSAN", "&", $str);
      
      $_cleaner_array = array(">" => "&gt; ", "®" => "(r)", "™" => "(tm)", "©" => "(c)", "‘" => "'", "’" => "'", "—" => "-", "–" => "-", "&" => "&", "&amp;amp;" => "&amp;", "“" => "\"", "”" => "\"", "…" => "...");
      $str = strtr($str, $_cleaner_array);
      return $str;
    }
    
    
    
    function google_mcde_xml_sanitizer($str, $cdata = false) {
      $str = $this->google_mcde_sanita($str);
      $length = strlen($str);
      for ($i = 0; $i < $length; $i++) {
        $current = ord($str{$i});
        if ((($current == 0x9) || ($current == 0xA) || ($current == 0xD) || (($current >= 0x20) && ($current <= 0xD7FF)) || (($current >= 0xE000) && ($current <= 0xFFFD)) || (($current >= 0x10000) && ($current <= 0x10FFFF))) && ($current > 10) ) {
          $out .= chr($current);
        } else {
          $out .= " ";
        }
      }
      $str = trim($str);
     
      return $str;
    }
    
    // creates the url for the products_image
    function google_mcde_image_url($products_image) {
      if($products_image == "") return "";
      if (defined('GOOGLE_MCDE_ALTERNATE_IMAGE_URL') && GOOGLE_MCDE_ALTERNATE_IMAGE_URL != '') {
        return GOOGLE_MCDE_ALTERNATE_IMAGE_URL . $products_image; 
      }
      $products_image_extention = substr($products_image, strrpos($products_image, '.'));
      $products_image_base = ereg_replace($products_image_extention, '', $products_image);
      $products_image_medium = $products_image_base . IMAGE_SUFFIX_MEDIUM . $products_image_extention;
      $products_image_large = $products_image_base . IMAGE_SUFFIX_LARGE . $products_image_extention;

      // check for a medium image else use small
      if (!file_exists(DIR_WS_IMAGES . 'medium/' . $products_image_medium)) {
        $products_image_medium = DIR_WS_IMAGES . $products_image;
      } else {
        $products_image_medium = DIR_WS_IMAGES . 'medium/' . $products_image_medium;
      }
      // check for a large image else use medium else use small
      if (!file_exists(DIR_WS_IMAGES . 'large/' . $products_image_large)) {
        if (!file_exists(DIR_WS_IMAGES . 'medium/' . $products_image_medium)) {
          $products_image_large = DIR_WS_IMAGES . $products_image;
        } else {
          $products_image_large = DIR_WS_IMAGES . 'medium/' . $products_image_medium;
        }
      } else {
        $products_image_large = DIR_WS_IMAGES . 'large/' . $products_image_large;
      }
      if ((function_exists('handle_image')) && (GOOGLE_MCDE_IMAGE_HANDLER == 'true')) {
        $image_ih = handle_image($products_image_large, '', LARGE_IMAGE_MAX_WIDTH, LARGE_IMAGE_MAX_HEIGHT, '');
        $retval = (HTTP_SERVER . DIR_WS_CATALOG . $image_ih[0]);
      } else {
        $retval = (HTTP_SERVER . DIR_WS_CATALOG . $products_image_large);
      }
      return $retval;
    }
    
    // creates the url for a News and Articles Manager article
    function google_mcde_news_link($article_id) {
      $link = zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . (int)$article_id . $product_url_add, 'NONSSL', false);
      return $link;
    }
    
    function google_mcde_expiration_date($base_date) {
      if(GOOGLE_MCDE_EXPIRATION_BASE == 'now')
        $expiration_date = time();
      else
        $expiration_date = strtotime($base_date);
      $expiration_date += GOOGLE_MCDE_EXPIRATION_DAYS*24*60*60;
      $retval = (date('Y-m-d', $expiration_date));
      return $retval;
    }
    
// SHIPPING FUNCTIONS //

  function get_countries_iso_code_2($countries_id) {
    global $db;

    $countries_query = "select countries_iso_code_2
                        from " . TABLE_COUNTRIES . "
                        where countries_id = '" . $countries_id . "'
                        limit 1";
    $countries = $db->Execute($countries_query);
    $countries_iso_code_2 = $countries->fields['countries_iso_code_2'];
    return $countries_iso_code_2;
  }

  function shipping_rate($method, $percategory='', $freerules='', $table_zone = '', $products_weight = '', $products_price = '', $products_id = '') {
    global $currencies, $percategory, $freerules;
    // skip the calculation for products that are always free shipping
    if (zen_get_product_is_always_free_shipping($products_id)) {
      $rate = 0;
    } else {
      switch ($method) {
        case "zones table rate":
          $rate = $this->numinix_zones_table_rate($products_weight, $table_zone);
          break;
        case "flat rate":
          $rate = MODULE_SHIPPING_FLAT_COST;
          break;
        case "per item":
          $rate = MODULE_SHIPPING_ITEM_COST + MODULE_SHIPPING_ITEM_HANDLING;
          break;
        case "per weight unit":
          $rate = (MODULE_SHIPPING_PERWEIGHTUNIT_COST * $products_weight) + MODULE_SHIPPING_PERWEIGHTUNIT_HANDLING;
          break;
        case "table rate":
          $rate = $this->numinix_table_rate($products_weight, $products_price);
          break;
        case "zones":
          $rate = $this->numinix_zones_rate($products_weight, $products_price, $table_zone);
          break;
        case "percategory":
          if (is_object($percategory)) {
            $products_array = array();
            $products_array[0]['id'] = $products_id;
            $rate = $percategory->calculation($products_array, $table_zone, (int)MODULE_SHIPPING_PERCATEGORY_GROUPS);
          }
          break;
        case "free shipping":
          $rate = 0;
          break;
        case "free rules shipping":
          if (is_object($freerules)) {
            if ($freerules->test($products_id)) {
              $rate = 0;
            } else {
              $rate = -1;
            }
          }
          break;
        // this shouldn't be possible
        case "none":
          $rate = -1;
          break; 
        default:
          $rate = -1;
          break;
      }
    }
    //if ($rate >= 0) {
       //$rate = $currencies->format($rate, true, GOOGLE_MCDE_CURRENCY, $currencies->get_value(GOOGLE_MCDE_CURRENCY));
    //}
    return $rate;
  }
  
  function numinix_table_rate($products_weight, $products_price) {
    global $currencies;
    
     switch (MODULE_SHIPPING_TABLE_MODE) {
      case ('price'):
        $order_total = $products_price;
        break;
      case ('weight'):
        $order_total = $products_weight;
        break;
      case ('item'):
        $order_total = 1;
        break;
    }

    $table_cost = split("[:,]" , MODULE_SHIPPING_TABLE_COST);
    $size = sizeof($table_cost);
    for ($i=0, $n=$size; $i<$n; $i+=2) {
      if (round($order_total,9) <= $table_cost[$i]) {
        if (strstr($table_cost[$i+1], '%')) {
          $shipping = ($table_cost[$i+1]/100) * $products_price;
        } else {
          $shipping = $table_cost[$i+1];
        }
        break;
      }
    }
    $shipping = $shipping + MODULE_SHIPPING_TABLE_HANDLING;
    return $shipping;
  }
    
  function numinix_zones_table_rate($products_weight, $table_zone) {
    global $currencies;
    
    switch (MODULE_SHIPPING_ZONETABLE_MODE) {
      case ('price'):
        $order_total = $products_price;
        break;
      case ('weight'):
        $order_total = $products_weight;
        break;
      case ('item'):
        $order_total = 1;
        break;
    }
    
    $table_cost = split("[:,]" , constant('MODULE_SHIPPING_ZONETABLE_COST_' . $table_zone));
    $size = sizeof($table_cost);
    for ($i=0, $n=$size; $i<$n; $i+=2) {
      if (round($order_total,9) <= $table_cost[$i]) {
        $shipping = $table_cost[$i+1];
        break;
      }
    }
    $shipping = $shipping + constant('MODULE_SHIPPING_ZONETABLE_HANDLING_' . $table_zone);
    return $shipping;
  }
  
  function numinix_zones_rate($products_weight, $products_price, $table_zone) {
    global $currencies;
    
    switch (MODULE_SHIPPING_ZONES_METHOD) {
      case ('Price'):
        $order_total = $products_price;
        break;
      case ('Weight'):
        $order_total = $products_weight;
        break;
      case ('Item'):
        $order_total = 1;
        break;
    }
    
    $zones_cost = constant('MODULE_SHIPPING_ZONES_COST_' . $table_zone);
    $zones_table = split("[:,]" , $zones_cost);
    $size = sizeof($zones_table);
    for ($i=0; $i<$size; $i+=2) {
      if (round($order_total,9) <= $zones_table[$i]) {
        if (strstr($zones_table[$i+1], '%')) {
          $shipping = ($zones_table[$i+1]/100) * $products_price;
        } else {
          $shipping = $zones_table[$i+1];
        }
         break;
      }
    }
    $shipping = $shipping + constant('MODULE_SHIPPING_ZONES_HANDLING_' . $table_zone);
    return $shipping;
  }
// PRICE FUNCTIONS

// Actual Price Retail
// Specials and Tax Included
  function google_get_products_actual_price($products_id) {
    global $db, $currencies;
    $product_check = $db->Execute("select products_tax_class_id, products_price, products_priced_by_attribute, product_is_free, product_is_call from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'" . " limit 1");

    $show_display_price = '';
    $display_normal_price = $this->google_get_products_base_price($products_id);
    //echo $display_normal_price . '<br />';
    $display_special_price = $this->google_get_products_special_price($products_id, $display_normal_price, true);
    //echo $display_special_price . '<br />';
    $display_sale_price = $this->google_get_products_special_price($products_id, $display_normal_price, false);
    //echo $display_sale_price . '<br />';
    $products_actual_price = $display_normal_price;

    if ($display_special_price) {
      $products_actual_price = $display_special_price;
    }
    if ($display_sale_price) {
      $products_actual_price = $display_sale_price;
    }

    // If Free, Show it
    if ($product_check->fields['product_is_free'] == '1') {
      $products_actual_price = 0;
    }
    //die();

    return $products_actual_price;
  }

// computes products_price + option groups lowest attributes price of each group when on
  function google_get_products_base_price($products_id) {
    global $db;
      $product_check = $db->Execute("select products_price, products_priced_by_attribute from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");

// is there a products_price to add to attributes
      $products_price = $product_check->fields['products_price'];

      // do not select display only attributes and attributes_price_base_included is true
      $product_att_query = $db->Execute("select options_id, price_prefix, options_values_price, attributes_display_only, attributes_price_base_included from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and attributes_display_only != '1' and attributes_price_base_included='1' and options_values_price > 0". " order by options_id, price_prefix, options_values_price");
      //echo $products_id . ' ';
      //print_r($product_att_query);
      //die();
      $the_options_id= 'x';
      $the_base_price= 0;
// add attributes price to price
      if ($product_check->fields['products_priced_by_attribute'] == '1' and $product_att_query->RecordCount() >= 1) {
        while (!$product_att_query->EOF) {
          if ( $the_options_id != $product_att_query->fields['options_id']) {
            $the_options_id = $product_att_query->fields['options_id'];
            $the_base_price += $product_att_query->fields['options_values_price'];
            //echo $product_att_query->fields['options_values_price'];
            //die();
          }
          $product_att_query->MoveNext();
        }

        $the_base_price = $products_price + $the_base_price;
      } else {
        $the_base_price = $products_price;
      }
      //echo $the_base_price;
      return $the_base_price;
  }
  
//get specials price or sale price
  function google_get_products_special_price($product_id, $product_price, $specials_price_only=false) {
    global $db;
    $product = $db->Execute("select products_price, products_model, products_priced_by_attribute from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");

    //if ($product->RecordCount() > 0) {
//      $product_price = $product->fields['products_price'];
      //$product_price = zen_get_products_base_price($product_id);
    //} else {
      //return false;
    //}

    $specials = $db->Execute("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "' and status='1'");
    if ($specials->RecordCount() > 0) {
//      if ($product->fields['products_priced_by_attribute'] == 1) {
        $special_price = $specials->fields['specials_new_products_price'];
    } else {
      $special_price = false;
    }

    if(substr($product->fields['products_model'], 0, 4) == 'GIFT') {    //Never apply a salededuction to Ian Wilson's Giftvouchers
      if (zen_not_null($special_price)) {
        return $special_price;
      } else {
        return false;
      }
    }

// return special price only
    if ($specials_price_only==true) {
      if (zen_not_null($special_price)) {
        return $special_price;
      } else {
        return false;
      }
    } else {
// get sale price

// changed to use master_categories_id
//      $product_to_categories = $db->Execute("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
//      $category = $product_to_categories->fields['categories_id'];

      $product_to_categories = $db->Execute("select master_categories_id from " . TABLE_PRODUCTS . " where products_id = '" . $product_id . "'");
      $category = $product_to_categories->fields['master_categories_id'];

      $sale = $db->Execute("select sale_specials_condition, sale_deduction_value, sale_deduction_type from " . TABLE_SALEMAKER_SALES . " where sale_categories_all like '%," . $category . ",%' and sale_status = '1' and (sale_date_start <= now() or sale_date_start = '0001-01-01') and (sale_date_end >= now() or sale_date_end = '0001-01-01') and (sale_pricerange_from <= '" . $product_price . "' or sale_pricerange_from = '0') and (sale_pricerange_to >= '" . $product_price . "' or sale_pricerange_to = '0')");
      if ($sale->RecordCount() < 1) {
         return $special_price;
      }

      if (!$special_price) {
        $tmp_special_price = $product_price;
      } else {
        $tmp_special_price = $special_price;
      }
      switch ($sale->fields['sale_deduction_type']) {
        case 0:
          $sale_product_price = $product_price - $sale->fields['sale_deduction_value'];
          $sale_special_price = $tmp_special_price - $sale->fields['sale_deduction_value'];
          break;
        case 1:
          $sale_product_price = $product_price - (($product_price * $sale->fields['sale_deduction_value']) / 100);
          $sale_special_price = $tmp_special_price - (($tmp_special_price * $sale->fields['sale_deduction_value']) / 100);
          break;
        case 2:
          $sale_product_price = $sale->fields['sale_deduction_value'];
          $sale_special_price = $sale->fields['sale_deduction_value'];
          break;
        default:
          return $special_price;
      }

      if ($sale_product_price < 0) {
        $sale_product_price = 0;
      }

      if ($sale_special_price < 0) {
        $sale_special_price = 0;
      }

      if (!$special_price) {
        return number_format($sale_product_price, 4, '.', '');
      } else {
        switch($sale->fields['sale_specials_condition']){
          case 0:
            return number_format($sale_product_price, 4, '.', '');
            break;
          case 1:
            return number_format($special_price, 4, '.', '');
            break;
          case 2:
            return number_format($sale_special_price, 4, '.', '');
            break;
          default:
            return number_format($special_price, 4, '.', '');
        }
      }
    }
  }

// FTP FUNCTIONS //
    
    function ftp_file_upload($url, $login, $password, $local_file, $ftp_dir='', $ftp_file=false, $ssl=false, $ftp_mode=FTP_ASCII) {
      if(!is_callable('ftp_connect')) {
        echo FTP_FAILED . NL;
        return false;
      }
      if(!$ftp_file)
        $ftp_file = basename($local_file);
      ob_start();
      if($ssl)
        $cd = ftp_ssl_connect($url);
      else
        $cd = ftp_connect($url);
      if (!$cd) {
        $out = $this->ftp_get_error_from_ob();
        echo FTP_CONNECTION_FAILED . ' ' . $url . NL;
        echo $out . NL;
        return false;
      }
      echo FTP_CONNECTION_OK . ' ' . $url . NL;
      $login_result = ftp_login($cd, $login, $password);
      if (!$login_result) {
        $out = $this->ftp_get_error_from_ob();
  //      echo FTP_LOGIN_FAILED . FTP_USERNAME . ' ' . $login . FTP_PASSWORD . ' ' . $password . NL;
        echo FTP_LOGIN_FAILED . NL;
        echo $out . NL;
        ftp_close($cd);
        return false;
      } else {
  //    echo FTP_LOGIN_OK . FTP_USERNAME . ' ' . $login . FTP_PASSWORD . ' ' . $password . NL;
        echo FTP_LOGIN_OK . NL;
        if ($ftp_dir != "") {
          if (!ftp_chdir($cd, $ftp_dir)) {
            $out = $this->ftp_get_error_from_ob();
            echo FTP_CANT_CHANGE_DIRECTORY . '&nbsp;' . $url . NL;
            echo $out . NL;
            ftp_close($cd);
            return false;
          }
        }
        echo FTP_CURRENT_DIRECTORY . '&nbsp;' . ftp_pwd($cd) . NL;
        if (GOOGLE_MCDE_PASV == 'true') {
          $pasv = true;
        } else {
          $pasv = false;
        }
        ftp_pasv($cd, $pasv);
        $upload = ftp_put($cd, $ftp_file, $local_file, $ftp_mode);
        $out = $this->ftp_get_error_from_ob();
        $raw = ftp_rawlist($cd, $ftp_file, true);
        for($i=0,$n=sizeof($raw);$i<$n;$i++){
          $out .= $raw[$i] . '<br/>';
        }
        if (!$upload) {
          echo FTP_UPLOAD_FAILED . NL;
          if(isset($raw[0])) echo $raw[0] . NL;
          echo $out . NL;
          ftp_close($cd);
          return false;
        } else {
          echo FTP_UPLOAD_SUCCESS . NL;
          echo $raw[0] . NL;
          echo $out . NL;
        }
        ftp_close($cd);
        return true;
      }
    }

    function ftp_get_error_from_ob() {
      $out = ob_get_contents();
      ob_end_clean();
      $out = str_replace(array('\\', '<!--error-->', '<br>', '<br />', "\n", 'in <b>'),array('/', '', '', '', '', ''),$out);
      if(strpos($out, DIR_FS_CATALOG) !== false){
        $out = substr($out, 0, strpos($out, DIR_FS_CATALOG));
      }
      return $out;
    }

    function microtime_float() {
       list($usec, $sec) = explode(" ", microtime());
       return ((float)$usec + (float)$sec);
    }
  }
