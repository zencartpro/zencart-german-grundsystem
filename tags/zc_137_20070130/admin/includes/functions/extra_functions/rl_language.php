<?php
#include_once()
#define('SOAPSERVER', 'http://localhost/kzen/zc130/docs/soap/soap/scalar2.php');
#define('SOAPSERVER', 'http://all.ar-pub.com/kzen/zc130/docs/soap/soap/scalar2.php');
$SS = 'SS::'.SOAPSERVER;

function getMenuList($mail='test@xx.yy'){
     require_once(DIR_FS_CATALOG . 'soap/nusoap.php');
     $client = new soapclientNU(SOAPSERVER);
     $result = array();
     $result = $client -> call('menuList', array('mail' => $mail));
    return $result;
     }

 function setSmarty(){
     require(DIR_FS_CATALOG . 'smarty/Smarty.class.php');
     $smarty = new Smarty();
     $smarty -> template_dir = DIR_FS_CATALOG . 'smarty/templates';
     $smarty -> compile_dir = DIR_FS_CATALOG . 'smarty/templates_c';
     $smarty -> cache_dir = DIR_FS_CATALOG . 'smarty/cache';
     $smarty -> config_dir = DIR_FS_CATALOG . 'smarty/configs';
     $smarty -> assign('path', '');
     return $smarty;
     }
function getLastChangeDate($langID=43){
     global $db;
     $sql = "SELECT max(last_modified) as lm FROM  " . TABLE_CONFIGURATION_LANGUAGE. " WHERE configuration_language_id =".$langID;
     $res = $db -> execute($sql);
     if($res -> fields['lm'] == 'NULL'){
         $ret = '1970-01-01';
         }else{
         $ret = substr($res -> fields['lm'], 0, 110);
         }
     return $ret;
     }
function getOldestChangeDate($langID=43){
     global $db;
     $sql = "SELECT min(last_modified) as lm FROM  " . TABLE_CONFIGURATION_LANGUAGE. " WHERE configuration_language_id =".$langID;
     $res = $db -> execute($sql);
     if($res -> fields['lm'] == 'NULL'){
         $ret = '1970-01-01';
         }else{
         $ret = substr($res -> fields['lm'], 0, 110);
         }
     return $ret;
     }

function getSOAP($date = "ALL", $typekey = "ALL", $languages_id){
     require_once(DIR_FS_CATALOG . 'soap/nusoap.php');
     $client = new soapclientNU(SOAPSERVER);
     $result = array();
     $result = $client -> call('configAll', array('date' => $date, 'typekey' => $typekey, 'languages_id'=>$languages_id));
     return $result;
     }
function getSOAPKey($key, $langID=43){
     require_once(DIR_FS_CATALOG . 'soap/nusoap.php');
     $client = new soapclientNU(SOAPSERVER);
     $result = array();
     $result = $client -> call('configKey', array('key' => $key, 'langID'=>$langID));
     # $result='HUGO'.SOAPSERVER;
    return $result;
     }
function getSOAPList($langID=43){
     require_once(DIR_FS_CATALOG . 'soap/nusoap.php');
     $client = new soapclientNU(SOAPSERVER);
     $result = array();
     $result = $client -> call('configList', array('langID' => $langID));
     #$result='HUGO'.SOAPSERVER;
    return $result;
     }
function checkSOAPLang($soapLang, $langID=43){
     global $db;
     $resArr = array();
     if(empty($soapLang)){
         echo '##### EMPTY ####';
         $resArr[] = array('ori' => array('configuration_title' => 'NIX'));
         }
     foreach ($soapLang as $key => $value){
         # echo "$key :: {$value['configuration_key']}<hr>";
        $sql = "SELECT configuration_key,  configuration_title,  configuration_description FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key='" . $value['configuration_key'] . "' AND configuration_language_id =".$langID;
         $res = $db -> execute($sql);
         if(!$res -> EOF){
             if(!($res -> fields['configuration_title'] == $value['configuration_title'] && $res -> fields['configuration_description'] == $value['configuration_description']))
                 $resArr[] = array('ori' => $res -> fields, 'new' => $value);
             }else{
             $res -> fields['configuration_key'] = '!!!NEW!!!';
             $res->  fields['configuration_title'] = '!!!NEW KEY :: '.$value['configuration_key'];
            # $res->  fields['configuration_description'] = '!!!NEW!!!';
            $resArr[] = array('ori' => $res -> fields, 'new' => $value);
             }
         }
         if(empty($resArr)){
            $resArr[0] = array('ori' => array('configuration_key' => 'NIX', 'configuration_title' => 'nothing to do'), 'new' => array('configuration_key' => 'NIX', 'configuration_title' => '<h3>nothing to do</h3>'));
         }
     return $resArr;
     }
 function makeTrans($arg, $arg2, $langID=43, $ID)
{
     global $db;
     $resp = getSOAPKey($arg2, $langID);
     $objResponse = new xajaxResponse();
     $newContent = '<span class="gotit">gotIt:: '.$resp['configuration_key'].'</span>';
     $sql = "REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . "(configuration_title , configuration_key , configuration_language_id , configuration_description , last_modified , date_added )
                VALUES (
                    '" . $resp['configuration_title'] . "', '" . $resp['configuration_key'] . "', '$langID', '" . $resp['configuration_description'] . "', '{$resp['last_modified']}', '{$resp['date_added']}')";
     $res = $db -> execute($sql);
     #$newContent = str_replace("'", '#', $sql);      
     #$newContent = str_replace('"', '@', $newContent);
     #$newContent = "$sql";
     #$newContent = $arg . '######';
     $objResponse -> addAssign('but-'.$ID, "innerHTML", '');
     $objResponse -> addAssign('id-'.$ID, "innerHTML", $newContent);
     $objResponse -> addAssign('tab-'.$ID, "innerHTML", '<td></td>');
     #$objResponse -> addAssign($arg, "innerHTML", makeLanguage());
    return $objResponse -> getXML();
     }
     
 function makeTrans2(&$objResponse, $arg, $arg2, $langID=43, $ID)
{
     global $db;
     $resp = getSOAPKey($arg2, $langID);
     $newContent = '<span class="gotit">gotIt:: '.$resp['configuration_key'].'</span>';
     $sql = "REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . "(configuration_title , configuration_key , configuration_language_id , configuration_description , last_modified , date_added )
                VALUES (
                    '" . mysql_escape_string($resp['configuration_title']) . "', '" . $resp['configuration_key'] . "', '$langID', '" . mysql_escape_string($resp['configuration_description']) . "',  '{$resp['last_modified']}', '{$resp['date_added']}')";
     $res = $db -> execute($sql);
     $objResponse -> addAssign('but-'.$ID, "innerHTML", '');
     $objResponse -> addAssign('id-'.$ID, "innerHTML", $newContent);
     $objResponse -> addAssign('tab-'.$ID, "innerHTML", '<td></td>');
     $objResponse -> getXML();  
    return $objResponse -> getXML();
     }
function makeTransAll($arg='XXX', $arg2='SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', $langID=43, $ID='338')
{
     global $db, $transCount, $checked;
    $newLang = getSOAP('ALL', 'ALL', $_SESSION['languages_id']);
    #$newLang = getSOAP(getOldestChangeDate($_SESSION['languages_id']), 'ALL', $_SESSION['languages_id']);
    
    #rldp($newLang);
    $checkedLang[0] = array('ori' => array('configuration_key' => 'NIX'), 'new' => array('configuration_key' => 'NIX'));   
    if(!empty($newLang)){
         $checkedLang = checkSOAPLang($newLang, $_SESSION['languages_id']);
        }
    $transCount = count($checkedLang);
    $checked = $checkedLang;   
    $checked2 = print_r($checked, true);
    $objResponse = new xajaxResponse();
    
    foreach ($checked as $key => $value) {
    #for($i=2;$i<=222;$i++){
        #writeRL2($key);
        #$objResponse2->loadXML(xajax_makeTrans('', $checked[$i]['new'][configuration_key], 43, $checked[$i]['new'][configuration_id]));
        #makeTrans2(&$objResponse, '', $checked[$i]['new'][configuration_key], 43, $checked[$i]['new'][configuration_id]);
        makeTrans2(&$objResponse, '', $value['new'][configuration_key], 43, $value['new'][configuration_id]);
    }
    
     $newContent = '<span class="gotit">gotIt:: '.$checked[1]['new'][configuration_key].'</span>';
     $objResponse -> addAssign('but-'.$checked[1]['new'][configuration_id], "innerHTML", '');
     $objResponse -> addAssign('id-'.$checked[1]['new'][configuration_id], "innerHTML", $newContent);
     $objResponse -> addAssign('tab-'.$checked[1]['new'][configuration_id], "innerHTML", '<td></td>');
     #$objResponse -> addAssign($arg, "innerHTML", makeLanguage());
    return $objResponse -> getXML();
     }
function writeRL2($somecontent, $filename = "temp2/debug.txt"){
    global $db;
    $sql = "INSERT INTO alog (memo) VALUES ('$somecontent')";
    $db->Execute($sql);
    return;
      }

 ?>
