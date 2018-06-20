<?php
/**
 * @package Image Handler
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: bmz_image_handler_conf.php 2018-06-15 16:13:51Z webchills $
 */
$ihConf = array();
$ihConf['noresize_key']         = 'noresize';         //files which contain this string will not be resized
$ihConf['noresize_dirs']        = array('noresize', 'banners'); //images in directories with these names within the images directory will not be resized.
$ihConf['trans_threshold']      = '90%';              //this is where semitransparent pixels blend to transparent when rendering gifs with ImageMagick
$ihConf['im_convert']           = '';                 //if you want to use ImageMagick, you must specify the convert binary here (e.g. '/usr/bin/convert')
$ihConf['gdlib']                = 2;                  //the GDlib version (0, 1 or 2) 2 tries to autodetect
$ihConf['default']['bg']        = 'transparent 255:255:255';
$ihConf['default']['quality']   = 85;