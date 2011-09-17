<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2007 iChoze Internet Solutions
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_main_product_image.php 3208 2008-02-21 16:48:57Z tesuser $
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); 
?> 
<div id="productMainImage" class="centeredContent back">
<?php
	if(HOVERBOX_ENABLED == 'true'){
		if(HOVERBOX_DISPLAY_TITLE == 'true'){
		$title = zen_clean_html($products_name);
		}else{
		$title='';
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
			
  echo zen_image($products_image_medium, $products_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<div class="lrgarea"><a href="'. zen_hoverbox_IH2_url($products_image_large, addslashes($products_name), LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) .'" class="hoverbox" rel="gallery[group]" title="' . $title . $price . $hoverbox_pdesc . '"><img src="' . $template->get_template_dir('/zoomIcon.gif',DIR_WS_TEMPLATE, $current_page_base,'images/hoverbox'). '/zoomIcon.gif" alt="View Larger" class="lrglink" /></a></div>';
  }else{
  ?>
<script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '\\\')">' . zen_image($products_image_medium, addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '<\/span><\/a>'; ?>');
//--></script>
<?php }?>
<noscript>
<?php
  echo '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '" target="_blank">' . zen_image($products_image_medium, $products_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
?>
</noscript>
</div>