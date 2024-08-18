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

namespace Zencart\Plugins\Catalog\InstantSearch\SearchEngineProviders;

interface SearchEngineProviderInterface
{
    /**
     * Searches for $queryText and returns the results.
     *
     * @param string $queryText
     * @param array $productFieldsList
     * @param int $productsLimit
     * @param int $categoriesLimit
     * @param int $manufacturersLimit
     * @param int|null $alphaFilter
     * @return array
     */
    public function search(
        string $queryText,
        array $productFieldsList,
        int $productsLimit,
        int $categoriesLimit = 0,
        int $manufacturersLimit = 0,
        int $alphaFilter = null
    ): array;
}
