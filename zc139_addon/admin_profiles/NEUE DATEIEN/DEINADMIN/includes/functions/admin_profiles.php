<?php
/**
 * @package Admin Profiles
 * @copyright Copyright 2006-2010 Kuroi Web Design
 * @copyright Portions Copyright 2004 Jonathan Kontuk
 * @copyright Portions Copyright 2003 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_profiles.php 356 2010-05-23 18:46:09Z kuroi $
 */

/**
 * This function is used in preference to the php basename function as one of the
 * config entries currently includes a slash which basename unfortunately interprets
 * as part of a filepath and discards everything in front of it.
 */
function strip_suffix($filename,$suffix) {
  $slen = strlen($suffix);
  if (substr($filename,-$slen,$slen) == $suffix) {
    $result = substr($filename,0,strlen($filename)-$slen);
  } else {
    $result = $filename;
  }
  return $result;
}

/**
 * This function tests whether the header passed as a parameter in $header is available
 * to the currently logged in admin user. If so it returns 'true', otherwise 'false'
 */
function menu_header_visible($header) {
  global $db;
  $sql = "SELECT id FROM ".TABLE_ADMIN_MENU_HEADERS." WHERE header = '".$header."'";
  $included = $db->Execute($sql);
  if ($included->fields['id'] != '') {
    $sql = "SELECT admin_id FROM ".TABLE_ADMIN_VISIBLE_HEADERS." WHERE header_id = '".$included->fields['id']."'";
    $who_allow = $db->Execute($sql);
    while (!$who_allow->EOF) {
      if ($who_allow->fields['admin_id']==$_SESSION['admin_id']) return TRUE;
      $who_allow->MoveNext();
    }
  }
  return FALSE;
}

/**
 * This function determines whether the page passed as parameter $page should be
 * displayed in the admin menu for the currently logged on user. After stripping
 * any .php suffix, it looks up the page ID and if it doesn't find one, assumes
 * that this is a new function (e.g. a 3rd party mod) and inserts the page into
 * the admin_files table. Otherwise it checks whether the page is allowed for the
 * currently logged on user. If so, it returns boolean false. If not (including for a new
 * insertion) it returns boolean false.
 */
function page_allowed($page, $param='') {
  global $db;

  // Avoid any risk of unprocessed data making it into the database
  $page = strip_suffix($page,".php");
  $page = zen_db_prepare_input($page);
  $param = zen_db_prepare_input($param);
  if ($page == 'Configuration') {
    return check_page($page, $param);
  }
  $sql = "SELECT id FROM ".TABLE_ADMIN_FILES." WHERE page = '".$page."'";
  $included = $db->Execute($sql);
  if ($included->fields['id'] == '') {
    $sql = "INSERT INTO ". TABLE_ADMIN_FILES." SET page = :page:";
    $sql = $db->bindVars($sql, ':page:', $page, 'string');
    $db->Execute($sql);
  } else {
    $sql = "SELECT admin_id FROM ".TABLE_ADMIN_ALLOWED." WHERE page_id = ".(int)$included->fields['id'];
    $who_allow = $db->Execute($sql);
    while (!$who_allow->EOF){
      if ($who_allow->fields['admin_id'] == $_SESSION['admin_id']) return TRUE;
      $who_allow->MoveNext();
    }
  }
  return FALSE;
}

/**
 * This function checks whether the currently logged on user has permission to access
 * the page passed as parameter $page. The function returns boolean true if the user is
 * allowed access to the page, and boolean false otherwise (including when the page is auto
 * inserted - see below for more details).
 */
function check_page($page, $param='') {
  global $db;

  // Avoid any risk of unprocessed data making it into the database
  $page = zen_db_prepare_input($page);
  $param = zen_db_prepare_input($param);
  $gid = zen_db_prepare_input($_GET['gID']);
  $set =  zen_db_prepare_input($_GET['set']);

  // Most entries (normal case) have their own pages. However, everything on the Config
  // and Modules menus are handled by the single pages config.php and modules.php which
  // must be broken down into subpages for display on the Admin Profiles permissions page.
  // If the page name is passed with a .php suffix, it is stripped.
  if ($page == 'modules') {
    $page = 'modulesset='.$set;
  } elseif ($page == 'configuration') {
    $cid = str_replace('gID=', '', $param) . $gid;
    $sql = "SELECT configuration_group_title FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_id = '".$cid."'";
    $config = $db->Execute($sql);
    $page = $config->fields['configuration_group_title'];
  } else {
    $page = strip_suffix($page,".php");
  }

  // Look up the the ID for the page name passed as parameter $page. If no ID is found
  // assume that this is a new function (e.g. a 3rd party mod) and insert the page into
  // the admin_files table. Otherwise compile a list of users allowed access to the page.
  // If the currently logged in user is on the list return 'true'. If not (including for
  // a new insertion) return 'false'.
  $sql = "SELECT id FROM ".TABLE_ADMIN_FILES." WHERE page = '".$page."'";
  $included = $db->Execute($sql);
  if ($included->fields['id'] == '') {
    $sql = "INSERT INTO ". TABLE_ADMIN_FILES." SET page = :page:";
    $sql = $db->bindVars($sql, ':page:', $page, 'string');
    $db->Execute($sql);
  } else {
    $sql = "SELECT admin_id FROM ".TABLE_ADMIN_ALLOWED." WHERE page_id = '".$included->fields['id']."'";
    $who_allow = $db->Execute($sql);
    while (!$who_allow->EOF) {
      if ($who_allow->fields['admin_id'] == $_SESSION['admin_id']) return TRUE;
      $who_allow->MoveNext();
    }
  }
  return FALSE;
}

/**
 * This function is used to display headers and associated pages when the Edit Permissions option is
 * selected from Admin Settings. It displays the information for the headings and associated pages
 * listed in the array passed to the function as the parameter $headings, and indicates which are
 * currently available to the user with the ID passed as $adminID.
 */
function display_profiles($headers, $adminID) {
  global $db;

  while (!$headers->EOF){ // for each valid menu header
  // From the list of headers in the array passed as a parameter, compile a subset of those visible
  // for the user with parameter adminID. Display all header titles with checkbox, checked if header
  // is visible for this user, unchecked otherwise. Except for the third party mods header which
  // does not have a checkbox and instead has extra explanatory text. Display buttons allowing all
  // boxes under each heading to be checked or unchecked with a single click.

    $sql = "SELECT * FROM ".TABLE_ADMIN_VISIBLE_HEADERS." WHERE header_id = '".$headers->fields['id']."' AND admin_id = '".$adminID."'";
    $visible = $db->Execute($sql);
    if ($headers->fields['id'] == 0) {
      echo '<div class="menuHeaderOff"><span class="menuTitle">';
      echo $headers->fields['header'].TEXT_CONTRIBUTION_GUIDANCE;
    } else {
      if ($visible->fields['admin_id']==$adminID) {
        echo '<div class="menuHeaderOn">'."\n";
        echo "\t".'<span class="menuTitle">';
        echo '<label><input name="'.$headers->fields['header'].'" type="checkbox" checked="on" value="on">';
      } else {
        echo '<div class="menuHeaderOff">'."\n";
        echo "\t".'<span class="menuTitle">';
        echo '<label><input name="'.$headers->fields['header'].'" type="checkbox" value="off">';
      }
      echo $headers->fields['header'].' Menu</label>';
    }
    echo "</span>\n";
    echo "\t".'<span class="headerCheckButtons">'."\n";
    echo "\t\t".'<input type="button" value="'.BUTTON_TEXT_CHECK_ALL.'" onclick="checkAll(this.form,\''.$headers->fields['header'].'\',true);">'."\n";
    echo "\t\t".'<input type="button" value="'.BUTTON_TEXT_UNCHECK_ALL.'" onclick="checkAll(this.form,\''.$headers->fields['header'].'\',false);">'."\n";
    echo "\t</span>\n";
    echo "</div>\n\n";

    // Read in list of all pages under this header from dB thsn for each page. Then for each page
    // read dB to see if the user with parameter adminID is allowed access to this page. Output
    // check box (ticked if page is allowed) and page name. Page name is constructed by stripping
    // out the 10 characters if page is called from the modules menu and replacing underlines
    // space otherwise. Add an asterisk to pages that do not appear directly in the admin menus.
    echo '<div class="checkboxBlock">'."\n";
    $sql = "SELECT * FROM ".TABLE_ADMIN_FILES." WHERE header = '".$headers->fields['id']."'";
    $pages = $db->Execute($sql);
    while (!$pages->EOF) {
      echo "\t".'<label class="permissionBox"><input name="'.$pages->fields['page'].'" class="'.$headers->fields['header'].'" type="checkbox" ';
      $sql = "SELECT * FROM ".TABLE_ADMIN_ALLOWED." WHERE page_id = '".$pages->fields['id']."' AND admin_id = '".$adminID."'";
      $allow = $db->Execute($sql);
      if ($allow->fields['admin_id']==$adminID) {
        echo 'checked="on" value="on">';
      } else {
        echo 'value="off">';
      }
      if (substr($pages->fields['page'],0,11)=='modulesset=') {
        echo substr($pages->fields['page'],11);
      } else{
        echo str_replace('_', ' ', $pages->fields['page']);
      }
      if ($pages->fields['submenu']==1) echo '*';
      echo "</label>\n";
      $pages->MoveNext();
    }
    echo "</div>\n\n";
    $headers->MoveNext();
  }
}

/**
 * This function is used in preference to the php basename function as one of the
 * config entries currently includes a slash which basename unfortunately interprets
 * as part of a filepath and discards everything in front of it.
 */
function extract_page($link)
{
  global $db;

  // Most entries (normal case) have their own pages. However, the Configuration menu is
  // handled differently. A single page takes a parameter. For Admin Profiles these
  // parameters are extracted, looked up and the associated text is used as the page.
  if (strpos($link, 'configuration.php')) {
    $cid = substr($link, strpos($link,'gID=')+4);
    $config = $db->Execute("SELECT configuration_group_title FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_id = '".$cid."'");
    $page = $config->fields['configuration_group_title'];
  }
  else
  {
    $page = $link;
    $page = str_replace(HTTP_SERVER, '', $page);
    $page = str_replace(HTTPS_SERVER, '', $page);
    $page = str_replace(DIR_WS_ADMIN, '', $page);
    if (isset($_GET['zenAdminID']))
    { // remove adminID for users with cookies off, wherever it appears in the URL
      $page = str_replace('?zenAdminID=' . $_GET['zenAdminID'], '', $page);
      $page = str_replace('&zenAdminID=' . $_GET['zenAdminID'], '', $page);
    }
    $page = str_replace('?', '', $page); // for core Zen Cart modules (payment, shipping. order_total
    $page = str_replace('.php', '', $page);
  }
  return $page;
}

/**
 * Amended version of the standard Zen Cart function used to draw a menu entry. This is normally
 * found in the admin/includes/functions/general.php file, where it should be commented out.
 * The change made here is to exclude any menu items for which the current user does not have
 * access priviledges.
 */
function zen_draw_admin_box ($zf_header, $zf_content)
{
  $zp_boxes = '  <li class="submenu">' . "\n";
  $zp_boxes .= '    <a target="_top" href="' . $zf_header['link'] . '">' . $zf_header['text'] . '</a>' . "\n";
  $zp_boxes .= '    <ul>' . "\n";
  for ($i = 0, $sizeof = sizeof($zf_content); $i < $sizeof; ++$i)
  {
    if (page_allowed(extract_page($zf_content[$i]['link'])))
    {
      $zp_boxes .= '      <li><a href="' . $zf_content[$i]['link'] . '">' . $zf_content[$i]['text'] . '</a></li>' . "\n";
    }
  }
  $zp_boxes .= '    </ul>' . "\n";
  $zp_boxes .= '  </li>' . "\n";
  return $zp_boxes;
}