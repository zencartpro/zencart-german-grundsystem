<?php
/*
	+----------------------------------------------------------------------+
	|	Ultimate SEO URLs For Zen Cart, version 2.100                        |
	+----------------------------------------------------------------------+
	|                                                                      |
	|	Derrived from Ultimate SEO URLs v2.1 for osCommerce by Chemo         |
	|                                                                      |
	|	Portions Copyright 2005, Joshua Dechant                              |
	|                                                                      |
	|	Portions Copyright 2005, Bobby Easland                               |
	|                                                                      |
	|	Portions Copyright 2003 The zen-cart developers                      |
	|                                                                      |
	+----------------------------------------------------------------------+
	| This source file is subject to version 2.0 of the GPL license,       |
	| that is bundled with this package in the file LICENSE, and is        |
	| available through the world-wide-web at the following url:           |
	| http://www.zen-cart.com/license/2_0.txt.                             |
	| If you did not receive a copy of the zen-cart license and are unable |
	| to obtain it through the world-wide-web, please send a note to       |
	| license@zen-cart.com so we can mail you a copy immediately.          |
	+----------------------------------------------------------------------+
*/

	class SEO_URL_INSTALLER{	
		var $default_config;
		var $db;
		var $attributes;

		function SEO_URL_INSTALLER() {
			$this->attributes = array();
		
			$x = 0;
			$this->default_config = array();

			$this->default_config['SEO_ENABLED'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'SEO URLs aktivieren?', 'SEO_ENABLED', 'true', 'SEO URLs aktivieren? Generelle Einstellung zum kompletten Abschalten.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['SEO_ADD_CPATH_TO_PRODUCT_URLS'] = array(
				'DEFAULT' => 'false',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Kategorienummer als cPath an die Produktlinks anhängen?', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'false', 'Kategorienummer wird als cPath angehängt (z.B. - some-product-p-1.html?cPath=xx).', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['SEO_ADD_CAT_PARENT'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Oberkategorienamen am Anfang der Kategorielinks anzeigen?', 'SEO_ADD_CAT_PARENT', 'true', 'Übergeordnete Kategorie wird in Kategorielinks angezeigt (z.B. - parent-category-c-1.html).', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['SEO_URLS_FILTER_SHORT_WORDS'] = array(
				'DEFAULT' => '0',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Kurze Worte ausfiltern', 'SEO_URLS_FILTER_SHORT_WORDS', '0', 'Worte mit weniger oder gleich viel Buchstaben wie hier eingestellt werden aus der URL entfernt.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, NULL)"
			);
			$x++;

			$this->default_config['SEO_URLS_USE_W3C_VALID'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'W3C valide URLs ausgeben?', 'SEO_URLS_USE_W3C_VALID', 'true', 'Die ausgegebenen URLs sind W3C konform.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['USE_SEO_CACHE_GLOBAL'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'SEO Cache aktivieren?', 'USE_SEO_CACHE_GLOBAL', 'true', 'Generelle Einstellung, die den Cache komplett abschaltet.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['USE_SEO_CACHE_PRODUCTS'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Produkt Cache aktivieren?', 'USE_SEO_CACHE_PRODUCTS', 'true', 'Produktcache aktivieren?', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
				);
			$x++;

			$this->default_config['USE_SEO_CACHE_CATEGORIES'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Kategorie Cache aktivieren?', 'USE_SEO_CACHE_CATEGORIES', 'true', 'Kategoriecache aktivieren?', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['USE_SEO_CACHE_MANUFACTURERS'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Hersteller Cache aktivieren?', 'USE_SEO_CACHE_MANUFACTURERS', 'true', 'Herstellercache aktivieren?', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['USE_SEO_CACHE_ARTICLES'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Artikel Cache?', 'USE_SEO_CACHE_ARTICLES', 'true', 'Artikelcache aktivieren?', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['USE_SEO_CACHE_INFO_PAGES'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Infoseiten Cache aktivieren?', 'USE_SEO_CACHE_INFO_PAGES', 'true', 'Infoseitencache aktivieren?', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['USE_SEO_REDIRECT'] = array(
				'DEFAULT' => 'true',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Automatische Redirects aktivieren?', 'USE_SEO_REDIRECT', 'true', 'Automatischen Redirect aktivieren? 301 Header wird für alte an neue URLs übermittelt.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['SEO_REWRITE_TYPE'] = array(
				'DEFAULT' => 'Rewrite',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'URL Rewrite Typ festlegen', 'SEO_REWRITE_TYPE', 'Rewrite', 'Welches SEO URL Format soll genutzt werden? (Derzeit wird nur Rewrite unterstützt!)', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''Rewrite''),')"
			);
			$x++;

			$this->default_config['SEO_CHAR_CONVERT_SET'] = array(
				'DEFAULT' => '',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Umlaute umschreiben', 'SEO_CHAR_CONVERT_SET', '', 'Umlaute sollte man umschreiben lassen.<br><br>Das Format <b>MUSS</b> so sein: <b>zeichen1=>wunschzeichen1,zeichen2=>wunschzeichen2</b><br/>Hier ein Beispiel, das bereits die wichtigsten enthält:<br/>
				ä=>ae,ö=>oe,ü=>ue,ß=>ss,é=>e,Ö=>Oe,Ä=>ae,Ü=>Ue,è=>e', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, NULL)"
			);
			$x++;

			$this->default_config['SEO_REMOVE_ALL_SPEC_CHARS'] = array(
				'DEFAULT' => 'false',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Nicht alphanumerische Zeichen entfernen?', 'SEO_REMOVE_ALL_SPEC_CHARS', 'false', 'Entfernt Zeichen, die keine Buchstaben oder Ziffern sind.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),')"
			);
			$x++;

			$this->default_config['SEO_URLS_CACHE_RESET'] = array(
				'DEFAULT' => 'false',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'SEO URLs Cache leeren', 'SEO_URLS_CACHE_RESET', 'false', 'Setzt den SEO URL Cache zurueck', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), 'zen_reset_cache_data_seo_urls', 'zen_cfg_select_option(array(''reset'', ''false''),')"
			);
			$x++;

			//IMAGINADW.COM
			$this->default_config['SEO_URLS_ONLY_IN'] = array(
				'DEFAULT' => 'index, product_info, products_new, products_all, featured_products, specials, contact_us, conditions, privacy, reviews, shippinginfo, faqs_all, site_map, gv_faq, discount_coupon, page, page_2, page_3, page_4',
				'QUERY' => "INSERT INTO `".TABLE_CONFIGURATION."` VALUES ('', 'Seiten eingeben, die umgeschrieben werden sollen', 'SEO_URLS_ONLY_IN', 'index, product_info, products_new, products_all, featured_products, specials, contact_us, conditions, privacy, reviews, shippinginfo, faqs_all, site_map, gv_faq, discount_coupon, page, page_2, page_3, page_4', 'Dieses Setting erlaubt den Rewrite nur fuer die angegebenen Seiten. Wird hier alles rausgeloescht, werden alle Seiten umgeschrieben. <br><br>Das Format <b>MUSS</b> sein: <b>page1,page2,page3</b>', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, NULL)"
			);
			$x++;

			$this->db = &$GLOBALS['db'];

			$this->init();
		}
	
/**
 * Initializer - if there are settings not defined the default config will be used and database settings installed. 
 * @author Bobby Easland 
 * @version 1.1
 */	
	function init() {
		foreach( $this->default_config as $key => $value ){
			$container[] = defined($key) ? 'true' : 'false';
		} # end foreach
		$this->attributes['IS_DEFINED'] = in_array('false', $container) ? false : true;
		switch(true){
			case ( !$this->attributes['IS_DEFINED'] ):
				$this->eval_defaults();
				$sql = "SELECT configuration_key, configuration_value  
						FROM " . TABLE_CONFIGURATION . " 
						WHERE configuration_key LIKE '%SEO%'";
				$result = $this->db->Execute($sql);
				$num_rows = $result->RecordCount();
				$this->attributes['IS_INSTALLED'] = (sizeof($container) == $num_rows) ? true : false;
				if ( !$this->attributes['IS_INSTALLED'] ){
					$this->install_settings(); 
				}
				break;
			default:
				$this->attributes['IS_INSTALLED'] = true;
				break;
		} # end switch
	} # end function
	
/**
 * This function evaluates the default serrings into defined constants 
 * @author Bobby Easland 
 * @version 1.0
 */	
	function eval_defaults(){
		foreach( $this->default_config as $key => $value ){
			define($key, $value['DEFAULT']);
		} # end foreach
	} # end function

/**
 * This function removes the database settings (configuration and cache)
 * @author Bobby Easland 
 * @version 1.0
 */	
	function uninstall_settings(){
		$this->db->Execute("DELETE FROM `".TABLE_CONFIGURATION_GROUP."` WHERE `configuration_group_title` LIKE '%SEO%'");
		$this->db->Execute("DELETE FROM `".TABLE_CONFIGURATION."` WHERE `configuration_key` LIKE '%SEO%'");
		$this->db->Execute("DROP TABLE IF EXISTS " . TABLE_SEO_CACHE);
	} # end function
	
/**
 * This function installs the database settings
 * @author Bobby Easland 
 * @version 1.0
 */	
	function install_settings(){
		$this->uninstall_settings();
		$sort_order_query = "SELECT MAX(sort_order) as max_sort FROM `".TABLE_CONFIGURATION_GROUP."`";
		$sort = $this->db->Execute($sort_order_query);
		$next_sort = $sort->fields['max_sort'] + 1;
		$insert_group = "INSERT INTO `".TABLE_CONFIGURATION_GROUP."` VALUES ('','43', 'Ultimate SEO URL 2.107', 'Einstellungen fuer Ultimate SEO URLs', '".$next_sort."', '1')";
		$this->db->Execute($insert_group);
		$group_id = $this->db->insert_ID();

		foreach ($this->default_config as $key => $value){
			$sql = str_replace('GROUP_INSERT_ID', $group_id, $value['QUERY']);
			$this->db->Execute($sql);
		}

		$insert_cache_table = "CREATE TABLE " . TABLE_SEO_CACHE . " (
		  `cache_id` varchar(32) NOT NULL default '',
		  `cache_language_id` tinyint(1) NOT NULL default '0',
		  `cache_name` varchar(255) NOT NULL default '',
		  `cache_data` mediumtext NOT NULL,
		  `cache_global` tinyint(1) NOT NULL default '1',
		  `cache_gzip` tinyint(1) NOT NULL default '1',
		  `cache_method` varchar(20) NOT NULL default 'RETURN',
		  `cache_date` datetime NOT NULL default '0000-00-00 00:00:00',
		  `cache_expires` datetime NOT NULL default '0000-00-00 00:00:00',
		  PRIMARY KEY  (`cache_id`,`cache_language_id`),
		  KEY `cache_id` (`cache_id`),
		  KEY `cache_language_id` (`cache_language_id`),
		  KEY `cache_global` (`cache_global`)
		) TYPE=MyISAM;";
		$this->db->Execute($insert_cache_table);
	} # end function	
} # end class
?>