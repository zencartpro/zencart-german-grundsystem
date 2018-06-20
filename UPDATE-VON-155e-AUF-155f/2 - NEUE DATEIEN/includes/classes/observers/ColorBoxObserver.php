<?php
/**
 * @package Image Handler
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: ColorBoxObserver.php 2018-06-15 16:13:51Z webchills $
 */
// -----
// An observer-class to enable the "Colorbox" plugin to operate with the notification updates in the
// main_product_image and additional_images processing, provided by "Image Handler" v5.0.0 and later.
//
class ColorBoxObserver extends base 
{
    public function __construct() 
    {
        if (defined('ZEN_COLORBOX_STATUS') && ZEN_COLORBOX_STATUS == 'true') {
            $this->attach(
                $this,
                array(
                    //- From /includes/modules/additional_images.php
                    'NOTIFY_MODULES_ADDITIONAL_IMAGES_SCRIPT_LINK',
                )
            );
        }
    }

    public function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4, &$p5, &$p6, &$p7, &$p8, &$p9) 
    {
        switch ($eventID) {
            // -----
            // This notifier gives notice that an additional image's script link is requested.  A monitoring observer sets
            // the $p2 value to boolean true if it has provided an alternate form of that link; otherwise, the base code will
            // create that value.
            //
            // $p1 ... (r/o) ... An associative array, containing the 'flag_display_large', 'products_name', 'products_image_large', 'large_link' and 'thumb_slashes' values.
            // $p2 ... (r/w) ... A reference to the $script_link value, set initially to boolean false; if an observer modifies that value, the
            //                     the default module's processing is bypassed.
            //
            case 'NOTIFY_MODULES_ADDITIONAL_IMAGES_SCRIPT_LINK':
                global $template_dir;
                $flag_display_large = $p1['flag_display_large'];
                $products_name = $p1['products_name'];
                $products_image_large = $p1['products_image_large'];
                $thumb_slashes = $p1['thumb_slashes'];
                $large_link = $p1['large_link'];
                require DIR_WS_MODULES . zen_get_module_directory('zen_colorbox.php');
                if (isset($script_link)) {
                    $p2 = $script_link;
                }
                break;

            default:
                break;
        }
    }
}
