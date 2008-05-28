<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

  define('MODULE_PAYMENT_NOCHEX_TEXT_ADMIN_TITLE', 'Nochex APC');
  define('MODULE_PAYMENT_NOCHEX_TEXT_CATALOG_TITLE', 'Credit oder Debit Card (Nochex)');
  if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_NOCHEX_TEXT_DESCRIPTION', '<strong>Nochex APC</strong><br /><br />Dieses Modul unterstützt beides, Nochex Verkäufer und Nochex Händler. Es verwendet die aktuellste Nochex Zahlungsmethode um Ihren Käufern eine reibungslose und nahtlose Zahlung zu ermöglichen. Wenige Konfigurationsschritte sind erforderlich aber bitte lesen Sie die Dokumentation zuerst.' );
  } else {
    define('MODULE_PAYMENT_NOCHEX_TEXT_DESCRIPTION', '<strong>Nochex</strong>');
  }
  define('MODULE_PAYMENT_NOCHEX_ENTRY_TRANSACTION_ID', 'Transaktion ID');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_TRANSACTION_DATE', 'Transaktion Datum');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_TO_EMAIL', 'Zahlung an');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_FROM_EMAIL', 'Zahlung von');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_ORDER_ID', 'Bestell-Nr.');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_CUSTOM', 'Kundenspezifisches Feld');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_AMOUNT', 'Betrag bezahlt');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_SECURITY_KEY', 'Sicherheitsschlüssel');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_STATUS', 'Zahlungsstatus');
  define('MODULE_PAYMENT_NOCHEX_ENTRY_NOCHEX_RESPONSE', 'Nochex Antwort');
  define('MODULE_PAYMENT_NOCHEX_PURCHASE_DECRIPTION_TITLE', STORE_NAME . ' Einkauf');

  define('MODULE_PAYMENT_NOCHEX_NOT_CONFIGURED_MERCHANT_ID', ' <span class="alert"> (nicht konfiguriert - Händler ID wird benötigt)</span>');
