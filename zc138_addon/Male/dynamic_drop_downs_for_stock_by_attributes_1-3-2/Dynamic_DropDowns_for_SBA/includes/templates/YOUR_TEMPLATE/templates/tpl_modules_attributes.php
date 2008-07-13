<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_attributes.php 3208 2006-03-19 16:48:57Z birdbrain $
 */
?>
<div id="productAttributes">
<?php if ($zv_display_select_option > 0) { ?>
<?php
$products_attributes = $db->Execute("select count(distinct products_options_id) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = ". (int)$_SESSION['languages_id'] ."");


     if ($products_attributes->fields['total'] > 1)  {
    
      $products_id=(preg_match("/^\d{1,10}(\{\d{1,10}\}\d{1,10})*$/",$_GET['products_id']) ? $_GET['products_id'] : (int)$_GET['products_id']); 
     require(DIR_WS_CLASSES . 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN_MULTI . '.php');
      $class = 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN_MULTI;

     $pad = new $class($products_id);
     
     echo $pad->draw();

  }
  elseif ($products_attributes->fields['total'] > 0)  {
    
      $products_id=(preg_match("/^\d{1,10}(\{\d{1,10}\}\d{1,10})*$/",$_GET['products_id']) ? $_GET['products_id'] : (int)$_GET['products_id']); 
     require(DIR_WS_CLASSES . 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN_SINGLE . '.php');
      $class = 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN_SINGLE;

     $pad = new $class($products_id);
     
     echo $pad->draw();
  }


?>

<?php
if ($options_attributes_image[$i] != '') {
?>
<?php echo $options_attributes_image[$i]; ?>
<?php
}
?>
<br class="clearBoth" />
<?php
    }
?>


<?php
  if ($show_onetime_charges_description == 'true') {
?>
    <div class="wrapperAttribsOneTime"><?php echo TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION; ?></div>
<?php } ?>


<?php
  if ($show_attributes_qty_prices_description == 'true') {
?>
    <div class="wrapperAttribsQtyPrices"><?php echo zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;' . '<a href="javascript:popupWindowPrice(\'' . zen_href_link(FILENAME_POPUP_ATTRIBUTES_QTY_PRICES, 'products_id=' . $_GET['products_id'] . '&products_tax_class_id=' . $products_tax_class_id) . '\')">' . TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK . '</a>'; ?></div>
<?php } ?>
</div>