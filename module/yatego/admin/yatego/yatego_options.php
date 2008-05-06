<?php
/*
  $Id: yatego_main.php,

  Yatego Export for OSC
  by www.pocketbit.net 05/2007. All rights reserved

*/

require('includes/application_top.php');

if ($_GET_['action'] == 'anlegen') {
    if (!isset($_POST['delete_products'])) {
        $_POST['delete_products'] = '0';
    }

    $query = $db->Execute("update yategooptions SET outputdir='" . $_POST['outputdir'] . "', language_id= '" . $_POST['language_id'] . "', deleteproducts = '" . $_POST['delete_products'] . "', footer='" . zen_db_prepare_input($_POST['products_footer']) . "'");

    $msg = "Die Einstellungen wurden gespeichert";
}
// <!--$query = tep_db_query("select outputdir, language_id, deleteproducts, footer from yategooptions");//-->
// <!--$options = tep_db_fetch_array($query);//-->

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
    <?php echo zen_draw_form('yatego_anlegen', 'yatego_options.php', '&action=anlegen', 'post', 'enctype="multipart/form-data"');
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">Einstellungen</td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
            <?php
if (strlen($msg) > 5)
    echo "<tr><td  colspan=\"2\" class=\"main\" style=\"font-weight:bold;padding:10px;border:1px solid #0C7E02;\">$msg<br/></td></tr>";

?>
<tr>
     <td class="main" colspan="2">
     <br/>Sie k&ouml;nnen hier Einstellungen vornehmen.</td>
		  </td>
        </tr>
        <tr>
          <td class="main">Language-ID (Sprache)</td>
		  <td class="main" colspan="1" >
		  <?php echo zen_draw_input_field('language_id', $options[language_id]);
?>
		  </td>
		  <td class="main" colspan="1" ></td>
        </tr>
        <tr>
          <td class="main">Ausgabepfad (relativ zum Administrationsverzeichnis) </td>
		  <td class="main" colspan="1" >
		  <?php echo zen_draw_input_field('outputdir', $options[outputdir]);
?>
		  </td>
		  <td class="main" colspan="1" ></td>
        </tr>

        <tr>
          <td class="main">L&ouml;schmarkierung f&uuml;r Produkte</td>
		  <td class="main" colspan="1" ><?php echo zen_draw_checkbox_field('delete_products', '1', $options[deleteproducts]);
?>
		  </td>
		  <td class="main" colspan="1" ></td>
        </tr>
        <tr>
          <td class="main">Fusstext Produkte</td>
		  <td class="main" colspan="1" >
		    <?php
echo zen_draw_textarea_field('products_footer', '', '60', '10', $options[footer], '');

?>
		  </td>
		  <td class="main" colspan="1" ></td>
        </tr>
   <tr>
     <td class="main"><br/><?php
echo '&nbsp;&nbsp;'
 . zen_image_submit('button_save.gif', IMAGE_INSERT);

?><br/><br></td>
		  <td class="main" colspan="2">
		  </td>
        </tr>

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
