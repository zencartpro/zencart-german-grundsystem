<?php
/**
 * subscribe_header - this is a subscribe field that appears in the navigation header
 * This uses the same base template as the subscribe sidebox.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: subscribe_header.php,v 1.1 2006/06/16 01:46:15 Owner Exp $
 */

   if(defined('NEWSONLY_SUBSCRIPTION_ENABLED') &&
      (NEWSONLY_SUBSCRIPTION_ENABLED=='true')) {
    $show_subscribe_header= true;
  }

  if ($show_subscribe_header == true) {
    $subscribe_text = HEADER_SUBSCRIBE_LABEL;
    require($template->get_template_dir('tpl_subscribe_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_subscribe_header.php');

    $title = '';
    $title_link = false;
    require($template->get_template_dir('tpl_box_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_box_header.php');
  }
?>
