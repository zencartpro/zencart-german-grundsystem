<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 729 2011-08-09 15:49:16Z hugo13 $
 */
?>

<body id="popupShippingEstimator">
<div class="shippingEstimatorWrapper biggerText">
<p><?php echo '<a href="javascript:window.close()">' . TEXT_CURRENT_CLOSE_WINDOW . '</a>'; ?></p>
      <?php require(DIR_WS_MODULES . zen_get_module_directory('shipping_estimator.php')); ?>
<p><?php echo '<a href="javascript:window.close()">' . TEXT_CURRENT_CLOSE_WINDOW . '</a>'; ?></p>
</div>
</body>