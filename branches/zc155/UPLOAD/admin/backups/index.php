<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 730 2014-02-08 08:13:51Z webchills $
 */
//

// send to domain root
    session_write_close();
    header('Location: ' . 'http://' . $_SERVER['HTTP_HOST']);
    exit();
?>