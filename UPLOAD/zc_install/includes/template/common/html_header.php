<?php
/**
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: html_header.php 2021-11-28 17:49:16Z webchills $
 */
?>
<!DOCTYPE html >
<!--[if IE 9]><html class="lt-ie10" <?php echo HTML_PARAMS; ?> > <![endif]-->
<html class="no-js" <?php echo HTML_PARAMS; ?> >

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo META_TAG_TITLE; ?></title>
<!-- <base href="<?php echo str_replace(DIR_FS_ROOT, '', DIR_FS_INSTALL); ?>"> -->
<meta name="robots" content="noindex, nofollow" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_INSTALL_TEMPLATE . 'css/normalize.css'; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_INSTALL_TEMPLATE . 'css/foundation.min.css'; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_INSTALL_TEMPLATE . 'css/stylesheet.css'; ?>" />

<script src="<?php echo DIR_WS_INSTALL_TEMPLATE . 'foundation/modernizr.js'; ?>"></script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="includes/template/foundation/jquery.min.js"><\/script>');</script>
</head>

