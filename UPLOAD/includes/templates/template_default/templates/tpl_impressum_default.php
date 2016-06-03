<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=impressum.<br />
 * Displays impressum page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_impressum_default.php 747 2016-06-03 19:58:36Z webchills $
 */

?>

<div class="centerColumn" id="impressum">
<?php if (IT_RECHT_KANZLEI_STATUS == 'ja') { ?>
<h1 id="impressumHeading"><?php echo $var_pageDetails->fields['pages_title']; ?></h1>
<?php } else { ?>
<h1 id="impressumHeading"><?php echo HEADING_TITLE; ?></h1>
<?php } ?>

<?php if (DEFINE_IMPRESSUM_STATUS >= 1 and DEFINE_IMPRESSUM_STATUS <= 2) { ?>
<div id="impressumMainContent" class="content">
<?php if (IT_RECHT_KANZLEI_STATUS == 'ja') { ?>
<?php echo $var_pageDetails->fields['pages_html_text']; ?>
<?php } else { ?>
<?php
/**
 * require the html_define for the impressum page
 */
  require($define_page);
?>
<?php } ?>
</div>
<?php } ?>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>

