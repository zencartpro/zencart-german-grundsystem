<?php

/**
 * Autoloader array for MailBeez for Zen Cart 1.5+.
 * Mapping MailBeez in the Zen Cart admin menu.
 * 

 */

if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
} 

$autoLoadConfig[142][] = array(
	'autoType' => 'init_script',
	'loadFile' => 'init_mailbeez.php'
	);

?>