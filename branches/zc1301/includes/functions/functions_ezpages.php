<?php
/**
 * ezpages functions - used to prepare content for EZ-Pages
 *
 * @package functions
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_ezpages.php 2844 2006-01-13 06:46:29Z drbyte $
 */


/**
 * look up page_id and create link for ez_pages
 * to use this link add '\<a href="' . zen_ez_pages_link($pages_id) . '">\</a>';
 */
// to use this link add '<a href="' . zen_ez_pages_link($pages_id) . '"></a>';
  function zen_ez_pages_link($ez_pages_id, $ez_pages_chapter = 0, $ez_pages_is_ssl = false, $ez_pages_open_new_window = false) {
    global $db;
    $ez_link = 'unknown';
    if ($ez_pages_chapter == 0) {
      $ez_page_query = $db->Execute("select * from " . TABLE_EZPAGES . " where pages_id='" . $ez_pages_id . "' limit 1");
      $ez_link = zen_href_link(FILENAME_EZPAGES, 'id=' . $ez_page_query->fields['pages_id'] . ($ez_page_query->fields['toc_chapter'] !=0 ? '&chapter=' . $ez_page_query->fields['toc_chapter'] : ''), ($ez_page_query->fields['page_is_ssl']=='0' ? 'NONSSL' : 'SSL'));
      $ez_link .= ($ez_page_query->fields['page_open_new_window'] == '1' ? '" target="_blank"' : '');
    } else {
      $ez_link = zen_href_link(FILENAME_EZPAGES, 'id=' . $ez_pages_id . ($ez_pages_chapter != 0 ? '&chapter=' . $ez_pages_chapter : ''), ($ez_pages_is_ssl=='0' ? 'NONSSL' : 'SSL')) . ">" . $ez_page_query->fields['pages_title'] . '</a>';
    }
//    echo 'I SEE ' . '<a href=' . $ez_link . '>' . $ez_page_query->fields['pages_title'] . '</a>' . '<br>';
    return $ez_link;
  }

?>