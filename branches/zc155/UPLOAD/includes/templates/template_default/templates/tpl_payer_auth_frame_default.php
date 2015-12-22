<?php
/**
 * template for 3d-secure iframe
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2005 CardinalCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_payer_auth_frame_default.php 729 2011-08-09 15:49:16Z hugo13 $
 */
?>
<div>
  <div class="bold"><p><?php echo TEXT_3DS_PAYER_AUTH_FRAME_TITLE_MESSAGE; ?></p></div>
  <div class="forward"><?php echo zen_image(DIR_WS_IMAGES.'3ds/vbv.gif');?></div>
  <div class="forward"><?php echo zen_image(DIR_WS_IMAGES.'3ds/mcsc.gif');?></div>
</div>

<iframe name="auth_frame" id="authFrame" class="authFrame" src="<?php echo $_SESSION['3Dsecure_auth_url'] ?>" frameborder="0" width="500" height="500" scrolling="no" style="align: center;"></iframe>
