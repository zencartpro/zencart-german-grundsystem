<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_information.php 2 2016-04-06 11:33:58Z webchills $
 */
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';
  $content .= "\n" . '<ul class="list-links">' . "\n";
  for ($i=0; $i<sizeof($information); $i++) {
    $content .= '<li>' . $information[$i] . '</li>' . "\n";
  }
  $content .= '</ul>' .  "\n";
  $content .= '</div>';
