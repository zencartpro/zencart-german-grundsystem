<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: it_recht_kanzlei_get_external_content.php 2022-09-29 15:51:51Z webchills $
 */
  
  if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  
  
  function get_external_content($url, $timeout='3', $rss=true) {
    $data = '';

    if (function_exists('curl_version') && is_array(curl_version())) {
      $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
      
      $data = curl_exec($ch);
      curl_close($ch);

      if ($data && !check_valid_xml($data, $rss)) {
        $data = '';
      }
    }
    
    if ($data == '' && function_exists('file_get_contents')) {
      $opts = array('http' => array('method' => "GET", 'header' => "Content-Type: text/html; charset=UTF-8", 'timeout' => $timeout));
      $context = stream_context_create($opts); 
      $data = @file_get_contents($url, false, $context);

      if ($data && !check_valid_xml($data, $rss)) {
        $data = '';
      }
    }
    
    if ($data == '' && function_exists('fopen')) {
      ini_set('default_socket_timeout', $timeout);  
      $fp = @fopen($url, 'r');
      if (is_resource($fp)) {
        $data = @stream_get_contents($fp);
        fclose($fp);
      }

      if ($data && !check_valid_xml($data, $rss)) {
        $data = '';
      }
    }
        
    return $data;
  }
  
  function check_valid_xml($data, $rss) {
    $valid = true;
    
    if (!$rss)
      return $valid;
      
    libxml_use_internal_errors(true);
    libxml_clear_errors();
    
    if (class_exists('SimpleXmlElement')) {
      $xml = simplexml_load_string($data);
      if (sizeof(libxml_get_errors()) > 0) {
        $valid = false;
      }
    } else {
      $xml = new DOMDocument;
      $xml->load($data);
      if (sizeof(libxml_get_errors()) > 0) {      
        $valid = false;
      }
    }
    libxml_clear_errors();
    
    return $valid;
  }
?>