<?php
/**
 * Zen Cart German Specific
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: uploads.php 1 2019-07-05 21:31:51Z webchills $
 */

require 'includes/application_top.php';
global $db;
//  Download the user's uploaded file corresponding to $index.
//  A visitor cannot arrive here unless they are validly logged
//  in as the admin, so only the admin of the store should be able
//  to download a file via this mechanism.
function download_file($index, $oid) {
global $db;
//  Look up in the database of upload files, that
//  gives us the original filename the user used.
//  We care about that only to the extent that it
//  gives us an extension, from which we deduce
//  the file type.  We *could* arrange to name the
//  downloaded file per the user's original name,
//  but that is not likely to be helpful to us on
//  the receiving end (who knows what wacky naming
//  convention the user uses?).  Instead, we adopt a uniform
//  naming convention that incorporates the original
//  order ID.  Note: index has already been sanitized.
  $query = "SELECT *
            FROM " . TABLE_FILES_UPLOADED . "
            WHERE files_uploaded_id = " . (int)$index;
  $file = $db->Execute($query);
  if ($file->RecordCount() != 1) {
//  $index has been sanitized and so is safe to echo here.
    die('unknown upload index=' . (int)$index . ' (' . __LINE__ . ')');
  }
  $fileName = $file->fields['files_uploaded_name'];
  $file_extension = strtolower($fext = substr(strrchr($fileName, '.'), 1));
  switch ($file_extension) {
    case 'csv':
      $content = 'text/csv';
      break;
    case 'zip':
      $content = 'application/zip';
      break;
    case 'jpg':
      $content = 'image/jpeg';
      break;
    case 'jpeg':
      $content = 'image/jpeg';
      break;
    case 'gif':
      $content = 'image/gif';
      break;
    case 'png':
      $content = 'image/png';
      break;
    case 'eps':
      $content = 'application/postscript';
      break;
    case 'cdr':
      $content = 'application/cdr';
      break;  //  CorelDRAW
    case 'ai':
      $content = 'application/postscript';
      break;
    case 'pdf':
      $content = 'application/pdf';
      break;
    case 'tif':
      $content = 'image/tiff';
      break;
    case 'tiff':
      $content = 'image/tiff';
      break;
    case 'bmp':
      $content = 'image/bmp';
      break;
    case 'xls':
      $content = 'application/vnd.ms-excel';
      break;
    case 'numbers':
      $content = 'application/vnd.ms-excel';
      break;
    default:
      die('File extension "' . $file_extension . '" not understood (line ' . __LINE__ . ')');
  }
  $fs_path = DIR_FS_CATALOG . 'images/uploads/' . $index . '.' . $fext;
  if (!file_exists($fs_path))
    die('File "' . $fs_path . '" does not exist (' . __LINE__ . ')');
//  We make a download file name consisting of the characters "zc" followed
//  by the order ID followed by the file index, using "_" as a separator.
//  This makes the file names easily recognized on the receiving computer,
//  and lets the admin know what order the file came from.  Note: $oid is sanitized.
  $nfile = 'zc_order' . $oid . '_' . $index . '.' . $fext;
  header('Content-type: ' . $content);
  header('Content-Disposition: attachment; filename="' . $nfile . '"');
  header('Content-Transfer-Encoding: binary');
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
  readfile($fs_path);
}

$get = (isset($_GET['get']) ? (int)$_GET['get'] : '');
$oid = (isset($_GET['oid']) ? (int)$_GET['oid'] : '');

//  If the URL points to a specific file to download,
//  go do that now and abandon further processing.
if (zen_not_null($get)) {
  download_file($get, $oid);
  exit;
}

//  Find the products_option_id corresponding to a customer uploaded file.
$query_opt = "SELECT products_options_types_id AS optid
              FROM " . TABLE_PRODUCTS_OPTIONS_TYPES . "
              WHERE products_options_types_name = '" . PRODUCTS_OPTIONS_TYPES_NAME . "'";
$opts = $db->Execute($query_opt);
if ($opts->RecordCount() != 1)
//  If you get to thie die statement, you probably have something mis-configured.
//  You don't have a product option of type "File" which is unusual (although it's
//  not technically wrong, it's certainly unusual).  Or, you set the value of
//  PRODUCTS_OPTIONS_TYPES_NAME to something other than "File".
  die('Cannot find a product option of type "' . PRODUCTS_OPTIONS_TYPES_NAME . '" (' . __LINE__ . ')');
$optid = $opts->fields['optid'];

//  Determine which page we are displaying, build display list.
$query_files = "SELECT opa.products_options_values AS fname,
                       opa.orders_id AS oid,
                       tor.customers_name AS cname
                FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " AS opa
                LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " AS po ON po.products_options_id = opa.products_options_id
                LEFT JOIN " . TABLE_ORDERS . " AS tor ON opa.orders_id = tor.orders_id
                WHERE po.products_options_type = " . (int)$optid . "
                AND po.language_id = " . (int)$_SESSION['languages_id'] . "
                ORDER BY opa.orders_id DESC";

$splitter = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $query_files, $files_query_numrows);
$files = $db->Execute($query_files);
$filesArray = array();

foreach ($files as $file) {
  $oid = $file['oid'];
//  The file ID and NAME are combined within the products_options_values field
//  in the TABLE_ORDERS_PRODUCTS_ATTRIBUTES table.  So we have to parse that out.
  $opt = $file['fname'];
  $m = preg_match('/^([0-9]+)\.\s*(.*)$/', $opt, $matches);
  if (count($matches) == 3) {
    $fname = $matches[2];
    $upid = $matches[1];
    $link = '<a href="' . zen_href_link(basename($PHP_SELF), 'get=' . $upid . '&oid=' . $oid) . '">' . TABLE_DOWNLOAD . '</a>';
    $status = true;
  } else {
    $fname = $opt;
    $upid = '';
    $status = false;
    $link = '';
  }
  $filesArray[] = array(
    'cname' => $file['cname'],
    'oid' => $file['oid'],
    'fname' => $fname,
    'upid' => $upid,
    'status' => $status,
    'link' => $link
  );
}
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>
    <script>
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById) {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }
    </script>
  </head>
  <body onload="init()">
      <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <div class="container-fluid">
      <h1><?php echo HEADING_TITLE; ?></h1>
      <table class="table table-striped">
        <thead>
          <tr class="dataTableHeadingRow">
            <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_ID; ?></th>
            <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_NAME; ?></th>
            <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?></th>
            <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_FILE; ?></th>
            <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_ID; ?></th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($filesArray as $d) {
              ?>
            <tr>
              <td class="dataTableContent"><?php echo $d['oid']; ?></td>
              <td class="dataTableContent"><?php echo $d['cname']; ?></td>
              <td class="dataTableContent"><?php echo $d['link']; ?></td>
              <td class="dataTableContent"><?php echo $d['fname']; ?></td>
              <td class="dataTableContent"><?php echo $d['upid']; ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
      <div class="row">
        <table class="table">
          <tr>
            <td><?php echo $splitter->display_count($files_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_UPLOADS); ?></td>
            <td><?php echo $splitter->display_links($files_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page'))); ?></td>
          </tr>
        </table>
      </div>
    </div>
    <?php require DIR_WS_INCLUDES . 'footer.php'; ?>
  </body>
</html>
<?php require DIR_WS_INCLUDES . 'application_bottom.php'; ?>
