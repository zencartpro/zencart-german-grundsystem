<?php
/**
 * paypal_curl.php communications class for Paypal Express Checkout / Website Payments Pro / Payflow Pro payment methods
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal_curl.php 5425 2006-12-28 12:50:46Z drbyte $
 */

/**
 * PayPal NVP (v2.3) and Payflow Pro (v4 HTTP API) implementation via cURL.
 */
class paypal_curl extends base {

  /**
   * What level should we log at? Valid levels are:
   *   PEAR_LOG_ERR   - Log only severe errors.
   *   PEAR_LOG_INFO  - Date/time of operation, operation name, elapsed time, success or failure indication.
   *   PEAR_LOG_DEBUG - Full text of requests and responses and other debugging messages.
   *
   * @access protected
   *
   * @var integer $_logLevel
   */
  var $_logLevel = PEAR_LOG_DEBUG;

  /**
   * If we're logging, what directory should we create log files in?
   * Note that a log name coincides with a symlink, logging will
   * *not* be done to avoid security problems. File names are
   * <DateStamp>.PayflowPro.log.
   *
   * @access protected
   *
   * @var string $_logFile
   */
  var $_logDir = '/tmp';

  /**
   * Debug or production?
   */
  var $_server = 'sandbox';

  /**
   * URL endpoints -- defaults here are for three-token NVP implementation
   */
  var $_endpoints = array('live'    => 'https://api-3t.paypal.com/nvp',
                          'sandbox' => 'https://api.sandbox.paypal.com/nvp');
  /**
   * Options for cURL. Defaults to preferred (constant) options.
   */
  var $_curlOptions = array(CURLOPT_HEADER => 0,
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_TIMEOUT => 300,
                            CURLOPT_FOLLOWLOCATION => 0,
                            CURLOPT_SSL_VERIFYPEER => 0,
                            CURLOPT_SSL_VERIFYHOST => 2,
                            CURLOPT_FORBID_REUSE => true,
                            CURLOPT_POST => 1,
                            );

  /**
   * Parameters that are always required and that don't change
   * request to request.
   */
  var $_partner;
  var $_vendor;
  var $_user;
  var $_pwd;
  var $_certificationId;
  var $_version;
  var $_signature;

  /**
   * nvp or payflow?
   */
  var $_mode = 'nvp';

  /**
   * Sales or authorizations? For the U.K. this will always be 'S'
   * (Sale) because of Switch and Solo cards which don't support
   * authorizations. The other option is 'A' for Authorization.
   */
  var $_trxtype = 'S';

  /**
   * Store the last-generated name/value list for debugging.
   */
  var $lastParamList = null;

  /**
   * Store the last-generated headers for debugging.
   */
  var $lastHeaders = null;

  /**
   * Constructor. Sets up communication infrastructure.
   */
  function paypal_curl($params = array()) {
    foreach ($params as $name => $value) {
      $this->setParam($name, $value);
    }
  }

  /**
   * SetExpressCheckout
   *
   * Prepares to send customer to PayPal site so they can 
   * log in and choose their funding source and shipping address.
   * 
   * The token returned to this function is passed to PayPal in 
   * order to link their PayPal selections to their cart actions.
   */
  function SetExpressCheckout($amount, $returnUrl, $cancelUrl, $optional = array()) {
    $values = array_merge($optional, array('AMT'       => $amount,
                                           'RETURNURL' => urlencode($returnUrl),
                                           'CANCELURL' => urlencode($cancelUrl)));
    if ($this->_mode == 'payflow') {
      $values = array_merge($values, array('ACTION'  => 'S', /* ACTION=S denotes SetExpressCheckout */
                                           'TENDER'  => 'P',
                                           'TRXTYPE' => $this->_trxtype));
    } elseif ($this->_mode == 'nvp') {
      if (!isset($values['PAYMENTACTION'])) $values['PAYMENTACTION'] = ($this->_trxtype == 'S' ? 'Sale' : 'Authorization');
    }

    // allow page-styling support -- see language file for definitions
    if (defined('MODULE_PAYMENT_PAYPALWPP_PAGE_STYLE'))   $values['PAGESTYLE'] = MODULE_PAYMENT_PAYPALWPP_PAGE_STYLE;
    if (defined('MODULE_PAYMENT_PAYPALWPP_HEADER_IMAGE')) $values['HDRIMG'] = urlencode(MODULE_PAYMENT_PAYPALWPP_HEADER_IMAGE);
    if (defined('MODULE_PAYMENT_PAYPALWPP_PAGECOLOR'))    $values['PAYFLOWCOLOR'] = MODULE_PAYMENT_PAYPALWPP_PAGECOLOR;
    if (defined('MODULE_PAYMENT_PAYPALWPP_HEADER_BORDER_COLOR')) $values['HDRBORDERCOLOR'] = MODULE_PAYMENT_PAYPALWPP_HEADER_BORDER_COLOR;
    if (defined('MODULE_PAYMENT_PAYPALWPP_HEADER_BACK_COLOR')) $values['HDRBACKCOLOR'] = MODULE_PAYMENT_PAYPALWPP_HEADER_BACK_COLOR;

    return $this->_request($values, 'SetExpressCheckout');
  }

  /**
   * GetExpressCheckoutDetails
   *
   * When customer returns from PayPal site, this retrieves their payment/shipping data for use in Zen Cart
   */
  function GetExpressCheckoutDetails($token, $optional = array()) {
    $values = array_merge($optional, array('TOKEN' => $token));
    if ($this->_mode == 'payflow') {
      $values = array_merge($values, array('ACTION'  => 'G', /* ACTION=G denotes GetExpressCheckoutDetails */
                                           'TENDER'  => 'P',
                                           'TOKEN'   => $token,
                                           'TRXTYPE' => $this->_trxtype));
    }
    return $this->_request($values, 'GetExpressCheckoutDetails');
  }

  /**
   * DoExpressCheckoutPayment
   *
   * Completes the sale using PayPal as payment choice
   */
  function DoExpressCheckoutPayment($token, $payerId, $amount, $optional = array()) {
    $values = array_merge($optional, array('TOKEN'   => $token,
                                           'PAYERID' => $payerId,
                                           'AMT'     => $amount));
    if ($this->_mode == 'payflow') {
      $values = array_merge($values, array('ACTION'  => 'D', /* ACTION=D denotes DoExpressCheckoutPayment */
                                           'TENDER'  => 'P',
                                           'TRXTYPE' => $this->_trxtype));
    } elseif ($this->_mode == 'nvp') {
      if (!isset($values['PAYMENTACTION'])) $values['PAYMENTACTION'] = ($this->_trxtype == 'S' ? 'Sale' : 'Authorization');
      $values['NOTIFYURL'] = urlencode(zen_href_link('ipn_main_handler.php', '', 'SSL',false,false,true));
    }
    return $this->_request($values, 'DoExpressCheckoutPayment');
  }

  /**
   * DoDirectPayment
   * Sends CC information to gateway for processing.  
   *
   * Requires Website Payments Pro or Payflow Pro as merchant gateway.
   *
   * PAYMENTACTION = Authorization (auth/capt) or Sale (final)
   */
  function DoDirectPayment($amount, $cc, $cvv2 = '', $exp, $fname = null, $lname = null, $cc_type, $options = array(), $nvp = array() ) {
    $values = $options;
		$values['AMT'] = $amount;
		$values['ACCT'] = $cc;
    if ($cvv2 != '') $values['CVV2'] = $cvv2;
    if ($this->_mode == 'payflow') {
      $values['EXPDATE'] = $exp;
      $values['TENDER'] = 'C';
      $values['TRXTYPE'] = $this->_trxtype;
      if (($fname . $lname) !== null) {
          $values['NAME'] = $fname . ' ' . $lname;
      }
    } elseif ($this->_mode == 'nvp') {
      $values = array_merge($values, $nvp);
      $values['CREDITCARDTYPE'] = $cc_type;
      $values['FIRSTNAME'] = $fname;
      $values['LASTNAME'] = $lname;
      $values['NOTIFYURL'] = urlencode(zen_href_link('ipn_main_handler.php', '', 'SSL',false,false,true));
      if (!isset($values['PAYMENTACTION'])) $values['PAYMENTACTION'] = ($this->_trxtype == 'S' ? 'Sale' : 'Authorization');
    }
    ksort($values);

    return $this->_request($values, 'DoDirectPayment');
  }

  /**
   * RefundTransaction
   *
   * Used to refund all or part of a given transaction
   */
  function RefundTransaction($oID, $txnID, $amount = 'Full', $note = '') {
    $values['TRANSACTIONID'] = $txnID;
    if ($amount != 'Full' && (float)$amount > 0) {  
      $values['REFUNDTYPE'] = 'Partial';
      $values['AMT'] = number_format((float)$amount, 2);
    } else {
      $values['REFUNDTYPE'] = 'Full';
    }
    if ($note != '') $values['NOTE'] = $note;
    return $this->_request($values, 'RefundTransaction');
  }

  /**
   * DoVoid
   *
   * Used to void a previously authorized transaction
   */
  function DoVoid($txnID, $note = '') {
    $values['AUTHORIZATIONID'] = $txnID;
    if ($note != '') $values['NOTE'] = $note;
    return $this->_request($values, 'DoVoid');
  }
  /**
   * DoAuthorization
   *
   * Used to authorize part of a previously placed order which was initiated as authType of Order
   */
  function DoAuthorization($txnID, $amount = 0, $currency = 'USD', $entity = 'Order') {
    $values['TRANSACTIONID'] = $txnID;
    $values['AMT'] = number_format($amount, 2, '.', ',');
    $values['TRANSACTIONENTITY'] = $entity;
    $values['CURRENCYCODE'] = $currency;
    return $this->_request($values, 'DoAuthorization');
  }

  /**
   * DoReauthorization
   *
   * Used to reauthorize a previously-authorized order which has expired
   */
  function DoReauthorization($txnID, $amount = 0, $currency = 'USD') {
    $values['AUTHORIZATIONID'] = $txnID;
    $values['AMT'] = number_format($amount, 2, '.', ',');
    $values['CURRENCYCODE'] = $currency;
    return $this->_request($values, 'DoReauthorization');
  }

  /**
   * DoCapture
   *
   * Used to capture part or all of a previously placed order which was only authorized
   */
  function DoCapture($txnID, $amount = 0, $currency = 'USD', $captureType = 'Complete', $invNum = '', $note = '') {
    $values['AUTHORIZATIONID'] = $txnID;
    $values['COMPLETETYPE'] = $captureType;
    $values['AMT'] = number_format((float)$amount, 2);
    $values['CURRENCYCODE'] = $currency;
    if ($invNum != '') $values['INVNUM'] = $invNum;
    if ($note != '') $values['NOTE'] = $note;
    return $this->_request($values, 'DoCapture');
  }

  /**
   * GetTransactionDetails
   *
   * Used to read data from PayPal for a given transaction
   */
  function GetTransactionDetails($txnID) {
    $values['TRANSACTIONID'] = $txnID;
    return $this->_request($values, 'GetTransactionDetails');
  }
  /**
   * Set a parameter as passed.
   */
  function setParam($name, $value) {
    $name = '_' . $name;
    $this->$name = $value;
  }

  /**
   * Set cURL options.
   */
  function setCurlOption($name, $value) {
    $this->_curlOptions[$name] = $value;
  }

  /**
   * Send a request to endpoint.
   */
  function _request($values, $operation, $requestId = null) {
    $start = $this->_getMicroseconds();

    if ($this->_mode == 'nvp') {
      $values['METHOD'] = $operation;
    }
    // convert currency code to proper key name for nvp
    if ($this->_mode == 'nvp') {
      if (!isset($values['CURRENCYCODE']) && isset($values['CURRENCY'])) {
        $values['CURRENCYCODE'] = $values['CURRENCY'];
        unset($values['CURRENCY']);
      }
    }

    // request-id must be unique within 30 days
    if ($requestId === null) {
      $requestId = md5(uniqid(mt_rand()));
    }

    $headers[] = 'Content-Type: text/namevalue';
    $headers[] = 'X-VPS-Timeout: 45';
    $headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";
    if ($this->_mode == 'payflow') {
      $headers[] = 'X-VPS-VIT-Client-Certification-Id: ' . $this->_certificationId;
      $headers[] = 'X-VPS-Request-ID: ' . $requestId;
      $headers[] = 'X-VPS-VIT-Integration-Product: PHP::Zen Cart Payflow Pro';
    } elseif ($this->_mode == 'nvp') {
      $headers[] = 'X-VPS-VIT-Integration-Product: PHP::Zen Cart WPP-NVP';
    }
    $headers[] = 'X-VPS-VIT-Integration-Version: 0.1';
    $this->lastHeaders = $headers;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->_endpoints[$this->_server]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_buildNameValueList($values));

    foreach ($this->_curlOptions as $name => $value) {
      curl_setopt($ch, $name, $value);
    }

    $response = curl_exec($ch);
    curl_close($ch);

    // do debug/logging
    $this->_logTransaction($operation, $this->_getElapsed($start), $response);
      //die('<PRE>' . urldecode($tt) . '</PRE>');
    //if ($operation=='DoExpressCheckoutPayment') die('<PRE>' . urldecode($tt) . '</PRE>');




    if ($response) {
      return $this->_parseNameValueList($response);
    } else {
      return false;
    }

    // The nice thing about the v4 API Payflow protocol is that if you *don't*
    // get a $response, you can simply re-submit the transaction
    // *using the same REQUEST_ID* until you *do* get a response
    // -- every time Payflow gets a transaction with the same
    // REQUEST_ID, it will not process a new transactions, but
    // simply return the same results, with a DUPLICATE=1
    // parameter appended.
  }

  /**
   * Take an array of name-value pairs and return a properly
   * formatted list. Enforces the following rules:
   *
   *   - Names must be uppercase, all characters must match [A-Z].
   *   - Values cannot contain quotes.
   *   - If values contain & or =, the name has the length appended to
   *     it in brackets (NAME[4] for a 4-character value.
   *
   * If any of the "cannot" conditions are violated the function
   * returns false, and the caller must abort and not proceed with
   * the transaction.
   */
  function _buildNameValueList($pairs) {
    // Add the parameters that are always sent.
    $commpairs = array();
    // generic:
    if ($this->_user != '')      $commpairs['USER'] = trim($this->_user);
    if ($this->_pwd != '')       $commpairs['PWD'] = trim($this->_pwd);
    // PRO2.0 options:
    if ($this->_partner != '')   $commpairs['PARTNER'] = trim($this->_partner);
    if ($this->_vendor != '')    $commpairs['VENDOR'] = trim($this->_vendor);
    // NVP-specific options:
    if ($this->_version != '')   $commpairs['VERSION'] = trim($this->_version);
    if ($this->_signature != '') $commpairs['SIGNATURE'] = trim($this->_signature);

    $pairs = array_merge($pairs, $commpairs);

    $string = array();
    foreach ($pairs as $name => $value) {
      if (preg_match('/[^A-Z_0-9]/', $name)) {
        return false;
      }
      if (strpos($value, '"') !== false) {
        return false;
      }

      if (strpos($value, '&') !== false ||
        strpos($value, '=') !== false) {
        $string[] = $name . '[' . strlen($value) . ']=' . $value;
      } else {
        $string[] = $name . '=' . $value;
      }
    }

    $this->lastParamList = implode('&', $string);
    return $this->lastParamList;
  }

  /**
   * Take a name/value response string and parse it into an
   * associative array. Doesn't handle length tags in the response
   * as they should not be present.
   */
  function _parseNameValueList($string) {
    $pairs = explode('&', $string);
    $values = array();
    foreach ($pairs as $pair) {
      list($name, $value) = explode('=', $pair);
      $values[$name] = $value;
    }
    return $values;
  }

  /**
   * Log the current transaction depending on the current log level.
   *
   * @access protected
   *
   * @param string $operation  The operation called.
   * @param integer $elapsed   Microseconds taken.
   * @param object $response   The response.
   */
  function _logTransaction($operation, $elapsed, $response) {
    $token_key = $this->_parseNameValueList($response);
    switch ($this->_logLevel) {
    case PEAR_LOG_DEBUG:
      $this->log('Request Headers: ' . $this->_sanitizeLog($this->lastHeaders), urldecode($token_key['TOKEN']));
      $this->log('Request Parameters: ' . urldecode($this->_sanitizeLog($this->_parseNameValueList($this->lastParamList))), urldecode($token_key['TOKEN']));
      $this->log('Response: ' . urldecode($this->_sanitizeLog($this->_parseNameValueList($response))), urldecode($token_key['TOKEN']));

// extra debug email: ///
    if (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log and Email') {
      $message =  $this->_endpoints[$this->_server] . "\n" . $this->_server . "\n";
      $message .= 'Request Headers: ' . $this->_sanitizeLog($this->lastHeaders) . "\n\n";
      $message .= 'Request Parameters: ' . urldecode($this->_sanitizeLog($this->_parseNameValueList($this->lastParamList))) . "\n\n";
      $message .= 'Response: ' . urldecode($this->_sanitizeLog($this->_parseNameValueList($response)));

      zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, 'PayPal Debug log - ' . $operation, $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    }
/////////////////////////

    case PEAR_LOG_INFO:
      $success = false;
      if ($response) {
        $values = $this->_parseNameValueList($response);
        if ($values['RESULT'] == 0 || strstr($values['ACK'],'Success')) {
          $success = true;
        }
      }
      $this->log($operation . ', Elapsed: ' . $elapsed . 'ms; ' . (isset($values['ACK']) ? $values['ACK'] : ($success ? 'Succeeded' : 'Failed')), urldecode($token_key['TOKEN']));

    case PEAR_LOG_ERR:
      if (!$response) {
        $this->log('No response from server', urldecode($token_key['TOKEN']));
      } else {
        $values = $this->_parseNameValueList($response);
        if ($response['RESULT'] != 0 || strstr($response['ACK'],'Failure')) {
          $this->log($response, urldecode($token_key['TOKEN']));
        }
      }
    }
  }

  /**
   * Strip sensitive information (passwords, credit card numbers,
   * cvv2 codes) from requests/responses.
   *
   * @access protected
   *
   * @param mixed $log  The log to sanitize.
   *
   * @return string  The sanitized (and string-ified, if necessary) log.
   */
  function _sanitizeLog($log) {
    if (is_array($log)) {
      foreach (array_keys($log) as $key) {
        switch (strtolower($key)) {
          case 'pwd':
          case 'cvv2':
            $log[$key] = str_repeat('*', strlen($log[$key]));
            break;

          case 'signature':
          case 'acct':
            $log[$key] = str_repeat('*', strlen(substr($log[$key], 0, -4))) . substr($log[$key], -4);
            break;
        }
      }
      return var_export($log, true);
    } else {
      return $log;
    }
  }

  function log($message, $token = '') {
    static $tokenHash;
    if ($tokenHash == '') $tokenHash = '_' . zen_create_random_value(4);
    if ($token == '') $token = $_SESSION['paypal_ec_token'];
    if ($token == '') $token = time();
    $token .= $tokenHash;
    $file = $this->_logDir . '/' . 'Paypal_Debug_' . $token . '.log';
    $fp = @fopen($file, 'a');
    @fwrite($fp, $message . "\n\n");
    @fclose($fp);
  }
  /**
   * Return the current time including microseconds.
   *
   * @access protected
   *
   * @return integer  Current time with microseconds.
   */
  function _getMicroseconds() {
    list($ms, $s) = explode(' ', microtime());
    return floor($ms * 1000) + 1000 * $s;
  }

  /**
   * Return the difference between now and $start in microseconds.
   *
   * @access protected
   *
   * @param integer $start  Start time including microseconds.
   *
   * @return integer  Number of microseconds elapsed since $start
   */
  function _getElapsed($start) {
    return $this->_getMicroseconds() - $start;
  }
}

?>