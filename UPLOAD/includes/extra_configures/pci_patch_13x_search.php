<?php
/**
 * PCI Patch for v1.3.x -- to aid in avoiding false-positives thrown by PCI scans
 *
 * @package initSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: pci_patch_13x_search.php 729 2011-08-09 15:49:16Z hugo13 $
 */
/**
 *
 * Please Note : This file should be placed in includes/extra_configures and will automatically load.
 *
 */
if (isset($_GET['keyword']) && $_GET['keyword'] != '')
{
  $count =  substr_count($_GET['keyword'], '"');
  if ($count == 1)
  {
    if(substr(stripslashes(trim($_GET['keyword'])), 0, 1) == '"')
    {
      $_GET['keyword'] .= '"';
    }
  }
  $_GET['keyword'] = stripslashes($_GET['keyword']);
}
if (isset($_GET['sort']) && strlen($_GET['sort']) > 3) {
  $_GET['sort'] = substr($_GET['sort'], 0, 3);
}
