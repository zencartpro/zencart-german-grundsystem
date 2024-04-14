<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_ask_a_question.php 2023-10-26 16:51:51Z webchills $
 */
?>
<div class="centerColumn" id="askAQuestion">

<?php echo zen_draw_form('ask_a_question', zen_href_link(FILENAME_ASK_A_QUESTION, 'action=send&pid=' . (int)$_GET['pid'], 'SSL')); ?>

<?php if (CONTACT_US_STORE_NAME_ADDRESS== '1') { ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>
<h1><?php echo $heading_title . $product_details['products_name']; ?></h1>


<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>

<div class="mainContent success"><?php echo TEXT_SUCCESS; ?></div>

<div class="buttonRow"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  } else {
?>

<?php echo '<a href="' . zen_href_link(zen_get_info_page((int)$_GET['pid']), 'products_id=' . (int)$_GET['pid'], 'SSL') . '">' . zen_image(DIR_WS_IMAGES . $product_details['products_image'], $product_details['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT) . '</a>'; ?>

<div id="contactUsNoticeContent" class="content">
<?php
/**
 * require html_define for the contact_us page
 */
  require($define_page);
?>
</div>

<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>

<fieldset id="contactUsForm">
<legend><?php echo $form_title; ?></legend>
<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clearBoth">

<?php
// show dropdown if set
    if (!empty(CONTACT_US_LIST)){
?>
<label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
<?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 0, 'id="send-to"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clearBoth">
<?php
    }
?>

<label class="inputLabel" for="contactname"><?php echo ENTRY_NAME; ?></label>
<?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname" placeholder="' . ENTRY_REQUIRED_SYMBOL . '" autofocus required'); ?>
<br class="clearBoth">

<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL; ?></label>
<?php echo zen_draw_input_field('email', ($email_address), ' size="40" id="email-address" autocomplete="off" placeholder="' . ENTRY_REQUIRED_SYMBOL . '" required', 'email'); ?>
<br class="clearBoth">

<label class="inputLabel" for="telephone"><?php echo ENTRY_TELEPHONE; ?></label>
<?php echo zen_draw_input_field('telephone', ($telephone), ' size="20" id="telephone" autocomplete="off" placeholder="' . ENTRY_REQUIRED_SYMBOL . '" required', 'tel'); ?>
<br class="clearBoth">

<div class="contact">
<label for="enquiry"><?php echo ENTRY_ENQUIRY; ?></label>
<?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, 'id="enquiry" placeholder="' . ENTRY_REQUIRED_SYMBOL . '" required'); ?>
</div>
  
<div class="email-pot">
<label for="email-us"></label>
<?php echo zen_draw_input_field(SPAM_TEST_TEXT, '', ' id="email-us" title="do not fill in!" placeholder="do not fill in!" autocomplete="off"', 'email'); ?>
</div>

<div class="email-pot">
<p><?php echo HUMAN_TEXT_NOT_DISPLAYED; ?></p>
<?php echo zen_draw_radio_field(SPAM_TEST_USER, 'H1', '', 'id="user-1"') . '<span class="input-group-addon"><i class="fa fa-male fa-2x"></i></span>' . zen_draw_radio_field(SPAM_TEST_USER, 'C2', '', 'id="user-2"') . '<span class="input-group-addon"><i class="fa fa-laptop fa-2x"></i></span>'; ?>
</div>

</fieldset>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
  }
?>
</form>
</div>

