<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: functions_general.php 277 2004-09-10 23:03:52Z wilt $
//

function zen_get_sources($sources_id = '') {
	global $db;
	$sources_array = array();
	if (zen_not_null($sources_id)) {
		$sources = "select sources_name
                    from " . TABLE_SOURCES . "
                    where sources_id = '" . (int)$sources_id . "'";
		// $sources_values = $db->Execute($sources);
		//$sources_array = array('sources_name' => $sources_values->fields['sources_name']);
	} else {
		$sources = "select sources_id, sources_name
                  from " . TABLE_SOURCES . "
                  order by sources_name";

		//$sources_array = array('sources_name' => $sources_values->fields['sources_name']);

	}
	$sources_values = $db->Execute($sources);
	while (!$sources_values->EOF) {
		$sources_array[] = array('sources_id' => $sources_values->fields['sources_id'],
		'sources_name' => $sources_values->fields['sources_name']);
		$sources_values->MoveNext();
	}

	return $sources_array;
}

////rmh referral
// Creates a pull-down list of sources
function zen_get_source_list($name, $show_other = false, $selected = 'PULL_DOWN_SOURCES', $parameters = '') {
	$sources_array = array(array('id' => '', 'text' => PULL_DOWN_SOURCES));
	$sources = zen_get_sources();

	foreach ($sources as $source) {
		$sources_array[] = array('id' => $source['sources_id'], 'text' => $source['sources_name']);
	}

	if ($show_other == 'true') {
		$sources_array[] = array('id' => '9999', 'text' => PULL_DOWN_OTHER);
	}

	return zen_draw_pull_down_menu($name, $sources_array, $selected, $parameters);
}
?>