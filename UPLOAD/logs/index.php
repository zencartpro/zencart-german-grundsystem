<?php
/**
 * @package main
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version GIT: $Id: Author: DrByte  Tue Aug 28 16:48:39 2012 -0400 New in v1.5.1 $
 */

// send to domain root
    session_write_close();
    header('Location: ' . 'http://' . $_SERVER['HTTP_HOST']);
    exit();
