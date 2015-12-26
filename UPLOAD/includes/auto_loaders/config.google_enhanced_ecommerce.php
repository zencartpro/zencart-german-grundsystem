<?php
/* **********************************************************************
 * Easy Google Analytics
 * **********************************************************************/

if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}


$autoLoadConfig[90][] = array('autoType'=>'class',
                              'loadFile'=>'observers/class.google_enhanced_ecommerce.php');
$autoLoadConfig[90][] = array('autoType'=>'classInstantiate',
                              'className'=>'googleEnhancedEcommerceObserver',
                              'objectName'=>'googleEnhancedEcommerceObserver');
// eof