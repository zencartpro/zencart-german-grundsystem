<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_best_sellers.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  for ($i=1; $i<=sizeof($bestsellers_list); $i++) {
    $bsl .= '<li><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' . zen_trunc_string($bestsellers_list[$i]['name'], BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) . '</a><br /><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' .  zen_image(DIR_WS_IMAGES . $bestsellers_list[$i]['image'], $bestsellers_list[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) .'</a><br /></li>' . "\n";
  }

  $total = $i;

	if ($total > 1) { //if more than one special exists in the db then scrolling begins
	$content .= '<div class="scroller_container"><div class="jscroller2_up jscroller2_speed-20 jscroller2_mousemove"><ol>' . $bsl .'</ol>' . "\n" . '</div>
	<div class="jscroller2_up_endless"><ol>' . $bsl .'</ol>' . "\n" . '</div></div>';
 }

 elseif ($total == 1) {  // If only one special exists in the db then the specials box will remain static
    $content .=  $bsl;
 }

 else { //  If there are no bestsellers then this text is displayed
    $content .= "No bestsellers this month!";
 }
	$content .= '</div>'; 
//EOF