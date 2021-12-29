<?php
/**
 * ZCAdditions.com Mega UL/LI Menu Template
 * Important Links (ez-pages) Option
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_ezpages.php 2021-12-27 16:55:58Z webchills $
 */

  $content .= '<li><a href="javascript:void(0)">'.$title_ezpages.'</a>';
  $content .= '<ul>';

  for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) { 
    $content .= '<li><a href="' . $var_linksList[$i]['link'] . '">' . $var_linksList[$i]['name'] . '</a></li>' . "\n" ;
  } // end FOR loop

  $content .= '</ul>';
  $content .= '</li>';
