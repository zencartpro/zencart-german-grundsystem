<?php

/**

 * Page Template

 *

 * Loaded automatically by index.php?main_page=contact_us.<br />

 * Displays contact us page form.

 *

 * @package templateSystem

 * @copyright Copyright 2003-2010 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_contact_us_default.php for reCaptcha ZC139 2010-09-22 21:10:49Z webchills $

 *	Adapted by Joe McFrederick for reCAPTCHA 2009/06/23
 */

?>

<div class="centerColumn" id="contactUsDefault">



<?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send')); ?>



<?php if (CONTACT_US_STORE_NAME_ADDRESS== '1') { ?>

<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>

<?php } ?>



<?php

  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {

?>



<div class="mainContent success"><?php echo TEXT_SUCCESS; ?></div>



<div class="buttonRow"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>



<?php

  } else {

?>



<?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>

<div id="contactUsNoticeContent" class="content">

<?php

/**

 * require html_define for the contact_us page

 */

  require($define_page);

?>

</div>

<?php } ?>



<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>



<fieldset id="contactUsForm">

<legend><?php echo HEADING_TITLE; ?></legend>

<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

<br class="clearBoth" />



<?php

// show dropdown if set

    if (CONTACT_US_LIST !=''){

?>

<label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>

<?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 0, 'id="send-to"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>

<br class="clearBoth" />

<?php

    }

?>



<label class="inputLabel" for="contactname"><?php echo ENTRY_NAME; ?></label>

<?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>

<br class="clearBoth" />



<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL; ?></label>
<?php echo zen_draw_input_field('email', ($email_address), ' size="40" id="email-address"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clearBoth" />



<label for="enquiry"><?php echo ENTRY_ENQUIRY . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, 'id="enquiry"'); ?>



</fieldset>

<?php
	/*
	*	reCAPTCHA modification begin
	*/
	
	if(CONTACT_US_RECAPTCHA_STATUS == 'true')
	{
		
?>
	 <!-- start modification for reCaptcha -->
             <div class="recaptcha">
             <label class="inputLabel" for="recaptcha"><?php echo ENTRY_SECURITY_CHECK; ?></label>
              			<script language="javascript" type="text/javascript">
								var RecaptchaOptions = {
								   theme : '<?php echo CONTACT_US_RECAPTCHA_THEME;?>',
								   tabindex : 3
								};
						</script>              	
               <?php echo recaptcha_get_html(CONTACT_US_RECAPTCHA_PUBLIC_KEY); ?>
              </div>
              <!-- end modification for reCaptcha -->
<?php
	}
	/*
	*	reCAPTCHA modification begin
	*/
?>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>

<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php

  }

?>

</form>

</div>