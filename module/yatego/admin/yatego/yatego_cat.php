<?php
/*
  $Id$

  Yatego Export for Zen-Cart
  by www.pocketbit.net 05/2007. All rights reserved
  converted from OSC to ZenCart by 
    JeffClay 
    Hugo13 (http://edv.langheiter.com/zencart/ )

*/
error_reporting(E_ALL);
chdir('../');
require('includes/application_top.php');

/**
 * init smarty environment
 */
$smarty = setSmarty ();

/**
 * header stuff
 */
$smarty->assign('path', '../');
$smarty -> display('header.tpl.html');
require(DIR_WS_INCLUDES . 'header.php');



function zen_get_category_tree_html($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false) {
    global $db;
    // global $languages_id;
    if (!is_array($category_tree_array)) $category_tree_array = array();
    if ((sizeof($category_tree_array) < 1) && ($exclude != '0')) $category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
        $category = $db->Execute("select cd.categories_name from categories_description cd where cd.language_id = '" . $languages_id . "' and cd.categories_id = '" . $parent_id . "'");
        $category_tree_array[] = array('id' => $parent_id, 'text' => $category['categories_name']);
    }

    $categories_query = "select c.categories_id, cd.categories_name, c.parent_id from categories c, categories_description cd where c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' and c.parent_id = '" . $parent_id . "' order by c.sort_order, cd.categories_name";
    while ($categories = $db->Execute($categories_query)) {
        if ($exclude != $categories->fields['categories_id']) {
            $category_tree_array[] = array('id' => $categories->fields['categories_id'],
                'text' => $spacing . $categories->fields['categories_name'],
                );
        }
        $category_tree_array = zen_get_category_tree($categories->fields['categories_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $category_tree_array);
        $categories->MoveNext();
    }
    return $category_tree_array;
}

function zen_get_yatego_nummer($cID) {
    global $db;
    // global $languages_id;
    $yatego = $db->Execute("select yategocategories_id from categories_to_yatego where categories_id= '" . $cID . "'");
    return $yatego->fields['yategocategories_id'];
}

function zen_get_yatego_categories_id($artikelnr) {
    global $db;
    // global $languages_id;
    $yatego = $db->Execute("select categories_id from products_to_categories where products_id= '" . $artikelnr . "'");
    return zen_get_yatego_nummer($yatego['categories_id']);
}

if ($_GET['action'] == 'anlegen') {
    for ($i = 0; $i < sizeof($_POST['yatego_id']);$i++) {
        if ($_POST['fill'][$_POST['yatego_id'][$i]] == '1') {
            $db->Execute("update categories_to_yatego SET yategocategories_id = '" . $_POST['categories_yatego_id'][$i] . "' where categories_id = '" . $_POST['yatego_id'][$i] . "'");
        } else if (strlen($_POST['categories_yatego_id'][$i]) > 0) {
            $db->Execute("INSERT INTO categories_to_yatego (yategocategories_id, categories_id) VALUES ('" . $_POST['categories_yatego_id'][$i] . "','" . $_POST['yatego_id'][$i] . "')");
        }
    }
}


$smarty->assign('msg', $msg);
$smarty->assign('yatego_cat_form', zen_draw_form('yatego_anlegen', 'yatego/yatego_cat.php', '&action=anlegen', 'post', 'enctype="multipart/form-data"'));
$smarty->assign('yatego_cat_btnsave', str_replace('includes/languages', '../includes/languages', zen_image_submit('button_save.gif', IMAGE_INSERT)));
$hv = zen_get_category_tree();     
foreach ($hv as $key => $value) {
    $hv[$key]['r'] = zen_get_yatego_nummer($value['id']);
    if($hv[$key]['r'] == null){
        $hv[$key]['h'] = 0;
    } else {
        $hv[$key]['h'] = 1;
    }
}

$smarty->assign('cat', $hv);
$smarty -> display('yatego_cat.tpl.html');

/**
 * footer stuff
 */
require(DIR_WS_INCLUDES . 'footer.php');
