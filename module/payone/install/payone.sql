

CREATE TABLE IF NOT EXISTS `po_transactions` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;