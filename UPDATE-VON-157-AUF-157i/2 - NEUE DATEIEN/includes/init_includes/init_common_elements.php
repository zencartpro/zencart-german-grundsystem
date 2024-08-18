<?php
/**
 * Set some common processing flags, overridable via site-specific /extra_datafiles processing.  See
 * /includes/extra_datafiles/dist-site_specific_overrides.php.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_common_elements 2023-10-21 09:06:39Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// -----
// Sets the processing flag (used by /includes/modules/sideboxes/information.php) that
// indicates whether or not a link to the "About Us" page should be included.
//
$flag_show_about_us_sidebox_link = (isset($flag_show_about_us_sidebox_link)) ? (bool)$flag_show_about_us_sidebox_link : true;

// -----
// Sets the processing flag (used by /includes/modules/sideboxes/information.php) that
// indicates whether or not a link to the "Brands" page should be included.
//
if (isset($flag_show_brand_sidebox_link)) {
    $flag_show_brand_sidebox_link = (bool)$flag_show_brand_sidebox_link;
} else {
    // -----
    // Setting a flag for use in the 'information' sidebox.
    //
    $brand_check = $db->Execute(
        "SELECT m.manufacturers_id
           FROM " . TABLE_MANUFACTURERS . " m
                LEFT JOIN " . TABLE_PRODUCTS . " p
                    ON p.manufacturers_id = m.manufacturers_id
          WHERE p.products_status = 1
          LIMIT 1"
    );
    $flag_show_brand_sidebox_link = !$brand_check->EOF;
    unset($brand_check);
}
