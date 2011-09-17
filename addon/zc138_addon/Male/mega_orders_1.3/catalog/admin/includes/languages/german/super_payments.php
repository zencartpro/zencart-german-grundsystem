<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   This file generates a pop-up window  //
//  that is used to enter and edit payment information  //
//  for a given order.                                  //
//////////////////////////////////////////////////////////
// $Id: super_payments.php 25 2006-02-03 18:55:56Z BlindSide $
*/
require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'order_status_email.php');

define('HEADER_ENTER_PAYMENT', 'Zahlung eingeben');
define('HEADER_ENTER_PO', 'Bestellung eingeben');
define('HEADER_ENTER_REFUND', 'Erstattung eingeben');

define('HEADER_UPDATE_PAYMENT', 'Zahlung aktualisieren');
define('HEADER_UPDATE_PO', 'Bestellung aktualisiere');
define('HEADER_UPDATE_REFUND', 'Erstattung aktualisiere');

define('HEADER_CONFIRM_PAYMENT', 'Zahlung best&auml;tigen');
define('HEADER_CONFIRM_PO', 'Bestellung best&auml;tigen');
define('HEADER_CONFIRM_REFUND', 'Erstattung best&auml;tigen');

define('HEADER_DELETE_PAYMENT', 'Zahlung l&ouml;schen');
define('HEADER_DELETE_PO', 'Bestellung l&ouml;schen');
define('HEADER_DELETE_REFUND', 'Erstattung l&ouml;schen');

define('HEADER_ORDER_ID', 'Rechnung #');
define('HEADER_PAYMENT_UID', 'Zahlung UID #');
define('HEADER_REFUND_UID', 'Erstattung UID #');
define('HEADER_PO_UID', 'Bestellung UID #');

define('TEXT_PAYMENT_NUMBER', 'Nummer:');
define('TEXT_PAYMENT_NAME', 'Name:');
define('TEXT_PAYMENT_AMOUNT', 'Betrag:');
define('TEXT_PAYMENT_TYPE', 'Bestelltyp:');
define('TEXT_ATTACHED_PO', 'Bestellung:');

define('TEXT_PO_NUMBER', 'Bestellnummer:');

define('TEXT_ATTACHED_PAYMENT', 'Zahlung f&auml;llig:');
define('TEXT_REFUND_NUMBER', 'Nummer:');
define('TEXT_REFUND_NAME', 'Name:');
define('TEXT_REFUND_AMOUNT', 'Betrag:');
define('TEXT_REFUND_TYPE', 'Bestelltyp');
define('TEXT_NO_MINUS', ' * Kein Minus Zeichen');

define('BUTTON_SUBMIT', 'senden');
define('BUTTON_CANCEL', 'Abbrechen');
define('BUTTON_SAVE_CLOSE', 'Speichern & Zur&uuml;ck');
define('BUTTON_MODIFY', 'aktualisieren');
define('BUTTON_ADD_NEW', 'Weitere bearbeiten');
define('BUTTON_ADD_PAYMENT', 'Zahlung bearbeiten');

define('CHECKBOX_UPDATE_STATUS', 'Bestellung mit vorgegebenen Status & Kommentare aktualisieren?');
define('CHECKBOX_NOTIFY_CUSTOMER', 'Kunde informieren?');

define('WARN_DELETE_PAYMENT', 'Sind Sie sicher, dass die Zahlung gel&ouml;scht werden soll?<p>Diese Aktion kann nicht r&uuml;ckg&auml;ngig gemacht werden!');
define('WARN_DELETE_PO', 'Sind Sie sicher, dass die Rechnungsbestellung gel&ouml;scht werden soll?<p>Diese Aktion kann nicht r&uuml;ckg&auml;ngig gemacht werden!');
define('WARN_DELETE_REFUND', 'Sind Sie sicher, dass die Erstattung gel&ouml;scht werden soll?<p>Diese Aktion kann nicht r&uuml;ckg&auml;ngig gemacht werden!');

define('TEXT_REFUND_ACTION', '<strong>%s</strong> refund(s) currently tied to this payment.  Was m&ouml;chten Sie machen?');
define('REFUND_ACTION_KEEP', 'Geben Sie die R&uuml;ckzahlung zusammen mit der Bestellung, aber nicht einer besonderen Zahlung an');
define('REFUND_ACTION_MOVE', 'R&uuml;ckzahlung einer anderen Zahlung zuordnen: ');
define('REFUND_ACTION_DROP', 'Mit der R&uuml;ckzahlung zusammen entfernen');

define('TEXT_PAYMENT_ACTION', '<strong>%s</strong> Zahlungen sind zurzeit an dieser Bestellung gebunden. Was m&ouml;chten Sie tun?');
define('PAYMENT_ACTION_KEEP', 'Geben Sie die Zahlung zusammen mit der Bestellung, aber nicht einer besonderen Zahlung an.');
define('PAYMENT_ACTION_MOVE', 'Zahlung einer anderen Bestellung zuordnen:');
define('PAYMENT_ACTION_DROP', 'Mit der Zahlung zusammen entfernen');

define('HEADER_DELETE_CONFIRM', 'L&ouml;schen erfolgreich');
define('TEXT_DELETE_CONFIRM', 'Der Vorgang ist komplett.<p><strong>%s</strong> Linie(n) wurden ge&auml;ndert.');
define('BUTTON_DELETE_CONFIRM', 'Zur&uuml;ck');

// DO NOT EDIT
define('NL', "\n");
// DO NOT EDIT
?>