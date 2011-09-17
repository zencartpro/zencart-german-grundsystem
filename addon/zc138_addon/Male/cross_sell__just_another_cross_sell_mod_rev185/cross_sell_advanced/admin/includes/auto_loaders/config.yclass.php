<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}
	$autoLoadConfig[0][] = array('autoType'=>'init_script', 'loadFile'=> 'init_yclass.php'); 
?>