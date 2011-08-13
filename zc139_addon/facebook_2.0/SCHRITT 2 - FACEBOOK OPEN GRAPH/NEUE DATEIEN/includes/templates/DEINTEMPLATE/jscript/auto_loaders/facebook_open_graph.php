    <?php if (FACEBOOK_OPEN_GRAPH_STATUS == 'true') { ?>
    <meta property="og:title" content="<?php echo META_TAG_TITLE; ?>" />
    <meta property="og:url" content="<?php echo $canonicalLink; ?>" />
    <meta property="og:site_name" content="<?php echo STORE_NAME; ?>" />
    <?php if (FACEBOOK_OPEN_GRAPH_ADMINID != '') { ?>
    <meta property="fb:admins" content="<?php echo FACEBOOK_OPEN_GRAPH_ADMINID; ?>" />
    <?php } ?>
    <?php if (FACEBOOK_OPEN_GRAPH_APPID != '') { ?>
    <meta property="fb:app_id" content="<?php echo FACEBOOK_OPEN_GRAPH_APPID; ?>" />
    <?php } ?>
    <?php
      if (isset($_GET['products_id'])) { // use products_image if products_id exists
        $facebook_image = $db->Execute("select p.products_image from " . TABLE_PRODUCTS . " p where products_id='" . (int)$_GET['products_id'] . "'");
        $fb_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $facebook_image->fields['products_image'];
      }
      if ($fb_image == '') { // if no products image, use the default image if enabled
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
    <?php } ?>