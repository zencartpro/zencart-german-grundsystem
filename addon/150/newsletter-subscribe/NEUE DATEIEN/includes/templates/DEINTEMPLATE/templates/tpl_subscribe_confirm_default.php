<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_subscribe_confirm_default.php,v 1.1 2006/06/16 01:46:16 Owner Exp $  dmcl1
//
?>
<!-- body_text //-->
   <div class="centerColumn" id="maintenanceDefault">
<?php if ($error == 'true') { ?>
	<p><?php echo $messageStack->output('subscribe'); ?></p>
	<p>
	<?php	require(DIR_FS_CATALOG . DIR_WS_MODULES . zen_get_module_directory(FILENAME_SUBSCRIBE_HEADER)); ?>
	</p>
<?php } else { ?>
<?php 	if (file_exists($definedpage)) { ?>
	<p class="plainBox"><?php require($definedpage); ?></p>
<?php 	} else { ?>
  <p class="plainBox"><?php echo TEXT_INFORMATION; ?></p>
<?php 	} ?>
  <p class="plainBox"><?php echo TEXT_INFORMATION_CONFIRM; ?></p>
<?php } ?>
    <p class="main"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></p>
</div>
