<?php
/**
 * rss_feed.php
 *
 * @package rss feed
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rss_feed.php, v 2.1.4 14.02.2008 15:26 Andrew Berezin $
 */
// <a href="http://feedvalidator.org/check.cgi?url=..."><img src="valid-rss.png" alt="[Valid RSS]" title="Validate my RSS feed" /></a>

class rss_feed extends base {
  var $xmlns = array();
  var $encoding = "UTF-8";
  var $content_type = "text/xml";
  var $version = "2.0";

  var $addAtomSelfLink = true;

  var $stylesheets = array();

  var $title = "";
  var $link = "";
  var $description = "";

  var $language = "en-us";
  var $copyright = false;
  var $managingEditor = false;
  var $webMaster = false;
  var $pubDate = false;
  var $lastBuildDate = false;
  var $category = false;
  var $generator = "RSS Feed Generator";
  var $docs = false;
  var $cloud = false;
  var $ttl = 1440;
  var $image = false;
  var $textInput = false;
  var $skipHours = false;
  var $skipDays = false;

  var $xElements = array();

  var $item = array();
  var $description_out = true;
  var $description_out_max = 0;

  var $rssFeedContent = false;
  var $rssFeedTimeCreated = false;

  var $rssFeedCahcheFlag = true;
  var $rssFeedCahcheFileName = false;
  var $rssFeedCahcheFrom = false;


  function rss_feed($xmlns = array()) {
    $this->rss_feed_xmlns($xmlns);
  }

  function rss_feed_xmlns($xmlns = "") {
    if (is_array($xmlns)) {
      foreach ($xmlns as $i => $v) {
        $this->xmlns[] = $xmlns[$i];
      }
    } elseif (is_string($xmlns)) {
      $this->xmlns[] = $xmlns;
    }
  }

  function rss_feed_style($href) {
    $this->stylesheets[] = $href;
  }

  function rss_feed_encoding($encoding) {
    $this->encoding = $encoding;
  }

  function rss_feed_content_type($content_type) {
    $this->content_type = $content_type;
  }

  function rss_feed_set($name, $value) {
    switch ($name) {
      case 'title':
        $this->title = $value;
        break;
      case 'link':
        $this->link = $value;
        break;
      case 'description':
        $this->description = $value;
        break;
      case 'language':
        $this->language = $value;
        break;
      case 'copyright':
        $this->copyright = $value;
        break;
      case 'managingEditor':
        $this->managingEditor = $value;
        break;
      case 'webMaster':
        $this->webMaster = $value;
        break;
      case 'pubDate':
        $this->pubDate = $value;
        break;
      case 'lastBuildDate':
        $this->lastBuildDate = $value;
        break;
// category $this->rss_feed_category
      case 'generator':
        $this->generator = $value;
        break;
      case 'docs':
        $this->docs = $value;
        break;
// cloud $this->rss_feed_cloud
      case 'ttl':
        $this->ttl = $value;
        break;
// image $this->rss_feed_image
// textInput $this->rss_feed_textInput
      case 'skipHours':
        $this->skipHours = explode(',', $value);
        break;
      case 'skipDays':
        $this->skipDays = explode(',', $value);
        break;
    }
    return;
  }

  function rss_feed_category($name, $domain=false) {
    $this->category['name'] = $name;
    $this->category['domain'] = $domain;
  }

  function rss_feed_cloud($domain, $port, $path, $registerProcedure, $protocol) {
    $this->cloud['domain'] = $domain;
    $this->cloud['port'] = $port;
    $this->cloud['path'] = $path;
    $this->cloud['registerProcedure'] = $registerProcedure;
    $this->cloud['protocol'] = $protocol;
  }

  function rss_feed_image($title, $link, $url, $width=0, $height=0, $description=false) {
    $this->image['title'] = $title;
    $this->image['link'] = $link;
    $this->image['url'] = $url;
    $this->width['width'] = $width;
    $this->width['height'] = $height;
    $this->width['description'] = $description;
  }

  function rss_feed_textInput($title, $link, $description, $name) {
    $this->textInput['title'] = $title;
    $this->textInput['link'] = $link;
    $this->textInput['description'] = $description;
    $this->textInput['name'] = $name;
  }

  function rss_feed_description_set($out, $max) {
    $this->description_out = $out;
    $this->description_out_max = $max;
  }

  function rss_feed_item($title, $link, $guid, $pubDate = false, $description = false, $enclosure = false, $comments = false, $author = false, $category = false, $source=false, $ext_tags = array()) {
    $this->item['title'][] = $title;
    $this->item['link'][] = $link;
    $this->item['guid'][] = $guid;
    $this->item['pubDate'][] = $pubDate;
    $this->item['description'][] = $description;
    $this->item['enclosure'][] = $enclosure;
    $this->item['comments'][] = $comments;
    $this->item['author'][] = $author;
    $this->item['category'][] = $category;
    $this->item['source'][] = $source;

    $this->item['ext_tags'][] = $ext_tags;
  }

  function rss_feed_content() {
    $feedContent = '<?xml version="1.0" encoding="' . $this->encoding . '"?'.'>' . "\n";
    foreach($this->stylesheets as $stylesheet) {
      if(substr($stylesheet, -3) == 'xsl') {
        $feedContent .= '<?xml-stylesheet type="text/xsl" href="' . $stylesheet . '" media="screen"?'.'>' . "\n";
      } else {
        $feedContent .= '<?xml-stylesheet type="text/css" href="' . $stylesheet . '" media="screen"?'.'>' . "\n";
      }
    }
    if (sizeof($this->xmlns) > 0) {
      $xmlns = "\n" . implode("\n", $this->xmlns);
    } else {
      $xmlns = "";
    }
    if($this->addAtomSelfLink == true) {
      $xmlns .= "\n" . 'xmlns:atom="http://www.w3.org/2005/Atom"';
    }
    $feedContent .= '<!-- generator="Zen-Cart RSS Feed/"' . RSS_FEED_VERSION . ' -->' . "\n";
    $feedContent .= '<rss version="' . $this->version . '" ' . $xmlns . '>' . "\n" .
            '  <channel>' . "\n" .
            '    <title>' . $this->_clear_string($this->title) . '</title>' . "\n" .
            '    <link>' . $this->_clear_url($this->link) . '</link>' . "\n" .
            '    <description>' . $this->_clear_string($this->description) . '</description>' . "\n";
    if($this->addAtomSelfLink == true) {
      $feedContent .= '    <atom:link href="' . $this->_clear_url($this->link) . '" rel="self" type="application/rss+xml" />' . "\n";
    }
    if ($this->language)
      $feedContent .= '    <language>' . $this->language . '</language>' . "\n";
    if ($this->copyright)
      $feedContent .= '    <copyright>' . $this->_clear_string($this->copyright) . '</copyright>' . "\n";
    if ($this->managingEditor)
      $feedContent .= '    <managingEditor>' . $this->_clear_email($this->managingEditor) . '</managingEditor>' . "\n";
    if ($this->webMaster)
      $feedContent .= '    <webMaster>' . $this->_clear_email($this->webMaster) . '</webMaster>' . "\n";
    if ($this->pubDate)
      $feedContent .= '    <pubDate>' . $this->pubDate . '</pubDate>' . "\n";
    if (!$this->lastBuildDate)
      $this->lastBuildDate = date('r');
    $feedContent .= '    <lastBuildDate>' . $this->lastBuildDate . '</lastBuildDate>' . "\n";
    if ($this->category) {
      if ($this->category['domain']) {
        $feedContent .= '    <category domain="' . $this->_clear_url($this->category['domain']) . '">' . $this->_clear_string($this->category['name']) . '</category>' . "\n";
      } else {
        $feedContent .= '    <category>' . $this->_clear_string($this->category['name']) . '</category>' . "\n";
      }
    }
    if ($this->generator)
      $feedContent .= '    <generator>' . $this->_clear_string($this->generator) . '</generator>' . "\n";
    if ($this->docs)
      $feedContent .= '    <docs>' . $this->_clear_url($this->docs) . '</docs>' . "\n";
    if ($this->cloud)
      $feedContent .= '    <cloud domain=">' . $this->_clear_url($this->cloud['domain']) . '" port="' . $this->cloud['port'] . '" path="' . $this->cloud['path'] . '" registerProcedure="' . $this->cloud['registerProcedure'] . '" protocol="' . $this->cloud['protocol'] . '" />' . "\n";
    if ($this->ttl)
      $feedContent .= '    <ttl>' . $this->ttl . '</ttl>' . "\n";
    if ($this->image['url']) {
      $feedContent .= '    <image>' . "\n" .
              '      <title>' . $this->_clear_string($this->image['title']) . '</title>' . "\n" .
              '      <link>' . $this->_clear_url($this->image['link']) . '</link>' . "\n" .
              '      <url>' . $this->_clear_url($this->image['url']) . '</url>' . "\n";
      if ($this->image['width'] > 0)
        $feedContent .= '      <width>' . $this->image['width'] . '</width>' . "\n";
      if ($this->image['height'] > 0)
        $feedContent .= '      <height>' . $this->image['height'] . '</height>' . "\n";
      if ($this->image['description'])
        $feedContent .= '      <description>' . $this->_clear_string($this->image['description']) . '</description>' . "\n";
      $feedContent .= '    </image>' . "\n";
    }
    if ($this->textInput) {
      $feedContent .= '    <textInput>' . "\n" .
              '      <title>' . $this->_clear_string($this->textInput['title']) . '</title>' . "\n" .
              '      <description>' . $this->_clear_string($this->textInput['description']) . '</description>' . "\n" .
              '      <name>' . $this->_clear_string($this->textInput['name']) . '</name' . "\n" .
              '      <link>' . $this->_clear_url($this->textInput['link']) . '</link>' . "\n" .
              '    </textInput>' . "\n";
    }
    if (is_array($this->skipHours) && sizeof($this->skipHours) > 0) {
      $feedContent .= '    <skipHours>' . "\n";
      foreach ($this->skipHours as $hour) {
        $feedContent .= '      <hour>' . $hour . '</hour>' . "\n";
      }
      $feedContent .= '    </skipHours>' . "\n";
    }
    if (is_array($this->skipDays) && sizeof($this->skipDays) > 0) {
      $feedContent .= '    <skipDays>' . "\n";
      foreach ($this->skipHours as $day) {
        $feedContent .= '      <day>' . $day . '</day>' . "\n";
      }
      $feedContent .= '    </skipDays>' . "\n";
    }
    if (is_array($this->xElements) && sizeof($this->xElements) > 0) {
      foreach($this->xElements as $xtag => $xval) {
        $xtagE = $xtag;
        if(is_array($xval)) {
          foreach($xval as $xvalItem) {
            $feedContent .= '      <' . $xtag . '>' . $xvalItem . '</' . $xtagE . '>' . "\n";
          }
        } else {
          $feedContent .= '      <' . $xtag . '>' . $xval . '</' . $xtagE . '>' . "\n";
        }
      }
    }

    for($i=0,$n=sizeof($this->item['title']);$i<$n;$i++) {
      $feedContent .= '    <item>' . "\n" .
              '      <title>' . $this->_clear_string($this->item['title'][$i]) . '</title>' . "\n" .
              '      <link>' . $this->_clear_url($this->item['link'][$i]) . '</link>' . "\n";
      if ($this->item['comments'][$i])
        $feedContent .= '      <comments>' . $this->_clear_url($this->item['comments'][$i]) . '</comments>' . "\n";
      if ($this->description_out == true && $this->item['description'][$i]) {
        $feedContent .= '      <description>' . $this->_clear_string($this->item['description'][$i], $this->description_out_max) . '</description>' . "\n";
      }
      if ($this->item['author'][$i])
        $feedContent .= '      <author>' . $this->_clear_email($this->item['author'][$i]) . '</author>' . "\n";
      if($this->item['enclosure'][$i] !== false && $this->item['enclosure'][$i] != '' && is_file(DIR_FS_CATALOG . DIR_WS_IMAGES . $this->item['enclosure'][$i])) {
        $imageinfo = getimagesize(DIR_FS_CATALOG . DIR_WS_IMAGES . $this->item['enclosure'][$i]);
        $feedContent .= '      <enclosure url="' . $this->_clear_url(HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $this->item['enclosure'][$i]) . '" length="' . filesize(DIR_FS_CATALOG . DIR_WS_IMAGES . $this->item['enclosure'][$i]) . '" type="' . $imageinfo['mime'] . '" />' . "\n";
      }
      if ($this->item['guid'][$i])
        $feedContent .= '      <guid isPermaLink="' . ($this->item['guid'][$i]['PermaLink'] === true ? 'true' : 'false') . '">' . $this->_clear_url($this->item['guid'][$i]['url']) . '</guid>' . "\n";
      if ($this->item['pubDate'][$i])
        $feedContent .= '      <pubDate>' . $this->item['pubDate'][$i] . '</pubDate>' . "\n";
      else
        $feedContent .= '      <pubDate>' . date('r') . '</pubDate>' . "\n";
      if ($this->item['source'][$i])
        $feedContent .= '      <source url="' . $this->_clear_url($this->item['source'][$i]['url']) . '">' . $this->_clear_string($this->item['source'][$i]['name']) . '</source>' . "\n";
      if ($this->item['category'][$i] !== false && is_array($this->item['category'][$i])) {
        foreach ($this->item['category'][$i] as $category) {
          if(isset($category['domain']) && $category['domain'] != '') {
            $feedContent .= '      <category domain="' . $this->_clear_url($category['domain']) . '">' . $this->_clear_string($category['name']) . '</category>' . "\n";
          } else {
            $feedContent .= '      <category>' . $this->_clear_string($category['name']) . '</category>' . "\n";
          }
        }
      }

      foreach($this->item['ext_tags'][$i] as $xtag => $xval) {
        $xtagE = $xtag;
        if(preg_match('@^(.*):(.*) type="(.*)"$@', $xtag, $m)) {
          $xtagE = $m[1] . ':' . $m[2];
//          var_dump($xtag, $xtagE, $m);echo '<br />';
        }
        if(is_array($xval)) {
          foreach($xval as $xvalItem) {
            $feedContent .= '      <' . $xtag . '>' . $xvalItem . '</' . $xtagE . '>' . "\n";
          }
        } else {
          $feedContent .= '      <' . $xtag . '>' . $xval . '</' . $xtagE . '>' . "\n";
        }
      }
      $feedContent .= '    </item>' . "\n";
    }
    $feedContent .= '  </channel>' . "\n" .
            '</rss>' . "\n";
    return $feedContent;
  }

  function rss_feed_out() {
    if($this->rssFeedCahcheFrom == false) {
      $this->rssFeedContent = $this->rss_feed_content();
      $this->rssFeedTimeCreated = time();
      if($this->rssFeedCahcheFlag == true) {
        if (($f = fopen($this->rssFeedCahcheFileName, 'w'))) {
          fwrite($f, $this->rssFeedContent, strlen($this->rssFeedContent));
          fclose($f);
        }
      }
    }

    header('Last-Modified: ' . gmdate("r", $this->rssFeedTimeCreated) . ' GMT');
    header('Expires: ' . gmdate("r", ($this->rssFeedTimeCreated+($this->ttl*60))) . ' GMT');
    header("Content-Type: " . $this->content_type . "; charset=" . $this->encoding);
    header("Content-disposition: inline; filename=rss.xml");
    echo $this->rssFeedContent;
  }

  function rss_feed_cache($zf_query, $time=false) {
    $this->rssFeedCahcheFrom = false;
    $this->rss_feed_cache_flush($time);
    $this->rssFeedCahcheFileName = DIR_FS_RSSFEED_CACHE . '/rssfeed_' . md5($zf_query);
    if($this->rssFeedCahcheFlag && is_writable($this->rssFeedCahcheFileName)) {
      if(($this->rssFeedContent = file_get_contents($this->rssFeedCahcheFileName))) {
//        $this->rssFeedContent = unserialize($this->rssFeedContent);
        $this->rssFeedTimeCreated = filemtime($this->rssFeedCahcheFileName);
        $this->rssFeedCahcheFrom = true;
      }
    }
    return $this->rssFeedCahcheFrom;
  }

  function rssFeedCahcheSet($flag) {
    $this->rssFeedCahcheFlag = ($flag === true) ? true : false;
  }

  function rss_feed_cache_flush($time=false) {
    if ($za_dir = @dir(DIR_FS_RSSFEED_CACHE)) {
      clearstatcache();
      while ($zv_file = $za_dir->read()) {
        if (strpos($zv_file, 'rssfeed_') === 0) {
          if ($time == false || (time() - filemtime(DIR_FS_RSSFEED_CACHE . '/' . $zv_file)) < $time) {
            @unlink(DIR_FS_RSSFEED_CACHE . '/' . $zv_file);
          }
        }
      }
      $za_dir->close();
    }
  }

  function _clear_string($str, $max_leng=0) {
    $in[] = '@&(amp|#038);@i'; $out[] = '&';
    $in[] = '@&(#036);@i'; $out[] = '$';
    $in[] = '@&(quot);@i'; $out[] = '"';
    $in[] = '@&(#039);@i'; $out[] = '\'';
    $in[] = '@&(nbsp|#160);@i'; $out[] = ' ';
    $in[] = '@&(hellip|#8230);@i'; $out[] = '...';
    $in[] = '@&(copy|#169);@i'; $out[] = '(c)';
    $in[] = '@&(trade|#129);@i'; $out[] = '(tm)';
    $in[] = '@&(lt|#60);@i'; $out[] = '<';
    $in[] = '@&(gt|#62);@i'; $out[] = '>';
    $in[] = '@&(laquo);@i'; $out[] = '«';
    $in[] = '@&(raquo);@i'; $out[] = '»';
    $in[] = '@&(deg);@i'; $out[] = '°';
    $in[] = '@&(mdash);@i'; $out[] = '—';
    $in[] = '@&(reg);@i'; $out[] = '®';
    $str = preg_replace($in, $out, $str);

    $s = strpos($str, '<!--');
    $f = strpos($str, '-->');
    while($s !== false && $f !== false && $f > $s) {
      $str = substr($str, 0, $s) . substr($str, $f+3);
      $s = strpos($str, '<!--');
      $f = strpos($str, '-->');
    }

    $str = trim($str);

    if($max_leng > 0 && strlen($str) > $max_leng) {
      $str = substr($str, 0, $max_leng) . '...';
    }

    if ( preg_match( "/['\"\[\]<>&]/", $str ) ) {
      if(RSS_STRIP_TAGS == 'true') {
        $st_in[] = '@<br>@i'; $st_out[] = "\n";
        $st_in[] = '@<br />@i'; $st_out[] = "\n";
        $st_in[] = '@<br/>@i'; $st_out[] = "\n";
        $st_in[] = '@<li>@i'; $st_out[] = "\n•".chr(160);
        $st_in[] = '@<h\d>@i'; $st_out[] = "\n\n";
        $st_in[] = '@</h\d>@i'; $st_out[] = "\n\n";
        $st_in[] = '@</p>@i'; $st_out[] = "\n";
        $st_in[] = '@<p>@i'; $st_out[] = "\n";

        $str = preg_replace($st_in, $st_out, $str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str, ENT_QUOTES);
      } else {
        $str = "<![CDATA[ " . $str . " ]]>";
      }
    }

    if($str == '') $str = false;

    return $str;

  }

  function _clear_url($str) {
    $url_parts = parse_url($str);
    $out = '';
    if(isset($url_parts["scheme"])) $out .= $url_parts["scheme"] . '://';
    if(isset($url_parts["host"])) $out .= $url_parts["host"];
    if(isset($url_parts["port"])) $out .= ':' . $url_parts["port"];
    if(isset($url_parts["path"])) {
      $pathinfo = pathinfo($url_parts["path"]);
      if(!isset($pathinfo["dirname"]) || $pathinfo["dirname"] == '\\' || $pathinfo["dirname"] == '.') $pathinfo["dirname"] = '';
      $out .= rtrim($pathinfo["dirname"], '/') . '/';
      if($pathinfo["basename"] != '') {
        $out .= str_replace('&', '%26', rawurlencode($pathinfo["basename"]));
      }
    }
    if(isset($url_parts["query"])) {
      $url_parts["query"] = str_replace('&amp;', '&', $url_parts["query"]);
      $url_parts["query"] = str_replace('&&', '&', $url_parts["query"]);
      $url_parts["query"] = str_replace('&', '&amp;', $url_parts["query"]);
      $out .= '?' . $url_parts["query"];
    }
    if(isset($url_parts["fragment"])) $out .= '#' . $url_parts["fragment"];
    return $out;
  }

  function _clear_email($str) {
    $out = str_replace(array('<', '>'), array('(', ')'), $str);
    return $out;
  }

}

// EOF