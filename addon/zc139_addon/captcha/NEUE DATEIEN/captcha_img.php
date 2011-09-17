<?php
/**
 * captcha_img.php generate CAPTCHA image
 *
 * @package captcha
 * @copyright Copyright 2004-2007 AndrewBerezin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: captcha_img.php v v 2.7 28.04.2007 6:12 AndrewBerezin $
 */

require('includes/application_top.php');

require(DIR_WS_CLASSES . 'captcha.php');
$captcha = new captcha();

$captcha->generateCaptcha();
?>