<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
*
* Common Template
* 
* @package templateSystem
* @copyright Copyright 2009-2010 12leaves.com
* @copyright Copyright 2003-2012 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id$
*/

// choose box images based on box position
  if ($title_link) {
    $title = $title . ' - <a href="' . zen_href_link($title_link) . '">' . BOX_HEADING_LINKS . '</a>';
  }
//
?>
<!--// bof: <?php echo $box_id; ?> //-->
<div class="singleBoxContainer" id="<?php echo str_replace('_', '-', $box_id ); ?>" style="width: <?php echo $column_width; ?>">
<h3 class="singleBoxHeading" id="<?php echo str_replace('_', '-', $box_id) . 'Heading'; ?>"><?php echo $title; ?></h3>
<?php echo $content; ?>
</div>
<!--// eof: <?php echo $box_id; ?> //-->

