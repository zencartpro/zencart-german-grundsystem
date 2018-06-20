<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: options.php 3 2018-06-13 09:02:17 webchills $
 */

echo 
'opacity:' . ZEN_COLORBOX_OVERLAY_OPACITY .
',speed:' . ZEN_COLORBOX_RESIZE_DURATION .
',initialWidth:' . ZEN_COLORBOX_INITIAL_WIDTH . 
',initialHeight:' . ZEN_COLORBOX_INITIAL_HEIGHT . 
',overlayClose:' . ZEN_COLORBOX_CLOSE_OVERLAY .
',loop:' . ZEN_COLORBOX_LOOP;
if (ZEN_COLORBOX_SLIDESHOW == 'true')
{
echo
	',slideshow:' . ZEN_COLORBOX_SLIDESHOW . 
	',slideshowAuto:' . ZEN_COLORBOX_SLIDESHOW_AUTO . 
	',slideshowSpeed:' . ZEN_COLORBOX_SLIDESHOW_SPEED . 
	',slideshowStart:' . '"' . ZEN_COLORBOX_SLIDESHOW_START_TEXT . '"'. 
	',slideshowStop:' . '"' . ZEN_COLORBOX_SLIDESHOW_STOP_TEXT . '"';
}
echo 
',current:'; 
if (ZEN_COLORBOX_COUNTER == 'true') 
{
	echo '"{current} of {total}"'; 
}
else 
{
	echo '""'; 
}

