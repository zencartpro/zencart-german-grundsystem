<?php
/**
* @package templateSystem
* @copyright Copyright 2003-2016 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_search_header.php 12 2013-08-17 20:33:58Z webchills $
*/
  $content = "";
  $content .= zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
  $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
  $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();

  
    $content .= zen_draw_input_field('keyword', '', 'size="40" maxlength="40" value="' . HEADER_SEARCH_DEFAULT_TEXT . '" onfocus="if (this.value == \'' . HEADER_SEARCH_DEFAULT_TEXT . '\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . HEADER_SEARCH_DEFAULT_TEXT . '\';"');
    
   $content .= '&nbsp;<input type="image" class="alignme" src="' . $template->get_template_dir('', DIR_WS_TEMPLATE, $current_page_base,'images') . '/search_header_button.jpg' . '" alt="Go!" title="Go!" />';
   

  $content .= "</form>";
  echo($content);
?>