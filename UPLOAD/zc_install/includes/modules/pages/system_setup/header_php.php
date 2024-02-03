<?php
/**
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2024-02-02 13:30:16Z webchills $
 */
[
    $adminDir,
    $documentRoot,
    $adminServer,
    $catalogHttpServer,
    $catalogHttpUrl,
    $catalogHttpsServer,
    $catalogHttpsUrl,
    $dir_ws_http_catalog,
    $dir_ws_https_catalog,
] = getDetectedURIs();

$db_type = 'mysql';

$enableSslCatalog = '';
if ($request_type === 'SSL') {
    $enableSslCatalog = 'checked = checked';
}
