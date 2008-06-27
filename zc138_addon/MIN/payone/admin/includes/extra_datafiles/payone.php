<?php
// $Id$

$poTables = array();
$poTables['transaction'] = "CREATE TABLE `po_transactions` (
                              `txid` int(11) NOT NULL default '0',
                              `memo` text NOT NULL,
                              `param` varchar(255) NOT NULL default '',
                              `po_userid` mediumint(8) unsigned NOT NULL default '0',
                              `amount` float(3,2) NOT NULL default '0.00',
                              `clearingtype` varchar(8) NOT NULL default '',
                              `txtime` int(11) NOT NULL default '0',
                              `po_accessid` mediumint(8) unsigned NOT NULL default '0',
                              `portalid` mediumint(8) unsigned NOT NULL default '0',
                              `productid` mediumint(8) unsigned NOT NULL default '0',
                              `aid` smallint(5) unsigned NOT NULL default '0',
                              `status` varchar(15) NOT NULL default '',
                              `failedcause` varchar(10) NOT NULL default '',
                              `failedcost` float(4,2) NOT NULL default '0.00',
                              `balance` float(4,2) NOT NULL default '0.00',
                              `orders_id` int(11) NOT NULL,
                              PRIMARY KEY  (`txid`)
                            )";
$poTables['log'] = 'CREATE TABLE `rl_log` (
                      `id` int(11) NOT NULL auto_increment,
                      `filename` varchar(150) NOT NULL,
                      `comment` text NOT NULL,
                      `get` text NOT NULL,
                      `post` text NOT NULL,
                      PRIMARY KEY  (`id`)
                    )';

$poLang = array();

// german
$poLang['43'] = array(
                    'MODULE_PAYMENT_PAYONE_AID' => array('PAYONE ZugangsID', 'die PAYONE ZugangsID'),
                    'MODULE_PAYMENT_PAYONE_CLEARINGTYPES' => array('Payment methods', 'Select allowed payment methods (f.e. \"cc;elv\")'),
                    'MODULE_PAYMENT_PAYONE_DEBUG' => array('Debugging', 'Debugging aktivieren; die Tabelle rl_log wird beschrieben'),
                    'MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS' => array('Adresse anzeigen', 'die Adresse im Zahlungsfenster erneut anzeigen?'),
                    'MODULE_PAYMENT_PAYONE_DISPLAY_NAME' => array('Namen anzeigen', 'den Kundennamen im Zahlungsfenster erneut anzeigen?'),
                    'MODULE_PAYMENT_PAYONE_KEY' => array('Händler-Schlüssel', 'Ihr Händler-Schlüssel'),
                    'MODULE_PAYMENT_PAYONE_MODE' => array('Modus', 'Live oder Test-Modus auswählen (test = Testmodus, live = Live Zahlung'),
                    'MODULE_PAYMENT_PAYONE_ORDER_STATUS_ID' => array('Bestell-Status', 'Bestellstatus nach erfolgreicher Bestellung'),
                    'MODULE_PAYMENT_PAYONE_PORTALID' => array('PAYONE PortalID', 'Ihre PAYONE PortalID'),
                    'MODULE_PAYMENT_PAYONE_REQUEST' => array('Forderung', 'authorization:   Forderung wird sofort eingezogen (Vorgabe) <br />preauthorization:  Forderung wird später eingezogen (per API oder PMI)'),
                    'MODULE_PAYMENT_PAYONE_SORT_ORDER' => array('Sort order of display.', 'Sort order of display. Lowest is displayed first.'),
                    'MODULE_PAYMENT_PAYONE_STATUS' => array('PAYONE Module aktivieren', 'Wollen Sie PAYONE-Vorkasse als Zahlungsmittel aktivieren?'),
                    'MODULE_PAYMENT_PAYONE_ZONE' => array('Payment Zone', 'If a zone is selected, only enable this payment method for that zone.'),
);

// greece
$poLang['30'] = array(
                    'MODULE_PAYMENT_PAYONE_AID' => array('PAYONE ZugangsID', 'die PAYONE ZugangsID'),
                    'MODULE_PAYMENT_PAYONE_CLEARINGTYPES' => array('Payment methods', 'Select allowed payment methods (f.e. \"cc;elv\")'),
                    'MODULE_PAYMENT_PAYONE_DEBUG' => array('Debugging', 'Debugging aktivieren; die Tabelle rl_log wird beschrieben'),
                    'MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS' => array('Adresse anzeigen', 'die Adresse im Zahlungsfenster erneut anzeigen?'),
                    'MODULE_PAYMENT_PAYONE_DISPLAY_NAME' => array('Namen anzeigen', 'den Kundennamen im Zahlungsfenster erneut anzeigen?'),
                    'MODULE_PAYMENT_PAYONE_KEY' => array('Händler-Schlüssel', 'Ihr Händler-Schlüssel'),
                    'MODULE_PAYMENT_PAYONE_MODE' => array('Modus', 'Live oder Test-Modus auswählen (test = Testmodus, live = Live Zahlung'),
                    'MODULE_PAYMENT_PAYONE_ORDER_STATUS_ID' => array('Bestell-Status', 'Bestellstatus nach erfolgreicher Bestellung'),
                    'MODULE_PAYMENT_PAYONE_PORTALID' => array('PAYONE PortalID', 'Ihre PAYONE PortalID'),
                    'MODULE_PAYMENT_PAYONE_REQUEST' => array('Forderung', 'authorization:   Forderung wird sofort eingezogen (Vorgabe) <br />preauthorization:  Forderung wird später eingezogen (per API oder PMI)'),
                    'MODULE_PAYMENT_PAYONE_SORT_ORDER' => array('Sort order of display.', 'Sort order of display. Lowest is displayed first.'),
                    'MODULE_PAYMENT_PAYONE_STATUS' => array('PAYONE Module aktivieren', 'Wollen Sie PAYONE-Vorkasse als Zahlungsmittel aktivieren?'),
                    'MODULE_PAYMENT_PAYONE_ZONE' => array('Payment Zone', 'If a zone is selected, only enable this payment method for that zone.'),
);

