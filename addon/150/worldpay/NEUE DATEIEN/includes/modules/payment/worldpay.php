<?php
/**
 * @copyright Copyright (c) 2008-9 Philip Clarke
 * @copyright portions Copyright (c) 2009 khalilm
 * @copyright Copyright (c) 2004-2008 duncanad
 * @copyright Copyright (c) 2004 networkdad 
 * @copyright Portions Copyright (c) 2003-2011 Zen Cart
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * Version 2.3 for Zen-Cart German 1.5 2012-04-04 webchills
 */


include_once( (IS_ADMIN_FLAG === true ? DIR_FS_CATALOG_LANGUAGES : DIR_WS_LANGUAGES) . 'german/modules/payment/worldpay.php');


  class worldpay {
    var $code, $title, $description, $enabled, $info_suhosin, $cc_drop;

////////////////////////////////////////////////////
// Class constructor -> initialize class variables.
// Sets the class code, description, and status.
////////////////////////////////////////////////////

    function worldpay() 
	{
      global $db, $order;

	  $this->old_files = array(
		'includes/extra_datafiles/wpcallback_defines.php',
		'includes/languages/english/extra_definitions/wp_cc_accept_defines.php',
		'includes/languages/english/modules/sideboxes/wp_cc_accept.php',
		'includes/languages/english/wpcallback.php',
		'includes/modules/pages/wpcallback/header_php.php',
		'includes/templates/template_default/templates/tpl_wpcallback_default.php'
	  );

		$rmFiles = '';
		foreach($this->old_files as $rm){
			if(file_exists(DIR_FS_CATALOG.$rm)){
				$rmFiles .= '<pre style="color:red; font-weight:bold">'.DIR_FS_CATALOG.$rm.'</pre><br />';
			}
		}
		if($rmFiles != ''){
				$rmFiles = '<p>For security, you are strongly advised to remove these old files from your system</p>'.$rmFiles ;
		}

	  $this->cc_map = array(
	    'AMEX' => 'American Express',
		'DINS' => 'Diners Card',
		'ELV' => 'ELV',
		'JCB' => 'JCB Card',
		'MSCD' => 'Master Card',
		'SOLO' => 'Solo',
		'MAES' => 'Maestro',
		'VISA' => 'Visa',
		'VISD' => 'Visa Delta',
		'VIED' => 'Visa Electron',
		'VISP' => 'Visa Purchasing',
		'0' => 'MODULE_PAYMENT_WORLDPAY_CCMAP'
		) ;


      $this->code = 'worldpay';
      if(defined( 'MODULE_PAYMENT_WORLDPAY_SUSHOSIN_TEXT' )) { $this->info_suhosin = MODULE_PAYMENT_WORLDPAY_SUSHOSIN_TEXT ; }
      $this->description = (IS_ADMIN_FLAG === true) ? MODULE_PAYMENT_WORLDPAY_TEXT_DESCRIPTION.$rmFiles : MODULE_PAYMENT_WORLDPAY_TEXT_DESCRIPTION;

      $this->sort_order = MODULE_PAYMENT_WORLDPAY_SORT_ORDER;
      $this->moduleVersion = '2.3';
      $this->title =  (IS_ADMIN_FLAG === true) ? MODULE_PAYMENT_WORLDPAY_TEXT_ADMIN_DESCRIPTION.' v'.$this->moduleVersion .( ((int)MODULE_PAYMENT_WORLDPAY_TEST_MODE != 0) ? ' <b style="color:red">(Test Mode activated)</b>' : '') : MODULE_PAYMENT_WORLDPAY_TEXT_TITLE;
      $this->enabled = ((MODULE_PAYMENT_WORLDPAY_STATUS == 'True') ? true : false);

		if ((int)MODULE_PAYMENT_WORLDPAY_TEST_MODE !== 0)
        {

//         Neue URL seit August 2011!!!
        $this->form_action_url = 'https://secure-test.worldpay.com/wcc/purchase';
        }
        else
        {
//         Neue URL seit August 2011!!!
        $this->form_action_url = 'https://secure.worldpay.com/wcc/purchase ';
        }

		if ((int)MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID > 0)
		{
			$this->order_status = MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID;
		}
	  
	  if (is_object($order)) $this->update_status();
	  
	}


 function update_status() {
      global $order, $db;
      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_WORLDPAY_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_WORLDPAY_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while (!$check->EOF) 
		{
          if ($check->fields['zone_id'] < 1) 
		  {
            $check_flag = true;
            break;
          } 
		  elseif ($check->fields['zone_id'] == $order->billing['zone_id']) 
		  {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }
        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }


////////////////////////////////////////////////////
// Javascript form validation
// Check the user input submited on checkout_payment.php with javascript (client-side).
// Examples: validate credit card number, make sure required fields are filled in
////////////////////////////////////////////////////
      function javascript_validation() {
        return false;
      }


	  function cc_split($val, $key){
			  $this->cc_drop[] = array('id'=>trim($key), 'text'=>$val);
	  }


		function _draw_radio_menu($select_array, $chkd='') {
		$string = '<ul style="list-style: none">';

		foreach ($select_array as $key=>$val) {
// 			$name = ((zen_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');

			$string .= '<li><input type="radio" name="paymentType" value="' . trim($key) . '"';

 			if ($chkd == $key) $string .= ' CHECKED';

			$string .= ' id="' . strtolower($key . '-paymentType"').  ' onclick="document.getElementById(\'pmt-worldpay\').checked=\'true\';"><label for="'.strtolower($key . '-paymentType').'" class="radioButtonLabel" onclick="document.getElementById(\'pmt-worldpay\').checked=\'true\';">' . $val . '</label></li>';
		}

		return $string.'</ul>';
		}


	  function _cc_map(){

		$arr = explode(',', MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST);
		$out = array(''=> MODULE_PAYMENT_WORLDPAY_CCMAP);
		foreach($arr as $val){
			if(isset($this->cc_map[trim($val)]) ){
				$out[trim($val)] = $this->cc_map[trim($val)];
			}
		}
		
		return $out;

	  }

      function selection() {

		if(sizeof(explode(',', trim(MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST)))>0 && MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST !='--none--' && MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC != 'False'){
			switch(MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC){
			case 'Radio Buttons' :
			return array('id' => $this->code,
						'module' => $this->title.$this->_draw_radio_menu($this->_cc_map(), $_SESSION['paymentType'] ));
			break;
			case 'Select Box':
			$this->cc_drop = array();
			array_walk($this->_cc_map(), array('worldpay', 'cc_split'));
			return array('id' => $this->code,
						'module' => $this->title.' '.zen_draw_pull_down_menu("paymentType", $this->cc_drop, $_SESSION['paymentType'] ) );
			break;
			default:
			return array('id' => $this->code,
						'module' => $this->title);
			}
		}else{
        return array('id' => $this->code,
				'module' => $this->title);
		}

      }

      function pre_confirmation_check() {
		if(isset($_POST) && isset($_POST['paymentType']) ){
			$_SESSION['paymentType'] = $_POST['paymentType'];
		}else{
			unset($_SESSION['paymentType']);
		}
        return false;
      }

      function confirmation() {
        return false;
      }

	  function _build_callback(){

		$ssl = (defined('ENABLE_SSL') && ENABLE_SSL == true) ? 'SSL' : 'NONSSL' ;
		$sid = ( defined('SID') && zen_not_null(SID) ) ? false : true ;
		$callback_url = str_replace( array('http://','https://'),'', zen_href_link(FILENAME_WP_CALLBACK, zen_session_name().'='.zen_session_id() , $ssl, $sid));

		return $callback_url ;
	  
	  }

      function process_button() {
      global $_POST, $languages_id, $shipping_cost, $total_cost, $shipping_selected, $shipping_method, $currencies, $currency, $customer_id , $db, $order;
	  $cartId = zen_session_id();
      $currency = $_SESSION['currency'];
      $OrderAmt = number_format($order->info['total'] * $currencies->get_value($currency), $currencies->get_decimal_places($currency), '.', '') ; 

      //**************************************
      //  Credit card Drop down
      //**************************************
      //Get the CC type  (added to session as otherwise details are lost on a log in / log out
      $CCpaymentType = $_SESSION['paymentType'];
      //**************************************  

      $process_button_string = 
      zen_draw_hidden_field('instId', MODULE_PAYMENT_WORLDPAY_ID) .
//	  zen_draw_hidden_field('accId', MODULE_PAYMENT_ACCOUNT_ID) . // Future development for multiple stores using same WorldPay installation but different bank accounts.
    zen_draw_hidden_field('currency', $currency) .
    
      //**************************************
      //  Credit card Drop down
      //**************************************

      (isset($_SESSION['paymentType']) ? zen_draw_hidden_field('paymentType', $CCpaymentType) : '').
      zen_draw_hidden_field('desc', MODULE_PAYMENT_WORLDPAY_TEXT_PURCHASE .STORE_NAME) .
      zen_draw_hidden_field('cartId', $cartId) .
      zen_draw_hidden_field('amount', $OrderAmt) ;
      if (MODULE_PAYMENT_WORLDPAY_USEPREAUTH == 'True') $process_button_string .= zen_draw_hidden_field('authMode', MODULE_PAYMENT_WORLDPAY_AUTHORIZATION_TYPE);		

	  $worldpay_callback = $this->_build_callback();

	  $street_address = $order->billing['street_address'];
	  $suburb = $order->billing['suburb'];
	  $city = $order->billing['city'];
	  $state = $order->billing['state'];

	  $address = $street_address . '&#10;';
	  if ($suburb) $address.=$suburb . '&#10;';
	  $address.=$city . '&#10;' . $state;



		if(defined('MODULE_PAYMENT_WORLDPAY_TEST_MODE') && MODULE_PAYMENT_WORLDPAY_TEST_MODE != 0){

			switch (MODULE_PAYMENT_WORLDPAY_TEST_RESULT){

			case 'CAPTURED' :
				$process_button_string .= zen_draw_hidden_field('name', 'CAPTURED');
			break;

			case 'REFUSED' :
				$process_button_string .= zen_draw_hidden_field('name', 'REFUSED');
			break;

			case 'ERROR':
				$process_button_string .= zen_draw_hidden_field('name', 'ERROR');
			break;
			
			default:
				$process_button_string .= zen_draw_hidden_field('name', $order->billing['firstname'] . ' ' . $order->billing['lastname']);
			
			}

		}else{
		
		$process_button_string .= zen_draw_hidden_field('name', $order->billing['firstname'] . ' ' . $order->billing['lastname']);

		}

	  
      $process_button_string .=	
        zen_draw_hidden_field('testMode', MODULE_PAYMENT_WORLDPAY_TEST_MODE) .
        zen_draw_hidden_field('address', $address) .
        zen_draw_hidden_field('M_address', $address) .
        zen_draw_hidden_field('postcode', $order->billing['postcode']) .
        zen_draw_hidden_field('M_postcode', $order->billing['postcode']) .
        zen_draw_hidden_field('country', $order->billing['country']['iso_code_2']) .
        zen_draw_hidden_field('tel', $order->billing['telephone']) .
        zen_draw_hidden_field('fax', $order->billing['fax']) .
        zen_draw_hidden_field('email', $order->customer['email_address']) .
		zen_draw_hidden_field('lang', $_SESSION['languages_code']) .
        zen_draw_hidden_field('MC_callback', $worldpay_callback);

      if (MODULE_PAYMENT_WORLDPAY_USEMD5 == 'True') 
	  {
        $md5_signature_fields = 'amount:currency:email';
		$md5_signature = MODULE_PAYMENT_WORLDPAY_MD5KEY . ':'.$OrderAmt.':' . $currency . ':' . $order->customer['email_address'];
	    $md5_signature_md5 = md5($md5_signature);

        $process_button_string .= zen_draw_hidden_field('signatureFields', $md5_signature_fields ) .
                                  zen_draw_hidden_field('signature',$md5_signature_md5);
      }
        return $process_button_string ;
      }


      function before_process() {
      	global $db, $order;

		if (defined('MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD') && $_POST['callbackPW'] != MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD){
			zen_redirect(zen_href_link(FILENAME_CHECKOUT_CONFIRMATION));
			exit;
			return false;
		}else if(!defined('MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD')){
			zen_redirect(zen_href_link(FILENAME_CHECKOUT_CONFIRMATION));
			exit;
			return false;
		}


		$str = array();
		// strip for xss
			foreach($_POST as $key=>$val){
				$_POST[$key] = htmlentities(stripslashes($val));
			}
			foreach($_REQUEST as $key=>$val){
				$_REQUEST[$key] = htmlentities(stripslashes($val));
			}

		$str['POST'] = base64_encode(serialize($_POST));
		$str['SESSION'] = base64_encode(serialize($_SESSION));
		$str['SERVER'] = base64_encode(serialize($_SERVER));
		$str['REQUEST'] = base64_encode(serialize($_REQUEST));
		
		if($_REQUEST['transStatus'] == 'C'){
				$_POST['transId'] = 'Cancelled';
				$_REQUEST['transId'] = 'Cancelled';
		}

		$db->Execute("INSERT INTO `".TABLE_WORLDPAY_PAYMENTS."` (cartId, worldpay_transaction_id, POST, SESSION, SERVER, REQUEST) VALUES ('".zen_db_input($_POST['cartId'])."', '".zen_db_input($_POST['transId'])."', '". $str['POST'] ."', '". $str['SESSION'] ."', '". $str['SERVER'] ."', '". $str['REQUEST'] ."')");

		$this->wpId = $db->Insert_ID();
		
		// carry out security check and alter info if there is a problem.

		if ( isset($_REQUEST['wafMerchMessage']) && trim($_REQUEST['wafMerchMessage']) != '') {
			$order->info['payment_method'] = MODULE_PAYMENT_WORLDPAY_TEXT_PAYMENTMETHOD;
			$this->title = MODULE_PAYMENT_WORLDPAY_TEXT_PAYMENTMETHOD;
			$GLOBALS[$_SESSION['payment']]->auth_code = "Your customer DOES NOT SEE this message.\n\n".( ($_REQUEST['wafMerchMessage']=='waf.caution') ?  MODULE_PAYMENT_WORLDPAY_CAUTION : MODULE_PAYMENT_WORLDPAY_WARNING ).
			"\n".
			'go to Admin > Customers > Worldpay Payments WP#'. $this->wpId."\n\n" ;
		}
			$GLOBALS[$_SESSION['payment']]->transaction_id = zen_db_input($_POST['transId']) ;

		return true;

      }

		function after_order_create($insert_id){

      	global $db, $order;


		$db->Execute("UPDATE `".TABLE_WORLDPAY_PAYMENTS."` SET order_id = '".$insert_id."' WHERE cartId = '".$_POST['cartId']."' AND worldpay_transaction_id='".$_POST['transId']."'");

		if( defined('MODULE_PAYMENT_WORLDPAY_DISCREET') && MODULE_PAYMENT_WORLDPAY_DISCREET=='False' ){

		$totMatch = (isset($_REQUEST['wafMerchMessage'])) ? "Merchant Warning Issued\n" : '' ;

        $totMatch .= ((strtolower($_REQUEST['country'])==strtolower($order->billing['country']['iso_code_2']))) ? MODULE_PAYMENT_WORLDPAY_COUNTRY_MATCH : MODULE_PAYMENT_WORLDPAY_COUNTRY_MISMATCH ;

		$totMatch .= "\n";;

        $totMatch .= ( ($_REQUEST['authCurrency']==$order->info['currency']) && (strval($_REQUEST['authAmount'])==strval($order->info['total'])) ) ? MODULE_PAYMENT_WORLDPAY_TOTALS_MATCH : MODULE_PAYMENT_WORLDPAY_TOTALS_MISMATCH ;

		$totMatch .= "\n";;

        $totMatch .= ((strtolower($_REQUEST['address'])==strtolower($_REQUEST['M_address']))) ? MODULE_PAYMENT_WORLDPAY_ADDRESS_MATCH : MODULE_PAYMENT_WORLDPAY_ADDRESS_MISMATCH ;

		$totMatch .= "\n";;

        $totMatch .= ((strtolower($_REQUEST['postcode'])==strtolower($_REQUEST['M_postcode']))) ? MODULE_PAYMENT_WORLDPAY_POSTCODE_MATCH : MODULE_PAYMENT_WORLDPAY_POSTCODE_MISMATCH ;

// 		$totMatch .= zen_href_link(FILENAME_WORLDPAY, '&wpId=' . $this->wpId);

		$sql_data_array = array('orders_id' => $insert_id,
                            'orders_status_id' => $order->info['order_status'],
                            'date_added' => 'now()',
                            'customer_notified' => '0',
                            'comments' => $totMatch);

		zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

		}

		return true;

		}

      function after_process() {
        return false;
      }

      function output_error() {
        return false;
      }
	
      function check() {
      global $db;
        if (!isset($this->_check)) {
          $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_WORLDPAY_STATUS'");
        $this->_check = $check_query->RecordCount();
        }
      return $this->_check;
      }


    function wp_cfg_select_multioption($select_array, $key_value, $key = '') {
    	$i=0;
// 		for($i=0; $i<sizeof($select_array); $i++) {
		foreach($select_array as $skey=>$val) {
		$name = (($key) ? 'configuration[' . $key . '][]' : 'configuration_value');
		$string .= '<br><input type="checkbox" name="' . $name . '" value="' . $skey . '"';
		$key_values = explode( ", ", $key_value);
		if ( in_array($skey, $key_values) ) $string .= ' CHECKED';
		$string .= ' id="' . strtolower($skey . '-' . $name) . '"> ' . '<label for="' . strtolower($val . '-' . $name) . '" class="inputSelect">' . $val . '</label>' . "\n";
		}
		$string .= '<input type="hidden" name="' . $name . '" value="--none--">';
		return $string;
    }


      function install() {
      /* db sort order ignored, values sorted by key order in the key func below.*/
      global $db;

	  $sql = "SHOW TABLES LIKE '". TABLE_WORLDPAY_PAYMENTS ."'";
	  $prevDBSetup = $db->Execute($sql);

	  if(!$prevDBSetup->RecordCount()){
	  	$sql = "CREATE TABLE `". TABLE_WORLDPAY_PAYMENTS ."` (id int auto_increment primary key, cartId varchar(255), worldpay_transaction_id varchar(255), order_id INT(11) NOT NULL, POST mediumblob, SERVER mediumblob, SESSION mediumblob, REQUEST mediumblob)";
		$db->Execute($sql);
	  }

      $db->Execute("REPLACE INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, date_added) VALUES ('MODULE_PAYMENT_WORLDPAY_VERSION', '".$this->moduleVersion."', '6', now())");


      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable WorldPay Module', 'MODULE_PAYMENT_WORLDPAY_STATUS', 'True', 'Do you want to accept WorldPay payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      // www.zen-cart.at languages_id==43 START
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('WorldPay Modul aktivieren?', 'MODULE_PAYMENT_WORLDPAY_STATUS', '43', 'Wollen Sie Kreditkartenzahlung via WorldPay anbieten?', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Diskretion einschalten?', 'MODULE_PAYMENT_WORLDPAY_DISCREET', '43', 'Wenn WorldPay einen Warnhinweis rückmeldet, wird dieser immer gemailt und erscheint in der Administration unter Kunden > WorldPay Zahlungen. Beides sieht der Kunde nicht. Was der Kunde allerdings sehen kann, sind Meldungen auf der Bestellseite, wenn z.B. Postleitzahl oder Land nicht übereinstimmen. Solche Hinweise sind auch in der Bestellhistory im Kommentar ersichtlich. Wenn Sie hier auf True stellen (Voreinstellung), dann sieht der Kunde diese Hinweise nicht. Achten Sie aber dann unbedingt darauf, dass Sie solche Hinweise in den Emails oder in der Administration nicht übersehen. Wenn Sie hier auf False stellen, dann sieht der Kunde alle Warnhinweise, die von WorldPay rückgemeldet werden.', now())");     
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Debugging aktivieren?', 'MODULE_PAYMENT_WORLDPAY_DEBUG', '43', 'Wenn Sie das Debugging aktivieren, erhalten Sie Debugmeldungen bei jeder Transaktion via Email. Posten Sie NIEMALS die darin enthaltenen Informationen in einem Support-Forum!', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Emails für Debugging', 'MODULE_PAYMENT_WORLDPAY_DEBUG_LIST', '43', 'Standardmäßig ist das die Shop Owner Adresse. Wenn Sie weitere Emailadressen angeben wollen, trennen Sie diese mit einem Komma oder einem Strichpunkt.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('WorldPay Installations ID', 'MODULE_PAYMENT_WORLDPAY_ID', '43', 'Tragen Sie hier Ihre WorldPay Installations ID / Select Junior ID ein', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Transaktionsmodus', 'MODULE_PAYMENT_WORLDPAY_TEST_MODE', '43', 'Test oder Live', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Transaktionsmeldungen', 'MODULE_PAYMENT_WORLDPAY_TEST_RESULT', '43', 'Dies betrifft nur den Testmodus. Diese Rückmeldungscodes erscheinen dann im Namensfeld bei der Bestellung.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Payment Response Passwort', 'MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD', '43', 'Dieses Payment Response Passwort müssen Sie auch in Ihrer WorldPay Installationskonfiguration angeben.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('MD5 Key', 'MODULE_PAYMENT_WORLDPAY_MD5KEY', '43', 'Ihr MD5 Secret Key. Muss auch in Ihrer WorldPay Installations Konfiguration eingetragen werden.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('MD5 verwenden?', 'MODULE_PAYMENT_WORLDPAY_USEMD5', '43', 'Soll MD5 Verschlüsselung für die Transaktionen verwendet werden?', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Anzeigereihenfolge', 'MODULE_PAYMENT_WORLDPAY_SORT_ORDER', '43', 'Sortierreihenfolge für das WorldPay Zahlungsmodul. Niedrigste Werte werden zuerst angezeigt.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Vorautorisierung verwenden?', 'MODULE_PAYMENT_WORLDPAY_USEPREAUTH', '43', 'Wollen Sie Zahlungen erst zunächst autorisieren? Voreinstellung: False. Falls Sie diese Variante nutzen wollen, müssen Sie das erst bei WorldPay anfordern.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus', 'MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die per WorldPay bezahlt werden?', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Vorautorisierung', 'MODULE_PAYMENT_WORLDPAY_AUTHORIZATION_TYPE', '43', 'Modus der Vorautorisierung (A = Pay Now, E = Pre Auth). Wird ignoriert falls Vorautorisierung deaktiviert ist', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zone', 'MODULE_PAYMENT_WORLDPAY_ZONE', '43', 'Wenn Sie hier eine Zone auswählen, dann wird WorldPay Kreditkartenzahlung nur in dieser Zone angeboten.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Akzeptierte Kreditkarten anzeigen?', 'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC', '43', 'Auswahl der akzeptierten Kreditkarten bereits im Shop anzeigen? <br/>Die Auswahl der Kreditkarte bereits im Shop erpart dem Kunden einen Schritt auf der WorldPay Zahlungsseite, da er schon vorher auswählen kann, mit welcher Kreditkarte gezahlt werden soll.<br/>Voreinstellung: False<br/>Wenn Sie das nutzen wollen stellen Sie hier ob die Auswahl mit Radiobutton oder Checkbox angeboten werden soll.', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Akzeptierte Kreditkarten', 'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST', '43', 'Wählen Sie hier die Kreditkarten aus, die Ihnen von WorldPay erlaubt worden sind.', now())");
      // www.zen-cart.at languages_id==43 END
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Be discreet?', 'MODULE_PAYMENT_WORLDPAY_DISCREET', 'True', 'If worldpay issues a caution or a warning,<ul><li>Always emailed</li><li>It appears in the  Customers&gt;WorldPay_Payments page</li></ul>
      which your customer does not see.<br />However, if this is set to <b>True</b>, worldpay warnings and failures will <u>not</u> appear on the order page and the customer will not see country or postcode mismatch warning messages in ::my account::. This means you <i>might</i> possibly miss seeing a warning <i>if</i> you didn\'t read the emails or look at the WorldPay Payments page.<br /> If this is set to <b>False</b>, <u>your customer will see any warnings</u> issued by WorldPay.', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Diagnostic: Suhosin Check', 'MODULE_PAYMENT_WORLDPAY_SUHOSIN', '".$this->info_suhosin."', '6', '1', 'worldpay_external_suhosin( '/* set function for form */, 'worldpay->_full_check_suhosin'/* use function for loaded display */, now())");
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Debugging<br /><i style=\"color: red; font-weight: normal;\">NEVER</i> <i style=\"font-weight: normal;\">put a debug email on a forum asking for help!</i>', 'MODULE_PAYMENT_WORLDPAY_DEBUG', 'False', 'Emails out debugging info to debug list.', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      

// 	  $prevInstallTest = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_WORLDPAY_DEBUG_LIST'");

	  if(!defined('MODULE_PAYMENT_WORLDPAY_DEBUG_LIST')){
      $db->Execute("REPLACE INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Debugging list', 'MODULE_PAYMENT_WORLDPAY_DEBUG_LIST', '".STORE_OWNER_EMAIL_ADDRESS."', 'Separate Emails with either a comma \',\' or a semi-colon \';\'', '6', '1', '', now())");
      
      }


// 	  $prevInstallTest = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_WORLDPAY_ID'");

	  if(!defined('MODULE_PAYMENT_WORLDPAY_ID')){
      $db->Execute("REPLACE INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Worldpay Installation ID', 'MODULE_PAYMENT_WORLDPAY_ID', '00000', 'Your WorldPay Select Junior ID', '6', '3', now())");
      
      }

	  if(!defined('MODULE_PAYMENT_WORLDPAY_TEST_MODE')){
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Transaction Mode', 'MODULE_PAYMENT_WORLDPAY_TEST_MODE', '100', 'Test or Live mode, set the test type in the Transaction result box next', '6', '4', 'zen_cfg_select_drop_down(array( array( \'id\'=>\'0\', \'text\'=>\'Live.\' ), array( \'id\'=>\'100\', \'text\'=> \'Test mode.\') ), ', 'worldpay->_get_transaction_status', now())");
     
      }

      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Transaction Result', 'MODULE_PAYMENT_WORLDPAY_TEST_RESULT', 'AUTHORISED', 'Only Applicable during Test Mode Above, these codes appear in the person\'s name field', '6', '4', 'zen_cfg_select_option(array( \'AUTHORISED\', \'CAPTURED\', \'REFUSED\', \'ERROR\' ), ', now())");
      

// 	  $prevInstallTest = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD'");

	  if(!defined('MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD')){
	  $db->Execute("REPLACE INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Payment Response Password', 'MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD', '', 'Payment Response Password. Must also be entered into Worldpay installation config', '6', '5', now())");
	 

	  }

// 	  $prevInstallTest = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_WORLDPAY_USEMD5'");

	  if(!defined('MODULE_PAYMENT_WORLDPAY_USEMD5')){
      $db->Execute("REPLACE INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use MD5?', 'MODULE_PAYMENT_WORLDPAY_USEMD5', 'True', 'Use MD5 encryption for transactions?', '6', '6', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      
      }

// 	  $prevInstallTest = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_WORLDPAY_MD5KEY'");

	  if(!defined('MODULE_PAYMENT_WORLDPAY_MD5KEY')){
      $db->Execute("REPLACE INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('MD5 secret key', 'MODULE_PAYMENT_WORLDPAY_MD5KEY', '', 'MD5 secret key. Must also be entered into Worldpay installation config', '6', '7', now())");
	   
	  }

      if(!defined('MODULE_PAYMENT_WORLDPAY_SORT_ORDER')){
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_WORLDPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '8', now())");
      
      }

      if(!defined('MODULE_PAYMENT_WORLDPAY_USEPREAUTH')){
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use Pre-Authorisation?', 'MODULE_PAYMENT_WORLDPAY_USEPREAUTH', 'False', 'Do you want to pre-authorise payments? Default=False. You need to request this from WorldPay before using it.', '6', '9', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
     
      }

      if(!defined('MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID')){
      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Order Status', 'MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '10', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
     
      }


      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Pre-Auth', 'MODULE_PAYMENT_WORLDPAY_AUTHORIZATION_TYPE', 'A', 'The mode you are working in (A = Pay Now, E = Pre Auth). Ignored if Use PreAuth is False.', '6', '11', now())");

      $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_WORLDPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '12', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now() )");

// 	$prevInstallTest = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC'");

	if(!defined('MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC')){
		$db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Accepted Cards?', 'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC', 'False', 'Accepted Credit cards list. Tick each one that is valid for your worldpay merchant account.<br />This gives the customer a selection of cards that you accept<br />(This is a customer convenience and removes one WorldPay Payment page from their experience and gets them back to your site quicker).', '6', '9', 'zen_cfg_select_option(array(\'False\', \'Select Box\', \'Radio Buttons\'), ', now())");

		$db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Accepted credit cards.', 'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST', '', 'Tick the credit cards worldpay has authorized you to accept.', '6', '8', 'worldpay->wp_ech', '\$module->wp_cfg_select_multioption(array(
		\'AMEX\' => \'American Express\',
		\'DINS\' => \'Diners Card\',
		\'ELV\' => \'ELV\',
		\'JCB\' => \'JCB Card\',
		\'MSCD\' => \'Master Card\',
		\'SOLO\' => \'Solo\',
		\'MAES\' => \'Maestro\',
		\'VISA\' => \'Visa\',
		\'VISD\' => \'Visa Delta\',
		\'VIED\' => \'Visa Electron\',
		\'VISP\' => \'Visa Purchasing\'
		), ', now() )");
		
	}


		foreach($this->old_files as $rm){
			if(file_exists(DIR_FS_CATALOG.$rm)){
				@unlink(DIR_FS_CATALOG.$rm);
			}
		}

      }


	  function wp_ech($arr){
// 	  	echo $arr;
	  	$arr = explode(',', $arr);
	  	$str = '';
		foreach($arr as $key){
			$str .= $this->cc_map[trim($key)].'<br />' ;
		}
		return $str;
	  }

      function remove() {
	  global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->upgrade_keys()) . "')");
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->remove_german()) . "')");
      }

////////////////////////////////////////////////////
// Create our Key - > Value Arrays
////////////////////////////////////////////////////
 function keys() {

	$this->_keys = array(
	'MODULE_PAYMENT_WORLDPAY_STATUS',
	'MODULE_PAYMENT_WORLDPAY_TEST_MODE',
	'MODULE_PAYMENT_WORLDPAY_TEST_RESULT',
	'MODULE_PAYMENT_WORLDPAY_DEBUG',
	'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC',
	'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST',
	'MODULE_PAYMENT_WORLDPAY_DISCREET',
	'MODULE_PAYMENT_WORLDPAY_DEBUG_LIST',
	'MODULE_PAYMENT_WORLDPAY_ID',
	'MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD',
	'MODULE_PAYMENT_WORLDPAY_USEMD5',
	'MODULE_PAYMENT_WORLDPAY_MD5KEY',
	'MODULE_PAYMENT_WORLDPAY_SORT_ORDER',
	'MODULE_PAYMENT_WORLDPAY_USEPREAUTH',
	'MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID',
	'MODULE_PAYMENT_WORLDPAY_AUTHORIZATION_TYPE',
	'MODULE_PAYMENT_WORLDPAY_ZONE');
	
 	if($this->_check_suhosin()){
 	 array_unshift( $this->_keys, 'MODULE_PAYMENT_WORLDPAY_SUHOSIN' ) ;
 	}
      return $this->_keys;
    }

 function upgrade_keys() {
      return array(
	'MODULE_PAYMENT_WORLDPAY_STATUS',
	'MODULE_PAYMENT_WORLDPAY_SUHOSIN',
	'MODULE_PAYMENT_WORLDPAY_DEBUG',
	'MODULE_PAYMENT_WORLDPAY_DISCREET',
// 	'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC',
// 	'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST',
// 	'MODULE_PAYMENT_WORLDPAY_DEBUG_LIST',
// 	'MODULE_PAYMENT_WORLDPAY_ID',
	'MODULE_PAYMENT_WORLDPAY_TEST_MODE',
	'MODULE_PAYMENT_WORLDPAY_TEST_RESULT',
// 	'MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD',
// 	'MODULE_PAYMENT_WORLDPAY_USEMD5',
// 	'MODULE_PAYMENT_WORLDPAY_MD5KEY',
	'MODULE_PAYMENT_WORLDPAY_SORT_ORDER',
	'MODULE_PAYMENT_WORLDPAY_USEPREAUTH',
	'MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID',
	'MODULE_PAYMENT_WORLDPAY_AUTHORIZATION_TYPE',
	'MODULE_PAYMENT_WORLDPAY_ZONE');
    }
    
  function remove_german() {
      return array(
	'MODULE_PAYMENT_WORLDPAY_STATUS',
	'MODULE_PAYMENT_WORLDPAY_SUHOSIN',
	'MODULE_PAYMENT_WORLDPAY_DEBUG',
	'MODULE_PAYMENT_WORLDPAY_DISCREET',
 	'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC',
 	'MODULE_PAYMENT_WORLDPAY_ACCEPTED_CC_LIST',
 	'MODULE_PAYMENT_WORLDPAY_DEBUG_LIST',
 	'MODULE_PAYMENT_WORLDPAY_ID',
	'MODULE_PAYMENT_WORLDPAY_TEST_MODE',
	'MODULE_PAYMENT_WORLDPAY_TEST_RESULT',
 	'MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD',
 	'MODULE_PAYMENT_WORLDPAY_USEMD5',
 	'MODULE_PAYMENT_WORLDPAY_MD5KEY',
	'MODULE_PAYMENT_WORLDPAY_SORT_ORDER',
	'MODULE_PAYMENT_WORLDPAY_USEPREAUTH',
	'MODULE_PAYMENT_WORLDPAY_ORDER_STATUS_ID',
	'MODULE_PAYMENT_WORLDPAY_AUTHORIZATION_TYPE',
	'MODULE_PAYMENT_WORLDPAY_ZONE');
    }

	function _check_suhosin(){
		return include DIR_FS_CATALOG.'/wpcheck.php';
	}

	function _full_check_suhosin(){

		return $this->info_suhosin."<br />".$this->_check_suhosin_extension();

	}


	function _check_suhosin_extension(){

		$admin_suhosin = '<i>Additional:</i> session encryption is '.((@ini_get('suhosin.session.encrypt') == '1' || strtolower(@ini_get('suhosin.session.encrypt')) == 'on') ? 'enabled' : 'disabled').' in <i>admin</i> area' ;


		$handle = @fopen(HTTP_SERVER . DIR_WS_CATALOG .'/worldpay_suhosin.php', "r");
		$contents = '';
		if($handle){
			while (!feof($handle)) {
			$contents .= fread($handle, 8192);
			}
			fclose($handle);
		}
		
		if( ($contents == '1') ){
			return '<b style="color:red">Warning:</b> Session encryption is <u>enabled in store.</u><br />'.$admin_suhosin;
		}

		return '<b style="color:green">Verified:</b> Session encryption is disabled in store.<br />'.$admin_suhosin;

	}

	function _get_transaction_status($submitted){
		$wp = array( array( 'id'=>'0', 'text'=>'Live.' ), array( 'id'=>'100', 'text'=> 'Test mode.') ) ;
		while(list($key,$val) = each($wp)){
			if($val['id']==$submitted){
				return '<b style="color:red">'.$val['text'].'</b>';
				break;
			}
		}
	}



}

// 	  function cc_options($unk){
// 
// 		print '<h1>'.$unk.'</h1>';
// 
// 		$viable = array(
// 		"AMEX" => "American Express",
// 		"DINS" => "Diners Card",
// 		"ELV" => "ELV",
// 		"JCB" => "JCB Card",
// 		"MSCD" => "Master Card",
// 		"SOLO" => "Solo",
// 		"MAES" => "Maestro",
// 		"VISA" => "Visa",
// 		"VISD" => "Visa Delta",
// 		"VIED" => "Visa Electron",
// 		"VISP" => "Visa Purchasing",
// 		"0" => "I will choose a method later"
// 		);
// 
// 		$out = '';
// 		foreach($viable as $key=>$val){
// 			$out .= '<input type="checkbox" name="cc['.$key.']" /> : '.$val.'<br />';
// 		}
// 
// 		return $out;
// 
// 	  }


	function worldpay_external_suhosin(){
		$wp = new worldpay;
		return $wp->_check_suhosin_extension();
	}




?>