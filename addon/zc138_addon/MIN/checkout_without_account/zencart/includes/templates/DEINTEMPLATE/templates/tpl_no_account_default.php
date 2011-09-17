<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: J_Schilz for Integrated COWOA - 14 April 2007
 */
?>
<div class="centerColumn" id="createAcctDefault">

<h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<h4 id="createAcctDefaultLoginLink"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(array('action')), 'SSL')); ?></h4>

<?php echo zen_draw_form('no_account', zen_href_link(FILENAME_NO_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(no_account);"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>


<?php require($template->get_template_dir('tpl_modules_no_account.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_no_account.php'); ?>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONTINUE_CHECKOUT, BUTTON_CONTINUE_ALT); ?></div>
<div class="buttonRow back"><?php echo '<strong>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</strong><br />' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>


</form>
</div>
