<?php
/**
 * Handler for page not found errors
 * 
 * Generates a 301 Moved permanently error and redirects to index.php?main_page=page_not_found
 * Especially useful as for Google indexing
 *
 * @package general
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
/*
* redirect to the page_not_found page after sending spiders the "moved" message
*/
header("HTTP/1.1 301 Moved Permanently");
header("Location: index.php?main_page=page_not_found");
?>