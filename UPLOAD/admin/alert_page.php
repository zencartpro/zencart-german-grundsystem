<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: alert_page.php 2021-11-29 20:01:24Z webchills $
 */
require('includes/application_top.php');
$adminDirectoryExists = $installDirectoryExists = false;
if (substr(DIR_WS_ADMIN, -7) == '/admin/' || substr(DIR_WS_HTTPS_ADMIN, -7) == '/admin/') {
    $adminDirectoryExists = true;
}
$check_path = dirname($_SERVER['SCRIPT_FILENAME']) . '/../zc_install';
if (is_dir($check_path)) {
    $installDirectoryExists = true;
}
if (!$adminDirectoryExists && !$installDirectoryExists) {
    zen_redirect(zen_href_link(FILENAME_DEFAULT));
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Zen Cart!</title>
    <meta name="robots" content="noindex, nofollow">
</head>
<body style="font-family:Helvetica, Arial, sans-serif">
<div style="width:80%;margin: 10% auto auto;border:5px red solid;padding:20px 50px 50px 50px;background-color:#FFAFAF;">
    <h1 style="text-align: center;font-size:40px;color:red;margin:0;"><?php echo HEADING_TITLE; ?></h1>
    <p><?php echo ALERT_PART1; ?></p>
    <ul>
        <?php if ($installDirectoryExists) { ?>
            <li><?php echo ALERT_REMOVE_ZCINSTALL; ?><br><br></li>
        <?php } ?>
        <?php if ($adminDirectoryExists) { ?>
	<li><?php echo ALERT_RENAME_ADMIN; ?><br /><a href="https://www.zen-cart-pro.at/forum/threads/9870-Wie-benenne-ich-das-admin-Verzeichnis-in-Zen-Cart-1-5-x-um" target="_blank"><?php echo ADMIN_RENAME_FAQ_NOTE; ?></a></li>
	<?php  } ?>
	</ul>
    <?php if ($adminDirectoryExists) { ?>
        <br><p><?php echo ALERT_PART2; ?></p>
    <?php } ?>
</div>

</body>
</html>
