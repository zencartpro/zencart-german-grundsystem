<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_whats_new.php 6128 2007-04-08 04:53:32Z birdbrain $
 */
  $content = "";
    $content .= '<div class="sideBoxContent centeredContent">';
  $whats_new_box_counter = 0;
  while (!$random_whats_new_sidebox_product->EOF) {
    $whats_new_price = zen_get_products_display_price($random_whats_new_sidebox_product->fields['products_id']);
    $wn .=  	 '<a href="' . zen_href_link(zen_get_info_page($random_whats_new_sidebox_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_sidebox_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_sidebox_product->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $random_whats_new_sidebox_product->fields['products_image'], $random_whats_new_sidebox_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br /><a href="' . zen_href_link(zen_get_info_page($random_whats_new_sidebox_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_sidebox_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_sidebox_product->fields['products_id']) . '">' . $random_whats_new_sidebox_product->fields['products_name'] . '</a><br />' . $whats_new_price . '<br /><br />';
    $whats_new_box_counter++;
    $random_whats_new_sidebox_product->MoveNextRandom();
  }
  
	$total = $whats_new_box_counter;

	if ($total > 1) { //if more than one new product exists in the db then scrolling begins
	$content .= '<div class="scroller_container"><div class="jscroller2_up jscroller2_speed-20 jscroller2_mousemove">' . $wn .'</div>
	<div class="jscroller2_up_endless">' . $wn .'</div></div>';
 }
 elseif ($total == 1) {  // If only one new product exists in the db then the box will remain static
    $content .=  $wn;
 }
 else { //  If there are no new products then this text is displayed
    $content .= "No new products this month!";
 }
	
    $content .= '</div>';
//EOF
