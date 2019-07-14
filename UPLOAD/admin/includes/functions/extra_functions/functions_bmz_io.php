<?php
/**
 * @package Image Handler
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: functions_bmz_io.php 2018-06-15 16:13:51Z webchills $
 */
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    exit('Invalid access');
}

require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/functions_bmz_io.php';

function bmz_clear_cache() 
{
	global $bmzConf;
	return remove_dir($bmzConf['cachedir']);
}

function remove_dir($dirname) 
{
    global $messageStack;
    $error = false;
    if ($dir = @dir($dirname)) {
        $dir->rewind();
        while (false !== ($file = $dir->read())) {
            //echo $dirname . '/' . $file . '<br />';
            if (($file != ".") && ($file != "..") && ($file != ".htaccess") && ($file != ".keep")) {
                if (is_dir($dirname . '/' . $file)) {
                    // another directory, recurse
                    $error |= remove_dir($dirname . '/' . $file);
                    // if it was a directory, it should be empty now
                    if (!@rmdir($dirname . '/' . $file)) {
                        $error |= true;
                        $messageStack->add('Couldn\'t delete ' . $dirname . '/' . $file . '.', 'error');
                    }
                } else {
                    if (!@unlink($dirname . '/' . $file)) {
                        $error |= true;
                        $messageStack->add('Couldn\'t delete ' . $dirname . '/' . $file . '.', 'error');
                    }
                }
            }
        }
        $dir->close();
    } else {
        $error |= true;
    }
    return $error;
}
