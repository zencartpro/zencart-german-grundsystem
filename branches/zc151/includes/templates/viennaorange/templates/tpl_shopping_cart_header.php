<?php
/**
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 */
 
  $content ="";
  $product_amount = 0;

  if ($_SESSION['cart']->count_contents() > 0) {
    $products = $_SESSION['cart']->get_products();

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
		$product_amount = $products[$i]['quantity'] + $product_amount;
	}

	$content .= '<a href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '"><img class="cart-icon full float-left" src="'. $template->get_template_dir('', DIR_WS_TEMPLATE, $current_page_base,'images') . '/spacer.gif" alt="" />' . HEADER_PRODUCT_AMOUNT . '<span>'. $product_amount . '</span></a><br/>'; 
  } else {
    $content .= '<div id="cartBoxEmpty"><a href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '"><img class="cart-icon empty float-left" src="'. $template->get_template_dir('', DIR_WS_TEMPLATE, $current_page_base,'images') . '/spacer.gif" alt="" /></a>' . HEADER_SHOPPING_CART_EMPTY . '</div>';
  }

  if ($_SESSION['cart']->count_contents() > 0) {
    $content .= HEADER_CART_SUBTOTAL .'<span class="subtotalhead">' . $currencies->format($_SESSION['cart']->show_total()) . '</span>';
  }

?>
