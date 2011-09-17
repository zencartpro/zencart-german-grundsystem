<?php
/**
 * export_customerdata.php
 *
 * @package export_customerdata
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: export_customerdata 675 2010-10-27 10:19:41Z webchills $
 */
define('BOX_EXPORT_CUSTOMERDATA', 'Export customer data');
define('HEADING_TITLE', 'Export customer data as csv - Version 1.0');
define('TEXT_EXPORT_CUSTOMERDATA_OVERVIEW', 'This tool generates a csv file with the current customer data.<br/>The following values are exported:<ul><li>Prename</li><li>Name</li><li>Email</li><li>Company</li><li>Street</li><li>Address 2</li><li>Post Code</li><li>City</li><li>Phone</li></ul>Click the Button to generate and download the csv file:<br/>');
define('TEXT_EXPORT_CUSTOMERDATA_INFO', '<b>Note:</b><br/>If you are exceriencing strange behaviour with German Umlauts in Microsoft Excel, try Open Office instead and select as character set utf-8 when opening the file in OpenOffice.<br/><br/>Free download of Open Office at: <br/><a href="http://www.openoffice.org" target="_blank">http://www.openoffice.org</a>');