<?php
/**
 * @package admin profiles
 * @copyright Copyright kuroi web design 2006-2007
 * @copyright Portions Copyright 2004 Jonathan Kontuk
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_profiles.php - last updated 2006-05-01 by kuroi
 */

function strip_suffix($filename,$suffix){

// This function is used in preference to the php basename function as one of the
// config entries currently includes a slash which basename unfortunately interprets
// as part of a filepath and discards everything in front of it.

	$slen = strlen($suffix);
	if (substr($filename,-$slen,$slen) == $suffix){
		$result = substr($filename,0,strlen($filename)-$slen);
	}else{
		$result = $filename;
	}
	return $result;
}	

function menu_header_visible($header){

// This function tests whether the header passed as a parameter in $header is available
// to the currently logged in admin user. If so it returns 'true', otherwise 'false'

global $db;
	$query = "select id from ".TABLE_ADMIN_MENU_HEADERS." where header = '".$header."'";
	$included = $db->Execute($query);
	if ($included->fields['id'] != ''){
    	$who_allow = $db->Execute("select admin_id from ".TABLE_ADMIN_VISIBLE_HEADERS." where header_id = '".$included->fields['id']."'");
        while (!$who_allow->EOF){
        	if ($who_allow->fields['admin_id']==$_SESSION['admin_id']){return 'true';}
        $who_allow->MoveNext();
        }
    }

return 'false';
}

function page_allowed($page, $param=''){

// This function determines whether the page passed as parameter $page should be
// displayed in the admin menu for the currently logged on user. After stripping
// any .php suffix, it looks up the page ID and if it doesn't find one, assumes
// that this is a new function (e.g. a 3rd party mod) and inserts the page into
// the admin_files table. Otherwise it checks whether the page is allowed for the
// currently logged on user. If so, it returns 'true'. If not (including for a new
// insertion) it returns 'false'.

global $db;

	$page = strip_suffix($page,".php");
  if ($page=='configuration') return check_page($page, $param);

	$query = "select id from ".TABLE_ADMIN_FILES." where page = '".$page."'";
	$included = $db->Execute($query);
	if ($included->fields['id'] == ''){
		$sql = "insert into ". TABLE_ADMIN_FILES."  set page = '".$page."'";
		$db->Execute($sql);
	}else{
    	$who_allow = $db->Execute("select admin_id from ".TABLE_ADMIN_ALLOWED." where page_id = '".$included->fields['id']."'");
        while (!$who_allow->EOF){
        	if ($who_allow->fields['admin_id']==$_SESSION['admin_id']){return 'true';}
        $who_allow->MoveNext();
        }
    }

return 'false';
}

function check_page($page, $param=''){

// This function checks whether the currently logged on user has permission to access
// the page passed as parameter $page. The function returns 'true' if the user is
// allowed access to the page, and 'false' otherwise (including when the page is auto
// inserted - see below for more details). 

global $db;

	// Most entries (normal case) have their own pages. However, everything on the Config
	// and Modules menus are handled by the single pages config.php and modules.php which
	// must be broken down into subpages for display on the Admin Profiles permissions page.
	// If the page name is passed with a .php suffix, it is stripped.

	if ($page == 'modules'){
		$page = 'modulesset='.$_GET['set'];	
	}elseif ($page == 'configuration'){
		$cid = str_replace('gID=', '', $param) . $_GET['gID'];
		$config = $db->Execute("select configuration_group_title from ".TABLE_CONFIGURATION_GROUP." where configuration_group_id = '".$cid."'");
		$page = $config->fields['configuration_group_title'];
	}else{
		$page = strip_suffix($page,".php");
	}

	// Look up the the ID for the page name passed as parameter $page. If no ID is found
	// assume that this is a new function (e.g. a 3rd party mod) and insert the page into
	// the admin_files table. Otherwise compile a list of users allowed access to the page.
	// If the currently logged in user is on the list return 'true'. If not (including for
	// a new insertion) return 'false'.

	$query = "select id from ".TABLE_ADMIN_FILES." where page = '".$page."'";
    $included = $db->Execute($query);
    if ($included->fields['id'] == ''){
    	$sql = "insert into ". TABLE_ADMIN_FILES."  set page = '".$page."'";
	$db->Execute($sql);    	
	}else{
    	$query = "select admin_id from ".TABLE_ADMIN_ALLOWED." where page_id = '".$included->fields['id']."'";
		$who_allow = $db->Execute($query);
        while (!$who_allow->EOF){
        	if ($who_allow->fields['admin_id']==$_SESSION['admin_id']){return 'true';}
        $who_allow->MoveNext();
        }
    }

return 'false';
}

function display_profiles($headers, $adminID){

// This function is used to display headers and associated pages when the Edit Permissions option is
// selected from Admin Settings. It displays the information for the headings and associated pages
// listed in the array passed to the function as the parameter $headings, and indicates which are
// currently available to the user with the ID passed as $adminID.
 
global $db;
  
  while (!$headers->EOF){ // for each valid menu header

	// From the list of headers in the array passed as a parameter, compile a subset of those visible
	// for the user with parameter adminID. Display all header titles with checkbox, checked if header
	// is visible for this user, unchecked otherwise. Except for the third party mods header which
	// does not have a checkbox and instead has extra explanatory text. Display buttons allowing all
	// boxes under each heading to be checked or unchecked with a single click.

  	$query  = "select * from ".TABLE_ADMIN_VISIBLE_HEADERS." where header_id = '".$headers->fields['id']."' and admin_id = '".$adminID."'";
	$visible = $db->Execute($query);
	if ($headers->fields['id'] == 0){
		echo '<div class="menuHeaderOff"><span class="menuTitle">';
		echo $headers->fields['header'].' (when enabled these 3rd party contributions will appear in the Admin menus determined by their authors)';
	}else{
		if ($visible->fields['admin_id']==$adminID){
			echo '<div class="menuHeaderOn">'."\n";
			echo "\t".'<span class="menuTitle">';
			echo '<label><input name="'.$headers->fields['header'].'" type="checkbox" checked="on" value="on">';
		}else{
			echo '<div class="menuHeaderOff">'."\n";
			echo "\t".'<span class="menuTitle">';
			echo '<label><input name="'.$headers->fields['header'].'" type="checkbox" value="off">';
		}
		echo $headers->fields['header'].' Menu</label>';
	}
	echo "</span>\n";
	echo "\t".'<span class="headerCheckButtons">'."\n";
	echo "\t\t".'<input type="button" value="check All" onclick="checkAll(this.form,\''.$headers->fields['header'].'\',true);">'."\n";
	echo "\t\t".'<input type="button" value="Uncheck All" onclick="checkAll(this.form,\''.$headers->fields['header'].'\',false);">'."\n";
	echo "\t</span>\n";
	echo "</div>\n\n";
	
	// Read in list of all pages under this header from dB thsn for each page. Then for each page
	// read dB to see if the user with parameter adminID is allowed access to this page. Output
	// check box (ticked if page is allowed) and page name. Page name is constructed by stripping
	// out the 10 characters if page is called from the modules menu and replacing underlines
	// space otherwise. Add an asterisk to pages that do not appear directly in the admin menus.

	echo '<div class="checkboxBlock">'."\n";
	$query = "select * from ".TABLE_ADMIN_FILES." where header = '".$headers->fields['id']."'";
	$pages = $db->Execute($query);
	while (!$pages->EOF){
	
 	    echo "\t".'<label class="permissionBox"><input name="'.$pages->fields['page'].'" class="'.$headers->fields['header'].'" type="checkbox" ';
		$query = "select * from ".TABLE_ADMIN_ALLOWED." where page_id = '".$pages->fields['id']."' and admin_id = '".$adminID."'";
		$allow = $db->Execute($query);
		if ($allow->fields['admin_id']==$adminID) {echo 'checked="on" value="on">';}
		else {echo 'value="off">';}
		
		if (substr($pages->fields['page'],0,11)=='modulesset=')
			{echo substr($pages->fields['page'],11);}
		else{echo str_replace('_', ' ', $pages->fields['page']);}
		
		if ($pages->fields['submenu']==1)
			{echo '*';}
		echo "</label>\n";
	$pages->MoveNext();
	}
	echo "</div>\n\n";
  $headers->MoveNext();
  }
}
?>