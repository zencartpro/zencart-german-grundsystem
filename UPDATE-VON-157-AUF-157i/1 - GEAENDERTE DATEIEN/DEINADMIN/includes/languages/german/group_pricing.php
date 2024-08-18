<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: group_pricing.php 2023-10-28 15:49:16Z webchills $
 */

define('HEADING_TITLE', 'Gruppenpreise');

define('TABLE_HEADING_GROUP_NAME', 'Gruppenname');
define('TABLE_HEADING_GROUP_AMOUNT', '% Rabatt');

define('TEXT_HEADING_NEW_PRICING_GROUP', 'Neue Preisgruppe');
define('TEXT_HEADING_EDIT_PRICING_GROUP', 'Preisgruppe bearbeiten');
define('TEXT_HEADING_DELETE_PRICING_GROUP', 'Preisgruppe löschen');
define('TEXT_NEW_INTRO', 'Bitte geben Sie folgende Informationen für die neue Preisgruppe an');

define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Preisgruppe löschen wollen?');
define('TEXT_DELETE_PRICING_GROUP', 'Preisgruppe löschen');
define('TEXT_DELETE_WARNING_GROUP_MEMBERS', '<b>WARNUNG:</b> Es gibt %s Kunden, die noch mit dieser Kategorie verbunden sind !');
define('TEXT_GROUP_PRICING_NAME', 'Gruppenname: ');
define('TEXT_GROUP_PRICING_AMOUNT', 'Preisnachlass in Prozent: ');

define('TEXT_CUSTOMERS', 'Kunden in der Gruppe:');
define('ERROR_GROUP_PRICING_CUSTOMERS_EXIST', 'FEHLER: In dieser Gruppe sind noch Kunden.  Bestätigen Sie bitte, daß Sie alle Mitglieder von der Gruppe entfernen und sie löschen möchten.');
define('ERROR_MODULE_NOT_CONFIGURED', 'HINWEIS: Sie verwenden Gruppenpreise, haben jedoch nicht das Gruppenermäßigunsmodul aktiviert.<br>Gehen Sie zu Admin->Module->Zusammenfassung->Gruppenermäßigung (ot_group_pricing) und installieren/konfigurieren das Modul.');