<?php
/** 
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: dsgvo_export.php 2022-02-04 18:57:14Z webchills $
 */

define('HEADING_TITLE', 'DSGVO Kundendatensatz Export');
define('DSGVO_KUNDENEXPORT_OVERVIEW', 'Laut Art. 20 DSGVO haben Kunden das Recht, ihre personenbezogenen Daten, die sie dem Shopbetreiber bereitgestellt haben, in einem strukturierten, gängigen und maschinenlesebaren Format zu erhalten<br>Wenn Kunden diesbezüglich anfragen, können Sie hier für jeden Kunden einen aktuellen Kundendatensatz erstellen, der auch die bisherigen Bestellungen und eventuell abgegebene Produktbewertungen des Kunden enthält.<br>Generiert wird eine csv Datei mit Trennzeichen Semikolon und Zeichensatz utf-8.<br>Wählen Sie einen Kunden aus und clicken Sie dann auf den Export Button, um eine csv Datei aus dem aktuellen Datenbestand zu erzeugen und herunterzuladen.<br>');
define('IMAGE_DSGVOEXPORT','DSGVO Kundendaten Export');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_FIRSTNAME', 'Vorname');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Konto erstellt am');

define('TEXT_DATE_ACCOUNT_CREATED', 'Konto erstellt am:');
define('ENTRY_NONE', 'Kein');
define('TABLE_HEADING_COMPANY', 'Firma');
define('TEXT_INFO_ADDRESS_BOOK_COUNT', ' | 1 von  ');
define('TABLE_HEADING_LOGIN', 'Letzte Anmeldung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('ADDRESS_BOOK_TITLE', 'Adressbucheinträge');
define('PRIMARY_ADDRESS', '(Standard Adresse)');
define('TEXT_MAXIMUM_ENTRIES', '<span class="coming"><strong>Anmerkung:</strong></span> Es sind maximal %s Adressbucheinträge erlaubt.');

define('CSV_HEADING_TITLE_SALUTATION','Anrede');
define('CSV_HEADING_TITLE_GENDER','Herr/Frau/Divers');
define('DSGVO_CUSTOMERDATA_HEADING','KUNDENDATEN');
define('DSGVO_CUSTOMERS_GENDER','Anrede');
define('DSGVO_CUSTOMERS_FIRSTNAME','Vorname');
define('DSGVO_CUSTOMERS_LASTNAME','Nachname');
define('DSGVO_CUSTOMERS_DOB','Geburtsdatum');
define('DSGVO_CUSTOMERS_EMAIL_ADDRESS','E-Mail Adresse');
define('DSGVO_ENTRY_COMPANY','Firmenname');
define('DSGVO_ENTRY_STREET_ADDRESS','Strasse und Hausnummer');
define('DSGVO_ENTRY_POSTCODE','PLZ');
define('DSGVO_ENTRY_CITY','Stadt');
define('DSGVO_COUNTRIES_NAME','Land');
define('DSGVO_CUSTOMERS_TELEPHONE','Telefon');
define('DSGVO_CUSTOMERS_FAX','Fax');
define('DSGVO_CUSTOMERS_INFO_DATE_ACCOUNT_CREATED','Kunde seit');
define('DSGVO_CUSTOMERS_INFO_DATE_OF_LAST_LOGON','letztes Login');
define('DSGVO_REVIEWS_HEADING','BEWERTUNGEN');
define('DSGVO_REVIEW_HEADING','Bewertung');
define('DSGVO_DATE','Datum');
define('DSGVO_PRODUCT_NAME','Produkt');
define('DSGVO_REVIEWS_TEXT','Text');
define('DSGVO_ORDERS_HEADING','BESTELLUNGEN');
define('DSGVO_ORDER_HEADING','Bestellung');
define('DSGVO_ORDER_ID','Bestellnummer');
define('DSGVO_ORDER_DATE','Bestelldatum');
define('DSGVO_ORDER_IP_ADDRESS','IP Addresse');
define('DSGVO_CUSTOMER_ADDRESS','Kundenaddresse');
define('DSGVO_SHIPPING_ADDRESS','Lieferadresse');
define('DSGVO_BILLING_ADDRESS','Rechnungsadresse');
define('DSGVO_PAYMENT_METHOD','Zahlungsart');
define('DSGVO_PRODUCT_NUMBER','Artikelnummer');