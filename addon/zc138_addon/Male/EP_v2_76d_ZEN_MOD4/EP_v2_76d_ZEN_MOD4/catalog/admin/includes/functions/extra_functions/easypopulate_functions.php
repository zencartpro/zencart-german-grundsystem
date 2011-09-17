<?php
function zen_get_uploaded_file($filename) {
	if (isset($_FILES[$filename])) {
		$uploaded_file = array('name' => $_FILES[$filename]['name'],
		'type' => $_FILES[$filename]['type'],
		'size' => $_FILES[$filename]['size'],
		'tmp_name' => $_FILES[$filename]['tmp_name']);
	} elseif (isset($GLOBALS['HTTP_POST_FILES'][$filename])) {
		global $HTTP_POST_FILES;

		$uploaded_file = array('name' => $HTTP_POST_FILES[$filename]['name'],
		'type' => $HTTP_POST_FILES[$filename]['type'],
		'size' => $HTTP_POST_FILES[$filename]['size'],
		'tmp_name' => $HTTP_POST_FILES[$filename]['tmp_name']);
	} else {
		$uploaded_file = array('name' => $GLOBALS[$filename . '_name'],
		'type' => $GLOBALS[$filename . '_type'],
		'size' => $GLOBALS[$filename . '_size'],
		'tmp_name' => $GLOBALS[$filename]);
	}

return $uploaded_file;
}

// the $filename parameter is an array with the following elements:
// name, type, size, tmp_name
function zen_copy_uploaded_file($filename, $target) {
	if (substr($target, -1) != '/') $target .= '/';

	$target .= $filename['name'];

	move_uploaded_file($filename['tmp_name'], $target);
}

////
// Recursively go through the categories and retreive all sub-categories IDs
// TABLES: categories
if (!function_exists(zen_get_sub_categories)) {
  function zen_get_sub_categories(&$categories, $categories_id) {
    $sub_categories_query = mysql_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$categories_id . "'");
    while ($sub_categories = mysql_fetch_array($sub_categories_query)) {
      if ($sub_categories['categories_id'] == 0) return true;
      $categories[sizeof($categories)] = $sub_categories['categories_id'];
      if ($sub_categories['categories_id'] != $categories_id) {
        zen_get_sub_categories($categories, $sub_categories['categories_id']);
      }
    }
  }
}
?>
