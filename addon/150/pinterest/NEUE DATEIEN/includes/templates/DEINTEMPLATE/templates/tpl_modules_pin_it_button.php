<?php
  // get the image
  if (isset($_GET['products_id'])) { // use products_image if products_id exists
    $pinit_image = $db->Execute("select p.products_image from " . TABLE_PRODUCTS . " p where products_id='" . (int)$_GET['products_id'] . "'");
    $pinit_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $pinit_image->fields['products_image'];
  } elseif (isset($_GET['cPath'])) {
    $cPath = explode('_', $_GET['cPath']);
    $cPath_size = sizeof($cPath);
    $categories_id = $cPath[$cPath_size - 1]; 
    $pinit_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . zen_get_categories_image($categories_id);
  }  
  
  // get the URL
  if ($canonicalLink != '') {
    $piniturl = html_entity_decode($canonicalLink);
  } else {
    $piniturl = zen_href_link($_GET['main_page'], zen_get_all_get_params($fb_exclude_params));
  }
  // get the name
  if (META_TAG_TITLE != '') {
    $pinit_name = META_TAG_TITLE;
  } else {
    $pinit_name = zen_get_products_name((int)$_GET['products_id']);
  }
  if ($pinit_image != '' && $piniturl != '' && $pinit_name != '') {
?>
<div id="pinitButton" style="display: inline-block; vertical-align: top;">
  <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($piniturl); ?>&description=<?php echo urlencode($pinit_name); ?>&media=<?php echo urlencode($pinit_image); ?>" id="PinItButton" class="pin-it-button" count-layout="<?php echo PINTEREST_BUTTON_COUNT; ?>">Pin It</a>
<?php
    if (PINTEREST_BUTTON_METHOD == 'basic') { 
?>  
  <script type="text/javascript" src="<?php echo ($_SERVER['HTTPS'] != 'on' ? 'http' : 'https'); ?>://assets.pinterest.com/js/pinit.js"></script>
<?php 
    }
?>
</div>
<?php
  }
?>