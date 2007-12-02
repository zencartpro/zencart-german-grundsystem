<?php
/**
 * paypal_ipn specific session stuff
 *
 * @package initSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_paypal_ipn_sessions.php 6598 2007-07-15 00:34:08Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/**
 * Begin processing. Add notice to log if logging enabled.
 */
  ipn_debug_email('IPN PROCESSING INITIATED. ' . "\n" . '*** Originating IP: ' . $_SERVER['REMOTE_ADDR'] . '  ' . (SESSION_IP_TO_HOST_ADDRESS == 'true' ? @gethostbyaddr($_SERVER['REMOTE_ADDR']) : '') . ($_SERVER['HTTP_USER_AGENT'] == '' ? '' : "\n" . '*** Browser/User Agent: ' . $_SERVER['HTTP_USER_AGENT']));
  
// need to see if we are in test mode. If so then the data is going to come in as a GET string
  if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
    foreach ($_GET as $key=>$value) {
      $_POST[$key] = $value;
    }
  }  
  if (!$_POST) {
    ipn_debug_email('IPN FATAL ERROR :: No POST data available -- Most likely initiated by browser and not PayPal.' . "\n\n\n" . '     *** The rest of this log report can most likely be ignored !! ***' . "\n\n\n\n");
     //if ($show_all_errors) echo 'No POST data. This is not a real IPN transaction. Any "Undefined" errors below can be ignored ...<br />';
  }
  
  
  $session_post = isset($_POST['custom']) ? $_POST['custom'] : '=';
  $session_stuff = explode('=', $session_post);
  $ipnFoundSession = true;
  if (!$isECtransaction && !isset($_POST['parent_txn_id']) && ipn_get_stored_session($session_stuff) === false) {
    ipn_debug_email('IPN FATAL ERROR :: No saved IPN session data available. Must be an Express Checkout or Direct Pay transaction.'); 
    $ipnFoundSession = false;
  }
?>