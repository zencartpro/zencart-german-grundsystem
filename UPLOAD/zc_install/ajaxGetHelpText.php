<?php
/**
 * ajaxGetHelpText.php
 * @package Installer
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxGetHelpText.php 2 2019-04-12 12:59:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

if (isset($_POST['id']))
{
  $result = str_replace('helpId', '' , zen_output_string_protected($_POST['id']));
  $content = "TEXT_HELP_CONTENT_" . strtoupper($result);
  $content = "<p>".constant($content) . "</p>";
  $title = "TEXT_HELP_TITLE_" . strtoupper($result);
  $title = constant($title);
}

echo json_encode(array('text'=>$content, 'title'=>$title));
