<?php
/**
 * @package Admin Profiles
 * @copyright Copyright 2006-2010 Kuroi Web Design
 * @copyright Portions Copyright 2003 Zen Cart Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_control.php 362 2010-05-23 19:02:04Z kuroi $
 */

require('includes/application_top.php');

$adminID = zen_db_prepare_input($_GET['adminID']);

if ($_GET['action'] == 'save'){ // if changes to adminID's profile are being saved

  // This section updates the dB as menu headers are turned on and off for this adminID
  $headers = $db->Execute("SELECT * FROM ".TABLE_ADMIN_MENU_HEADERS);
  while (!$headers->EOF){
    $field = $_POST[$headers->fields['header']];
    $sql = "SELECT * FROM ".TABLE_ADMIN_VISIBLE_HEADERS." WHERE header_id = ".$headers->fields['id']." AND admin_id = '".$adminID."'";
    $althere = $db->Execute($sql);
    if ($field == 'on' || $field == 'off'){
      if ($althere->fields['header_id'] == '') {
        $sql = "INSERT INTO ".TABLE_ADMIN_VISIBLE_HEADERS." SET header_id = ".$headers->fields['id'].", admin_id = :adminId:";
        $sql = $db->bindVars($sql, ':adminId:', $adminID, 'integer');
        $db->Execute($sql);
      }
    } else {
      if ($althere->fields['header_id'] != '') {
        $sql = "DELETE FROM ".TABLE_ADMIN_VISIBLE_HEADERS." WHERE header_id = ".$headers->fields['id']." AND admin_id = '".$adminID."'";
        $db->Execute($sql);
      }
    }
    $headers->MoveNext();
  }

  // This section updates the dB for those pages who are being allowed or disallowed for adminID
  $pages = $db->Execute("SELECT * FROM ".TABLE_ADMIN_FILES);
  while (!$pages->EOF){
    $field = '';
    $field = $_POST[str_replace(' ', '_', $pages->fields['page'])];
    $sql = "SELECT * FROM ".TABLE_ADMIN_ALLOWED." WHERE page_id = ".$pages->fields['id']." AND admin_id = ".$adminID;
    $althere = $db->Execute($sql);
    if ($field == 'on' || $field == 'off') {
      if ($althere->fields['page_id'] == '') {
        $sql = "INSERT INTO ".TABLE_ADMIN_ALLOWED." SET page_id = ".$pages->fields['id'].", admin_id = :adminId:";
        $sql = $db->bindVars($sql, ':adminId:', $adminID, 'integer');
        $db->Execute($sql);
      }
    } else {
      if ($althere->fields['page_id'] != '') {
        $sql = "DELETE FROM ".TABLE_ADMIN_ALLOWED." WHERE page_id = '".$pages->fields['id']."' AND admin_id = '".$adminID."'";
        $db->Execute($sql);
      }
    }
  $pages->MoveNext();
  }

  // reload page to display showing the revised user profile
  zen_redirect(zen_href_link(FILENAME_ADMIN_CONTROL, 'adminID='.$adminID, 'SSL'));

} else {

 // read user name to display in Admin Profiles header
  $admin = $db->Execute("SELECT admin_name FROM " . TABLE_ADMIN . " WHERE admin_id = " . $adminID);

  // read in list of all valid menu headers from dB ex. 3rd party mods and display headers and checkboxes for their pages
  $headers_defined = $db->Execute("SELECT * FROM " . TABLE_ADMIN_MENU_HEADERS . " WHERE id > 0 order by id");

  // read in name of header for 3rd party mods and display checkboxes for any relevant pages
  $headers_undefined = $db->Execute("SELECT * FROM " . TABLE_ADMIN_MENU_HEADERS . " WHERE id = 0");

// Display page allowing updates to user profiles
?><!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/admin_profiles.css">
<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript">
<!--
function init(){
  cssjsmenu('navbar');
  if (document.getElementById){
    var kill = document.getElementById('hoverJS');
    kill.disabled = true;
  }
}

function checkAll(form,header,value){
  for (var i = 0; i < form.elements.length; i++){
      if (form.elements[i].className == header){
      form.elements[i].checked = value;
    }
  }
}
// -->
</script>
</head>
<body onLoad="init()">
<?php
require(DIR_WS_INCLUDES . 'header.php');

?>

<div id="profileHeader">
  <div id="profileName"><?php echo sprintf(HEADING_TITLE, $admin->fields['admin_name']) ?></div>
  <div id="profileFunctions"><a href="<?php echo zen_href_link(FILENAME_ADMIN)?>"><?php echo TEXT_UPDATE_MORE_USERS ?></a></div>
</div>
<?php echo zen_draw_form('profileBoxes', FILENAME_ADMIN_CONTROL, 'adminID=' . $adminID . '&amp;action=save', 'post', 'id="profileBoxes"', 'true'); ?>
<div class="formButtons"><input type="submit" value="<?php echo BUTTON_TEXT_SAVE ?>"><input type="reset" value="<?php echo BUTTON_TEXT_CANCEL ?>"></div>

<?php
  display_profiles($headers_defined, $adminID);
  display_profiles($headers_undefined, $adminID);
?>

<p id="subPage"><?php echo TEXT_SUBPAGE_EXPLANATION ?></p>
<div class="formButtons"><input type="submit" value="<?php echo BUTTON_TEXT_SAVE ?>"><input type="reset" value="<?php echo BUTTON_TEXT_CANCEL ?>"></div>
</form>
</body>
</html>
<?php } ?>