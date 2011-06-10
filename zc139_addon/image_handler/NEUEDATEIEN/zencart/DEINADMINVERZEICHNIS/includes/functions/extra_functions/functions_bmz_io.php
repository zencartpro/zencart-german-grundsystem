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

require_once(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/functions_bmz_io.php');

function bmz_clear_cache() {
	global $bmzConf;
	return remove_dir($bmzConf['cachedir']);
}

function remove_dir($dirname) {
  global $messageStack;
  $error = false;
  if ($dir = @dir($dirname)) {
    $dir->rewind();
    while ($file = $dir->read()) {
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
