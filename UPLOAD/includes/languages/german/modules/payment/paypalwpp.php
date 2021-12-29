<?php
/**
* Zen Cart German Specific
* @package languageDefines
* @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: paypalwpp.php 715 2020-02-08 10:57:24Z webchills $
*/

define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_EC', 'PayPal Express');

define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PRO20', 'PayPal Express (Pro 2.0 Payflow Edition) (UK)');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_EC', 'PayPal Payflow Pro - Gateway');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_GATEWAY', 'PayPal Express via Payflow Pro');

if (IS_ADMIN_FLAG === true) {
if (!defined('MODULE_PAYMENT_PAYPALWPP_MODULE_MODE')) define('MODULE_PAYMENT_PAYPALWPP_MODULE_MODE', 'undefined');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_DESCRIPTION', '<strong>PayPal Express Checkout</strong>%s<br/><br/><img src="images/checkout-logo-large-de.png" alt="PayPal Express"/><br/><br />Dieses Modul ist eine <b>NVP/SOAP API-Integration</b>.<br/>Infos zum Erstellen der API Zugangsdaten (<b>API Berechtigung mit Signatur</b>) finden Sie <a href="https://www.paypal.com/at/smarthelp/article/wie-fordere-ich-eine-api-berechtigung-mit-signatur-oder-zertifikat-an-faq3196" target=":blank">hier</a>.<br/><br/>' . (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' ? '<a href="https://manager.paypal.com/loginPage.do?partner=ZenCart" target="_blank">Verwalten Sie Ihren PayPal Account.</a>' : '<a href="https://www.paypal.com/de/webapps/mpp/merchant" target="_blank">Verwalten Sie Ihren PayPal Account.</a>') . '<br /><br /><font color="green">Konfiguration Anleitung:</font><br /><span class="alert">1. </span><a href="https://www.paypal.com/de/webapps/mpp/merchant" target="_blank">Erstellen Sie einen PayPal Account.</a><br />' . 
(defined('MODULE_PAYMENT_PAYPALWPP_STATUS') ? '' : '... und drücken auf den Button "Installieren" um PayPal Express Checkout zu aktivieren.</br>') . 
(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' && (!defined('MODULE_PAYMENT_PAYPALWPP_APISIGNATURE') || MODULE_PAYMENT_PAYPALWPP_APISIGNATURE == '') ? '<span class="alert">2. </span><strong>API Zugangsdaten fehlen!</strong> Dieses Modul benutzt die <strong>API Signatur</strong> Option -- Bitte geben Sie in die unteren Felder Ihren Benutzernamen, Passwort und die Signatur ein.' : (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' && (!defined('MODULE_PAYMENT_PAYPALWPP_PFUSER') || MODULE_PAYMENT_PAYPALWPP_PFUSER == '') ? '<span class="alert">2. </span><strong>PAYFLOW Credentials</strong> Dieses Modul benötigt Ihre <strong>PAYFLOW Partner Daten</strong>. Bitte geben Sie diese in die Felder unten ein. Diese Daten werden für den reibungslosen Transaktionsablauf benötigt..' : '<span class="alert">2. </span>Bitte stellen Sie sicher, dass Sie die notwendigen Daten für dieses Modul eingegeben haben.') ) . 
(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' ? '<br /><span class="alert">3. </span>Aktivieren Sie in Ihrem Paypal Account <strong>Sofortige Zehlungsbenachrichtung</strong>:<br />unter Mein Profil wählen Sie <em>Sofortige Zahlungsbenachrichtung Einstellungen</em><ul style="margin-top: 0.5;"><li>und machen einen Haken in das dazugehörige Kästchen</li><li>Falls nicht bereits eine URL angegeben ist, geben Sie bitte folgende URL ein:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . '</li></ul>' : '') . 
'<hr/><font color="green"><strong>Voraussetzungen:</strong></font><br />*<strong>CURL</strong> wird für die Kommunikation mit dem Gateway genutzt und muss deshlb zwingend auf Ihrem Webspace vorhanden und aktiviert sein. Falls Sie einen CURL Proxy verwenden (NICHT empfohlen!), konfigurieren Sie diesen bitte unter Konfiguration -> Mein Shop<hr />');
}

define('MODULE_PAYMENT_PAYPALWPP_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_TITLE', 'Kreditkarte');
define('MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TITLE', 'PayPal');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_EC_HEADER', 'Schneller, sicherer Checkout mit PayPal:');
define('MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TYPE', 'PayPal Express Checkout');
define('MODULE_PAYMENT_PAYPALWPP_DP_TEXT_TYPE', 'PayPal Direct Payment');
define('MODULE_PAYMENT_PAYPALWPP_PF_TEXT_TYPE', 'Kreditkarte');  //(used for payflow transactions)
define('MODULE_PAYMENT_PAYPALWPP_ERROR_HEADING', 'Es war uns leider nicht möglich Ihre Kreditkarte zu verarbeiten');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CARD_ERROR', 'Die angegebenen Kreditkarten Informationen enthalten einen Fehler, Bitte prüfen Sie ihre Angaben und versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_FIRSTNAME', 'Kreditkarteninhaber Vorname:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_LASTNAME', 'Kreditkarteninhaber Nachname');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_OWNER', 'Kreditkarteninhaber:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_NUMBER', 'Kreditkartennummer:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_EXPIRES', 'Gültig bis:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_ISSUE', 'Ausgabedatum der KK:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER', 'Prüfziffer:');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(auf der Rückseite Ihrer Kreditkarte)');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED', 'Ihre Kreditkarte wurde abgelehnt. Bitte versuchen Sie es mit einer anderen Kreditkarter erneut oder nehmen Sie Kontakt mit Ihrer Bank auf um weitere Informationen zu erhalten.');
define('MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE', 'Wir konnten Ihre Auftrag leider nicht ausführen. Bitte nehmen Sie mit uns Kontakt auf um nach möglichen Alternativen zu suchen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_ERROR', 'Es trat ein Fehler beim Kontakt mit der Kreditkartenprüfstelle auf. Bitte versuchen Sie es später noch einmal oder nehmen Sie mit uns Kontakt auf.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_MESSAGE', 'Lieber Shopinhaber,' . "\n" . 'Ein Fehler ist aufgetreten beim Versuch eine PayPal Express Checkout Transaktion zu starten. Nur die Fehler "Nummer" wurde Ihrem Kunden angezeigt.  Hier die genauen Details zum Fehler.' . "\n\n");
define('MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_SUBJECT', 'ALARM: PayPal Express Checkout Error');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADDR_ERROR', 'Die angegebene Adresse scheint ungültig zu sein oder stimmt nicht mit der bei Paypal hinterlegten überein. Bitte wählen Sie eine andere Adresse und versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CONFIRMEDADDR_ERROR', 'Die ausgewählte Adresse bei Paypal ist keine bestätigte Adresse. Bitte wählen Sie eine Andere aus und versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INSUFFICIENT_FUNDS_ERROR', 'PayPal konnte diese Transaktion nicht erfolgreich durchführen. Bitte wählen Sie eine andere Zahlungsart oder überprüfen Sie Ihre Zahlungsoptionen in Ihrem PayPal Account bevor Sie fortfahren.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_PAYPAL_DECLINED', 'Entschuldigung. PayPal hat die Transaktion abgelehnt und uns mitgeteilt, dass Sie sich für weitere Informationen an den PayPal-Kundendienst wenden sollen. Um Ihren Einkauf abzuschließen, wählen Sie bitte eine alternative Zahlungsmethode.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ERROR', 'Es trat ein Fehler während der Verarbeitung Ihrer Kreditkarten Informationen auf. Bitte versuchen Sie es erneut oder nehmen Sie mit uns Kontakt auf.');
define('MODULE_PAYMENT_PAYPALWPP_FUNDING_ERROR','Problem mit der Finanzierungsquelle; bitte gehen Sie zu Paypal.com und zahlen Sie direkt an ' . STORE_OWNER_EMAIL_ADDRESS); 
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_CARD', 'Es tut uns leid, aber die angebene Kreditkarte akzeptieren wir nicht. Bitte wählen sie eine andere oder nehmen Sie mit uns Kontakt auf.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_LOGIN', 'Es gab ein Problem bei der Überprüfung Ihres Paypal Accounts, bitte versuchen Sie es erneut.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_OWNER', '* Der Kreditkarteninhaber sollte mindestens eine Länge von' . CC_OWNER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_NUMBER', '* Die Kreditkartenummer sollte mindestens eine Länge von ' . CC_NUMBER_MIN_LENGTH . ' Zeichen haben.\n');
define('MODULE_PAYMENT_PAYPALWPP_ERROR_AVS_FAILURE_TEXT', 'ALARM: Addressprüfungsfehler. ');
define('MODULE_PAYMENT_PAYPALWPP_ERROR_CVV_FAILURE_TEXT', 'ALARM: CVV Code Überprüfungsfehler. ');
define('MODULE_PAYMENT_PAYPALWPP_ERROR_AVSCVV_PROBLEM_TEXT', ' Bestellung wird erst vom Shopinhaber überprüft.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_UNILATERAL', ' - Sie müssen Ihre PayPal API Zugangsdaten eintragen, bevor Sie erweitere Transaktionsverarbeitungen nutzen können.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_STATE_ERROR', 'Der zugewiesene Status zu ihrem Paypal Account ist nicht gültig., Bitte ändern Sie Ihre Einstellungen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_WPP_ACCOUNT_ERROR', 'Es tut uns leid, wir konnten Ihre Zahlungsart Paypal Express Checkout leider nicht akzeptieren. Entweder sind die Shopeinstellungen fehlerhaft oder die Zahlungsart wurde noch nicht von Paypal für diesen Webshop aktiviert. Bitte nehmen Sie mit uns Kontakt auf');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_SANDBOX_VS_LIVE_ERROR', 'Es tut uns leid, wir konnten die Transaktion leider nicht ausführen. Der Paypal Account dieses Webshops ist leider fehlerhaft (Sandbox und Live Status aktiviert) eingestellt. Bitte nehmen Sie mit dem Shopinhaber Kontakt auf und weisen Sie ihn auf diesen Fehler hin.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_WPP_BAD_COUNTRY_ERROR', 'Es tut uns leid, der Paypal Account des Shopinhabers liegt in einem Land, das derzeit noch nicht von Paypal Express Checkout unterstützt wird. Bitte wählen Sie eine andere Zahlungsweise aus.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_CONFIGURED', '<span class="alert">&nbsp;(HINWEIS: Das Modul ist noch nicht konfiguriert)</span>');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GETDETAILS_ERROR', 'Es gab Probleme beim Empfangen von Transaktionsdetails. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_TRANSSEARCH_ERROR', 'Es gab ein Problem, passende Transaktionen zu Ihren Angaben zu finden. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_ERROR', 'Ein Problem hat die Ausführung der Transaktion verhindert. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_ERROR', 'Es gab ein Problem beim Rückerstatten der Zahlung. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_ERROR', 'Es gab ein Problem bei der Autorisierung der Transaktion. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_ERROR', 'Ein Problem hat die Ausführung der Transaktion verhindert. ');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUNDFULL_ERROR', 'Ihr Rückerstattungsanliegen wurde von Paypal abgelehnt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_REFUND_AMOUNT', 'Sie haben eine teilweise Rückerstattung angefordert, haben allerdings keinen Betrag eingegeben.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_ERROR', 'Sie haben die volle Rückerstattung angefordert, aber haben nicht die Bestätigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_AUTH_AMOUNT', 'Sie haben eine Autorisation angefordert, aber haben keinen Betrag angegeben.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_CAPTURE_AMOUNT', 'Die haben eine Capture angefordert, aber haben keinen Betrag angegeben.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_CHECK', 'Bestätigen');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_ERROR', 'Sie wollten eine Transaktion abbrechen, haben aber nicht die Bestätigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Bestätigen');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_CONFIRM_ERROR', 'Sie haben eine Autorisation angefordert, aber haben nicht die Bestätigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_ERROR', 'Sie haben einen Funds-Capture angefordert, aber haben nicht die Bestätigen Checkbox angehakt.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_INITIATED', 'PayPal Rückerstattung für %s gestartet. Transaction ID: %s. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_INITIATED', 'PayPal Autorisation für %s gestartet. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_INITIATED', 'PayPal Capture für %s gestartet. Receipt ID: %s. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_INITIATED', 'PayPal Abbrechen Request gestartet. Transaction ID: %s. Aktualisieren Sie die Seite (F5) um den aktuellen Status einzusehen.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_API_ERROR', 'Es gab einen Fehler bei der auszuführenden Transaktion. Bitte schauen Sie in der API Anleitung oder in den Transaktions Logs für weitere Informationen nach.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_ZONE_ERROR', 'Es tut uns leid, aber zur Zeit ist es uns nicht möglich, die Zahlungsart Paypal für ihre geographische Region zu benutzen. Bitte wählen Sie eine andere Zahlungsart.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ORDER_ALREADY_PLACED_ERROR', 'Sie scheinen Ihre Bestellung zweimal abgesandt zu haben. Bitte überprüfen Sie unter Mein Konto die Details zu Ihrer Bestellung. Falls Ihre Bestellung dort nicht aufscheint, aber via PayPal bezahlt wurde, kontaktieren Sie uns bitte, damit wir das mit Ihnen klären können.');


define('MODULE_PAYMENT_PAYPALWPP_TEXT_BUTTON_ALTTEXT', 'Klicken Sie hier um mit PayPal Express Checkout zu zahlen');
// EC buttons -- Do not change these values:
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_IMG', 'https://www.paypalobjects.com/webstatic/de_DE/i/de-btn-expresscheckout.gif');
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_IMG_MOBILE', 'https://www.paypalobjects.com/webstatic/de_DE/i/de-btn-expresscheckout.gif');
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_SM_IMG', 'https://www.paypalobjects.com/webstatic/de_DE/i/de-btn-expresscheckout.gif');
define('MODULE_PAYMENT_PAYPALEC_MARK_BUTTON_IMG', 'https://www.paypalobjects.com/webstatic/de_DE/i/de-pp-logo-100px.png');
define('MODULE_PAYMENT_PAYPALEC_MARK_BUTTON_TXT', 'Einkaufen mit PayPal');
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT', '');

////////////////////////////////////////
// Styling of the PayPal Payment Page. Uncomment to customize.
// A BETTER WAY, HOWEVER, is to simply create a Custom Page Style at PayPal and mark it as Primary or name it in your Zen Cart PayPal EC settings.
//define('MODULE_PAYMENT_PAYPALWPP_HEADER_IMAGE', '');  // this should be an HTTPS URL to the image file
//define('MODULE_PAYMENT_PAYPALWPP_PAGECOLOR', '');  // 6-digit hex value
////// Styling of pseudo cart contents display section
//define('MODULE_PAYMENT_PAYPAL_LOGO_IMAGE', ''); // https path to your customized logo
//define('MODULE_PAYMENT_PAYPAL_CART_BORDER_COLOR', ''); // 6-digit hex value
////////////////////////////////////////


// These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'Vorname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', 'Nachname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', 'Firmenname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', 'Adressen Name:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', 'Strasse:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', 'Stadt:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', 'Bundesland/PLZ:');
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
define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', 'Währung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', 'Summe:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', 'Kosten Zahlungsart:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', 'Wechselkurs:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', 'Warenkorbinhalt:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', 'Trans. Typ:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', 'Trans. ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', 'Zugehörige Trans. ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TITLE', '<strong>Rückerstattung</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_FULL', 'Wenn Sie diese Bestellung komplett zurückerstatten wollen, dann klicken Sie bitte hier:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Volle Rückerstattung');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Teilweise Rückerstattung');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_FULL_OR', '<br />... oder Teilbetrag angeben ');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_PAYFLOW_TEXT', 'Geben Sie ein den ');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_PARTIAL_TEXT', 'für teilweise Rückerstattung');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_SUFFIX', '*Eine volle Rückerstattung ist nach einer teilweisen Rückerstattung nicht möglich.<br />*Mehrere teilweise Rückerstattungen sind möglich, höchstens allerdings bis zum vollständigen Aufbrauchen des Restbetrages.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Hinweis für den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE', 'Rückerstattet vom Shopinhaber.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_CHECK','Bestätigung: ');
define('MODULE_PAYMENT_PAYPAL_ENTRY_COMMENTS', 'System Meldungen: ');
define('MODULE_PAYMENT_PAYPALWPP_ENTRY_PROTECTIONELIG', 'Protection Berechtigung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_TITLE', '<strong>Bestell Autorisation</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_PARTIAL_TEXT', 'Wollen Sie einen Teil dieser Bestellungen authorisieren, dann tragen Sie den Betrag hier ein:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_BUTTON_TEXT_PARTIAL', 'Autorisieren');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_SUFFIX', '');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Hinweis für den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE', 'Rückerstattet vom Shopinhaber.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TITLE', '<strong>Autorisationen Abfangen</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FULL', 'Wenn Sie alle oder einen Teil der ausstehenden Autorisationen für diesen Auftrag abfangen wollen, dann geben sie bitte den gewünschten Betrag ein. Bitte machen Sie auch einen Haken in die Bestätigung Checkbox, bevor Sie auf den Button Abfangen klicken..<br />');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Abfangen');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_AMOUNT_TEXT', 'Betrag:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FINAL_TEXT', 'Ist dieses der endgültige Abfangversuch??');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_SUFFIX', '');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TEXT_COMMENTS', '<strong>Hinweis für den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_DEFAULT_MESSAGE', 'Vielen Dank für Ihren Auftrag.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_CHECK','Bestätigung: ');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TITLE', '<strong>Abbrechen von Auftrags Autorisationen</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID', 'Wenn Sie eine Autorisation abbrechen wollen, dann tragen Sie bitte die entsprechende ID hier ein und klicken auf Abbrechen.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TEXT_COMMENTS', '<strong>Hinweis für den Kunden:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_DEFAULT_MESSAGE', 'Vielen Dank dass Sie ein Kunde von uns sind, bitte besuchen Sie uns bald wieder.');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL', 'Abbrechen');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_SUFFIX', '');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TRANSSTATE', 'Trans. State:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTHCODE', 'Auth. Code:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AVSADDR', 'AVS Address match:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AVSZIP', 'AVS ZIP match:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CVV2MATCH', 'CVV2 match:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_DAYSTOSETTLE', 'Days to Settle:');
// this text is used to announce the username/password when the module creates the customer account and emails data to them:
define('EMAIL_EC_ACCOUNT_INFORMATION', 'Bei Ihrem Checkout mit PayPal Express wurde automatisch ein Kundenkonto in unserem Shop angelegt, damit Sie wieder einloggen und den Status Ihrer Bestellung prüfen können. Mit folgenden Zugangsdaten können Sie in Ihr Kundenkonto einloggen:');
define('MODULES_PAYMENT_PAYPALWPP_LINEITEM_TEXT_ONETIME_CHARGES_PREFIX', 'Einmalgebühren bezogen auf ');
define('MODULES_PAYMENT_PAYPALWPP_LINEITEM_TEXT_SURCHARGES_SHORT', 'Aufpreise');
define('MODULES_PAYMENT_PAYPALWPP_LINEITEM_TEXT_SURCHARGES_LONG', 'Bearbeitungsgebühren und andere Gebühren');
define('MODULES_PAYMENT_PAYPALWPP_LINEITEM_TEXT_DISCOUNTS_SHORT', 'Rabatte');
define('MODULES_PAYMENT_PAYPALWPP_LINEITEM_TEXT_DISCOUNTS_LONG', 'Angewandte Rabatte, Discounts, Gutscheincodes, Geschenkgutscheine, etc');
define('MODULES_PAYMENT_PAYPALDP_TEXT_EMAIL_FMF_SUBJECT', 'Zahlung in Betrugsprüfung Status: ');
define('MODULES_PAYMENT_PAYPALDP_TEXT_EMAIL_FMF_INTRO', 'This is an automated notification to advise you that PayPal flagged the payment for a new order as Requiring Payment Review by their Fraud team. Normally the review is completed within 36 hours. It is STRONGLY ADVISED that you DO NOT SHIP the order until payment review is completed. You can see the latest review status of the order by logging into your PayPal account and reviewing recent transactions.');
define('MODULES_PAYMENT_PAYPALWPP_TEXT_BLANK_ADDRESS', 'PROBLEM: Sorry. PayPal hat unerwarteter Weise eine leere Adresse zurückgegeben. <br />Um Ihre Bestellung abzuschließen, geben Sie bitte Ihre Adresse an, in dem Sie den Konto Erstellen Button anclicken und ein Kundenkonto in unserem Shop anlegen. Dann gehen Sie bitte wieder zur Kasse und wählen erneut PayPal als Zahlungsart aus. Sorry für die Unannehmlichkeiten. Wenn Sie Schwierigkeiten mit der Bestellung haben, nutzen Sie bitte das Kontaktformular und schildern uns, was nicht funktioniert. Wir helfen Ihnen dann gerne weiter.');
define('MODULES_PAYMENT_PAYPALWPP_AGGREGATE_CART_CONTENTS', 'Alle Artikel in Ihrem Warenkorb (Details finden Sie im Shop unter Mein Konto und in Ihrer Bestellbestätigung)');
define('MODULES_PAYMENT_PAYPALWPP_MESSAGE_STACK_CHECKOUT_SHIPPING', 'Sie zahlen mit PayPal und verwenden eine bei PayPal hinterlegte Lieferadresse.<br/>Wir möchten sicherstellen, dass diese Lieferadresse korrekt ist, daher haben wir Sie wieder auf diese Seite geleitet.<br/>Bitte prüfen Sie die Lieferanschrift und ändern Sie sie falls das nötig sein sollte..<br/>Adresse korrekt? Fein!<br/>Clicken Sie rechts unten auf weiter und bestätigen Sie dann im letzten Schritt nochmals mit dem Button Kaufen.<br/>PayPal Zahlung und Bestellung werden erst durchgeführt, wenn Sie die Bestellung auf diese Weise bestätigen.');