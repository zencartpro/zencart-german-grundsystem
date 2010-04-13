<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
unset($lines);
$lines[0] = 'ERROR|FsF.php|I';
define('RL_LANGUAGE_BOX', '&Uuml;bersetzen');
define('FILENAME_RL_LANGUAGE', 'rl_language');
if(isset($_SESSION['zendeutsch']) && file_exists(DIR_FS_CATALOG . 'images/zendeutsch.txt') ){
    $lines = @file(DIR_FS_CATALOG . 'images/zendeutsch.txt');  
} else {
    $host = str_replace('http://', '', NEW_VERSION_CHECKUP_URL);
    $host = str_replace('/version_id.txt', '', $host);
    $fp = @fsockopen ($host, 80, $errno, $errstr, 5);
    if (!$fp) {
        if(file_exists(DIR_FS_CATALOG . 'images/zendeutsch.txt') ) {
            $lines = @file(DIR_FS_CATALOG . 'images/zendeutsch.txt');  
        }
    } else {
        $lines = @file(NEW_VERSION_CHECKUP_URL.'.at');  
        if(is_array($lines)){
            $l2 = @file_get_contents(NEW_VERSION_CHECKUP_URL.'.at');        
            #writeMenu($l2, 'images/zendeutsch.txt');   
            writeRL($l2, DIR_FS_CATALOG . 'images/', 'zendeutsch.txt', 'w' );
            $_SESSION['zendeutsch'] = 'zd';
        } 
    }
}
if(is_array($lines)){ 
    foreach ($lines as $key => $valrl) {
        $split = split('\|', $valrl);
        $za_contents[] = array('text'=>$split[0], 'link'=>$split[1]);
    }
    unset($value);
}
#rldp($lines);
#rldp($_SESSION, 'SESS');
