<?php
/**
 * @package Image Handler 5.3.6
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018-2026 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2026 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: functions_bmz_io.php 2026-05-16 16:13:51Z webchills $
 */
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    exit('Invalid access');
}

require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/functions_bmz_io.php';

function bmz_clear_cache(): bool
{
    global $bmzConf;
    return remove_dir($bmzConf['cachedir']);
}

function remove_dir(string $dirname): bool
{
    global $messageStack;
    $error = false;
    if ($dir = @dir($dirname)) {
        $dir->rewind();
        while (false !== ($file = $dir->read())) {
            if (!in_array($file, ['.', '..', '.htaccess', '.keep'], true)) {
                if (is_dir($dirname . '/' . $file)) {
                    // another directory, recurse
                    $error = remove_dir($dirname . '/' . $file);
                    // if it was a directory, it should be empty now
                    if (!@rmdir($dirname . '/' . $file)) {
                        $error = true;
                        $messageStack->add('Couldn\'t delete ' . $dirname . '/' . $file . '.', 'error');
                    }
                } else {
                    if (!@unlink($dirname . '/' . $file)) {
                        $error = true;
                        $messageStack->add('Couldn\'t delete ' . $dirname . '/' . $file . '.', 'error');
                    }
                }
            }
        }
        $dir->close();
    }
    return $error;
}
