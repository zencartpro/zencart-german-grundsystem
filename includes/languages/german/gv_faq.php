<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: gv_faq.php 4155 2006-08-16 17:14:52Z ajeh $
//

define('NAVBAR_TITLE', TEXT_GV_NAME . ' FAQ');define('HEADING_TITLE', TEXT_GV_NAME . ' FAQ');define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Wie bestelle ich ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Wie versende ich ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Einkaufen mit ' . TEXT_GV_NAMES . 'n</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Einl&ouml;sen von ' . TEXT_GV_NAMES . 'n</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">Wenn Probleme auftreten</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','');define('SUB_HEADING_TEXT','Bitte w&auml;hlen Sie Ihr Thema, zudem Sie Fragen haben.');
  break;
  case '2':

  break;
  case '3':

  break;
  case '4':

  break;
  case '5':

  break;
  default:


  }

define('TEXT_GV_REDEEM_INFO', 'Bitte geben Sie Ihren  ' . TEXT_GV_NAME . ' Gutscheincode ein: ');define('TEXT_GV_REDEEM_ID', 'Gutscheincode:');


?>