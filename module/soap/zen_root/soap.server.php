<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 rainer langheiter <rainer@langheiter.com>      
*  All rights reserved
*  http://edv.langheiter.com  http://soap.zencart.hugo13.com
*
*  This script is part of the ZenCart project. The ZenCart project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
* $Id$       
***************************************************************/


require 'includes/application_top.php'; 
require 'includes/classes/products.php'; 

// 
require 'soap/ZenCart.class.php';
require 'soap/ZenCartProduct.class.php';
require 'soap/ZenCartCategoriesList.class.php';
require 'soap/ZenCartCategoriesListJSON.class.php';


ini_set("soap.wsdl_cache_enabled", "1"); // disabling WSDL cache; default cache-time == 1 day
$server = new SoapServer(HTTP_SERVER . DIR_WS_CATALOG ."soap/ZenCart.wsdl");
$server->setClass("ZenCart");
$server->setPersistence(SOAP_PERSISTENCE_SESSION);
$server->handle(); 
?>