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

<div class="centerColumn" id="instantSearchResultDefault">

    <h1 id="searchResultsDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

    <?php if ($do_filter_list || PRODUCT_LIST_ALPHA_SORTER === 'true') { ?>
        <div id="filter-wrapper" class="group instantSearchResults__sorterRow" style="display:none">
        <?php
            echo zen_draw_form('filter', zen_href_link(FILENAME_INSTANT_SEARCH_RESULT), 'get') . '<label class="inputLabel">' . TEXT_SHOW . '</label>';
            echo zen_post_all_get_params(['currency', 'alpha_filter_id']);
            require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING_ALPHA_SORTER));
            echo '</form>'; ?>
        </div>
    <?php } ?>

    <div id="productListing" class="group">
    </div>

    <div class="buttonRow back">
        <?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
    </div>

</div>
