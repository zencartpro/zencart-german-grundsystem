<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: options.php 2008-12-16 aclarke $
 */

echo 
'overlayOpacity:' . ZEN_LIGHTBOX_OVERLAY_OPACITY .
',overlayFadeDuration:' . ZEN_LIGHTBOX_OVERLAY_FADE_DURATION .
',resizeDuration:' . ZEN_LIGHTBOX_RESIZE_DURATION .
',resizeTransition:' . ZEN_LIGHTBOX_RESIZE_TRANSITION . 
',initialWidth:' . ZEN_LIGHTBOX_INITIAL_WIDTH . 
',initialHeight:' . ZEN_LIGHTBOX_INITIAL_HEIGHT . 
',imageFadeDuration:' . ZEN_LIGHTBOX_IMAGE_FADE_DURATION . ',captionAnimationDuration:' . ZEN_LIGHTBOX_CAPTION_ANIMATION_DURATION . 
',counterText:'; 
if (ZEN_LIGHTBOX_COUNTER == 'true') 
{
	echo '"' . ZEN_LIGHTBOX_COUNTER_IMAGE . ' {x} ' . ZEN_LIGHTBOX_COUNTER_OF . ' {y}"'; 
}
else 
{
	echo 'false'; 
}
	echo ',closeKeys:['; 
if (ZEN_LIGHTBOX_KEYBOARD_NAVIGATION == 'true')
{
	echo str_replace(' ', '', ZEN_LIGHTBOX_ESCAPE_KEYS); 
}
else
{
	echo 'false'; 
}
	echo '],previousKeys:['; 
if (ZEN_LIGHTBOX_KEYBOARD_NAVIGATION == 'true') 
{
	echo str_replace(' ', '', ZEN_LIGHTBOX_PREVIOUS_KEYS); 
}
else 
{
	echo 'false'; 
}
	echo  '],nextKeys:[';
if (ZEN_LIGHTBOX_KEYBOARD_NAVIGATION == 'true') 
{
	echo str_replace(' ', '', ZEN_LIGHTBOX_NEXT_KEYS);
	
}
else 
{
	echo 'false'; 
}
echo ']';
?>