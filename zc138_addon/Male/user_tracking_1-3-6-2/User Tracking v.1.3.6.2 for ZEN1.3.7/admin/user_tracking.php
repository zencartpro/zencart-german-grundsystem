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
  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  require(DIR_WS_INCLUDES . 'geoip.inc');
  $gi = geoip_open(DIR_WS_INCLUDES . 'GeoIP.dat',GEOIP_STANDARD);

$date_day[] = array();
$date_month[] = array();
$date_year[] = array();

$today = getdate();
$today_month = (int)$today['mon'];
$today_year = (int)$today['year'];
if ($today_month == 0)
    {
    $today_month = 12;
    $today_year =  $today_year-1;
    }


if (isset($_GET['sdate_month'])) {
    $start_date_month_val = (int)$_GET['sdate_month'];
    $start_date_day_val = (int)$_GET['sdate_day'];
    $start_date_year_val = (int)$_GET['sdate_year'];
    }
elseif (isset($_GET['time'])) {
    $start_date_year_val = (int)date("y", $_GET['time'])+2000;
    $start_date_month_val = (int)date("m", $_GET['time']);
    $start_date_day_val = (int)date("d", $_GET['time']);
}
else {
//    trigger_error ("initializing to today = " . $start_date_month_val, E_USER_WARNING );
    $start_date_year_val = (int)$today_year;
    $start_date_month_val = (int)$today_month;
    $start_date_day_val = (int)$today['mday'];
    }

for ($i=1; $i<32; $i++) {
$date_day[] = array('id' => sprintf('%02d', $i), 'text' => sprintf('%02d', $i));
}

for ($i=1; $i<13; $i++) {
$date_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
}

$last_year = $today['year'] - 5;
$first_year = $today['year'];

for ($i=$first_year; $i > $last_year; $i--) {
$date_year[] = array('id' => sprintf('%02d', $i), 'text' => sprintf('%02d', $i));
}

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
<!-- header_eof //-->

<?php echo zen_draw_form('user_tracking_stats', 'user_tracking.php', 'post', 'onsubmit="return check_form(user_tracking_stats);"') . zen_draw_hidden_field('action', 'process'); ?>
<table border="0" width="100%" cellspacing="4" cellpadding="4">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
            <table border="0" width="70%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="main"><?php echo ENTRY_START_DATE; ?></td>
            <td class="main">
            <?php
            echo zen_draw_pull_down_menu('sdate_month', $date_month, $start_date_month_val);
            echo zen_draw_pull_down_menu('sdate_day', $date_day, $start_date_day_val);
            echo zen_draw_pull_down_menu('sdate_year', $date_year, $start_date_year_val);
            echo zen_not_null(ENTRY_START_DATE_TEXT) ? '<span class="inputRequirement">' . ENTRY_START_DATE_TEXT . '</span>': '';
            ?>
            </td>
<td class="main" align="left"><?php echo zen_image_submit('button_report.gif', 'Update Report'); ?></td>

</tr>
</table>

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
      <tr>
        <td class="smallText">

<?php
  if ($_GET['purge'] == '72')
  {
// JTD:10/27/05
//    $db->Execute("DELETE FROM " . TABLE_USER_TRACKING . " where time_last_click < '"  . (time() - ($purge * 3600))."'");
    $db->Execute("DELETE FROM " . TABLE_USER_TRACKING . " where time_last_click < '" . (time() - ($_GET['purge'] * 3600))."'");
    echo "<font color=red>" . TEXT_HAS_BEEN_PURGED . '</font><p>';
  }
  if ($_GET['delip'] == '1')
  {
 //   $db->Execute("DELETE FROM " . TABLE_USER_TRACKING . " WHERE ip_address = '" . CONFIG_USER_TRACKING_EXCLUDED . "'");
//    echo CONFIG_USER_TRACKING_EXCLUDED . ' has been deleted. <p>';
      foreach(explode(",", CONFIG_USER_TRACKING_EXCLUDED) as $skip_ip)
      {
              $db->Execute("DELETE FROM " . TABLE_USER_TRACKING . " WHERE ip_address = '" . (trim($skip_ip)) . "'");
              echo "<br />\n".CONFIG_USER_TRACKING_EXCLUDED . ' has been deleted.<br />';
      }
      echo '<p>';
    $delip='0';
  }
  if ($_GET['delsession'])
  {
    $db->Execute("DELETE FROM " . TABLE_USER_TRACKING . " WHERE session_id = '" . $_GET['delsession'] . "'");
    echo $_GET['delsession'] . ' has been deleted. <p>';
   }

  echo EXPLAINATION, "<p>";

  if (!isset($_GET['time']))
     $_GET['time'] = mktime (0,0,0, $start_date_month_val,$start_date_day_val,$start_date_year_val,-1);
  $time_frame = $_GET['time'];

  echo '<b>' . TEXT_SELECT_VIEW .': </b>';
  echo '<a href="' . FILENAME_USER_TRACKING . '?time=' ;
  echo $time_frame - 86400 . '">' . TEXT_BACK_TO . ' ' . date("M d, Y", $time_frame - 86400) . '</a> ';

  if (time() > $time_frame + 86400)
  {
    echo '| <a href="' . FILENAME_USER_TRACKING . '?time=' ;
    echo $time_frame + 86400 . '">' . TEXT_FORWARD_TO . date("M d, Y", $time_frame + 86400) . '</a>';
  }

  echo "<p>" . TEXT_DISPLAY_START . CONFIG_USER_TRACKING_SESSION_LIMIT . TEXT_DISPLAY_END;
  echo TEXT_PURGE_START . ' <a href="' . FILENAME_USER_TRACKING . '?purge=72">'. TEXT_PURGE_RECORDS. '</a> ' . TEXT_PURGE_END. '</font><p>';

  echo TEXT_DELETE_IP . CONFIG_USER_TRACKING_EXCLUDED . ' <a href="' . FILENAME_USER_TRACKING . '?delip=1">'. TEXT_PURGE_RECORDS. '</a> </font><p>';

  $whos_online =
      $db->Execute("select customer_id, full_name, ip_address, time_entry, time_last_click, last_page_url, page_desc," .
                   " session_id, referer_url, customers_host_address from " . TABLE_USER_TRACKING  .
                   " where time_entry > " . $time_frame .
                   " and time_entry < " . ($time_frame + 86400) .
                   " order by time_last_click desc");

  $results = 0;
while (!$whos_online->EOF) {
     $user_tracking[$whos_online->fields['session_id']]['session_id']=$whos_online->fields['session_id'];
     $user_tracking[$whos_online->fields['session_id']]['ip_address']=$whos_online->fields['ip_address'];
     $user_tracking[$whos_online->fields['session_id']]['customers_host_address']=$whos_online->fields['customers_host_address'];
     $user_tracking[$whos_online->fields['session_id']]['referer_url']=$whos_online->fields['referer_url'];
     $user_tracking[$whos_online->fields['session_id']]['customer_id']=$whos_online->fields['customer_id'];

if ($whos_online->fields['full_name'] != 'Guest')
        $user_tracking[$whos_online->fields['session_id']]['full_name'] = '<font color="0000ff"><b>' . $whos_online->fields['full_name'] . '</b></font>';

     $user_tracking[$whos_online->fields['session_id']]['last_page_url'][$whos_online->fields['time_last_click']] = $whos_online->fields['last_page_url'];

     $user_tracking[$whos_online->fields['session_id']]['page_desc'][$whos_online->fields['time_last_click']] = $whos_online->fields['page_desc'];

     if (($user_tracking[$whos_online->fields['session_id']]['time_entry'] > $whos_online->fields['time_entry']) ||
         (!$user_tracking[$whos_online->fields['session_id']]['time_entry']))
          $user_tracking[$whos_online->fields['session_id']]['time_entry'] = $whos_online->fields['time_entry'];
     if (($user_tracking[$whos_online->fields['session_id']]['end_time'] < $whos_online->fields['time_entry']) ||
         (!$user_tracking[$whos_online->fields['session_id']]['end_time']))
          $user_tracking[$whos_online->fields['session_id']]['end_time'] = $whos_online->fields['time_entry'];
     $results ++;
 $whos_online->MoveNext();
  }

?>




       <tr>
        <td class="smallText" colspan="7"><?php echo sprintf(TEXT_NUMBER_OF_CUSTOMERS, $results); ?></td>
       </tr>





        <table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" align=center><table border="0" width="95%" cellspacing="0" cellpadding="2">

<?php

  // now let's display it

  $listed=0;
  if ($results)
  while (($ut = each($user_tracking)) && ($listed++ < CONFIG_USER_TRACKING_SESSION_LIMIT))
  {
    $time_online = (time() - $ut['value']['time_entry']);
    if ( ((!$_GET['info']) || (@$_GET['info'] == $ut['value']['session_id'])) && (!$info) ) {
      $info = $ut['value']['session_id'];
    }
echo '
       <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent" colspan="5">'.TABLE_HEADING_SESSION_ID .'</td>
        <td class="dataTableHeadingContent" colspan="1 width="150">'.TEXT_USER_SHOPPING_CART.'</td>
       </tr>';


      echo '              <tr class="dataTableRowSelected">' . "\n";

      if ($ut['value']['full_name'] == "")
        $ut['value']['full_name'] = "Guest";

   if($ut['value']['full_name'] != "Guest")
   {
     $stripped_name = strip_tags($ut['value']['full_name']);
     $exploded_name = explode(" ", $stripped_name);
     $customer_link = "<a href=" . DIR_WS_ADMIN . "customers.php?search=" . $exploded_name[1] . ">" . $ut['value']['full_name'] . "</a>";
   }
   else
   {
     $customer_link = $ut['value']['full_name'];
   }
   ?>
   <td colspan = "5" class="dataTableContent" valign="top"><a name="<?php echo $ut['value']['session_id'];?>"></a><?php echo $customer_link . ",&nbsp;" . $ut['value']['session_id'] . ", <a href=\"user_tracking.php?" . ($_GET['time'] ? "time=" . $_GET['time'] . "&" : "") . "delsession=" . $ut['value']['session_id'] . "\"><font color=red>[delete session]</font></a>" . ", <a href=\"user_tracking.php?" . ($_GET['time'] ? "time=" . $_GET['time'] . "&" : "") . "viewsession=" . $ut['value']['session_id'] . "#" . $ut['value']['session_id'] . "\"><font color=green>[view session]</font></a>";?></td>
<?php

    // shopping cart decoding
    $session_data = $db->Execute("select value from " . TABLE_SESSIONS . " WHERE sesskey = '" . $ut['value']['session_id'] . "'");
if ($session_data->RecordCount() >0) {
      $session_data = trim($session_data->fields['value']);
    } else {
      $session_data = @file(zen_session_save_path() . '/sess_' . $ut['value']['session_id']);
      $session_data = trim($session_data[0]);
    }
    $cart = "";
    $referer_url = "";
    $num_sessions ++;
    session_decode($session_data);

    $contents = array();
      if (is_object($_SESSION['cart'])) {
        $products = $_SESSION['cart']->get_products();
        for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
          $contents[] = array('text' => $products[$i]['quantity'] . ' x ' . '<a href="' . zen_href_link(FILENAME_CATEGORIES, 'cPath=' . zen_get_product_path($products[$i]['id']) . '&pID=' . $products[$i]['id']) . '">' . $products[$i]['name'] . '</a>');
// cPath=23&pID=74
        }

        if (sizeof($products) > 0) {
          $contents[] = array('text' => zen_draw_separator('pixel_black.gif', '100%', '1'));
          $contents[] = array('align' => 'right', 'text'  => TEXT_SHOPPING_CART_SUBTOTAL . ' ' . $currencies->format($_SESSION['cart']->show_total(), true, $_SESSION['currency']));
        } else {
          $contents[] = array('text' => '&nbsp;');
        }
      }

    $heading = array();

    if (zen_not_null($contents))
    {

      echo '            <td rowspan="4" valign="top">' . "\n";

      $box = new box;

      echo $box->infoBox($heading, $contents);
      echo '            </td>' . "\n";
    }
    else
    {
      echo '            <td rowspan="4" valign="top" class="dataTableContent" align="center">session expired' . "\n";
      echo '            </td>' . "\n";

    }

?>

              </tr>
		      <tr>
        <td class="dataTableContent" align="right" valign="top"><b>Click Count:</b></td>
        <td class="dataTableContent" valign="top"><font color=FF0000><b><?php echo count($ut['value']['last_page_url']);?></b></font></td>
        <td class="dataTableContent" colspan=2 rowspan=4 align="center">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="dataTableContent" align="right" valign="top"><b><?php echo TABLE_HEADING_ENTRY_TIME; ?></b></td>
    <td class="dataTableContent" colspan="2" valign="top"><?php echo date('H:i:s', $ut['value']['time_entry']); ?></td>
    <td class="dataTableContent" align="right" valign="top"><b><?php echo TEXT_IDLE_TIME ?></ b></td>
    <td class="dataTableContent" colspan="2" valign="top"><?php echo date('H:i:s', (time() - $ut['value']['end_time']+ 28800)); ?></td>
  </tr>
  <tr>
    <td class="dataTableContent" align="right" valign="top"><b><?php echo TABLE_HEADING_END_TIME; ?></b></td>
    <td class="dataTableContent" colspan="2" valign="top"><?php echo date('H:i:s', $ut['value']['end_time']); ?></td>
    <td class="dataTableContent" align="right" valign="top"><b><?php echo TEXT_TOTAL_TIME ?></b></td>
    <td class="dataTableContent" colspan="2" valign="top"><?php echo date('H:i:s', ($ut['value']['end_time'] - $ut['value']['time_entry'] + 28800)); ?></td>
</table>
        </td>
			  </tr>
              <tr>
        <td class="dataTableContent" align="right" valign="top"><b><?php echo TABLE_HEADING_COUNTRY ?></b></td>
        <?php $flag = strtolower(geoip_country_code_by_addr($gi, $ut['value']['ip_address']));
              $cn = geoip_country_name_by_addr($gi, $ut['value']['ip_address']);
        if ($flag == '') $flag = 'us';
        if ($cn == '') $cn = 'United States'; ?>
        <td class="dataTableContent" valign="top"><?php echo zen_image(DIR_WS_FLAGS . $flag . '.gif', $cn); ?>&nbsp;<?php echo $cn; ?></td>
       </tr>
              <tr>
        <td class="dataTableContent" align="right" valign="top"><b><?php echo TABLE_HEADING_IP_ADDRESS ?></b></td>
        <td class="dataTableContent" valign="top"><a href="<?php echo USER_TRACKING_WHOIS_URL ?><?php echo $ut['value']['ip_address'] ; ?>" target="_new"><?php echo $ut['value']['ip_address'] ; ?></a></td>
       </tr>
       <tr>
        <td class="dataTableContent" align="right" valign="top"><b><?php echo TABLE_HEADING_HOST ?></b></td>
        <td class="dataTableContent" valign="top"><?php echo $ut['value']['customers_host_address']/*echo gethostbyaddr($ut['value']['ip_address']) too slow under WINDOWS */; ?></td>
       </tr>
       <tr>
        <td class="dataTableContent" align="right" valign="top"><b><?php echo TEXT_ORIGINATING_URL ?></b></td>
<?php
$ref_name = chunk_split($referer_url,40,"<br>");
?>
        <td class="dataTableContent" align="left" valign="top" colspan=3><?php echo '<a href="'.$ut['value']['referer_url'].'" target="_new">'. $ut['value']['referer_url'] .'</a>' ; ?>&nbsp;</td>
       </tr>
       <tr>
        <td class="dataTableContent"></td>
        <td class="dataTableContent" colspan=3>
        <table border="0" cellspacing="1" cellpadding="2" bgcolor=999999 width=100%>
<?php

if ($_GET['viewsession'] == $ut['value']['session_id']){
  while (($pu = each($ut['value']['last_page_url']))&&($du = each($ut['value']['page_desc'])))
  {

?>
          <tr bgcolor=ffffff>
            <td class="dataTableContent" valign=top align="right"><?php echo date('H:i:s', $pu['key']); ?>:</td>
            <td class="dataTableContent" nowrap valign=top align="left">&nbsp;<a href="<?php echo $pu['value']; ?>" target="_new"><?php if ($du['value']!=''){ echo $du['value'];} ?></a>&nbsp;</td>
            <td class="dataTableContent" width=100% align="left"><a href="<?php echo $pu['value']; ?>" target="_new"><?php echo chunk_split($pu['value'],40,"<br>"); ?></a></td>
          </tr>
<?php
  }
}
echo'        </table>
      </td>
     </tr> ';
 }
?>
       <tr>
        <td class="smallText" colspan="7"><?php echo sprintf(TEXT_NUMBER_OF_CUSTOMERS, $results); echo " Total number of users: " . $num_sessions . "."; ?></td>
       </tr>
      </table></td>
     </tr>
    </table>
   </td>
   </tr>
  </table></td>
<!-- body_text_eof //-->
 </tr>
</table>
</form>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>