<?php
/*
  $Id$

  Yatego Export for Zen-Cart
  by www.pocketbit.net 05/2007. All rights reserved
  converted from OSC to ZenCart by 
    JeffClay 
    Hugo13 (http://edv.langheiter.com/zencart/ )

*/
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


if ($_GET_['action'] == 'anlegen') {
    if (!isset($_POST['delete_products'])) {
        $_POST['delete_products'] = '0';
    }

    $query = $db->Execute("update yategooptions SET outputdir='" . $_POST['outputdir'] . "', language_id= '" . $_POST['language_id'] . "', deleteproducts = '" . $_POST['delete_products'] . "', footer='" . zen_db_prepare_input($_POST['products_footer']) . "'");

    $msg = "Die Einstellungen wurden gespeichert";
}
$smarty->assign('$yatego_options_msg', $msg);
$smarty->assign('yatego_options_form', zen_draw_form('yatego_anlegen', 'yatego_options.php', '&action=anlegen', 'post', 'enctype="multipart/form-data"'));
$smarty->assign('yatego_options_input_1', zen_draw_input_field('language_id', $options[language_id]));
$smarty->assign('yatego_options_input_2', zen_draw_input_field('outputdir', $options[outputdir]));
$smarty->assign('yatego_options_input_3', zen_draw_checkbox_field('delete_products', '1', $options[deleteproducts]));
$smarty->assign('yatego_options_input_3', zen_draw_checkbox_field('delete_products', '1', $options[deleteproducts]));


$smarty->assign('yatego_cat_btnsave', str_replace('includes/languages', '../includes/languages', zen_image_submit('button_save.gif', IMAGE_INSERT)));
$hv = zen_get_category_tree();     

$smarty->assign('cat', $hv);
$smarty -> display('yatego_options.tpl.html');

/**
 * footer stuff
 */
require(DIR_WS_INCLUDES . 'footer.php');
