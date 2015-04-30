<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_whats_new.php 730 2015-04-09 12:50:16Z webchills $
 */
  $content = "";
  $content .= '<div class="sideBoxContent centeredContent">';
  $whats_new_box_counter = 0;
  while (!$random_whats_new_sidebox_product->EOF) {
    $whats_new_box_counter++;
    $whats_new_price = zen_get_products_display_price($random_whats_new_sidebox_product->fields['products_id']);
    $content .= "\n" . '  <div class="sideBoxContentItem">';
    $content .= '<a href="' . zen_href_link(zen_get_info_page($random_whats_new_sidebox_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_sidebox_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_sidebox_product->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $random_whats_new_sidebox_product->fields['products_image'], $random_whats_new_sidebox_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $content .= '<br />' . $random_whats_new_sidebox_product->fields['products_name'] . '</a>';
    $content .= '<div>' . $whats_new_price . '</div>';

    $content .= "<script type=\"text/javascript\">\n";
    $content .= "ga('ec:addImpression', {\n";                                                               // Provide product details in an impressionFieldObject.
    $content .= "   'id': '"       . $random_whats_new_sidebox_product->fields['products_id']   . "',\n";   // Product ID (string).
    $content .= "   'name': '"     . addslashes($random_whats_new_sidebox_product->fields['products_name']) . "',\n";   // Product name (string).
//     $content .= "   'category':    'CATEGORY',                                                           // Product category (string).
//     $content .= "   'brand':       'BRAND',                                                              // Product brand (string).
//     $content .= "   'variant':     'COLOR',                                                              // Product variant (string).
    $content .= "   'list':        'Side Box What\'s New',\n";                                              // Product list (string).
    $content .= "   'position': "   . $whats_new_box_counter . ",\n";                                       // Product position (number).
//     $content .= "   'dimension1':  'DIMENSION'});                                                        // Custom dimension (string).
    $content .= "});\n";
    $content .= "</script>\n";
    $content .= '</div>';
    $random_whats_new_sidebox_product->MoveNextRandom();
  }
  $content .= '</div>' . "\n";
