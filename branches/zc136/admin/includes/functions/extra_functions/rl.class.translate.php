<?php
/**
 * @package languageDefines
 * @copyright Copyright 2006 rainer langheiter, http://edv.langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

class translate {
    var $db;
    var $ZCVersion;
    var $keyPathArr;
    var $languageFiles;
    var $configKey;
    var $config;
    var $transLog;
    
    /** 
    * @desc 
    */
    function translate()
    {
        global $db;
        $this->db = $db;
        require('rl_translate_config.php');
        $this->config = $config;
        if(!existTable($this->getConf('transTable', 'table'))){
            $sql = $this->getConf('sql', 'table');
            $this->rldp($sql, __function__, 'CREATE TABLE TRANSLATION '.__FILE__.__LINE__);
            $this->db->execute($sql);
        }
    } 

    /**
    * @desc  override the config-file entries
    */
    function setConfig($configKey, $param){
        $param = (array) $param;
        $this->config[$configKey] = (array)$this->config[$configKey];
        $this->config[$configKey] = array_merge($this->config[$configKey], $param);
    } 

    /** 
    * @desc get a config entry
    */
    function getConf($param, $key='all'){
        if(is_null($param)){
            return $this->config[$key];
        } else {
            return $this->config[$key][$param];
        }
    }

    /**
    * @desc shows arrays structered   
    */
    function rldp($call, $cname = 'NIX', $zus='')
    {
        $dg = $this->getConf($cname, 'debug');
         if(true == $dg){
             echo '<br />' . $cname.':: ('.$zus . ") :<pre>";
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
    /**
    * @desc stolen from developers_tool_kit.php
    */
    function getLangDirs($path = '/opt/lampp/htdocs/zencart-german/branches/zc135/', $language = 'english', $template_dir = 'template_default')
    {
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $template_dir . '/' . $language . '/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/' . $template_dir . '/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/extra_definitions/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/extra_definitions/' . $template_dir . '/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/modules/payment/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/modules/shipping/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/modules/order_total/';
        $langDirs[] = $path . DIR_WS_LANGUAGES . $language . '/modules/product_types/';
        $langDirs[] = $path . 'zc_install/' . DIR_WS_LANGUAGES . $language . '/';
        $langDirs[] = $path . 'admin/' . DIR_WS_LANGUAGES . $language . '/';
        $langDirs[] = $path . 'admin/' . DIR_WS_LANGUAGES . $language . '/modules/newsletters/';
        $langDirs[] = $path . 'admin/' . DIR_WS_LANGUAGES . '' . $language . '.php'; 
        $langDirs[] = $path . '' . DIR_WS_LANGUAGES . '' . $language . '.php'; 
        $langDirs[] = $path . 'zc_install/' . DIR_WS_LANGUAGES . '' . $language . '.php'; 

        return $langDirs;
    } 
    
    /**
    * @desc build a list from all language-files
    * @param $ld dir-list
    */
    function getLanguageFiles($ld=array(), $language){
        $tmp2 = array();
        $l = array();
        foreach ($ld as $key => $value) {
            if(file_exists($value)){
                if(substr($value, -4)=='.php'){
                    $l[] = $value;
                } else {
                    $tmp = $this->directoryToArray($value, false, '.php');
                }
                $tmp2 = array_merge_recursive($tmp2, $tmp, $l);
            }
        }
        
        $tmp = array();
        foreach ($tmp2 as $key => $value) {
            $tmp[$value] = 1;
        }
        $tmp2 = array();
        foreach ($tmp as $key => $value) {
            $tmp2[]=$key;
        }
        return $tmp2;
    }
    
    function setLanguageFiles($files, $language='english'){
        $this->languageFiles[$language] = $files;
    }
    
    /**
    * @desc helper function to get files recursivley from a directory
    */
    function directoryToArray($directory, $recursive, $ext = 'at.php')
    {
        $recursion = __FUNCTION__;
        $extlen = strlen($ext) * -1;
        $array_items = array();
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($directory . "/" . $file)) {
                        if ($recursive) {
                            $array_items = array_merge($array_items, $this->directoryToArray ($directory . "/" . $file, $recursive, $ext));
                        } 
                        $file = $directory . "/" . $file;
                        $xx = substr($file, $extlen);
                        if (substr($file, $extlen) == $ext) {
                            $array_items[] = preg_replace("/\/\//si", "/", $file);
                        } 
                    } else {
                        $file = $directory . "/" . $file;
                        if (substr($file, $extlen) == $ext) {
                            $array_items[] = preg_replace("/\/\//si", "/", $file);
                        } 
                    } 
                } 
            } 
            closedir($handle);
        } else {
            // echo($directory);
        } 
        return $array_items;
    } 

    /**
    * @desc read a language-file & split the entries into comments/code & defines & write this into the db
    */
    function readKeyFile($filename, $version, $language){
        $fn = (array) $filename;
        $this->setZCVersion($version);
        $this->writeLanguage= $language;
        foreach ($fn as $key => $filename) {
            echo '. ';
            ob_flush();
            flush();
            $this->replaceKeyPath($filename);
            $handle = fopen ($filename, "r");
            $subject = fread ($handle, filesize ($filename));
            $this->xx[] = $subject;
            fclose ($handle);
            
            preg_match_all('%^ *//.*%m', $subject, $result, PREG_PATTERN_ORDER);$result = $result[0];
            foreach ($result as $key => $value) {
                $v2 = preg_replace('%^ *//%', '', $value);
            }            
            preg_match_all('/^ *define\\(([\\s\\S]*?)\\);\\s?/m', $subject, $result, PREG_SET_ORDER);
            for ($matchi = 0; $matchi < count($result); $matchi++) {
                $sp = strpos($subject, '' . $result[$matchi][0]);
                if (false == $sp) {
                    // no comment
                } else {
                    $f = substr($subject, 0, $sp-1);
                    $t = strlen(trim($f));
                    if (0 != $t) {
                        $f = $this->replaceInFile($f);
                        $this->insertKey('@@@COMM@@@', $f, $filename);
                    } 
                    $sp += strlen($result[$matchi][0]);
                    $subject = substr($subject, $sp);
                } 
                $x = explode(',', $result[$matchi][1], 2);
                $this->insertKey($x[0], $x[1], $filename);
            } 
            $tmp = substr(rtrim($this->replaceInFile($subject), $filename), 0, -2);
            $this->insertKey('@@@COMM@@@', $tmp, $filename);
        }
    }
    /** 
    * @desc helper 
    */
    function replaceKeyPath($filePath){
         $patterns[0] = '/\/' . $this->getConf('languageName', 'COMPARE') . '\//';
         $patterns[1] = '/\/' . $this->getConf('languageName', 'ORI')     . '\//';
         $replacements[1] = '/LANGUAGE/';
         $replacements[0] = '/LANGUAGE/';
         $keypath = preg_replace($patterns, $replacements, $filePath);
         
         /**
         * @desc special case root entries in language-dir 
         */
         $patterns[0] = '/\/' . $this->getConf('languageName', 'COMPARE') . '.php/';
         $patterns[1] = '/\/' . $this->getConf('languageName', 'ORI')     . '.php/';
         $replacements[1] = '/LANGUAGE.php';
         $replacements[0] = '/LANGUAGE.php';
         $keypath = preg_replace($patterns, $replacements, $keypath);
         
         $patterns[0] = $this->getConf('absPath2LangDir', 'ORI');
         $patterns[1] = $this->getConf('absPath2LangDir', 'COMPARE');     
         $keypath = str_replace($patterns, '', $keypath);
         $this->keyPathArr = $keypath;
         return $keypath;
    }
    function getKeyPath($ind=1){
        return $this->keyPathArr;
        return $this->keyPathArr[$ind];
    }
    /**
    * @desc helper to insert the keys
    */
    function insertKey($key, $value, $path=NULL)
    {
        $sql = "INSERT INTO " . $this->getConf('transTable', 'table') . " (languages_id, keyword, keyvalue, version, filenamepath, keypath )
                    VALUES ('".$this->writeLanguage."', '" . trim(mysql_escape_string($key)) . "', '" . (mysql_escape_string($value)) . "', '".$this->getZCVersion()."', '".$path."', '".$this->getKeyPath(1)."')";
        $this->db->execute($sql);
    }  
    /**
    * @desc  
    */
    function setZCVersion($version){
        $this->ZCVersion = $version;
    }
    function getZCVersion(){
        return $this->ZCVersion;
    }
    /**
    * @desc 
    */
    function replaceInFile($content){
        $rw = $this->getConf(NULL, 'trans');
        foreach ($rw as $key => $value) {
            $content = str_replace($key, $value, $content);
        } 
        return $content;
    }     
    /**
    * @desc compare language-file & mark entries for deletion & translating
    */

     function compareFiles($filename, $v1, $v2){
         $v1 = $this->getConf(NULL, 'ORI');
         $v2 = $this->getConf(NULL, 'COMPARE');
         $fn = 'LANGUAGE/' . $filename;
         $fn = $filename;
         $sql1 = "SELECT * FROM " . $this->getConf('transTable', 'table'). " WHERE version IN ('{$v1['version']}','{$v2['version']}') AND keypath='{$fn}'  ORDER BY id";
         $this->rldp($v2, __FUNCTION__, __FILE__.__LINE__);
         $res = $this -> db -> Execute($sql1);
         $i = 0;
         while (!$res -> EOF){
             #if($res -> fields['languages_id'] == $this -> config[$v2]['languages_id'] && $res -> fields['keyword'] != '@@@COMM@@@'){
             if($res->filds['keypath']=='admin/includes/languages/german.php'){
                #$res->filds['keypath']=='admin/includes/languages/english.php';
             }
             if($res -> fields['languages_id'] == $v2['languages_id'] && $res -> fields['keyword'] != '@@@COMM@@@'){
                 $germanKeys[$res -> fields['keyword']] = $res -> fields;
                 }
             if($res -> fields['languages_id'] == $v1['languages_id']){
                 if($res -> fields['keyword'] == '@@@COMM@@@'){
                     $englishKeys[$res -> fields['keyword'] . $i] = $res -> fields ;
                     $lastKey = $res -> fields['keyword'] . $i;
                     }else{
                     $englishKeys[$res -> fields['keyword']] = $res -> fields ;
                     }
                 }
             if($res -> fields['keyword'] == '@@@COMM@@@'){
                 $comp[$res -> fields['keyword'] . $i][$res -> fields['languages_id']] = $res -> fields ;
                 }else{
                 $comp[$res -> fields['keyword']][$res -> fields['languages_id']] = $res -> fields ;
                 }
             if($res -> fields['languages_id'] == $v1['languages_id']){
                 $i++;
                 }
             $res -> MoveNext();
             }
             
         $diffGerman = array_diff_assoc((array)$germanKeys, (array)$englishKeys);
         foreach ($diffGerman as $key => $value) {
            if(false === strpos($key, '@@@COMM@@@')){
                $diffGerman[$key]['flag'] = 'del';
                $germanKeys[$key]['flag'] = 'del';
            }
         }
         $diffEnglish = array_diff_assoc((array)$englishKeys, (array)$germanKeys);
         foreach ($diffEnglish as $key => $value) {
            if(false === strpos($key, '@@@COMM@@@')){
                $diffEnglish[$key]['flag'] = 'trans';
            }
         }
         
         $gggg = array_merge((array)$englishKeys, (array)$diffEnglish, (array)$diffGerman);
         foreach($gggg as $key => $val){
             if(is_array($germanKeys[$key])){
                 $gggg[$key] = $germanKeys[$key];
                 }
             }
         $fn = $this -> getConf('absPath2LangDir', 'NEW') . $filename;
         $filename = str_replace('/LANGUAGE/', '/'.$this->getConf('languageName', 'COMPARE').'/', $fn);
         $filename = str_replace('/LANGUAGE.php', '/'.$this->getConf('languageName', 'COMPARE').'.php', $filename);
         $fn = str_replace($this->getConf('absPath2LangDir', 'COMPARE'), '', $filename);

         $this -> writeLangFile($gggg, $fn);
         if(true==$this->getConf('testInclude')){
             $ret = $this->ChkInc($fn);
            if(true == $this->ChkInc($fn)){
                #$this->transLog['includeStatus'][$fn]='OK';
                $this->transLog['includeStatus']['OK'][]=$fn;
            } else {
                #$this->transLog['includeStatus'][$fn]='ERROR';
                $this->transLog['includeStatus']['ERROR']=$fn;
            }
         }
         $this->rldp($gggg, compareFiles, __LINE__);
         return $gggg;
         }

    /**
    * @desc helper function for marking defines     
    */
    function makeDefine($val){
        switch ($val['flag']) {
           case 'del':
            $v = $this->getConf('version', 'ORI');
            $cont = "/**\ndeleted in version {$v}\ndefine(" . $val['keyword'] . "," . $val['keyvalue'] . ");\n*/\n";
            $this->transLog[$val['keypath']][] = $cont;
        
             break;
           case 'trans':
                $cont = "define(" . $val['keyword'] . "," . $val['keyvalue'] . ");\t// !!!TRANSLATE!!!\n";
                $cont = "define(" . $val['keyword'] . "," . $val['keyvalue']." . ' !!!TRANSLATE!!! file: ".$val['keypath'] .' at line '. __LINE__. "');\n";
                $this->transLog[] = $cont;
             break;
           default:
                $cont = "define(" . $val['keyword'] . "," . $val['keyvalue'] . ");\n";
             break;
        }
        return $cont;
    }
    
    /**
    * @desc write language-file physically
    */
    function writeLangFile($data, $filename){
        $this->rldp($data, 'writeLangFile', __LINE__);
        
         $this -> makeDirs(dirname($filename));
         if (!file_exists($filename)){
             touch($filename); // Create blank file
             chmod($filename, 0777);
             }
         if (is_writable($filename)){
             if (!$handle = fopen($filename, 'w')){
                 echo "Cannot open file ($filename)";
                 exit;
                 }
             $cont = '';
             foreach($data as $key => $val){
                 if(is_array($val)){
                     if($val['keyword'] == '@@@COMM@@@'){
                         $cont .= $val['keyvalue'] . "\n";
                         }else{
                         $cont .= $this->makeDefine($val);
                     }
                 }
             }
             $cont .= "\n?>";
             if (fwrite($handle, $cont) === FALSE){
                 echo "Cannot write to file ($filename)";
                 exit;
                 }
            
             $this -> log[] = $filename;
            
             fclose($handle);
            
             }else{
             echo "The file $filename is not writable";
             }
         }
        
     /**
     * @desc  helper function for making dirs
     */
     function makeDirs($strPath, $mode = 0777){ // creates directory tree recursively
         return is_dir($strPath) or ($this -> makeDirs(dirname($strPath), $mode) and mkdir($strPath, $mode));
         }
     /**
     * @desc look at: gillis dot php at TAKETHISAWAY dot gillis dot fi 14-Apr-2005 11:47
     *                  http://de.php.net/manual/de/function.include.php
     */
    function ChkInc($file){
       if(substr(exec("php -l $file"), 0, 28) == "No syntax errors detected in"){
       return true;
       }else{
       return false;
       }
    }
} 
?>
