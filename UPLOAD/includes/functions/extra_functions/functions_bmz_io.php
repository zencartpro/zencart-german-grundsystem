<?php
/**
 * @package Image Handler 5.3.0
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018-2022 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: functions_bmz_io.php 2022-09-06 08:13:51Z webchills $
 */

/**
 * Tries to lock a file
 *
 * Locking uses directories inside $bmzConf['lockdir']
 *
 * It waits maximal 3 seconds for the lock, after this time
 * the lock is assumed to be stale and the function goes on
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Tim Kroeger <tim@breakmyzencart.com>
 */
function io_lock($file)
{
    global $bmzConf;
    // no locking if safemode hack
    //if ($bmzConf['safemodehack']) return;

    $lockDir = $bmzConf['lockdir'] . '/' . md5($file);
    ignore_user_abort(true);

    $timeStart = time();
    do {
        //waited longer than 3 seconds? -> stale lock
        if ((time() - $timeStart) > 3) break;
        $locked = mkdir($lockDir);
    } while ($locked === false);
}

/**
 * Unlocks a file
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Tim Kroeger <tim@breakmyzencart.com>
 */
function io_unlock($file)
{
    global $bmzConf;

    // no locking if safemode hack
    //if($bmzConf['safemodehack']) return;

    $lockDir = $bmzConf['lockdir'] . '/' . md5($file);
    rmdir($lockDir);
    ignore_user_abort(false);
}

//-bof-IH5.0.1-lat9-getCacheName function moved to bmz_image_handler_class.php

/**
 * Create the directory needed for the given file
 *
 * @author  Andreas Gohr <andi@splitbrain.org>
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 */
function io_makeFileDir($file)
{
    global $messageStack, $bmzConf;

    $dir = dirname($file);
    $dmask = $bmzConf['dmask'];
    umask($dmask);
    if (!is_dir($dir)){
        io_mkdir_p($dir) || $messageStack->add("Creating directory $dir failed", "error");
    }
    umask($bmzConf['umask']);
}

/**
 * Creates a directory hierachy.
 *
 * @link    http://www.php.net/manual/en/function.mkdir.php
 * @author  <saint@corenova.com>
 * @author  Andreas Gohr <andi@splitbrain.org>
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 */
function io_mkdir_p($target)
{
    global $bmzConf;

    if (empty($target) || is_dir($target)) return 1; // best case check first
    if (file_exists($target) && !is_dir($target)) return 0;
    //recursion
    if (io_mkdir_p(substr($target, 0, strrpos($target, '/')))) {
        return mkdir($target, 0755); // crawl back up & create dir tree
    }
    return 0;
}

