<?php
/**
 * captcha.php CAPTCHA class
 *
 * @package captcha
 * @copyright Copyright 2004-2007 AndrewBerezin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zen_captcha_img.php 1 26.02.2007 8:01 AndrewBerezin $
 */

define('TITLE_CAPTCHA', 'Spam Protection:<br/>Enter verification code:');
define('TEXT_CAPTCHA', '* (case insensitive)');
define('ERROR_CAPTCHA', 'You did not enter the validation code correctly. Please, try again.');
define('BUTTON_IMAGE_CAPTCHA_REDRAW', 'button_redraw.gif');
define('BUTTON_IMAGE_CAPTCHA_REDRAW_ALT', 'Redraw Captcha Image');
define('BUTTON_IMAGE_CAPTCHA_REDRAW_TEXT', 'If the image text is not readable use this button to redisplay it');
define('IMAGE_CAPTCHA_ALT', 'Enable this picture');

define('ERROR_CAPTCHA_GD', 'CAPTCHA Error: There is no GD-Library enabled. The CAPTCHA cannot be used!');
define('ERROR_CAPTCHA_GIF', 'CAPTCHA Error: GD-Library does not support GIF. The CAPTCHA cannot be used!');
define('ERROR_CAPTCHA_PNG', 'CAPTCHA Error: GD-Library does not support PNG. The CAPTCHA cannot be used!');
define('ERROR_CAPTCHA_JPG', 'CAPTCHA Error: GD-Library does not support JPG. The CAPTCHA cannot be used!');
define('ERROR_CAPTCHA_SESSION', 'CAPTCHA Error: Session not started. The CAPTCHA cannot be used!');
?>