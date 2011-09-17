<?php
/**
* @package Pages
* @copyright Copyright 2008-2009 RubikIntegration.com
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: link.php 149 2009-03-04 05:23:35Z yellow1912 $
*/                                             
  $loaders[] = array('conditions' => array('pages' => array('*')),
										  'jscript_files' => array(
										    'auto_loaders/facebook_open_graph.php' => 1
										  )
								  );