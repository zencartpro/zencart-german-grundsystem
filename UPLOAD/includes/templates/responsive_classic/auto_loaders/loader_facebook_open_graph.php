<?php
/**
 * facebook loader
 *
 * @package facebook
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2008-2009 RubikIntegration.com
 * @copyright Portions Copyright 2014 Numinix
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: loader_facebook_open_graph.php 2014-03-28 09:34:05 webchills $
 */
                                            
  $loaders[] = array('conditions' => array('pages' => array('*')),
										  'jscript_files' => array(
										    'auto_loaders/facebook_open_graph.php' => 1
										  )
								  );