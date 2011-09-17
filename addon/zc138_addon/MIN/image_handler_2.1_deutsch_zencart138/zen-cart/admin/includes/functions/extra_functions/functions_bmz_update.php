<?php
/**
 * functions_bmz_update.php
 * functions for automatic patching of the database for various
 * breakmyzencart.com contributions
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: functions_bmz_update.php,v 1.4 2006/05/01 12:12:08 tim Exp $
 */

function bmz_split_version_string($version_string) {
	// determine major version by splitting version string at first '.'
	// e.g. 1.99-beta2 => 1
	$version = array();
	$major_splitpos = strpos($version_string, '.');
	if ($major_splitpos !== FALSE) {
		$version['major'] = intval(substr($version_string, 0, $major_splitpos));
		// determine minor version by splitting version string at last '-'
		// e.g. 1.99-beta2 => 99
		$minor_splitpos = strrpos($version_string, '-');
		if ($minor_splitpos !== FALSE) {
			$version['minor'] = intval(substr($version_string, $major_splitpos + 1, $minor_splitpos - $major_splitpos - 1));
			// determine version suffix by splitting version string at last '-'
			// e.g. 1.99-beta2 => beta2
			$version['suffix'] = substr($version_string, $minor_splitpos + 1);
		} else {
			$version['minor'] = intval(substr($version_string, $major_splitpos) + 1);
		}
	} else {
		$version['major'] = intval($version_string);
	}
	
	return $version;
}

function bmz_needs_update($version_string, $installed_version_string) {
	$version = bmz_split_version_string($version_string);
	$installed_version = bmz_split_version_string($installed_version_string);
	if ($version['major'] > $installed_version['major']) {
		return true;
	}
	if ($version['major'] == $installed_version['major']) {
		if ($version['minor'] > $installed_version['minor']) {
			return true;
		}
		if ($version['minor'] == $installed_version['minor']) {
			// suffix from low to high:
			// beta1 beta2 ... rc1 rc2 ... <empty>
			if  (($version['suffix'] == '') && ($installed_version['suffix'] != '')) {
				return true;
			}
			if ((strpos($version['suffix'], 'rc') !== FALSE) &&
					(strpos($installed_version['suffix'], 'beta') !== FALSE)) {
				return true;
			}
			if ((strpos($version['suffix'], 'rc') !== FALSE) &&
					(strpos($installed_version['suffix'], 'rc') !== FALSE) &&
					(intval(str_replace('rc', '', $version['suffix'])) > intval(str_replace('rc', '', $installed_version['suffix'])))) {
				return true;
			}
			if ((strpos($version['suffix'], 'beta') !== FALSE) &&
					(strpos($installed_version['suffix'], 'beta') !== FALSE) &&
					(intval(str_replace('beta', '', $version['suffix'])) > intval(str_replace('beta', '', $installed_version['suffix'])))) {
				return true;
			}
		}
	}
	return false;
}