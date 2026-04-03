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

declare(strict_types=1);

namespace Zencart\Plugins\Admin\InstantSearch;

class InstantSearchConfigurationValidation extends \base
{
    /**
     * Array of allowed product fields.
     *
     * @var array
     */
    protected const VALID_PRODUCT_FIELDS_DROPDOWN = [
        'category',
        'manufacturer',
        'meta-keywords',
        'model-broad',
        'model-exact',
        'name',
        'name-description',
    ];

    /**
     * Performs a series of checks on the product fields list to validate it.
     *
     * @param string $productFieldsList
     * @return bool
     */
    public static function validateFieldsList(string $productFieldsList): bool
    {
        // Check that the string is in the correct format
        if (preg_match('/^[a-z][a-z,-]*[a-z-]$/', $productFieldsList) !== 1) {
            return false;
        }

        $productFields = explode(',', $productFieldsList);

        // Check that there are no duplicates
        if (count(array_unique($productFields)) < count($productFields)) {
            return false;
        }

        // Check that there is only one value between name and name-description in the list
        if (in_array('name', $productFields, true) && in_array('name-description', $productFields, true)) {
            return false;
        }

        foreach ($productFields as $productField) {
            // Check that $searchField is a valid field name
            if (!in_array($productField, self::VALID_PRODUCT_FIELDS_DROPDOWN, true)) {
                return false;
            }
        }

        return true;
    }
}
