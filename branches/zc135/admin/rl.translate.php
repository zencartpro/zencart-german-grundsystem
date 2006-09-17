<?php
/**
 * @package languageDefines
 * @copyright Copyright 2006 rainer langheiter, http://edv.langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

require('includes/application_top.php');

$translate = new translate();
/** 
* @desc if in rl_translate_config the debug enties set, then display infos
*/
$translate->rldp($translate->config, 'root', __FILE__.' :: '.__LINE__);

/**
* @desc empty the translation table
*/
if(true == $translate->getConf('truncateTable')){
    $sql = "TRUNCATE TABLE " . $translate->getConf('transTable', 'table');
    $db->Execute($sql);
}
/**
* @desc reread all the language files & store entries in the database
*/
if(true == $translate->getConf('reReadFiles')){
    echo 'fill database table . ';
    // ORI
    $ld = $translate->getLanguageFiles($translate->getLangDirs());
    $translate->setLanguageFiles($ld, 'english');
    $translate->readKeyFile($ld, $translate->getConf('version', 'ORI'),$translate->getConf('languages_id', 'ORI'));

    // COMPARE
    $ld = $translate->getLanguageFiles($translate->getLangDirs($translate->getConf('absPath2LangDir', 'COMPARE'), $translate->getConf('languageName', 'COMPARE')));
    $translate->setLanguageFiles($ld, $translate->getConf('languageName', 'COMPARE'));
    $translate->readKeyFile($ld, $translate->getConf('version', 'COMPARE'), $translate->getConf('languages_id', 'COMPARE'));
}

/** 
* @desc loop through the db & write the language-files && display "running output""
*/
$sql = 'SELECT DISTINCT keypath FROM ' . $translate->getConf('transTable', 'table') . ' limit 0,299999';
$res = $db->Execute($sql);
echo '<hr>'.$res->recordCount().'  create new languages files<br />';
while (!$res->EOF){
    $translate->compareFiles($res->fields['keypath'], $translate->getConf('version', 'ORI'), $translate->getConf('version', 'COMPARE'));
    echo $res->fields['keypath']."<br />";
    ob_flush();
    flush();
    $res->moveNext();
}

/** display the work/protocol
* includeStatus OK/ERROR
* are there deleted or not translated defines in the language files
*/
$translate->rldp($translate->transLog, 'transLog', __FILE__.' :: '.__LINE__);

?>