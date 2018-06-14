<meta property="og:title" content="<?php echo META_TAG_TITLE; ?>" />
<meta property="og:description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta property="og:site_name" content="<?php echo STORE_NAME; ?>" />
<?php
if ($og_url == '') {
  if (FACEBOOK_OPEN_GRAPH_CANONICAL == 'true') {
    $og_url = html_entity_decode($canonicalLink); 
  } else {
    $fb_exclude_params = array('action', 'notify', 'main_page', 'zenid', 'fb_action_ids', 'fb_action_types', 'fb_source', 'action_object_map', 'action_type_map', 'action_ref_map');
    if (FACEBOOK_OPEN_GRAPH_CPATH == 'false') {
      $fb_exclude_params[] = 'cPath'; 
    }
    if (FACEBOOK_OPEN_GRAPH_LANGUAGE == 'false') {
      $fb_exclude_params[] = 'language'; 
    }
    $og_url = zen_href_link($_GET['main_page'], zen_get_all_get_params($fb_exclude_params), 'NONSSL', false);    
  }
}
?>
<meta property="og:url" content="<?php echo $og_url; ?>" />
    <?php if (FACEBOOK_OPEN_GRAPH_ADMINID != '') { ?>
    <meta property="fb:admins" content="<?php echo FACEBOOK_OPEN_GRAPH_ADMINID; ?>" />
    <?php } ?>
    <?php if (FACEBOOK_OPEN_GRAPH_APPID != '') { ?>
    <meta property="fb:app_id" content="<?php echo FACEBOOK_OPEN_GRAPH_APPID; ?>" />
    <?php } ?>
    <?php
  if (isset($facebook_override_image) && $facebook_override_image != '') {
    $fb_image = $facebook_override_image;
  } else {
    if (isset($_GET['products_id'])) { // use products_image if products_id exists
      $facebook_image = $db->Execute("select p.products_image from " . TABLE_PRODUCTS . " p where products_id='" . (int)$_GET['products_id'] . "'");
      $fb_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $facebook_image->fields['products_image'];
    } elseif (isset($_GET['cPath'])) {
      $fb_cPath_array = explode('_', $_GET['cPath']);
      $fb_cPath_size = sizeof($fb_cPath_array);
      $fb_categories_id = $fb_cPath_array[$fb_cPath_size - 1]; 
      $fb_categories_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . zen_get_categories_image($fb_categories_id);
    }
  }
  if ($fb_image == '' && FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE != '') { // if no products image, use the default image if enabled
       $fb_image = FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE;
      }
      if ($fb_image != '') {
    ?>
    <meta property="og:image" content="<?php echo $fb_image; ?>" />
    <?php
      }
    ?>
    <?php if (FACEBOOK_OPEN_GRAPH_TYPE != '') { ?>
    <meta property="og:type" content="<?php echo FACEBOOK_OPEN_GRAPH_TYPE; ?>" />
    <?php } ?>  