<?php
/**
 * autoloader components to instantiate the seo-url class
 */

$autoLoadConfig[0][] = array('autoType'=>'class',
                             'loadFile'=>'seo.url.php');

// must be 120 since 110 is where the language components are established for the session
$autoLoadConfig[120][] = array('autoType'=>'classInstantiate',
                               'className'=>'SEO_URL',
                               'objectName'=>'seo_urls');

?>