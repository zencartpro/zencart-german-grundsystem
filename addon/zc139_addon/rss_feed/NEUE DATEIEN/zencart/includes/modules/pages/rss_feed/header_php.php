<?php
/**
 * rss_feed header_php.php
 *
 * @package rss feed
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php, v 2.1.4 14.02.2008 15:26 Andrew Berezin $
 */
// <a href="http://feedvalidator.org/check.cgi?url=..."><img src="valid-rss.png" alt="[Valid RSS]" title="Validate my RSS feed" /></a>
// Google Base namespace (http://www.google.com/base/help/rss_specs.html?hl=en_US);
// Google Base tags (http://base.google.com/base/help/attributes.html);
//  @ini_set('display_errors', '1');
//  error_reporting(E_ALL);

// http://www.disobey.com/detergent/2002/extendingrss2/
@define('RSS_UTM_ACTIVE', 'false');
@define('RSS_UTM_SOURCE', 'rss');
@define('RSS_UTM_MEDIUM', 'rssfeed');
@define('RSS_UTM_TERM', '');
@define('RSS_UTM_CONTENT', '');
@define('RSS_UTM_CAMPAIGN', '');

@define('RSS_BUYNOW_LINK', 'false');
@define('RSS_DEFAULT_IMAGE_SIZE', 'small'); // \'small\', \'medium\', \'large\'
@define('RSS_CACHE_TIME', '10');

@define('DIR_FS_RSSFEED_CACHE', DIR_FS_SQL_CACHE);
@define('RSS_ERROR_CACHE_DIR', 'Cache directory not found "' . DIR_FS_RSSFEED_CACHE . '"');


require_once(DIR_WS_CLASSES . 'rss_feed.php');

$rss = new rss_feed();

if(RSS_CACHE_TIME > 0) {
	$rss->rssFeedCahcheSet(true);
} else {
	$rss->rssFeedCahcheSet(false);
}

  $rss->rss_feed_encoding(CHARSET);
  $rss->rss_feed_content_type('text/xml'); // 'application/rss+xml'
  $rss->rss_feed_set('ttl', RSS_TTL);

if(!$rss->rss_feed_cache($_SERVER['QUERY_STRING'], RSS_CACHE_TIME*60)) {

  // Google Base and Custom Namespaces - http://base.google.com/support/bin/answer.py?answer=58085
  $rss->rss_feed_xmlns('xmlns:g="http://base.google.com/ns/1.0"');
  $rss->rss_feed_xmlns('xmlns:c="http://base.google.com/cns/1.0"');

  // "Ecommerce RSS" Module Specification (ERSS) - http://shopping.discovery.com/erss/
//  $rss->rss_feed_xmlns('xmlns:ecommerce="http://shopping.discovery.com/erss');

//  $rss->rss_feed_xmlns('xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"');
//  $rss->rss_feed_xmlns('xmlns:admin="http://webns.net/mvcb/"');
//  $rss->rss_feed_xmlns(array('xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"', 'xmlns:content="http://purl.org/rss/1.0/modules/content/"'));

  $directory_array = array();
  $tpl_dir = $template->get_template_dir('rss(.*)\.css', DIR_WS_TEMPLATE, $current_page_base, 'css');
  $directory_array = $template->get_template_part($tpl_dir ,'/^rss/', '.css');
  foreach ($directory_array as $value) {
    $rss->rss_feed_style(HTTP_SERVER . DIR_WS_CATALOG . $tpl_dir . '/' . $value);
  }
  $tpl_dir = $template->get_template_dir('rss(.*)\.xsl', DIR_WS_TEMPLATE, $current_page_base, 'css');
  $directory_array = $template->get_template_part($tpl_dir ,'/^rss/', '.xsl');
  foreach ($directory_array as $value) {
    $rss->rss_feed_style(HTTP_SERVER . DIR_WS_CATALOG . $tpl_dir . '/' . $value);
  }

  if (is_file($template->get_template_dir(RSS_IMAGE, DIR_WS_TEMPLATE, $current_page_base, 'images') . '/' . RSS_IMAGE)) {
    $image = zen_href_link($template->get_template_dir(RSS_IMAGE, DIR_WS_TEMPLATE, $current_page_base, 'images') . '/' . RSS_IMAGE, '', 'NONSSL', false, true, true);
  } elseif (is_file(DIR_FS_CATALOG . DIR_WS_IMAGES . RSS_IMAGE)) {
    $image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . RSS_IMAGE;
  } else {
    $image = false;
  }
  $rss->rss_feed_image((RSS_IMAGE_NAME == '' ? STORE_NAME : RSS_IMAGE_NAME), HTTP_SERVER . DIR_WS_CATALOG, $image);

  $rss_title = (RSS_TITLE == '' ? STORE_NAME : RSS_TITLE);
  $rss_title .= RSS_TITLE_DELIMITER . rss_feed_title();

  $rss->rss_feed_description_set(RSS_ITEMS_DESCRIPTION, RSS_ITEMS_DESCRIPTION_MAX_LENGTH);
  $rss->rss_feed_set('title', $rss_title);
  $rss->rss_feed_set('link', HTTP_SERVER . DIR_WS_CATALOG);
  $rss->rss_feed_set('description', RSS_DESCRIPTION);
  $rss->rss_feed_set('lastBuildDate', date('r'));
  $rss->rss_feed_set('generator', 'Zen-Cart v. ' . RSS_FEED_VERSION . ' RSS 2.0 Feed');
  $rss->rss_feed_set('copyright', 'Copyright &copy; ' . date('Y') . ' ' . (RSS_COPYRIGHT == ''? STORE_OWNER : RSS_COPYRIGHT));
  $rss->rss_feed_set('managingEditor', (RSS_MANAGING_EDITOR == ''? STORE_OWNER_EMAIL_ADDRESS . " (" . STORE_OWNER . ")" : RSS_MANAGING_EDITOR));
  $rss->rss_feed_set('webMaster', (RSS_WEBMASTER == ''? STORE_OWNER_EMAIL_ADDRESS . " (" . STORE_OWNER . ")" : RSS_WEBMASTER));
  $rss->rss_feed_set('language', $_SESSION["languages_code"]);

  $additionalURL = '';
  if($_SESSION["languages_code"] != DEFAULT_LANGUAGE) {
    $additionalURL .= '&language=' . $_SESSION["languages_code"];
  }
  if(isset($_GET["ref"])) {
    $additionalURL .= '&ref=' . $_GET["ref"];
  }
  if(isset($_GET["utm_source"]) && isset($_GET["utm_medium"])) {
    $additionalURL .= '&utm_source=' . $_GET["utm_source"] . '&utm_medium=' . $_GET["utm_medium"];
    if($_GET["utm_term"] != '') $additionalURL .= '&utm_term=' . $_GET["utm_term"];
    if($_GET["utm_content"] != '') $additionalURL .= '&utm_content=' . $_GET["utm_content"];
    if($_GET["utm_campaign"] != '') $additionalURL .= '&utm_campaign=' . $_GET["utm_campaign"];
  } elseif (RSS_UTM_ACTIVE == 'true' && RSS_UTM_SOURCE != '' && RSS_UTM_MEDIUM != '') {
    $additionalURL .= '&utm_source=' . RSS_UTM_SOURCE . '&utm_medium=' . RSS_UTM_MEDIUM;
    if(RSS_UTM_TERM != '') $additionalURL .= '&utm_term=' . RSS_UTM_TERM;
    if(RSS_UTM_CONTENT != '') $additionalURL .= '&utm_content=' . RSS_UTM_CONTENT;
    if(RSS_UTM_CAMPAIGN != '') $additionalURL .= '&utm_campaign=' . RSS_UTM_CAMPAIGN;
  }

  $random = false;

  if(isset($_GET['products_id'])) $_GET['products_id'] = (int)$_GET['products_id'];

  $limit = "";
  if(isset($_GET['limit'])) {
    if((int)$_GET['limit'] > 0) {
      $limit = " LIMIT " . (int)$_GET['limit'];
    }
  } elseif ((int)RSS_PRODUCTS_LIMIT > 0) {
    $limit = " LIMIT " . (int)RSS_PRODUCTS_LIMIT;
  }

  switch($_GET["feed"]) {

/*
    case "orders":
      if(isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])) {
        $message = false;
        $admin_name = zen_db_prepare_input($_SERVER["PHP_AUTH_USER"]);
        $admin_pass = zen_db_prepare_input($_SERVER["PHP_AUTH_PW"]);
        $sql = "select admin_id, admin_name, admin_pass from " . TABLE_ADMIN . " where admin_name = '" . zen_db_input($admin_name) . "'";
        $result = $db->Execute($sql);
        if (!($admin_name == $result->fields['admin_name'])) {
          $message = true;
          $pass_message = ERROR_WRONG_LOGIN;
        }
        if (!zen_validate_password($admin_pass, $result->fields['admin_pass'])) {
          $message = true;
          $pass_message = ERROR_WRONG_LOGIN;
        }
        if ($message == false) {
          $_SESSION['admin_id'] = $result->fields['admin_id'];
          zen_redirect(zen_href_link(FILENAME_DEFAULT, '', 'SSL'));
        }
      } else {
        $message = true;
      }
      break;
*/

    case "news":
      require_once(DIR_WS_FUNCTIONS . 'news.php');
      $date_selector = $db->Execute("SELECT news_date_published
                                     FROM " . TABLE_NEWS_ARTICLES . "
                                     WHERE news_status = '1'
                                       AND to_days(news_date_published) <= to_days(now())
                                     GROUP BY news_date_published DESC
                                     LIMIT " . (int)NEWS_RSS_FEED_NUMBER_OF_DAYS);
      while (!$date_selector->EOF) {
        $article = $db->Execute("SELECT n.article_id, na.author_name, na.author_email, nt.news_article_name, nt.news_article_text, nt.news_article_shorttext, n.news_image, nt.news_image_text, n.news_date_published
                                 FROM " . TABLE_NEWS_ARTICLES . " n
                                   LEFT JOIN " . TABLE_NEWS_ARTICLES_TEXT . " nt ON (n.article_id = nt.article_id AND nt.language_id = " . (int)$_SESSION['languages_id'] . "), " .
                                          TABLE_NEWS_AUTHORS . " na
                                 WHERE n.authors_id = na.authors_id
                                   AND n.news_status = '1'
                                   AND n.news_date_published = '" . $date_selector->fields['news_date_published'] . "'
                                 ORDER BY n.sort_order");
        while (!$article->EOF) {
          $xtags = array();
          $link = zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $article->fields['article_id'] . $additionalURL, 'NONSSL', false);
          $rss->rss_feed_item($article->fields['news_article_name'],
                              $link,
                              array('url' => $link, 'PermaLink' => true),
                              date('r', strtotime($article->fields['news_date_published'])),
                              news_create_news_summary($article->fields['news_article_text'], $article->fields['news_article_shorttext']),
                              $article->fields['news_image'],
                              zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $article->fields['article_id'] . $additionalURL, 'NONSSL', false),
                              $article->fields['author_name'] . " <" . $article->fields['author_email'] . ">",
                              false,
                              false,
                              $xtags
                              );
          $article->MoveNext();
        }
        $date_selector->MoveNext();
      }
      break;

    case "categories":
      // don't build a tree when no categories
      $check_categories = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_status = '1' limit 1");
      if ($check_categories->RecordCount() > 0) {
        if(isset($_GET['cPath'])) {
          $categories = $db->Execute("SELECT c.categories_id, c.parent_id, GREATEST(c.date_added, IFNULL(c.last_modified, 0)) AS categories_date, c.categories_image, cd.categories_name, cd.categories_description
                                      FROM " . TABLE_CATEGORIES . " c
                                        LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd on c.categories_id = cd.categories_id
                                      WHERE c.parent_id = " . (int)$id_parent . "
                                        AND cd.language_id = " . (int)$_SESSION['languages_id'] . "
                                        AND c.categories_status= '1'
                                      ORDER BY c.sort_order, cd.categories_name",
                                      '', false, 150);

          if(!$categories->EOF) {
            $link_categories = addslashes(zen_href_link(FILENAME_DEFAULT, 'cPath=' . $cPath . $additionalURL, 'NONSSL', false));
            $rss->rss_feed_item($categories->fields['categories_name'],
                                $link_categories,
                                array('url' => $link_categories, 'PermaLink' => true),
                                date('r', strtotime($categories->fields['categories_date'])),
                                $categories->fields['categories_description'],
                                $categories->fields['categories_image'],
                                false,
                                (RSS_AUTHOR == ''? STORE_OWNER_EMAIL_ADDRESS . " <" . STORE_OWNER . ">" : RSS_AUTHOR)
                                );
            if(!isset($_GET['limit']) || (int)$_GET['limit'] >1) {
              zen_rss_category_tree($current_category_id, $cPath, isset($_GET['limit']) ? ((int)$_GET['limit']-1) : 32767);
            }
          }
        } else {
          zen_rss_category_tree(0, '', isset($_GET['limit']) ? (int)$_GET['limit'] : 32767);
        }
      }
      break;

    case "specials_random":
      $random = true;
      $rss->rssFeedCahcheSet(false);
      $limit = " LIMIT " . MAX_RANDOM_SELECT_SPECIALS;
    case "specials":
      $specials_product_query = "SELECT DISTINCT p.products_id, pd.products_name, pd.products_description, p.products_image, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0)) AS products_date, p.products_price, p.products_tax_class_id, s.specials_new_products_price as price, p.products_quantity, p.products_model, p.products_weight, p.manufacturers_id, m.manufacturers_name, r.reviews_rating
                                 FROM " . TABLE_PRODUCTS . " p
                                   LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (pd.products_id = p.products_id)
                                   LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)
                                   LEFT JOIN " . TABLE_REVIEWS . " r ON (p.products_id = r.products_id)
                                   LEFT JOIN " . TABLE_SPECIALS . " s ON (p.products_id = s.products_id)
                                 WHERE p.products_status = 1
                                   AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
                                   AND s.status = 1 " . $limit;
      zen_rss_products($specials_product_query, $random);
      break;

    case "featured_random":
      $random = true;
      $rss->rssFeedCahcheSet(false);
      $limit = " LIMIT " . MAX_RANDOM_SELECT_FEATURED_PRODUCTS;
    case "featured":
      $featured_products_query = "SELECT DISTINCT p.products_id, pd.products_name, pd.products_description, p.products_image, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0)) AS products_date, p.products_price_sorter as price, p.products_tax_class_id, p.products_quantity, p.products_model, p.products_weight, p.manufacturers_id, m.manufacturers_name, r.reviews_rating
                                  FROM " . TABLE_PRODUCTS . " p
                                    LEFT JOIN " . TABLE_FEATURED . " f on p.products_id = f.products_id
                                    LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id
                                    LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)
                                    LEFT JOIN " . TABLE_REVIEWS . " r ON (p.products_id = r.products_id)
                                  WHERE p.products_status = 1
                                   AND f.status = '1'
                                   AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
                                  ORDER BY pd.products_name DESC" . $limit;
      zen_rss_products($featured_products_query, $random);
      break;

    case "best_sellers_random":
      $random = true;
      $rss->rssFeedCahcheSet(false);
      $limit = " LIMIT " . MAX_DISPLAY_BESTSELLERS;
    case "best_sellers":
      $where_cat = $from_cat = "";
      if (isset($current_category_id) && ($current_category_id > 0)) {
        if (RSS_PRODUCTS_CATEGORIES == 'all') {
          $from_cat = ", " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c ";
          $where_cat = " AND p.products_id = p2c.products_id
                         AND c.categories_id = " . (int)$current_category_id . "
                         AND p2c.categories_id = " . (int)$current_category_id . " ";
        } else {
          $where_cat = " AND p.master_categories_id = " . (int)$current_category_id . " ";
        }
      }
      $best_sellers_query = "SELECT DISTINCT p.products_id, pd.products_name, pd.products_description, p.products_image, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0)) AS products_date, p.products_ordered, p.products_price_sorter as price, p.products_tax_class_id, p.products_quantity, p.products_model, p.products_weight, p.manufacturers_id, m.manufacturers_name, r.reviews_rating
                             FROM " . TABLE_PRODUCTS . " p
                               LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (pd.products_id = p.products_id)
                               LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)
                               LEFT JOIN " . TABLE_REVIEWS . " r ON (p.products_id = r.products_id)
                             " . $from_cat . "
                             WHERE p.products_status = 1
                               AND p.products_ordered > 0
                               AND pd.language_id = " . (int)$_SESSION['languages_id'] . $where_cat ."
                             ORDER BY p.products_ordered DESC, pd.products_name" . $limit;
      zen_rss_products($best_sellers_query, $random);
      break;

    case "upcoming_random":
      $random = true;
      $rss->rssFeedCahcheSet(false);
      $limit = " LIMIT " . MAX_DISPLAY_UPCOMING_PRODUCTS;
    case "upcoming":
      $where_cat = $from_cat = "";
      $display_limit = zen_get_upcoming_date_range();
      if (isset($current_category_id) && ($current_category_id > 0)) {
        if (RSS_PRODUCTS_CATEGORIES == 'all') {
          $from_cat = ", " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c ";
          $where_cat = "AND p.products_id = p2c.products_id
                        AND c.categories_id = " . (int)$current_category_id . "
                        AND p2c.categories_id = " . (int)$current_category_id . " ";
        } else {
          $where_cat = "AND p.master_categories_id = " . (int)$current_category_id . " ";
        }
      }
      $expected_query = "SELECT DISTINCT p.products_id, pd.products_name, pd.products_description, p.products_image, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0)) AS products_date, p.products_date_available as date_expected, p.products_price_sorter as price, p.products_tax_class_id, p.products_quantity, p.products_model, p.products_weight, p.manufacturers_id, m.manufacturers_name, r.reviews_rating
                         FROM " . TABLE_PRODUCTS . " p
                           LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (pd.products_id = p.products_id)
                           LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)
                           LEFT JOIN " . TABLE_REVIEWS . " r ON (p.products_id = r.products_id)
                         " . $from_cat . "
                         WHERE to_days(products_date_available) >= to_days(now())
                           AND p.products_status = 1
                           AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
                         " . $where_cat . "
                         " . $display_limit . "
                         ORDER BY " . EXPECTED_PRODUCTS_FIELD . " " . EXPECTED_PRODUCTS_SORT . $limit;
      zen_rss_products($expected_query, $random);
      break;

    case "new_products_random":
      $random = true;
      $rss->rssFeedCahcheSet(false);
      $limit = " LIMIT " . MAX_RANDOM_SELECT_NEW;
    case "new_products":
      $disp_order_default = PRODUCT_NEW_LIST_SORT_DEFAULT;
      require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_LISTING_DISPLAY_ORDER));
      $where_days = zen_get_new_date_range();

    case "products":
    default:
      $where_cat = $from_cat = "";
      if (isset($current_category_id) && ($current_category_id > 0)) {
        if (RSS_PRODUCTS_CATEGORIES == 'all') {
        $from_cat = ", " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c ";
        $where_cat = "AND p.products_id = p2c.products_id
                      AND c.categories_id = " . (int)$current_category_id . "
                      AND p2c.categories_id = " . (int)$current_category_id . " ";
        } else {
          $where_cat = "AND p.master_categories_id = " . (int)$current_category_id . " ";
        }
      }
      $where_prod = '';
      if(isset($_GET['products_id'])) {
        $where_prod = " AND p.products_id=" . (int)$_GET['products_id'];
        $limit = " LIMIT 1";
      } else if(isset($_GET['products_model'])) {
        $where_prod = " AND p.products_model=" . zen_db_input(zen_db_prepare_input($_GET['products_model']));
      }
      if(!isset($order_by)) $order_by = " ORDER BY p.products_last_modified DESC, p.products_sort_order";
      if(!isset($where_days)) $where_days = '';
      $sql_products = "SELECT DISTINCT p.products_id, pd.products_name, pd.products_description, p.products_image, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0)) AS products_date, p.master_categories_id, p.products_price_sorter AS price, p.products_tax_class_id, p.products_quantity, p.products_model, p.products_weight, p.manufacturers_id, m.manufacturers_name, r.reviews_rating
                       FROM " . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (p.products_id = pd.products_id)
                         LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)
                         LEFT JOIN " . TABLE_REVIEWS . " r ON (p.products_id = r.products_id)
                         " . $from_cat . "
                       WHERE pd.language_id = " . (int)$_SESSION['languages_id'] . "
                         AND p.products_status = 1
                         " . $where_cat . "
                         " . $where_days . "
                         " . $where_prod . "
                         " . $order_by . "
                         " . $limit;
      zen_rss_products($sql_products, $random);
      break;
  }

}

  function zen_rss_products($sql_products, $random){
    global $db, $currencies, $rss, $additionalURL;

    $imageSize = (isset($_GET['imgsize']) ? $_GET['imgsize'] : RSS_DEFAULT_IMAGE_SIZE);

//IFNULL(, 0)??????
    $sql_maxdate = "SELECT GREATEST(MAX(products_date_added), MAX(IFNULL(products_last_modified, 0))) as max_date
                    FROM " . TABLE_PRODUCTS . "
                    WHERE products_status = 1";
    $maxdate = $db->Execute($sql_maxdate);
    if(!$maxdate->EOF) {
      $rss->rss_feed_set('lastBuildDate', date('r', strtotime($maxdate->fields['max_date'])));
    }

    if ($random) {
      $products = zen_random_select($sql_products);
    } else {
      $products = $db->Execute($sql_products);
    }
    $cashTaxRate = array();
    while(!$products->EOF) {
      $info_page = zen_get_info_page($products->fields['products_id']);
      $xtags = array();

      if(RSS_PRODUCTS_PRICE == 'true' && $products->fields['price'] > 0) {
        if(!isset($cashTaxRate[$products->fields['products_tax_class_id']])) {
          $cashTaxRate[$products->fields['products_tax_class_id']] = zen_get_tax_rate($products->fields['products_tax_class_id']);
        }
        $xtags['g:price'] = number_format(zen_add_tax($products->fields['price']*$currencies->get_value($_SESSION['currency']), $cashTaxRate[$products->fields['products_tax_class_id']]), $currencies->get_decimal_places($_SESSION['currency']), '.', '');
//      $xtags['c:price_formatted type="string"'] = zen_get_products_display_price($products->fields['products_id']);
//        $xtags['c:price_formatted type="string"'] = $currencies->display_price($products->fields['price'], $cashTaxRate[$products->fields['products_tax_class_id']]);
      }
      if(RSS_PRODUCTS_CURRENCY == 'true') $xtags['g:currency'] = ($_SESSION["currency"] == 'RUR' ? 'RUB' : $_SESSION["currency"]);
      if(RSS_PRODUCTS_ID == 'true') $xtags['g:id'] = $products->fields['products_id'];
      if(RSS_PRODUCTS_WEIGHT == 'true' && $products->fields['products_weight'] > 0) $xtags['g:weight'] = $products->fields['products_weight'];
      if(RSS_PRODUCTS_BRAND == 'true' && zen_not_null($products->fields['manufacturers_name'])) $xtags['g:brand'] = $rss->_clear_string($products->fields['manufacturers_name']);
      if(RSS_PRODUCTS_QUANTITY == 'true' && $products->fields['products_quantity'] > 0) $xtags['g:quantity'] = $products->fields['products_quantity'];
      if(RSS_PRODUCTS_MODEL == 'true' && zen_not_null($products->fields['products_model'])) $xtags['g:model_number'] = $rss->_clear_string($products->fields['products_model']);
      if(RSS_PRODUCTS_RATING == 'true' && zen_not_null($products->fields['reviews_rating'])) $xtags['g:rating'] = $products->fields['reviews_rating']; // rating - The rating of the item. Format: Text. XML example: <g:rating>4 stars</g:rating>
/*
image_link
The URL of an associated image for the item. Use your full-sized images; do not use thumbnail images.
If you do not have an image available, leave the attribute blank.
Do not include logos or an image that says, "Image not available."
Format:
URL. (Must include the http:// portion.) Up to 10 URLs can be included.
For XML, include each URL as a separate <image_link> attribute.
XML example:
<g:image_link>http://www.example.com/image1.jpg</g:image_link>
<g:image_link>http://www.example.com/image2.jpg</g:image_link>
*/
      if(RSS_PRODUCTS_IMAGES == 'true' && zen_not_null($products->fields['products_image'])) {
        $products_image = ltrim($products->fields['products_image'], '/');
        require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));
        switch ($imageSize) {
          case 'small':
          $xtags['g:image_link'][0] = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $rss->_clear_url($products_image);
            break;
          case 'medium':
          $xtags['g:image_link'][0] = HTTP_SERVER . DIR_WS_CATALOG . $rss->_clear_url($products_image_medium);
            break;
          case 'large':
          default:
          $xtags['g:image_link'][0] = HTTP_SERVER . DIR_WS_CATALOG . $rss->_clear_url($products_image_large);
            break;
        }
        if(isset($_GET['products_id']) || isset($_GET['products_model'])) {
          require(DIR_WS_MODULES . zen_get_module_directory('additional_images.php'));
          $num_images = min(9, $num_images);
          for ($i=0, $n=$num_images; $i<$n; $i++) {
            $file = $images_array[$i];
            $products_image_large = str_replace(DIR_WS_IMAGES, DIR_WS_IMAGES . 'large/', $products_image_directory) . str_replace($products_image_extension, '', $file) . IMAGE_SUFFIX_LARGE . $products_image_extension;
            $flag_has_large = file_exists($products_image_large);
            $products_image_large = ($flag_has_large ? $products_image_large : $products_image_directory . $file);
            $xtags['g:image_link'][] = HTTP_SERVER . DIR_WS_CATALOG . $rss->_clear_url($products_image_large);
          }
        }
      }

      $link = zen_href_link($info_page, 'products_id=' . $products->fields['products_id'] . $additionalURL, 'NONSSL', false);

      $products_description = $products->fields['products_description'];
      if (RSS_PRODUCTS_DESCRIPTION_IMAGE == 'true' && zen_not_null($products->fields['products_image'])) {
        $image_url = zen_image(DIR_WS_IMAGES . $products->fields['products_image'], $products->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'style="float: left; margin: 0px 8px 8px 0px;"');
        $image_url = str_replace('<img src="', '<img src="' . HTTP_SERVER . DIR_WS_CATALOG, $image_url);
        $image_link = '<a href="' . $link . '">' . $image_url . '</a>';
        if(RSS_STRIP_TAGS == 'true') {
          $products_description = '<![CDATA[' . $image_link . ']]>' . $products_description;
        } else {
          $products_description = $image_link . $products_description;
        }
      }

      if (RSS_PRODUCTS_DESCRIPTION_BUYNOW == 'true') {
/*
        $buynow_link = '<br /><br />' . zen_draw_form('cart_quantity', $link . '&action=add_product', 'post', 'enctype="multipart/form-data" target="_blank"') . "\n";
//        $buynow_link .= '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($products->fields['products_id'])) . '" maxlength="6" size="4" />' . zen_get_products_quantity_min_units_display((int)$products->fields['products_id']);
        $buynow_link .= zen_draw_hidden_field('cart_quantity', zen_get_buy_now_qty($products->fields['products_id']));
        $buynow_link .= zen_draw_hidden_field('products_id', (int)$products->fields['products_id']);
        $buynow_link .= str_replace('<img src="', '<img src="' . HTTP_SERVER . DIR_WS_CATALOG, zen_image_submit(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT));
        $buynow_link .= '</form>';
*/
        $buynow_button = str_replace('<img src="', '<img src="' . HTTP_SERVER . DIR_WS_CATALOG, zen_image_button(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT));
        $buynow_button = preg_replace('@onmouseover="[^"]*"@i', '', $buynow_button);
        $buynow_button = preg_replace('@onmouseout="[^"]*"@i', '', $buynow_button);
        $buynow_button = str_replace(' >', '>', $buynow_button);
//        $buynow_link = '<br /><br />' . '<a href="' . $link . '&action=buy_now' . '" target="_blank">' . $buynow_button . '</a>' . "\n";
        $buynow_link = '<br /><br />' . '<a href="' . zen_href_link(FILENAME_SHOPPING_CART, 'products_id=' . $products->fields['products_id'] . '&action=buy_now' . $additionalURL, 'SSL', false) . '" target="_blank">' . $buynow_button . '</a>' . "\n";
        if(RSS_STRIP_TAGS == 'true') {
          $products_description .= "\n" . '<![CDATA[' . $buynow_link . ']]>';
        } else {
          $products_description .= "\n" . $buynow_link;
        }
      }

      if (RSS_BUYNOW_LINK == 'true') {
/*
        $buynow_link = '<br /><br />' . zen_draw_form('cart_quantity', $link . '&action=add_product', 'post', 'enctype="multipart/form-data" target="_blank"') . "\n";
//        $buynow_link .= '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($products->fields['products_id'])) . '" maxlength="6" size="4" />' . zen_get_products_quantity_min_units_display((int)$products->fields['products_id']);
        $buynow_link .= zen_draw_hidden_field('cart_quantity', zen_get_buy_now_qty($products->fields['products_id']));
        $buynow_link .= zen_draw_hidden_field('products_id', (int)$products->fields['products_id']);
        $buynow_link .= str_replace('<img src="', '<img src="' . HTTP_SERVER . DIR_WS_CATALOG, zen_image_submit(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT));
        $buynow_link .= '</form>';
*/
        $buynow_button = str_replace('<img src="', '<img src="' . HTTP_SERVER . DIR_WS_CATALOG, zen_image_button(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT));
        $buynow_button = preg_replace('@onmouseover="[^"]*"@i', '', $buynow_button);
        $buynow_button = preg_replace('@onmouseout="[^"]*"@i', '', $buynow_button);
        $buynow_button = str_replace(' >', '>', $buynow_button);
//        $buynow_link = $link . '&action=buy_now';
        $buynow_link = zen_href_link(FILENAME_SHOPPING_CART, 'products_id=' . $products->fields['products_id'] . '&action=buy_now' . $additionalURL, 'SSL', false);
        $xtags['zencart:buynow_link'] = $buynow_link;
        $xtags['zencart:buynow_button'] = $buynow_button;
      }

// TODO:
// Attribute processing
// Model, weight, brand & etc...
      $rss->rss_feed_item($products->fields['products_name'],
                          $link,
                          array('url' => $link, 'PermaLink' => true),
                          date('r', strtotime($products->fields['products_date'])),
                          $products_description,
                          $rss->_clear_url($products->fields['products_image']),
                          zen_href_link(FILENAME_PRODUCT_REVIEWS,'products_id=' . $products->fields['products_id'] . $additionalURL, 'NONSSL', false),
                          (RSS_AUTHOR == ''? STORE_OWNER_EMAIL_ADDRESS . " <" . STORE_OWNER . ">" : RSS_AUTHOR),
                          false,
                          false,
                          $xtags
                          );
      if ($random)
        break;
      $products->MoveNext();
    }
  }

  function zen_rss_category_tree($id_parent=0, $str_cPath='', $limit = 32767){
    global $db, $rss, $additionalURL;
    if($limit < 0) return;
    $categories = $db->Execute("SELECT c.categories_id, c.parent_id, GREATEST(c.date_added, IFNULL(c.last_modified, 0)) AS categories_date, c.categories_image, cd.categories_name, cd.categories_description
                       FROM " . TABLE_CATEGORIES . " c
                         LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd on c.categories_id = cd.categories_id
                       WHERE c.parent_id = " . (int)$id_parent . "
                         AND cd.language_id = " . (int)$_SESSION['languages_id'] . "
                         AND c.categories_status = 1
                       ORDER BY c.sort_order, cd.categories_name",
                       '', false, 150);
    if ($categories->RecordCount() == 0)
      return;
    while(!$categories->EOF && $limit>0) {
      $new_str_cPath = (zen_not_null($str_cPath) ? $str_cPath . '_' . $categories->fields['categories_id'] : $categories->fields['categories_id']);
      $products_in_category = zen_count_products_in_category($categories->fields['categories_id']);
      if ((CATEGORIES_COUNT_ZERO == '1' && $products_in_category == 0) or $products_in_category >= 1) {
        $limit--;
        $link = zen_href_link(FILENAME_DEFAULT, 'cPath=' . $new_str_cPath . $additionalURL, 'NONSSL', false);
        $rss->rss_feed_item($categories->fields['categories_name'],
                            $link,
                            array('url' => $link, 'PermaLink' => true),
                            date('r', strtotime($categories->fields['categories_date'])),
                            $categories->fields['categories_description'],
                            $categories->fields['categories_image'],
                            false,
                            (RSS_AUTHOR == ''? STORE_OWNER_EMAIL_ADDRESS . " <" . STORE_OWNER . ">" : RSS_AUTHOR)
                            );
      }
      if (zen_has_category_subcategories($categories->fields['categories_id'])) {
        zen_rss_category_tree($categories->fields['categories_id'], $new_str_cPath, $limit);
      }
      $categories->MoveNext();
    }
  }
// EOF