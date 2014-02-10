<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_more_information.php 729 2011-08-09 15:49:16Z hugo13 $
 */
  $content = '';
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n" ;
  $content .=  "\n" . '<ul style="margin: 0; padding: 0; list-style-type: none;">' . "\n" ;
  for ($i=0; $i<sizeof($more_information); $i++) {
    $content .= '<li>' . $more_information[$i] . '</li>' . "\n" ;
  }

  $content .= '</ul>' . "\n" ;
  $content .= '</div>';
?>