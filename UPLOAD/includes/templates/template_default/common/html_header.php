<?php
/**
 * Common Template
 *
 * outputs the html header. i,e, everything that comes before the \</head\> tag <br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: html_header.php 859 2016-06-04 19:10:39Z webchills $
 */

$zco_notifier->notify('NOTIFY_HTML_HEAD_START', $current_page_base, $template_dir);

// Prevent clickjacking risks by setting X-Frame-Options:SAMEORIGIN
header('X-Frame-Options:SAMEORIGIN');

/**
 * load the module for generating page meta-tags
 */
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
/**
 * output main page HEAD tag and related headers/meta-tags, etc
 */
?>
<?php
if (!class_exists('Mobile_Detect')) {
  include_once(DIR_WS_CLASSES . 'Mobile_Detect.php');
}
  $detect = new Mobile_Detect;
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta name="language" content="<?php echo META_TAG_LANGUAGE; ?>" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="<?php echo STORE_NAME ?>" />
<meta name="generator" content="Zen-Cart 1.5.5 - deutsche Version, http://www.zen-cart-pro.at" />
<?php if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($current_page_base,explode(",",constant('ROBOTS_PAGES_TO_SKIP'))) || $current_page_base=='down_for_maintenance' || $robotsNoIndex === true) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
<?php if (defined('FAVICON')) { ?>
<link rel="icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<?php } //endif FAVICON ?>

<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>" />
<?php if (isset($canonicalLink) && $canonicalLink != '') { ?>
<link rel="canonical" href="<?php echo $canonicalLink; ?>" />
<?php } ?>
<?php if (RSS_FEED_ENABLED == 'true'){ ?>
<?php echo rss_feed_link_alternate();?>
<?php } ?>
<?php if (GOOGLE_ANALYTICS_ENABLED == 'Enabled'){ ?>
<script type="text/javascript">
var gaProperty = '<?php echo GOOGLE_ANALYTICS_UACCT; ?>';
var disableStr = 'ga-disable-' + gaProperty;
if (document.cookie.indexOf(disableStr + '=true') > -1) { window[disableStr] = true;
}
function gaOptout() {
document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
window[disableStr] = true; }
</script>
<?php } ?>
<script>window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="//code.jquery.com/jquery-1.12.4.min.js"%3E%3C/script%3E'));</script>
<script>window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="<?php echo $template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'); ?>/jquery.min.js"%3E%3C/script%3E'));</script>
<?php
  // BOF hreflang for multilingual sites
  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    $lng = new language;
  }
  reset($lng->catalog_languages);
  while (list($key, $value) = each($lng->catalog_languages)) {
    if ($value['id'] == $_SESSION['languages_id']) continue;
    echo '<link rel="alternate" href="' . ($this_is_home_page ? zen_href_link(FILENAME_DEFAULT, 'language=' . $key, $request_type) : $canonicalLink . '&amp;language=' . $key) . '" hreflang="' . $key . '" />' . "\n";
  }
  // EOF hreflang for multilingual sites
?>

<?php
/**
* load the loader files
*/
$RC_loader_files = array();
if($RI_CJLoader->get('status') && (!isset($Ajax) || !$Ajax->status())){
    $RI_CJLoader->autoloadLoaders();
    $RI_CJLoader->loadCssJsFiles();
    $RC_loader_files = $RI_CJLoader->header();

    foreach($RC_loader_files['meta'] as $file) {
        include($file['src']);
        echo "\n";
    }

    foreach($RC_loader_files['css'] as $file){
        if($file['include']) {
            include($file['src']);
        } else if (!$RI_CJLoader->get('minify_css') || $file['external']) {
            
            echo '<link rel="stylesheet" type="text/css" href="'.$file['src'] .'" />'."\n";
        } else {
            
            echo '<link rel="stylesheet" type="text/css" href="extras/min/?f='.$file['src'].'&amp;'.$RI_CJLoader->get('minify_time').'" />'."\n";
        }
    } 
}
//DEBUG: echo '<!-- I SEE cat: ' . $current_category_id . ' || vs cpath: ' . $cPath . ' || page: ' . $current_page . ' || template: ' . $current_template . ' || main = ' . ($this_is_home_page ? 'YES' : 'NO') . ' -->';
?>
<?php require($template->get_template_dir('super_data_head.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/super_data_head.php'); ?>
<?php
  $zco_notifier->notify('NOTIFY_HTML_HEAD_END', $current_page_base);
?>
</head>
<?php // NOTE: Blank line following is intended: ?>

