<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 rainer langheiter <rainer@langheiter.com>
*  All rights reserved
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

if(!isset($_SESSION['SOAPSRV'])){
    session_start();
}

require_once ("./xajax_core/xajax.inc.php");
require_once 'soap.xajax.server.php';
$xajax = new xajax("soap.xajax.server.php");
$se = new SoapExample('http://soap.zencart.hugo13.com/soap/ZenCart.wsdl');
$xajax->registerCallableObject($se);

?>
