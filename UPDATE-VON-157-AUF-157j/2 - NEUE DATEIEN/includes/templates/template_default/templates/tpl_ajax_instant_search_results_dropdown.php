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

$nameModelClass = '';
if (INSTANT_SEARCH_DROPDOWN_HIGHLIGHT_TEXT === 'query') {
    $nameModelClass = ' instantSearchResultsDropdownContainer__resultWrapper__infoWrapper__nameModelWrapper--highlightQuery';
} elseif (INSTANT_SEARCH_DROPDOWN_HIGHLIGHT_TEXT === 'autocomplete') {
    $nameModelClass = ' instantSearchResultsDropdownContainer__resultWrapper__infoWrapper__nameModelWrapper--highlightAutocomplete';
} ?>

<?php if (!empty($dropdownResults)) { ?>
    <ul role="listbox">
        <?php foreach ($dropdownResults as $result) { ?>
            <?php if (!empty($result['separator'])) { ?>
                </ul>
                <div class="instantSearchResultsDropdownContainer__separator">
                    <?php echo $result['separator']; ?>
                </div>
                <ul role="listbox">
            <?php } else { ?>
                <li role="option" tabindex="-1">
                    <a href="<?php echo $result['link']; ?>" class="instantSearchResultsDropdownContainer__link">
                        <div class="instantSearchResultsDropdownContainer__resultWrapper">
                            <?php if (!empty($result['img'])) { ?>
                                <div class="instantSearchResultsDropdownContainer__resultWrapper__img">
                                    <?php echo $result['img']; ?>
                                </div>
                            <?php } ?>
                            <div class="instantSearchResultsDropdownContainer__resultWrapper__infoWrapper">
                                <div class="instantSearchResultsDropdownContainer__resultWrapper__infoWrapper__nameModelWrapper<?php echo $nameModelClass; ?>">
                                    <?php echo $result['name']; ?>
                                    <?php if (!empty($result['model'])) { ?>
                                        <div class="instantSearchResultsDropdownContainer__resultWrapper__infoWrapper__nameModelWrapper__model">
                                            <?php echo $result['model']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="instantSearchResultsDropdownContainer__resultWrapper__infoWrapper__priceCountWrapper">
                                    <?php if (!empty($result['price'])) {
                                        echo $result['price'];
                                    } elseif (!empty($result['count'])) { ?>
                                        <div class="instantSearchResultsDropdownContainer__resultWrapper__infoWrapper__priceCountWrapper__count">
                                            <?php echo $result['count'] . ' ' . TEXT_INSTANT_SEARCH_PRODUCTS_TEXT; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
<?php } ?>
