<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_newsletters.
 * Subscribe/Unsubscribe from General Newsletter
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_account_newsletters_default.php 2022-04-09 08:14:16Z webchills $
 */
?>
<div class="centerColumn" id="acctNewslettersDefault">
<?php echo zen_draw_form('account_newsletter', zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>

<h1 id="acctNewslettersDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<?php if ($messageStack->size('newsletter') > 0) echo $messageStack->output('newsletter'); ?>

<fieldset>
<legend><?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER; ?></legend>
<?php echo zen_draw_checkbox_field('newsletter_general', '1', (($newsletter->fields['customers_newsletter'] == '1') ? true : false), 'id="newsletter"'); ?>
<label class="checkboxLabel" for="newsletter"><?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER_DESCRIPTION; ?></label>
<br class="clearBoth">
</fieldset>


<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div> 
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

</form>
</div>