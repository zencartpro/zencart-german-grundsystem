<?php
/**
 * additional_images module
 *
 * Prepares list of additional product images to be displayed in template
 *
 * @package templateSystem
 * @copyright Copyright 2007 iChoze Internet Solutions
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: additional_images.php 5369 2008-02-21 10:55:52Z testuser $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$image_handler_installed = IH_RESIZE;
if($image_handler_installed == 'false'){
if (!defined('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE')) define('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE','Yes');
if ($products_image != '') {
  // prepare image name
  $products_image_extension = substr($products_image, strrpos($products_image, '.'));
  $products_image_base = ereg_replace($products_image_extension . '$', '', $products_image);

  // if in a subdirectory
  if (strrpos($products_image, '/')) {
    $products_image_match = substr($products_image, strrpos($products_image, '/')+1);
    //echo 'TEST 1: I match ' . $products_image_match . ' - ' . $file . ' -  base ' . $products_image_base . '<br>';
    $products_image_match = ereg_replace($products_image_extension, '', $products_image_match) . '_';
    $products_image_base = $products_image_match;
  }

  $products_image_directory = ereg_replace($products_image, '', substr($products_image, strrpos($products_image, '/')));
  if ($products_image_directory != '') {
    $products_image_directory = DIR_WS_IMAGES . ereg_replace($products_image_directory, '', $products_image) . "/";
  } else {
    $products_image_directory = DIR_WS_IMAGES;
  }

  // Check for additional matching images
  $file_extension = $products_image_extension;
  $products_image_match_array = array();
  if ($dir = @dir($products_image_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir($products_image_directory . $file)) {
        if(preg_match("/" . $products_image_base . "/i", $file) == '1') {
          if (substr($file, 0, strrpos($file, '.')) != substr($products_image, 0, strrpos($products_image, '.'))) {
            if ($products_image_base . ereg_replace($products_image_base, '', $file) == $file) {
                //echo 'I AM A MATCH ' . $file . '<br />';
              $images_array[] = $file;
            } else {
                //echo 'I AM NOT A MATCH ' . $file . '<br />';
            }
          }
        }
      }
    }
    if (sizeof($images_array)) {
      sort($images_array);
    }
    $dir->close();
  }
}

// Build output based on images found
$num_images = sizeof($images_array);
$list_box_contents = '';
$title = '';

if ($num_images) {
  $row = 0;
  $col = 0;
  if ($num_images < IMAGES_AUTO_ADDED || IMAGES_AUTO_ADDED == 0 ) {
    $col_width = floor(100/$num_images);
  } else {
    $col_width = floor(100/IMAGES_AUTO_ADDED);
  }

  for ($i=0, $n=$num_images; $i<$n; $i++) {
    $file = $images_array[$i];
    $file_extension = substr($file, strrpos($file, '.'));
    $products_image_large = ereg_replace('^' . DIR_WS_IMAGES, DIR_WS_IMAGES . 'large/', $products_image_directory) . ereg_replace($file_extension . '$', '', $file) . IMAGE_SUFFIX_LARGE . $file_extension;
    $flag_has_large = true;
    $flag_display_large = (IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE == 'Yes' || $flag_has_large);
    $base_image = $products_image_directory . $file;
    $thumb_slashes = zen_image($base_image, addslashes($products_name), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    // remove additional single quotes from image attributes (important!)
    $thumb_slashes = preg_replace("/([^\\\\])'/", '$1\\\'', $thumb_slashes);
    $thumb_regular = zen_image($base_image, $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $large_link = zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $_GET['products_id'] . '&pic=' . $i . '&products_image_large_additional=' . $products_image_large);

        // Link Preparation:
if(HOVERBOX_ENABLED == 'true'){
		if(HOVERBOX_DISPLAY_TITLE == 'true'){
		$htitle = zen_clean_html($products_name);
		}else{
		$htitle='';
		}
		if(HOVERBOX_DISPLAY_PRICE == 'true'){
			if($specials_price){
			$price = ' - ' . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $specials_price;
			}else{
			$price = ' - ' . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $products_base_price;
			}
		}else{
		$price='';
		}
		if (HOVERBOX_PRODUCT_DESC == 'true'){
			$hoverbox_pdesc = '::' . zen_trunc_string(zen_clean_html($products_description), HOVERBOX_MAX_DESC_LENGTH, true);
		}else{
			$hoverbox_pdesc = '';
		}
		$script_link = '<a href="'. zen_hoverbox_IH2_url($products_image_large, addslashes($products_name), LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '" class="hoverbox" rel="gallery[group]" title="' . $htitle . $price . $hoverbox_pdesc . '">' . zen_image($base_image, $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	}else{
    $script_link = '<script language="javascript" type="text/javascript"><!--' . "\n" . 'document.write(\'' . ($flag_display_large ? '<a href="javascript:popupWindow(\\\'' . $large_link . '\\\')">' . $thumb_slashes . '<br />' . TEXT_CLICK_TO_ENLARGE . '<\/a>' : $thumb_slashes) . '\');' . "\n" . '//--></script>';

    $noscript_link = '<noscript>' . ($flag_display_large ? '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $_GET['products_id'] . '&pic=' . $i . '&products_image_large_additional=' . $products_image_large) . '" target="_blank">' . $thumb_regular . '<br /><span class="imgLinkAdditional">' . TEXT_CLICK_TO_ENLARGE . '</span></a>' : $thumb_regular ) . '</noscript>';
	}

    //  $alternate_link = '<a href="' . $products_image_large . '" onclick="javascript:popupWindow(\''. $large_link . '\') return false;" title="' . $products_name . '" target="_blank">' . $thumb_regular . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>';

    $link = $script_link . "\n      " . $noscript_link;
    //    $link = $alternate_link;

    // List Box array generation:
    $list_box_contents[$row][$col] = array('params' => 'class="additionalImages centeredContent back"' . ' ' . 'style="width:' . $col_width . '%;"',
    'text' => "\n      " . $link);
    $col ++;
    if ($col > (IMAGES_AUTO_ADDED -1)) {
      $col = 0;
      $row ++;
    }
  } // end for loop
} // endif
	
}else{
if (!defined('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE')) define('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE','Yes');
$images_array = array();

if ($products_image != '') {
  // prepare image name
  $products_image_extension = substr($products_image, strrpos($products_image, '.'));
  $products_image_base = str_replace($products_image_extension, '', $products_image);

  // if in a subdirectory
  if (strrpos($products_image, '/')) {
    $products_image_match = substr($products_image, strrpos($products_image, '/')+1);
    //echo 'TEST 1: I match ' . $products_image_match . ' - ' . $file . ' -  base ' . $products_image_base . '<br>';
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
          //          if(preg_match("/" . $products_image_match . "/i", $file) == '1') {
          if(preg_match("/" . $products_image_base . "/i", $file) == 1) {
            if ($file != $products_image) {
              if ($products_image_base . str_replace($products_image_base, '', $file) == $file) {
                //  echo 'I AM A MATCH ' . $file . '<br>';
                $images_array[] = $file;
              } else {
                //  echo 'I AM NOT A MATCH ' . $file . '<br>';
              }
            }
          }
        }
      }
    }
    if (sizeof($images_array)) {
      sort($images_array);
    }
    $dir->close();
  }
}

// Build output based on images found
$num_images = sizeof($images_array);
$list_box_contents = '';
$title = '';

if ($num_images) {
  $row = 0;
  $col = 0;
  if ($num_images < IMAGES_AUTO_ADDED || IMAGES_AUTO_ADDED == 0 ) {
    $col_width = floor(100/$num_images);
  } else {
    $col_width = floor(100/IMAGES_AUTO_ADDED);
  }

  for ($i=0, $n=$num_images; $i<$n; $i++) {
    $file = $images_array[$i];
    $products_image_large = str_replace(DIR_WS_IMAGES, DIR_WS_IMAGES . 'large/', $products_image_directory) . str_replace($products_image_extension, '', $file) . IMAGE_SUFFIX_LARGE . $products_image_extension;
    $flag_has_large = file_exists($products_image_large);
    $products_image_large = ($flag_has_large ? $products_image_large : $products_image_directory . $file);
    $flag_display_large = (IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE == 'Yes' || $flag_has_large);
    $base_image = $products_image_directory . $file;
    $thumb_slashes = zen_image($base_image, addslashes($products_name), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $thumb_regular = zen_image($base_image, $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $large_link = zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $_GET['products_id'] . '&pic=' . $i . '&products_image_large_additional=' . $products_image_large);

    // Link Preparation:
   if(HOVERBOX_ENABLED == 'true'){
		if(HOVERBOX_DISPLAY_TITLE){
		$htitle = zen_clean_html($products_name);
		}else{
		$htitle='';
		}
		if(HOVERBOX_DISPLAY_PRICE == 'true'){
			if($specials_price){
			$price = ' - ' . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $specials_price;
			}else{
			$price = ' - ' . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $products_base_price;
			}
		}else{
		$price='';
		}
		if (HOVERBOX_PRODUCT_DESC == 'true'){
			$hoverbox_pdesc = '::' . zen_trunc_string(zen_clean_html($products_description), HOVERBOX_MAX_DESC_LENGTH, true);
		}else{
			$hoverbox_pdesc = '';
		}
		$script_link = '<a href="'. zen_hoverbox_IH2_url($products_image_large, addslashes($products_name), LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '" class="hoverbox" rel="gallery[group]" title="' . $htitle . $price . $hoverbox_pdesc . '">' . zen_image($base_image, $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	}else{
    $script_link = '<script language="javascript" type="text/javascript"><!--' . "\n" . 'document.write(\'' . ($flag_display_large ? '<a href="javascript:popupWindow(\\\'' . $large_link . '\\\')">' . $thumb_slashes . '<br />' . TEXT_CLICK_TO_ENLARGE . '<\/a>' : $thumb_slashes) . '\');' . "\n" . '//--></script>';

    $noscript_link = '<noscript>' . ($flag_display_large ? '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $_GET['products_id'] . '&pic=' . $i . '&products_image_large_additional=' . $products_image_large) . '" target="_blank">' . $thumb_regular . '<br /><span class="imgLinkAdditional">' . TEXT_CLICK_TO_ENLARGE . '</span></a>' : $thumb_regular ) . '</noscript>';
	}

    $link = $script_link . "\n      " . $noscript_link;
    //      $link = $alternate_link;

    // List Box array generation:
    $list_box_contents[$row][$col] = array('params' => 'class="additionalImages centeredContent back"' . ' ' . 'style="width:' . $col_width . '%;"',
    'text' => "\n      " . $link);
    $col ++;
    if ($col > (IMAGES_AUTO_ADDED -1)) {
      $col = 0;
      $row ++;
    }
  } // end for loop
} // endif
}
?>