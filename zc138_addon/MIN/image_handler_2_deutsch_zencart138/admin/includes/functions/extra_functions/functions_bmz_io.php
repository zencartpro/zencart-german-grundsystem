<?php
/**
 * functions_bmz_io.php
 * admin filesystem functions for image handler
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: functions_bmz_io.php,v 1.2 2006/04/11 22:00:55 tim Exp $
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
      if (($file != ".") && ($file != "..")) {
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
