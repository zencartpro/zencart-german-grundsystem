<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=adress_book.
 * Allows customer to manage entries in their address book
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_address_book_default.php 2023-10-26 16:17:16Z webchills $
 */
?>
<div class="centerColumn" id="addressBookDefault">

<h1 id="addressBookDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
 
<?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?> 
      
<h2 id="addressBookDefaultPrimary"><?php echo PRIMARY_ADDRESS_TITLE; ?></h2>
<address class="back"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br>'); ?></address>
<div class="instructions"><?php echo PRIMARY_ADDRESS_DESCRIPTION; ?></div>
<br class="clearBoth">

<fieldset>
<legend><?php echo ADDRESS_BOOK_TITLE; ?></legend>
<div class="alert forward"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></div>
<br class="clearBoth">
<?php
/**
 * Used to loop thru and display address book entries
 */
  foreach ($addressArray as $addresses) {
?>
<h3 class="addressBookDefaultName"><?php echo zen_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?><?php if ($addresses['address_book_id'] == $_SESSION['customer_default_address_id']) echo '&nbsp;' . PRIMARY_ADDRESS ; ?></h3>

<address><?php echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br>'); ?></address>

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a> <a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_DELETE_SMALL, BUTTON_DELETE_SMALL_ALT) . '</a>'; ?></div>
<br class="clearBoth">
<?php
  }
?>
</fieldset>

<?php
  if (count($addressArray) < MAX_ADDRESS_BOOK_ENTRIES) {
?>
   <div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_ADD_ADDRESS, BUTTON_ADD_ADDRESS_ALT) . '</a>'; ?></div>
<?php
  }
?>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<br class="clearBoth">
</div>
