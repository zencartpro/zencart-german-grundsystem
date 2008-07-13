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
//  $Id: usertracking 2004-12-1 dave@open-operations.com http://open-operations.com
$gID = 999;
  require('includes/application_top.php');

  if ($HTTP_GET_VARS['action']) {
    switch ($HTTP_GET_VARS['action']) {
      case 'save':
        $configuration_value = zen_db_prepare_input($HTTP_POST_VARS['configuration_value']);
        $cID = zen_db_prepare_input($HTTP_GET_VARS['cID']);

        zen_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . zen_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . zen_db_input($cID) . "'");
        zen_redirect(zen_href_link(FILENAME_CONFIGURATION, 'gID=999&cID=' . $cID));
        break;
    }
  }

  $cfg_group = $db->Execute("select configuration_group_title from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = '999'");
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $configuration = $db->Execute("select configuration_id, configuration_title, configuration_value, use_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '999' order by sort_order");
   while (!$configuration->EOF) {
    if (zen_not_null($configuration->fields['use_function'])) {
      $use_function = $configuration->fields['use_function'];
      if (ereg('->', $use_function)) {
        $class_method = explode('->', $use_function);
        if (!is_object(${$class_method[0]})) {
          include(DIR_WS_CLASSES . $class_method[0] . '.php');
          ${$class_method[0]} = new $class_method[0]();
        }
        $cfgValue = zen_call_function($class_method[1], $configuration->fields['configuration_value'], ${$class_method[0]});
      } else {
        $cfgValue = zen_call_function($use_function, $configuration->fields['configuration_value']);
      }
    } else {
      $cfgValue = $configuration->fields['configuration_value'];
    }

    if (((!$HTTP_GET_VARS['cID']) || (@$HTTP_GET_VARS['cID'] == $configuration->fields['configuration_id'])) && (!$cInfo) && (substr($HTTP_GET_VARS['action'], 0, 3) != 'new')) {
          $cfg_extra = $db->Execute("select configuration_key, configuration_description, date_added, last_modified, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_id = '" . (int)$configuration->fields['configuration_id'] . "'");

          $cInfo_array = array_merge($configuration->fields, $cfg_extra->fields);
          $cInfo = new objectInfo($cInfo_array);
        }

    if ( (is_object($cInfo)) && ($configuration->fields['configuration_id'] == $cInfo->configuration_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . zen_href_link(FILENAME_CONFIGURATION, 'gID=999&cID=' . $cInfo->configuration_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . zen_href_link(FILENAME_CONFIGURATION, 'gID=999&cID=' . $configuration->fields['configuration_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $configuration->fields['configuration_title']; ?></td>
                <td class="dataTableContent"><?php echo htmlspecialchars($cfgValue); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($configuration->fields['configuration_id'] == $cInfo->configuration_id) ) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_CONFIGURATION, 'gID=999&cID=' . $configuration->fields['configuration_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
 $configuration->MoveNext();


  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($HTTP_GET_VARS['action']) {
    case 'edit':
      $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

      if ($cInfo->set_function) {
        eval('$value_field = ' . $cInfo->set_function . '"' . htmlspecialchars($cInfo->configuration_value) . '");');
      } else {
        $value_field = zen_draw_input_field('configuration_value', $cInfo->configuration_value);
      }

      $contents = array('form' => zen_draw_form('configuration', FILENAME_CONFIGURATION, 'gID=999&cID=' . $cInfo->configuration_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->configuration_title . '</b><br>' . $cInfo->configuration_description . '<br>' . $value_field);
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . zen_href_link(FILENAME_CONFIGURATION, 'gID=999&cID=' . $cInfo->configuration_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_CONFIGURATION, 'gID=999&cID=' . $cInfo->configuration_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');
        $contents[] = array('text' => '<br>' . $cInfo->configuration_description);
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . zen_date_short($cInfo->date_added));
        if (zen_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . zen_date_short($cInfo->last_modified));
      }
      break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>