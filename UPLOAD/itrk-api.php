<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2022 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: itrk-api.php  2016-05-26 10:13:51Z webchills $
 */

error_reporting(1);
require_once('includes/application_top.php');

require_once('includes/classes/it_recht_kanzlei_api.php');
$xml_input = file_get_contents('php://input');
$xml_output = rawurldecode(str_replace(array('xml=', '+'), array('', ' '), $xml_input));
$api_rechtskanzlei = new it_recht_kanzlei($xml_output);