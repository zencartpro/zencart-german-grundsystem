<?php
/**
 * Initializes non-database constants that were previously set in language modules,
 * overridable via site-specific /init_includes processing.  See
 * /admin/includes/init_includes/dist-init_site_specific_non_db_settings_admin.php.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_non_db_settings_admin 2023-10-21 09:06:39Z webchills $
 */

// -----
// Load the constant values defined for both storefront and admin use.
//
require DIR_FS_CATALOG . DIR_WS_INCLUDES . 'init_includes/init_non_db_settings.php';