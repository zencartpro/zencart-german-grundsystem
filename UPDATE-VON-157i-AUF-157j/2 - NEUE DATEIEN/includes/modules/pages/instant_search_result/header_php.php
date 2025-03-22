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

$zco_notifier->notify('NOTIFY_HEADER_START_INSTANT_SEARCH_RESULTS_PAGE');

if (!defined('INSTANT_SEARCH_PAGE_ENABLED') || INSTANT_SEARCH_PAGE_ENABLED === 'false') {
    zen_redirect(zen_href_link(FILENAME_DEFAULT));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

require(zen_get_index_filters_directory('default_filter.php'));

$breadcrumb->add(NAVBAR_TITLE);
if (!empty($_GET['keyword'])) {
    $breadcrumb->add(zen_output_string_protected($_GET['keyword']));
}

$zco_notifier->notify('NOTIFY_HEADER_END_INSTANT_SEARCH_RESULTS_PAGE');