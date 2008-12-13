<?php
/**
 * bmz_io_conf.php
 * filesystem access configuration
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: bmz_io_conf.php,v 1.3 2006/04/11 22:00:55 tim Exp $
 */
 
$bmzConf = array();
$bmzConf['umask']       = 0111;              //set the umask for new files
$bmzConf['dmask']       = 0000;              //directory mask accordingly
//$bmzConf['cachetime']   = 60*60*24;         //maximum age for cachefile in seconds (defaults to a day)
$bmzConf['cachetime']   = 0;         //maximum age for cachefile in seconds (defaults to a day)
$bmzConf['cachedir']    = DIR_FS_CATALOG . 'bmz_cache';
$bmzConf['lockdir']     = DIR_FS_CATALOG . 'bmz_lock';

/* Safemode Hack */
$bmzConf['safemodehack'] = 0;               //read http://wiki.breakmyzencart.com/zen-cart:safemodehack !
$bmzConf['ftp']['host'] = 'localhost';
$bmzConf['ftp']['port'] = '21';
$bmzConf['ftp']['user'] = 'user';
$bmzConf['ftp']['pass'] = 'password';
$bmzConf['ftp']['root'] = DIR_FS_CATALOG;
