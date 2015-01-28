<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_whos_online.php 729 2011-08-09 15:49:16Z hugo13 $
 */
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  for ($i=0; $i<sizeof($whos_online); $i++) {
    $content .= $whos_online[$i];
  }
  $content .= '</div>';
  $content .= '';
?>