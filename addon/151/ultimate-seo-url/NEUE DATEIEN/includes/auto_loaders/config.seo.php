<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

/**
 * autoloader components to instantiate the seo-url class
 */

$autoLoadConfig[0][] = array(
	'autoType'=>'class',
	'loadFile'=>'seo.url.php'
);

// sessions are started at 70
$autoLoadConfig[71][] = array(
	'autoType'=>'init_script',
	'loadFile'=> 'init_seo_config.php'
);

// must be 120 since 110 is where the language components are established for the session
$autoLoadConfig[120][] = array(
	'autoType'=>'classInstantiate',
	'className'=>'SEO_URL',
	'objectName'=>'seo_urls'
);