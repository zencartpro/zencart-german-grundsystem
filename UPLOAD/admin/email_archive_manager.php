<?php
/*
//////////////////////////////////////////////////////////
//  EMAIL ARCHIVE SEARCH                                //
//  Version 1.5                                         //
//                                                      //
//  By Frank Koehl  (PM: BlindSide)                     //
//  Support by DrByte                                   //
//  Delete button by That Software Guy                  //
//                                                      //
//  Powered by Zen Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2010 The Zen Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $isForDisplay = (($_GET['print_format'] < 1) ? true : false);
  if ($action == 'prev_text' || $action == 'prev_html') {
    //$isForDisplay = false;
  }
  if ($action == 'resend') {
    // collect the e-mail data
    $email_sql = $db->Execute("select * from " . TABLE_EMAIL_ARCHIVE . " where archive_id = " . $_GET['archive_id']);
    $email = new objectInfo($email_sql->fields);
    // resend the message
    // we use 'cc_middle_digs' as the module because that is not archived (don't want to achive the same message twice)
    zen_mail($email->email_to_name, $email->email_to_address, $email->email_subject, $email->email_text, $email->email_from_name, $email->email_from_address, $email->email_html, 'cc_middle_digs');
    $messageStack->add_session(sprintf(SUCCESS_EMAIL_RESENT, $email->archive_id, $email->email_to_address), 'success');
    zen_redirect(zen_href_link(FILENAME_EMAIL_HISTORY));
  }
  if ($action == 'delete') {
      $db->Execute("delete from " . TABLE_EMAIL_ARCHIVE . "
                                  where archive_id = '" . (int)$_GET['archive_id'] . "'");
      zen_redirect(zen_href_link(FILENAME_EMAIL_HISTORY));
  }
  if ($action == 'trim_confirm') {
    $age = $_GET['email_age'];
    if ($age == '1_months') {
      $cutoff_date = '1 MONTH';
    }
    if ($age == '6_months') {
      $cutoff_date = '6 MONTH';
    }
    elseif ($age == '1_year') {
      $cutoff_date = '12 MONTH';
    }
    $db->Execute("DELETE FROM " . TABLE_EMAIL_ARCHIVE . " WHERE
                  date_sent <= DATE_SUB(NOW(), INTERVAL " . $cutoff_date . ")");
    $db->Execute("OPTIMIZE TABLE " . TABLE_EMAIL_ARCHIVE);
    $messageStack->add_session(sprintf(SUCCESS_TRIM_ARCHIVE, $cutoff_date), 'success');
    zen_redirect(zen_href_link(FILENAME_EMAIL_HISTORY, '', 'NONSSL'));
  }
  $email_module = $db->Execute("SELECT DISTINCT module
                                FROM " . TABLE_EMAIL_ARCHIVE . "
                                ORDER BY module ASC");
  $email_module_array[] = array('id' => 1,
                                'text' => TEXT_ALL_MODULES);
  while (!$email_module->EOF) {
    $email_module_array[] = array('id' => $email_module->fields['module'],
                                  'text' => $email_module->fields['module']);
    $email_module->MoveNext();
  }
  $search_sd = ((isset($_GET['start_date']) && zen_not_null($_GET['start_date'])) ? true : false);
  $search_ed = ((isset($_GET['end_date']) && zen_not_null($_GET['end_date'])) ? true : false);
  $search_text = ((isset($_GET['text']) && zen_not_null($_GET['text'])) ? true : false);
  $search_module = ((isset($_GET['module']) && zen_not_null($_GET['module']) && $_GET['module'] != 1) ? true : false);
  $sd_raw = zen_date_raw($_GET['start_date']);
  $ed_raw = zen_date_raw($_GET['end_date']);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<?php if ($isForDisplay) { ?>
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
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
  function del_confirmation() {
    var answer = confirm('<?php echo POPUP_CONFIRM_DELETE; ?>')
    if (answer) {
      window.location = "<?php echo zen_href_link(FILENAME_EMAIL_HISTORY, zen_get_all_get_params(array('action')) . 'action=delete'); ?>";
    }
  }

  function confirmation() {
    var answer = confirm('<?php echo POPUP_CONFIRM_RESEND; ?>')
    if (answer) {
      window.location = "<?php echo zen_href_link(FILENAME_EMAIL_HISTORY, zen_get_all_get_params(array('action')) . 'action=resend'); ?>";
    }
  }
// -->
</script>
<style type="text/css">
<!--
.warningBox{
background-color:#FF9999;
}
.warningText{
font-size:10px;
font-weight:bold;
border-color:#FF0000;
border-style:solid;
border-width:3px;
}
-->
</style>
<?php } ?>
</head>
<?php if ($action == 'prev_text' || $action == 'prev_html') { ?>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<?php }
      if ($isForDisplay) { ?>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<script language="javascript">
<!--
var StartDate = new ctlSpiffyCalendarBox("StartDate", "search", "start_date", "btnDate1","<?php echo (($_GET['start_date'] == '') ? '' : $_GET['start_date']); ?>",scBTNMODE_CUSTOMBLUE);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "search", "end_date", "btnDate2","<?php echo (($_GET['end_date'] == '') ? '' : $_GET['end_date']); ?>",scBTNMODE_CUSTOMBLUE);
-->
</script>
<?php } ?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<?php
    switch ($action) {

      case 'delete_confirm':
      case 'resend_confirm':
      case 'prev_text':
      case 'prev_html':
      $this_email = $db->Execute("select * from " . TABLE_EMAIL_ARCHIVE . "
                                  where archive_id = '" . $_GET['archive_id'] . "'");

      if ($action=='prev_html') {
        $html_content = $this_email->fields['email_html'];
        $html_content = str_replace('__','><',$html_content);
        $html_content = str_replace('_html','<html',$html_content);
        $html_content = str_replace('_base','<base',$html_content);
        $html_content = str_replace('_table_','<table>',$html_content);
        $html_content = str_replace('_table ','<table ',$html_content);
        $html_content = str_replace('_/table','</table',$html_content);
        $html_content = str_replace(array('_tr_','_tr>'),'<tr>',$html_content);
        $html_content = str_replace(array('_/tr_','_/tr>'),'</tr>',$html_content);
        $html_content = str_replace(array('_td_','<td_'),'<td>',$html_content);
        $html_content = str_replace('_td ','<td ',$html_content);
        $html_content = str_replace(array('_/td_','_/td>','</td_'),'</td>',$html_content);
        $html_content = str_replace('"_','">',$html_content);
        $html_content = str_replace('_ ','> ',$html_content);
        $html_content = str_replace('_li>','<li>',$html_content);
        $html_content = str_replace('_div ','<div ',$html_content);
        $html_content = str_replace('_/div_','</div>',$html_content);
        $html_content = str_replace('_/div','</div',$html_content);
        $html_content = str_replace('_strong_','<strong>',$html_content);
        $html_content = str_replace('_/strong_','</strong>',$html_content);
        $html_content = str_replace('strong_','strong>',$html_content);
        $html_content = str_replace('_/strong','</strong',$html_content);
        $html_content = str_replace('_!','<!',$html_content);
        $html_content = str_replace(array('_br_','_br /_','_br />'),'<br />',$html_content);
        $html_content = str_replace('_/style','</style',$html_content);
        $html_content = str_replace('em_','em>',$html_content);
        $html_content = str_replace('_/em','</em',$html_content);
        $html_content = str_replace('_img ','<img ',$html_content);
        $html_content = str_replace('_a href','<a href',$html_content);
        $html_content = str_replace(array('_/a_','_/a>'),'</a>',$html_content);

        $html_content = str_replace(array('<html>','</html>','</html_'),'',$html_content);
        $html_content = str_replace(array('<head>','</head>'),'',$html_content);
        $html_content = str_replace(array('<body>','</body>'),'',$html_content);
        $html_content = str_replace('&quot;_','">',$html_content);
        $html_content = str_replace('_nobr','<nobr',$html_content);
        $html_content = str_replace(';nbsp;','&nbsp;',$html_content);
        $html_content = str_replace('&amp;','&',$html_content);
        $html_content = str_replace('&amp&','&&',$html_content);
        $html_content = str_replace('&&nbsp;','&nbsp;',$html_content);
        $html_content = str_replace('&quot;','"',$html_content);
      }
?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" align="left"><?php echo '<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY) . '">' . '</a>' . zen_image(DIR_WS_IMAGES . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT); ?></td>
            <td class="pageHeading" align="right"><?php echo TEXT_EMAIL_NUMBER . $this_email->fields['archive_id']; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TEXT_EMAIL_TO; ?></b></td>
            <td class="main"><?php echo $this_email->fields['email_to_name'] . ' [' . $this_email->fields['email_to_address'] . ']'; ?></td>
          </tr>
          <tr>
            <td class="main"><b><?php echo TEXT_EMAIL_FROM; ?></b></td>
            <td class="main"><?php echo $this_email->fields['email_from_name'] . ' [' . $this_email->fields['email_from_address'] . ']'; ?></td>
          </tr>
          <tr>
            <td class="main"><b><?php echo TEXT_EMAIL_DATE_SENT; ?></b></td>
            <td class="main"><?php echo zen_datetime_short($this_email->fields['date_sent']); ?></td>
          </tr>
          <tr>
            <td class="main"><b><?php echo TEXT_EMAIL_SUBJECT; ?></b></td>
            <td class="main"><?php echo $this_email->fields['email_subject']; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo zen_draw_separator(); ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
      </tr>
      <tr>
        <td><table border="1" cellspacing="0" cellpadding="10">
          <tr>
            <td class="main" colspan="2"><?php
              if ($action == 'prev_html') {
                echo $html_content;
              }
              else {
                echo nl2br($this_email->fields['email_text']);
              }
            ?></td>
          </tr>
        </table></td>
      </tr>
<?php
      break;

      case 'trim':
?>
      <tr>
        <td class="pageHeading" align="left"><?php echo TEXT_TRIM_ARCHIVE; ?></td>
        <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
      </tr>
      <tr>
        <td class="main" align="left"><?php echo HEADING_TRIM_INSTRUCT; ?></td>
      </tr>
      <?php echo zen_draw_form('trim_timeframe', FILENAME_EMAIL_HISTORY, '', 'get'); ?>
      <?php echo zen_draw_hidden_field('action', 'trim_confirm'); ?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo zen_draw_radio_field('email_age', '1_months', true) . RADIO_1_MONTH . ' (' . date("m/d/Y", mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"))) . ')'; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo zen_draw_radio_field('email_age', '6_months') . RADIO_6_MONTHS . ' (' . date("m/d/Y", mktime(0, 0, 0, date("m") - 6, date("d"), date("Y"))) . ')'; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo zen_draw_radio_field('email_age', '1_year') . RADIO_1_YEAR . ' (' . date("m/d/Y", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 1)) . ')'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="5">
          <tr class="warningBox">
            <td class="warningText" align="middle" colspan="2">
              <?php echo TRIM_CONFIRM_WARNING; ?>
              <p><input type="submit" value="<?php echo BUTTON_TRIM_CONFIRM; ?>">
              <input type="button" value="<?php echo BUTTON_CANCEL; ?>" onClick="<?php echo 'window.location.href=\'' . zen_href_link(FILENAME_EMAIL_HISTORY) . '\''; ?>">
            </td>
          </tr>
        </table></td>
      </tr></form>
<?php
      break;

      default:
?>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
    <?php if (!$isForDisplay) { ?>
      <tr>
        <td><?php echo '<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY, 'action=' . $action) . '"><span class="pageHeading">' .  HEADING_TITLE . '</span></a>'; ?></td>
        <td class="pageHeading" align="right"><?php echo date('l M d, Y', time()); ?></td>
      </tr>
      <tr>
        <td class="pageHeading"><?php echo $this_report; ?><br>&nbsp;</td>
      </tr>
    <?php } else { ?>
      <tr>
        <td class="pageHeading" align="left"><?php echo HEADING_TITLE; ?></td>
        <td class="pageHeading" align="right"><?php echo
        zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
      </tr>
      <tr>
        <td class="main" align="left"><?php echo HEADING_SEARCH_INSTRUCT; ?></td>
        <td align="right"><?php echo '<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY, 'action=trim') . '">' . TEXT_TRIM_ARCHIVE . '</a>'; ?></td>
      </tr>
      <tr>
        <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <?php echo zen_draw_form('search', FILENAME_EMAIL_HISTORY, '', 'get'); ?>
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="left">
                  <?php echo HEADING_START_DATE . '<br>'; ?>
                  <script language="javascript">StartDate.writeControl(); StartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="left">
                  <?php echo HEADING_END_DATE . '<br>'; ?>
                  <script language="javascript">EndDate.writeControl(); EndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
                </td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" valign="top"><?php
                  echo HEADING_SEARCH_TEXT . '<br>';
                  echo zen_draw_input_field('text');
                  if (isset($_GET['text']) && zen_not_null($_GET['text'])) {
                    $keywords = zen_db_input(zen_db_prepare_input($_GET['text']));
                    echo '<br>' . HEADING_SEARCH_TEXT_FILTER . $keywords;
                  }
                ?></td>
              </tr>
              <tr>
                <td class="smallText" valign="top"><?php
                  echo HEADING_MODULE_SELECT . '<br>';
                  echo zen_draw_pull_down_menu('module', $email_module_array, $_GET['module']);
                ?></td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText"><?php echo zen_draw_checkbox_field('print_format', 1) . HEADING_PRINT_FORMAT; ?></td>
              </tr>
              <tr>
                <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
              </tr>
              <tr>
                <td class="main" valign="bottom"><input type="submit" value="<?php echo BUTTON_SEARCH; ?>"></td>
              </tr>
            </table></td>
          </tr></form>
        </table></td>
      </tr>
    <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_EMAIL_DATE; ?></td>
            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMERS_NAME; ?></td>
            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMERS_EMAIL; ?></td>
            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_EMAIL_SUBJECT; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_EMAIL_FORMAT; ?></td>
          </tr>
<?php
  // build search query

  $archive_search = "select * from " . TABLE_EMAIL_ARCHIVE . " ";
  if ($search_sd || $search_ed || $search_text || $search_module) {
    $archive_search .= " where ";
  }

  if ($search_sd) $archive_search .= "date_sent >= '" . $sd_raw . "' ";

  if ($search_ed) {
    if ($search_sd) $archive_search .= "and ";
    $archive_search .= "date_sent <= DATE_ADD('" . $ed_raw . "', INTERVAL 1 DAY) ";
  }

  if ($search_text) {
    if ($search_sd || $search_ed) $archive_search .= "and ";

    $keywords = zen_db_input(zen_db_prepare_input($_GET['text']));
    $archive_search .= "(email_to_address like '%" . $keywords . "%' or email_subject like '%" . $keywords . "%' or email_html like '%" . $keywords . "%' or email_text like '%" . $keywords . "%' or email_to_name like '%" . $keywords . "%') ";
  }

  if ($search_module) {
    if ($search_sd || $search_ed || $search_text) {
      $archive_search .= "and ";
    }
    $archive_search .= "module = '" . $_GET['module'] . "' ";
  }

  $archive_search .= "order by archive_id desc";

  $email_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $archive_search, $email_query_numrows);

  // DEBUG
  //echo '<br>' . $archive_search . '<br>';
  $email_archive = $db->Execute($archive_search);

  while (!$email_archive->EOF) {

    if ((!isset($_GET['archive_id']) || (isset($_GET['archive_id']) && ($_GET['archive_id'] == $email_archive->fields['archive_id']))) && !isset($archive)) {
        $archive = new objectInfo($email_archive->fields);
      }

      if (isset($archive) && is_object($archive) && ($email_archive->fields['archive_id'] == $archive->archive_id) && $isForDisplay) {
        echo '          <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_EMAIL_HISTORY, zen_get_all_get_params(array('archive_id', 'action')) . 'archive_id=' . $archive->archive_id . '&action=view', 'NONSSL') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_EMAIL_HISTORY, zen_get_all_get_params(array('archive_id')) . 'archive_id=' . $email_archive->fields['archive_id'], 'NONSSL') . '\'">' . "\n";
      }

?>
            <td class="dataTableContent" align="left"><?php echo zen_datetime_short($email_archive->fields['date_sent']); ?></td>
            <td class="dataTableContent" align="left"><?php echo $email_archive->fields['email_to_name']; ?></td>
            <td class="dataTableContent" align="left"><?php echo $email_archive->fields['email_to_address']; ?></td>
            <td class="dataTableContent" align="left"><?php echo substr($email_archive->fields['email_subject'], 0, SUBJECT_SIZE_LIMIT) . MESSAGE_LIMIT_BREAK; ?></td>
            <td class="dataTableContent" align="right"><?php
              if (isset($archive) && is_object($archive) && ($email_archive->fields['archive_id'] == $archive->archive_id) && $isForDisplay) {
                echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
              }
              else {
                if ($email_archive->fields['email_html'] != '') {
                  echo TABLE_FORMAT_HTML;
                }
                else {
                  echo TABLE_FORMAT_TEXT;
                }
              }
            ?></td>
          </tr>
<?php
    $email_archive->MoveNext();
  }
?>
          <tr>
            <td class="smallText" colspan="3" valign="top"><?php echo $email_split->display_count($email_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_EMAILS); ?></td>
            <td class="smallText" colspan="4" align="right"><?php echo $email_split->display_links($email_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('archive_id', 'page'))); ?></td>
          </tr>
        </table></td>
<?php
  // create sidebox
  $heading = array();
  $contents = array();

  if (isset($archive) && is_object($archive)) {

    // get the customer ID
    $customer = $db->Execute("select customers_id from " . TABLE_CUSTOMERS . "
                              where customers_email_address like '" . $archive->email_to_address . "'");
    if ($customer->RecordCount() == 1) {
      $mail_button = '<a href="' . zen_href_link(FILENAME_MAIL, 'origin=' . FILENAME_EMAIL_HISTORY . '&mode=NONSSL&selected_box=tools&customer=' . $archive->email_to_address . '&cID=' . $customer->fields['customers_id'], 'NONSSL') . '">' . zen_image_button('button_email.gif', IMAGE_EMAIL) . '</a>';
    }
    else {
      $mail_button = '<a href="mailto:' . $archive->email_to_address . '">' . zen_image_button('button_email.gif', IMAGE_EMAIL) . '</a>';
    }

    $heading[] = array('text' => '<b>' . TEXT_ARCHIVE_ID . $archive->archive_id . '&nbsp; - &nbsp;' . zen_datetime_short($archive->date_sent) . '</b>');
    $contents[] = array('align' => 'center', 'text' => $mail_button . '&nbsp;<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY, 'archive_id=' . $archive->archive_id . '&action=resend_confirm') . '">' . zen_image_button('button_resend.gif', IMAGE_ICON_RESEND) . '</a>');
    // Delete button
    $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY, 'archive_id=' . $archive->archive_id . '&action=delete_confirm') . '">' . zen_image_button('button_delete.gif', IMAGE_ICON_DELETE) . '</a>' . $html_button);
    $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY, 'archive_id=' . $archive->archive_id . '&action=prev_text') . '" TARGET="_blank">' . zen_image_button('button_prev_text.gif', IMAGE_ICON_TEXT) . '</a>' . $html_button);
    if ($archive->email_html != '') {
      $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_EMAIL_HISTORY, 'archive_id=' . $archive->archive_id . '&action=prev_html') . '" TARGET="_blank">' . zen_image_button('button_prev_html.gif', IMAGE_ICON_HTML) . '</a>');
    }
    $contents[] = array('text' => '<br>' . zen_draw_separator());
    $contents[] = array('text' => '<br><b>' . TEXT_EMAIL_MODULE . '</b>'. $archive->module);
    $contents[] = array('text' => '<br><b>' . TEXT_EMAIL_TO . '</b>'. $archive->email_to_name . ' [' . $archive->email_to_address . ']');
    $contents[] = array('text' => '<b>' . TEXT_EMAIL_FROM . '</b>' . $archive->email_from_name . ' [' . $archive->email_from_address . ']');
    $contents[] = array('text' => '<b>' . TEXT_EMAIL_DATE_SENT . '</b>' . $archive->date_sent);
    $contents[] = array('text' => '<b>' . TEXT_EMAIL_SUBJECT . '</b>' . $archive->email_subject);
    $contents[] = array('text' => '<br><b>' . TEXT_EMAIL_EXCERPT . '</b>');
    $contents[] = array('text' => '<br>' . nl2br(substr($archive->email_text, 0, MESSAGE_SIZE_LIMIT)) . MESSAGE_LIMIT_BREAK);
  }

  // display sidebox
  if (zen_not_null($heading) && zen_not_null($contents) && $isForDisplay) {
?>
        <td width="25%" valign="top"><table border="0" cellspacing="0" cellpadding="0" width="100%" valign="top">
          <tr>
            <td colspan="2" valign="top">
<?php
              $box = new box;
              echo $box->infoBox($heading, $contents);
?>
            </td>
          </tr>
        </table></td>
<?php } ?>

      </tr>
    </table></td>
  </tr>
</table></td>
<?php
break;
}
?>
</tr></table>
<?php
if ($isForDisplay) {
  require(DIR_WS_INCLUDES . 'footer.php');

  if ($action == 'resend_confirm') {
?>
<script language="javascript">
  confirmation()
</script>
<?php
  } else if ($action == 'delete_confirm') {
?>
<script language="javascript">
  del_confirmation()
</script>
<?php
  }
}
?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
