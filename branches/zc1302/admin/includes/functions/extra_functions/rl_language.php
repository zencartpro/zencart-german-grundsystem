<?php
#include_once()
#define('SOAPSERVER', 'http://localhost/kzen/zc130/docs/soap/soap/scalar2.php');
#define('SOAPSERVER', 'http://all.ar-pub.com/kzen/zc130/docs/soap/soap/scalar2.php');
$SS = 'SS::'.SOAPSERVER;
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
function getSOAPList(){
     require_once(DIR_FS_CATALOG . 'soap/nusoap.php');
     $client = new soapclientNU(SOAPSERVER);
     $result = array();
     $result = $client -> call('configList', array('key' => $key));
     # $result='HUGO'.SOAPSERVER;
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
     if($arg == '!!!NEW!!!'){
         $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . "(configuration_title , configuration_key , configuration_language_id , configuration_description , last_modified , date_added )
                    VALUES (
                        '" . $resp['configuration_title'] . "', '" . $resp['configuration_key'] . "', '$langID', '" . $resp['configuration_description'] . "', NOW(), NOW())";
         }else{
         $sql = "UPDATE " . TABLE_CONFIGURATION_LANGUAGE . " SET configuration_title='" . $resp['configuration_title'] . "', configuration_description='" . $resp['configuration_description'] . "', last_modified=NOW() WHERE configuration_key='" . $resp['configuration_key'] . "' AND configuration_language_id =".$langID;             
         }
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

 ?>