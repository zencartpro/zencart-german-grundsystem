<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=impressum.<br />
 * Displays impressum page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_impressum_default.php 746 2011-08-12 07:58:36Z hugo13 $
 */

?>
<!-- bof tpl_impressum_default.php -->
	<div class='centerColumn' id='impressum'>
		<h1 id='impressum-heading'><?php echo HEADING_TITLE; ?></h1>
		<div id='impressum-content' class='content'>
		<?php
		/**
		* require the html_define for the impressum page
		*/
		require($define_page);
		?>
		</div>
	</div>
<!-- eof tpl_impressum_default.php -->
