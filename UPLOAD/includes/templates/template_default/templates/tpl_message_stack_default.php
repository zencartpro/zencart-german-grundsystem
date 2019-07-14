<?php
/**
 * Page Template
 *
 * Loaded by messageStack system to display error/caution messages as needed
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_message_stack_default.php 729 2011-08-09 15:49:16Z hugo13 $
 */
?>
<?php for ($i=0, $n=sizeof($output); $i<$n; $i++) { ?>
  <div <?php echo $output[$i]['params']; ?>><?php echo $output[$i]['text']; ?></div>

<?php } ?>