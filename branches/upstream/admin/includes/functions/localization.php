<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: localization.php 5369 2006-12-23 10:55:52Z drbyte $
//

  function quote_oanda_currency($code, $base = DEFAULT_CURRENCY) {
    $url = 'http://www.oanda.com/convert/fxdaily';
    $data = 'value=1&redirected=1&exch=' . $code .  '&format=CSV&dest=Get+Table&sel_list=' . $base;
    // check via file() ... may fail if php file Wrapper disabled.
    $page = @file($url . '?' . $data);
    if (!is_object($page) && function_exists('curl_init')) {
      // check via cURL instead.  May fail if proxy not set, esp with GoDaddy.
      $page = doCurlCurrencyRequest('POST', $url, $data) ;
      $page = explode("\n", $page);
    }
    if (is_object($page) || $page !='') {
      $match = array();

      preg_match('/(.+),(\w{3}),([0-9.]+),([0-9.]+)/i', implode('', $page), $match);

      if (sizeof($match) > 0) {
        return $match[3];
      } else {
        return false;
      }
    }
  }

  function quote_xe_currency($to, $from = DEFAULT_CURRENCY) {
    $url = 'http://www.xe.net/ucc/convert.cgi';
    $data = 'Amount=1&From=' . $from . '&To=' . $to;
    // check via file() ... may fail if php file Wrapper disabled.
    $page = @file($url . '?' . $data);
    if (!is_object($page) && function_exists('curl_init')) {
      // check via cURL instead.  May fail if proxy not set, esp with GoDaddy.
      $page = doCurlCurrencyRequest('POST', $url, $data) ;
      $page = explode("\n", $page);
    }
    if (is_object($page) || $page !='') {
      $match = array();

      preg_match('/[0-9.]+\s*' . $from . '\s*=\s*([0-9.]+)\s*' . $to . '/', implode('', $page), $match);
      if (sizeof($match) > 0) {
        return $match[1];
      } else {
        return false;
      }
    }
  }

  function doCurlCurrencyRequest($method, $url, $vars) {
    //echo '-----------------<br />';
    //echo 'URL: ' . $url . ' VARS: ' . $vars . '<br />';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//  curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
//  curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    if (strtoupper($method) == 'POST') {
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
    }
    if (CURL_PROXY_REQUIRED == 'True') {
      $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
      curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
      curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
      curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
    }
    $data = curl_exec($ch);
    $error = curl_error($ch);
    //$info=curl_getinfo($ch);
    curl_close($ch);

    if ($error != '') {
      global $messageStack;
      $messageStack->add_session('cURL communication ERROR: ' . $error, 'error');
    }
    //echo 'INFO: <pre>'; print_r($info); echo '</pre><br />';
    //echo 'ERROR: ' . $error . '<br />';
    //print_r($data) ;

    if ($data != '') {
      return $data;
    } else {
      return $error; 
    }
  }

?>
