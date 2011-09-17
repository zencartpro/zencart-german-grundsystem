<?php
/**
 * @version sofortüberweisung 3.03 - $Date: 2011-08-12 11:08:11 +0200 (Fr, 08 Aug 2011) $
 * @author Payment Network AG (integration@payment-network.com)
 * @link http://www.payment-network.com/
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
 * USA
 *
 ***********************************************************************************
 * this file contains code based on:
 * (c) 2000 - 2001 The Exchange Project
 * (c) 2001 - 2003 osCommerce, Open Source E-Commerce Solutions
 * (c) 2003 - 2011 Zen-Cart
 * Released under the GNU General Public License
 ***********************************************************************************
 *
 * $Id: pn_sofortueberweisung.php 121 2010-04-12 08:17:11Z thoma $
 * $Id: pn_sofortueberweisung.php 2011-08-12 09:17:11Z webchills $
 *
 */

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_TITLE', 'sofortüberweisung');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_PUBLIC_TITLE', 'sofortüberweisung');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ALLOWED_TITLE', 'Erlaubte Zonen');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ALLOWED_DESC', 'Geben Sie <b>einzeln</b> die Zonen an, welche für dieses Modul erlaubt sein sollen. (z.B. AT,DE (wenn leer, werden alle Zonen erlaubt))');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_TITLE', 'sofortüberweisung Modul aktivieren');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_DESC', 'Möchten Sie Zahlungen per sofortüberweisung akzeptieren?');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_TITLE', 'Kundennummer');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_DESC', 'Ihre Kundennummer bei der sofortüberweisung');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_TITLE', 'Projektnummer');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_DESC', 'Die verantwortliche Projektnummer bei der sofortüberweisung, zu der die Zahlung gehört');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_TITLE', 'Projekt-Passwort:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_DESC', 'Das Projekt-Passwort (unter Erweiterte Einstellungen / Passwörter und Hashfunktionen)');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_TITLE', 'Benachrichtigungspasswort:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_DESC', 'Das Benachrichtigungspasswort (unter Erweiterte Einstellungen / Passwörter und Hashfunktionen)');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_TITLE', 'Hash-Algorithmus:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_DESC', 'Der Hash-Algorithmus (unter Erweiterte Einstellungen / Passwörter und Hashfunktionen)');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_DESC', 'Reihenfolge der Anzeige. Kleinste Ziffer wird zuerst angezeigt');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_TITLE', 'Zahlungszone');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, gilt die Zahlungsmethode nur für diese Zone.');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES_TITLE', 'Länder');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES_DESC', 'Tragen Sie hier die Länder ein, für die sofortüberweisung möglich sein soll. Zweistellige ISO-Codes mit Komma getrennt');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_CURRENCY_TITLE', 'Transaktionswährung');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_CURRENCY_DESC', 'Empfangende Währung laut sofortüberweisung Projekteinstellung');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_TITLE', 'bestätigter Bestellstatus');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_DESC', 'Order Status nach Eingang einer Bestellung, bei der von sofortüberweisung eine erfolgreiche Zahlungsbestätigung übermittelt wurde');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_TITLE', 'Temporärer Bestellstatus');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_DESC', 'Bestellstatus für noch nicht abgeschlossene Transaktionen');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_NAME', 'sofortüberweisung Vorbereitung');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_TITLE', 'Zu überprüfender Bestellstatus');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_DESC', 'Bestellstatus nach Eingang einer Bestellung bei der eine fehlerhafte Zahlungsbestätigung übermittelt wurde');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_TITLE', 'Verwendungszweck Zeile 1');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_DESC', 'Im Verwendungszweck (maximal 27 Zeichen) kann nur die Bestellnummer und Kundennummer stehen. Die Werte müssen eindeutig sein');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_TITLE', 'Verwendungszweck Zeile 2');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_DESC', 'Im Verwendungszweck (maximal 27 Zeichen) werden folgende Platzhalter ersetzt:<br /> {{order_id}}<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_TITLE', 'Zahlungsauswahl Grafik / Text');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_DESC', 'Angezeigte Grafik / Text bei der Auswahl Zahlungsoptionen');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'Online-Überweisung mit TÜV geprüftem Datenschutz ohne Registrierung. Bitte halten Sie Ihre Online-Banking-Daten (PIN/TAN) bereit.  Dienstleistungen/Waren werden bei Verfügbarkeit SOFORT geliefert bzw. versendet!');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'sofortüberweisung ist der kostenlose, TüV-zertifizierte Zahlungsdienst der Payment Network AG. Ihre Vorteile: keine zusätzliche Registrierung, automatische Abbuchung von Ihrem Online-Bankkonto, höchste Sicherheitsstandards und sofortiger Versand von Lagerware. Für die Bezahlung mit sofortüberweisung benötigen Sie Ihre eBanking Zugangsdaten, d.h. Bankverbindung, Kontonummer, PIN und TAN.');


define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION', (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS != 'True' ? 
	'<form action="'.zen_href_link(FILENAME_MODULES, '', 'SSL').'" method="get"><input type="hidden" name="set" value="payment">
	<input type="hidden" name="module" value="pn_sofortueberweisung"><input type="hidden" name="action" value="install">
	<input type="hidden" name="autoinstall" value="1"><input type="submit" value="Autoinstaller (empfohlen)" /></form><br />' : '').'<br />
	<b>sofortüberweisung</b><br>Sobald der Kunde sofortüberweisung ausgewählt hat und auf Bestellen klickt, wird eine Bestellung angelegt. 
	Bei Abbruch wird die Bestellung nicht rückgängig gemacht und die Bestellnummer nicht verworfen. Der Kunde wird auf eine Seite geleitet wo ihm die Bankdaten für eine manuelle Überweisung angezeigt werden. Solche abgebrochenen Bestellungen sind also so zu behandlen wie Vorauskasse per Banküberweisung.');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '
     <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><a href="https://www.payment-network.com/sue_de/demo/start" target="_blank">{{image}}</a></td>
      </tr>
      <tr>
      	<td class="main"><br />%s</td>
      	</tr>	
    </table>');

  define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_CONFIRMATION', '
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main"><p>Nach Bestätigung der Bestellung werden Sie zum Zahlungssytem von sofortüberweisung weitergeleitet und können dort eine Online-Überweisung duchführen.</p><p>Hierfür benötigen Sie Ihre eBanking Zugangsdaten, d.h. Bankverbindung, Kontonummer, PIN und TAN. Mehr Informationen finden Sie hier: <a href="https://www.payment-network.com/sue_de/demo/start" target="_blank">sofort.com</a>.</p></td>
      </tr>
    </table>');