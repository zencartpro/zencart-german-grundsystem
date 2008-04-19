<?php
/**                        
 * ajax ::    ajax.common MUST be loaed after the globally scripts
 *
 * @package ajax
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
 
    $autoLoadConfig[500][] = array('autoType'=>'include',
                                'loadFile' => DIR_WS_INCLUDES . 'ajax_javascript_function.php');
    // ajax_common
    $autoLoadConfig[550][] = array('autoType'=>'include',
                                'loadFile' => DIR_WS_INCLUDES . 'ajax.common.php');

?>