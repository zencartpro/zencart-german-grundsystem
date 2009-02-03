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
// $Id: rl.vat_info.php 343 2008-06-28 12:11:52Z hugo13 $
//
define('VAT_SHOW', true);
#define('ADD_VATADDON', 'NONE');
define('ADD_VATADDON', 'ALL');
#define('ADD_VATADDON', 'product_info|products_new'); // only display at productDetail & new Products

//define('VAT_SHOW_TEXT','<h2 class="taxAddon">inkl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></h2>');
define('VAT_SHOW_TEXT','<br><span class="taxAddon">inkl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></span>');
?>
