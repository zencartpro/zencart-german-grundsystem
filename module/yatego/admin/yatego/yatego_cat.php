<?php
/*
  $Id: yatego_main.php,

  Yatego Export for OSC
  by www.pocketbit.net 05/2007. All rights reserved

*/
chdir('../');
require('includes/application_top.php');

#rldp($_POST, 'POST');
/**
 * init smarty environment
 */
$smarty = setSmarty ();

/**
 * header stuff
 */
$smarty->assign('path', '../');
$smarty -> display('header.tpl.html');

function zen_get_category_tree_html($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false) {
    global $db;
    // global $languages_id;
    if (!is_array($category_tree_array)) $category_tree_array = array();
    if ((sizeof($category_tree_array) < 1) && ($exclude != '0')) $category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
        $category = $db->Execute("select cd.categories_name from categories_description cd where cd.language_id = '" . $languages_id . "' and cd.categories_id = '" . $parent_id . "'");
        // <!--$category = tep_db_fetch_array($category_query);//
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
    // $yatego    = tep_db_fetch_array($sql_query);
    return $yatego->fields['yategocategories_id'];
}

function zen_get_yatego_categories_id($artikelnr) {
    global $db;
    // global $languages_id;
    $yatego = $db->Execute("select categories_id from products_to_categories where products_id= '" . $artikelnr . "'");
    // $yatego    = tep_db_fetch_array($sql_query);
    return zen_get_yatego_nummer($yatego['categories_id']);
}

if ($_GET['action'] == 'anlegen') {
    for ($i = 0; $i < sizeof($_POST['yatego_id']);$i++) {
        if ($_POST['fill'][$_POST['yatego_id'][$i]] == '1') {
            $db->Execute("update categories_to_yatego SET yategocategories_id = '" . $_POST['categories_yatego_id'][$i] . "' where categories_id = '" . $_POST['yatego_id'][$i] . "'");
        } else if (!isset($_POST['fill'][$_POST['yatego_id'][$i]]) && strlen($_POST['categories_yatego_id'][$i]) > 0) {
            $db->Execute("INSERT INTO categories_to_yatego (yategocategories_id, categories_id) VALUES ('" . $_POST['categories_yatego_id'][$i] . "','" . $_POST['yatego_id'][$i] . "')");
        }
    }
}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS;
?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;
?>">
<title><?php echo TITLE;
?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH;
?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH;
?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->

<!-- left_navigation_eof //-->
        </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
    <?php echo zen_draw_form('yatego_anlegen', 'yatego/yatego_cat.php', '&action=anlegen', 'post', 'enctype="multipart/form-data"');
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">Zuordnung Yatego-Kategorien</td>
            <td class="pageHeading" align="right"><?php #echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">

<tr>
     <td class="main" colspan="2"><br/>Nehmen Sie hier die Zuordnung ihrer Shopkategorien zu den Yategokategorien vor. <br/>Sie k&ouml;nnen auch mehrere Yategokategorien w&auml;hlen. Diese sind dann durch Komma zu trennen. <br/>Klicken Sie auf <b>sichern</b>, wenn Sie die Zuordnung vorgenommen haben. <br/><br/>Die aktuelle Liste der Nummer f&uuml;r die Yategokategorien erhalten Sie auf der Yatego.</td>
		  </td>
        </tr>
  <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">Shopkategorie</td>
                <td class="dataTableHeadingContent">Yategokategorie</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;</td>
              </tr>
   <tr>
     <td class="main" style="width:40%;background:#00FF00"><br/><?php
echo '&nbsp;&nbsp;' . str_replace('includes/languages', '../includes/languages', zen_image_submit('button_save.gif', IMAGE_INSERT));

?><br/><br></td>
		  <td class="main" colspan="2">
		  </td>
        </tr>



<?php
#$hv = zen_get_category_tree_html();
$hv = zen_get_category_tree();
for ($i = 0, $n = sizeof($hv); $i < $n; $i++) {
    // shopkategoirie auslesen
    ?>
        <tr>
          <td class="main"><?php echo $hv[$i]['text'];
    ?></td>
		  <td class="main" colspan="1" >
		    <?php
    echo zen_draw_hidden_field('yatego_id[]', $hv[$i]['id']);
    $r = zen_get_yatego_nummer($hv[$i]['id']);
    if (isset($r))
        echo zen_draw_hidden_field('fill[' . $hv[$i]['id'] . ']', '1');
    echo zen_draw_input_field('categories_yatego_id[]', $r);

    ?>
		  </td>
		  <td class="main" colspan="1" ></td>
        </tr>
<?php
}

?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
 <?php echo '</form>';
?>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
