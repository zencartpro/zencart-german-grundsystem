<?php
/**
 * Links Submit Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_3_default.php 3254 2006-03-25 17:34:04Z ajeh $
 */
?>

<div class="centerColumn" id="ezPageDefault">

<?php echo HEADING_TITLE; ?>
   
<?php echo zen_draw_form('submit_link', zen_href_link(FILENAME_LINKS_SUBMIT, 'action=send', 'SSL')); ?>

<?php if (CONTACT_US_STORE_NAME_ADDRESS== '1') { ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>

<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>

<br class="clearBoth" />
<div class="mainContent success"><?php echo LINKS_SUCCESS; ?></div>
<br class="clearBoth" />
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>


<?php
  } else {
?>

<?php if (DEFINE_LINKS_STATUS >= '1' and DEFINE_LINKS_STATUS <= '2') { ?>
<div id="pageThreeMainContent">
<?php
require($define_page);
?>
</div>
<?php } ?>

<?php if ($messageStack->size('submit_link') > 0) echo $messageStack->output('submit_link'); ?>


<fieldset>
<legend><?php echo NAVBAR_TITLE_2; ?></legend>
<div class="forward"><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_LINKS_HELP) . '\')">' . zen_image_button(BUTTON_IMAGE_LINK_HELP, BUTTON_LINK_HELP_ALT) . '</a><br /><br />'; ?></div>  
<br class="clearBoth" />
<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clearBoth" />
<fieldset>
<legend><?php echo CATEGORY_WEBSITE; ?></legend>

<label class="inputLabel" for="links_title"><?php echo ENTRY_LINKS_TITLE; ?></label>
<?php echo zen_draw_input_field('links_title', '', 'size="18" id="links_title"') . '&nbsp;' . (zen_not_null(ENTRY_LINKS_TITLE_TEXT) ? '<span class="alert">' . ENTRY_LINKS_TITLE_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
              
<label class="inputLabel" for="links_url"><?php echo ENTRY_LINKS_URL; ?></label>
<?php echo zen_draw_input_field('links_url', 'http://', 'size="18" id="links_url"') . '&nbsp;' . (zen_not_null(ENTRY_LINKS_URL_TEXT) ? '<span class="alert">' . ENTRY_LINKS_URL_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
              
<?php
  //link category drop-down list
  $categories_array = array();
  $categories_values = $db->Execute("select lcd.link_categories_id, lcd.link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " lcd where lcd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by lcd.link_categories_name");
 while (!$categories_values->EOF) {
    $categories_array[] = array('id' => $categories_values->fields['link_categories_name'], 'text' => $categories_values->fields['link_categories_name']);
$categories_values->MoveNext();
  }
  if (isset($_GET['lPath'])) {
    $current_categories_id = $_GET['lPath'];
    $categories = $db->Execute("select link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id ='" . (int)$current_categories_id . "' and language_id ='" . (int)$_SESSION['languages_id'] . "'");
    $default_category = $categories->fields['link_categories_name'];
    } else {
      $default_category = '';
    }
?>
             
<label class="inputLabel" for="links_category"><?php echo ENTRY_LINKS_CATEGORY; ?></label>
<?php echo zen_draw_pull_down_menu('links_category', $categories_array, $default_category) . '&nbsp;' . (zen_not_null(ENTRY_LINKS_CATEGORY_TEXT) ? '<span class="alert">' . ENTRY_LINKS_CATEGORY_TEXT . '</span>': '');?>
<br class="clearBoth" />
               
<label class="inputLabel" for="links_description"><?php echo ENTRY_LINKS_DESCRIPTION . '&nbsp;' . (zen_not_null(ENTRY_LINKS_DESCRIPTION_TEXT) ? '<span class="alert">' . ENTRY_LINKS_DESCRIPTION_TEXT . '</span>': ''); ?></label>
<?php echo zen_draw_textarea_field('links_description', '20', '5');?>
<br class="clearBoth" />
</fieldset>

<fieldset>
<legend><?php echo CATEGORY_CONTACT; ?></legend>

<label class="inputLabel" for="links_contact_name"><?php echo ENTRY_LINKS_CONTACT_NAME; ?></label>
<?php echo zen_draw_input_field('links_contact_name', $name, 'size="18" id="links_contact_name"') . '&nbsp;' . (zen_not_null(ENTRY_LINKS_CONTACT_NAME_TEXT) ? '<span class="alert">' . ENTRY_LINKS_CONTACT_NAME_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<label class="inputLabel" for="links_contact_email"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('links_contact_email', $email, 'size="18" id="links_contact_email"') . '&nbsp;' . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
               
</fieldset>
         
<?php if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') { ?>
<fieldset>
<legend><?php echo CATEGORY_RECIPROCAL; ?></legend>
<label class="inputLabel" for="links_reciprocal_url"><?php echo ENTRY_LINKS_RECIPROCAL_URL; ?></label>
<?php echo zen_draw_input_field('links_reciprocal_url', 'http://', 'size="18" id="links_reciprocal_url"') . '&nbsp;' . (zen_not_null(ENTRY_LINKS_RECIPROCAL_URL_TEXT) ? '<span class="alert">' . ENTRY_LINKS_RECIPROCAL_URL_TEXT . '</span>': ''); ?>
</fieldset>
<?php
  }
?>

<?php
// BOF Captcha
if(is_object($captcha)) {
?>
<fieldset>
<legend><?php echo TITLE_CAPTCHA; ?></legend>
<?php echo $captcha->img(); ?>
<?php echo $captcha->redraw_button(BUTTON_IMAGE_CAPTCHA_REDRAW, BUTTON_IMAGE_CAPTCHA_REDRAW_ALT); ?>
<br class="clearBoth" />
<label for="captcha"><?php echo TITLE_CAPTCHA; ?></label>
<?php echo $captcha->input_field('captcha', 'id="captcha"') . '&nbsp;<span class="alert">' . TEXT_CAPTCHA . '</span>'; ?>
<br class="clearBoth" />
</fieldset>
<?php
}
// EOF Captcha
?>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT_LINK, BUTTON_SUBMIT_LINK_ALT); ?></div>
</fieldset>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>
<?php
  }
?>
</form>
<br class="clearBoth" />
</div>
