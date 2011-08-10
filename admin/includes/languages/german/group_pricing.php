<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: group_pricing.php 297 2008-05-29 21:16:41Z maleborg $
//

define('HEADING_TITLE', 'Gruppenpreise');
define('TABLE_HEADING_GROUP_ID', 'ID');
define('TABLE_HEADING_GROUP_NAME', 'Gruppenname');
define('TABLE_HEADING_GROUP_AMOUNT', '% Rabatt');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_HEADING_NEW_PRICING_GROUP', 'Neue Preisgruppe');
define('TEXT_HEADING_EDIT_PRICING_GROUP', 'Preisgruppe bearbeiten');
define('TEXT_HEADING_DELETE_PRICING_GROUP', 'Preisgruppe löschen');
define('TEXT_NEW_INTRO', 'Bitte geben Sie folgende Informationen für die neue Preisgruppe an');
define('TEXT_EDIT_INTRO', 'Bitte führen Sie hier die notwendigen Änderungen durch');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Preisgruppe löschen wollen?');
define('TEXT_DELETE_PRICING_GROUP', 'Preisgruppe löschen');
define('TEXT_DELETE_WARNING_GROUP_MEMBERS', '<b>WARNUNG:</b> Es gibt %s Kunden, die noch mit dieser Kategorie verbunden sind !');
define('TEXT_GROUP_PRICING_NAME', 'Gruppenname: ');
define('TEXT_GROUP_PRICING_AMOUNT', 'Preisnachlass in Prozent: ');
define('TEXT_DATE_ADDED', 'Erstellt am:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_CUSTOMERS', 'Kunden in der Gruppe:');
define('ERROR_GROUP_PRICING_CUSTOMERS_EXIST', 'FEHLER: In dieser Gruppe sind noch Kunden.  Bestätigen Sie bitte, daß Sie alle Mitglieder von der Gruppe entfernen und sie löschen möchten.');
define('ERROR_MODULE_NOT_CONFIGURED', 'Anmerkung: Sie verwenden Gruppenpreise, haben jedoch nicht das Gruppenermäßigunsmodul aktiviert.<br />Gehen Sie zu Admin->Module->Zusammenfassung->Gruppenermäßigung (ot_group_pricing) und installieren/konfigurieren das Modul.');
