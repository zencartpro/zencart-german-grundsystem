<?php
/**
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/
 * 
 * @version $Id$
 */

chdir('../');
require_once('includes/application_top.php');
#require('./rl_invoice3/rl_invoice3_header.php');
require('rl_invoice3_header.php');

die('');
require(DIR_WS_INCLUDES . 'header.php');       
  
  global $messageStack;
  $page = isset($_GET['page']) ? $_GET['page'] : ((!defined('IH_VERSION') || (IH_VERSION == 'REMOVED')) ? 'admin' : 'manager');
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $products_filter = (isset($_GET['products_filter']) ? $_GET['products_filter'] : $products_filter);
  $current_category_id = (isset($_GET['current_category_id']) ? $_GET['current_category_id'] : $current_category_id);
  
  function get_image_details_string( $filename ) {
  
    if (!file_exists( $filename )) {
      return "no info";
    }
    $str = "";
    // find out some details about the file 
    $image_size = @getimagesize($filename);
    $image_fs_size = filesize($filename);
  
    $str .= $image_size[0]."x".$image_size[1];
    $str .= "<br /><strong>". round($image_fs_size/1024, 2) . "Kb</strong>";
    
    return $str;
  }
  
  //
  // Search the base directory and find additional images
  //
  function find_additional_images(&$array, $directory, $extension, $base ) {
  
    $image = $base . $extension;
  
    // Check for additional matching images
    if ($dir = @dir($directory)) {
      while ($file = $dir->read()) {
        if (!is_dir($directory . $file)) {
          if(preg_match("/^" . $base . "/i", $file) == '1') {
            // echo "BASE: ".$base.' FILE: '.$file.'<br />';
            if (substr($file, 0, strrpos($file, '.')) != substr($image, 0, strrpos($image, '.'))) {
              if ($base . preg_replace("/^$base/", '', $file) == $file) {
                $array[] = $file;
                // echo 'I AM A MATCH ' . $products_image_directory . '/'.$file . $products_image_extension .'<br />';
              } else {
                // echo 'I AM NOT A MATCH ' . $file . '<br />';
              } 
            }
          }
        }
      }
      
      if (sizeof($array) > 1) {
        sort($array);
      }
      
      $dir->close();
      
      return 1;
    }
    
    return 0;
  }

  function find_original_image($src) {
    global $ihConf;
    // try to find file by using different file extensions if initial
    // source doesn't succeed
    $imageroot = $ihConf['dir']['docroot'] . $ihConf['dir']['images'] . 'original/';
    if (is_file($imageroot . $src)) {
      return 'original/' . $src;
    } else {
      // do a quick search for files with common extensions
      $extensions = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.gif', '.GIF');
      $base = substr($src, 0, strrpos($src, '.'));
      for ($i=0; $i<count($extensions); $i++) {
        if (is_file($imageroot . $base . $extensions[$i])) {
          return 'original/' . $base . $extensions[$i];
        }
      }
      // not found? maybe mixed case file extension?
      if ($ihConf['allow_mixed_case_ext']) {
        // this can cost some time for every displayed image so default is
        // to not do this search
        $directory = dirname($imageroot . $src);
        $dir = @dir($directory);
        while ($file = $dir->read()) {
          if (!is_dir($directory . $file)) {
            if(preg_match("/^" . $imageroot . $base . "/i", $file) == '1') {
              $file_ext = substr($file, strrpos($file, '.'));
              if (is_file($imageroot . $base . $file_ext)) {
                return 'original/' . $base . $file_ext;
              }
            }
          }
        }
      }
    }
    // still here? no file found...
    return false;
  }

  function get_import_info() {
    global $db;
    $products = $db->Execute("select products_id, products_image from " . TABLE_PRODUCTS . " where products_image != '' order by products_image asc");
    $previous_image = '';
    $info = array();
    $index = 0;
    $previous_image = '';
    while (!$products->EOF){
      $image = $products->fields['products_image'];
      if ($image != $previous_image) {
        $previous_image = $image;
        $original_image = find_original_image($image);
        if ($original_image) {
          $info[$index]['source'] = $image;
          $info[$index]['original'] = $original_image;
          $info[$index]['target'] = preg_replace('/^original\//', '', $original_image);
          $index++;  
        }
      }
      $products->MoveNext();
    }
    return $info;
  }





  if ($action == 'set_products_filter') {
    $_GET['products_filter'] = $_POST['products_filter'];
    zen_redirect(zen_href_link(FILENAME_IMAGE_HANDLER, 'page=manager&products_filter=' . $_GET['products_filter']));
  }

  if ($page == 'manager') {
    // manager actions are handled in a seperate file
    require('includes/ih_manager.php');
  }


  if ($action == 'ih_remove') {
  	$error = remove_image_handler();
    if ($error) {
      $messageStack->add($error, 'error');
    } else {
      zen_redirect(zen_href_link(FILENAME_IMAGE_HANDLER, 'page=admin&action=ih_remove_success'));
    }
  }
  
  if ($action == 'ih_remove_success') {
      $messageStack->add(IH_REMOVED, 'success');
  }
  
  if ($action == 'ih_install') {
  	$error = install_image_handler();
    if ($error) {
      $messageStack->add($error, 'error');
    } else {
      zen_redirect(zen_href_link(FILENAME_IMAGE_HANDLER, 'page=admin&action=ih_install_success'));
    }
  }
  
  if ($action == 'ih_install_success') {
      $messageStack->add(IH_INSTALLED, 'success');
  }

  if ($action == 'ih_update') {
    $error = update_image_handler();
    if ($error) {
      $messageStack->add($error, 'error');
    } else {
      zen_redirect(zen_href_link(FILENAME_IMAGE_HANDLER, 'page=admin&action=ih_update_success'));
    }
  }
  
  if ($action == 'ih_update_success') {
      $messageStack->add(IH_UPDATED, 'success');
  }
  
  if ($action == 'ih_import_images') {
    $files = get_import_info();
    $previous_image = '';
    $imageroot = $ihConf['dir']['docroot'] . $ihConf['dir']['images'];
    if (count($files) > 0) {
      for ($i = 0; $i < count($files); $i++) {
        // Remove destination file if it's there
        @unlink($imageroot . $files[$i]['target']);
        if (rename($imageroot . $files[$i]['original'], $imageroot . $files[$i]['target'])) {
          // Update database
          if ($files[$i]['target'] != $files[$i]['source']) {
            $db->Execute("update " . TABLE_PRODUCTS . " set products_image='" . $files[$i]['target'] . "' where products_image='" . $files[$i]['source'] . "'");
          }
          @unlink($imageroot . $files[$i]['source']);
          $messageStack->add(TEXT_MSG_IMPORT_SUCCESS . $files[$i]['original'] . ' => ' . $files[$i]['target'], 'success');
        } else {
          $messageStack->add(TEXT_MSG_IMPORT_FAILURE . $files[$i]['original'] . ' => ' . $files[$i]['target'], 'error');
        }
      }
      $messageStack->add(IH_IMAGES_IMPORTED, 'success');
    }
  }

  if ($action == 'ih_scan_originals') {
    $import_info = get_import_info();
    if (count($import_info) <= 0) {
      $messageStack->add(IH_NO_ORIGINALS, 'caution');
    }
  }  

  if ($action == 'ih_clear_cache') {
    $error = bmz_clear_cache();
    if (!$error) {
      $messageStack->add(IH_CACHE_CLEARED, 'success');
    }
  }
  
  
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>

<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }

   function popupWindow(url) {
  		window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=600,height=460,screenX=150,screenY=150,top=150,left=150')
	}

  // -->
</script>
<style type="text/css">
  <!--
  /* general headline setup */
  h1, h2, h3, h4, h5 {
     color: #000000;
     font-family: Georgia,"Times New Roman",serif;
     font-weight: bold;
     letter-spacing: 0.1em;
     word-spacing: 0.2em;
     margin: 0 0 0 0;
     padding: 0 0 0 0;
     clear: left
  }
  
  .logo h1 {margin: 0; padding: 11px 0 0 0; font-size: 30px; color:#CCCCCC}
  h1 {font-size: 180%}
  h2 {font-size: 160%}
  h3 {font-size: 140%}
  h4 {font-size: 120%}
  h5 {font-size: 100%}

  h1 a, h2 a, h3 a, h4 a, h5 a {
     font-family: Georgia,"Times New Roman",serif;
     font-weight: bold;
     letter-spacing: 0.1em;
     word-spacing: 0.2em;
  }
  
  input[type="text"], input[type="submit"], input[type="file"], select {
    border: 1px solid #CCCCCC;
    background-color: #FFFFFF;
  }
  
  div.adminbox {
    padding: 8px;
  }

  div.aboutbox {
    margin: 0 auto;
    width: 60%;
    text-align:center;
  }
  
  .aboutbox p {
    text-align: justify;
  }
  
  div.managerbox {
    clear: both;
  }
  
  div.donationbox {
    display: inline;
    float: right;
    padding: 8px;
    border: 1px solid #CCCCCC;
    background-color: #F5F5F5;
    text-align: left;
    margin: 10px;
  }
  
  .donationbox label {
    display: inline;
    font-weight: normal;
  }
  
  .donationbox input[type=text], .donationbox input[type=submit], .donationbox select {
    display: inline;
    border: 1px solid #CCCCCC;
    background-color: #FFFFFF;
  }
  
  .donationbox input[type=submit] {margin-bottom: 5px; cursor: pointer}
  
  .donationbox h2 {
    font-size: 100%;
  }

  a.wikilink1:link    { color:#009900; text-decoration:none }
  a.wikilink1:visited { color:#009900; text-decoration:none }
  a.wikilink1:hover   { color:#009900; text-decoration:underline }

  
  -->
</style>


</head>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->

<div>

<div style="float:left; padding: 8px 5px;">
<h1><?php echo HEADING_TITLE; ?></h1>
<?php
if (defined('IH_VERSION')) {
	echo IH_VERSION_VERSION . ':&nbsp;' . IH_VERSION . '<br />';
} else {
	echo IH_VERSION_NOT_FOUND . '<br />';
}
?>
</div>

<?php
if ($page == 'manager') {
// SEARCH DIALOG BOX 
  echo '<div style="float:right; padding: 5px;">';
  echo zen_draw_form('search', FILENAME_CATEGORIES, '', 'get');
// show reset search
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    echo '<a href="' . zen_href_link(FILENAME_CATEGORIES) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
  }
  echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search');
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
  }
  echo '</form>';
  echo '</div>';
}
?>
</div>

<div style="clear:both">

<ul style="background-color:#F5F5F5; border: solid #CCCCCC; border-width: 1px 0px;">
  <li style="display:inline; padding:2px 5px; <?php echo ($page == 'manager') ? 'background:#CCCCCC;' : ''; ?>">
    <a href="<?php echo zen_href_link(FILENAME_IMAGE_HANDLER, 'page=manager') ?>"><?php echo TEXT_MENU_MANAGER; ?></a>
  </li>
  <li style="display:inline; padding:2px 5px; <?php echo ($page == 'admin') ? 'background:#CCCCCC;' : ''; ?>">
     <a href="<?php echo zen_href_link(FILENAME_IMAGE_HANDLER, 'page=admin') ?>"><?php echo TEXT_MENU_ADMINISTRATION; ?></a>
  </li>
  <li style="display:inline; padding:2px 5px; <?php echo ($page == 'preview') ? 'background:#CCCCCC;' : ''; ?>">
    <a href="<?php echo zen_href_link(FILENAME_IMAGE_HANDLER, 'page=preview') ?>"><?php echo TEXT_MENU_PREVIEW; ?></a>
  </li>
  <li style="display:inline; padding:2px 5px; <?php echo ($page == 'about') ? 'background:#CCCCCC;' : ''; ?>">
    <a href="<?php echo zen_href_link(FILENAME_IMAGE_HANDLER, 'page=about') ?>"><?php echo TEXT_MENU_ABOUT; ?></a>
  </li>
</ul>

<div class="donationbox">
<form class="contrib" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="business" value="paypal@breakmyzencart.com" />
  <input type="hidden" name="item_name" value="breakmyzencart donation" />
  <input type="hidden" name="item_number" value="DONATE" />
  <input type="hidden" name="no_note" value="0" />
  <input type="hidden" name="cmd" value="_xclick" />
  <input type="hidden" name="lc" value="en" />
  <input type="hidden" name="on0" value="Anonymity" />
  <input type="hidden" name="on1" value="Comment" />
  <input type="hidden" name="no_shipping" value="1" />
  <input type="hidden" name="tax" value="0" />
  
  <input type="hidden" name="return" value="http://breakmyzencart.com/thanks" />
  <input type="hidden" name="cancel_return" value="http://breakmyzencart.com/canceled" /> 
  
  <?php 
  //<input type="hidden" name="notify_url" value="http://breakmyzencart.com/donated.php" /-->
  ?>

  <h2>Please donate. <a class="wikilink1" href="http://breakmyzencart.com/donate" title="Why donate">Why?</a></h2> 
  <p>
  <label for="don-amount">One time gift of</label>
  <input type="text" name="amount" id="don-amount" maxlength="30" size="5" />
  <select name="currency_code">
    <option value="USD" selected="selected">$ (USD)</option>
    <option value="EUR">€ (EUR)</option>
    <option value="GBP">£ (GBP)</option>
    <option value="CAD">$ (CAD)</option>
    <option value="AUD">$ (AUD)</option>
    <option value="JPY">¥ (JPY)</option>
  </select>
  </p>
  <p>
  <label for="os1">Public comment
    <small>(200 characters max)</small>
  </label>  
  <br />
  <input type="text" size="25" name="os1" id="os1" maxlength="200" />
  </p>
  <p>
  <a class="wikilink1" href="http://breakmyzencart.com/donors_list" title="Donors' list'">Donors&rsquo; list</a><br />
  <input type="radio" name="os0" id="name-yes" value="Mention my name" />
  <label for="name-yes">List my name</label>
  <br />
  <input type="radio" name="os0" id="name-no" checked="checked" value="Don't mention my name" />
  <label for="name-no">List anonymously</label>
  <br />

  <input type="submit" value="Donate Now!" />
  <br />
  <img src="images/cc.gif" alt="Visa, MasterCard, Discover, American Express, eCheck" />
  </p>
</form>
</div>

<div class="adminbox">
<?php



/**
 * ADMIN TABPAGE INITIALIZATION
 */
$ih_admin_actions = array();

if ($page == 'admin') {
	if (!defined('IH_VERSION') || (IH_VERSION == 'REMOVED')) {
		$ih_admin_actions['ih_install'] = IH_INSTALL;
	} else {
		if (bmz_needs_update($ihConf['version'], IH_VERSION)) {
			$ih_admin_actions['ih_update'] = IH_UPDATE;
		}
		
		$ih_admin_actions['ih_confirm_remove'] = IH_REMOVE;
	}
	$ih_admin_actions['ih_clear_cache'] = IH_CLEAR_CACHE;
  $ih_admin_actions['ih_scan_originals'] = IH_SCAN_FOR_ORIGINALS;
}




/**
 * image handler uninstall confirmation
 */ 

if ($action == 'ih_confirm_remove') {
  echo zen_draw_form('remove_form', FILENAME_IMAGE_HANDLER, '', 'get');
  echo zen_draw_hidden_field('action', 'ih_remove');
  echo IH_CONFIRM_REMOVE . '&nbsp;';
  echo zen_image_submit('button_delete.gif', IMAGE_DELETE); 
  echo '</form>';
}

if ($action == 'ih_scan_originals') {
  if (count($import_info) > 0) {
    echo zen_draw_form('import_form', FILENAME_IMAGE_HANDLER, '', 'get');
    echo zen_draw_hidden_field('action', 'ih_import_images');
    echo IH_CONFIRM_IMPORT . '<br />';
    echo zen_image_submit('button_confirm.gif', IMAGE_CONFIRM) . '<br /><br />';
    for ($i = 0; $i < count($import_info); $i++) {
      echo "#$i: " . $import_info[$i]['original'] . ' => ' . $import_info[$i]['target'] . '<br /><br />';
    }
    echo '<br /><br />' . IH_CONFIRM_IMPORT . '<br />';
    echo zen_image_submit('button_confirm.gif', IMAGE_CONFIRM) . '<br />'; 
    echo '</form>';
  }
}

if (count($ih_admin_actions) > 0) {
	echo '<ul>';
	foreach ($ih_admin_actions as $action_name => $link_name) {
		echo '<li><a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'page=admin&action=' . $action_name) . '">' . $link_name . '</a></li>';
	}
	echo '</ul>';
}




/**
 * MANAGER TABPAGE
 */

if ($page == 'manager') {
  $curr_page = FILENAME_IMAGE_HANDLER;
    require(DIR_WS_MODULES . FILENAME_PREV_NEXT_DISPLAY);
?>

      <form name="set_products_filter_id" <?php echo 'action="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'action=set_products_filter') . '"'; ?> method="post"><?php echo zen_draw_hidden_field('products_filter', $_GET['products_filter']); ?>
        <table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="200" align="left" valign="top">&nbsp;</td>
            <td colspan="2" class="main"><?php echo TEXT_PRODUCT_TO_VIEW; ?></td>
          </tr>
          <tr>
            <td class="main" width="200" align="center" valign="top">

<?php
// FIX HERE
if ($_GET['products_filter'] != '') {
  $display_priced_by_attributes = zen_get_products_price_is_priced_by_attributes($_GET['products_filter']);
  echo ($display_priced_by_attributes ? '<span class="alert">' . TEXT_PRICED_BY_ATTRIBUTES . '</span>' . '<br />' : '');
  echo zen_get_products_display_price($_GET['products_filter']) . '<br /><br />';
  echo zen_get_products_quantity_min_units_display($_GET['products_filter'], $include_break = true);
  $not_for_cart = $db->Execute("select p.products_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCT_TYPES . " pt on p.products_type= pt.type_id where pt.allow_add_to_cart = 'N'");
} else {
  echo '';
  $not_for_cart = '';
}
?>
            </td>
            <td class="attributes-even" align="center"><?php echo zen_draw_products_pull_down('products_filter', 'size="5"', $not_for_cart->fields, true, $_GET['products_filter'], true, true); ?></td>
            <td class="main" align="center" valign="top">
              <?php
                echo zen_image_submit('button_display.gif', IMAGE_DISPLAY);
              ?>
            </td>
          </tr>

        <tr>
          <td colspan="3">
            <table>

<?php
// show when product is linked
if (zen_get_product_is_linked($products_filter) == 'true') {
?>
              <tr>
                <td class="main" align="center" valign="bottom">
                  <?php echo zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED) . '&nbsp;&nbsp;' . TEXT_LEGEND_LINKED . ' ' . zen_get_product_is_linked($products_filter, 'true'); ?>
                </td>
              </tr>
<?php } ?>
              <tr>
                <td class="main" align="center" valign="bottom">
<?php
  if ($_GET['products_filter'] != '') {
    echo '<a href="' . zen_href_link(FILENAME_CATEGORIES, 'action=new_product' . '&cPath=' . $current_category_id . '&pID=' . $products_filter . '&product_type=' . zen_get_products_type($products_filter)) . '">' . zen_image_button('button_edit_product.gif', IMAGE_EDIT_PRODUCT) . '<br />' . TEXT_PRODUCT_EDIT . '</a>';
    echo '</td><td class="main" align="center" valign="bottom">';
    echo '<a href="' . zen_href_link(FILENAME_ATTRIBUTES_CONTROLLER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id, 'NONSSL') . '">' . zen_image_button('button_edit_attribs.gif', IMAGE_EDIT_ATTRIBUTES) . '<br />' . TEXT_ATTRIBUTE_EDIT . '</a>' . '&nbsp;&nbsp;&nbsp;';
  }
?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        </table>
      </form>


<div class="managerbox">
<!-- Start Photo Display -->

<?php
// start of attributes display
if ($products_filter == '') {
?>
    <h2><?php echo HEADING_TITLE_PRODUCT_SELECT; ?></h2>
<?php 
} else {
  // Get the details for the product
  $product = $db->Execute("select p.products_id, p.products_model,
                                      p.products_image, 
                                      p.product_is_free, p.product_is_call, p.products_quantity_mixed, p.products_priced_by_attribute, p.products_status,
                                      p.products_discount_type, p.products_discount_type_from, p.products_price_sorter,
                                      pd.products_name,
                                      p.master_categories_id
                               from " . TABLE_PRODUCTS . " p, " .
                                        TABLE_PRODUCTS_DESCRIPTION . " pd
                               where p.products_id = '" . $_GET['products_filter'] . "'
                               and p.products_id = pd.products_id
                               and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");


    if ($product->RecordCount() > 0) {
        $pInfo = new objectInfo($product->fields);
    }

  // Determine if there are any images and work out the file names
  // (based on code from modules/pages/product_info/main_template_vars_images(& _additional) (copying is evil!))
  if ($pInfo->products_image != '') {
    
    $products_image = $pInfo->products_image;
    $products_image_match_array = array();

    // get file extension and base
    $products_image_extension = substr($products_image, strrpos($products_image, '.'));
    $products_image_base = preg_replace("/".$products_image_extension."$/", '', $products_image);
        
    // if in a subdirectory
    if (strrpos($products_image_base, '/')) {
      $products_image_base = substr($products_image_base, strrpos($products_image_base, '/')+1);
    }
    
    
    // sort out directory
    $products_image_directory =  substr($products_image, 0, strrpos($products_image, '/'));
      // add slash to base dir
      if (($products_image_directory != '') && (!ereg("\/$", $products_image_directory))) {
        $products_image_directory .= '/'; 
      }
    $products_image_directory_full = DIR_FS_CATALOG . DIR_WS_IMAGES . $products_image_directory;
    
    // Check that the image exists! (out of date Database)
    if (file_exists( $products_image_directory_full . $products_image_base . $products_image_extension )) {

      // Add base image to array
      $products_image_match_array[] = $products_image_base . $products_image_extension;
      // $products_image_base .= "_";
      
      // Check for additional matching images
      find_additional_images($products_image_match_array, $products_image_directory_full, 
        $products_image_extension, $products_image_base );
    }
    
  } // if products_image

?>

<?php
  if ($pInfo->products_id != '') {
?>
    <h2>
      <?php echo TEXT_PRODUCT_INFO . ': #' . $pInfo->products_id . '&nbsp;&nbsp;' . $pInfo->products_name; ?>&nbsp;&nbsp;&nbsp;
      <?php 
        if ($pInfo->products_model != '') {
          echo TEXT_PRODUCTS_MODEL . ': ' . $pInfo->products_model; 
        }
      ?>
      &nbsp;&nbsp;&nbsp;
      <?php 
        if ($pInfo->products_image != '') {
          if (preg_match("/^([^\/]+)\//", $pInfo->products_image, $matches)) {
            echo TEXT_IMAGE_BASE_DIR .': ';
            echo $matches[1];
          }
        }
      ?>
    </h2>
    <table border="0" width="100%" cellspacing="0" cellpadding="2"><tr><td valign="top">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr class="dataTableHeadingRow">
      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PHOTO_NAME; ?></td>
      <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DEFAULT_SIZE; ?></td>
      <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_MEDIUM_SIZE; ?></td>
      <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_LARGE_SIZE; ?></td>
      <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
    </tr>
<?php
  $count = sizeof($products_image_match_array);
  if (! $count) {
    // no images
    $no_images = 1;
?>
      <tr>
        <td colspan="6" class="dataTableContent" align="center"><?php echo TEXT_NO_PRODUCT_IMAGES; ?></td>
      </tr>
<?php 
  }
?>

<?php
  $first = 1;
  for ($i=0; $i < $count; $i++) {
    // there are some pictures, show them!
    $splitpos = strrpos($products_image_match_array[$i], '.');
    $tmp_image_name = substr($products_image_match_array[$i], 0, $splitpos);
    $products_image_extension = substr($products_image_match_array[$i], $splitpos);
    
    $image_file = DIR_WS_IMAGES . $products_image_directory . $tmp_image_name . $products_image_extension;
    $image_file_medium = DIR_WS_IMAGES . 'medium/' . $products_image_directory . $tmp_image_name . IMAGE_SUFFIX_MEDIUM . $products_image_extension;
    $image_file_large  = DIR_WS_IMAGES . 'large/' . $products_image_directory . $tmp_image_name . IMAGE_SUFFIX_LARGE .  $products_image_extension;

    $image_file_full = DIR_FS_CATALOG . $image_file;
    $image_file_medium_full = DIR_FS_CATALOG . $image_file_medium;
    $image_file_large_full = DIR_FS_CATALOG . $image_file_large;

    $tmp_image = new ih_image($image_file, $ihConf['small']['width'], $ihConf['small']['height']);
    $tmp_image_file = $tmp_image->get_local();
    $tmp_image_file_full = DIR_FS_CATALOG . $tmp_image_file;
    $tmp_image_preview = new ih_image($tmp_image_file, IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT);
  
    $tmp_image_medium = new ih_image($image_file_medium, $ihConf['medium']['width'], $ihConf['medium']['height']);
    $tmp_image_file_medium = $tmp_image_medium->get_local();
    $tmp_image_file_medium_full = DIR_FS_CATALOG . $tmp_image_file_medium;
    $tmp_image_medium_preview = new ih_image($tmp_image_file_medium, IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT);
    
    $tmp_image_large = new ih_image($image_file_large, $ihConf['large']['width'], $ihConf['large']['height']);
    $tmp_image_file_large = $tmp_image_large->get_local();
    $tmp_image_file_large_full = DIR_FS_CATALOG . $tmp_image_file_large;
    $tmp_image_large_preview = new ih_image($tmp_image_file_large, IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT);


    // Get file details 
    $text_default_size = get_image_details_string( $tmp_image_file_full );
    $text_medium_size = get_image_details_string( $tmp_image_file_medium_full );
    $text_large_size = get_image_details_string( $tmp_image_file_large_full );

    if ($first == 1) {
      $tmp_image_link = zen_catalog_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $pInfo->products_id);
      $first = 0;
    } else {
      $tmp_image_link = zen_catalog_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 
        'pID=' . $pInfo->products_id . '&pic='.($i).'&products_image_large_additional='.$tmp_image_file_large);
    }

    
    if ( $_GET['imgName'] == $tmp_image_name ) {
      // an image is selected, highlight it
      echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' 
        . zen_href_link(FILENAME_IMAGE_HANDLER, 'products_filter=' . $_GET['products_filter'] 
        . '&imgName=' .$tmp_image_name . '&action=layout_edit') . '\'">' . "\n";
        // set some details for later usage
      $selected_image_file = DIR_WS_CATALOG . $tmp_image_file_medium;
      $selected_image_file_large = DIR_WS_CATALOG . $tmp_image_file_large;
        $selected_image_link = $tmp_image_link;
        $selected_image_name = $tmp_image_name;
        $selected_image_suffix = preg_replace("/^".$products_image_base."/", '', $tmp_image_name);
        $selected_image_extension = $products_image_extension;
    } else {
      echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''
         . zen_href_link(FILENAME_IMAGE_HANDLER, 'products_filter=' . $_GET['products_filter'] 
         . '&imgName=' . $tmp_image_name . '&action=layout_info') . '\'">' . "\n";
    }
?>
    
      <td class="dataTableContent"><?php echo $tmp_image_name; ?></td>
      <td class="dataTableContent" align="center" valign="top">
        <?php
          $preview_image = $tmp_image_preview->get_resized_image(IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT, 'generic');
          list($width, $height) = @getimagesize(DIR_FS_CATALOG . $preview_image);
          $width = min($width, intval(IMAGE_SHOPPING_CART_WIDTH));
          $height = min ($height, intval(IMAGE_SHOPPING_CART_HEIGHT));
          echo zen_image(DIR_WS_CATALOG . $preview_image, addslashes($products_name), $width, $height) . '<br />';
        ?>
        <?php echo $text_default_size; ?>
      </td>
      <td class="dataTableContent" align="center" valign="top">
        <?php
          $preview_image = $tmp_image_medium_preview->get_resized_image(IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT, 'generic');
          list($width, $height) = @getimagesize(DIR_FS_CATALOG . $preview_image);
          $width = min($width, intval(IMAGE_SHOPPING_CART_WIDTH));
          $height = min ($height, intval(IMAGE_SHOPPING_CART_HEIGHT));
          echo zen_image(DIR_WS_CATALOG . $preview_image, addslashes($products_name), $width, $height) . '<br />';
          echo $text_medium_size . '<br />';
          if (is_file($image_file_medium_full)) {
            echo ' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'imgName=' 
              . $image_file_medium . '&products_filter=' . $_GET['products_filter'] . '&action=quick_delete') . '">' 
              . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>';
          }
        ?>
      </td>
      <td class="dataTableContent" align="center" valign="top">
        <?php
          $preview_image = $tmp_image_large_preview->get_resized_image(IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT, 'generic');
          list($width, $height) = @getimagesize(DIR_FS_CATALOG . $preview_image);
          $width = min($width, intval(IMAGE_SHOPPING_CART_WIDTH));
          $height = min ($height, intval(IMAGE_SHOPPING_CART_HEIGHT));
          echo zen_image(DIR_WS_CATALOG . $preview_image, addslashes($products_name), $width, $height) . '<br />';
          echo $text_large_size . '<br />';
          if (is_file($image_file_large_full)) {
            echo ' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'imgName=' 
              . $image_file_large . '&products_filter=' . $_GET['products_filter'] . '&action=quick_delete') . '">' 
              . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>';
          }
        ?>
      </td>
      <td class="dataTableContent" align="right"><?php 
        if ( $_GET['imgName'] == $tmp_image_name ) { 
          echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); 
        } else { 
          echo '<a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'products_filter=' . $_GET['products_filter'] 
            . '&imgName=' . $tmp_image_name . '&action=layout_info') 
            . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
        } 
      ?>&nbsp;</td>
    </tr>
<?php   
    
  } // for each photo loop
?>
  </table></td><!-- END Photo list table -->
  <!-- Start Data Edit Pane -->
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'layout_info':
      // edit
      list($width, $height) = @getimagesize(DIR_FS_CATALOG . $selected_image_file);
//      $width = min($width, intval(MEDIUM_IMAGE_WIDTH));
//      $height = min($height, intval(MEDIUM_IMAGE_HEIGHT)); 
      $heading[] = array('text' => '<strong>' . TEXT_INFO_IMAGE_INFO . '</strong>');
      $contents = array('align' => 'center', 'form' => zen_draw_form('image_define', FILENAME_IMAGE_HANDLER, 
        'page=' . $_GET['page'] . '&products_filter=' . $_GET['products_filter'] . '&action=save', 'post', 'enctype="multipart/form-data"'));
          $contents[] = array('text' => '<strong>'.TEXT_INFO_NAME.': </strong>' . $selected_image_name .'<br />');
          $contents[] = array('text' => '<strong>'.TEXT_INFO_FILE_TYPE.': </strong>' . $selected_image_extension .'<br />');
          $contents[] = array('text' => 
              '<script language="javascript" type="text/javascript"><!--
              document.write(\'<a href="javascript:popupWindow(\\\'' . $selected_image_link . '\\\')">' 
              . zen_image($selected_image_file, addslashes($products_name), $width, $height) 
              . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>\');'
              .'//-->'
        .'</script>
        <noscript>'
        .'<a href="' . zen_href_link($selected_image_file_large) . '" target="_blank">' 
            . zen_image($selected_image_file, $products_name, $width, $height) 
            . TEXT_CLICK_TO_ENLARGE . '</a>'
        .'</noscript>' );
      // show new, delete, and edit buttons
      $contents[] = array('align' => 'center', 'text' => '<br />' .
        ' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'imgName=' 
        . $_GET['imgName'] . '&products_filter=' . $_GET['products_filter'] . '&action=layout_edit') . '">' 
        . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> &nbsp; '
        .' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 'imgName=' 
        . $_GET['imgName'] . '&products_filter=' . $_GET['products_filter'] . '&action=layout_delete') . '">' 
        . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a> &nbsp;'
        .' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 
        '&products_filter=' . $_GET['products_filter'] . '&action=layout_new') . '">' 
        . zen_image_button('button_new_file.gif', IMAGE_NEW) . '</a>');
      
      break;
    case 'layout_edit':
      // Edit specific details 
      $imgNameStr = '&imgEdit=1' .'&imgBase=' . $products_image_base
          . "&imgSuffix=" . $selected_image_suffix
          . "&imgBaseDir=" . $products_image_directory 
          . "&imgExtension=" . $selected_image_extension;
      $heading[] = array('text' => '<strong>' . TEXT_INFO_EDIT_PHOTO . '</strong>');

    case 'layout_new':  
      
      if ( $action != 'layout_edit' ) {
        $imgNameStr .= ( $no_images == 1 ) ? "&newImg=1" : '&imgBase='.$products_image_base
          . "&imgBaseDir=" . $products_image_directory 
          . "&imgExtension=" . $products_image_extension;
        $heading[] = array('text' => '<strong>' . TEXT_INFO_NEW_PHOTO . '</strong>');
      }
      
      
      $contents = array('form' => zen_draw_form('image_define', FILENAME_IMAGE_HANDLER, 
        '&products_filter=' . $_GET['products_filter'] . $imgNameStr
        .'&action=save', 'post', 'enctype="multipart/form-data"'));

      // check if this is a master image or if no images exist
      if ($no_images == 1) {
        $contents[] = array('text' => '<strong>'.TEXT_INFO_IMAGE_BASE_NAME.'</strong><br />' );
        $contents[] = array('text' => zen_draw_input_field('imgBase', '', 30));
              
        $dir = @dir(DIR_FS_CATALOG_IMAGES);
            $dir_info[] = array('id' => '', 'text' => TEXT_INFO_MAIN_DIR);
            while ($file = $dir->read()) {
              if (is_dir(DIR_FS_CATALOG_IMAGES . $file) 
                  && strtoupper($file) != 'CVS' 
                  && $file != "." 
                  && $file != ".." 
                  && $file != 'original' 
                  && $file != 'medium'
                  && $file != 'large') {
                  $dir_info[] = array('id' => $file . '/', 'text' => $file);
              }
            }
            $contents[] = array('text' => '<br /><strong>'.TEXT_INFO_BASE_DIR.'</strong><br />'.TEXT_INFO_NEW_DIR);
            $contents[] = array('text' => TEXT_INFO_IMAGE_DIR . zen_draw_pull_down_menu('imgBaseDir', $dir_info, ""));
            $contents[] = array('text' => TEXT_INFO_OR.' ' . zen_draw_input_field('imgNewBaseDir', '', 20) );

      } else if ($action != 'layout_edit') {
            $contents[] = array('text' => '<strong>'.TEXT_INFO_IMAGE_SUFFIX.'</strong><br />'.TEXT_INFO_USE_AUTO_SUFFIX.'<br />' );
            $contents[] = array('text' => zen_draw_input_field('imgSuffix', $selected_image_suffix, 10) );
      }

      // Image fields
      $contents[] = array('text' => '<br /><strong>' . TEXT_INFO_DEFAULT_IMAGE . '</strong><br />' 
          . TEXT_INFO_DEFAULT_IMAGE_HELP . '<br />'
          . zen_draw_input_field('default_image', '', ' size="20" ', false, 'file') . '<br />' . $ptInfo->default_image);

      if ( $action == 'layout_edit' ) {
        if ( $selected_image_name == $products_image_match_array[0]) {
          $contents[] = array('text' => zen_draw_radio_field('imgNaming', 'new_discard', true)
                . IH_NEW_NAME_DISCARD_IMAGES . '<br />'
//  new_copy functionality scheduled for future release                
//            . zen_draw_radio_field('imgNaming', 'new_copy', false)
//                . IH_NEW_NAME_COPY_IMAGES . '<br />'
            . zen_draw_radio_field('imgNaming', 'keep_name', false)
                . IH_KEEP_NAME);
        }
      }

      $contents[] = array('text' => '<br /><strong>' . 'Medium image file (optional)' . '</strong><br />' . 
          zen_draw_input_field('medium_image', '', ' size="20" ', false, 'file') . '<br />' . $ptInfo->medium_image);
      $contents[] = array('text' => '<br /><strong>' . 'Large image file (optional)' . '</strong><br />' .
          zen_draw_input_field('large_image', '', ' size="20" ', false, 'file') . '<br />' . $ptInfo->large_image);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_save.gif', IMAGE_SAVE) );
      break;
    case 'layout_delete':

      $imgStr = "&imgBase=" . $products_image_base
          . "&imgSuffix=" . $selected_image_suffix
          . "&imgBaseDir=" . $products_image_directory 
          . "&imgExtension=" . $selected_image_extension;
          
      // show new button      
      $heading[] = array('text' => '<strong>' . TEXT_INFO_CONFIRM_DELETE . '</strong>');
      
      $contents[] = array('text' => '<br />' . $products_image_directory.$products_image_base.$selected_image_suffix.$selected_image_extension);
      $contents[] = array('text' => '<br />' . TEXT_INFO_CONFIRM_DELETE_SURE);
      if ($selected_image_suffix == '') {
        $contents[] = array('text' => zen_draw_checkbox_field('delete_from_database_only', 'Y', false) . IH_DELETE_FROM_DB_ONLY);
      }

      $contents[] = array('align' => 'center', 'text' => '<br />'
        .' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 
        '&products_filter=' . $_GET['products_filter'] . '&action=delete' 
        . $imgStr ) . '">' 
        . zen_image_button( 'button_delete.gif', IMAGE_DELETE ) . '</a>');
      break;
    default:
      // show new button      
      $heading[] = array('text' => '<strong>' . TEXT_INFO_SELECT_ACTION . '</strong>');
      $contents = array('form' => zen_draw_form('image_define', FILENAME_PRODUCT_TYPES, 'page=' . $_GET['page'] . '&ptID=' . $ptInfo->type_id . '&action=new', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => '<br />' . TEXT_INFO_CLICK_TO_ADD);
      $contents[] = array('align' => 'center', 'text' => '<br />'
        .' <a href="' . zen_href_link(FILENAME_IMAGE_HANDLER, 
        '&products_filter=' . $_GET['products_filter'] . '&action=layout_new') . '">' 
        . zen_image_button('button_new_file.gif', IMAGE_NEW) . '</a>');
      break;
  }
  
  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>  
  </tr></table>
<?php
  
  } // if products_id

} // if products_filter
?>
</div>
<?php
} // if $page == 'manager'


/**
 * PREVIEW TABPAGE
 */

if ($page == 'preview') {
  $images = array();
  $pngimage = new ih_image($ihConf['dir']['admin'] . 'images/ih-test.png', intval($ihConf['small']['width']), intval($ihConf['small']['height']));
  $images['pngsource'] = $pngimage->get_resized_image(intval($ihConf['small']['width']), intval($ihConf['small']['height']), 'orig');
  $images['pngsmall'] = $pngimage->get_resized_image($ihConf['small']['width'], $ihConf['small']['height'], 'small');
  $images['pngmedium'] = $pngimage->get_resized_image($ihConf['medium']['width'], $ihConf['medium']['height'], 'medium');
  $images['pnglarge'] = $pngimage->get_resized_image($ihConf['large']['width'], $ihConf['large']['height'], 'large');
  
  $jpgimage = new ih_image($ihConf['dir']['admin'] . 'images/ih-test.jpg', intval($ihConf['small']['width']), intval($ihConf['small']['height'])); 
  $images['jpgsource'] = $jpgimage->get_resized_image(intval($ihConf['small']['width']), intval($ihConf['small']['height']), 'orig');
  $images['jpgsmall'] = $jpgimage->get_resized_image($ihConf['small']['width'], $ihConf['small']['height'], 'small');
  $images['jpgmedium'] = $jpgimage->get_resized_image($ihConf['medium']['width'], $ihConf['medium']['height'], 'medium');
  $images['jpglarge'] = $jpgimage->get_resized_image($ihConf['large']['width'], $ihConf['large']['height'], 'large');
  
  $gifimage = new ih_image($ihConf['dir']['admin'] . 'images/ih-test.gif', intval($ihConf['small']['width']), intval($ihConf['small']['height'])); 
  $images['gifsource'] = $gifimage->get_resized_image(intval($ihConf['small']['width']), intval($ihConf['small']['height']), 'orig');
  $images['gifsmall'] = $gifimage->get_resized_image($ihConf['small']['width'], $ihConf['small']['height'], 'small');
  $images['gifmedium'] = $gifimage->get_resized_image($ihConf['medium']['width'], $ihConf['medium']['height'], 'medium');
  $images['giflarge'] = $gifimage->get_resized_image($ihConf['large']['width'], $ihConf['large']['height'], 'large');
  
?>
  <table style="background-color:#F5F5F5" cellspacing="0" cellpadding="5px" border="0">
  	<tr>
  		<th style="border-bottom: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC"><?php echo IH_SOURCE_TYPE; ?></th>
  		<th style="border-bottom: 1px solid #CCCCCC"><?php echo IH_SOURCE_IMAGE; ?></th>
  		<th style="border-bottom: 1px solid #CCCCCC"><?php echo IH_SMALL_IMAGE; ?></th>
  		<th style="border-bottom: 1px solid #CCCCCC"><?php echo IH_MEDIUM_IMAGE; ?></th>
  	</tr>
  	<!-- source png row -->
  	<tr>
  		<td style="border-right: 1px solid #CCCCCC"><strong>png</strong></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['pngsource']?>" /></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['pngsmall']?>" /></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['pngmedium']?>" /></td>
  	</tr>
  	<!-- source jpg row -->
  	<tr>
  		<td style="border-right: 1px solid #CCCCCC"><strong>jpg</strong></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['jpgsource']?>" /></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['jpgsmall']?>" /></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['jpgmedium']?>" /></td>
  	</tr>
  	<!-- source gif row -->
  	<tr style="border-right: 1px solid #CCCCCC">
  		<td style="border-right: 1px solid #CCCCCC"><strong>gif</strong></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['gifsource']?>" /></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['gifsmall']?>" /></td>
  		<td><img style="border: 1px solid #000000; background:url(images/checkpattern.gif)" src="<?php echo HTTP_SERVER . DIR_WS_CATALOG . $images['gifmedium']?>" /></td>
  	</tr>
  </table>
<?php
}



/**
 * ABOUT TABPAGE
 */

if ($page == 'about') {
?>
<div class="aboutbox">
<p>
  <h2>Image Handler<sup>2</sup></h2>
  by<br />
  <a href="http://breakmyzencart.com/">breakmyzencart.com</a><br />
  (<a href="mailto:tim@breakmyzencart.com">tim@breakmyzencart.com</a>)<br />
</p>
<p>
Donations help me divert more time from other projects to breakmyzencart, 
which means you get the great new Zen-Cart contributions, maintenance of 
current releases for your ease of use and this informational website stays 
up-to-date.
</p>
<p>
And don&rsquo;t forget my university studies! You help with that, too!
</p>
<p>
Any amount is very much appreciated, so don&rsquo;t hesitate to send whatever
you can. Every little bit helps!<br />
Thank you!
</p>

</div>

</div>
<?php
}
?>
<!-- body_eof //-->
<!-- footer //-->
<?php
	require(DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
</body>
</html>
<?php
	require(DIR_WS_INCLUDES . 'application_bottom.php');