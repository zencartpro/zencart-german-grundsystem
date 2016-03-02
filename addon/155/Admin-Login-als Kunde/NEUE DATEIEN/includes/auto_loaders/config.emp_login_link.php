<?php
// -----
// Part of the Encrypted Master Password plugin, provided by lat9@vinosdefrutastropicales.com
//
// Copyright (C) 2013-2014, Vinos de Frutas Tropicales
//
// @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
//
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}
                    
/*
** Point 200 is after all other initialization is complete.
*/
  $autoLoadConfig[200][] = array('autoType'=>'class',
                                 'loadFile'=>'observers/class.emp_order_observer.php');
  $autoLoadConfig[200][] = array('autoType'=>'classInstantiate',
                                 'className'=>'emp_order_observer',
                                 'objectName'=>'emp_order_observer');