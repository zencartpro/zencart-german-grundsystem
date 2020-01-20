<?php
/**
 * @package admin
 * Zen Cart German Specific
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: footer.php 797 2019-04-13 09:24:50Z webchills $
 */

// check and display zen cart version and history version in footer
  $current_sinfo = PROJECT_VERSION_NAME . ' v' . PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR . '/';
  $check_hist_query = "SELECT * from " . TABLE_PROJECT_VERSION . " WHERE project_version_key = 'Zen-Cart Database' ORDER BY project_version_date_applied DESC LIMIT 1";
  $check_hist_details = $db->Execute($check_hist_query);
  if (!$check_hist_details->EOF) {
    $current_sinfo .=  'v' . $check_hist_details->fields['project_version_major'] . '.' . $check_hist_details->fields['project_version_minor'];
    if (zen_not_null($check_hist_details->fields['project_version_patch1'])) $current_sinfo .= '&nbsp;&nbsp;Patch: ' . $check_hist_details->fields['project_version_patch1'];
  }

// BOF: Mailbeez Customer Insight
define('MH_DIR_FS_CATALOG', (substr(DIR_FS_CATALOG, -1) != '/') ? DIR_FS_CATALOG . '/' : DIR_FS_CATALOG);
@include(MH_DIR_FS_CATALOG . '/mailhive/configbeez/config_customer_insight/includes/admin_footer_include.php');
// EOF: Mailbeez Customer Insight

?>
<footer>
  <div id="footer">
   
    E-Commerce Engine Copyright &copy; 2003-<?php echo date('Y'); ?> <a href="http://www.zen-cart-pro.at" target="_blank">Zen Cart - deutsche Version</a><br />
    <?php echo '<a href="' . zen_href_link(FILENAME_SERVER_INFO) . '">' . $current_sinfo . '</a>'; ?>
  </div>
</footer>
<?php
$zco_notifier->notify('NOTIFY_ADMIN_FOOTER_END');