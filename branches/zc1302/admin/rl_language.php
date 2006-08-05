<?php
// Copyright (C) 2006 rainer langheiter
// 
// You can contact the original developer by going to this web page:
// http://edv.langheiter.com/
// 
// This program is subject to the Gnu General Public License version 2 (dated June 1991)
// 
// A copy of the license should have been included with this package; see license.txt
// The license is also available at: http://www.gnu.org/copyleft/gpl.html
// $Id$ 
$version = "2006-07-19";
if(!defined('SOAPSERVER')){
    define('SOAPSERVER', 'http://translate.ar-pub.com/soap_trans.php');
    }

require('includes/application_top.php');
require_once("../ajax/xajax.inc.php");

$xajax = new xajax();
$xajax -> registerFunction("makeTrans");
$xajax -> registerFunction("makeTransAll");

$xajax -> processRequests();

/*

# rldp($_GET, 'GET');
# rldp($_POST, 'POST');

$x = getMenuList('rainer@ar-pub.com');
rldp($x, 'X');  

#$x = getSOAPList(43);
rldp($x, 'X');  
die();
*/
/**
 * init smarty environment
 */
$smarty = setSmarty ();

/**
 * header stuff
 */
$smarty -> display('header.tpl.html');
$xajax -> printJavascript('../ajax/');

require(DIR_WS_INCLUDES . 'header.php');
$smarty -> assign('cfg_header', $za_heading);
$smarty -> assign('cfg', $za_contents);
$smarty -> assign('languages_id', $_SESSION['languages_id']);
$smarty -> assign('SOAPSERVER', SOAPSERVER);

/**
 * main-part == rl_language
 */

$smarty -> assign('version', $version);
$smarty -> assign('lm', getLastChangeDate());
$smarty -> assign('name', 'Fred2');        // auswahlmenu einblenden


#$x = getSOAPList(43);
#rldp($x, 'X');

$newLang = getSOAP(getLastChangeDate(), 'ALL', 43);
$newLang = getSOAP('ALL', 'ALL', 43);   
#$newLang = getSOAP(getOldestChangeDate($_SESSION['languages_id']), 'ALL', $_SESSION['languages_id']);
#rldp($newLang);
#die('###');  
#writeRL2(print_r($newLang, true));
#rldp($newLang);
$checkedLang[0] = array('ori' => array('configuration_key' => 'NIX'), 'new' => array('configuration_key' => 'NIX'));   
if(!empty($newLang)){
     $checkedLang = checkSOAPLang($newLang, $_SESSION['languages_id']);
    }
$transCount = count($checkedLang);
$checked = $checkedLang[0];      
$smarty -> assign('transCount', $transCount);

# rldp($newLang, '000');
# $checked['new']['configuration_title'] = str_highlight($checked['new']['configuration_title'], $checked['ori']['configuration_title'], NULL, '<span class="Stil1">\1</span>');

$smarty -> assign('checkedA', $checkedLang);

# ;
# rldp($checked['ori']['configuration_key'],'ori');
$smarty -> display('rl_language.tpl.html');


/**
 * footer stuff
 */
$smarty -> display('footer.tpl.html');
$smarty -> display('configuration.tpl.html');
require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
