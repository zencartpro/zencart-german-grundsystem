<?php
/**
 * Page Template
 * Zen Cart German Specific (zencartpro adaptations)
 
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_login_default.php 2023-10-26 17:25:16Z webchills $
 */
?>
<div class="centerColumn" id="loginDefault">
    <h1 id="loginDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
    <?php if ($messageStack->size('login') > 0) {
        echo $messageStack->output('login');
    } ?>

    <?php if (USE_SPLIT_LOGIN_MODE == 'True' || $ec_button_enabled) { ?>
        <!--BOF PPEC split login- DO NOT REMOVE-->
        <fieldset class="floatingBox back">
            <legend><?php echo HEADING_NEW_CUSTOMER_SPLIT; ?></legend>


            <div class="information"><?php echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT; ?></div>
            <?php echo zen_draw_form('create', zen_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL')); ?>

            <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CREATE_ACCOUNT, BUTTON_CREATE_ACCOUNT_ALT, 'name="registrationButton"'); ?></div>
            <?php echo '</form>'; ?>
        </fieldset>

        <fieldset class="floatingBox forward">
            <legend><?php echo HEADING_RETURNING_CUSTOMER_SPLIT; ?></legend>
            <div class="information"><?php echo TEXT_RETURNING_CUSTOMER_SPLIT; ?></div>
            <?php echo zen_draw_form('loginForm', zen_href_link(FILENAME_LOGIN, 'action=process' . (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'id="loginForm"'); ?>

            <label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
            <?php echo zen_draw_input_field('email_address', '', 'size="18" id="login-email-address" autofocus autocomplete="username" placeholder="' . ENTRY_EMAIL_ADDRESS_TEXT . '"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
            <br class="clearBoth">

            <label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
            <?php echo zen_draw_password_field('password', '', 'size="18" id="login-password" autocomplete="current-password" placeholder="' . ENTRY_REQUIRED_SYMBOL . '"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : '')); ?>
            <br class="clearBoth">
            <?php echo zen_draw_input_field('empadminlogin', '', 'size="18" id="empadminlogin" style="visibility:hidden; display:none;" autocomplete="off"'); ?>
            <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?></div>
            <div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
            <?php echo '</form>'; ?>
        </fieldset>
<br class="clearBoth">

<?php if ($_SESSION['cart']->count_contents() > 0) { ?>
<?php if ($ec_button_enabled) { ?>	
  <br class="clearBoth">	
  	<fieldset id="paypallogin">
<legend><?php echo HEADING_PAYPAL_CUSTOMER_SPLIT; ?></legend>
<div class="information"><?php echo TEXT_PAYPAL_CUSTOMER_SPLIT; ?></div>
<div align="right"><?php require(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php'); ?></div>

</fieldset>
<?php } ?>
<?php } ?>
        <!--EOF PPEC split login- DO NOT REMOVE-->
    <?php } else { ?>
        <!--BOF normal login-->
        <?php
        if ($_SESSION['cart']->count_contents() > 0) {
            ?>
            <div class="advisory"><?php echo TEXT_VISITORS_CART; ?></div>
            <?php
        }
        ?>
        <?php echo zen_draw_form('loginForm', zen_href_link(FILENAME_LOGIN, 'action=process' . (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'id="loginForm"'); ?>
        <fieldset>
            <legend><?php echo HEADING_RETURNING_CUSTOMER; ?></legend>

            <label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
            <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address" autofocus autocomplete="username" placeholder="' . ENTRY_EMAIL_ADDRESS_TEXT . '"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
            <br class="clearBoth">

            <label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
            <?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', 40) . ' id="login-password" autocomplete="current-password" placeholder="' . ENTRY_REQUIRED_SYMBOL . '"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : '')); ?>
            <br class="clearBoth">
            <?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
            <?php echo zen_draw_input_field('empadminlogin', '', 'size="18" id="empadminlogin" style="visibility:hidden; display:none;" autocomplete="off"'); ?>
        </fieldset>

        <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?></div>
        <div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
        <?php echo '</form>'; ?>
        <br class="clearBoth">

        <?php echo zen_draw_form('createAccountForm', zen_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'onsubmit="return check_form(createAccountForm);" id="createAccountForm"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
        <fieldset>
            <legend><?php echo HEADING_NEW_CUSTOMER; ?></legend>
            <div class="information"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION; ?></div>
            <?php require($template->get_template_dir('tpl_modules_create_account.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_create_account.php'); ?>
        </fieldset>

        <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
        <?php echo '</form>'; ?>
        <!--EOF normal login-->
    <?php } ?>
</div>
