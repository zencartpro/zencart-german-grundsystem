<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2012-2014 Vinos de Frutas Tropicales (lat9)            |
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
// $Id: display_log_files.php 2014-01-20 lat9, Copyright 2014, Vinos de Frutas Tropicales  $
//
  define('MAX_LOG_FILES_TO_VIEW', 20);
  if (!defined('MAX_LOG_FILE_READ_SIZE')) define('MAX_LOG_FILE_READ_SIZE', 80000);  /*v1.0.3a*/

// -----
// Functions that gather the log-related files and provide the ascending/descending sort thereof.
//  
  function sortLogA($a, $b) {
    if ($a['mtime'] == $b['mtime']) return 0;
    return ($a['mtime'] < $b['mtime']) ? -1 : 1;
  }
  function sortLogD($a, $b) {
    if ($a['mtime'] == $b['mtime']) return 0;
    return ($a['mtime'] > $b['mtime']) ? -1 : 1;
  }
  
  function getLogFiles() {
    $logFiles = array();
    foreach(array(DIR_FS_LOGS, DIR_FS_SQL_CACHE, DIR_FS_CATALOG . '/includes/modules/payment/paypal/logs') as $logFolder) {
      $logFolder = rtrim($logFolder, '/');                          /*v1.0.1c-lat9*/
      $dir = @dir($logFolder);                                      /*v1.0.1c-lat9*/
      if ($dir != NULL) {                                           /*v1.0.1a-lat9*/
        while ($file = $dir->read()) {
          if ( ($file != '.') && ($file != '..') && substr($file, 0, 1) != '.') {
            if (preg_match('/^(myDEBUG-|AIM_Debug_|SIM_Debug_|FirstData_Debug_|Linkpoint_Debug_|Paypal|paypal|ipn_|zcInstall|notifier|usps|SHIP_usps).*\.log$/', $file)) {  /*v1.0.5c-lat9*/
              $hash = sha1 ($logFolder . '/' . $file);
              $logFiles[$hash] = array ( 'name'  => $logFolder . '/' . $file,
                                         'mtime' => filemtime($logFolder . '/' . $file),
                                         'filesize' => filesize($logFolder . '/' . $file) /*v1.0.2-design75*/
                                       );
            }
          }
        }
        
        $dir->close();  /*v1.0.3m-lat9*/
        unset($dir);  /*v1.0.3m-lat9*/
      }                                                             /*v1.0.1a-lat9*/
    }
 
    uasort($logFiles, (isset($_GET) && isset($_GET['sort']) && $_GET['sort'] == 'a') ? 'sortLogA' : 'sortLogD');
    reset($logFiles);
    
    return $logFiles;
  }

// -----
// Start main processing ...
//  
  require('includes/application_top.php');
  
  $logFiles = getLogFiles();

// -----
// If any file delete requests have been made, process them first.
//
  $action = (isset($_GET['action'])) ? $_GET['action'] : '';  
  if (zen_not_null($action) && $action == 'delete') {
    if (isset($_POST) && isset($_POST['dList']) && sizeof($_POST['dList']) != 0) {
      $numFiles = sizeof($_POST['dList']);
      $filesDeleted = 0;
      foreach ($_POST['dList'] as $currentHash => $value) {
        if (array_key_exists($currentHash, $logFiles)) {
          if (is_writeable($logFiles[$currentHash]['name'])) {
            zen_remove($logFiles[$currentHash]['name']);
            $filesDeleted++;
          }
        }
      }
      if ($filesDeleted == $numFiles) {
        $messageStack->add_session(sprintf(SUCCESS_FILES_DELETED, $numFiles), 'success');  //-v1.0.4c
      } else {
        $messageStack->add_session(sprintf(WARNING_SOME_FILES_DELETED, $filesDeleted, $numFiles), 'warning');  //-v1.0.4c
      }
    } else {
      $messageStack->add_session(WARNING_NO_FILES_SELECTED, 'warning');  //-v1.0.4c
    }

    zen_redirect(zen_href_link(FILENAME_DISPLAY_LOGS));  //-v1.0.4c
 
  }
    
  if (isset($_GET) && isset($_GET['fID'])){
    if (array_key_exists($_GET['fID'], $logFiles)) {
      $getFile = $_GET['fID'];
      
    } else {
      unset($_GET['fID']);
      $getFile = key($logFiles);
    }
    
  } elseif (sizeof($logFiles) != 0) {
    $getFile = key($logFiles);
    
  } else {
    $getFile = '';
  }
  
  $numLogFiles = sizeof($logFiles);
//-bof-v1.0.3a-lat9
  // -----
  // If more files are in the log-file array than will be displayed, free up the memory associated with
  // those files' entries by popping them off the end of the array.
  //
  if ($numLogFiles > MAX_LOG_FILES_TO_VIEW) {
    for ($i = 0, $n = $numLogFiles - MAX_LOG_FILES_TO_VIEW; $i < $n; $i++) {
      array_pop($logFiles);
    }
  }
//-eof-v1.0.3a-lat9
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<style type="text/css">
<!--
#theButtons { padding-top: 10px; margin-top: 10px; border-top: 1px solid black; }
#dButtons, #dSpace { width: 50%; }
#dAll { float: right; padding-right: 20px; }
#dSel { float: right; }
#fContents { overflow: auto; max-height: <?php echo 23 * MAX_LOG_FILES_TO_VIEW; ?>px; }
#contentsOuter { vertical-align: top; }
.bigfile { font-weight: bold; color: red; }
-->
</style>
<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
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
  
  function buttonCheck(whichButton) {
    var submitOK = false;
    var elements = document.getElementsByClassName('cBox');
    var n = elements.length;
    if (whichButton == 'all') {
      submitOK = confirm('<?php echo JS_MESSAGE_DELETE_ALL_CONFIRM; ?>');
      if (submitOK) {
        for (var i = 0; i < n; i++) {
          elements[i].checked = true;
        }
      }
    } else {
      var selected = 0;
      for (var i = 0; i < n; i++) {
        if (elements[i].checked) selected++;
      }
      if (selected > 0) {
        submitOK = confirm('<?php echo JS_MESSAGE_DELETE_SELECTED_CONFIRM; ?>');
      } else {
        alert('<?php echo WARNING_NO_FILES_SELECTED; ?>');
      }
    }
    return submitOK;
  }
  // -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

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

          <tr>
            <td class="main"><?php echo ((substr(HTTP_SERVER, 0, 5) != 'https') ? WARNING_NOT_SECURE : '') . sprintf(TEXT_INSTRUCTIONS, MAX_LOG_FILE_READ_SIZE, ((isset($_GET) && isset($_GET['sort']) && $_GET['sort'] == 'a') ? TEXT_OLDEST : TEXT_MOST_RECENT), (($numLogFiles > MAX_LOG_FILES_TO_VIEW) ? MAX_LOG_FILES_TO_VIEW : $numLogFiles), $numLogFiles); //-v1.0.6c ?></td>
            <td class="main" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>

        </table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>    
    <td>
      <form id="dlFormID" name="dlForm" action="<?php echo zen_href_link(FILENAME_DISPLAY_LOGS, 'action=delete', 'NONSSL'); ?>" method="post"><?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']) . "\n"; ?>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" width="50%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_FILENAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_DISPLAY_LOGS, 'sort=' . ((isset($_GET) && isset($_GET['sort']) && $_GET['sort'] == 'a') ? 'd' : 'a') . '&amp;' . zen_get_all_get_params(array('sort')), 'NONSSL'); ?>"><?php echo TABLE_HEADING_MODIFIED; ?></a></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_FILESIZE; ?></td><!--v1.0.2-design75-->
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DELETE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  reset ($logFiles);
  $fileData = '';
//-bof-v1.0.3c-lat9
  $heading = array();
  $contents = array();
//  $filesDisplayed = 0;
//-eof-v1.0.3c
  foreach ($logFiles as $curHash => $curFile) {
?>
              <tr>
                <td class="dataTableContent" align="left"><?php echo $curFile['name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo date (PHP_DATE_TIME_FORMAT, $curFile['mtime']); ?></td>
                <td class="dataTableContent<?php echo ($curFile['filesize'] > MAX_LOG_FILE_READ_SIZE) ? ' bigfile' : ''; /*v1.0.3a-lat9*/ ?>" align="right"><?php echo $curFile['filesize']; ?></td><!--v1.0.2-design75-->
                <td class="dataTableContent" align="center"><?php echo zen_draw_checkbox_field('dList[' . $curHash . ']', false, false, '', 'class="cBox"'); ?></td>
                <td class="dataTableContent" align="right"><?php if ($getFile == $curHash) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_DISPLAY_LOGS, 'fID=' . $curHash . '&amp;' . zen_get_all_get_params(array('fID'))) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', ICON_INFO_VIEW) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    if ($getFile == $curHash) {
//-bof-v1.0.3c-lat9
      $heading[] = array('text' => '<strong>' . TEXT_HEADING_INFO . '( ' . $curFile['name'] . ')</strong>');
      $contents[] = array('align' => 'left', 'text' => '<div id="fContents">' . nl2br(htmlentities(trim(@file_get_contents($curFile['name'], NULL, NULL, -1, MAX_LOG_FILE_READ_SIZE)), ENT_COMPAT+ENT_IGNORE, CHARSET, false)) . '</div>');  //-v1.0.4c

    }
/*  
    $filesDisplayed++;
    if ($filesDisplayed >= MAX_LOG_FILES_TO_VIEW) {
      break; // End foreach loop prematurely
    }
*/
//-eof-v1.0.3c-lat9
  }
?>
            </table></td>
<?php
  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
?>
            <td id="contentsOuter" width="50%">
<?php
    $box = new box;
    echo $box->infoBox($heading, $contents);
?>
            </td>
<?php
  }
?>           
          </tr>
        </table></td>
      </tr>
<?php
  if ($numLogFiles > 0) {
?>
      <tr>
        <td id="theButtons">
          <div id="dButtons">
            <div id="dSel"><?php echo zen_image_submit(BUTTON_DELETE_SELECTED, DELETE_SELECTED_ALT, 'name="dButton" value="delete" onclick="return buttonCheck(\'delete\');"'); /*v1.0.6c*/ ?></div>
            <div id="dAll"><?php echo zen_image_submit(BUTTON_DELETE_ALL, DELETE_ALL_ALT, 'name="sButton" value="all" onclick="return buttonCheck(\'all\');"'); /*v1.0.6c*/ ?></div>
          </div>
          <div id="dSpace">&nbsp;</div>
        </td>
      </tr>
<?php
  }
?>
    </table></form></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>