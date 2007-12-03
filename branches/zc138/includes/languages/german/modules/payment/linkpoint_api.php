<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2003 Jason LeBaron 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2006-11-02
 * @version $Id: linkpoint_api.php 4657 2006-10-02 01:46:39Z drbyte $
 */
 
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ADMIN_TITLE', 'Linkpoint/YourPay API');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CATALOG_TITLE', 'Kreditkarte');


  if (MODULE_PAYMENT_LINKPOINT_API_STATUS == 'True') {
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DESCRIPTION', '<a target="_blank" href="http://www.zen-cart.com/index.php?main_page=infopages&pages_id=30">Klicken Sie hier um einen neuen Account zu erstellen</a><br /><br /><a target="_blank" href="https://secure.linkpt.net/lpcentral/servlet/LPCLogin">Linkpoint/YourPay API Merchant Area</a><br /><br /><strong>Voraussetzungen:</strong><br /><hr />*<strong>LinkPoint oder YourPay Account</strong> (benutzen Sie den obigen Link zum Erstellen eines Accounts)<br />*<strong>cURL wird ben&ouml;tigt </strong>und MUSS in PHP von Ihrem Webhoster compiliert worden sein<br />*<strong>Port 1129</strong> wird f&uuml;r die bidirectionale Kommunikation mit dem Gateway benutzt. Der Port muss bei ihrem Webhoster frei bzw. im Router ge&ouml;ffnet sein<br />*<strong>PEM RSA Key File </strong>Digitales Zertifikat:<br />Um Ihr digitales Zertifikat (.PEM) zu erhalten und hochzuladen:<br />- Melden Sie sich auf der Linkpoint/Yourpay Website in Ihrem Kundenkonto an.<br />- Klicken Sie auf Support im Main Men&uuml;.<br />- Klicken Sie auf Download Center im Sidebox Men&uuml;.<br />- Klicken Sie auf Download neben der &quot;Store PEM File&quot; Sektion auf der rechten Seite.<br />- Geben Sie die notwendigen Informationen ein um den Download zu starten. Sie brauchen dazu entweder ihre aktuelle SSN oder ihre Steuernummer, die Sie w&auml;hrend des Anlegens des Kundenkontos angegeben haben.<br />- Laden Sie die erhaltene Date im Order includes/modules/payment/linkpoint_api/ hoch (bsp. includes/modules/payment/linkpoint_api/XXXXXX.pem - xxxxxx ist ihre Shop ID).');

  } else { 

  }
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_OWNER', 'Kreditkarteninhaber:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_NUMBER', 'Kreditkartennummer:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CVV', 'Kreditkarten Pr&uuml;fziffer:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_EXPIRES', 'Kreditkarten Ablaufdatum:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_OWNER', '* Der Kreditkarteninhaber muss mindestens eine L&auml;nge von ' . CC_OWNER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_NUMBER', '* Die Kreditkartennummer muss mindestens eine L&auml;nge von ' . CC_NUMBER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_CVV', '* Sie m&uuml;ssen die drei- oder vierstelligen Nummer auf der R&uuml;ckseite Ihrer Kreditkarte eingeben');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR', 'Kreditkarten Fehler!');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_MESSAGE', 'Ihre Kreditkarte wurde abgelehnt. Bitte geben Sie Ihre Kreditkarten Informationen erneut ein, versuchen eine andere Kreditkarte oder nehmen mit uns Kontakt auf.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_AVS_MESSAGE', 'Ung&uuml;ltige Rechnungsadresse!  Bitte geben Sie Ihre Kreditkarten Informationen erneut ein, versuchen eine andere Kreditkarte oder nehmen mit uns Kontakt auf.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_GENERAL_MESSAGE', 'Ihre Kreditkarte wurde abgelehnt. Bitte geben Sie Ihre Kreditkarten Informationen erneut ein, versuchen eine andere Kreditkarte oder nehmen mit uns Kontakt auf.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_POPUP_CVV_LINK', 'Was ist das?');
define('ALERT_LINKPOINT_API_PREAUTH_TRANS', '***NUR G&Uuml;LTIGKEITSPR&Uuml;FUNG -- DIE GEB&Uuml;HREN WERDEN SP&Auml;TER VOM ADMINISTRATOR FESTGELEGT.***');
define('ALERT_LINKPOINT_API_TEST_FORCED_SUCCESSFUL', 'Bemerkung: Dieses ist eine TEST Transaktion... es wird ein erfolgreicher Abschlu&szlig; erzwungen.');
define('ALERT_LINKPOINT_API_TEST_FORCED_DECLINED', 'Bemerkung: Dieses ist eine TEST Transaktion... es wird ein NICHT erfolgreicher Abschlu&szlig; erzwungen.');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_NOT_CONFIGURED', '<span class="alert">&nbsp;(Bemerkung: Das Modul wurde bisher nicht konfiguriert)</span>');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR_CURL_NOT_FOUND', 'CURL Funktionen wurden nicht gefunden - diese werden zwingend ben&ouml;tigt f&uuml;r das Linkpoint API Zahlungsmodul');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_FAILURE_MESSAGE', 'Wir entschuldigigen uns f&uuml;r die Unannehmlichkeiten, aber es ist momentan nicht m&ouml;glich mit der Kreditkartengesellschaft Kontakt aufzunehmen um die G&uuml;ltigkeit der Kreditkarte zu &uuml;berpr&uuml;fen. Bitte nehmen Sie f&uuml;r alternative Zahlungsm&ouml;glichkeitenarten mit uns Kontakt auf.');

  // note: the above error can occur as a result of:
     // - port 1129 not open for bidirectional communication 
     // - CURL is not installed or not functioning
     // - incorrect or invalid or "no" .PEM file found in modules/payment/linkpoint_api folder
     // - In general it means that there was no valid connection made to the gateway... it was stopped before it got outside your server
  
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_GENERAL_ERROR', 'Es tut uns leid. W&auml;hrend der Verarbeitung Ihrer Kreditkarten Informationen ist ein Systemfehler aufgetreten. Ihre Informationen sind sicher, konnten aber nicht verarbeitet werden. Bitte benachrichtigen Sie uns um eine alternative Zahlungsm&ouml;glichkeit zu vereinbaren.');

  // note: the above error is a general error message which is reported when serious and known error conditions occur. Further details are given immediately following the display of this message. If database storage is enabled, details can be found there too.
  
  
  // Admin definitions

define('MODULE_PAYMENT_LINKPOINT_API_LINKPOINT_ORDER_ID', 'Linkpoint Auftragsnummer:');
define('MODULE_PAYMENT_LINKPOINT_API_AVS_RESPONSE', 'AVS Antwort:');
define('MODULE_PAYMENT_LINKPOINT_API_MESSAGE', 'Antwortmeldung:');
define('MODULE_PAYMENT_LINKPOINT_API_APPROVAL_CODE', 'Annahmecode:');
define('MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_REFERENCE_NUMBER', 'Referenznummer:');
define('MODULE_PAYMENT_LINKPOINT_API_FRAUD_SCORE', 'Glaubw&uuml;rdigkeits Score:');
define('MODULE_PAYMENT_LINKPOINT_API_TEXT_TEST_MODE', '<span class="alert">&nbsp;(Bemerkung: Das Modul ist im TESTMODUS)</span>');




?>