<?php
/**
 * ipncheck.php diagnostic tool
 *
 * @package utility
 * @copyright Copyright 2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ipncheck.php 6321 2007-05-13 14:28:17Z drbyte $
 */


define('MODULE_PAYMENT_PAYPAL_HANDLER', 'www.paypal.com/cgi-bin/webscr');
$_POST['ipn_mode'] = 'communication_test';
//$_POST['test_ipn'] = 1;
define('ENABLE_SSL','true');
define('CURL_PROXY_REQUIRED', 'False');
define('CURL_PROXY_SERVER_DETAILS', '');


echo 'IPNCHECK.PHP - Version 1.0';
echo '<br /><br />';

    $info = '';
    $header = '';
    $scheme = 'http://';
    if (ENABLE_SSL == 'true') $scheme = 'https://';
    //Parse url
    $web = parse_url($scheme . (defined('MODULE_PAYMENT_PAYPAL_HANDLER') ? MODULE_PAYMENT_PAYPAL_HANDLER : 'www.paypal.com/cgi-bin/webscr'));
    if (isset($_POST['test_ipn']) && $_POST['test_ipn'] == 1) {
      $web = parse_url($scheme . 'www.sandbox.paypal.com/cgi-bin/webscr');
    }
    //build post string
    $postdata = '';
    $postback = '';
    $postback_array = array();
    foreach($_POST as $key=>$value) {
      $postdata .= $key . "=" . urlencode(stripslashes($value)) . "&";
      $postback .= $key . "=" . urlencode(stripslashes($value)) . "&";
      $postback_array[$key] = $value;
    }
    $postback .= "cmd=_notify-validate";
    $postback_array['cmd'] = "_notify-validate";

    if ($postdata == '=&') {
      echo nl2br('IPN FATAL ERROR :: No POST data to process -- Bad IPN data');
      die('<br />aborted');
    }
    $postdata_array = $_POST;
    ksort($postdata_array);

    //echo nl2br('IPN INFO - POST VARS received (sorted): ' . "\n" . stripslashes(urldecode(print_r($postdata_array, true))));
    if (sizeof($postdata_array) == 0) die('Nothing to process. Please return to home page.');

      //Set the port number
      if($web['scheme'] == "https") {
        $web['port']="443";  $ssl = "ssl://";
      } else {
        $web['port']="80";   $ssl = "";
      }
      $proxy = $web;
      if (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '') {
        $proxy = parse_url($scheme . CURL_PROXY_SERVER_DETAILS);
      }

      //Post Data
      if (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '') {
        $header  = "POST " . $ssl . $web[host] . $web[path] . " HTTP/1.1\r\n";
        $header .= "Host: $proxy[host]\r\n";
      } else {
        $header  = "POST $web[path] HTTP/1.1\r\n";
        $header .= "Host: $web[host]\r\n";
      }
      $header .= "Content-type: application/x-www-form-urlencoded\r\n";
      $header .= "Content-length: " . strlen($postback) . "\r\n";
      $header .= "Connection: close\r\n\r\n";

      echo nl2br('IPN TESTING - POSTING to PayPal via: <strong>' . $ssl . $proxy['host'] . ':' . $proxy['port'] . "</strong>\n\n");

      //Create paypal connection
      $fp=fsockopen($ssl . $proxy['host'], $proxy['port'], $errnum, $errstr, 30);

      if(!$fp) {
        echo nl2br('IPN FATAL ERROR :: Could not establish fsockopen. ' . "\n" . 'Host Details = ' . $ssl . $proxy['host'] . ':' . $proxy['port'] . ' (' . $errnum . ') ' . $errstr . "\n" . (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '' ? "\n" . $ssl . $web[host] . $web[path] : '') . "\n Trying again without SSL ...\n\n");
        $fp=fsockopen($proxy['host'], 80, $errnum, $errstr, 30);
      }
      if(!$fp) {
        echo nl2br('IPN FATAL ERROR :: Could not establish fsockopen. ' . "\n" . 'Host Details = ' . $ssl . $proxy['host'] . ':' . $proxy['port'] . ' (' . $errnum . ') ' . $errstr . "\n" . (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '' ? "\n" . $ssl . $web[host] . $web[path] : ''));
     }

      fputs($fp, $header . $postback . "\r\n\r\n");
      $header_data = '';
      //loop through the response from the server
      while(!feof($fp)) {
        $line = @fgets($fp, 1024);
        if (strcmp($line, "\r\n") == 0) {
          // this is a header row
          $headerdone = true;
          $header_data .= $line;
        } else if ($headerdone) { 
          // header has been read. now read the contents
          $info[] = $line;
        }
      }
      //close fp - we are done with it
      fclose($fp);
      //break up results into a string
      $info = implode("", $info);

    $status = (strstr($info,'VERIFIED')) ? 'VERIFIED' : (strstr($info,'SUCCESS')) ? 'SUCCESS' : (strstr($info,'INVALID')) ? 'RESPONSE RECEIVED - Communications OKAY' : 'FAILED';

    echo nl2br('IPN TESTING - Confirmation/Validation response: <strong>' .$status . "</strong>\n<!--" . $info . '-->');

echo "<br><br>Script finished.";

?>