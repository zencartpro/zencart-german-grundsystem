<?php
/**
 * tpl_modules_checkout_address_book.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_modules_checkout_address_book.php 2011-08-09 15:49:16Z hugo13 $
 */
?>
<?php
/**
 * require code to get address book details
 */
  require(DIR_WS_MODULES . zen_get_module_directory('checkout_address_book.php'));
?>

<?php
      while (!$addresses->EOF) {
        if ($addresses->fields['address_book_id'] == $_SESSION['sendto']) {
          echo '      <div id="defaultSelected" class="moduleRowSelected">' . "\n";
        } else {
          echo '      <div class="moduleRow">' . "\n";
        }
?>
        <div class="back"><?php echo zen_draw_radio_field('address', $addresses->fields['address_book_id'], ($addresses->fields['address_book_id'] == $_SESSION['sendto']), 'id="name-' . $addresses->fields['address_book_id'] . '"'); ?></div>
        <div class="back"><label for="name-<?php echo $addresses->fields['address_book_id']; ?>"><?php echo zen_output_string_protected($addresses->fields['firstname'] . ' ' . $addresses->fields['lastname']); ?></label></div>
      </div>
      <br class="clearBoth" />
       <address><?php echo zen_address_format(zen_get_address_format_id($addresses->fields['country_id']), $addresses->fields, true, ' ', '<br />'); ?></address>

<?php
        $addresses->MoveNext();
      }
?>