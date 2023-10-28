<?php
/** 
 * File contains just the base class
 * Zen Cart German Specific (158 code in 157) 
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: class.base.php 2023-10-25 20:11:16Z webchills $
 */

use Zencart\Traits\NotifierManager;
use Zencart\Traits\ObserverManager;

class base
{
    use NotifierManager;
    use ObserverManager;

    public static function camelize($rawName, $camelFirst = false)
    {
        if ($rawName == "")
            return $rawName;
        if ($camelFirst) {
            $rawName[0] = strtoupper($rawName[0]);
        }
        return preg_replace_callback('/[_-]([0-9,a-z])/', function ($matches) {
            return strtoupper($matches[1]);
        }, $rawName);
    }
}
