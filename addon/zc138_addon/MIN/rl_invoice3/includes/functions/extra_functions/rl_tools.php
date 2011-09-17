<?php
/**
 * Copyright notice
 *
 * (c) 2003 -2004 The zen-cart developers
 * All rights reserved
 *
 * Portions Copyright (c) 2003 osCommerce
 *
 * This script is part of the zen-cart project. The zen-cart project is
 * free software;
 *
 * This source file is subject to version 2.0 of the GPL license,
 * that is bundled with this package in the file LICENSE, and is
 * available through the world-wide-web at the following url:
 * http://www.zen-cart.at/lizenz/gpl_license.htm.
 * If you did not receive a copy of the zen-cart license and are unable
 * to obtain it through the world-wide-web, please send a note to
 * license@zen-cart.com so we can mail you a copy immediately.
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 *
 * version: 0.2 // 20061002
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com



 $Id$
 */
 
/**
* @desc  merge languagespcific values to PRODUCT_TYPE_LAYOUT
*/
function getProdTypeLangArr($fields){
    global $db;
    $key = $fields['configuration_key'];
    $lang['configuration_title'] = $fields['configuration_title'];
    $lang['configuration_description'] = $fields['configuration_description'];
    
    $sql = "SELECT configuration_title, configuration_description
                            FROM " . TABLE_PRODUCT_TYPE_LAYOUT_LANGUAGE . "
                            WHERE configuration_key = :configurationKey AND languages_id = :languagesID";
    $sql = $db->bindVars($sql, ':configurationKey', $key, 'string');
    $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
    $res = $db->Execute($sql);   
    if(!$res->EOF){
        $lang =  $res->fields;
    }
    return $lang;
}


// shows arrays structered
function rldp($call, $cname = 'NIX', $show = true)
{
     if($show){
         echo '<br />' . $cname . ":<pre>";
         if (!is_array($call)){
             $call = htmlspecialchars($call);
             }
         print_r($call);
         if (is_array($call)){
             reset($call);
             }
         echo "</pre><hr></hr>";
         }
    }

// check cols & index & create/update
function checkColumn($table, $colname, $type, $index=false) {
    global $db;

    //columns
     $sqlC = 'SHOW COLUMNS FROM ' . $table . ' LIKE \'' . $colname . '\'';
     $resC = $db -> Execute($sqlC);
     $anzC = $resC->RecordCount();
     if($anzC) {
        $sqlDo = 'ALTER TABLE ' . $table .' CHANGE ' . $colname . ' ' . $colname . ' ' . $type . ';';
     } else {
        $sqlDo = 'ALTER TABLE ' . $table .' ADD ' . $colname . ' ' . $type . ';';
     }
     $resDo = $db -> Execute($sqlDo);
     $ret['col'] = $sqlDo;

     // index
    if($index) {
        $sqlI = 'SHOW INDEX FROM ' . $table;
        $resI = $db -> Execute($sqlI);
        $ce = true;
        while (!$resI->EOF) {
            if($resI->fields['Column_name'] == $colname) {
                $ce = false;
                break;
            }
            $resI->MoveNext();
        }
        if($ce){
            $sqlDo = 'ALTER TABLE ' . $table .' ADD INDEX (' . $colname . ');';
            $resDo = $db -> Execute($sqlDo);
            $ret['ind'] = $sqlDo;
        }
    }
    return $ret;
}
/**
* @desc exists the table in the database?
*/
function existTable($table) {
    global $db;
    $sqlT = "SHOW  TABLE  STATUS  LIKE  '" . $table . "'";
    $resT = $db -> Execute($sqlT);
    $anzT = $resT->RecordCount();
    return $anzT;
}
/**
* @desc for logging
*/
function writeRL($somecontent, $folder = '../pub/', $filename = "debug.txt", $att='a'){
     // Sichergehen, dass die Datei existiert und beschreibbar ist
     $foldFile = $folder . $filename;
    if (is_writable($folder)){
         if (!$handle = fopen($foldFile, $att)){
             print "Kann die Datei $filename nicht öffnen";
             exit;
             }

         // Schreibe $somecontent in die geöffnete Datei.
        if (!fwrite($handle, $somecontent)){
             print "Kann in die Datei $filename nicht schreiben";
             exit;
             }
         fclose($handle);

         }else{
         print "Die Datei $filename ist nicht schreibbar";
         }
     }
function writeMenu($somecontent, $file){
    $filename = DIR_FS_CATALOG . $file;   
    if ( !file_exists($filename)){
           touch ($filename);
    }
    writeRL($somecontent, $file, 'w');
}

function getNextConfigGroupID(){
    global $db;
    $sql = 'SELECT max(configuration_group_id) as nGID FROM ' . TABLE_CONFIGURATION_GROUP;
    $res = $db->Execute($sql);   
    $max = intval($res->fields['nGID']) + 1; 
    return $max;
}