<?php
/**
 * @package IH3 Admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright 2005-2006 Tim Kroeger (original author)
 * @revisited by ckosloff/DerManoMann/C Jones/Nigelt74/K Hudson/Nagelkruid
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * 2011-05-13 12:46:50 webchills$
 */

require_once(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/functions_bmz_image_handler.php');

global $ihConf;

$ihConf['dir']['admin'] = preg_replace('/^\/(.*)/', '$1', (($request_type == 'SSL') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN));