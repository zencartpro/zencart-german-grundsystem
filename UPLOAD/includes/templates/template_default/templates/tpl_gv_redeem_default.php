<?php
/**
 * Page Template
 *
 * Display information related to GV redemption (could be redemption details, or an error message)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_gv_redeem_default.php 729 2011-08-09 15:49:16Z hugo13 $
 */
?>
<div class="centerColumn" id="gvRedeemDefault">

<h1 id="gvRedeemDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="gvRedeemDefaultMessage" class="content"><?php echo sprintf($message, $_GET['gv_no']); ?></div>

<div id="gvRedeemDefaultMainContent" class="content"><?php echo TEXT_INFORMATION; ?></div>

<div class="buttonRow forward"><?php echo '<a href="' . ($_GET['goback'] == 'true' ? zen_href_link(FILENAME_GV_FAQ) : zen_href_link(FILENAME_DEFAULT)) . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></div>

</div>