<?php
/**
 * functions_bmz_image_handler.php
 * call to include IH2 functions from catalog
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id$
 */

require_once(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/functions_bmz_image_handler.php');

global $ihConf;

$ihConf['dir']['admin'] = preg_replace('/^\/(.*)/', '$1', (($request_type == 'SSL') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN));