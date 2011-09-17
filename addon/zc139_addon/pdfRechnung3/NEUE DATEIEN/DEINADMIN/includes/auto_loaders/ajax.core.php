<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
} 

  $autoLoadConfig[0][] = array('autoType'=>'class',
                               'loadFile'=>'class.base.php');
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
/**
 * Breakpoint 30.
 * 
 * $zc_cache = new cache(); 
 * 
 */

/**
 * Breakpoint 40.
 * 
 * require('includes/init_includes/init_db_config_read.php');
 * 
 */
  $autoLoadConfig[40][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_db_config_read.php');
/**
 * Breakpoint 50.
 * 
 * $sniffer = new sniffer();
 * require('includes/init_includes/init_sefu.php'); 
 * $phpBB = new phpBB();
 */

/**
 * Breakpoint 60.
 * 
 * require('includes/init_includes/init_general_funcs.php'); 
 * require('includes/init_includes/init_tlds.php'); 
 * 
 */
  $autoLoadConfig[60][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_general_funcs.php');
/**
 * Include PayPal-specific functions
 * require('includes/modules/payment/paypal/paypal_functions.php');
 */


/**
 * Breakpoint 70.
 * 
 * require('includes/init_includes/init_sessions.php'); 
 * 
 */
  $autoLoadConfig[70][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_sessions.php');
/**
 * Breakpoint 80.
 * 
 * if(!$_SESSION['cart']) $_SESSION['cart'] = new shoppingCart();
 * 
 */
/**
 * Breakpoint 90.
 * 
 * currencies = new currencies();
 * 
 */
/**
 * Breakpoint 100.
 * 
 * require('includes/init_includes/init_sanitize.php'); 
 * $template = new template_func();
 * 
 */
  $autoLoadConfig[100][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_sanitize.php');
/**
 * Breakpoint 110.
 * 
 * require('includes/init_includes/init_languages.php'); 
 * require('includes/init_includes/init_templates.php'); 
 * 
 */
/**
 * Breakpoint 120.
 * 
 * require('includes/init_includes/init_currencies.php'); 
 * 
 */
/**
 * Breakpoint 150.
 * 
 * require('includes/init_includes/init_admin_auth.php');
 * 
 */
/** 
/**
 * Breakpoint 170.
 * 
 * require('includes/languages/english/checkout_process.php');
 * 
 */

