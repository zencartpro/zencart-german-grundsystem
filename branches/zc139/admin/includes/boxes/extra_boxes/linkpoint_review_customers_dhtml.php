<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
?>
<?php
  if (defined('MODULE_PAYMENT_LINKPOINT_API_STATUS') && MODULE_PAYMENT_LINKPOINT_API_STATUS == 'True')
    $za_contents[] = array('text' => BOX_CUSTOMERS_LINKPOINT_REVIEW, 'link' => zen_href_link(FILENAME_LINKPOINT_REVIEW, '', 'NONSSL'));
?>