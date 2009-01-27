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

define('TITLE_CAPTCHA', 'Spamschutz:<br/>Bitte tragen Sie die dargestellten Zeichen ein:');
define('TEXT_CAPTCHA', '* (Gross- und Kleinschreibung nicht wichtig)');
define('LABEL_CAPTCHA', 'Zeichen:');
define('ERROR_CAPTCHA', 'Sie haben die Zeichen falsch eingegeben. Bitte versuchen Sie es erneut.');
define('BUTTON_IMAGE_CAPTCHA_REDRAW', 'button_redraw.gif');
define('BUTTON_IMAGE_CAPTCHA_REDRAW_ALT', 'Bild neu laden');
define('BUTTON_IMAGE_CAPTCHA_REDRAW_TEXT', 'Wenn die Zeichen nicht leserlich genug sind, clicken Sie bitte hier um das Bild neu zu laden.');
define('IMAGE_CAPTCHA_ALT', 'Dieses Bild aktivieren');

define('ERROR_CAPTCHA_GD', 'CAPTCHA Fehler: Die GD-Bibliothek ist nicht aktiviert. CAPTCHA kann nicht benutzt werden!');
define('ERROR_CAPTCHA_GIF', 'CAPTCHA Fehler: Die GD-Bibliothek unterstützt das GIF-Format nicht. CAPTCHA kann nicht benutzt werden!');
define('ERROR_CAPTCHA_PNG', 'CAPTCHA Fehler: Die GD-Bibliothek unterstützt das PNG-Format nicht. CAPTCHA kann nicht benutzt werden!');
define('ERROR_CAPTCHA_JPG', 'CAPTCHA Fehler: Die GD-Bibliothek unterstützt das JPEG-Format nicht. CAPTCHA kann nicht benutzt werden!');
define('ERROR_CAPTCHA_SESSION', 'CAPTCHA Error: Session nicht gestartet. CAPTCHA kann nicht benutzt werden!');
?>