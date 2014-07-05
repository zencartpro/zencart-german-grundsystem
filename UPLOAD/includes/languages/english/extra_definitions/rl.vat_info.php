<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl.vat_info.php 658 2014-04-12 15:45:57Z webchills $
 */
 
define('VAT_SHOW_TEXT_VERSANDKOSTENFREI','<br/><span class="taxAddon">incl. %s VAT</span>');

if(DISPLAY_PRICE_WITH_TAX=='true')
define('VAT_SHOW_TEXT','<br/><span class="taxAddon">incl. %s VAT<br/> plus <a href="' . zen_href_link(FILENAME_SHIPPING) . '">shipping and handling</a></span>');
else
define('VAT_SHOW_TEXT','<br/><span class="taxAddon">plus %s VAT<br/> plus <a href="' . zen_href_link(FILENAME_SHIPPING) . '">shipping and handling</a></span>');