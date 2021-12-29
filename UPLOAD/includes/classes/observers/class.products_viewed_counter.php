<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: aclass.products_viewed_counter.php 2021-10-26 10:13:51Z webchills $ 
 */

class products_viewed_counter extends base
{
    protected $exclude_spiders = true;
    protected $exclude_maintenance_ips = true; // admins

    function __construct()
    {
        if ($this->should_be_excluded()) {
            return;
        }
        $this->attach($this, array('NOTIFY_PRODUCT_VIEWS_HIT_INCREMENTOR'));
    }

    function updateNotifyProductViewsHitIncrementor(&$class, $eventID, $product_id)
    {
        global $db;

        $sql = "INSERT INTO " . TABLE_COUNT_PRODUCT_VIEWS . "
                (product_id, language_id, date_viewed, views)
                VALUES (" . (int)$product_id . ", " . (int)$_SESSION['languages_id'] . ", now(), 1)
                ON DUPLICATE KEY UPDATE views = views + 1";
        $db->Execute($sql);
    }

    protected function should_be_excluded()
    {
        // exclude search-engine spiders
        if ($this->exclude_spiders && $GLOBALS['spider_flag'] === true) {
            return true;
        }

        // exclude hits from Admin users
        if ($this->exclude_maintenance_ips && zen_is_whitelisted_admin_ip()) { // admins
            return true;
        }
    }
}
