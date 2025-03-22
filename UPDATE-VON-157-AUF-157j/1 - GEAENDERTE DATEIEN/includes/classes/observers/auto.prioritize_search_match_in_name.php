<?php
/**
 * @package Search: Prioritize Matching Names
 * @copyright Copyright 2015-2024 Vinos de Frutas Tropicales (lat9)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: auto.prioritize_search_match_in_name.php 2024-10-16 16:05:51Z webchills $
 */

class zcObserverPrioritizeSearchMatchInName extends base
{
    protected string $order_by;

    public function __construct()
    {
        $this->attach(
            $this,
            [
                'NOTIFY_SEARCH_SELECT_STRING',
                'NOTIFY_SEARCH_REAL_ORDERBY_STRING',
            ]
        );
    }

    public function update(&$class, $eventID, $p1, &$p2, &$p3)
    {
        switch ($eventID) {
            // -----
            // From class.search.php
            //
            // $p1 ... (r/o) The current $select_str
            // $p2 ... (r/w) The current $select_str
            //
            case 'NOTIFY_SEARCH_SELECT_STRING':
                $keywords = $_GET['keyword'] ?? '';
                if (empty($keywords)) {
                    return;
                }

                $in_name_select = zen_build_keyword_where_clause(['pd.products_name'], $keywords);
                $in_name_select = substr($in_name_select, 5);   //- Remove unwanted ' AND (' lead-in
                 if ($in_name_select !== '') {
                    $p2 .= ", IF ($in_name_select, 1, 0) AS in_name ";
                    $this->order_by = 'in_name DESC, ';
                }
                break;

            // -----
            // From class.search.php
            //
            // $p1 ... (r/o) The current $order_str
            // $p2 ... (r/w) The current $order_str
            //
            case 'NOTIFY_SEARCH_REAL_ORDERBY_STRING':
                if (isset($this->order_by)) {
                    $p2 = str_ireplace('order by', 'ORDER BY ' . $this->order_by, $p2);
                }
                break;

            default:
                break;
        }
    }
}
