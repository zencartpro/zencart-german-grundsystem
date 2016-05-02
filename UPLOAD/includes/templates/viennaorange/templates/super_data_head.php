<?php 
/**
 * super_data_body.php
 *
 * @package facebook open graph forked for super data
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: super_data_body.php 3 2016-05-01 21:32:41Z webchills $
 */
if (FACEBOOK_OPEN_GRAPH_STATUS == 'true') { ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
    "@type": "Organization",
      "url": "<?php echo $canonicalLink; ?>",
      "logo": "<?php echo FACEBOOK_OPEN_GRAPH_LOGO; ?>",
      "contactPoint" : [
{      "@type" : "ContactPoint",
        "telephone" : "<?php echo FACEBOOK_OPEN_GRAPH_PHONE; ?>",
        "contactType" : "customer service",
        "areaServed" : "<?php echo FACEBOOK_OPEN_GRAPH_AREA; ?>",
        "availableLanguage" : "<?php echo FACEBOOK_OPEN_GRAPH_LOCALE; ?>"
}],
      "sameAs" : [ "<?php echo FACEBOOK_OPEN_GRAPH_FBPG; ?>","<?php echo FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER; ?>","<?php echo FACEBOOK_OPEN_GRAPH_LINK; ?>","<?php echo FACEBOOK_OPEN_GRAPH_PROF1; ?>","<?php echo FACEBOOK_OPEN_GRAPH_PROF2; ?>","<?php echo FACEBOOK_OPEN_GRAPH_TWIT; ?>"],     
      "duns" : "<?php echo FACEBOOK_OPEN_GRAPH_DUNS; ?>",    
      "legalName" : "<?php echo FACEBOOK_OPEN_GRAPH_LEG; ?>",
      "taxID" : "<?php echo FACEBOOK_OPEN_GRAPH_TID; ?>",
      "vatID" : "<?php echo FACEBOOK_OPEN_GRAPH_VAT; ?>",
      "email" : "<?php echo FACEBOOK_OPEN_GRAPH_EMAIL; ?>",
      "faxNumber" : "<?php echo FACEBOOK_OPEN_GRAPH_FAX; ?>",
   "address": {
    "@type": "PostalAddress",
      "streetAddress" : "<?php echo FACEBOOK_OPEN_GRAPH_STREET_ADDRESS; ?>",
      "addressLocality": "<?php echo FACEBOOK_OPEN_GRAPH_CITY; ?>",
      "addressRegion": "<?php echo FACEBOOK_OPEN_GRAPH_STATE; ?>",      
      "postalCode": "<?php echo FACEBOOK_OPEN_GRAPH_ZIP; ?>",
      "addressCountry" : "<?php echo FACEBOOK_OPEN_GRAPH_COUNTRY; ?>"
}                                  
}
</script>
<meta property="og:title" content="<?php echo META_TAG_TITLE; ?>" />
<meta property="og:site_name" content="<?php echo STORE_NAME; ?>" />
<meta property="og:url" content="<?php echo $canonicalLink; ?>" />
<?php
  if (isset($_GET['products_id'])) { // use products_image if products_id exists
    $facebook_image = $db->Execute("select p.products_image from " . TABLE_PRODUCTS . " p where products_id='" . (int)$_GET['products_id'] . "'");
    $fb_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $facebook_image->fields['products_image'];
    $products_image_extension = substr($products_image, strrpos($products_image, '.'));
//Begin Image Handler changes 1 of 2
//the next three lines are commented out for Image Handler 4
//$products_image_base = str_replace($products_image_extension, '', $products_image);
//$products_image_medium = $products_image_base . IMAGE_SUFFIX_MEDIUM . $products_image_extension;
//$products_image_large = $products_image_base . IMAGE_SUFFIX_LARGE . $products_image_extension;
$products_image_base = preg_replace('/'.$products_image_extension . '$/', '', $products_image);
$products_image_medium = DIR_WS_IMAGES . 'medium/' . $products_image_base . IMAGE_SUFFIX_MEDIUM . $products_image_extension;
$products_image_large  = DIR_WS_IMAGES . 'large/' . $products_image_base . IMAGE_SUFFIX_LARGE .  $products_image_extension;
    
  } elseif (isset($_GET['cPath'])) {
    $fb_cPath_array = explode('_', $_GET['cPath']);
    $fb_cPath_size = sizeof($fb_cPath_array);
    $fb_categories_id = $fb_cPath_array[$fb_cPath_size - 1]; 
    
  }
  if ($fb_image == '' && FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE != '') { // if no products image, use the default image if enabled
   $fb_image = FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE;
  }
  if ($fb_image != '') {
?>
<?php 
  }
?>
<meta property="og:image" content="<?php echo $fb_image; ?>" />
<meta property="og:description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<?php if (FACEBOOK_OPEN_GRAPH_APPID != '') { ?>
<meta property="fb:app_id" content="<?php echo FACEBOOK_OPEN_GRAPH_APPID; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_ADMINID != '') { ?>
<meta property="fb:admins" content="<?php echo FACEBOOK_OPEN_GRAPH_ADMINID; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_STREET_ADDRESS != '') { ?>
<meta property="og:street-address" content="<?php echo FACEBOOK_OPEN_GRAPH_STREET_ADDRESS; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_CITY != '') { ?>
<meta property="og:locality" content="<?php echo FACEBOOK_OPEN_GRAPH_CITY; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_STATE != '') { ?>
<meta property="og:region" content="<?php echo FACEBOOK_OPEN_GRAPH_STATE; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_ZIP != '') { ?>
<meta property="og:postal-code" content="<?php echo FACEBOOK_OPEN_GRAPH_ZIP; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_COUNTRY != '') { ?>
<meta property="og:country_name" content="<?php echo FACEBOOK_OPEN_GRAPH_COUNTRY; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_EMAIL != '') { ?>
<meta property="og:email" content="<?php echo FACEBOOK_OPEN_GRAPH_EMAIL; ?>" />
<?php } ?>
<?php if (FACEBOOK_OPEN_GRAPH_PHONE != '') { ?>
<meta property="og:phone_number" content="<?php echo FACEBOOK_OPEN_GRAPH_PHONE; ?>" />
<?php } ?>
<meta name="twitter:card" content="summary" />
<?php if (FACEBOOK_OPEN_GRAPH_TWUSER != '') { ?>
<meta name="twitter:site" content="<?php echo FACEBOOK_OPEN_GRAPH_TWUSER; ?>" />
<?php } ?>
<meta name="twitter:title" content="<?php echo META_TAG_TITLE; ?>" />
<meta name="twitter:description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta name="twitter:image" content="<?php echo $fb_image; ?>" />
<meta name="twitter:url" content="<?php echo $canonicalLink; ?>" />
<?php if (FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER != '') { ?><link href="<?php echo FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER; ?>" rel=publisher /><?php } ?> 
<?php if ($current_page_base=='product_info'){ ?> 
<?php     
    $res = $db->Execute($sql);
    $sql = "select p.products_id, pd.products_name,
                  pd.products_description, p.products_model,
                  p.products_quantity, p.products_image,
                  p.products_price, p.manufacturers_id, p.products_quantity, p.products_tax_class_id
           from   " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
           where  p.products_status = '1'
           and    p.products_id = '" . (int)$_GET['products_id'] . "'
           and    pd.products_id = p.products_id
           and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
    $product_info = $db->Execute($sql);
$manufacturers_name= zen_get_products_manufacturers_name((int)$_GET['products_id']);
$products_name = $product_info->fields['products_name'];
$products_model = $product_info->fields['products_model'];
$products_id = $product_info->fields['products_id'];
$products_quantity = $product_info->fields['products_quantity'];
 ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
   "@type": "Product",
    "brand": "<?php echo $manufacturers_name; ?>",
    "mpn": "<?php echo $products_model; ?>",
    "productID": "<?php echo $products_id; ?>",
    "url": "<?php echo $canonicalLink; ?>",
    "name": "<?php echo $products_name; ?>",
    "description": "<?php echo META_TAG_DESCRIPTION; ?>",
    "image": "<?php echo $fb_image; ?>",
   "offers": {
    "@type" : "Offer",
    "availability" : "<?php if ($products_quantity > 0) { ?>http://schema.org/InStock<?php } ?><?php if ($products_quantity == 0) { ?>http://schema.org/OutOfStock<?php }?>",
    "price" : "<?php echo $specials_new_products_price = (round(zen_add_tax(zen_get_products_actual_price($product_info_metatags->fields['products_id']),zen_get_tax_rate($product_info_metatags->fields['products_tax_class_id'])),2)); ?>",
    "priceCurrency" : "<?php if (FACEBOOK_OPEN_GRAPH_CUR != '') { ?><?php echo FACEBOOK_OPEN_GRAPH_CUR; ?><?php } ?>",
    "seller" : "<?php echo STORE_NAME; ?>",
    "itemCondition" : "http://schema.org/<?php if (FACEBOOK_OPEN_GRAPH_COND != '') { ?><?php echo FACEBOOK_OPEN_GRAPH_COND; ?><?php }?>",
    "inventoryLevel" : "<?php echo $products_quantity; ?>",    
    "deliveryLeadTime" : "<?php if (FACEBOOK_OPEN_GRAPH_DTS != '') { ?><?php echo FACEBOOK_OPEN_GRAPH_DTS; ?><?php }?>",
    "category" : "<?php echo $categories->fields['categories_name']; ?>",
    "itemOffered" : "<?php echo $products_name; ?>",
    "eligibleRegion" : "<?php if (FACEBOOK_OPEN_GRAPH_ELER != '') { ?><?php echo FACEBOOK_OPEN_GRAPH_ELER; ?><?php }?>",
    "acceptedPaymentMethod" : [ "http://purl.org/goodrelations/v1#<?php echo FACEBOOK_OPEN_GRAPH_PAY1; ?>,http://purl.org/goodrelations/v1#<?php echo FACEBOOK_OPEN_GRAPH_PAY2; ?>,http://purl.org/goodrelations/v1#<?php echo FACEBOOK_OPEN_GRAPH_PAY3; ?>,http://purl.org/goodrelations/v1#<?php echo FACEBOOK_OPEN_GRAPH_PAY4; ?>,http://purl.org/goodrelations/v1#<?php echo FACEBOOK_OPEN_GRAPH_PAY5; ?>,http://purl.org/goodrelations/v1#<?php echo FACEBOOK_OPEN_GRAPH_PAY6; ?>" ]    
}       
}
</script>
<meta property="og:type" content="product" />
<?php if (FACEBOOK_OPEN_GRAPH_COND != '') { ?><meta property="og:condition" content="<?php echo FACEBOOK_OPEN_GRAPH_COND; ?>" /><?php }?>
<?php if (FACEBOOK_OPEN_GRAPH_CUR != '') { ?><meta property="product:price:currency" content="<?php echo FACEBOOK_OPEN_GRAPH_CUR; ?>"/><?php }?>
<meta property="product:retailer_part_no" content="<?php echo $products_model; ?>"/>
<meta property="og:category" content="<?php echo $categories->fields['categories_name']; ?>" />
<meta property="og:price:amount" content="<?php echo $specials_new_products_price = (round(zen_get_products_actual_price($product_info_metatags->fields['products_id']),2)); ?>" />
<meta property="og:availability" content="<?php if ($products_quantity > 0) { ?>InStock<?php } ?><?php if ($products_quantity == 0) { ?>OutOfStock<?php }?>" />
<meta property="og:brand" content="<?php echo $manufacturers_name; ?>" />
<meta name="twitter:card" content="product">
<meta name="twitter:creator" content="<?php if (FACEBOOK_OPEN_GRAPH_TWUSER != '') { ?><?php echo FACEBOOK_OPEN_GRAPH_TWUSER; ?><?php }?>">
<meta name="twitter:domain" content="<?php echo HTTP_SERVER; ?>">    
<?php } ?>
<?php } ?>
