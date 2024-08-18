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

namespace Zencart\Plugins\Catalog\InstantSearch;

use Zencart\Plugins\Catalog\InstantSearch\Exceptions\InstantSearchEngineSearchException;
use Zencart\Plugins\Catalog\InstantSearch\SearchEngineProviders\SearchEngineProviderInterface;

abstract class InstantSearch extends \base
{
    /**
     * The search engine provider.
     *
     * @var SearchEngineProviderInterface
     */
    protected SearchEngineProviderInterface $searchEngineProvider;

    /**
     * Factory method that returns the Search engine provider.
     *
     * @return SearchEngineProviderInterface
     */
    abstract public function getSearchEngineProvider(): SearchEngineProviderInterface;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->searchEngineProvider = $this->getSearchEngineProvider();
    }

    /**
     * Search for $queryText with the chosen Search Engine Provider and return the results.
     *
     * @param string $queryText
     * @param array $productFieldsList
     * @param int $productsLimit
     * @param int $categoriesLimit
     * @param int $manufacturersLimit
     * @param int|null $alphaFilter
     * @param bool $addToSearchLog
     * @param string $searchLogPrefix
     * @return array
     * @throws InstantSearchEngineSearchException
     */
    public function runSearch(
        string $queryText,
        array $productFieldsList,
        int $productsLimit,
        int $categoriesLimit = 0,
        int $manufacturersLimit = 0,
        int $alphaFilter = null,
        bool $addToSearchLog = false,
        string $searchLogPrefix = ''
    ): array {
        try {
            $results = $this->searchEngineProvider->search(
                $queryText,
                $productFieldsList,
                $productsLimit,
                $categoriesLimit,
                $manufacturersLimit,
                $alphaFilter
            );

            if ($addToSearchLog === true) {
                $this->addEntryToSearchLog($queryText, $searchLogPrefix, count($results));
            }
            return $results;
        } catch (\Exception $e) {
            if ($addToSearchLog === true) {
                $this->addEntryToSearchLog($queryText, $searchLogPrefix, null);
            }
            throw new InstantSearchEngineSearchException("Error while searching for \"$queryText\"", 0, $e);
        }
    }

    /**
     * Adds the searched terms to the search log table (if the table exists, i.e.
     * if the Search Log plugin is installed).
     *
     * @param string $query
     * @param string $prefix
     * @param int|null $resultsCount
     * @return void
     */
    protected function addEntryToSearchLog(string $query, string $prefix, ?int $resultsCount): void
    {
        global $db;

        $searchLogTableName = DB_PREFIX . 'search_log';

        $sql = "
            SELECT TABLE_NAME
              FROM information_schema.TABLES
             WHERE (TABLE_SCHEMA = :table_schema)
               AND (TABLE_NAME = :table_name)
        ";

        $sql = $db->bindVars($sql, ':table_schema', DB_DATABASE, 'string');
        $sql = $db->bindVars($sql, ':table_name', $searchLogTableName, 'string');
        $check = $db->Execute($sql);

        if ($check->RecordCount() > 0) {
            $sql = "
                INSERT INTO :table_name (search_term, search_time, search_results)
                VALUES (:search_term, NOW(), :results_count)
            ";
            $sql = $db->bindVars($sql, ':table_name', $searchLogTableName, 'noquotestring');
            $sql = $db->bindVars($sql, ':search_term', $prefix . ' ' . $query, 'string');
            $sql = $db->bindVars($sql, ':results_count', $resultsCount, 'integer');
            $db->Execute($sql);
        }
    }

    /**
     * @param SearchEngineProviderInterface $searchEngineProvider
     */
    public function setSearchEngineProvider(SearchEngineProviderInterface $searchEngineProvider): void
    {
        $this->searchEngineProvider = $searchEngineProvider;
    }
}
