<?php
/*=======================================================================*\
|| #################### //-- SCRIPT INFO --// ########################## ||
|| #	Script name: admin/includes/seo_cache_reset.php
|| #	Contribution: Ultimate SEO URLs v2.1
|| #	Version: 2.0
|| #	Date: 30 January 2005
|| # ------------------------------------------------------------------ # ||
|| #################### //-- COPYRIGHT INFO --// ######################## ||
|| #	Copyright (C) 2005 Bobby Easland								# ||
|| #	Internet moniker: Chemo											# ||	
|| #	Contact: chemo@mesoimpact.com									# ||
|| #	Commercial Site: http://gigabyte-hosting.com/					# ||
|| #	GPL Dev Server: http://mesoimpact.com/							# ||
|| #																	# ||
|| #	This script is free software; you can redistribute it and/or	# ||
|| #	modify it under the terms of the GNU General Public License		# ||
|| #	as published by the Free Software Foundation; either version 2	# ||
|| #	of the License, or (at your option) any later version.			# ||
|| #																	# ||
|| #	This script is distributed in the hope that it will be useful,	# ||
|| #	but WITHOUT ANY WARRANTY; without even the implied warranty of	# ||
|| #	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the	# ||
|| #	GNU General Public License for more details.					# ||
|| #																	# ||
|| #	Script is intended to be used with:								# ||
|| #	osCommerce, Open Source E-Commerce Solutions					# ||
|| #	http://www.oscommerce.com										# ||
|| #	Copyright (c) 2003 osCommerce									# ||
|| ###################################################################### ||
\*========================================================================*/
	$db->Execute("DELETE FROM " . TABLE_SEO_CACHE . " WHERE cache_name LIKE '%seo_urls%'");
?>