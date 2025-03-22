<?php
/**
 * @package  Instant Search Plugin for Zen Cart German
 * @author   marco-pm
 * @version  4.0.3
 * @see      https://github.com/marco-pm/zencart_instantsearch
 * @license  GNU Public License V2.0
 * modified for Zen Cart German
 * 2024-04-05 webchills
 */
?>

<?php if ($show_top_submit_button) { // only show when there is something to submit and enabled ?>
    <div class="prod-list-wrap group">
        <div class="forward button-top">
            <?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit1" name="submit1"'); ?>
        </div>
    </div>
<?php } // show top submit ?>

<?php if (in_array($product_listing_layout_style, ['columns', 'fluid'])) {
    require($template->get_template_dir('tpl_columnar_display.php', DIR_WS_TEMPLATE, $current_page_base, 'common') . '/tpl_columnar_display.php');
} else {
    require($template->get_template_dir('tpl_tabular_display.php', DIR_WS_TEMPLATE, $current_page_base, 'common') . '/tpl_tabular_display.php');
} ?>

<?php if ($show_bottom_submit_button) { // only show when there is something to submit and enabled ?>
    <div class="prod-list-wrap group">
        <div class="forward button-top">
            <?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit2" name="submit2"'); ?>
        </div>
    </div>
<?php } // show_bottom_submit_button ?>

<?php if ($how_many > 0 && PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 && $show_submit && $listing_split->number_of_rows > 0) {
    echo '</form>';
} ?>
