<?php
/**
 * googlemcde.php
 *
 * @package google merchant center deutschland 3.0 for Zen-Cart 1.3.9 german
 * @copyright Copyright 2007 Numinix Technology http://www.numinix.com
 * @copyright Portions Copyright 2011 webchills http://www.webchills.at
 * @copyright Portions Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: googlefroogle.php 60 2011-05-31 21:18:54Z numinix $
 * @version $Id: gmcde.php 2011-10-01 16:29:54Z webchills $
 */
 /* configuration */
  ini_set('max_execution_time', 900); // change to whatever time you need
  ini_set('mysql.connect_timeout', 300); // change to whatever time you need
  ini_set('memory_limit','128M'); // change to whatever you need
  set_time_limit(900); // change to whatever time you need
  $keepAlive = 100;  // perform a keep alive every x number of products
  /* end configuration */
  
  
  
  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'gmc_de.php');
  $google_mcde = new google_mcde();
  
  
   
  @define('GOOGLE_MCDE_EXPIRATION_DAYS', 29);
  @define('GOOGLE_MCDE_EXPIRATION_BASE', 'now'); // now/product
  @define('GOOGLE_MCDE_OFFER_ID', 'id'); // id/model/false
  @define('GOOGLE_MCDE_DIRECTORY', 'feed/');
  @define('GOOGLE_MCDE_OUTPUT_BUFFER_MAXSIZE', 1024*1024);
  $anti_timeout_counter = 0; //for timeout issues as well as counting number of products processed
  $google_mcde_start_counter = 0; //for counting all products regardless of inclusion
  @define('GOOGLE_MCDE_USE_CPATH', 'false');
  @define('NL', "<br />\n");
  
  // process parameters
  $parameters = split('_', $_GET['feed']); // ?feed=fy_uy_tp
  $feed_parameter = $parameters[0];
  $feed = $google_mcde->get_feed($feed_parameter);
  $upload_parameter = $parameters[1];
  $upload = $google_mcde->get_upload($upload_parameter);
  $type_parameter = $parameters[2];
  $type = $google_mcde->get_type($type_parameter);
  $key = $_GET['key'];
  if ($key != GOOGLE_MCDE_KEY) exit('<p>Falscher Sicherheitskey!</p>');
  if (isset($_GET['upload_file'])) {
    $upload_file = DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . $_GET['upload_file'];
  } else {
    // sql limiters
    if ((int)GOOGLE_MCDE_MAX_PRODUCTS > 0 || (isset($_GET['limit']) && (int)$_GET['limit'] > 0)) {
      $query_limit = (isset($_GET['limit']) && (int)$_GET['limit'] > 0) ? (int)$_GET['limit'] : (int)GOOGLE_MCDE_MAX_PRODUCTS; 
      $limit = ' LIMIT ' . $query_limit; 
    }
    if ((int)GOOGLE_MCDE_START_PRODUCTS > 0 || (isset($_GET['offset']) && (int)$_GET['offset'] > 0)) {
      $query_offset = (isset($_GET['offset']) && (int)$_GET['offset'] > 0) ? (int)$_GET['offset'] : (int)GOOGLE_MCDE_START_PRODUCTS;
      $offset = ' OFFSET ' . $query_offset;
    }   
    $outfile = DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . GOOGLE_MCDE_OUTPUT_FILENAME . "_" . $type;
    if ($query_limit > 0) $outfile .= '_' . $query_limit; 
    if ($query_offset > 0) $outfile .= '_' . $query_offset;
    $outfile .= '.xml'; //example domain_products.xml
  }

  
    
  require(zen_get_file_directory(DIR_WS_LANGUAGES . strtolower(german) .'/', 'googlemcde.php', 'false'));
  $language = ucwords(strtolower(GOOGLE_MCDE_LANGUAGE));
  $languages = $db->execute("select code, languages_id from " . TABLE_LANGUAGES . " where name='" . $language . "' limit 1");
  $product_url_add = (GOOGLE_MCDE_LANGUAGE_DISPLAY == 'true' ? "&language=" . $languages->fields['code'] : '') . (GOOGLE_MCDE_CURRENCY_DISPLAY == 'true' ? "&currency=" . GOOGLE_MCDE_CURRENCY : '');

  echo sprintf(TEXT_GOOGLE_MCDE_STARTED, $google_mcde->google_mcde_version()) . NL;
  echo TEXT_GOOGLE_MCDE_FILE_LOCATION . (($upload_file != '') ? $upload_file : $outfile) . NL;
  echo "Verarbeitung: Feed - " . (isset($feed) && $feed == "yes" ? "Yes" : "No") . ", Upload - " . (isset($upload) && $upload == "yes" ? "Yes" : "No") . NL;

  if (isset($feed) && $feed == "yes") {
    if (is_dir(DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY)) {
      if (!is_writeable(DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY)) {
        echo ERROR_GOOGLE_MCDE_DIRECTORY_NOT_WRITEABLE . NL;
        die;
      }
    } else {
      echo ERROR_GOOGLE_MCDE_DIRECTORY_DOES_NOT_EXIST . NL;
      die;
    }

    $stimer_feed = $google_mcde->microtime_float();
    if (!get_cfg_var('safe_mode') && function_exists('safe_mode')) {
      set_time_limit(0);
    }

    $output_buffer = "";


    if (file_exists($outfile)) {
      chmod($outfile, 0777);
    } else {
      fopen($outfile, "w");
    }
    if (is_writeable($outfile)) {
      
      $content = array();
      
      $content["xml"] = '<?xml version="1.0" encoding="UTF-8" ?>';
      $content["rss"] = '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
      $content["channel"]= '<channel>';
      $content["title"] = '<title>' . $google_mcde->google_mcde_xml_sanitizer(STORE_NAME, true) . '</title>';
      $content["link"] = '<link>' . GOOGLE_MCDE_ADDRESS . '</link>';
      $content["channel_description"] = '<description>' . $google_mcde->google_mcde_xml_sanitizer(GOOGLE_MCDE_DESCRIPTION, true) . '</description>';
      $google_mcde->google_mcde_fwrite($content, "wb");
      
      
      $categories_array = $google_mcde->google_mcde_category_tree();
      
      $additional_attributes = '';
      $additional_tables = '';
      // ean
      if (GOOGLE_MCDE_EAN == 'true') {
        $additional_attributes .= ", p.products_ean";
      }
      // brand
      if (GOOGLE_MCDE_BRAND == 'true') {
        $additional_attributes .= ", p.products_brand";
      }
      // isbn
      if (GOOGLE_MCDE_ISBN == 'true') {
        $additional_attributes .= ", p.products_isbn";
        }
     // condition
            $additional_attributes .= ", p.products_condition";
     // availability   
        $additional_attributes .= ", p.products_availability";
		// google product taxonomy
        $additional_attributes .= ", p.products_taxonomy";
      
      
      if (GOOGLE_MCDE_META_TITLE == 'true') {
        $additional_attributes .= ", mtpd.metatags_title";
        $additional_tables .= " LEFT JOIN " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . " mtpd ON (p.products_id = mtpd.products_id) ";
      }
      
      switch($type) {
        case "products":
          $products_query = "SELECT distinct(pd.products_name), p.products_id, p.products_model, pd.products_description, p.products_image, p.products_tax_class_id, p.products_price_sorter, p.products_priced_by_attribute, p.products_type, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0), IFNULL(p.products_date_available, 0)) AS base_date, m.manufacturers_name, p.products_quantity, pt.type_handler, p.products_weight" . $additional_attributes . "
                             FROM " . TABLE_PRODUCTS . " p
                               LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)
                               LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (p.products_id = pd.products_id)
                               LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON (p.products_type=pt.type_id)"
                             . $additional_tables . 
                             "WHERE p.products_status = 1
                               AND p.products_type <> 3
                               AND p.product_is_call <> 1
                               AND p.product_is_free <> 1
                               AND pd.language_id = " . (int)$languages->fields['languages_id'] ."
                             GROUP BY pd.products_name
                             ORDER BY p.products_id ASC" . $limit . $offset . ";";
// debugging, comment out to disable
//echo $products_query . '<br />';
//print_r($products);
//die();
          $products = $db->Execute($products_query);
          //die('record count: ' . $products->RecordCount());
          while (!$products->EOF) { // run until end of file or until maximum number of products reached
            $google_mcde_start_counter++;
            // reset tax array
            $tax_rate = array();
            list($categories_list, $cPath) = $google_mcde->google_mcde_get_category($products->fields['products_id']);
            if (GOOGLE_MCDE_DEBUG == 'true') {
              if (!$google_mcde->check_product($products->fields['products_id'])) echo $products->fields['products_id'] . ' skipped due to user restrictions<br />';
            }
            if ($google_mcde->check_product($products->fields['products_id'])) {
              if ($gb_map_enabled && $products->fields['map_enabled'] == '1') {
                $price = $products->fields['map_price'];
              } else {
                $price = $google_mcde->google_get_products_actual_price($products->fields['products_id']);
              }
              //BEGIN ZERO QUANTITY CHECK
              if (GOOGLE_MCDE_ZERO_QUANTITY == 'false') {
                if ($products->fields['products_quantity'] > 0) {
                  $zero_quantity = false;
                } else {
                  $zero_quantity = true;
                }
              } else {
                $zero_quantity = false;
              }
              
              $products_description = $products->fields['products_description'];
              
              $products_description = $google_mcde->google_mcde_xml_sanitizer($products_description);
              if ( (GOOGLE_MCDE_META_TITLE == 'true') && ($products->fields['metatags_title'] != '') ) {
                $productstitle = $google_mcde->google_mcde_xml_sanitizer($products->fields['metatags_title']);
              } else {
                $productstitle = $google_mcde->google_mcde_xml_sanitizer($products->fields['products_name']); 
              }
              if (GOOGLE_MCDE_DEBUG == 'true') {
                $success = false;
                echo 'id: ' . $products->fields['products_id'] . ', price: ' . round($price, 2) . ', description length: ' . strlen($products_description) . ' ';
                if ( ($price <= 0) || (strlen($products_description) < 15 || strlen($productstitle) < 3) ) {
                  echo '- skipped, price below zero, description length less than 15 chars, or title less than 3 chars';
                } else {
                  if ($zero_quantity == false) {
                    echo '- including';
                  } else {
                    echo '- skipped, zero quantity product.  turn on include zero quantity to include.';
                  }
                }
              }
              
              if (($price > 0) && ($zero_quantity == false) && (strlen($products_description) >= 15)) {
                if (GOOGLE_MCDE_DEBUG == 'true') {
                  $success = true;
                }
                $anti_timeout_counter++;
               
                $tax_rate = zen_get_tax_rate($products->fields['products_tax_class_id']);
                
                // calculate tax for tax amount
                //$tax_amount = zen_calculate_tax($price, $tax_rate);
                // the following will only add the tax if DISPLAY_PRICE_WITH_TAX is set to true in the Zen Cart admin
                $price = zen_add_tax($price, $tax_rate);
                
                // modify price to match defined currency
                $price = $currencies->value($price, true, GOOGLE_MCDE_CURRENCY, $currencies->get_value(GOOGLE_MCDE_CURRENCY));
                
                
                  $link = ($products->fields['type_handler'] ? $products->fields['type_handler'] : 'product') . '_info';
                  $cPath_href = (GOOGLE_MCDE_USE_CPATH == 'true' ? 'cPath=' . $cPath . '&' : '');
                  $link = zen_href_link($link, $cPath_href . 'products_id=' . (int)$products->fields['products_id'] . $product_url_add, 'NONSSL', false);
                  $link = $google_mcde->google_mcde_xml_sanitizer($link, true);
               
                $product_type = $google_mcde->google_mcde_get_category($products->fields['products_id']);
                array_pop($product_type); // removes category number from end
                $product_type = explode(',', $product_type[0]);
                
                                
                $content = array();
                $content["item_start"] = "\n" . '<item>';
                if ( (GOOGLE_MCDE_META_TITLE == 'true') && ($products->fields['metatags_title'] != '') ) {
                  $content["title"] = '<title>' . substr($google_mcde->google_mcde_xml_sanitizer($products->fields['metatags_title'], true), 0, 70) . '</title>';
                } else {
                  $content["title"] = '<title>' . substr($google_mcde->google_mcde_xml_sanitizer($products->fields['products_name'], true), 0, 70) . '</title>'; 
                }
              
                if ($products->fields['manufacturers_name'] != '') {
                  $content["manufacturer"] = '<g:manufacturer>' . $google_mcde->google_mcde_xml_sanitizer($products->fields['manufacturers_name'], true) . '</g:manufacturer>';
                }
                
                
                  $content["condition"] = '<g:condition>' . $products->fields['products_condition'] . '</g:condition>';
                  
                   $content["availability"] = '<g:availability>' . $products->fields['products_availability'] . '</g:availability>';
                
                  
                if (GOOGLE_MCDE_PRODUCT_TYPE == 'default') {
                  $content["product_type"] = '<g:product_type>' . $google_mcde->google_mcde_xml_sanitizer(GOOGLE_MCDE_DEFAULT_PRODUCT_TYPE) . '</g:product_type>';
                } else {
                  $product_type = $google_mcde->google_mcde_get_category($products->fields['products_id']);
                  array_pop($product_type); // removes category number from end
                  $product_type = explode(',', $product_type[0]);
                if (GOOGLE_MCDE_PRODUCT_TYPE == 'top') {
                    $top_level = $product_type[0];
                  $content["product_type"] = '<g:product_type>' . $google_mcde->google_mcde_xml_sanitizer($top_level) . '</g:product_type>';
                } elseif (GOOGLE_MCDE_PRODUCT_TYPE == 'bottom') {
                  $bottom_level = array_pop($product_type); // sets last category in array as bottom-level
                  $bottom_level = htmlentities($bottom_level);
                  $content["product_type"] = '<g:product_type>' . $google_mcde->google_mcde_xml_sanitizer($bottom_level) . '</g:product_type>';
                } elseif (GOOGLE_MCDE_PRODUCT_TYPE == 'full') {
                  $full_path = implode(",", $product_type);
                  $full_path = htmlentities($full_path);
                  $content["product_type"] = '<g:product_type>' . $google_mcde->google_mcde_xml_sanitizer($full_path) . '</g:product_type>';
                  }
                }
                              
                $content["expiration_date"] = '<g:expiration_date>' . $google_mcde->google_mcde_expiration_date($products->fields['base_date']) . '</g:expiration_date>';
                
               
               $content["id"] = '<g:id>' . $products->fields['products_id'] . '</g:id>';
                  
                if ($products->fields['products_image'] != '') {
                  $content["image_link"] = '<g:image_link>' . $google_mcde->google_mcde_image_url($products->fields['products_image']) . '</g:image_link>';
                  $additional_images = $google_mcde->additional_images($products->fields['products_image']);
                  if (is_array($additional_images) && sizeof($additional_images) > 0) {
                    $count = 0;
                    foreach ($additional_images as $additional_image) {
                      $count++;
                      $content["image_link"] .= '<g:image_link>' . $additional_image . '</g:image_link>';
                      if ($count == 9) break; // max 10 images including main image 
                    }
                  }
                }
                $content["link"] = '<link>' . $link . '</link>';
                $content["price"] = '<g:price>' . number_format($price, 2, '.', '') . '</g:price>';
                
                if ($products->fields['products_model'] != '') {
                  $content["mpn"] = '<g:mpn>' . $google_mcde->google_mcde_sanita($products->fields['products_model'], true) . '</g:mpn>';
                }
                if (GOOGLE_MCDE_EAN == 'true' && $products->fields['products_ean'] != '') {
                $content["ean"] = '<g:ean>' . $google_mcde->google_mcde_sanita($products->fields['products_ean'], true) . '</g:ean>';
                }
                if (GOOGLE_MCDE_ISBN == 'true' && $products->fields['products_isbn'] != '') {
                $content["isbn"] = '<g:isbn>' . $google_mcde->google_mcde_sanita($products->fields['products_isbn'], true) . '</g:isbn>';
                }
                if (GOOGLE_MCDE_BRAND == 'true' && $products->fields['products_brand'] != '') {
                $content["brand"] = '<g:brand>' . $google_mcde->google_mcde_sanita($products->fields['products_brand'], true) . '</g:brand>';
                }
                if (GOOGLE_MCDE_BRAND == 'true' && $products->fields['products_brand'] == '') {
                $content["brand"] = '<g:brand>' . $google_mcde->google_mcde_sanita($products->fields['manufacturers_name'], true) . '</g:brand>';
                }
                // taxonomy
                if ($products->fields['products_taxonomy'] != '') {
                $content["taxonomy"] = '<g:google_product_category>' . $google_mcde->google_mcde_taxonomysanita($products->fields['products_taxonomy'], true) . '</g:google_product_category>';
                }
                
                
                if (GOOGLE_MCDE_IN_STOCK == 'true') {
                  if ($products->fields['products_quantity'] > 0) {
                    $content["quantity"] = '<g:quantity>' . $products->fields['products_quantity'] . '</g:quantity>';
                  } else {
                    $content["quantity"] = '<g:quantity>' . (int)GOOGLE_MCDE_DEFAULT_QUANTITY . '</g:quantity>';
                  }
                }
                
                
                
                if (GOOGLE_MCDE_CURRENCY_DISPLAY == 'true') {
                  $content["currency"] = '<g:currency>' . GOOGLE_MCDE_CURRENCY . '</g:currency>';
                }
                                
                if (GOOGLE_MCDE_ONLINE_ONLY == 'true') {
                  $content["online_only"] = '<g:online_only>y</g:online_only>';  
                }  
                
                if(GOOGLE_MCDE_SHIPPINGWEIGHT == 'true' && $products->fields['products_weight'] != '') {
                  $content["shipping_weight"] = '<g:shipping_weight>' . $products->fields['products_weight'] . ' ' . GOOGLE_MCDE_UNITS . '</g:shipping_weight>';
                }          
                               
                $content["description"] = '<description>' . $products_description . '</description>';
                $content["item_end"] = '</item>';
                $google_mcde->google_mcde_fwrite($content, "a");
              }
              if (GOOGLE_MCDE_DEBUG == 'true') {
                if ($success) {
                  echo ' - success';
                } else {
                  echo ' - failed';
                }
                echo '<br />';
              }
            }
            if ($google_mcde_start_counter % $keepAlive == 0) {
              echo '~'; // keep alive
            }
            $products->MoveNext();
          }
          $content = array();
          $content["channel"] = "\n" . '</channel>';
          $content["rss"] = '</rss>';
          $google_mcde->google_mcde_fwrite($content, "a");
          chmod($outfile, 0655);
          break;
        
        
      }
    } else {
      echo ERROR_GOOGLE_MCDE_OPEN_FILE . NL;
      die;
    }
    
    $timer_feed = $google_mcde->microtime_float()-$stimer_feed;
    
    echo NL . TEXT_GOOGLE_MCDE_FEED_COMPLETE . ' ' . GOOGLE_MCDE_TIME_TAKEN . ' ' . sprintf("%f " . TEXT_GOOGLE_MCDE_FEED_SECONDS, number_format($timer_feed, 6) ) . ' ' . $anti_timeout_counter . TEXT_GOOGLE_MCDE_FEED_RECORDS . NL;  
  }

  if (isset($upload) && $upload == "yes") {
    echo TEXT_GOOGLE_MCDE_UPLOAD_STARTED . NL;
    if ($upload_file == '') $upload_file = $outfile; // use file just created if no upload file was specified
    if($google_mcde->ftp_file_upload(GOOGLE_MCDE_SERVER, GOOGLE_MCDE_USERNAME, GOOGLE_MCDE_PASSWORD, $upload_file)) {
      echo TEXT_GOOGLE_MCDE_UPLOAD_OK . NL;
      $db->execute("update " . TABLE_CONFIGURATION . " set configuration_value = '" . date("Y/m/d H:i:s") . "' where configuration_key='GOOGLE_MCDE_UPLOADED_DATE'");
    } else {
      echo TEXT_GOOGLE_MCDE_UPLOAD_FAILED . NL;
    }
  }
?>