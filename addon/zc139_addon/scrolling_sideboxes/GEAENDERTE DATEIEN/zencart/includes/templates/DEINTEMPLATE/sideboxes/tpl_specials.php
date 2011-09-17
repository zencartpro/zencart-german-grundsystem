<?php
/**
 * tpl_specials.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_specials.php 6128 2007-04-08 04:53:32Z birdbrain $
 */
  $content = "";
    $content .= '<div class="sideBoxContent centeredContent">';
  $specials_box_counter = 0;
  while (!$random_specials_sidebox_product->EOF) {
    $specials_box_price = zen_get_products_display_price($random_specials_sidebox_product->fields['products_id']);
    $sp .= '<br /><a href="' . zen_href_link(zen_get_info_page($random_specials_sidebox_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_specials_sidebox_product->fields["master_categories_id"]) . '&products_id=' . $random_specials_sidebox_product->fields["products_id"]) . '">' . zen_image(DIR_WS_IMAGES . $random_specials_sidebox_product->fields['products_image'], $random_specials_sidebox_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br /><a href="' . zen_href_link(zen_get_info_page($random_specials_sidebox_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_specials_sidebox_product->fields["master_categories_id"]) . '&products_id=' . $random_specials_sidebox_product->fields["products_id"]) . '">' . $random_specials_sidebox_product->fields['products_name'] . '</a><br />' . $specials_box_price . '<br />'; 
    $specials_box_counter++;
    $random_specials_sidebox_product->MoveNextRandom();
  }

	$total = $specials_box_counter;

	if ($total > 1) { //if more than one special product exists in the db then scrolling begins
	$content .= '<div class="scroller_container"><div class="jscroller2_up jscroller2_speed-20 jscroller2_mousemove">' . $sp .'</div>
	<div class="jscroller2_up_endless">' . $sp .'</div></div>';
 }
 elseif ($total == 1) {  // If only one special product exists in the db then the box will remain static
    $content .=  $sp;
 }
 else { //  If there are no special products then this text is displayed
    $content .= "No special products this month!";
 }
  $content .= '</div>';
//EOF
