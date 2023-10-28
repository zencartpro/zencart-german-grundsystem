<?php
/**
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: display_logs.php 2023-10-27 16:49:16Z webchills $
 */
 
define('HEADING_TITLE', 'Display Debug Log Files');

define('TABLE_HEADING_FILENAME', 'Filename');
define('TABLE_HEADING_MODIFIED', 'Date');
define('TABLE_HEADING_FILESIZE', 'Size (b)');
define('TABLE_HEADING_DELETE', 'Selected');
define('TABLE_HEADING_ACTION', 'Action');
define('BUTTON_INVERT_SELECTED' , 'Invert Selection');
define('BUTTON_DELETE_SELECTED', 'Delete Selected');
define('DELETE_SELECTED_ALT', 'Delete all selected files');
define('BUTTON_DELETE_ALL', 'Delete All');
define('DELETE_ALL_ALT', 'Delete all files in the current view');

define('ICON_INFO_VIEW', 'View the contents of this file');

define('DISPLAY_DEBUG_LOGS_ONLY', 'Display debug-logs only?');
define('TEXT_HEADING_INFO', 'File Contents');
define('TEXT_MOST_RECENT', 'most recent');
define('TEXT_OLDEST', 'oldest');
define('TEXT_SMALLEST', 'smallest');
define('TEXT_LARGEST', 'largest');

define('TEXT_INSTRUCTIONS' , '<p>The files may be sorted in ascending or descending order by clicking on the <em>Asc</em> or <em>Desc</em> column links.</p> <p>Click on an %7$s icon to view the contents of the associated file. Only the first %1$u bytes of the selected file will be read/displayed; if a file is &quot;over-sized&quot;, its <em>File Size</em> will be highlighted like <span class="bigfile">this</span>.</p><ul><li><strong>Delete All</strong> will delete all the files currently displayed.</li><li><strong>Delete Selected</strong> will delete only those files with selected checkboxes.</li><li><strong>Invert Selection</strong> will swap checked files for unchecked and vice versa. For example, if you want to delete all but one file, tick the selection for the file to be kept, then "Invert Selection" and finally "Delete Selected".</li></ul><p>Currently viewing the %2$s %3$u of %4$u log files having these prefixes:<br><code>%5$s</code><br>and <b>not</b> matching any (optional) user-defined prefixes: <code>%6$s</code>.</p>');

define('JS_MESSAGE_DELETE_ALL_CONFIRM', 'Are you sure you want to delete these \'+n+\' files?');
define('JS_MESSAGE_DELETE_SELECTED_CONFIRM', 'Are you sure you want to delete the \'+selected+\' selected file(s)?');

define('WARNING_NOT_SECURE','<span class="errorText">NOTE: You do not have SSL enabled. File contents you view from this page will not be encrypted and could present a security risk.</span>');
define('WARNING_NO_FILES_SELECTED', 'No files were selected for deletion!');
define('WARNING_SOME_FILES_DELETED', 'Warning: Only %u of %u log files were deleted; check permissions.');
define('SUCCESS_FILES_DELETED', '%u log files were deleted.');