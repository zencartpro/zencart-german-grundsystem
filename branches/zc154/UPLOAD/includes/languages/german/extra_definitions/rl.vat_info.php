<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl.vat_info.php 657 2014-04-12 15:45:57Z webchills $
 */

define('VAT_SHOW_TEXT_VERSANDKOSTENFREI','<br/><span class="taxAddon">inkl. %s MwSt.</span>');

if(DISPLAY_PRICE_WITH_TAX=='true')
define('VAT_SHOW_TEXT','<br/><span class="taxAddon">inkl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></span>');
else
define('VAT_SHOW_TEXT','<br/><span class="taxAddon">zzgl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></span>');