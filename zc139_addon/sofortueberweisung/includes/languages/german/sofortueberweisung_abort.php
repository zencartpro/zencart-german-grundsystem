<?php
/**
 * @version sofortüberweisung.de 3.03 - $Date: 2011-08-12 11:25:11 +0200 (Fr, 12 Aug 2011) $
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
 * $Id: sofortueberweisung_abort.php 121 2010-04-12 08:17:11Z thoma $
 * $Id: sofortueberweisung_abort.php 122 2011-08-12 11:26:11Z webchills $
 *
 */

define('NAVBAR_TITLE', 'sofortüberweisung');
define('HEADING_TITLE', 'sofortüberweisung');

define('TEXT_INFORMATION', 'Folgender Fehler wurde von sofortüberweisung während des Prozesses gemeldet:<br /><br />
Zahlung via sofortüberweisung ist leider nicht möglich, oder wurde auf Kundenwunsch abgebrochen.<br /><br />
Bitte überweisen Sie den Betrag manuell auf folgendes Bankkonto:<br /><br />
Kontoinhaber: <br/>
Bank: <br/>
BLZ: <br/>
Kontonummer: <br/>
BIC: <br/>
IBAN: <br/><br/>
Ihre Bestellung wird erst bearbeitet, sobald der Betrag auf unserem Konto eingelangt ist.
');