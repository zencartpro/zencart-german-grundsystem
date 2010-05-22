<?php
require('includes/application_top.php');

require(DIR_WS_CLASSES . 'captcha.php');
$captcha = new captcha();

if(isset($_POST['action']) && $_POST['action'] == 'GO') {
	if($captcha->validateCaptchaCode()) 
		echo 'You enter VALID code - "' . $_POST["captcha"] . '"<br />';
	else
		echo 'You enter INVALID code - "' . $_POST["captcha"] . '"<br />';
}
?>
<form action="<?php echo $PHP_SELF; ?>" method="post">
<?php
// BOF Captcha
if(is_object($captcha)) {
?>
<?php echo $captcha->img(); ?>
<?php echo $captcha->redraw_button(BUTTON_IMAGE_CAPTCHA_REDRAW, BUTTON_IMAGE_CAPTCHA_REDRAW_ALT); ?>
<br class="clearBoth" />
<label for="captcha"><?php echo TITLE_CAPTCHA; ?></label>
<?php echo $captcha->input_field('captcha', 'id="captcha"') . '&nbsp;<span class="alert">' . TEXT_CAPTCHA . '</span>'; ?>
<br class="clearBoth" />
<?php
}
// EOF Captcha
?>
<input type="submit" name="action" value="GO" />
</form>