DROP TABLE IF EXISTS `banktransfer_blz`;
CREATE TABLE `banktransfer_blz` (
  `blz` int(10) NOT NULL default '0',
  `bic` varchar(11) NOT NULL default '',
  `bankname` varchar(255) NOT NULL default '',
  `bankplz` varchar(5) NOT NULL default '',
  `bankort` varchar(64) NOT NULL default '',
  `pan` VARCHAR(5) NULL,
  `prz` char(2) NOT NULL default '',
  PRIMARY KEY  (`blz`)
) TYPE=MyISAM;
