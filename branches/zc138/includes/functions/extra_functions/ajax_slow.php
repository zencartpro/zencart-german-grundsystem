<?php
/**          
 * ajax ::    for demonstration
 *
 * @package ajax
 * @copyright Copyright 2007 rainer@langheiter.comn // http://edv.langheiter.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
    function slow_function($t=1)
    {
        $objResponse = new xajaxResponse();
        sleep($t); //we'll do nothing for $t seconds
        $objResponse->addAlert("All done");
        return $objResponse;
    }  
  
?>