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
 * http://www.zen-cart.com/license/2_0.txt.
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
 */
/**
 * imports products & categories from a flat-file into zen-db
 * 
 * #) look at: import_columns.txt == column maping struc
 * a line like this means:
 * products_description 	products_description	description_en	2	Hugo was Here
 * table_name	fieldname	headername	language_id	defaultvalue
 * !!important: delimeter == tab (in all import files)
 * DON'T USE PREFIX (ZEN_ ..)
 * 
 * #) look at: admin/import_products/import.*
 * place in the first row the headernames from 4)
 * numbers must have the form: 12346.123 (decimal seperator == . (point))
 * 
 * #) place in import_products the file named import.txt
 * 
 * #) goto zen admin / tools / product import == click on import
 * 
 * version: 0.3 // 20041010
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com
 */
// $Id$
require('includes/application_top.php');

function dpO($call, $cname = 'NIX')
{
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

function getColumn($needle , $arr)
{
     $needle = trim($needle);
     return array_search($needle, $arr);
     }
function getCategories(){
     global $db;
     $q = ' SELECT ' . TABLE_CATEGORIES . '.categories_id, ' . TABLE_CATEGORIES . '.parent_id, ' . TABLE_CATEGORIES_DESCRIPTION . '.language_id, ' . TABLE_CATEGORIES_DESCRIPTION . '.categories_name, ' . TABLE_CATEGORIES_DESCRIPTION . '.categories_description
            FROM ' . TABLE_CATEGORIES_DESCRIPTION . ' INNER JOIN ' . TABLE_CATEGORIES . ' ON ' . TABLE_CATEGORIES_DESCRIPTION . '.categories_id = ' . TABLE_CATEGORIES . '.categories_id
            ORDER BY ' . TABLE_CATEGORIES . '.categories_id;';
     $row = $db -> Execute($q);
     while (!$row -> EOF){
         $cat[$row -> fields['language_id']][$row -> fields['categories_name']] = $row -> fields;
         $row -> MoveNext();
         }
     return $cat;
     }

 function getCatID($tableGes, & $catArray, $cols, $colVals, $map, $nextCID){
     global $db;
     $catExist = false;
     $table = $tableGes['categories_description'];
     foreach ($table['categories_name'] as $key => $value){
         $lid = $colVals[$value][3];
         $val = $colVals[$value][4];
         $same = explode('_', $val);
         if($same[0] == '#SAME#'){
             #$lid = $same[1];
             }
         $tmp = array_key_exists($val, $catArray[$lid]);
         if ($tmp == true){
             $catExist = true;
             $catA = $catArray[$lid][$val];
             }
         $aa[$lid] = array_key_exists($val, $catArray[$lid]);
         }
     if($catExist == false){
         if($nextCID == -1){
             $q = 'SELECT max( categories_id ) as mR FROM ' . DB_PREFIX . 'categories ';
             $row = $db -> Execute($q);
             $nextCID = $row -> fields['mR'] + 1;
             }else{
             $nextCID++;
             }
         foreach ($table['categories_name'] as $key => $value){
             $lid = $colVals[$value][3];
             $tmpCat[$lid]['categories_id'] = $nextCID;
             $tmpCat[$lid]['parent_id'] = 0;
             $tmpCat[$lid]['language_id'] = $colVals[$value][3];
             $tmpCat[$lid]['categories_name'] = $colVals[$value][4];
             }
        
         foreach ($table['categories_description'] as $key => $value){
             $lid = $colVals[$value][3];
             $tmpCat[$lid]['categories_decription'] = $colVals[$value][4];
             }
         foreach ($tmpCat as $key => $value){
             $catArray[$key][$value['categories_name']] = $value;
             }
         }else{
         $nextCID = $catA['categories_id'];
         }
     $ret['exist'] = $catExist;
     $ret['tf'] = $aa;
     $ret['nextCID'] = $nextCID;
     $ret['catA'] = $catA;
     return $ret;
     }
function importprod($fileName, $fileColumns, $dateFormat = 'YYYY-MM-DD', $numberFormat = ',')
{
     global $db;
     $podCount = -1;
     $table1 = DB_PREFIX . 'products';
     $table2 = DB_PREFIX . 'products_description';
     $table3 = DB_PREFIX . 'products_to_categories';
     $catArray = getCategories();
     $catID = -1;
    
     if (!file_exists($fileName)){
         return '<b>' . $fileName . ' doesn\'t exist</b>';
         }
    
    
    /**
     * map-file
     */
     $lines = file ($fileColumns);
     $cols = array();
     $colSearch = array();
     $i = 0;
     foreach ($lines as $key => $value){
         $value = trim($value);
         if($value[0] != '#'){
             $line = split("\t", $value);
             $cols[] = split("\t", $value);
             $colSearch[] = trim($line[2]);
             $tables2[trim($line[0])][trim($line[1])] = $i;
             $tables2C[trim($line[0])][trim($line[1])]++;
             if ($tables2C[trim($line[0])][trim($line[1])] > 1){
                 $tableCount[trim($line[0])][trim($line[1])] = $tables2C[trim($line[0])][trim($line[1])];
                 }
             $tables[trim($line[0])][trim($line[1])][] = $i;
             $i++;
             }
         }
     foreach ($tables2C as $key1 => $value1){
         foreach ($value1 as $vkey => $vvalue){
             if ($vvalue > $cc[$key1]){
                 $cc[$key1] = $vvalue;
                 }
             }
         }
     $colDefault = $cols;
     $lines = file ($fileName);
     foreach ($lines as $key1 => $value1){
         $line = split("\t", trim($value1));
         if ($key1 == 0){ // map-keys
             foreach ($line as $lkey => $lvalue){
                 $map[$lkey] = getColumn($lvalue, $colSearch);
                 }
             $q = 'SELECT max( products_id ) as mR FROM ' . DB_PREFIX . 'products ';
             $row = $db -> Execute($q);
             $nextID = $row -> fields['mR'] + 1;
             }else{ // data-handling
             $colVals = $colDefault;
             foreach ($line as $lkey => $lvalue){
                 $colVals[$map[$lkey]][4] = $lvalue;
                 }
             $catTmp = getCatID($tables, $catArray, $cols, $colVals, $map, $catID);
             $catID = $catTmp['nextCID'];
             foreach ($tables as $p1key => $p1value){
                 $qqA = array();
                 $qv = "LEER::$p1key::";
                 $qh = '';
                 for($j = 0; $j < $cc[$p1key]; $j++){
                     $kill[$j] = false;
                     switch ($p1key){
                     case 'categories':
                         $qvA[$j] = "INSERT INTO " . DB_PREFIX . "$p1key (categories_id ";
                         $qhA[$j] = " VALUES ('$catID' ";
                         if($catTmp['exist'] == true){
                             $kill[$j] = true;
                             }
                         break;
                     case 'categories_description':
                         $qvA[$j] = "INSERT INTO " . DB_PREFIX . "$p1key (categories_id, language_id ";
                         $qhA[$j] = " VALUES ('$catID', '@LID@' ";
                         if($catTmp['exist'] == true){
                             $kill[$j] = true;
                             }
                         break;
                     case 'products':
                         $qvA[$j] = "INSERT INTO " . DB_PREFIX . "$p1key (products_id ";
                         $qhA[$j] = " VALUES ('$nextID' ";
                         break;
                     case 'products_to_categories':
                         $qvA[$j] = "INSERT INTO " . DB_PREFIX . "$p1key (products_id, categories_id ";
                         $qhA[$j] = " VALUES ('$nextID', '$catID' ";
                         break;
                     case 'products_description':
                         $qvA[$j] = "INSERT INTO " . DB_PREFIX . "$p1key (products_id, language_id ";
                         $qhA[$j] = " VALUES ('$nextID', '@LID@' ";
                         }
                     foreach ($p1value as $pkey => $pvalue){
                     if($pkey == 'dummy'){
                     }else{
                     #if ($tables2C[$p1key][$pkey] > 1){
                     if ($colVals[$pvalue[$j]][3]>=1){
                         $qvA[$j] .= ", " . trim($colVals[$pvalue[$j]][1]);
                         $qhA[$j] .= ", '" . mysql_escape_string(trim($colVals[$pvalue[$j]][4])) . "'";
                         $qhA[$j] = str_replace('@LID@', trim($colVals[$pvalue[$j]][3]), $qhA[$j]);
                         if($p1key == 'categories_description' && $catTmp['tf'][$colVals[$pvalue[$j]][3]] == true){
                             $kill[$j] = true;
                             }
                         }else{
                         $qvA[$j] .= ", " . trim($colVals[$pvalue[0]][1]);
                         $qhA[$j] .= ", '" . mysql_escape_string(trim($colVals[$pvalue[0]][4])) . "'";
                         }
                     }
                 }
             if ($kill[$j] != true){
                 $qqA[$j] = $qvA[$j] . ') ' . $qhA[$j] . ')';
                 }else{
                 }
            
             }
         $qqqq[] = $qqA;
         }
     }
 $nextID ++;
 $prodCount++;
 }
 $content = "";
 #dpo($qqqq, 'VAL');
 foreach ($qqqq as $key1 => $value1){
 foreach ($value1 as $key => $value){
     $content .= $value . ";\n\n<br>";
     # echo($value."\n<br /><br />");
    # dpo($value, 'VAL');
    $row = $db -> Execute($value);
     }
 }
 # exec("mv $fileName $fileName.importet");
return $prodCount;
return $content;
}

 $action = (isset($_GET['action']) ? $_GET['action'] : '');

 if (zen_not_null($action)){
 switch ($action){
 case 'import':
 $imp = importProd('import_products/import.txt', 'import_products/import_columns.txt');
 break;
 case 'cat':
 require('import_cat.php');
 $imp = doIt();
 # $impC = new import('import_products/categories.txt', 'import_products/import_columns.txt');
# $imp = $impC->getRet();
/**
 * $impC -> Cat = $impC -> getCategories();
 * $x2 = $impC -> importCat2();
 * $imp = "CAT";
 * $imp = $impC -> getNextCatID();
 */
break;
 }
 }

// check if the backup directory exists
$dir_ok = true;
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS;
?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;
?>">
<title><?php echo TITLE;
?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE;
?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                
                
                
              </tr>
            </table></td>
<?php
 $heading = array();

 switch ($action){
 default:
 # $heading[] = array('text' => '<b>klick me <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;deeper' . $buInfo -> date . '</b>');
$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_IMPORT_PRODUCTS, 'file=' . $buInfo -> file . '&action=cat') . '">' . LINK_TEXT_CAT . '</a>');
$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_IMPORT_PRODUCTS, 'file=' . $buInfo -> file . '&action=import') . '">' . LINK_TEXT . '</a>');
if(isset($imp)){
 $contents[] = array('align' => 'center', 'text' => 'IMPORTED: ' . $imp);
}
 #$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_IMPORT_PRODUCTS, 'file=' . $buInfo -> file . '&action=import') . '">' . LINK_TEXT . '</a>');
 break;
 }

 echo '<td width="25%" valign="top">' . "\n";
 $box = new box;
 echo $box -> infoBox($heading, $contents);
 echo '            </td>' . "\n";
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
?>