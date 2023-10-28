<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tax_classes.php 2023-10-28 19:49:16Z webchills $
 */

define('HEADING_TITLE', 'Tax Classes');

define('TABLE_HEADING_TAX_CLASS_ID', 'ID');
define('TABLE_HEADING_TAX_CLASSES', 'Tax Classes');



define('TEXT_INFO_CLASS_TITLE', 'Tax Class Title:');
define('TEXT_INFO_CLASS_DESCRIPTION', 'Description:');

define('TEXT_INFO_INSERT_INTRO', 'Please enter the new tax class with its related data');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this tax class?');
define('TEXT_INFO_HEADING_NEW_TAX_CLASS', 'New Tax Class');
define('TEXT_INFO_HEADING_EDIT_TAX_CLASS', 'Edit Tax Class');
define('TEXT_INFO_HEADING_DELETE_TAX_CLASS', 'Delete Tax Class');
define('ERROR_TAX_RATE_EXISTS_FOR_CLASS', 'ERROR: Cannot delete this Tax Class -- Tax Rates are currently linked to this Tax Class.');
define('ERROR_TAX_RATE_EXISTS_FOR_PRODUCTS', 'ERROR: Cannot delete this Tax Class -- There are %s products linked to this Tax Class.');