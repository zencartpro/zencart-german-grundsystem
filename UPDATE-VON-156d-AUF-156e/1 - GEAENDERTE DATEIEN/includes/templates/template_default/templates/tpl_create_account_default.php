<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_create_account_default.php 730 2020-01-17 15:57:16Z webchills $
 */
?>
<div class="centerColumn" id="createAcctDefault">
    <h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
    <?php echo zen_draw_form('createAccountForm', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(createAccountForm);" id="createAccountForm"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
    <h4 id="createAcctDefaultLoginLink"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(['action']), 'SSL')); ?></h4>
    <fieldset>
        <legend><?php echo CATEGORY_PERSONAL; ?></legend>
        <?php require($template->get_template_dir('tpl_modules_create_account.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_create_account.php'); ?>
    </fieldset>
    <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
    <?php echo '</form>'; ?>
</div>