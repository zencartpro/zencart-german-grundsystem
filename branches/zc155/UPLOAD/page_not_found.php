<?php
/**
 * Handler for page not found errors
 * 
 * Generates a 301 Moved permanently error and redirects to index.php?main_page=page_not_found
 * Especially useful as for Google indexing
 *
 * @package general
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: page_not_found.php 729 2011-08-09 15:49:16Z hugo13 $
 */
/*
* redirect to the page_not_found page after sending spiders the "moved" message
*/
header("HTTP/1.1 301 Moved Permanently");
header("Location: index.php?main_page=page_not_found");
?>