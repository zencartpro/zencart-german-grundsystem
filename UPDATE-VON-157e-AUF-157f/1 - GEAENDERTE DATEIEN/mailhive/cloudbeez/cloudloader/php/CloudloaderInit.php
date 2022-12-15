<?php
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 - 2015 MailBeez

  inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License (Version 2)
  [http://www.gnu.org/licenses/gpl-2.0.html]

 */
    

$cloudloader = new Cloudloader();
$cloudloader->dir_permissions = 0755;
$cloudloader->file_permissions = 0755;
if (file_exists($cloudloader->deployDirectory . 'common/images/default_emailheader.gif')) {
    // updating
    $cloudloader->exclude_overwrite = array('catalog/mailhive/common/images/default_emailheader.gif');
}
$cloudloader->exclude_overwrite_package = array(); // PHP8.1 - if array('') all files are excluded? see \CloudloaderBase::check_in_array

$cloudloader->run();

$cloudloader->cleanLog();
@$cloudloader->cleanWorkDirectory();
$cloudloader->log('Host: %s', php_uname());
$cloudloader->log('Operating system: %s', PHP_OS);
$cloudloader->log('Memory limit: %s', ini_get('memory_limit'));
$cloudloader->log('Max execution time: %s', ini_get('max_execution_time'));
