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

use Zencart\Plugins\Catalog\InstantSearch\SearchEngineProviders\SearchEngineProviderInterface;
use Zencart\Plugins\Catalog\InstantSearch\SearchEngineProviders\MysqlSearchEngineProvider;

class MysqlInstantSearch extends InstantSearch
{
    /**
     * Use Query Expansion in the Full-Text searches.
     *
     * @var bool
     */
    protected bool $useQueryExpansion;

    /**
     * Constructor.
     *
     * @param $useQueryExpansion
     */
    public function __construct($useQueryExpansion)
    {
        $this->useQueryExpansion = $useQueryExpansion;

        parent::__construct();
    }

    /**
     * Factory method that returns the MySQL Search engine provider.
     *
     * @return SearchEngineProviderInterface
     */
    public function getSearchEngineProvider(): SearchEngineProviderInterface
    {
        return new MysqlSearchEngineProvider($this->useQueryExpansion);
    }
}
