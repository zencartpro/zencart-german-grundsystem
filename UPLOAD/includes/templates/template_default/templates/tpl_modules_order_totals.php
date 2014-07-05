<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_order_totals.php 729 2011-08-09 15:49:16Z hugo13 $
 */
 ?>
<?php 
/**
 * Displays order-totals modules' output
 */
  for ($i=0; $i<$size; $i++) { ?>
<div id="<?php echo str_replace('_', '', $GLOBALS[$class]->code); ?>">
    <div class="totalBox larger forward"><?php echo $GLOBALS[$class]->output[$i]['text']; ?></div>
    <div class="lineTitle larger forward"><?php echo $GLOBALS[$class]->output[$i]['title']; ?></div>
</div>
<br class="clearBoth" />
<?php } ?>
