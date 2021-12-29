<?php
/**
 * @package Search: Prioritize Matching Names
 * @copyright Copyright 2015-2019 Vinos de Frutas Tropicales (lat9)
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: auto.prioritize_search_match_in_name.php 1 2019-07-22 08:13:51Z webchills $
 */

class zcObserverPrioritizeSearchMatchInName extends base {
  public function __construct() {
    $this->order_by = '';
    $this->attach ($this, array ('NOTIFY_SEARCH_SELECT_STRING', 'NOTIFY_SEARCH_ORDERBY_STRING'));
    
  }

  public function update (&$class, $eventID) {
    switch ($eventID) {
      case 'NOTIFY_SEARCH_SELECT_STRING': {
        global $db, $keywords, $select_str;
        if (isset ($keywords) && zen_not_null ($keywords) && zen_parse_search_string (stripslashes ($_GET['keyword']), $search_keywords)) {
          $in_name_select = '';
          foreach ($search_keywords as $current_keyword) {
            switch ($current_keyword) {
              case '(':
              case ')':
              case 'and':
              case 'or': {
                $in_name_select .= " $current_keyword ";
                break;
                
              }
              default: {
                $in_name_select .= "pd.products_name LIKE '%:keywords%'";
                $in_name_select = $db->bindVars ($in_name_select, ':keywords', $current_keyword, 'noquotestring');
                break;
              }
            }
          }
          $select_str .= ", IF ($in_name_select, 1, 0) AS in_name ";
          $this->order_by = ' in_name DESC,';
          
        }        
        break;
      }
      case 'NOTIFY_SEARCH_ORDERBY_STRING': {
        global $listing_sql;
        $listing_sql = str_ireplace ('order by', 'order by' . $this->order_by, $listing_sql);
        break;
      }
      default: {
        break;
      }
    }
  }
}