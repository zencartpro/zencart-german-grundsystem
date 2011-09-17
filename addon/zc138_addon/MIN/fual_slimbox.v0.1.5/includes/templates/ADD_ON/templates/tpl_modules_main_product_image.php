<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2007 FUAL
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); ?> 
<div id="productMainImage" class="centeredContent back">
<!-- bof Zen Slimbox v0.1 btyler 2007-12-04 -->
<?php
if( FUAL_SLIMBOX == 'true' || ZEN_LIGHTBOX_STATUS == 'true' ) {
	// Set the title
	if ( $current_page_base == 'product_reviews' ) {
		$fual_slimbox_title = htmlentities($review->fields['products_name'],ENT_QUOTES);
	} else {
		$fual_slimbox_title = htmlentities($products_name,ENT_QUOTES);
	}
	// Get the href for the large image
	$fual_slimbox_href = zen_lightbox($products_image_large, $fual_slimbox_title, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
	$fual_slimbox_a = '<a href="' . $fual_slimbox_href . '" rel="lightbox[gallery]" title="' . $fual_slimbox_title . '">';
	// Get the img element for this product.
	$fual_slimbox_image = zen_image($products_image_medium, $fual_slimbox_title, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT); 

	// Test remote images to simulate slow loading for local development
	//$fual_slimbox_image = '<img src="http://demos.mootools.net/demos/DomReadyVS.Load/moo.png" width="150px" height="150px;" alt="test" />'; 
	
	// Note if you want to test a slow DOM load, then in /index.php add sleep(5); (in php brackets) just before the final </html>
	// This will make the DOM take an extra 5 seconds to load, which simulates dialup (what a cool feature)
	
	$fualSlimboxContent = "";
	if( ZEN_LIGHTBOX_STATUS == 'true' ) {
		$fualNervousSwitch = 0;
	} else {
		$fualNervousSwitch = FUAL_SLIMBOX_NERVOUS;
	}
	switch( $fualNervousSwitch ) {
		case 2:
			$fualSlimboxContent .= '<div id="slimboxWrapper">';
			break;
		case 1:
			$fualSlimboxContent .=  '<div id="slimboxWrapper" style="display:block;">';
			break;
		case 0:
		default:
			$fualSlimboxContent .= '<div id="slimboxWrapper" style="display:block; visibility:visible;">';
	}
	$fualSlimboxContent .=  $fual_slimbox_a . $fual_slimbox_image . '</a>'; 
	// Putting the text link together with the image is nasty!
	$fualSlimboxContent .=  '<br class="clearBoth" />';
	$fualSlimboxContent .=  $fual_slimbox_a . '<span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
	$fualSlimboxContent .=  '</div>';
?>
	<script language="javascript" type="text/javascript"><!--
	document.write('<?php echo $fualSlimboxContent; ?>' );
	//--></script>
	<noscript>
	<?php
	// If they can't be bothered to get a decent browser or turn js on then they only deserve the default behaviour.
	echo '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '" target="_blank">' . zen_image($products_image_medium, $products_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
?>
	</noscript>
<?php 		
} else {
?>
<!-- bof Zen Slimbox v0.1 btyler 2007-12-04 -->
	<script language="javascript" type="text/javascript"><!--
	document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '\\\')">' . zen_image($products_image_medium, addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>'; ?>');
	//--></script>
	<noscript>
	<?php
	echo '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '" target="_blank">' . zen_image($products_image_medium, $products_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
	?>
	</noscript>
<?php } ?>
</div>