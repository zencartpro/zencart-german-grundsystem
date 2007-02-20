<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id$
 */

define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_EC', 'PayPal Express Checkout');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_WPP', 'PayPal Website Payments Pro');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PRO20', 'PayPal Website Payments Pro Payflow Edition (UK)');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_EC', 'PayPal Payflow Pro - Gateway');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_GATEWAY', 'PayPal Payflow Pro Express Checkout');

if (IS_ADMIN_FLAG === true) {
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_DESCRIPTION', '<strong>PayPal Express Checkout</strong>%s<br />' . (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' ? '<a href="https://manager.paypal.com/loginPage.do?partner=ZenCart" target="_blank">Verwalten Sie Ihren PayPal Account.</a>' : '<a href="http://www.zen-cart.com/partners/paypal" target="_blank">Verwalten Sie Ihren PayPal Account.</a>') . '<br /><br /><font color="green">Konfiguration Anleitung:</font><br /><span class="alert">1. </span><a href="http://www.zen-cart.com/partners/paypal" target="_blank">Erstellen Sie einen PayPal Account.</a><br />' . 
  (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') ? '' : '... und dr&uuml;cken auf den Button &quot;Installieren&quot; um PayPal Express Checkout zu aktivieren.</br>') . 
  (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' && (!defined('MODULE_PAYMENT_PAYPALWPP_APISIGNATURE') || MODULE_PAYMENT_PAYPALWPP_APISIGNATURE == '') ? '<span class="alert">2. </span><strong>API Credentials</strong> Diese Modul benutzt die <strong>API Signatur</strong> Option -- Bitte geben Sie in die utnren Felder Ihren Benutzernamen, Passwort und die Signature ein.' : (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' && (!defined('MODULE_PAYMENT_PAYPALWPP_PFUSER') || MODULE_PAYMENT_PAYPALWPP_PFUSER == '') ? '<span class="alert">2. </span><strong>PAYFLOW Credentials</strong> Dieses Modul ben&ouml;tigt Ihre <strong>PAYFLOW Partner Daten</strong>. Bitte geben Sie diese in die Felder unten ein. Diese Daten werden f&uuml;r den reibungslosen Transaktionsablauf ben&ouml;tigt..' : '<span class="alert">2. </span>Bitte stellen Sie sicher, das Sie notwendigen Daten f&uuml;r diese Modul eingegeben haben.') ) . 
  (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' ? '<br /><span class="alert">3. </span>Aktivieren Sie in Ihrem Paypal Account <strong>Sofortige Zehlungsbenachrichtung</strong>:<br />unter Mein Profil w&auml;hlen Sie <em>Sofortige Zahlungsbenachrichtung Einstellungen</em><ul style="margin-top: 0.5;"><li>und machen einen Haken in das dazugeh&ouml;rige K&auml;stchen</li><li>Falls nicht bereicht eine URL angegeben ist, geben Sie bitte folgende URL ein:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . '</li></ul>' : '') . 
  '<font color="green"><hr /><strong>Vorrausetzungen:</strong></font><br /><hr />*<strong>CURL</strong> wird f&uuml;r die Kommunikation mit dem Gateway genutzt und muss deshlb zwingend auf Ihrem Webspace vorhanden und aktiviert sein. (Falls Sie einen CURL Proxy verwenden, konfigurieren Sie diesen bitte unter Konfiguration -> Mein Shop)<br /><hr />');
}

define('MODULE_PAYMENT_PAYPALWPP_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_TITLE', 'Kreditkarte');
define('MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TITLE', 'PayPal');
define('MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TYPE', 'PayPal Express Checkout');
define('MODULE_PAYMENT_PAYPALWPP_DP_TEXT_TYPE', 'PayPal Direct Payment');
define('MODULE_PAYMENT_PAYPALWPP_ERROR_HEADING', 'Es war uns leider nicht m&ouml;glich Ihre Kreditkarten zu verarbeiten');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CARD_ERROR', 'Die angegebenen Kreditkarten Informationen enthalten einen Fehler, Bitte pr&uuml;fen Sie ihre Angaben und versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_FIRSTNAME', 'Kreditkarteninhaber Vorname:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_LASTNAME', 'Kreditkarteninhaber Nachname');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_OWNER', 'Kreditkarteninhaber:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_NUMBER', 'Kreditkartennummer:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_EXPIRES', 'G&uuml;ltig bis:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_ISSUE', 'Ausgabedatum der KK:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER', 'Pr&uuml;fziffer:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(auf der R&uuml;ckseite Ihrer Kreditkarte)');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED', 'Ihre Kreditkarte wurde abgelehnt. Bitte versuchen Sie es mit einer anderen Kreditkarter erneut oder nehmen Sie Kontakt mit Ihrer Bank auf um weitere Informationen zu erhalten.');
define('MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE', 'Wir konnten Ihre Auftrag leider nicht ausf&uuml;hren. Bitte nehmen Sie mit uns Kontakt auf um nach m&ouml;glichen Alternativen zu suchen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_ERROR', 'Es trat ein Fehler beim Kontakt mit der Kreditkartenpr&uuml;fstelle auf. Bitte versuchen Sie es sp&auml;ter noch einmal oder nehmen Sie mit uns Kontakt auf.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADDR_ERROR', 'Die angegebene Adresse scheint ung&uuml;ltig zu sein oder stimmt nicht mit der bei Paypal hinterlegten &uuml;berein. Bitte w&auml;hlen Sie eine andere Adresse und versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CONFIRMEDADDR_ERROR', 'Die ausgew&auml;hlte Adresse bei Paypal ist keine best&auml;tigte Adresse. Bitte w&auml;hlen Sie eine Andere aus und versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ERROR', 'Es trat ein Fehler w&auml;hrend der Verarbeitung Ihrer Kreditkarten Informationen auf. Bitte versuchen Sie es erneut oder nehmen Sie mit uns Kontakt auf.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_CARD', 'Es tut uns leid, aber die angebene Kreditkarte akzeptieren wir nicht. Bitte w&auml;hlen sie eine Andere oder nehmen Sie mit uns Kontakt auf.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_LOGIN', 'Es gab ein Problem bei der &Uuml;berpr&uuml;fung Ihres Paypal Accounts, bitte versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_OWNER', '* Der Kreditkarteninhaber sollte mindestens eine L&auml;nge von' . CC_OWNER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_NUMBER', '* Die Kreditkartenummer sollte mindestens eine L&auml;nge von ' . CC_NUMBER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_EC_HEADER', 'Schnelle und sichere Bestellung mit Paypal:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BUTTON_TEXT', 'Sparen sie Zeit und bestellen sie vollkommen sicher. Zahlen Sie ohne ihre finanzielle Situation preiszugeben');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BUTTON_ALTTEXT', 'Klicken Sie hier um per PayPal Express Checkout zu bestellen');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_STATE_ERROR', 'Der zugewiesene Status zu ihrem Paypal Account ist nicht g&uuml;ltig., Bitte &auml;&auml;ndern Sie Ihre Einstellungen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_WPP_ACCOUNT_ERROR', 'Es tut uns leid, wir konnten Ihre Zahlungsart Paypal Express Checkout leider nicht akzeptieren. Entweder sind die Shopeinstellungen fehlerhaft oder die Zahlungsart wurde noch nicht von Paypal f&uuml;r diesen Webshop aktiviert. Bitte nehmen Sie mit uns Kontakt auf');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_SANDBOX_VS_LIVE_ERROR', 'Es tut uns leid, wir konnten die Transaktion leider nicht ausf&uuml;hren. Der Paypal Account dieses Webshops ist leider fehlerhaft (Sandbox und Live Status aktiviert) eingestellt. Bitte nehmen Sie mit dem Shopinhaber Kontakt auf und weisen Sie ihn auf diesen Fehler hin.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_WPP_BAD_COUNTRY_ERROR', 'Es tut uns leid, der Paypal Account des Shopinhabers liegt in einem Land, das derzeit noch nicht von Paypal Express Checkout unterst&uuml;tzt wird. Bitte w&auml;hlen Sie eine andere Zahlungsweise aus.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_CONFIGURED', '<span class="alert">&nbsp;(Hinweis: Das Modul ist noch nicht konfiguriert)</span>');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GETDETAILS_ERROR', 'Es gab Problem beim Empfangen von Transaktionsdetails. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_ERROR', 'Ein Problem hat die Ausf&uuml;hrung der Transaktion verhindert. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_ERROR', 'Es gab ein Problem beim R&uuml;ckerstatten der Zahlung. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_ERROR', 'Es gab ein Problem bei der Authorisierung der Transaktion. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_ERROR', 'Ein Problem hat die Ausf&uuml;hrung der Transaktion verhindert. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUNDFULL_ERROR', 'Ihr R&uuml;ckerstattungsanliegen wurde von Paypal abgelehnt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_REFUND_AMOUNT', 'Sie haben eine teilweise R&uuml;ckerstattung angefordert, haben allerdings keinen Betrag eingegeben.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_ERROR', 'Sie haben die volle R&uuml;ckerstattung angefordert, aber haben nicht die Best&auml;tigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_AUTH_AMOUNT', 'Sie haben eine Authorisation angefordert, aber haben keinen Betrag angegeben.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_CAPTURE_AMOUNT', 'Die haben eine Capture angefordert, aber haben keinen Betrag angegeben.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_CHECK', 'Best&auml;tigen');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_ERROR', 'Sie wollten eine Transaktion abbrechen, haben aber nicht die Best&auml;tigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Best&auml;tigen');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_CONFIRM_ERROR', 'Sie haben eine Authorisation angefordert, aber haben nicht die Best&auml;tigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_ERROR', 'Sie haben einen Funds-Capture angefordert, aber haben nicht die Best&auml;tigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_INITIATED', 'PayPal R&uuml;ckerstattung f&uuml;r %s gestartet. Transaction ID: %s. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_INITIATED', 'PayPal Authorization f&uuml;r %s gestartet. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_INITIATED', 'PayPal Capture f&uuml;r %s gestartet. Receipt ID: %s. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_INITIATED', 'PayPal Abbrechen Request gestartet. Transaction ID: %s. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_API_ERROR', 'Es gab einen Fehler bei der auszuf&uuml;hrenden Transaktion. Bitte schauen Sie in der API Anleitung oder in den Transaktions Logs f&uuml;r weitere Informationen nach.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_ZONE_ERROR', 'Es tut uns leid, aber zur Zeit ist es uns nicht m&ouml;glich, die Zahlungsart Paypal f&uuml;r ihre geographische Region zu benutzen. Bitte w&auml;hlen Sie eine andere Zahlungsart.');

// EC buttons -- Do not change these values:
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_IMG', 'https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif');
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_SM_IMG', 'https://www.paypal.com/en_US/i/btn/btn_xpressCheckoutsm.gif');
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_IMG', 'https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif');
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT', 'Checkout with PayPal');

////////////////////////////////////////
// Styling of the PayPal Payment Page. Uncomment to customize.  Otherwise, simply create a Custom Page Style at PayPal and mark it as Primary or name it in your Zen Cart PayPal WPP settings.
  //define('MODULE_PAYMENT_PAYPALWPP_HEADER_IMAGE', '');  // this should be an HTTPS URL to the image file
  //define('MODULE_PAYMENT_PAYPALWPP_PAGECOLOR', '');  // 6-digit hex value
  //define('MODULE_PAYMENT_PAYPALWPP_HEADER_BORDER_COLOR', '');  // 6-digit hex value
  //define('MODULE_PAYMENT_PAYPALWPP_HEADER_BACK_COLOR', ''); // 6-digit hex value
////////////////////////////////////////


  // These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'Vorname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', 'Nachname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', 'Firmenname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', 'Adressen Name:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', 'Strasse:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', 'Stadt:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', 'Bundesland:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_ZIP', 'Postleitzahl:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY', 'Land:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', 'Ebay ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', 'Zahlender ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', 'Zahlender Status:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', 'Adressen Status:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE', 'Zahlungsart:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS', 'Zahlungsart Status:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON', 'Wartet aufgrund von:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE', 'Rechnung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE', 'Datum der Zahlung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', 'W&auml;hrung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', 'Summe:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', 'Kosten Zahlungsart:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', 'Wechselkurs:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', 'Warenkorbinhalt:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', 'Trans. Typ:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', 'Trans. ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', 'Zugeh&ouml;rige Trans. ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TITLE', '<strong>R&uuml;ckerstattatung</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_FULL', 'Wenn Sie diese Bestellung komplett zur&uuml;ckerstattet haben wollen, dann klicken Sie bitte hier:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Volle R&uuml;ckerstattung');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Teilweise R&uuml;ckerstattung');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_PARTIAL_TEXT', '<br />... oder tragen Sie den gew&uuml;nschten Betrag für eine teilweise R&uuml;ckerstattung ein und klicken auf Teilweise R&uuml;ckerstattung');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_SUFFIX', '*Eine volle R&uuml;ckerstattung ist nach einer teilweisen R&uuml;ckerstattung nicht m&ouml;glich.<br />*Mehrere teilweise R&uuml;ckerstattungen sind m&ouml;glich, h&ouml;chstens allerdings bis zum vollst&auml;ndigen Aufbrauchen des Restbetrages.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Hinweis f&uuml;r den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE', 'R&uuml;ckerstattet vom Shopinhaber.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_CHECK','Best&auml;tigung: ');


define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_TITLE', '<strong>Bestell Authorisation</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_PARTIAL_TEXT', 'Wollen Sie einen Teil dieser Bestellungen authorisieren, dann tragen Sie den Betrag hier ein:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_BUTTON_TEXT_PARTIAL', 'Authorisieren');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_SUFFIX', '');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Hinweis f&uuml;r den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE', 'R&uuml;ckerstattet vom Shopinhaber.');

define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TITLE', '<strong>Authorisationen Abfangen</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FULL', 'Wenn Sie alle oder einen Teil der ausstehenden Authorisationen f&uuml;r diesen Auftrag abfangen wollen, dann geben sie bitte den gew&uuml;nschten Betrag ein. Bitte machen Sie auch einen Haken in die Best&auml;tigung Checkbox, bevor Sie auf den Button Abfangen klicken..<br />');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Abfangen');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_AMOUNT_TEXT', 'Betrag:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FINAL_TEXT', 'Ist dieses der endg&uuml;ltige Abfangversuch??');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_SUFFIX', '');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TEXT_COMMENTS', '<strong>Hinweis f&uuml;r den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_DEFAULT_MESSAGE', 'Vielen Dank f&uuml;r Ihren Auftrag.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_CHECK','Best&auml;tigung: ');

define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TITLE', '<strong>Abbrechen von Auftrags Authorisationen</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID', 'Wenn Sie eine Authorisation abbrechen wollen, dann tragen Sie bitte die entsprechende ID hier ein und klicken auf Abbrechen.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TEXT_COMMENTS', '<strong>Hinweis f&uuml;r den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_DEFAULT_MESSAGE', 'Vielen Dank das Sie ein Kunde von uns sind, bitte besuchen Sie uns bald wieder.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL', 'Abbrechen');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_SUFFIX', '');



// this text is used to announce the username/password when the module creates the customer account and emails data to them:
define('EMAIL_EC_ACCOUNT_INFORMATION', 'Mit folgenden Kundendaten k&ouml;nnen Sie ihren Einkauf erneut aufrufen:');



?>