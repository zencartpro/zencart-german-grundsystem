<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: product_free_shipping 658 2019-05-09 09:45:57Z webchills $
 */

// defined as an image, text or a combination for Always Free Shipping
// comment out the ones you do not which to use
// to show nothing, comment all out except one and define as ''
// define('TEXT_PRODUCT_FREE_SHIPPING_ICON', 'FREE SHIPPING'); // for text or set to '' for nothing
define('TEXT_PRODUCT_FREE_SHIPPING_ICON', zen_image(DIR_WS_TEMPLATE_IMAGES . 'always-free-shipping.gif', 'Immer versandkostenfrei')); // for an image or comment out to use another
