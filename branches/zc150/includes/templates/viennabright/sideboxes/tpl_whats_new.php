<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
* Power your Zen Cart!
* 
* Side Box Template
*
* @package templateSystem
* @copyright Copyright 2008-2009 12leaves.com
* @copyright Copyright 2003-2007 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id$
*/
  $content = "";
  $whats_new_box_counter = 0;
  while (!$random_whats_new_sidebox_product->EOF) {
    $whats_new_box_counter++;
    $whats_new_price = zen_get_products_display_price($random_whats_new_sidebox_product->fields['products_id']);
    $content .= '<div class="sideBoxContent centeredContent">';

    $content .= '<a href="' . zen_href_link(zen_get_info_page($random_whats_new_sidebox_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_sidebox_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_sidebox_product->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $random_whats_new_sidebox_product->fields['products_image'], $random_whats_new_sidebox_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
    $content .= '<a class="sidebox-products" href="' . zen_href_link(zen_get_info_page($random_whats_new_sidebox_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_sidebox_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_sidebox_product->fields['products_id']) . '">';
    $content .= $random_whats_new_sidebox_product->fields['products_name'] . '</a>';
    $content .= '<div>' . $whats_new_price . '</div>';
    $content .= '</div>';
    $random_whats_new_sidebox_product->MoveNextRandom();
  }
?>