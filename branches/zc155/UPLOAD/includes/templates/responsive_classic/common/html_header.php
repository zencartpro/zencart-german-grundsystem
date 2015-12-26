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
 * @version $Id: html_header.php 3 2015-12-26 19:10:39Z webchills $
 */
/**
 * load the module for generating page meta-tags
 */
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
?>

<?php
// ZCAdditions.com, ZCA Responsive Template Default (BOF-addition 1 of 3)
if (!class_exists('Mobile_Detect')) {
  include_once(DIR_WS_CLASSES . 'Mobile_Detect.php'); 
  $detect = new Mobile_Detect;
}
// ZCAdditions.com, ZCA Responsive Template Default (BOF-addition 1 of 3)
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
<?php // ZCAdditions.com, ZCA Responsive Template Default (BOF-addition 2 of 3) ?>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
<?php // ZCAdditions.com, ZCA Responsive Template Default (EOF-addition 2 of 3 ?>
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
<script type="text/javascript">window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"%3E%3C/script%3E'));</script>
<script type="text/javascript">window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="<?php echo $template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'); ?>/jquery.min.js"%3E%3C/script%3E'));</script>

<?php
/**
* load the loader files
*/

if($RI_CJLoader->get('status') && (!isset($Ajax) || !$Ajax->status())){
	$RI_CJLoader->autoloadLoaders();
	$RI_CJLoader->loadCssJsFiles();
	$files = $RI_CJLoader->header();
	foreach($files['css'] as $file)
		if($file['include']) {
      include($file['src']);
    } else if (!$RI_CJLoader->get('minify_css') || $file['external']) {
      echo "<link rel=\"stylesheet\" type=\"text/css\" href='{$file['src']}' />\n";
    } else {
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"extras/min/?f={$file['src']}&amp;".$RI_CJLoader->get('minify_time')."\" />\n";
    }
		
	foreach($files['jscript'] as $file)
		if($file['include']) {
      include($file['src']);
    } else if(!$RI_CJLoader->get('minify_js') || $file['external']) {
      echo "<script type='text/javascript' src='{$file['src']}'></script>\n";
    } else {
      echo "<script type=\"text/javascript\" src=\"extras/min/?f={$file['src']}&amp;".$RI_CJLoader->get('minify_time')."\"></script>\n";
    }
}
//DEBUG: echo '<!-- I SEE cat: ' . $current_category_id . ' || vs cpath: ' . $cPath . ' || page: ' . $current_page . ' || template: ' . $current_template . ' || main = ' . ($this_is_home_page ? 'YES' : 'NO') . ' -->';
?>

<?php // ZCAdditions.com, ZCA Responsive Template Default (BOF-addition 3 of 3)
$responsive_mobile = '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . 'responsive_mobile.css' . '" /><link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . 'jquery.mmenu.all.css' . '" />'; 
$responsive_tablet = '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . 'responsive_tablet.css' . '" /><link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . 'jquery.mmenu.all.css' . '" />'; 
$responsive_default = '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . 'responsive_default.css' . '" />'; 

if (in_array($current_page_base,explode(",",'popup_image,popup_image_additional')) ) {
  echo '';
} else {
  echo '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . 'responsive.css' . '" />';
  if ( $detect->isMobile() && !$detect->isTablet() || $_SESSION['layoutType'] == 'mobile' ) {
    echo $responsive_mobile;
  } else if ( $detect->isTablet() || $_SESSION['layoutType'] == 'tablet' ){
    echo $responsive_tablet;
  } else if ( $_SESSION['layoutType'] == 'full' ) {
    echo '';
  } else {
    echo $responsive_default;
  }
}
?>
  <script type="text/javascript">document.documentElement.className = 'no-fouc';</script>
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<?php // ZCAdditions.com, ZCA Responsive Template Default (EOF-addition 3 of 3) ?>
<?php require($template->get_template_dir('super_data_head.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/super_data_head.php'); ?>
</head>
<?php // NOTE: Blank line following is intended: ?>
