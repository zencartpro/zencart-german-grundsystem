<?php
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header.php 2024-02-06 21:25:51Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (defined('STRICT_ERROR_REPORTING') && STRICT_ERROR_REPORTING == true) {
  $messageStack->add('STRICT ERROR REPORTING IS ON', 'error');
}
/*
 * pull in any necessary JS for the page
 * Left here for legacy pages that do not use the new admin_html_head.php file
 */
require_once DIR_WS_INCLUDES . 'javascript_loader.php';

// Show Languages Dropdown for convenience only if main filename and directory exists
if (empty($action)) {
    $languages_array = [];
    $languages = zen_get_languages();
    if (count($languages) > 1) {
        //$languages_selected = $_GET['language'];
        $languages_selected = $_SESSION['language'];
        $missing_languages = '';
        $count = 0;
        for ($i = 0, $n = count($languages); $i < $n; $i++) {
            $test_directory = DIR_WS_LANGUAGES . $languages[$i]['directory'];
            $test_file = DIR_WS_LANGUAGES . $languages[$i]['directory'] . '.php';
            if (file_exists($test_file) && file_exists($test_directory)) {
                $count++;
                $languages_array[] = [
                  'id' => $languages[$i]['code'],
                  'text' => $languages[$i]['name']
                ];
                if ($languages[$i]['directory'] == $_SESSION['language']) {
                    $languages_selected = $languages[$i]['code'];
                }
            } else {
                $missing_languages .= ' ' . ucfirst($languages[$i]['directory']) . ' ' . $languages[$i]['name'];
            }
        }

// if languages in table do not match valid languages show error message
        if ($count != count($languages)) {
            $messageStack->add('MISSING LANGUAGE FILES OR DIRECTORIES ...' . $missing_languages, 'caution');
        }
        $hide_languages = false;
    } else {
        $hide_languages = true;
    } // more than one language
} else {
    $hide_languages = true;
} // hide when other language dropdown is used


// display alerts/error messages, if any
if ($messageStack->size > 0) {
    ?>
    <div class="messageStack-header noprint">
        <?php
        echo $messageStack->output();
        ?>
    </div>
    <?php
}
// check GV release queue and alert store owner
if (defined('MODULE_ORDER_TOTAL_GV_SHOW_QUEUE_IN_ADMIN') && MODULE_ORDER_TOTAL_GV_SHOW_QUEUE_IN_ADMIN == 'true') {
    $new_gv_queue = $db->Execute("select * from " . TABLE_COUPON_GV_QUEUE . " where release_flag='N'");
    $new_gv_queue_cnt = 0;
    if ($new_gv_queue->RecordCount() > 0) {
        $new_gv_queue_cnt = $new_gv_queue->RecordCount();
        $goto_gv = '<a href="' . zen_href_link(FILENAME_GV_QUEUE) . '">' . '<span class="btn btn-info">' . IMAGE_GIFT_QUEUE . '</span></a>';
    }
}
?>
<!-- All HEADER_ definitions in the columns below are defined in includes/languages/german.php //-->
<div id="topright">
<div id="help">
 <div class="helpicon hidden-xs noprint">
     <a title="Hilfe zur deutschen Zen Cart Version" href="<?php echo zen_href_link(FILENAME_GERMAN_HELP, '', 'NONSSL'); ?>"><i class="fa-solid fa-question fa-lg" style="color: #006080;"></i></a>
  </div>
  <br>
  <div class="logout noprint">
  <a title="Logout" href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'NONSSL'); ?>"><i class="fa-solid fa-arrow-right-from-bracket fa-lg" style="color: #E47B3A;"></i></a>
  </div>
</div>
</div>
  <div class="row">
    <div class="col-xs-8 col-sm-3" id="adminHeaderLogo">
        <?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . zen_image(DIR_WS_IMAGES . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT, HEADER_LOGO_WIDTH, HEADER_LOGO_HEIGHT) . '</a>'; ?>
    </div>

    <div class="hidden-xs col-sm-3 col-sm-push-6 noprint adminHeaderAlerts">
    	<span class="admininfosmall">
     <?php
     $admname = '' . preg_replace('/[^\w]/', '*', zen_get_admin_name()) . ''; 
    $adminInfo = zen_read_user(zen_get_admin_name($_SESSION['admin_id']));
    $uhrzeit = date('H');    
    if($uhrzeit >= 3 && $uhrzeit < 12){
          echo 'Guten Morgen ';}
    elseif($uhrzeit >= 12 && $uhrzeit < 18){ 
          echo 'Guten Tag ';}
    elseif($uhrzeit >= 18 && $uhrzeit < 22) { 
          echo 'Guten Abend '; 
    }
    else
    { 
          echo 'Gute Nacht ';   
    }
    echo '<b><a href="' . zen_href_link(FILENAME_ADMIN_ACCOUNT, '', 'NONSSL') .'">' . $admname . '</b></a> am ';
    setlocale(LC_TIME, 'de_DE.UTF8');
    echo $zcDate->output('%A').', '.date('d.m.Y H:i').' Uhr';
    echo '<br>';
    echo TEXT_PASSWORD_LAST_CHANGE . $adminInfo['pwd_last_change_date'];
    echo '<br>';
    echo '' . TEXT_LAST_LOGIN_INFO . $_SESSION['last_login_date'] . ' [' . $_SESSION['last_login_ip'] . ']';
    ?>
      </span>
    </div>

    <div class="hidden-sm hidden-md hidden-lg col-xs-4 noprint adminHeaderAlerts">
        <a class="btn btn-primary" role="button" href="<?php echo zen_href_link(FILENAME_ORDERS); ?>"><?php echo BOX_CUSTOMERS_ORDERS; ?></a>
    </div>

    <div class="clearfix visible-xs-block"></div>
    <div class="col-xs-6 col-sm-3 col-sm-pull-3 noprint adminHeaderAlerts">
        <?php
        if (isset($_SESSION['reset_admin_activity_log']) && ($_SESSION['reset_admin_activity_log'] == true && (basename($PHP_SELF) == FILENAME_DEFAULT . '.php'))) {
        ?>
        <a class="btn btn-warning" role="button" href="<?php echo zen_href_link(FILENAME_ADMIN_ACTIVITY); ?>"><?php echo TEXT_BUTTON_RESET_ACTIVITY_LOG;?></a><p class="hidden-xs"><br><?php echo RESET_ADMIN_ACTIVITY_LOG; ?></p>
        <?php
        }
        ?>
    </div>

    <div class="col-xs-6 col-sm-3 col-sm-pull-3 noprint adminHeaderAlerts">
        <?php if (!empty($new_gv_queue_cnt)) echo $goto_gv . '<br>' . sprintf(TEXT_SHOW_GV_QUEUE, $new_gv_queue_cnt); ?>
    </div>

  </div>
  <div class="row headerBar">
    <div id="langswitch" class="hidden-xs">
        <?php
        if (!$hide_languages) {
            echo zen_draw_form('languages', basename($PHP_SELF), '', 'get');
            echo DEFINE_LANGUAGE . '&nbsp;&nbsp;' . (count($languages) > 1 ? zen_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"') : '');
            echo zen_hide_session_id();
            echo zen_post_all_get_params(array('language'));
            echo '</form>';
        } else {
            echo '&nbsp;';
        }
        ?>
    </div>
    <div id="usefuladminlinks">       
    <div>
        <ul class="nav nav-pills upperMenu">           
            <li><a href="<?php echo zen_catalog_href_link(FILENAME_DEFAULT); ?>" class="headerLink" rel="noopener" target="_blank"><?php echo HEADER_TITLE_ONLINE_CATALOG; ?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_1_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_1_TEXT;?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_2_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_2_TEXT;?></a></li>
    	      <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_3_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_3_TEXT;?></a></li>
    	      <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_4_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_4_TEXT;?></a></li>
    	      <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_5_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_5_TEXT;?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_6_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_6_TEXT;?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_7_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_7_TEXT;?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_8_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_8_TEXT;?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_9_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_9_TEXT;?></a></li>
            <li><a class="headerLink" href="<?php echo ADMIN_HEADER_USEFUL_LINK_10_URL;?>" target="_blank"><?php echo ADMIN_HEADER_USEFUL_LINK_10_TEXT;?></a></li>            
        </ul>
    </div>
  </div>
  </div>
<?php require DIR_WS_INCLUDES . 'header_navigation.php'; ?>