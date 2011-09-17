<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured.php 6128 2007-04-08 04:53:32Z birdbrain $
 */
  $content = "";
    $content .= '<div class="sideBoxContent centeredContent">';
  $featured_box_counter = 0;
  while (!$random_featured_product->EOF) {
    $featured_box_price = zen_get_products_display_price($random_featured_product->fields['products_id']);
    $fp .=  '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], $random_featured_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br /><a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . $random_featured_product->fields['products_name'] . '</a><br />' . $featured_box_price . '<br /><br />'; 
    $featured_box_counter++;
    $random_featured_product->MoveNextRandom();
  }

	$total = $featured_box_counter;

	if ($total > 1) { //if more than one featured product exists in the db then scrolling begins
	$content .= '<div class="scroller_container"><div class="jscroller2_up jscroller2_speed-20 jscroller2_mousemove">' . $fp .'</div>
	<div class="jscroller2_up_endless">' . $fp .'</div></div>';
 }
 elseif ($total == 1) {  // If only one featured product exists in the db then the box will remain static
    $content .=  $fp;
 }
 else { //  If there are no featured products then this text is displayed
    $content .= "No featured products this month!";
 }

  $content .= '</div>';
//EOF
