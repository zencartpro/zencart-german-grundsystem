<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl.vat_info.php 656 2012-11-18 17:45:57Z webchills $
 */


if(DISPLAY_PRICE_WITH_TAX=='true')
define('VAT_SHOW_TEXT','<br/><span class="taxAddon">inkl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></span>');
else
define('VAT_SHOW_TEXT','<br/><span class="taxAddon">zzgl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></span>');