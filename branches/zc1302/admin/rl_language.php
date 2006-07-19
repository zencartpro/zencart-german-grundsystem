<?php
// Data Manager - Import data from CSV files into a MySQL DB
// Copyright (C) 2005  Eivind E. Valderhaug
// 
// You can contact the original developer by going to this web page:
// http://www.dataweb.no/net/contact/
// 
// This program is subject to the Gnu General Public License version 2 (dated June 1991)
// 
// A copy of the license should have been included with this package; see license.txt
// The license is also available at: http://www.gnu.org/copyleft/gpl.html
$version = "2006-04-19";
if(!defined('SOAPSERVER')){
    define('SOAPSERVER', 'http://translate.ar-pub.com/soap_trans.php');
    #define('SOAPSERVER', 'http://all.ar-pub.com/kzen/zc130/docs/soap/soap/scalar2.php');
    }

require('includes/application_top.php');
require_once("../ajax/xajax.inc.php");

$xajax = new xajax();
$xajax -> registerFunction("makeTrans");

$xajax -> processRequests();

# rldp($_GET, 'GET');
# rldp($_POST, 'POST');

# $x = getSOAPList();
# rldp($x, 'X');
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

# $newLang = getSOAP(getLastChangeDate(), 'ALL');
$newLang = getSOAP('ALL', 'ALL', $_SESSION['languages_id']);
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