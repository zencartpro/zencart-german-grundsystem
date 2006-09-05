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
 * version: 0.1 // 20050411
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com



 $Id$
 */
#require_once(('includes/application_top.php'));

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
function existTable($table) {
    global $db;
    $sqlT = "SHOW  TABLE  STATUS  LIKE  '" . $table . "'";
    $resT = $db -> Execute($sqlT);
    $anzT = $resT->RecordCount();
    return $anzT;
}
function writeRL($somecontent, $filename = "temp/debug.txt", $att='a+'){
     // Sichergehen, dass die Datei existiert und beschreibbar ist
     $filename = DIR_FS_CATALOG . $filename;
    if (is_writable($filename)){
         if (!$handle = fopen($filename, $att)){
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

?>
