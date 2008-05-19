<?php
require_once('includes/application_top.php');

function dpOXX($call, $cname = 'NIX')
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

class import{
     function import($impFile, $strucFile){
         $this -> impFile = $impFile;
         $this -> strucFile = $strucFile;
         global $db;
         $this -> db = $db;
         $this -> lid = $_SESSION['languages_id'];
         $this -> languages = $this -> getLanguages();
         }
     function getLanguages(){
         $q = 'SELECT languages_id FROM ' . TABLE_LANGUAGES;
         $row = $this -> db -> Execute($q);
         while (!$row -> EOF){
             $languages[] = $row -> fields;
             $row -> MoveNext();
             }
         return $languages;
         }
     function getNextCatID(){
         $q = 'SELECT max( categories_id ) as mR FROM ' . DB_PREFIX . 'categories ';
         $row = $this -> db -> Execute($q);
         $nextCID = $row -> fields['mR'] + 1;
         return $nextCID;
         }
     function getColumn($needle , $arr)
    {
         $needle = trim($needle);
         return array_search($needle, $arr);
         }
     function getCategories()
    {
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
    
     function getCatIDOLD($tableGes, & $catArray, $cols, $colVals, $map, $nextCID)
    {
         global $db;
         $catExist = false;
         $table = $tableGes['categories_description'];
         foreach ($table['categories_name'] as $key => $value){
             $lid = $colVals[$value][3];
             $val = $colVals[$value][4];
             $tmp = array_key_exists($val, $catArray[$lid]);
             if ($tmp == true){
                 $catExist = true;
                 $catA = $catArray[$lid][$val];
                 }
             $aa[$lid] = array_key_exists($val, $catArray[$lid]);
             }
         if ($catExist == false){
             if ($nextCID == -1){
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
             // $catArray[] = $tmpCat;
            // $catArray = array_merge($catArray, $tmpCat);
            // $rq1 = $db -> Execute($q1);
        }else{
             $nextCID = $catA['categories_id'];
             }
         $ret['exist'] = $catExist;
         $ret['tf'] = $aa;
         $ret['nextCID'] = $nextCID;
         $ret['catA'] = $catA;
         return $ret;
         }
     function importCat2(){
         $lines = file ($this -> impFile);
         $cols = array();
         $colSearch = array();
         $i = 0;
         foreach ($lines as $key => $value){
             $value = html_entity_decode(trim($value));
             # $value = str_replace('')
            $line = explode('|', $value);
             $cols[] = explode('|', $value);
             }
         return $cols;
         }
     function getRet(){
         return $this -> Ret;
         }
     function getCatID($catImport){
         $parent = 0;
         foreach ($catImport as $key => $scat){
             $tmp = array_key_exists($scat, $this -> CatArray[$this -> lid]);
             $catID = $this -> nextCID;
             if ($tmp == true){
                 $catExist = true;
                 $parent = $this -> CatArray[$this -> lid][$scat]['parent_id'];
                 $parent = $this -> CatArray[$this -> lid][$scat]['categories_id'];  
                 }else{
                 $qCat = "INSERT INTO " . TABLE_CATEGORIES . " (categories_id, parent_id, categories_status) ";
                 $qCat .= " VALUES('" . $catID . "', '" . $parent . "', '1')";
                 $ret[] = $qCat;
                 $parent = $catID;
                 foreach ($this -> languages as $key2 => $lang){
                     $qCat = "INSERT INTO " . TABLE_CATEGORIES_DESCRIPTION . " (categories_id, language_id , categories_name) ";
                     $qCat .= " VALUES('" . $catID . "', '" . $lang['languages_id'] . "', '" . mysql_escape_string($scat) . "')";
                     $ret[] = $qCat;
                     $tmp['categories_id'] = $catID;
                     $tmp['parent_id'] = $parent;
                     $tmp['language_id'] = $lang['languages_id'];
                     $tmp['categories_name'] = $scat;
                     $this -> CatArray[$lang['languages_id']][$scat] = $tmp;
                     }
                 $this -> nextCID++;
                 }
             }
         return $ret;
         }
     function writeCategories(){
         $count = 0;
         #dpO($this -> queryCat, '$this -> queryCat1');
         foreach ($this -> queryCat as $key => $value){
             foreach ($value as $key2 => $value2){
                 # $query .= $value2 . ";\n";
                $query .= $value2 . ";";
                 $tmp = ($value2);
                 # dpO($tmp, '$value2');
                $row = $this -> db -> Execute(($value2));
                 $count++;
                 }
             }
         # dpO($query, '22');
        # $row = $this -> db -> Execute($query);
        return $count;
         }
     }
// ####################################
function doIt(){
     $imp = new import('import_products/categories.txt', 'import_products/import_columns.txt');
     $imp -> CatArray = $imp -> getCategories();
     # dpO($imp -> CatArray, '$imp -> CatArray');
    $imp -> impCatArray = $imp -> importCat2();
     $imp -> nextCID = $imp -> getNextCatID();
     # $x[1] = $imp -> getCatID('EURO-Artikel');
    # $x[2] = $imp -> getCatID('LINDNER EURO-Vordruckalben');
    # $imp -> CatArray = array();
    foreach ($imp -> impCatArray as $key => $value){
         $xx = $imp -> getCatID($value);
         if(is_array ($xx)){
             $imp -> queryCat[] = $xx;
             }
         }
     # $imp -> writeCategories();
    # dpO($imp -> queryCat, 'queryCat');
    if(isset($imp -> queryCat)){
         return $imp -> writeCategories();
         }else{
         return 0;
         }
     }

if (zen_not_null($_GET['action'])){
     switch ($_GET['action']){
     case 'cat2':
         $imp = new import('import_products/categories.txt', 'import_products/import_columns.txt');
         $imp -> CatArray = $imp -> getCategories();
         $x2 = $imp -> importCat2();
         #dpO($x2, 'xx');
         #dpO($imp -> CatArray[1], '$imp->Cat');
         $imp -> Ret = $imp -> getNextCatID();
         break;
         }
     }
# echo $imp.'#########';
?>