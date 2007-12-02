<?php
/**
 * autoloader array for nochex_apc application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: nochex_apc.core.php 6557 2007-07-05 06:25:29Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}
/**
 *
 * require(DIR_WS_CLASSES . 'class.base.php');
 * require(DIR_WS_CLASSES . 'class.notifier.php');
 * $zco_notifier = new notifier()'
 * require(DIR_WS_CLASSES . 'mime.php');
 * require(DIR_WS_CLASSES . 'email.php');
 * require(DIR_WS_CLASSES . 'boxes.php');
 * require(DIR_WS_CLASSES . 'category_tree.php');
 * require(DIR_WS_CLASSES . 'cache.php');
 * require(DIR_WS_CLASSES . 'sniffer.php');
 * require(DIR_WS_CLASSES . 'shopping_cart.php');
 * require(DIR_WS_CLASSES . 'navigation_history.php');
 * require(DIR_WS_CLASSES . 'currencies.php');
 * require(DIR_WS_CLASSES . 'message_stack.php');
 * require(DIR_WS_CLASSES . 'template_func.php');
 * require(DIR_WS_CLASSES . 'split_page_results.php');
 * require(DIR_WS_CLASSES . 'breadcrumb.php');
 * require(DIR_WS_CLASSES . 'language.php');
 *
 */
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'class.base.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'class.notifier.php');
  $autoLoadConfig[0][] = array('autoType'=>'classInstantiate',
                                'className'=>'notifier',
                                'objectName'=>'zco_notifier');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=> 'class.phpmailer.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=> 'class.smtp.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=> 'boxes.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'category_tree.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'template_func.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'language.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'cache.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'sniffer.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'shopping_cart.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'navigation_history.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'currencies.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'message_stack.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'breadcrumb.php');
/**
 * Breakpoint 10.
 *
 * require('includes/init_includes/init_database.php');
 * require('includes/version.php');
 *
 */
  $autoLoadConfig[10][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_file_db_names.php');
  $autoLoadConfig[10][] = array('autoType'=>'init_script',
                                'loadFile'=>'init_database.php');
/**
 * Breakpoint 20.
 *
 * require('includes/init_includes/init_file_db_names.php');
 *
 */
  $autoLoadConfig[20][] = array('autoType'=>'include',
                                'loadFile'=> DIR_WS_INCLUDES . 'version.php');
/**
 * Breakpoint 30.
 *
 * $zc_cache = new cache();
 *
 */
  $autoLoadConfig[30][] = array('autoType'=>'classInstantiate',
                                'className'=>'cache',
                                'objectName'=>'zc_cache');
/**
 * Breakpoint 40.
 *
 * require('includes/init_includes/init_db_config_read.php');
 *
 */
  $autoLoadConfig[40][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_db_config_read.php');
/**
 * Breakpoint 60.
 *
 * require('includes/init_includes/init_general_funcs.php');
 * require('includes/init_includes/init_tlds.php');
 *
 */
  $autoLoadConfig[60][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_general_funcs.php');
  $autoLoadConfig[60][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_tlds.php');
/**
 * Include Nochex functions
 * require('includes/modules/payment/nochex_apc/nochex_functions.php');
 */

  $autoLoadConfig[60][] = array('autoType'=>'include',
                                'loadFile'=> DIR_WS_MODULES . 'payment/nochex_apc/nochex_functions.php');

/**
 * Breakpoint 70.
 *
 * require('includes/init_includes/init_sessions.php');
 *
 */
  $autoLoadConfig[70][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_sessions.php');
  $autoLoadConfig[70][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_nochex_apc_sessions.php');

/**
 * Breakpoint 80.
 *
 * if(!$_SESSION['cart']) $_SESSION['cart'] = new shoppingCart();
 *
 */
  $autoLoadConfig[80][] = array('autoType'=>'classInstantiate',
                                'className'=>'shoppingCart',
                                'objectName'=>'cart',
                                'checkInstantiated'=>true,
                                'classSession'=>true);
/**
 * Breakpoint 90.
 *
 * currencies = new currencies();
 *
 */
  $autoLoadConfig[90][] = array('autoType'=>'classInstantiate',
                                'className'=>'currencies',
                                'objectName'=>'currencies');
/**
 * Breakpoint 100.
 *
 * require('includes/init_includes/init_sanitize.php');
 * $template = new template_func();
 *
 */
  $autoLoadConfig[100][] = array('autoType'=>'classInstantiate',
                                 'className'=>'template_func',
                                 'objectName'=>'template');
  $autoLoadConfig[100][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_sanitize.php');
/**
 * Breakpoint 110.
 *
 * require('includes/init_includes/init_languages.php');
 * require('includes/init_includes/init_templates.php');
 *
 */
  $autoLoadConfig[110][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_languages.php');
  $autoLoadConfig[110][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_templates.php');
/**
 * Breakpoint 120.
 * 
 * require('includes/init_includes/init_currencies.php'); 
 * 
 */
  $autoLoadConfig[120][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_currencies.php');
/**
 * Breakpoint 170.
 * 
 * require('includes/languages/english/checkout_process.php');
 * 
 */
  $autoLoadConfig[170][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_ipn_postcfg.php');



?>