<?php
/**
 * @package Braintree SCA for Zen Cart German 1.5.7h and PHP 8.2.x
 * Zen Cart German Specific
 * based on braintree_web 3.103.0 and braintree_php 6.18.0 (July 2024)
 * @copyright Copyright 2018-2021 Numinix
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: braintree_api.php 2024-07-15 08:36:14 webchills $
*/
use Braintree\Gateway;
use Braintree\Transaction;
require_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/braintree/lib/Braintree.php');

class braintree_api extends base {
      /**
     * $_check is used to check the configuration key set up
     * @var int
     */
    protected $_check;
    /**
     * name of this module
     *
     * @var string
     */
    public $code;
    public $codeTitle;
    public $codeVersion;
    /**
     * $description is a soft name for this payment method
     * @var string 
     */
    public $description;
    /**
     * $email_footer is the text to me placed in the footer of the email
     * @var string
     */
    public $email_footer;
    /**
     * $enabled determines whether this module shows or not... during checkout.
     * @var boolean
     */
    public $enabled;
    /**
     * $order_status is the order status to set after processing the payment
     * @var int
     */
    public $order_status;
    /**
     * $title is the displayed name for this order total method
     * @var string
     */
    public $title;
    /**
     * $sort_order is the order priority of this payment module when displayed
     * @var int
     */
    public $sort_order;
    
   /**
   * order status setting for pending orders
   *
   * @var int
   */
   public $order_pending_status = 1;  
    
    /**
     * $zone is used for zone restrictions
     * @var int
     */
    public $zone;
     /**
     * $emailAlerts is a debugging setting
     * @var string 
     */
    public $emailAlerts;
    
  /**
   * Variables used in processing transaction request/response values for internal use.
   */
  protected $transaction_id;
  protected $payment_status;
  protected $payment_type;
  protected $avs;
  protected $cvv2;  
  protected $payment_time; 
  protected $amt;
  protected $transactiontype;
  protected $numitems; 

    /**
     * set other module specific specific vars
     * 
     */    
    public $enableDebugging = false;    
    public $cc_type_check = '';
    public $_logLevel = 0;
    public $version = '';
    public $nonce = '';

    /**
     * this module collects card-info onsite
     */
    public $collectsCardDataOnsite = TRUE;
    private $cards;

// class constructor
    function __construct() {        
        global $order;
        $this->code = 'braintree_api';
        $this->title = MODULE_PAYMENT_BRAINTREE_TEXT_ADMIN_TITLE;
        $this->codeVersion = defined('MODULE_PAYMENT_BRAINTREE_VERSION') ? MODULE_PAYMENT_BRAINTREE_VERSION : null;     
        $this->enabled = (defined('MODULE_PAYMENT_BRAINTREE_STATUS') && MODULE_PAYMENT_BRAINTREE_STATUS == 'True');  
        if (null === $this->codeVersion) return false;
        // Set the title & description text based on the mode we're in
        if (IS_ADMIN_FLAG === true) {
            
            $this->description = MODULE_PAYMENT_BRAINTREE_TEXT_ADMIN_DESCRIPTION;
            $this->title = MODULE_PAYMENT_BRAINTREE_TEXT_ADMIN_TITLE;

            if ($this->enabled) {

                if (MODULE_PAYMENT_BRAINTREE_SERVER == 'sandbox')
                    $this->title .= '<strong><span class="alert">'. BRAINTREE_MESSAGE_SANDBOX_ACTIVE .'</span></strong>';
                if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log File' || MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email')
                    $this->title .= '<strong> (Debug)</strong>';
                if (!function_exists('curl_init'))
                    $this->title .= '<strong><span class="alert">' . BRAINTREE_MESSAGE_CURL_NOT_FOUND .'</span></strong>';
            }
        } else {

            $this->description = MODULE_PAYMENT_BRAINTREE_TEXT_DESCRIPTION;
            $this->title = MODULE_PAYMENT_BRAINTREE_TEXT_TITLE;
        }

        if ((!defined('BRAINTREE_OVERRIDE_CURL_WARNING') || (defined('BRAINTREE_OVERRIDE_CURL_WARNING') && BRAINTREE_OVERRIDE_CURL_WARNING != 'True')) && !function_exists('curl_init'))
            $this->enabled = false;
        $this->enableDebugging = ((defined('MODULE_PAYMENT_BRAINTREE_DEBUGGING') && MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log File') || (defined('MODULE_PAYMENT_BRAINTREE_DEBUGGING') && MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email'));
        $this->emailAlerts = (defined('MODULE_PAYMENT_BRAINTREE_DEBUGGING') && MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email');        
        $this->sort_order = defined('MODULE_PAYMENT_BRAINTREE_SORT_ORDER') ? MODULE_PAYMENT_BRAINTREE_SORT_ORDER : null;
        $this->order_pending_status = defined('MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID') ? MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID : null;    
        if (null === $this->sort_order) return false;
	if (null === $this->codeVersion) return false;
        if (defined('MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID') && (int)MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID;            
        }  
        
        $this->zone = defined('MODULE_PAYMENT_BRAINTREE_ZONE') ? MODULE_PAYMENT_BRAINTREE_ZONE : null;
       

        if (is_object($order))
            $this->update_status();


        // debug setup
        if (!defined('DIR_FS_LOGS')) {
            $log_dir = 'logs/';
        } else {
            $log_dir = DIR_FS_LOGS;
        }

        if (!@is_writable($log_dir))
            $log_dir = DIR_FS_CATALOG . $log_dir;
        if (!@is_writable($log_dir))
            $log_dir = DIR_FS_SQL_CACHE;
        // Regular mode:
        if ($this->enableDebugging)
            $this->_logLevel = 2;
        // DEV MODE:
        if (defined('BRAINTREE_DEV_MODE') && BRAINTREE_DEV_MODE == 'true')
            $this->_logLevel = 3;
    }

    /**
     *  Sets payment module status based on zone restrictions etc
     */
    function update_status() {
      global $db;
      global $order;

        // if store is not running in SSL, cannot offer credit card module, for PCI reasons
        if (IS_ADMIN_FLAG === false && (!defined('ENABLE_SSL') || ENABLE_SSL != 'true')) {
            $this->enabled = False;
            $this->zcLog('update_status', '' . BRAINTREE_MESSAGE_NO_SSL . '');
        }

        // check other reasons for the module to be deactivated:
        if ($this->enabled && (int) $this->zone > 0) {

            $check_flag = false;

            $sql = "SELECT zone_id
                FROM " . TABLE_ZONES_TO_GEO_ZONES . "
                WHERE geo_zone_id = :zoneId
                AND zone_country_id = :countryId
                ORDER BY zone_id";

            $sql = $db->bindVars($sql, ':zoneId', $this->zone, 'integer');
            $sql = $db->bindVars($sql, ':countryId', $order->billing['country']['id'], 'integer');
            $check = $db->Execute($sql);

            while (!$check->EOF) {

                if ($check->fields['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } else if ($check->fields['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }

                $check->MoveNext();
            }

        if ($check_flag == false) {
                $this->enabled = false;
                $this->zcLog('update_status', ''. BRAINTREE_MESSAGE_ZONE_RESTRICTION .'');
            }

            // module cannot be used for purchase > 8,000 EUR
            $order_amount = $this->calc_order_amount($order->info['total'], 'EUR');

            if ($order_amount > 8000) {
                $this->enabled = false;
                $this->zcLog('update_status', ''. BRAINTREE_MESSAGE_LIMIT_EXCEEDED .'');
            }

            if ($order->info['total'] == 0) {
                $this->enabled = false;
                
            }
        }
    }
    
   
    function javascript_validation(){
        return 'if(!braintreeCheck()) return false;';
    }   

    /**
     * Display Credit Card Information Submission Fields on the Checkout Payment Page
     */
    function selection() {
        global $order, $zcDate;

        $this->cc_type_check = 'var value = document.checkout_payment.braintree_cc_type.value;' .
            'if(value == "Solo" || value == "Maestro" || value == "Switch") {' .
            '    document.checkout_payment.braintree_cc_issue_month.disabled = false;' .
            '    document.checkout_payment.braintree_cc_issue_year.disabled = false;' .
            '    document.checkout_payment.braintree_cc_checkcode.disabled = false;' .
            '    if(document.checkout_payment.braintree_cc_issuenumber) document.checkout_payment.braintree_cc_issuenumber.disabled = false;' .
            '} else {' .
            '    if(document.checkout_payment.braintree_cc_issuenumber) document.checkout_payment.braintree_cc_issuenumber.disabled = true;' .
            '    if(document.checkout_payment.braintree_cc_issue_month) document.checkout_payment.braintree_cc_issue_month.disabled = true;' .
            '    if(document.checkout_payment.braintree_cc_issue_year) document.checkout_payment.braintree_cc_issue_year.disabled = true;' .
            '    document.checkout_payment.braintree_cc_checkcode.disabled = false;' .
            '}';
        if ($this->cards && count($this->cards) == 0)  
            $this->cc_type_check = '';
        
        /**
         * since we are processing via the gateway, prepare and display the CC fields
         */
        $expires_month = array();
        $expires_year = array();
        $issue_year = array();

        for ($i = 1; $i < 13; $i++) {
            $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => $zcDate->output('%B - (%m)', mktime(0, 0, 0, $i, 1, 2000)));
        }

        $today = getdate();

        for ($i = $today['year']; $i < $today['year'] + 15; $i++) {
            $expires_year[] = array('id' => $zcDate->output('%y', mktime(0, 0, 0, 1, 1, $i)), 'text' => $zcDate->output('%Y', mktime(0, 0, 0, 1, 1, $i)));
        }

        $onFocus = ' onfocus="methodSelect(\'pmt-' . $this->code . '\')"';

        $fieldsArray = [];

        $fieldsArray[] = [
            "field" => '<script type="text/javascript">function braintree_cc_type_check() { ' . $this->cc_type_check . ' } </script>'
        ];
   
        if ($this->cards && count($this->cards) > 0)
            $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_TYPE,
                'field' => zen_draw_pull_down_menu('braintree_cc_type', $this->cards, '', 'onchange="braintree_cc_type_check();" onblur="braintree_cc_type_check();"' . 'id="' . $this->code . '-cc-type"' . $onFocus),
                'tag' => $this->code . '-cc-type');
         $fieldsArray[] = [
            'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_OWNER,
            'field' => '<div id="braintree_api-cc-owner-hosted"></div>'
        ];
        
        $fieldsArray[] = [
            'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_NUMBER,
            'field' => '<div id="braintree_api-cc-number-hosted"></div>'
        ];

        $fieldsArray[] = [
            'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_EXPIRES,
            'field' => '<div id="braintree_expiry-hosted"></div>'
        ];

        $fieldsArray[] = [
            'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_CHECKNUMBER,
            'field' => '<div id="braintree_api-cc-cvv-hosted"></div>'
        ];

        $fieldsArray[] = [
            'field' => "<div id='drop-in'></div>"
        ];


        $clientToken = $this->gateway()->clientToken()->generate();
        // prevent the data passed in verifyCard did not pass validation error
        // total gets refused if 4 decimals, so we use 2 only
        $amount = zen_round($order->info['total'], 2);
        $ip_address = zen_get_ip_address(); 
        // various fields get refused if more than 50 characters, so we limit to 49 before we pass them to verifyCard
        $streetAddress = substr($order->billing['street_address'],0,49);
        $streetAddressShipping = substr($order->delivery['street_address'],0,49);
        $givenName = substr($order->billing['firstname'],0,49);
        $surName = substr($order->billing['lastname'],0,49);
        $givenNameShipping = substr($order->delivery['firstname'],0,49);
        $surNameShipping = substr($order->delivery['lastname'],0,49);
        $cardholderName = $givenName . ' ' . $surName;
        
        if ($_SESSION['language']=='german') {
        $fieldsArray[] = [
            'field' => "
                <style>
                    #braintree_api-cc-owner-hosted iframe,
                    #braintree_api-cc-number-hosted iframe,
                    #braintree_expiry-hosted iframe,
                    #braintree_api-cc-cvv-hosted iframe
                    {
                        float:none !important;
                        height:35px !important;
                    }
                    #braintree_api-cc-owner-hosted,
                    #braintree_api-cc-number-hosted,
                    #braintree_expiry-hosted,
                    #braintree_api-cc-cvv-hosted
                    {
                        display:inline-block !important;
                        margin:0px 0px 10px 0px;
                        width:50% !important;
                        background-color:#FFF;
                        border: 3px solid #CCC;
                        padding:1px 2px 1px 5px;
                    }
                    .hide_field{
                        display:none;
                    }
                </style>
                <input type='text' class='hide_field' name='braintree_cc_owner' id='braintree_cc_owner'>
                <input type='text' class='hide_field' name='braintree_cc_number' id='braintree_cc_number'>
                <input type='text' class='hide_field' name='braintree_cc_expires_month' id='braintree_cc_expires_month'>
                <input type='text' class='hide_field' name='braintree_cc_expires_year' id='braintree_cc_expires_year'>
                <input type='text' class='hide_field' name='braintree_nonce' id='braintree_nonce'>
                <input type='text' class='hide_field' name='bt_liability_shift_possible' id='bt_liability_shift_possible'>
                <input type='text' class='hide_field' name='braintree_liability_shift_possible' id='braintree_liability_shift_possible'>
                <input type='text' class='hide_field' name='braintree_liability_shifted' id='braintree_liability_shifted'>
                <input type='text' class='hide_field' name='braintree_action_code' id='braintree_action_code'>
                <input type='text' class='hide_field' name='braintree_cavv' id='braintree_cavv'>
                <input type='text' class='hide_field' name='braintree_currency_code' id='braintree_currency_code'>
                <input type='text' class='hide_field' name='braintree_eci_flag' id='braintree_eci_flag'>
                <input type='text' class='hide_field' name='braintree_pares_status' id='braintree_pares_status'>
                <input type='text' class='hide_field' name='braintree_signature_verification' id='braintree_signature_verification'>
                <input type='text' class='hide_field' name='braintree_verification_status' id='braintree_verification_status'>
                <input type='text' class='hide_field' name='braintree_3ds_auth_id' id='braintree_3ds_auth_id'>
                <input type='text' class='hide_field' name='braintree_card_type' id='braintree_card_type'>
                
                <script src='https://js.braintreegateway.com/web/3.103.0/js/client.min.js'></script>
                <script src='https://js.braintreegateway.com/web/3.103.0/js/three-d-secure.min.js'></script>
                <script src='https://js.braintreegateway.com/web/3.103.0/js/hosted-fields.min.js'></script> 
                <script>
                    let hf, threeDS;
                    function braintreeCheck(){
                        if($('#checkoutPayment [name=payment]:checked').val() == 'braintree_api' && document.checkout_payment.braintree_nonce.value == ''){
                            authorizeCard();
                            return false;
                        }
                        return true;
                    }
                    function authorizeCard(){
                        setLoading('loading');
                        hf.tokenize().then(function(payload){
                            return threeDS.verifyCard({
                                onLookupComplete: function(data, next){
                                    next();
                                },
                                amount: '".$amount."',
                                nonce: payload.nonce,
                                bin:payload.details.bin,
                                collectDeviceData:true,
                                ipAddress: '".$ip_address."',
                                mobilePhoneNumber: '".$order->customer['telephone']."',
                                email: '".$order->customer['email_address']."',
                                billingAddress: {
                                    givenName: '".$givenName."',
                                    surname: '".$surName."',
                                    phoneNumber: '".$order->customer['telephone']."',
                                    streetAddress: '".$streetAddress."',
                                    locality: '".$order->billing['city']."',
                                    region: '".$order->billing['state']."',
                                    postalCode: '".$order->billing['postcode']."',
                                    countryCodeAlpha2: '".$order->billing['country']['iso_code_2']."'
                                },
                               additionalInformation: {
                                   shippingGivenName: '".$givenNameShipping."',
                                   shippingSurname: '".$surNameShipping."',
                                   shippingPhone: '".$order->customer['telephone']."',
                                   shippingAddress: {
                                      streetAddress: '".$streetAddressShipping."',
                                      locality: '".$order->delivery['city']."',
                                      region: '".$order->delivery['state']."',
                                      postalCode: '".$order->delivery['postcode']."',
                                      countryCodeAlpha2: '".$order->delivery['country']['iso_code_2']."'
                                  }
                                  },
                            })
                        }).then(function(payload){
                            console.log(payload);
                            if(isset(()=>payload.liabilityShiftPossible)){
                                $('#bt_liability_shift_possible').val(payload.liabilityShiftPossible);
                            }
                            if(isset(()=>payload.liabilityShifted)){
                                if(payload.liabilityShiftPossible && !payload.liabilityShifted){
                                    throw new Error('Die ausstellende Bank kann diese Transaktion nicht autorisieren. Bitte versuchen Sie eine andere Karte oder wählen Sie eine andere Zahlungsart.')
                                }
                                $('#braintree_liability_shifted').val(payload.liabilityShifted);
                            }
                            if(isset(() => payload.rawCardinalSDKVerificationData.ActionCode)){
                                $('#braintree_action_code').val(payload.liabilityShifted);
                            }
                            if(isset(() => payload.rawCardinalSDKVerificationData.Payment.ExtendedData.CurrencyCode)){
                                $('#braintree_currency_code').val(payload.rawCardinalSDKVerificationData.Payment.ExtendedData.CurrencyCode);
                            }
                            if(isset(()=>payload.rawCardinalSDKVerificationData.Payment.ExtendedData.SignatureVerification)){
                                if(payload.rawCardinalSDKVerificationData.Payment.ExtendedData.SignatureVerification === 'N'){
                                    throw new Error('Die ausstellende Bank kann diese Transaktion nicht autorisieren. Bitte versuchen Sie eine andere Karte oder wählen Sie eine andere Zahlungsart.');
                                }
                                $('#braintree_signature_verification').val(payload.rawCardinalSDKVerificationData.Payment.ExtendedData.SignatureVerification);
                            }
                            
                            if(isset(()=>payload.threeDSecureInfo.cavv)){
                                $('#braintree_cavv').val(payload.threeDSecureInfo.cavv);
                            }
                            
                            if(isset(()=>payload.threeDSecureInfo.eciFlag)){
                                $('#braintree_eci_flag').val(payload.threeDSecureInfo.eciFlag);
                            }
                            if(isset(()=>payload.threeDSecureInfo.paresStatus)){
                                $('#braintree_pares_status').val(payload.threeDSecureInfo.paresStatus);
                            }
                            
                            if(isset(()=>payload.threeDSecureInfo.status)){
                                if(payload.threeDSecureInfo.status !== 'authenticate_successful' 
                                    && payload.threeDSecureInfo.status !== 'authenticate_attempt_successful'
                                    && payload.threeDSecureInfo.status !== 'lookup_bypassed'
                                    && payload.threeDSecureInfo.status !== 'lookup_not_enrolled'
                                    && payload.threeDSecureInfo.status !== 'lookup_error'
                                    && payload.threeDSecureInfo.status !== 'authentication_unavailable'
                                ){
                                    console.log(payload);
                                    throw new Error('Karte kann nicht autorisiert werden. Bitte versuchen Sie es erneut.');
                                }
                                $('#braintree_verification_status').val(payload.threeDSecureInfo.status);
                            }
                            if(isset(()=>payload.threeDSecureInfo.threeDSecureAuthenticationId)){
                                $('#braintree_3ds_auth_id').val(payload.threeDSecureInfo.threeDSecureAuthenticationId);
                            }
                            if(isset(()=>payload.details.cardType)){
                                $('#braintree_card_type').val(payload.details.cardType);
                            }
                            
                            setLoading('success');
                            $('#braintree_nonce').val(payload.nonce);
                            $('#braintree_cc_number').val(payload.details.lastFour);
                            $('#braintree_cc_expires_month').val(payload.details.expirationMonth);
                            $('#braintree_cc_expires_year').val(payload.details.expirationYear);
                            $('#checkoutPayment > form').submit();
                        }).catch(function (err) {
                            setLoading('reset');
                            console.log(err);
                            alert(err.message);
                        });
                    }
                    
                    $(()=>{
                        start();                        
                    });
                    function setLoading(type){
                        let verifyBtn = $('#paymentSubmit input').first();
                        if(type === 'loading'){
                            $(verifyBtn).val('Verarbeite Karte ... Bitte warten ...');
                            $(verifyBtn).attr('disabled',true);
                        }
                        else if(type === 'reset'){
                            $(verifyBtn).val('Weiter');
                            $(verifyBtn).attr('disabled',false);
                        }
                        else if(type === 'success'){
                            $(verifyBtn).val('Karte autorisiert!');
                            $(verifyBtn).attr('disabled',true);
                        }
                    }
                    function start(){
                        getClientToken();
                    }
                    function getClientToken(){
                        onFetchClientToken('$clientToken');
                    }
                    function onFetchClientToken(clientToken){
                        return setupComponents(clientToken).then(function(instances){
                            hf = instances[0];
                            threeDS = instances[1];
                            //setupForm();
                        }).catch(function (err){
                            console.log('component error:',err);
                        });
                    }
                    function setupComponents(clientToken){
                        return Promise.all([
                            braintree.hostedFields.create({
                              authorization: clientToken,
                              styles: {
                                  input:{
//                                      'font-size':'30px',
//                                      'color' : 'red',
//                                      'border' : '3px solid #ccc',
                                  }
                              },
                              fields: {
                              	cardholderName: {
                                  selector: '#braintree_api-cc-owner-hosted',
                                  placeholder: 'Vorname Nachname'
                                },
                                number: {
                                  selector: '#braintree_api-cc-number-hosted',
                                  placeholder: '0000-0000-0000-0000'
                                },
                                cvv: {
                                  selector: '#braintree_api-cc-cvv-hosted',
                                  placeholder: '000'
                                },
                                expirationDate: {
                                  selector: '#braintree_expiry-hosted',
                                  placeholder: 'MM / JJ'
                                }
                              }
                            }),
                            braintree.threeDSecure.create({
                              authorization: clientToken,
                              version: 2
                            })
                        ]);
                    }
                    function isset (accessor) {
                      try {
                        return accessor() !== undefined && accessor() !== null
                      } catch (e) {
                        return false
                      }
                    }
                    function checkTimeout(){
                        
                    }
                    
                </script>"
        ];
      } else {
              $fieldsArray[] = [
            'field' => "
                <style>
                    #braintree_api-cc-owner-hosted iframe,
                    #braintree_api-cc-number-hosted iframe,
                    #braintree_expiry-hosted iframe,
                    #braintree_api-cc-cvv-hosted iframe
                    {
                        float:none !important;
                        height:35px !important;
                    }
                    #braintree_api-cc-owner-hosted,
                    #braintree_api-cc-number-hosted,
                    #braintree_expiry-hosted,
                    #braintree_api-cc-cvv-hosted
                    {
                        display:inline-block !important;
                        margin:0px 0px 10px 0px;
                        width:50% !important;
                        background-color:#FFF;
                        border: 3px solid #CCC;
                        padding:1px 2px 1px 5px;
                    }
                    .hide_field{
                        display:none;
                    }
                </style>
                <input type='text' class='hide_field' name='braintree_cc_owner' id='braintree_cc_owner'>
                <input type='text' class='hide_field' name='braintree_cc_number' id='braintree_cc_number'>
                <input type='text' class='hide_field' name='braintree_cc_expires_month' id='braintree_cc_expires_month'>
                <input type='text' class='hide_field' name='braintree_cc_expires_year' id='braintree_cc_expires_year'>
                <input type='text' class='hide_field' name='braintree_nonce' id='braintree_nonce'>
                <input type='text' class='hide_field' name='bt_liability_shift_possible' id='bt_liability_shift_possible'>
                <input type='text' class='hide_field' name='braintree_liability_shift_possible' id='braintree_liability_shift_possible'>
                <input type='text' class='hide_field' name='braintree_liability_shifted' id='braintree_liability_shifted'>
                <input type='text' class='hide_field' name='braintree_action_code' id='braintree_action_code'>
                <input type='text' class='hide_field' name='braintree_cavv' id='braintree_cavv'>
                <input type='text' class='hide_field' name='braintree_currency_code' id='braintree_currency_code'>
                <input type='text' class='hide_field' name='braintree_eci_flag' id='braintree_eci_flag'>
                <input type='text' class='hide_field' name='braintree_pares_status' id='braintree_pares_status'>
                <input type='text' class='hide_field' name='braintree_signature_verification' id='braintree_signature_verification'>
                <input type='text' class='hide_field' name='braintree_verification_status' id='braintree_verification_status'>
                <input type='text' class='hide_field' name='braintree_3ds_auth_id' id='braintree_3ds_auth_id'>
                <input type='text' class='hide_field' name='braintree_card_type' id='braintree_card_type'>
                
                <script src='https://js.braintreegateway.com/web/3.103.0/js/client.min.js'></script>
                <script src='https://js.braintreegateway.com/web/3.103.0/js/three-d-secure.min.js'></script>
                <script src='https://js.braintreegateway.com/web/3.103.0/js/hosted-fields.min.js'></script> 
                <script>
                    let hf, threeDS;
                    function braintreeCheck(){
                        if($('#checkoutPayment [name=payment]:checked').val() == 'braintree_api' && document.checkout_payment.braintree_nonce.value == ''){
                            authorizeCard();
                            return false;
                        }
                        return true;
                    }
                    function authorizeCard(){
                        setLoading('loading');
                        hf.tokenize().then(function(payload){
                            return threeDS.verifyCard({
                                onLookupComplete: function(data, next){
                                    next();
                                },
                                amount: '".$amount."',
                                nonce: payload.nonce,
                                bin:payload.details.bin,
                                collectDeviceData:true,
                                ipAddress: '".$ip_address."',
                                mobilePhoneNumber: '".$order->customer['telephone']."',
                                email: '".$order->customer['email_address']."',
                                billingAddress: {
                                    givenName: '".$givenName."',
                                    surname: '".$surName."',
                                    phoneNumber: '".$order->customer['telephone']."',
                                    streetAddress: '".$streetAddress."',
                                    locality: '".$order->billing['city']."',
                                    region: '".$order->billing['state']."',
                                    postalCode: '".$order->billing['postcode']."',
                                    countryCodeAlpha2: '".$order->billing['country']['iso_code_2']."'
                                },
                               additionalInformation: {
                                   shippingGivenName: '".$givenNameShipping."',
                                   shippingSurname: '".$surNameShipping."',
                                   shippingPhone: '".$order->customer['telephone']."',
                                   shippingAddress: {
                                      streetAddress: '".$streetAddressShipping."',
                                      locality: '".$order->delivery['city']."',
                                      region: '".$order->delivery['state']."',
                                      postalCode: '".$order->delivery['postcode']."',
                                      countryCodeAlpha2: '".$order->delivery['country']['iso_code_2']."'
                                  }
                                  },
                            })
                        }).then(function(payload){
                            console.log(payload);
                            if(isset(()=>payload.liabilityShiftPossible)){
                                $('#bt_liability_shift_possible').val(payload.liabilityShiftPossible);
                            }
                            if(isset(()=>payload.liabilityShifted)){
                                if(payload.liabilityShiftPossible && !payload.liabilityShifted){
                                    throw new Error('Issuing bank is unable to authorize transaction. Please try another card or form of payment')
                                }
                                $('#braintree_liability_shifted').val(payload.liabilityShifted);
                            }
                            if(isset(() => payload.rawCardinalSDKVerificationData.ActionCode)){
                                $('#braintree_action_code').val(payload.liabilityShifted);
                            }
                            if(isset(() => payload.rawCardinalSDKVerificationData.Payment.ExtendedData.CurrencyCode)){
                                $('#braintree_currency_code').val(payload.rawCardinalSDKVerificationData.Payment.ExtendedData.CurrencyCode);
                            }
                            if(isset(()=>payload.rawCardinalSDKVerificationData.Payment.ExtendedData.SignatureVerification)){
                                if(payload.rawCardinalSDKVerificationData.Payment.ExtendedData.SignatureVerification === 'N'){
                                    throw new Error('Issuing bank is unable to authorize transaction. Please try another card or form of payment');
                                }
                                $('#braintree_signature_verification').val(payload.rawCardinalSDKVerificationData.Payment.ExtendedData.SignatureVerification);
                            }
                            
                            if(isset(()=>payload.threeDSecureInfo.cavv)){
                                $('#braintree_cavv').val(payload.threeDSecureInfo.cavv);
                            }
                            
                            if(isset(()=>payload.threeDSecureInfo.eciFlag)){
                                $('#braintree_eci_flag').val(payload.threeDSecureInfo.eciFlag);
                            }
                            if(isset(()=>payload.threeDSecureInfo.paresStatus)){
                                $('#braintree_pares_status').val(payload.threeDSecureInfo.paresStatus);
                            }
                            
                            if(isset(()=>payload.threeDSecureInfo.status)){
                                if(payload.threeDSecureInfo.status !== 'authenticate_successful' 
                                    && payload.threeDSecureInfo.status !== 'authenticate_attempt_successful'
                                    && payload.threeDSecureInfo.status !== 'lookup_bypassed'
                                    && payload.threeDSecureInfo.status !== 'lookup_not_enrolled'
                                    && payload.threeDSecureInfo.status !== 'lookup_error'
                                    && payload.threeDSecureInfo.status !== 'authentication_unavailable'
                                ){
                                    console.log(payload);
                                    throw new Error('Unable to authorize card, please try again');
                                }
                                $('#braintree_verification_status').val(payload.threeDSecureInfo.status);
                            }
                            if(isset(()=>payload.threeDSecureInfo.threeDSecureAuthenticationId)){
                                $('#braintree_3ds_auth_id').val(payload.threeDSecureInfo.threeDSecureAuthenticationId);
                            }
                            if(isset(()=>payload.details.cardType)){
                                $('#braintree_card_type').val(payload.details.cardType);
                            }
                            
                            setLoading('success');
                            $('#braintree_nonce').val(payload.nonce);
                            $('#braintree_cc_number').val(payload.details.lastFour);
                            $('#braintree_cc_expires_month').val(payload.details.expirationMonth);
                            $('#braintree_cc_expires_year').val(payload.details.expirationYear);
                            $('#checkoutPayment > form').submit();
                        }).catch(function (err) {
                            setLoading('reset');
                            console.log(err);
                            alert(err.message);
                        });
                    }
                    
                    $(()=>{
                        start();                        
                    });
                    function setLoading(type){
                        let verifyBtn = $('#paymentSubmit input').first();
                        if(type === 'loading'){
                            $(verifyBtn).val('Processing Card...');
                            $(verifyBtn).attr('disabled',true);
                        }
                        else if(type === 'reset'){
                            $(verifyBtn).val('Continue');
                            $(verifyBtn).attr('disabled',false);
                        }
                        else if(type === 'success'){
                            $(verifyBtn).val('Card Authorized!');
                            $(verifyBtn).attr('disabled',true);
                        }
                    }
                    function start(){
                        getClientToken();
                    }
                    function getClientToken(){
                        onFetchClientToken('$clientToken');
                    }
                    function onFetchClientToken(clientToken){
                        return setupComponents(clientToken).then(function(instances){
                            hf = instances[0];
                            threeDS = instances[1];
                            //setupForm();
                        }).catch(function (err){
                            console.log('component error:',err);
                        });
                    }
                    function setupComponents(clientToken){
                        return Promise.all([
                            braintree.hostedFields.create({
                              authorization: clientToken,
                              styles: {
                                  input:{
//                                      'font-size':'30px',
//                                      'color' : 'red',
//                                      'border' : '3px solid #ccc',
                                  }
                              },
                              fields: {
                              	cardholderName: {
                                  selector: '#braintree_api-cc-owner-hosted',
                                  placeholder: 'Full Name'
                                },
                                number: {
                                  selector: '#braintree_api-cc-number-hosted',
                                  placeholder: '0000-0000-0000-0000'
                                },
                                cvv: {
                                  selector: '#braintree_api-cc-cvv-hosted',
                                  placeholder: '000'
                                },
                                expirationDate: {
                                  selector: '#braintree_expiry-hosted',
                                  placeholder: 'MM / YY'
                                }
                              }
                            }),
                            braintree.threeDSecure.create({
                              authorization: clientToken,
                              version: 2
                            })
                        ]);
                    }
                    function isset (accessor) {
                      try {
                        return accessor() !== undefined && accessor() !== null
                      } catch (e) {
                        return false
                      }
                    }
                    function checkTimeout(){
                        
                    }
                    
                </script>"
        ];
      	
      }

        $selection = array('id' => $this->code,
            'module' => MODULE_PAYMENT_BRAINTREE_TEXT_TITLE,
            'fields' => $fieldsArray);

        return $selection;
    }

    /**
     * This is the credit card check done between checkout_payment and
     * checkout_confirmation (called from checkout_confirmation).
     * Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
     */

    function pre_confirmation_check(){
        global $messageStack;
        if(empty($_POST['braintree_nonce'])){
            $messageStack->add_session($this->code, 'Must authorize card first', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }
        $this->nonce = $_POST['braintree_nonce'];        
    }

    /**
     * Display Credit Card Information for review on the Checkout Confirmation Page
     */    

    function confirmation(){
    	global $messageStack;
        $confirmation = ['title' => '', 'fields' => []];
        if(!empty($_POST['braintree_cc_owner'])){
        	$cc_owner = $_POST['braintree_cc_owner'];
            $confirmation['fields'][] = [
                'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_OWNER,
                'field' => $cc_owner
            ];
        }     
        if(!empty($this->cc_card_type)){
            $confirmation['fields'][] = [
                'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_TYPE,
                'field' => $this->cc_card_type
            ];
        }
        if(!empty($_POST['braintree_cc_number'])){
            $cc_number = $_POST['braintree_cc_number'];
            if(strlen($cc_number) == 4){
                $cc_number = "XXXX-XXXX-XXXX-$cc_number";
            }else{
                $cc_number = substr($_POST['braintree_cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['braintree_cc_number']) - 8)) . substr($_POST['braintree_cc_number'], -4);
            }
            $confirmation['fields'][] = [
                'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_NUMBER,
                'field' => $cc_number
            ];
        }
        if(!empty($_POST['braintree_cc_expires_month']) && !empty($_POST['braintree_cc_expires_year'])){
            $expiryMonth = $_POST['braintree_cc_expires_month'];
            $expiryYear = $_POST['braintree_cc_expires_year'];
            $confirmation['fields'][] = [
                'title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_EXPIRES,
                'field' => "$expiryMonth/$expiryYear"
            ];
        }
        if(!empty($_POST['braintree_cc_issuenumber'])){
            $confirmation['fields'][] = [
                'title' => MODULE_PAYMENT_BRAINTREE_TEXT_ISSUE_NUMBER,
                'field' => $_POST['braintree_cc_issuenumber']
            ];
        }

        return $confirmation;        
        
    }

    /**
     * Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
     */
    function process_button() {
        global $order;
        $process_button_string ='';
        if(isset($_POST['braintree_cc_type']) && !empty($_POST['braintree_cc_type'])){ 
        $process_button_string = "\n" . zen_draw_hidden_field('bt_cc_type', $_POST['braintree_cc_type']);
        }
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_expdate_month', $_POST['braintree_cc_expires_month']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_expdate_year', $_POST['braintree_cc_expires_year']);
        if(isset($_POST['braintree_cc_issue_month']) && !empty($_POST['braintree_cc_issue_month'])){ 
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_issuedate_month', $_POST['braintree_cc_issue_month']);
        }
        if(isset($_POST['braintree_cc_issuedate_year']) && !empty($_POST['braintree_cc_issuedate_year'])){ 
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_issuedate_year', $_POST['braintree_cc_issue_year']);
        }
        if(isset($_POST['braintree_cc_issuenumber']) && !empty($_POST['braintree_cc_issuenumber'])){ 
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_issuenumber', $_POST['braintree_cc_issuenumber']);
        }
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_number', $_POST['braintree_cc_number']);
        if(isset($_POST['braintree_cc_checkcode']) && !empty($_POST['braintree_cc_checkcode'])){ 
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_checkcode', $_POST['braintree_cc_checkcode']);
        }
        if(isset($_POST['braintree_cc_owner']) && !empty($_POST['braintree_cc_owner'])){ 
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_owner', $_POST['braintree_cc_owner']);
        }             
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_nonce', $_POST['braintree_nonce']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_liability_shift_possible', $_POST['braintree_liability_shift_possible']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_liability_shifted', $_POST['braintree_liability_shifted']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_action_code', $_POST['braintree_action_code']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cavv', $_POST['braintree_cavv']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_currency_code', $_POST['braintree_currency_code']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_eci_flag', $_POST['braintree_eci_flag']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_pares_status', $_POST['braintree_pares_status']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_signature_verification', $_POST['braintree_signature_verification']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_verification_status', $_POST['braintree_verification_status']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_3ds_auth_id', $_POST['braintree_3ds_auth_id']);
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_card_type', $_POST['braintree_card_type']);
        $process_button_string .= zen_draw_hidden_field(zen_session_name(), zen_session_id());
        return $process_button_string;
    }

    /**
     * Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
     */
    function process_button_ajax() {
        global $order;
        $processButton = array('ccFields' => array('bt_cc_type' => 'braintree_cc_type',
                'bt_cc_expdate_month' => 'braintree_cc_expires_month',
                'bt_cc_expdate_year' => 'braintree_cc_expires_year',
                'bt_cc_issuedate_month' => 'braintree_cc_issue_month',
                'bt_cc_issuedate_year' => 'braintree_cc_issue_year',
                'bt_cc_issuenumber' => 'braintree_cc_issuenumber',
                'bt_cc_number' => 'braintree_cc_number',
                'bt_cc_checkcode' => 'braintree_cc_checkcode',
                'bt_cc_owner' => 'braintree_cc_owner',                
                'bt_nonce' => 'braintree_nonce',
                'bt_liability_shift_possible' => 'braintree_liability_shift_possible',
                'bt_liability_shifted' => 'braintree_liability_shifted',
                'bt_action_code' => 'braintree_action_code',
                'bt_cavv' => 'braintree_cavv',
                'bt_currency_code' => 'braintree_currency_code',
                'bt_eci_flag' => 'braintree_eci_flag',
                'bt_pares_status' => 'braintree_pares_status',
                'bt_signature_verification' => 'braintree_signature_verification',
                'bt_verification_status' => 'braintree_verification_status',
                'bt_3ds_auth_id' => 'braintree_3ds_auth_id',
                'bt_card_type' => 'braintree_card_type',
            ), 'extraFields' => array(zen_session_name() => zen_session_id()));
        return $processButton;
    }

    /**
     * Prepare and submit the final authorization to Braintree via the appropriate means as configured
     */
    function before_process() {
        global $order, $messageStack;        
        try{

            #region CC VALIDATION
            if(isset($_POST['bt_nonce'])){

            }
            else{
                $cc_data = $this->retrieveValidatedCCData();
                $order->info['cc_type']     = $cc_data->cc_type;
                $order->info['cc_number']   = substr($cc_data->cc_number, 0, 4) . str_repeat('X', (strlen($cc_data->cc_number) - 8)) . substr($cc_data->cc_number, -4);
                $order->info['cc_owner']    = $_POST['braintree_cc_owner'];
                $order->info['cc_expires']  = $cc_data->cc_expiry_month . substr($cc_data->cc_expiry_year, -2);
                $order->info['ip_address']  = current(explode(':', str_replace(',', ':', zen_get_ip_address())));
                $cc_checkcode = (is_numeric($_POST['bt_cc_checkcode']) ? $_POST['bt_cc_checkcode'] : 0);
            }
            #endregion            

            #region PROCESS SALE
            $setCurrency = defined("MODULE_PAYMENT_BRAINTREE_CURRENCY") ? MODULE_PAYMENT_BRAINTREE_CURRENCY : DEFAULT_CURRENCY;
            $sale_options = [
                "amount"                => $this->calc_order_amount($order->info['total'], $setCurrency),
                "customer"              => [
                    "firstName"         => $order->customer['firstname'],
                    "lastName"          => $order->customer['lastname'],
                    "company"           => $order->customer['company'],
                    "phone"             => $order->customer['telephone'],
                    "email"             => $order->customer['email_address'],
                ],
                "billing"               => [
                    "firstName"         => $order->billing['firstname'],
                    "lastName"          => $order->billing['lastname'],
                    "company"          => $order->billing['company'],
                    "streetAddress"     => $order->billing['street_address'],
                    "extendedAddress"   => $order->billing['suburb'],
                    "locality"          => $order->billing['city'],
                    "region"            => $order->billing['state'],
                    "postalCode"        => $order->billing['postcode'],
                    "countryCodeAlpha2" => $order->billing['country']['iso_code_2']
                ],
                "shipping"              => [
                    "firstName"         => $order->delivery['firstname'],
                    "lastName"          => $order->delivery['lastname'],
                    "company"           => $order->delivery['company'],
                    "streetAddress"     => $order->delivery['street_address'],
                    "extendedAddress"   => $order->delivery['suburb'],
                    "locality"          => $order->delivery['city'],
                    "region"            => $order->delivery['state'],
                    "postalCode"        => $order->delivery['postcode'],
                    "countryCodeAlpha2" => $order->delivery['country']['iso_code_2']
                ],
                "options"               => [
                    "submitForSettlement" => MODULE_PAYMENT_BRAINTREE_SETTLEMENT
                ]
            ];
            if(isset($_POST['bt_nonce'])){
                $sale_options["paymentMethodNonce"] = $_POST["bt_nonce"];
            }
            else{
                $sale_options["merchantAccountId"] = MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID;
                $sale_options["paymentMethodNonce"] = MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID;
                $sale_options["creditCard"] = [
                    "number"            => $cc_data->cc_number,
                    "expirationMonth"   => $cc_data->cc_expiry_month,
                    "expirationYear"    => $cc_data->cc_expiry_year,
                    "cardholderName"    => $order->billing['firstname'] . ' ' . $order->billing['lastname'],
                    "cvv"               => $cc_checkcode,
                ];
            }

            $result = $gateway = $this->gateway()->transaction()->sale($sale_options);
            if($result->success){            	
                $this->zcLog('before_process - DP-5', 'Result: Success');
                $this->transaction_id           = $result->transaction->id;
                $this->payment_type = $result->transaction->creditCardDetails->cardType;
                $this->payment_status = 'Completed';
                $this->avs = $result->transaction->avsPostalCodeResponseCode;
                $this->cvv2 = $result->transaction->cvvResponseCode;

                $createdAt_date = new DateTime($result->transaction->createdAt->date??'');
                $createdAt_formatted = $createdAt_date->format('Y-m-d H:i:s');

                $this->payment_time = $createdAt_formatted;
                $this->amt = $result->transaction->amount;
                $this->transactiontype = 'cart';
                $this->numitems = count($order->products);

                $_SESSION['bt_FIRSTNAME'] = $result->transaction->customerDetails->firstName;
                $_SESSION['bt_LASTNAME'] = $result->transaction->customerDetails->lastName;
                $_SESSION['bt_BUSINESS'] = $result->transaction->billingDetails->company;
                $_SESSION['bt_NAME'] = $result->transaction->creditCardDetails->cardholderName;
                $_SESSION['bt_SHIPTOSTREET'] = $result->transaction->shippingDetails->streetAddress;
                $_SESSION['bt_SHIPTOSTREET2'] = $result->transaction->shippingDetails->extendedAddress;
                $_SESSION['bt_SHIPTOCITY'] = $result->transaction->shippingDetails->locality;
                $_SESSION['bt_SHIPTOSTATE'] = $result->transaction->shippingDetails->region;
                $_SESSION['bt_SHIPTOZIP'] = $result->transaction->shippingDetails->postalCode;
                $_SESSION['bt_SHIPTOCOUNTRY'] = $result->transaction->shippingDetails->countryName;
                $_SESSION['bt_ORDERTIME']       = $this->payment_time;
                $_SESSION['bt_CURRENCY']        = $result->transaction->currencyIsoCode;
                $_SESSION['bt_AMT']             = $result->transaction->amount;
                $_SESSION['bt_EXCHANGERATE']    = $result->transaction->disbursementDetails->settlementCurrencyExchangeRate;
                $_SESSION['bt_EMAIL']           = $order->customer['email_address'];
                $_SESSION['bt_PHONE']           = $order->customer['telephone'];
                $_SESSION['bt_PARENTTRANSACTIONID'] = $result->transaction->refundId;
                
            }else if ($result->transaction) {
                $error_msg = ''. BRAINTREE_MESSAGE_ERROR_PROCESSING .'' . $result->message;

                if (preg_match('/^1(\d+)/', $result->transaction->processorResponseCode)) {

                    // If it's a 1000 code it's Card Approved but since it didn't suceed above we assume it's Verification Failed.
                    // FROM " . TABLE_BRAINTREE . " : 1000 class codes mean the processor has successfully authorized the transaction; success will be true. However, the transaction could still be gateway rejected even though the processor successfully authorized the transaction if you have AVS and/or CVV rules set up and/or duplicate transaction checking is enabled and the transaction fails those validation.

                    $customer_error_msg = ''. BRAINTREE_MESSAGE_CUSTOMER_UNABLE_PROCESSING .'';
                } else if (preg_match('/^2(\d+)/', $result->transaction->processorResponseCode)) {

                    // If it's a 2000 code it's Card Declined
                    // FROM " . TABLE_BRAINTREE . " : 2000 class codes means the authorization was declined by the processor ; success will be false and the code is meant to tell you more about why the card was declined.                
                    if (defined('BRAINTREE_ERROR_CODE_' . $result->transaction->processorResponseCode)) {
                        $customer_error_msg = constant('BRAINTREE_ERROR_CODE_' . $result->transaction->processorResponseCode);
                    } else {
                        $customer_error_msg = ''. BRAINTREE_MESSAGE_PROCESSOR_DECLINE .'';
                    }
                } else if (preg_match('/^3(\d+)/', $result->transaction->processorResponseCode)) {

                    // If it's a 3000 code it's a processor failure
                    // FROM " . TABLE_BRAINTREE . " : 3000 class codes are problems with the back-end processing network, and dont necessarily mean a problem with the card itself.

                    $customer_error_msg = ''. BRAINTREE_MESSAGE_NETWORK_UNAVAILABLE .'';
                } else {

                    // This is the default error msg but technically it shouldn't be able to get here, Braintree in the future may add codes making it possible to not be a 1, 2, or 3k class code though.

                    $customer_error_msg = ''. BRAINTREE_MESSAGE_CUSTOMER_UNABLE_PROCESSING .'';
                }

                $this->zcLog('before_process - DP-5', 'Result: ' . $error_msg);

                $detailedEmailMessage = MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_MESSAGE . "\n\n" .
                        $result->message .
                        "\n\nProblem occurred while customer #" .
                        $order->customer['customer_id'] . ' -- ' .
                        $order->customer['firstname'] . ' ' .
                        $order->customer['lastname'] . ' -- was attempting checkout.' . "\n\n" . 'Detailed Validation errors below: ' . "\n\n" .
                        'Code: ' . $result->transaction->processorResponseCode . ' text: ' . $result->transaction->processorResponseText;

                if ($this->emailAlerts)
                    zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_SUBJECT, $detailedEmailMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML' => nl2br($detailedEmailMessage)), 'paymentalert');

                $messageStack->add_session('checkout_payment', $customer_error_msg, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
            } else {


                $error_msg = 'Message: ' . $result->message;
                $detailed_error_msg = 'Message: ' . $result->message . ' Validation error(s): ' . $result->errors->deepAll();

                $this->zcLog('before_process - DP-5', 'Result: ' . $detailed_error_msg);

                $detailedEmailMessage = MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_MESSAGE . "\n\n" .
                        $result->message .
                        "\n\nProblem occurred while customer #" .
                        $order->customer['customer_id'] . ' -- ' .
                        $order->customer['firstname'] . ' ' .
                        $order->customer['lastname'] . ' -- was attempting checkout.' . "\n\n" . 'Detailed Validation errors below: ' . "\n\n";

                foreach ($result->errors->deepAll() AS $error) {
                    $detailedEmailMessage .= ($error->code . ": " . $error->message . "\n");
                }

                if ($this->emailAlerts)
                    zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_SUBJECT, $detailedEmailMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML' => nl2br($detailedEmailMessage)), 'paymentalert');

                $messageStack->add_session('checkout_payment', $error_msg, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
            }
            #endregion
        } catch (Exception $e) {

            $this->zcLog('before_process - DP-5', 'Result: ' . $e->getMessage());
            $messageStack->add_session('checkout_payment', ''. BRAINTREE_MESSAGE_ERROR_PROCESSING .'', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }
    }

    /**
     * When the order returns from the processor, this stores the results in order-status-history and logs data for subsequent use
     */
    function after_process() {
        global $insert_id, $db, $order;

        // Add a new Order Status History record for this order's details
        $commentString = "Transaction ID: :transID: " .
                "\nPayment Type: :pmtType: " .
                ($this->payment_time != '' ? "\nTimestamp: :pmtTime: " : "") .
                "\nPayment Status: :pmtStatus: " .
                (isset($this->responsedata['auth_exp']) ? "\nAuth-Exp: " . $this->responsedata['auth_exp'] : "") .
                ($this->avs != '' ? "\nAVS Code: " . $this->avs . "\nCVV2 Code: " . $this->cvv2 : '') .
                (trim($this->amt) != '' ? "\nAmount: :orderAmt: " : "");

        $commentString = $db->bindVars($commentString, ':transID:', $this->transaction_id, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':pmtType:', $this->payment_type, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':pmtTime:', $this->payment_time, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':pmtStatus:', $this->payment_status, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':orderAmt:', $this->amt, 'noquotestring');

        $sql_data_array = array(array('fieldName' => 'orders_id', 'value' => $insert_id, 'type' => 'integer'),
            array('fieldName' => 'orders_status_id', 'value' => $order->info['order_status'], 'type' => 'integer'),
            array('fieldName' => 'date_added', 'value' => 'now()', 'type' => 'noquotestring'),
            array('fieldName' => 'customer_notified', 'value' => 0, 'type' => 'integer'),
            array('fieldName' => 'comments', 'value' => $commentString, 'type' => 'string'));

        $db->perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

        // store the Braintree order meta data -- used for later matching and back-end processing activities
        $braintree_order = array('order_id' => $insert_id,
            'txn_type' => $this->transactiontype,
            'module_name' => $this->code,
            'module_mode' => 'USA',
            'reason_code' => '',
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'pending_reason' => '',
            'first_name' => $_SESSION['bt_FIRSTNAME'],
            'last_name' => $_SESSION['bt_LASTNAME'],
            'payer_business_name' => $_SESSION['bt_BUSINESS'],
            'address_name' => $_SESSION['bt_NAME'],
            'address_street' => $_SESSION['bt_SHIPTOSTREET'],
            'address_city' => $_SESSION['bt_SHIPTOCITY'],
            'address_state' => $_SESSION['bt_SHIPTOSTATE'],
            'address_zip' => $_SESSION['bt_SHIPTOZIP'],
            'address_country' => $_SESSION['bt_SHIPTOCOUNTRY'],
            'payer_email' => $_SESSION['bt_EMAIL'],
            'payer_phone' => $_SESSION['bt_PHONE'],
            'payment_date' => 'now()',
            'txn_id' => $this->transaction_id,
            'parent_txn_id' => $_SESSION['bt_PARENTTRANSACTIONID'],
            'num_cart_items' => (float) $this->numitems,
            'settle_amount' => (float) urldecode($_SESSION['bt_AMT']),
            'settle_currency' => $_SESSION['bt_CURRENCY'],
            'exchange_rate' => (isset($_SESSION['bt_EXCHANGERATE']) && urldecode($_SESSION['bt_EXCHANGERATE']) > 0) ? urldecode($_SESSION['bt_EXCHANGERATE']) : 1.0,           
            'date_added' => 'now()'
        );

        zen_db_perform(TABLE_BRAINTREE, $braintree_order);
        $_SESSION['payment_method_messages'] = TEXT_PAYMENT_MESSAGE_BRAINTREE_API;
    }

    /**
     * Build admin-page components
     *
     * @param int $zf_order_id
     * @return string
     */
    function admin_notification($zf_order_id) {

        if (!defined('MODULE_PAYMENT_BRAINTREE_STATUS'))
            return '';
        global $db;

        $module = $this->code;
        $output = '';
        $response = $this->_GetTransactionDetails($zf_order_id);

        if (file_exists(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/braintree/braintree_admin_notification.php'))
            include_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/braintree/braintree_admin_notification.php');

        return $output;
    }

    /**
     * Used to read details of an existing transaction.  FOR FUTURE USE.
     */
    function _GetTransactionDetails($oID) {

        if ($oID == '' || $oID < 1)
            return FALSE;
        global $db, $messageStack, $doPayPal;

        $doBraintree = $this->braintree_init();

        // look up history on this order from Braintree table

        $sql = "SELECT * FROM " . TABLE_BRAINTREE . " 
            WHERE order_id = :orderID
            AND parent_txn_id = ''
            LIMIT 1";

        $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
        $zc_btHist = $db->Execute($sql);
        if ($zc_btHist->RecordCount() == 0)
            return false;
        $txnID = $zc_btHist->fields['txn_id'];
        if ($txnID == '' || $txnID === 0)
            return FALSE;

        /**
         * Read data from Braintree
         */
        try {
            $result = Braintree\Transaction::find($txnID);

            // Load data into $response
            $response['FIRSTNAME'] = $result->customerDetails->firstName;
            $response['LASTNAME'] = $result->customerDetails->lastName;
            $response['BUSINESS'] = $result->billingDetails->company;
            $response['NAME'] = $result->creditCardDetails->cardholderName;
            $response['BILLTOSTREET'] = $result->billingDetails->streetAddress;
            $response['BILLTOSTREET2'] = $result->billingDetails->extendedAddress;
            $response['BILLTOCITY'] = $result->billingDetails->locality;
            $response['BILLTOSTATE'] = $result->billingDetails->region;
            $response['BILLTOZIP'] = $result->billingDetails->postalCode;
            $response['BILLTOCOUNTRY'] = $result->billingDetails->countryName;
            $response['TRANSACTIONID'] = $result->id;
            $response['PARENTTRANSACTIONID'] = $result->refundedTransactionId;
            $response['TRANSACTIONTYPE'] = $result->type;
            $response['PAYMENTTYPE'] = $result->creditCardDetails->cardType;
            $response['PAYMENTSTATUS'] = $result->status;
            $createdAt_date = new DateTime($result->createdAt->date??'');
            $createdAt_formatted = $createdAt_date->format('Y-m-d H:i:s');
            $response['ORDERTIME'] = $createdAt_formatted;
            $response['CURRENCY'] = $result->currencyIsoCode;
            $response['AMT'] = $result->amount;
            $response['EXCHANGERATE'] = $result->disbursementDetails->settlementCurrencyExchangeRate;
            $response['EMAIL'] = $zc_btHist->fields['payer_email'];
            $response['PHONE'] = $zc_btHist->fields['payer_phone'];
        } catch (Exception $e) {
            $messageStack->add($e->getMessage(), 'error');
        }

        return $response;
    }
    
  /**
   * Determine whether the shipping-edit button should be displayed or not
   */
  function alterShippingEditButton() {
    return false;   
  }

    /**
     * Evaluate installation status of this module. Returns true if the status key is found.
     */
    function check() {
        global $db;

        if (!isset($this->_check)) {
            $check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_BRAINTREE_STATUS'");
            $this->_check = $check_query->RecordCount();
            if ($this->_check && defined('MODULE_PAYMENT_BRAINTREE_VERSION')) {
                $this->version = MODULE_PAYMENT_BRAINTREE_VERSION;
       
            }
        }
        return $this->_check;
    }

    /**
     * Installs all the configuration keys for this module
     */
    function install() {
        global $db, $messageStack;

        if (defined('MODULE_PAYMENT_BRAINTREE_STATUS')) {
            $messageStack->add_session(''. BRAINTREE_MESSAGE_ALREADY_INSTALLED .'', 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=braintree_api', 'SSL'));
            return 'failed';
        }

        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_BRAINTREE_STATUS', 'True', 'Do you want to enable this payment module?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) values ('Version', 'MODULE_PAYMENT_BRAINTREE_VERSION', '3.0.0', 'Version installed', '6', '2', now(), 'zen_cfg_read_only(')");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANTID', '', 'Your Merchant ID provided under the API Keys section.', '6', '3', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Public Key', 'MODULE_PAYMENT_BRAINTREE_PUBLICKEY', '', 'Your Public Key provided under the API Keys section.', '6', '4', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Private Key', 'MODULE_PAYMENT_BRAINTREE_PRIVATEKEY', '', 'Your Private Key provided under the API Keys section.', '6', '5', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Account ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID', '', 'Your Merchant Account ID, this should contain your <strong>Merchant Account Name</strong>.<br>Example: myaccountUSD', '6', '6', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Production or Sandbox', 'MODULE_PAYMENT_BRAINTREE_SERVER', 'sandbox', '<strong>Production: </strong> Used to process Live transactions<br><strong>Sandbox: </strong>For developers and testing', '6', '7', 'zen_cfg_select_option(array(\'production\', \'sandbox\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Account Default Currency', 'MODULE_PAYMENT_BRAINTREE_CURRENCY', 'EUR', 'Your Merchant Account Settlement Currency, must be the same as currency code in your Merchant Account Name.<br> Example: USD, CAD, AUD - You can see your store currencies from the <a target=\"_blank\" href=\"currencies.php\">Localization/Currency</a>(Opens New Window).', '6', '8', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_BRAINTREE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '9', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_BRAINTREE_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '10', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID', '2', 'Set the status of orders paid with this payment module to this value. <br><strong>Recommended: Processing[2]</strong>', '6', '11', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Unpaid Order Status', 'MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID', '1', 'Set the status of unpaid orders made with this payment module to this value. <br><strong>Recommended: Pending[1]</strong>', '6', '12', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID', '5', 'Set the status of refunded orders to this value. <br><strong>Recommended: Pending[1]</strong>', '6', '13', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_BRAINTREE_DEBUGGING', 'Alerts Only', 'Would you like to enable debug mode?  A complete detailed log of failed transactions will be emailed to the store owner if Log and Email is selected.', '6', '14', 'zen_cfg_select_option(array(\'Alerts Only\', \'Log File\', \'Log and Email\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Submit for Settlement', 'MODULE_PAYMENT_BRAINTREE_SETTLEMENT', 'true', 'Would you like to automatically Submit for Settlement?  Setting to false will only authorize and not submit for settlement (also know as capture) the transaction', '6', '15', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
        // www.zen-cart-pro.at german admin settings languages_id==43
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Kreditkartenzahlung via Braintree anbieten?', 'MODULE_PAYMENT_BRAINTREE_STATUS', '43', 'Wollen Sie Kreditkartenzahlung via Braintree aktivieren?', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Modulversion', 'MODULE_PAYMENT_BRAINTREE_VERSION', '43', 'Read Only Einstellung. Zeigt die Version des installierten Braintree Moduls an.', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Merchant ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANTID', '43', 'Tragen Sie hier die Merchant ID ein, die in Ihren Braintree API Keys Einstellungen angezeigt wird.', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Public Key', 'MODULE_PAYMENT_BRAINTREE_PUBLICKEY', '43', 'Tragen Sie hier den Public Key ein, der in Ihren Braintree API Keys Einstellungen angezeigt wird.', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Private Key', 'MODULE_PAYMENT_BRAINTREE_PRIVATEKEY', '43', 'Tragen Sie hier den Private Key ein, der in Ihren Braintree API Keys Einstellungen angezeigt wird.', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Merchant Account ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID', '43', 'Tragen Sie hier Ihre Merchant Account ID ein, sie enthält normalerweise Ihren <strong>Merchant Account Namen</strong>.<br>Beispiel: myaccountEUR', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Livesystem oder Sandbox', 'MODULE_PAYMENT_BRAINTREE_SERVER', '43', 'Stellen Sie zunächst auf sandbox, um alles im Braintree Testsystem zu testen.<br>Nach erfolgreichen Tests und Freischaltung durch Braintree stellen Sie auf das Produktivsystem um.<br><br><strong>production: </strong> für echte Live Transaktionen<br><strong>sandbox: </strong> zum Testen im Sandbox System', now())");
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Währung in Ihrem Braintree Händleraccount', 'MODULE_PAYMENT_BRAINTREE_CURRENCY', '43', 'Ihre Auszahlungswährung für das Handelskonto muss mit dem Währungscode in Ihrem Handelskonto-Namen übereinstimmen.<br> Beispiel: EUR oder USD<br>Sie können Ihre Shopwährungen im Link <a target=\"_blank\" href=\"currencies.php\">Lokalisation/Währungen</a> (öffnet neues Fenster) sehen.', now())"); 
        $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_BRAINTREE_SORT_ORDER', '43', 'An welcher Stelle der Zahlungsarten soll Braintree angeboten werden? Niedrigste Werte werden zuoberst angezeigt.', now())");   
			  $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Einschränkung auf Zahlungszone', 'MODULE_PAYMENT_BRAINTREE_ZONE', '43', 'Falls Sie hier eine Zone auswählen, dann wird Braintree Kreditkartenzahlung nur für Kunden dieser Zone angeboten.<br>Auf kein lassen, um diese Zahlungsart für alle Kunden anzubieten.', now())");
			  $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus für abgeschlossene Zahlungen', 'MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die erfolgreich mit Braintree bezahlt wurden?<br>Empfohlen: Zahlung erhalten - in Arbeit[2]', now())");
			  $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus für nicht abgeschlossene Zahlungen', 'MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die noch nicht erfolgreich mit Braintree bezahlt wurden?<br>Empfohlen: warten auf Zahlung[1]', now())");
			  $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus für erstattete Zahlungen', 'MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die via Braintree rückerstattet wurden?<br>Empfohlen: Storniert[5]', now())");
			  $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Debug Modus', 'MODULE_PAYMENT_BRAINTREE_DEBUGGING', '43', 'Möchten Sie den Debug-Modus aktivieren?  Ein vollständiges detailliertes Protokoll der fehlgeschlagenen Transaktionen wird dem Shopadministrator per E-Mail zugesandt, wenn Log and E-Mail ausgewählt ist. Wird nur Log ausgewählt wird lediglich im Ordner logs ein Logfile geschrieben. Nützlich in der Testphase zur Fehleranalyse', now())");
			  $db->Execute("replace into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Direkte Abrechnung oder bloß Autorisierung?', 'MODULE_PAYMENT_BRAINTREE_SETTLEMENT', '43', 'Möchten Sie automatisch zur Abrechnung einreichen?  Wenn Sie auf false setzen, wird die Transaktion nur autorisiert und nicht zur Abrechnung eingereicht (auch als Capture bezeichnet).', now())");
			  
			         
        $this->notify('NOTIFY_PAYMENT_BRAINTREE_INSTALLED');
    }

    function keys() {

        $keys_list = array(
            'MODULE_PAYMENT_BRAINTREE_STATUS',
            'MODULE_PAYMENT_BRAINTREE_VERSION',
            'MODULE_PAYMENT_BRAINTREE_MERCHANTID',
            'MODULE_PAYMENT_BRAINTREE_PUBLICKEY',
            'MODULE_PAYMENT_BRAINTREE_PRIVATEKEY',
            'MODULE_PAYMENT_BRAINTREE_CURRENCY',
            'MODULE_PAYMENT_BRAINTREE_SORT_ORDER',
            'MODULE_PAYMENT_BRAINTREE_ZONE',
            'MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID',
            'MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID',
            'MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID',
            'MODULE_PAYMENT_BRAINTREE_SERVER',
            'MODULE_PAYMENT_BRAINTREE_DEBUGGING',
            'MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID',
            'MODULE_PAYMENT_BRAINTREE_SETTLEMENT'
        );

        return $keys_list;
    }

    /**
     * Uninstall this module
     */
    function remove() {
        global $db;

        $db->Execute("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'MODULE\_PAYMENT\_BRAINTREE\_%'");
        $this->notify('NOTIFY_PAYMENT_BRAINTREE_UNINSTALLED');
    }

    /**
     * Debug Logging support
     */
    function zcLog($stage, $message) {
        static $tokenHash;

        if ($tokenHash == '')
            $tokenHash = '_' . zen_create_random_value(4);

        if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email' || MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log File') {

            $token = date('m-d-Y-H-i');
            $token .= $tokenHash;
            if (!defined('DIR_FS_LOGS')) {
                $log_dir = 'cache/';
            } else {
                $log_dir = DIR_FS_LOGS;
            }
            $file = $log_dir . '/' . $this->code . '_Braintree_Action_' . $token . '.log';
            if (defined('BRAINTREE_DEV_MODE') && BRAINTREE_DEV_MODE == 'true')
                $file = $log_dir . '/' . $this->code . '_Braintree_Debug_' . $token . '.log';
            $fp = @fopen($file, 'a');
            @fwrite($fp, date('M-d-Y H:i:s') . ' (' . time() . ')' . "\n" . $stage . "\n" . $message . "\n=================================\n\n");
            @fclose($fp);
        }

        $this->_doDebug($stage, $message, false);
    }

    /**
     * Used to submit a refund for a given transaction.
     */
    function _doRefund($oID, $amount = 'Full', $note = '') {
        global $db, $doBraintree, $messageStack;

        $new_order_status = (int) MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID;
        $doBraintree = $this->braintree_init();
        $proceedToRefund = false;
        $refundNote = strip_tags(zen_db_input($_POST['refnote']));

        if (isset($_POST['fullrefund']) && $_POST['fullrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_FULL) {
            $refundAmt = 'Full';
            if (isset($_POST['reffullconfirm']) && $_POST['reffullconfirm'] == 'on') {
                $proceedToRefund = true;
            } else {
                $messageStack->add_session(MODULE_PAYMENT_BRAINTREE_TEXT_REFUND_FULL_CONFIRM_ERROR, 'error');
            }
        }

        if (isset($_POST['partialrefund']) && $_POST['partialrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_PARTIAL) {
            $refundAmt = (float) $_POST['refamt'];
            $proceedToRefund = true;
            if ($refundAmt == 0) {
                $messageStack->add_session(MODULE_PAYMENT_BRAINTREE_TEXT_INVALID_REFUND_AMOUNT, 'error');
                $proceedToRefund = false;
            }
        }

        // look up history on this order FROM " . TABLE_BRAINTREE . "  table
        $sql = "SELECT * FROM " . TABLE_BRAINTREE . "  WHERE order_id = :orderID AND parent_txn_id = '' ";
        $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
        $zc_btHist = $db->Execute($sql);
        if ($zc_btHist->RecordCount() == 0)
            return false;
        $txnID = $zc_btHist->fields['txn_id'];

        /**
         * Submit refund request to Braintree
         */
        if ($proceedToRefund) {

            try {

                $result = Braintree\Transaction::find($txnID);

                if ($result->status == "submitted_for_settlement" || $result->status == "authorized") {

                    // Transaction is pending so Void

                    $result = Braintree\Transaction::void($txnID);
                    $transactionid = $txnID;
                } else if ($result->status == "settled" || $result->status == "settling") {

                    // Transaction is Settled so Refund

                    if (isset($_POST['fullrefund']) && $_POST['fullrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_FULL) {
                        $result = Braintree\Transaction::refund($txnID);
                        $transactionid = $result->transaction->refundId;
                    }

                    if (isset($_POST['partialrefund']) && $_POST['partialrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_PARTIAL) {
                        $result = Braintree\Transaction::refund($txnID, $refundAmt);
                        $transactionid = $result->transaction->refundId;
                    }
                }

                if ($result->success) {

                    if (!isset($result->transaction->amount))
                        $result->transaction->amount = $refundAmt;

                    $new_order_status = ($new_order_status > 0 ? $new_order_status : 1);

                    $sql_data_array = array('orders_id' => $oID,
                        'orders_status_id' => (int) $new_order_status,
                        'date_added' => 'now()',
                        'comments' => 'REFUND INITIATED. Trans ID:' . $transactionid . "\n" . ' Gross Refund Amt: ' . $refundAmt . "\n" . $refundNote,
                        'customer_notified' => 0
                    );

                    zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

                    $db->Execute("UPDATE " . TABLE_ORDERS . "
                        SET orders_status = '" . (int) $new_order_status . "'
                        WHERE orders_id = '" . (int) $oID . "'");

                    $messageStack->add_session(sprintf(MODULE_PAYMENT_BRAINTREE_TEXT_REFUND_INITIATED, $refundAmt, $transactionid), 'success');
                    return true;
                } else {

                    $messageStack->add_session($result->errors, 'error');
                }
            } catch (Exception $e) {
                $messageStack->add_session($e->getMessage(), 'error');
            }
        }
    }

    /**
     * Debug Emailing support
     */
    function _doDebug($data, $subject = 'Braintree debug data', $useSession = true) {

        if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email') {

            $data = urldecode($data) . "\n\n";
            if ($useSession)
                $data .= "\nSession data: " . print_r($_SESSION, true);
            zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $subject, $this->code . "\n" . $data, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML' => nl2br($this->code . "\n" . $data)), 'debug');
        }
    }

    /**
     * Initialize the Braintree object for communication to the processing gateways
     */
    function braintree_init() {

        if (MODULE_PAYMENT_BRAINTREE_MERCHANTID != '' && MODULE_PAYMENT_BRAINTREE_PUBLICKEY != '' && MODULE_PAYMENT_BRAINTREE_PRIVATEKEY != '') {

            Braintree\Configuration::environment(MODULE_PAYMENT_BRAINTREE_SERVER);
            Braintree\Configuration::merchantId(MODULE_PAYMENT_BRAINTREE_MERCHANTID);
            Braintree\Configuration::publicKey(MODULE_PAYMENT_BRAINTREE_PUBLICKEY);
            Braintree\Configuration::privateKey(MODULE_PAYMENT_BRAINTREE_PRIVATEKEY);
        } else {
            return FALSE;
        }
    }

    /**
     * Calculate the amount based on acceptable currencies
     */
    function calc_order_amount($amount, $braintreeCurrency, $applyFormatting = false) {
        global $currencies;

        $amount = ($amount * $currencies->get_value($braintreeCurrency));

        if ($braintreeCurrency == 'JPY' || (int) $currencies->get_decimal_places($braintreeCurrency) == 0) {
            $amount = (int) $amount;
            $applyFormatting = FALSE;
        }

        $amount = round($amount, 2);

        return ($applyFormatting ? number_format($amount, $currencies->get_decimal_places($braintreeCurrency)) : $amount);
    }

    /**
     * @return Gateway
     * @throws \Braintree\Exception
     */
    public function gateway(){
        global $messageStack;
        if(
            !defined("MODULE_PAYMENT_BRAINTREE_SERVER") ||
            !defined("MODULE_PAYMENT_BRAINTREE_MERCHANTID") ||
            !defined("MODULE_PAYMENT_BRAINTREE_PUBLICKEY") ||
            !defined("MODULE_PAYMENT_BRAINTREE_PRIVATEKEY")
        ){
            $messageStack->add_session("Braintree configuration not set!", 'error');
        }
        return new Braintree\Gateway([
            'environment' => MODULE_PAYMENT_BRAINTREE_SERVER,
            'merchantId' => MODULE_PAYMENT_BRAINTREE_MERCHANTID,
            'publicKey' => MODULE_PAYMENT_BRAINTREE_PUBLICKEY,
            'privateKey' => MODULE_PAYMENT_BRAINTREE_PRIVATEKEY
        ]);
    }

    /**
     * @param $order_id
     * @return string
     * @throws Exception
     */
    public function getTransactionId($order_id){
        global $db;

        if(empty($order_id) || $order_id <= 0){
            throw new Exception("Order ID is not valid");
        }

        $sql = "SELECT * FROM " . TABLE_BRAINTREE . "  WHERE order_id = :orderID AND parent_txn_id = '' ";
        $sql = $db->bindVars($sql, ':orderID', $order_id, 'integer');
        $zc_btHist = $db->Execute($sql);

        if ($zc_btHist->RecordCount() == 0){
            throw new Exception("Record is not found with ID:$order_id");
        }

        if(empty($zc_btHist->fields['txn_id'])){
            throw new Exception("Transaction ID is not found for this Order");
        }

        return $zc_btHist->fields['txn_id'];
    }

    /**
     * @param $array
     * @param $prop_name
     * @return string
     * @throws Exception
     */
    private function checkGetValue($array,$prop_name){
        if(!is_array($array)){
            throw new Exception("Key array is expected");
        }
        if(!is_string($prop_name) || empty($prop_name)){
            throw new Exception("Invalid property name type");
        }
        if(!isset($array[$prop_name])){
            throw new Exception("Property $prop_name does not exist");
        }
        return $array[$prop_name];
    }

    /**
     * @return cc_validation
     * @throws Exception
     */
    private function retrieveValidatedCCData(){
        global $messageStack;
        include(DIR_WS_CLASSES . 'cc_validation.php');

        $cc_number = $this->checkGetValue($_POST,"bt_cc_number");
        $cc_expiry_month = $this->checkGetValue($_POST,"bt_cc_expdate_month");
        $cc_expiry_year = $this->checkGetValue($_POST,"bt_cc_expdate_year");
        $cc_issue_month = $this->checkGetValue($_POST,"bt_cc_issuedate_month");
        $cc_issue_year = $this->checkGetValue($_POST,"bt_cc_issuedate_year");

        $cc_validation = new cc_validation();
        $check_result = $cc_validation->validate($cc_number,$cc_expiry_month,$cc_expiry_year,$cc_issue_month,$cc_issue_year);

        $error = "";
        switch ($check_result) {
            case -1:
                $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
                break;
            case -2:
                $error = sprintf(TEXT_CCVAL_ERROR_INVALID_MONTH_EXPIRY, $cc_expiry_month);
                break;
            case -3:
                $error = sprintf(TEXT_CCVAL_ERROR_INVALID_YEAR_EXPIRY, $cc_expiry_year);
                break;
            case -4:
                $error = sprintf(TEXT_CCVAL_ERROR_INVALID_YEAR_EXPIRY, $cc_expiry_year);
                break;
            case false:
                $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
                break;
        }

        if (($check_result === false) || ($check_result < 1)) {
            $this->zcLog('before_process - DP-2', 'CC validation results: ' . $error . '(' . $check_result . ')');
            $messageStack->add_session($this->code, $error . '<!-- [' . $this->code . '] -->' . '<!-- result: ' . $check_result . ' -->', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }
        if (!in_array($cc_validation->cc_type, array('Visa', 'MasterCard', 'Switch', 'Solo', 'Discover', 'American Express', 'Maestro'))) {
            $messageStack->add_session($this->code, MODULE_PAYMENT_BRAINTREE_TEXT_BAD_CARD . '<!-- [' . $this->code . ' ' . $cc_validation->cc_type . '] -->', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }

        return $cc_validation;
    }
}
