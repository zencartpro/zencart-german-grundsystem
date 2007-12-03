<?php
/**
 * @package htmleditors
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: htmlarea.php 4245 2006-08-24 14:07:50Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('BR',"\n");

// INSERTS <SCRIPT> TAGS IN <HEAD> FOR HTMLAREA TO BE CALLED
if ($_SESSION['html_editor_preference_status']=="HTMLAREA") {

//define URL and LANG parameters
  echo '<script type="text/javascript">' .BR;
  echo '   _editor_url = "'.DIR_WS_CATALOG . 'editors/htmlarea/";' .BR;
  echo '	_editor_lang = "'.strtolower($_SESSION['languages_code']).'";' .BR;
  echo '</script>' .BR;

//<!-- load the main HTMLArea files -->
  echo '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'editors/htmlarea/htmlarea.js"></script>' .BR;
//  echo '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'editors/htmlarea/lang/'.strtolower(DEFAULT_LANGUAGE).'.js"></script>' .BR;
//  echo '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'editors/htmlarea/dialog.js"></script>' .BR;
//  echo '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'editors/htmlarea/popupdiv.js"></script>' .BR;
//  echo '<script type="text/javascript" src="' . DIR_WS_CATALOG . 'editors/htmlarea/popupwin.js"></script>' .BR;

//<!-- load the plugins -->
  echo '<script type="text/javascript">' .BR;
      // WARNING: using this interface to load plugin
      // will _NOT_ work if plugins do not have the language
      // loaded by HTMLArea.

      // In other words, this function generates SCRIPT tags
      // that load the plugin and the language file, based on the
      // global variable HTMLArea.I18N.lang (defined in the lang file,
      // in our case "lang/en.js" loaded above).

      // If this lang file is not found the plugin will fail to
      // load correctly and nothing will work.

  echo '      HTMLArea.loadPlugin("TableOperations");' .BR;
  echo '      HTMLArea.loadPlugin("SpellChecker");' .BR;
  //  echo ' }' .BR;
  echo '</script>' .BR;
} 
?>