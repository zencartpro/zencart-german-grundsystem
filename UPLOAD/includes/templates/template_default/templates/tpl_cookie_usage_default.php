<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=cookie_usage.
 * Displays information page, if cookie only is set in admin and cookies disabled in users browser.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_cookie_usage_default.php 2011-08-09 15:49:16Z hugo13 $
 */
?>
<div class="centerColumn" id="cookieUsageDefault">

<h1 id="cookieUsageDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="cookieUsageDefaultMainContent" class="content"><?php echo TEXT_INFORMATION; ?></div>

<fieldset>
<legend><?php echo BOX_INFORMATION_HEADING; ?></legend>
<div id="cookieUsageDefaultSecondaryContent" class="content"><?php echo BOX_INFORMATION; ?></div>
</fieldset>

<div id="cookieUsageDefaultContent2" class="content"><?php echo TEXT_INFORMATION_2; ?></div>

<div id="cookieUsageDefaultContent3" class="content"><?php echo TEXT_INFORMATION_3; ?></div>

<div id="cookieUsageDefaultContent4" class="content"><?php echo TEXT_INFORMATION_4; ?></div>

<div id="cookieUsageDefaultContent5" class="content"><?php echo TEXT_INFORMATION_5; ?></div>

<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></div>
</div>
