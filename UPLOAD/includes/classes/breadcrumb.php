<?php
/**
 * breadcrumb Class.
 *
 * @package classes
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: breadcrumb.php 731 2019-10-21 09:21:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/**
 * The following switch simply checks to see if the setting is already defined, and if not, sets it to true
 * If you desire to have the older behaviour of having all product and category items in the breadcrumb be shown as links
 * then you should add a define() for this item in the extra_datafiles folder and set it to 'false' instead of 'true':
 */
if (!defined('DISABLE_BREADCRUMB_LINKS_ON_LAST_ITEM')) define('DISABLE_BREADCRUMB_LINKS_ON_LAST_ITEM','true');

/**
 * breadcrumb Class.
 * Class to handle page breadcrumbs
 *
 * @package classes
 */
class breadcrumb extends base {
  var $_trail;

  function __construct() {
    $this->reset();
  }

  function reset() {
    $this->_trail = array();
  }

  function add($title, $link = '') {
    $this->_trail[] = array('title' => $title, 'link' => $link);
  }

  function trail($separator = '&nbsp;&nbsp;') {
    $trail_string = '';

    for ($i=0, $n=sizeof($this->_trail); $i<$n; $i++) {
//    echo 'breadcrumb ' . $i . ' of ' . $n . ': ' . $this->_trail[$i]['title'] . '<br />';
      $skip_link = false;
		  if ($i==($n-1) && DISABLE_BREADCRUMB_LINKS_ON_LAST_ITEM =='true') {
        $skip_link = true;
      }
      if (isset($this->_trail[$i]['link']) && zen_not_null($this->_trail[$i]['link']) && !$skip_link ) {
        // this line simply sets the "Home" link to be the domain/url, not main_page=index?blahblah:
        // adding the breadcrumb identifier for Rich Snippets
        if ($this->_trail[$i]['title'] == HEADER_TITLE_CATALOG) {
          $trail_string .= '  <span vocab="http://schema.org/" typeof="BreadcrumbList"><span property="itemListElement" typeof="ListItem"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . $this->_trail[$i]['title'] . '</a></span></span>';
        } else {
          $trail_string .= '  <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' . $this->_trail[$i]['link'] . '"><span property="name">' . $this->_trail[$i]['title'] . '</span></a></span>';
        }
      } else {
        $trail_string .= $this->_trail[$i]['title'];
      }

      if (($i+1) < $n) $trail_string .= $separator;
      $trail_string .= "\n";
    }

    return $trail_string;
  }

  function last() {
    $trail_size = sizeof($this->_trail);
    return $this->_trail[$trail_size-1]['title'];
  }
}
?>