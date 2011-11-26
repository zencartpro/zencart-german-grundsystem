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
			if  ((isset($version['suffix'])) && ($version['suffix'] == '') && ($installed_version['suffix'] != '')) {
				return true;
			}
			if ((isset($version['suffix'])) && (strpos($version['suffix'], 'rc') !== FALSE) &&
					(strpos($installed_version['suffix'], 'beta') !== FALSE)) {
				return true;
			}
			if ((isset($version['suffix'])) && (strpos($version['suffix'], 'rc') !== FALSE) &&
					(strpos($installed_version['suffix'], 'rc') !== FALSE) &&
					(intval(str_replace('rc', '', $version['suffix'])) > intval(str_replace('rc', '', $installed_version['suffix'])))) {
				return true;
			}
			if ((isset($version['suffix'])) && (strpos($version['suffix'], 'beta') !== FALSE) &&
					(strpos($installed_version['suffix'], 'beta') !== FALSE) &&
					(intval(str_replace('beta', '', $version['suffix'])) > intval(str_replace('beta', '', $installed_version['suffix'])))) {
				return true;
			}
		}
	}
	return false;
}
