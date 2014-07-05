<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2003 Jason LeBaron 
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id: linkpoint_api.php 627 2010-08-30 15:05:14Z webchills $
 */
 
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ADMIN_TITLE', 'Linkpoint/YourPay API');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CATALOG_TITLE', 'Kreditkarte');


  if (MODULE_PAYMENT_LINKPOINT_API_STATUS == 'True') {
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DESCRIPTION', '<a target="_blank" href="http://www.zen-cart.com/index.php?main_page=infopages&pages_id=30">Klicken Sie hier um einen neuen Account zu erstellen</a><br /><br /><a target="_blank" href="https://secure.linkpt.net/lpcentral/servlet/LPCLogin">Linkpoint/YourPay API Merchant Area</a><br /><br /><strong>Voraussetzungen:</strong><br /><hr />*<strong>LinkPoint oder YourPay Account</strong> (benutzen Sie den obigen Link zum Erstellen eines Accounts)<br />*<strong>cURL wird benötigt </strong>und MUSS in PHP von Ihrem Webhoster compiliert worden sein<br />*<strong>Port 1129</strong> wird für die bidirectionale Kommunikation mit dem Gateway benutzt. Der Port muss bei ihrem Webhoster frei bzw. im Router geöffnet sein<br />*<strong>PEM RSA Key File </strong>Digitales Zertifikat:<br />Um Ihr digitales Zertifikat (.PEM) zu erhalten und hochzuladen:<br />- Melden Sie sich auf der Linkpoint/Yourpay Website in Ihrem Kundenkonto an.<br />- Klicken Sie auf Support im Main Menü.<br />- Klicken Sie auf Download Center im Sidebox Menü.<br />- Klicken Sie auf Download neben der "Store PEM File" Sektion auf der rechten Seite.<br />- Geben Sie die notwendigen Informationen ein um den Download zu starten. Sie brauchen dazu entweder ihre aktuelle SSN oder ihre Steuernummer, die Sie während des Anlegens des Kundenkontos angegeben haben.<br />- Laden Sie die erhaltene Date im Order includes/modules/payment/linkpoint_api/ hoch (bsp. includes/modules/payment/linkpoint_api/XXXXXX.pem - xxxxxx ist ihre Shop ID).');

  } else { 

  }
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_OWNER', 'Kreditkarteninhaber:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_NUMBER', 'Kreditkartennummer:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CVV', 'Kreditkarten Prüfziffer:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_EXPIRES', 'Kreditkarten Ablaufdatum:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_OWNER', '* Der Kreditkarteninhaber muss mindestens eine Länge von ' . CC_OWNER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_NUMBER', '* Die Kreditkartennummer muss mindestens eine Länge von ' . CC_NUMBER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_CVV', '* Sie müssen die drei- oder vierstelligen Nummer auf der Rückseite Ihrer Kreditkarte eingeben');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR', 'Kreditkarten Fehler!');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_MESSAGE', 'Ihre Kreditkarte wurde abgelehnt. Bitte geben Sie Ihre Kreditkarten Informationen erneut ein, versuchen eine andere Kreditkarte oder nehmen mit uns Kontakt auf.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_AVS_MESSAGE', 'Ungültige Rechnungsadresse!  Bitte geben Sie Ihre Kreditkarten Informationen erneut ein, versuchen eine andere Kreditkarte oder nehmen mit uns Kontakt auf.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_GENERAL_MESSAGE', 'Ihre Kreditkarte wurde abgelehnt. Bitte geben Sie Ihre Kreditkarten Informationen erneut ein, versuchen eine andere Kreditkarte oder nehmen mit uns Kontakt auf.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_POPUP_CVV_LINK', 'Was ist das?');
define('ALERT_LINKPOINT_API_PREAUTH_TRANS', '***NUR GÜLTIGKEITSPRÜFUNG -- DIE GEBÜHREN WERDEN SPÄTER VOM ADMINISTRATOR FESTGELEGT.***');
define('ALERT_LINKPOINT_API_TEST_FORCED_SUCCESSFUL', 'Bemerkung: Dieses ist eine TEST Transaktion... es wird ein erfolgreicher Abschluß erzwungen.');
define('ALERT_LINKPOINT_API_TEST_FORCED_DECLINED', 'Bemerkung: Dieses ist eine TEST Transaktion... es wird ein NICHT erfolgreicher Abschluß erzwungen.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_NOT_CONFIGURED', '<span class="alert">&nbsp;(Bemerkung: Das Modul wurde bisher nicht konfiguriert)</span>');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR_CURL_NOT_FOUND', 'CURL Funktionen wurden nicht gefunden - diese werden zwingend benötigt für das Linkpoint API Zahlungsmodul');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_FAILURE_MESSAGE', 'Wir entschuldigigen uns für die Unannehmlichkeiten, aber es ist momentan nicht möglich mit der Kreditkartengesellschaft Kontakt aufzunehmen um die Gültigkeit der Kreditkarte zu überprüfen. Bitte nehmen Sie für alternative Zahlungsmöglichkeitenarten mit uns Kontakt auf.');

  // note: the above error can occur as a result of:
     // - port 1129 not open for bidirectional communication 
     // - CURL is not installed or not functioning
     // - incorrect or invalid or "no" .PEM file found in modules/payment/linkpoint_api folder
     // - In general it means that there was no valid connection made to the gateway... it was stopped before it got outside your server
  
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_GENERAL_ERROR', 'Es tut uns leid. Während der Verarbeitung Ihrer Kreditkarten Informationen ist ein Systemfehler aufgetreten. Ihre Informationen sind sicher, konnten aber nicht verarbeitet werden. Bitte benachrichtigen Sie uns um eine alternative Zahlungsmöglichkeit zu vereinbaren.');

  // note: the above error is a general error message which is reported when serious and known error conditions occur. Further details are given immediately following the display of this message. If database storage is enabled, details can be found there too.
  
  
  // Admin definitions

define('MODULE_PAYMENT_LINKPOINT_API_LINKPOINT_ORDER_ID', 'Linkpoint Auftragsnummer:');
define('MODULE_PAYMENT_LINKPOINT_API_AVS_RESPONSE', 'AVS Antwort:');
define('MODULE_PAYMENT_LINKPOINT_API_MESSAGE', 'Antwortmeldung:');
define('MODULE_PAYMENT_LINKPOINT_API_APPROVAL_CODE', 'Annahmecode:');
define('MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_REFERENCE_NUMBER', 'Referenznummer:');
define('MODULE_PAYMENT_LINKPOINT_API_FRAUD_SCORE', 'Glaubwürdigkeits Score:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_TEST_MODE', '<span class="alert">&nbsp;(Bemerkung: Das Modul ist im TESTMODUS)</span>');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ORDERTYPE', 'Order Type:');


// admin tools:
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_NO_MATCHING_ORDER_FOUND', 'Error: Could not find transaction details for the record specified.');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_BUTTON_TEXT', 'Do Refund');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_REFUND_CONFIRM_ERROR', 'Error: You requested to do a refund but did not check the Confirmation box.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_INVALID_REFUND_AMOUNT', 'Error: You requested a refund but entered an invalid amount.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CC_NUM_REQUIRED_ERROR', 'Error: You requested a refund but didn\'t enter the last 4 digits of the Credit Card number.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_REFUND_INITIATED', 'Refund Initiated. Transaction ID: %s - Order ID: %s');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CAPTURE_CONFIRM_ERROR', 'Error: You requested to do a capture but did not check the Confirmation box.');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_BUTTON_TEXT', 'Do Capture');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_INVALID_CAPTURE_AMOUNT', 'Error: You requested a capture but need to enter an amount.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_TRANS_ID_REQUIRED_ERROR', 'Error: You need to specify a Transaction ID.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CAPT_INITIATED', 'Funds Capture initiated. Amount: %s.  Transaction ID: %s - AuthCode: %s');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID_BUTTON_TEXT', 'Do Void');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_VOID_CONFIRM_ERROR', 'Error: You requested a Void but did not check the Confirmation box.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_VOID_INITIATED', 'Void Initiated. Transaction ID: %s - Order ID: %s ');

  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_TITLE', '<strong>Refund Transactions</strong>');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND', 'You may refund money to the customer\'s original credit card here.');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_REFUND_CONFIRM_CHECK', 'Check this box to confirm your intent: ');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_AMOUNT_TEXT', 'Enter the amount you wish to refund');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_DEFAULT_TEXT', 'enter Trans.ID');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_CC_NUM_TEXT', 'Enter the last 4 digits of the Credit Card you are refunding.');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_TRANS_ID', 'Enter the original Transaction ID <em>(which usually looks like this: <strong>1193684363</strong>)</em>:');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_TEXT_COMMENTS', 'Notes (will show on Order History):');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_DEFAULT_MESSAGE', 'Refund Issued');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_REFUND_SUFFIX', 'You may refund an order up to the amount already captured. You must supply the last 4 digits of the credit card number used on the initial order.<br />Refunds cannot be issued if the card has expired. To refund an expired card, issue a credit using the merchant terminal instead.');

  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_TITLE', '<strong>Capture Transactions</strong>');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE', 'You may capture previously-authorized funds here:');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_AMOUNT_TEXT', 'Enter the amount to Capture: ');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CAPTURE_CONFIRM_CHECK', 'Check this box to confirm your intent: ');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_TRANS_ID', 'Enter the original Order Number <em>(ie: <strong>5138-i4wcYM</strong>)</em> : ');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_DEFAULT_TEXT', 'enter Order Number');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_TEXT_COMMENTS', 'Notes (will show on Order History):');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_DEFAULT_MESSAGE', 'Settled previously-authorized funds.');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_CAPTURE_SUFFIX', 'Captures must be performed within 2-10 days of the original authorization depending on your merchant bank requirement. You may  capture an order ONLY ONCE. <br />Please be sure the amount specified is correct.<br />If you leave the amount blank, the original amount will be used instead.');

  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID_TITLE', '<strong>Voiding Transactions</strong>');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID', 'You may void a transaction (preauth/capture/refund) which has not yet been settled. Please enter the original Transaction ID <em>(usually looks like this: <strong>1193684363</strong>)</em>:');
  define('MODULE_PAYMENT_LINKPOINT_API_TEXT_VOID_CONFIRM_CHECK', 'Check this box to confirm your intent:');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID_DEFAULT_TEXT', 'enter Trans.ID');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID_TEXT_COMMENTS', 'Notes (will show on Order History):');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID_DEFAULT_MESSAGE', 'Transaction Canceled');
  define('MODULE_PAYMENT_LINKPOINT_API_ENTRY_VOID_SUFFIX', 'Voids must be completed before the original transaction is settled in the daily batch, which occurs at 7:00PM Pacific Time.');


?>