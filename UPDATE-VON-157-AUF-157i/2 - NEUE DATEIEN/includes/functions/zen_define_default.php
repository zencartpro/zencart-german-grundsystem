<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * An early-loading function (loaded by /includes/application_top.php and /admin/includes/application_bootstrap.php)
 * to simplify the processing to set a default value for a 'define' if the definition is not yet present.
 *
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: zen_define_default.php 2023-04-30 19:25:16Z webchills $
 */

function zen_define_default(string $name, $default_value)
{
    if (!defined($name)) {
        define($name, $default_value);
    }
}