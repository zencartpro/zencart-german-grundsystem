<?php
/**
 * Authorize.net echeck Payment Module
 *
 * @package languageDefines
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: authorizenet_echeck.php 293 2008-05-28 21:10:40Z maleborg $
 */


// Admin Configuration Items
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_ADMIN_TITLE', 'Authorize.net - eScheck'); // Payment option title as displayed in the admin
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CATALOG_TITLE', 'eScheck');  // Payment option title as displayed to the customer

  if (MODULE_PAYMENT_AUTHORIZENET_ECHECK_STATUS == 'True') {
    define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DESCRIPTION', '<a target="_blank" href="https://account.authorize.net/">Authorize.net Verkäufer Login</a>');
  } else { 
 define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DESCRIPTION', '<a target="_blank" href="http://reseller.authorize.net/application.asp?id=131345">Klicken Sie hier um ein neues Konto zu eröffnen</a><br /><br /><a target="_blank" href="https://account.authorize.net/">Authorize.net Merchant Area</a><br /><br /><strong>Requirements:</strong><br /><hr />*<strong>Authorize.net Account</strong> (see link above to signup)<br />*<strong>CURL is required </strong>and MUST be compiled with SSL support into PHP by your hosting company<br />*<strong>Authorize.net username and transaction key</strong> available from your Merchant Area');
  }
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_ERROR_CURL_NOT_FOUND', 'CURL Funktionen nicht gefunden - benötigt für Authorize.net eScheck Zahlungsmodul');

// Catalog Items
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_BANK_ROUTING_CODE', 'ABA Routing Nummer:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_BANK_NAME', 'Bank Name:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_BANK_ACCOUNT_NUM', 'Bank Konto Number:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_BANK_ACCOUNT_TYPE', 'Bank Konto Typ:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_BANK_ACCOUNTHOLDER', 'Name des Bank Kontos:');

  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_ACCT_OWNER', '* Der Konto Inhaber muss mindestens  ' . CC_OWNER_MIN_LENGTH . ' Zeichen lang sein.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_ACCT_NUMBER', '* Die Konto nummer muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen lang sein.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_ROUTING_CODE', '* Die Bankleitzahl muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen lang sein.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_BANK_NAME', '* Der Name der Bank muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen lang sein.\n');

  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_AUTHORIZATION_TITLE', 'Authorisationsbestätigung:&nbsp;');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_AUTHORIZATION_NOTICE', 'Klicken auf den nachstehende Button(bestätigt Ihre Bestellung), authorisiere ich ' . STORE_NAME . ' mein Konto %s bei Bank %s mit dem Betrag von %s für den einmaligen Online-Kauf von Lieferungen und Leistungen auf dieses Webseite gelistet, zu belasten.');

  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DECLINED_MESSAGE', 'Ihre Transaktion ist fehlgeschlagen. Bitte überprüfen Sie Ihre Angaben und versuchen Sie es noch einmal oder kontaktieren Sie uns zur Unterstützung.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_ERROR', 'Transaktion Fehler!');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_AUTHENTICITY_WARNING', 'WARNUNG: Sicherheitsproblem. Bitte kontaktieren Sie sofort den Shop Betreiber. Ihre Bestellung konnte nicht vollständig authorisiert werden.');

  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CUST_TYPE', 'Kunden Typ:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CUST_TAX_ID', 'Kunden Steuer ID/SSN:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DL_NUMBER', 'Führerschein-Nr.:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DL_STATE', 'Fahrzeug-Kennzeichen:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DL_DOB_TEXT', 'Geburtsdatum des Fahrers:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_DL_DOB_FORMAT', '(MM/DD/YYYY)');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_CUST_TAX_ID', '* Die Steuer ID muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen lang sein.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_DL_NUMBER', '* Die Führerschein-Nr. muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen lang sein.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_JS_DL_DOB', '* Das Geburtsdatum muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen lang sein.\n');

// admin tools:
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_BUTTON_TEXT', 'Rückerstattung');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_REFUND_CONFIRM_ERROR', 'FEHLER: Sie haben Rückerstattung beantragt, aber die Bestätigungs-Box nicht aktiviert.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_INVALID_REFUND_AMOUNT', 'FEHLER: Sie haben Rückerstattung beantragt, haben aber einen ungültigen Betrag eingegeben.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CC_NUM_REQUIRED_ERROR', 'FEHLER: Sie haben Rückerstattung beantragt, habe aber die letzten 4 Stellen der Kreditkartennummer nicht eingegeben.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_REFUND_INITIATED', 'Rückerstattung initialisiert. Transaktion ID: %s - Auth Code: %s');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CAPTURE_CONFIRM_ERROR', 'FEHLER: Sie wollten die Rückerstattung akzeptieren, haben aber nicht die Bestätigungs-Box nicht aktiviert.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_BUTTON_TEXT', 'Rückerstatten');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_INVALID_CAPTURE_AMOUNT', 'FEHLER: Sie haben eine Rückerstattung angefordert, haben aber nicht den Betrag eingegeben.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_TRANS_ID_REQUIRED_ERROR', 'FEHLER: Bitte geben Sie die Transaktions ID ein.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CAPT_INITIATED', 'Rückerstattung gestartet. Betrag: %s.  Transaktion ID: %s - Auth Code: %s');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_VOID_BUTTON_TEXT', 'Zahlung aufheben');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_VOID_CONFIRM_ERROR', 'FEHLER: Sie haben eine Aufhebung beantragt, aber die Bestätigungs-Box nicht aktiviert.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_VOID_INITIATED', 'Aufhebung gestartet. Transaktion ID: %s - Auth Code: %s ');


  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_TITLE', '<strong>Rückerstattung Transaktionen</strong>');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND', 'Sie können hier Geld an der Zahler (Kreditkarte) zurück überweisen:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_REFUND_CONFIRM_CHECK', 'Markieren Sie die Box bevor Sie Bestätigen: ');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_AMOUNT_TEXT', 'Geben Sie den Rückerstattungsbetrag ein');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_CC_NUM_TEXT', 'Geben Sie die letzten 4 Ziffern der Konto Nummer ein.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_TRANS_ID', 'Geben Sie optional die Transaktion ID ein:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_TEXT_COMMENTS', 'Bemerkung (Erscheint nur in der Bestell-Historie):');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_DEFAULT_MESSAGE', 'Ausgeführte Rückerstattungen');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_REFUND_SUFFIX', 'Sie können ein Rückerstattung für einen Auftrag in der Höhe des ursprünglichen Betrags ausführen. Sie müssen die letzten 4 Stellen der Konto-Nr. angeben, unter der der Auftrag ausgeführt wurde.<br />Rückerstattungen können innerhalb 120 Tagen ab dem orginal Transaktionsdatum durchgeführt werden.');

  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_TITLE', '<strong>Transaktionen rückgängig machen</strong>');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE', 'Hier können Sie bereits authorisierte Zahlungen rückgängig machen:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_AMOUNT_TEXT', 'Geben Sie den Betrag ein: ');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_CAPTURE_CONFIRM_CHECK', 'Aktivieren Sie die Box um zu bestötigen: ');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_TRANS_ID', 'Geben sie hier die ursprüngliche Transaktion ID ein: ');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_TEXT_COMMENTS', 'Bemerkung (Erscheint nur in der Bestellhistorie):');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_DEFAULT_MESSAGE', 'Rückgängig gemachte Zahlungen.');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_CAPTURE_SUFFIX', 'Zahlungen können innerhalb von 30 Tagen ab der Transaktion getätigt werden. Rückführung ist EINMALIG.<br />Stellen Sir sicher, daß der Betrag korrekt ist.<br />Original betrag wird rückgängig gemacht, wenn Sie keinen Betrag eingeben.');

  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_VOID_TITLE', '<strong>Transaktionen löschen</strong>');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_VOID', 'Sie können Transaktionen löschen, die bisher noch nicht beglichen wurden:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_TEXT_VOID_CONFIRM_CHECK', 'Aktivieren Sie die Box um zu bestätigen:');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_VOID_TEXT_COMMENTS', 'Bemerkung (Erscheint nur in der Bestellhistorie):');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_VOID_DEFAULT_MESSAGE', 'Transaktion gelöscht');
  define('MODULE_PAYMENT_AUTHORIZENET_ECHECK_ENTRY_VOID_SUFFIX', 'Löschungen können nur täglich vorgenommen werden.');
