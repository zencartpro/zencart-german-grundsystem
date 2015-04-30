<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured.php 730 2015-04-09 12:49:16Z webchills $
 */
  $content = "";
  $content .= '<div class="sideBoxContent centeredContent">';
  $featured_box_counter = 0;
  while (!$random_featured_product->EOF) {
    $featured_box_counter++;
    $featured_box_price = zen_get_products_display_price($random_featured_product->fields['products_id']);
    $content .= "\n" . '  <div class="sideBoxContentItem">';
    $content .=  '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], $random_featured_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
    $content .= '<br />' . $random_featured_product->fields['products_name'] . '</a>';
    $content .= '<div>' . $featured_box_price . '</div>';

    $content .= "<script type=\"text/javascript\">\n";
    $content .= "ga('ec:addImpression', {\n";                                                             // Provide product details in an impressionFieldObject.\n";
    $content .= "   'id': '"       . $random_featured_product->fields['products_id']   . "',\n";          // Product ID (string).\n";
    $content .= "   'name': '"     . addslashes($random_featured_product->fields['products_name']) . "',\n";          // Product name (string).\n";
//     $content .= "   'category':    'CATEGORY',                                                         // Product category (string).\n";
//     $content .= "   'brand':       'BRAND',                                                            // Product brand (string).\n";
//     $content .= "   'variant':     'COLOR',                                                            // Product variant (string).\n";
    $content .= "   'list':        'Side Box Featured',\n";                                               // Product list (string).\n";
    $content .= "   'position': "   . $featured_box_counter . ",\n";                                      // Product position (number).\n";
//     $content .= "   'dimension1':  'DIMENSION'});                                                      // Custom dimension (string).\n";
    $content .= "});\n";
    $content .= "</script>\n";


    $content .= '</div>';
    $random_featured_product->MoveNextRandom();
  }
  $content .= '</div>' . "\n";
