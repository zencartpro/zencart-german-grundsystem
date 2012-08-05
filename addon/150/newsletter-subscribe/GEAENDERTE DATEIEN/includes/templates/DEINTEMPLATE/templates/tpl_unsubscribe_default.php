<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_unsubscribe_default.php for Newsletter Subscribe 2.3 2012-08-03 10:55:22Z webchills $
 * modified for newsletter_subscribe 20070120 sparrish
 */
?>
<div class="centerColumn" id="unsubDefault">

<?php if (!isset($_GET['action']) || ($_GET['action'] != 'unsubscribe')) { ?>

<h1 id="unsubDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php
// BEGIN newsletter subscribe mod 1/1
 $addr = empty($_REQUEST['addr']) ? '' : $_REQUEST['addr'];
 if (($definedpage) && file_exists($definedpage)) { require($definedpage); }
 else { echo ($unsubscribe_address=='') ? UNSUBSCRIBE_TEXT_NO_ADDRESS_GIVEN : UNSUBSCRIBE_TEXT_INFORMATION; }
?>
<div class="buttonRow forward">
<?php
  $content = '';
  $content .= zen_draw_form(FILENAME_UNSUBSCRIBE, zen_href_link(FILENAME_UNSUBSCRIBE, '', 'SSL'), 'get', '');
  $content .= zen_draw_hidden_field('action', 'unsubscribe');
  $content .= zen_draw_hidden_field('main_page',FILENAME_UNSUBSCRIBE);
  $content .= zen_draw_input_field('addr', $addr, 'style="width:20em;"');
  $content .= '&nbsp;'.zen_image_submit(BUTTON_IMAGE_UNSUBSCRIBE, BUTTON_UNSUBSCRIBE).'&nbsp;&nbsp;';
  echo $content;
?>
  </form>
</div>
<?php // END newsletter subscribe mod 1/1 ?>

<?php } elseif (isset($_GET['action']) && ($_GET['action'] == 'unsubscribe')) { ?>
<h1 id="unsubDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php echo $status_display; ?>

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE_SHOPPING, BUTTON_CONTINUE_SHOPPING_ALT) . '</a>'; ?></div>

<?php } else {
        zen_redirect(FILENAME_DEFAULT,'','NONSSL');
   }
?>
</div>