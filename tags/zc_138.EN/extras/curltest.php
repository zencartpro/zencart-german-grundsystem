<?php
/*
 * @package general
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: curltest.php 7126 2007-09-29 00:17:50Z drbyte $
 */
  error_reporting(E_ALL);

  $defaultURL = "http://www.zen-cart.com/testcurl.php";
  $useSSL = (isset($_GET['ssl']) && (strtolower($_GET['ssl']) == 'yes' || $_GET['ssl'] == 1)) ? true : false;
  if ($useSSL) $defaultURL = "https://www.zen-cart.com/testcurl.php";
  $url = (isset($_GET['url'])) ? urldecode($_GET['url']) : $defaultURL;
  $data = (isset($_GET['postdata'])) ? $_GET['postdata'] : "field1=This is a test&statuskey=ready";
  $proxy = (isset($_GET['proxy'])) ? true : false;
  $proxyAddress = (isset($_GET['proxyaddress'])) ? $_GET['proxyaddress'] : 'proxy.shr.secureserver.net:3128';

  $testLinkpoint = (isset($_GET['linkpoint']) && (strtolower($_GET['linkpoint']) == 'yes' || $_GET['linkpoint'] == 1)) ? true : false;
  if ($testLinkpoint) $url = "https://secure.linkpt.net:1129/LSGSXML";

  $testAuthnet = (isset($_GET['authnet']) && (strtolower($_GET['authnet']) == 'yes' || $_GET['authnet'] == 1)) ? true : false;
  if ($testAuthnet) $url = "https://secure.authorize.net/gateway/transact.dll";

  $testPayPal = (isset($_GET['paypal']) && (strtolower($_GET['paypal']) == 'yes' || $_GET['paypal'] == 1)) ? true : false;
  if ($testPayPal) $url = "https://api-3t.paypal.com/nvp";

  // Send CURL communication
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  if ($data != '') {
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  }
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 15);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); /* compatibility for SSL communications on some Windows servers (IIS 5.0+) */
  if ($proxy) {
    curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, true);
    @curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    curl_setopt ($ch, CURLOPT_PROXY, $proxyAddress);
  }

  $result = curl_exec($ch);
  $errtext = curl_error($ch);
  $errnum = curl_errno($ch);
  $commInfo = @curl_getinfo($ch);
  curl_close ($ch);

// enclose URL in quotes so it doesn't get converted to a clickable link if posted on the forum
  if (isset($commInfo['url'])) $commInfo['url'] = '"' . $commInfo['url'] . '"';

// Handle results
  echo ($errnum != 0 ? '<br />' . $errnum . ' ' . $errtext . '<br />' : '');
  if ($url == $defaultURL) echo $result;
  echo '<pre>' . print_r($commInfo, true) . '</pre><br /><br />';
  if ($url != $defaultURL) echo $result . 'EOF';

?>