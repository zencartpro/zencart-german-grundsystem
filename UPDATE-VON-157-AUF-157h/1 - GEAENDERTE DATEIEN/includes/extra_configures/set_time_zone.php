<?php
/**
 * @package initSystem
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: set_time_zone.php 2023-10-30 14:49:16Z webchills $
 */
/*
 * Set time zone
*/
// put your timezone here. Refer to http://www.php.net/manual/en/timezones.php
$TZ = '';  // eg: 'Europe/Oslo'



/**
* MAKE NO CHANGES BELOW THIS LINE
*
* The following will take the timezone you specified above and apply it in your store.
* If you didn't specify one, it will try to use the setting from your server's PHP configuration
*/
if (empty($TZ)) {
    $TZ = date_default_timezone_get();
} else {
    putenv('TZ=' . $TZ);
    @date_default_timezone_set($TZ);
}

// Now incorporate TZ change into log filenames
zen_set_error_logging_filename();
