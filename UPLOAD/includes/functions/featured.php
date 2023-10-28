<?php
/*
 * featured-products functions
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: featured.php 2022-12-14 21:49:16Z webchills $
 */

/**
 * Set the status of a featured product
 * 
 * @global object $db
 * @param int $featured_id
 * @param int $status
 */
function zen_set_featured_status(int $featured_id, int $status)
{
  global $db;
  $sql = "UPDATE " . TABLE_FEATURED . "
          SET status = " . (int)$status . ",
              date_status_change = now()
          WHERE featured_id = " . (int)$featured_id;

  $db->Execute($sql);
}

/**
 * Auto expire products on featured
 * 
 * @global object $db
 */
function zen_expire_featured()
{
  global $db;

  $date_range = time();
  $zc_featured_date = date('Ymd', $date_range);

  $featured_query = "SELECT featured_id
                     FROM " . TABLE_FEATURED . "
                     WHERE status = 1
                     AND (
                       (" . $zc_featured_date . " >= expires_date
                         AND expires_date != '0001-01-01')
                       OR (" . $zc_featured_date . " < featured_date_available
                         AND featured_date_available != '0001-01-01'))";

  $featureds = $db->Execute($featured_query);

  if ($featureds->RecordCount() > 0) {
    foreach ($featureds as $featured) {
      zen_set_featured_status((int)$featured['featured_id'], 0);
    }
  }
}

/**
 * Auto start products on featured
 * 
 * @global object $db
 */
function zen_start_featured()
{
  global $db;

  $date_range = time();
  $zc_featured_date = date('Ymd', $date_range);

  $featured_query = "SELECT featured_id
                     FROM " . TABLE_FEATURED . "
                     WHERE status = 0
                     AND (((featured_date_available <= " . $zc_featured_date . " AND featured_date_available != '0001-01-01') AND (expires_date > " . $zc_featured_date . "))
                     OR ((featured_date_available <= " . $zc_featured_date . " AND featured_date_available != '0001-01-01') AND (expires_date = '0001-01-01'))
                     OR (featured_date_available = '0001-01-01' AND expires_date > " . $zc_featured_date . "))";

  $featureds_on = $db->Execute($featured_query);

  if ($featureds_on->RecordCount() > 0) {
    foreach ($featureds_on as $featured) {
      zen_set_featured_status((int)$featured['featured_id'], 1);
    }
  }

// turn off featured if not active yet
  $featured_query = "SELECT featured_id
                     FROM " . TABLE_FEATURED . "
                     WHERE status = 1
                     AND (" . $zc_featured_date . " < featured_date_available AND featured_date_available != '0001-01-01')";

  $featureds_off = $db->Execute($featured_query);

  if ($featureds_off->RecordCount() > 0) {
    foreach ($featureds_off as $featured) {
      zen_set_featured_status((int)$featured['featured_id'], 0);
    }
  }
}
