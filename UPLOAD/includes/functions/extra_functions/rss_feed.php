<?php
/**
 * rss_feed.php
 *
 * @package rss feed
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rss_feed.php, v 2.1.4 14.02.2008 15:26 Andrew Berezin $
 */

@define('RSS_HOMEPAGE_FEED', '');
@define('RSS_DEFAULT_FEED', '');
@define('RSS_TITLE_DELIMITER', ' : ');
@define('RSS_TITLE_DELIMITER2', ' :: ');

  function rss_feed_title($feed=false) {
    global $current_category_id;
    if(!$feed) {
      $feed = $_GET['feed'];
    } else {
      if(($i = strpos($feed, '&')) !== false) {
        $feed_args = substr($feed, $i+1);
        $feed = substr($feed, 0, $i);
      }
    }
    switch (true) {
      case ($feed == 'news'):
          $title = TEXT_RSS_NEWS;
        break;
      case ($feed == 'categories'):
        $title = TEXT_RSS_CATEGORIES;
        if (isset($_GET['cPath']) && $current_category_id > 0) {
          $title .= RSS_TITLE_DELIMITER2 . strip_tags(zen_get_categories_name((int)$current_category_id));
        }
        break;
      case ($feed == 'specials_random'):
      case ($feed == 'specials'):
        $title = TEXT_RSS_SPECIALS;
        break;
      case ($feed == 'featured_random'):
      case ($feed == 'featured'):
        $title = TEXT_RSS_FEATURED_PRODUCTS;
        break;
      case ($feed == 'best_sellers_random'):
      case ($feed == 'best_sellers'):
        $title = TEXT_RSS_BEST_SELLERS;
        break;
      case ($feed == 'upcoming_random'):
      case ($feed == 'upcoming'):
        $title = TEXT_RSS_UPCOMING_PRODUCTS;
        break;
      case ($feed == 'new_products_random'):
      case ($feed == 'new_products'):
        $title = TEXT_RSS_PRODUCTS_NEW;
        break;
      case ($feed == 'products'):
        if (isset($_GET['products_id'])) {
          $title = TEXT_RSS_PRODUCT . RSS_TITLE_DELIMITER2 . strip_tags(zen_get_products_name((int)$_GET['products_id']));
        } elseif (isset($_GET['cPath']) && $current_category_id > 0) {
          $title = TEXT_RSS_PRODUCTS . RSS_TITLE_DELIMITER2 . strip_tags(zen_get_categories_name((int)$current_category_id));
        } else {
          $title = TEXT_RSS_PRODUCTS_ALL;
        }
        break;
      default:
        $title = TEXT_RSS_FEED;
        break;
    }
    return $title;
  }

  function rss_feed_current_page() {
    global $this_is_home_page, $category_depth, $cPath;
    $title = $feed = false;
    if($cPath > 0) $cpath_parm = '&cPath=' . $cPath;
    else $cpath_parm = '';
    switch (true) {
      case ($this_is_home_page):
        if(RSS_HOMEPAGE_FEED != '') {
          $feed = RSS_HOMEPAGE_FEED;
        }
        break;
      case (isset($_GET['products_id'])):
        $feed = 'products&products_id=' . $_GET['products_id'];
        break;
      case ($category_depth == 'products'):
        $feed = 'products' . $cpath_parm;
        break;
      case ($_GET['main_page'] == FILENAME_PRODUCTS_ALL):
        $feed = 'products' . $cpath_parm;
        break;
      case ($category_depth == 'nested' && $cPath > 0):
        $feed = 'categories' . $cpath_parm;
        break;
      case ($_GET['main_page'] == FILENAME_SPECIALS):
        $feed = 'specials';
        break;
      case ($_GET['main_page'] == FILENAME_FEATURED_PRODUCTS):
        $feed = 'featured';
        break;
      case ($_GET['main_page'] == FILENAME_UPCOMING_PRODUCTS):
        $feed = 'upcoming';
        break;
      case ($_GET['main_page'] == FILENAME_PRODUCTS_NEW):
        $feed = 'new_products';
        break;
      case ($_GET['main_page'] == FILENAME_PRODUCTS_NEW):
        $feed = 'news';
        break;
      default:
        if(RSS_DEFAULT_FEED != '') {
          $feed = RSS_DEFAULT_FEED;
        }
        break;
    }
    $title = rss_feed_title($feed);
    return array($feed, $title);
  }

  function rss_feed_link_alternate() {
    $feed_array = array('specials', 'new_products', 'upcoming', 'featured', 'best_sellers'); // 'news'
    $link = '';
    foreach($feed_array as $i => $feed) {
      $link .= '<link rel="alternate" type="application/rss+xml" title="' . rss_feed_title($feed) . '" href="' . zen_href_link(FILENAME_RSS_FEED, 'feed=' . $feed, 'NONSSL', false) . '" />' . "\n";
    }
    list($feed, $title) = rss_feed_current_page();
    if($feed && !in_array($feed, $feed_array)) {
      $link .= '<link rel="alternate" type="application/rss+xml" title="' . $title . '" href="' . zen_href_link(FILENAME_RSS_FEED, 'feed=' . $feed, 'NONSSL', false) . '" />' . "\n";
    }
    return $link;
  }

  function rss_feed_link($img=false) {
    global $template, $current_page_base;
    list($feed, $title) = rss_feed_current_page();
    if($feed) {
      if(!$img) {
        $anchor = $title;
      } else {
        $tpl_dir = $template->get_template_dir($img, DIR_WS_TEMPLATE, $current_page_base, 'images');
        $anchor = zen_image($tpl_dir . '/' . $img, $title);
      }
      $link = '<a href="' . zen_href_link(FILENAME_RSS_FEED, 'feed=' . $feed, 'NONSSL', false) . '" title="' . $title . '" target="_blank">' . $anchor . '</a>' . "\n";
    } else {
      $link = '';
    }
    return $link;
  }

  function rss_feed_href() {
    list($feed, ) = rss_feed_current_page();
    if($feed) {
      $href = zen_href_link(FILENAME_RSS_FEED, 'feed=' . $feed, 'NONSSL', false);
    } else {
      $href = '';
    }
    return $href;
  }

  function rss_feed_name() {
    list($feed, $title) = rss_feed_current_page();
    return $title;
  }
// EOF