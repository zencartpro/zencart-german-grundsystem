<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2016-06-20 17:19:17Z webchills $
 */
 
$zco_notifier->notify('NOTIFY_HEADER_START_DOWNLOAD');

if (!$_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_TIME_OUT));
}
if ((isset($_GET['order']) && !is_numeric($_GET['order'])) || (isset($_GET['id']) && !is_numeric($_GET['id'])) ) {
  zen_redirect(zen_href_link(FILENAME_TIME_OUT));
}
// Check that order_id and customer_id match

$sql = "SELECT customers_id
                        FROM   " . TABLE_ORDERS . "
                        WHERE  orders_id = ordersID";
                        
$sql = $db->bindVars($sql, 'customersID', $_SESSION['customer_id'], 'integer');

$sql = $db->bindVars($sql, 'ordersID', $_GET['order'], 'integer');
$securitycheck = $db->Execute($sql);
if ($securitycheck->fields['customers_id'] != $_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}
require_once(DIR_WS_INCLUDES . 'classes/order.php');
require_once(DIR_WS_INCLUDES . 'classes/class.rl_invoice3.php');
$pdfT = new rl_invoice3($_GET['order'], $paper['orientation'], $paper['unit'], $paper['format']);
$pdfName = $pdfT->getPDFFileName();

if (!file_exists($pdfName)) die('Sorry. File not found. Please contact the webmaster to report this error.<br />c/f: ' . $downloads->fields['orders_products_filename']);

function zen_random_name()
{
  $letters = 'abcdefghijklmnopqrstuvwxyz';
  $dirname = '.';
  $length = floor(zen_rand(16,20));
  for ($i = 1; $i <= $length; $i++) {
    $q = floor(zen_rand(1,26));
    $dirname .= $letters[$q];
  }
  return $dirname;
}

// Unlinks all subdirectories and files in $dir
// Works only on one subdir level, will not recurse
function zen_unlink_temp_dir($dir)
{
  $h1 = opendir($dir);
  while ($subdir = readdir($h1)) {
    // Ignore non directories
    if (!is_dir($dir . $subdir)) continue;
    // Ignore . and .. and CVS
    if ($subdir == '.' || $subdir == '..' || $subdir == 'CVS') continue;
    // Loop and unlink files in subdirectory
    $h2 = opendir($dir . $subdir);
    while ($file = readdir($h2)) {
      if ($file == '.' || $file == '..') continue;
      @unlink($dir . $subdir . '/' . $file);
    }
    closedir($h2);
    @rmdir($dir . $subdir);
  }
  closedir($h1);
}

// disable gzip output buffering if active:
@ob_end_clean();
@ini_set('zlib.output_compression', 'Off');

// determine filename for download
$origin_filename = $pdfName;
$browser_filename = RL_INVOICE3_INVLINK;

// Now send the file with header() magic
// the "must-revalidate" and expiry times are used to prevent caching and fraudulent re-acquiring of files w/o redownloading.
$zv_filesize = filesize($origin_filename);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"$browser_filename\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $zv_filesize);


if (DOWNLOAD_BY_REDIRECT == 'true') {
  // This will work only on Unix/Linux hosts
  zen_unlink_temp_dir(DIR_FS_DOWNLOAD_PUBLIC);
  $tempdir = zen_random_name();
  umask(0000);
  mkdir(DIR_FS_DOWNLOAD_PUBLIC . $tempdir, 0777);
  $download_link = str_replace(array('/','\\'),'_',$browser_filename);
  $link_create_status = @symlink($origin_filename, DIR_FS_DOWNLOAD_PUBLIC . $tempdir . '/' . $download_link);

  if ($link_create_status==true) {
    $zco_notifier->notify('NOTIFY_DOWNLOAD_VIA_SYMLINK___BEGINS');
    header("HTTP/1.1 303 See Other");
    zen_redirect(DIR_WS_DOWNLOAD_PUBLIC . $tempdir . '/' . $download_link);
  }
}

if (DOWNLOAD_BY_REDIRECT != 'true' or $link_create_status==false ) {
  // not downloading by redirect; instead, we stream it to the browser.
  // This happens if the symlink couldn't happen, or if set as default in Admin
  header("Content-Length: " . (string)$zv_filesize);
  if (DOWNLOAD_IN_CHUNKS != 'true') {
    // This will work on all systems, but will need considerable resources
    $zco_notifier->notify('NOTIFY_DOWNLOAD_WITHOUT_REDIRECT___COMPLETED');
    readfile($origin_filename);
  } else {
    // override PHP timeout to 20 minutes, if allowed
    @set_time_limit(1200);
    // loop with fread($fp, xxxx) to allow streaming in chunk sizes below the PHP memory_limit
    $handle = @fopen($origin_filename, "rb");
    while (!@feof($handle)) {
      echo(fread($handle, 4096));
      @flush();
    }
    fclose($handle);
    $zco_notifier->notify('NOTIFY_DOWNLOAD_WITHOUT_REDIRECT_VIA_CHUNKS___COMPLETED');
  }
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_DOWNLOAD');

// finally, upon completion of the download, the script should end here and not attempt to display any template components etc.
zen_exit();
