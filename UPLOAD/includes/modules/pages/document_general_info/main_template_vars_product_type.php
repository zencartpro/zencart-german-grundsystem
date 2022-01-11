<?php
/**
 * main_template_vars_product_type.php
 * This file contains all the logic to prepare $vars for use in the product-type-specific template
 * It pulls data from all the related tables which collectively store the info related only to this product type.
 *
 * @package productTypes
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: main_template_vars_product_type.php 2011-08-09 15:49:16Z hugo13 $
 */
/*
 * This file contains all the logic to prepare $vars for use in the product-type-specific template
 * It pulls data from all the related tables which collectively store the info related only to this product type.
 */

  // This should be first line of the script:
  $zco_notifier->notify('NOTIFY_PRODUCT_TYPE_VARS_START_DOCUMENT_GENERAL_INFO');

/**
 * Retrieve relevant data from relational tables, for the current products_id:
 */


// Nothing special to do here for primary product_info type


/*
 * extract info from queries for use as template-variables:
 */

//nothing special to do here for this product type


// This should be last line of the script:
$zco_notifier->notify('NOTIFY_PRODUCT_TYPE_VARS_END_DOCUMENT_GENERAL_INFO');