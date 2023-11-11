<?php
/**
 * Memoization cache for MySQL SELECT queries
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Created by Data-Diggers.com http://www.data-diggers.com/
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: query_cache.php 2023-10-25 20:11:16Z webchills $
 */

/**
 * QueryCache memoization cache for SELECT queries
 */
class QueryCache
{
    protected $queries = [];

    /**
     * Cache SELECT statement query resources in application memory
     * returns TRUE if and only if query has been stored in cache
     * @param string $query query string, used as a key
     * @param mysqli_result $valueToStore result from mysqli_query
     * @return bool
     */
    public function cache(string $query, $valueToStore)
    {
        if ($this->isSelectStatement($query) === true) {
            $this->queries[$query] = $valueToStore;
        } else {
            return false;
        }
        return true;
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function getFromCache(string $query)
    {
        $ret = $this->queries[$query];
        mysqli_data_seek($ret, 0);
        return ($ret);
    }

    /**
     * @param string $query used as a cache key
     * @return bool
     */
    public function inCache(string $query)
    {
        return (isset($this->queries[$query]));
    }

    /**
     * ensure the query is a SELECT query
     * @param string $q
     * @return bool
     */
    protected function isSelectStatement(string $q)
    {
        return 0 === stripos($q, "SELECT");
    }

    /**
     * Remove query from cache. Pass ALL to reset entire cache
     * @param string $query
     * @return bool
     */
    public function reset(string $query)
    {
        if ('ALL' == $query) {
            $this->queries = [];
            return false;
        }
        unset ($this->queries[$query]);
    }
}
