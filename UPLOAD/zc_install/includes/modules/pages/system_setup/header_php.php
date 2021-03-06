<?php
/**
 * @package Installer
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 4 2015-12-29 19:49:16Z webchills $
 */
list($adminDir, $documentRoot, $adminServer, $catalogHttpServer, $catalogHttpUrl, $catalogHttpsServer, $catalogHttpsUrl, $dir_ws_http_catalog, $dir_ws_https_catalog) = getDetectedURIs();
$db_type = 'mysql';
$enableSslCatalog = '';
if ($request_type == 'SSL') {
    $enableSslCatalog = 'checked = checked';
}
