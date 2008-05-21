<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-AT" lang="de-AT">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <base href="http://soap.zencart.hugo13.com" /> -->
<title>Zen-Cart SOAP example</title>
<?php $xajax->printJavascript('./'); ?>
<script type="text/javascript" src="./xajax_js/loading.js"></script>
<link rel="stylesheet" type="text/css" href="soap.example.css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<body> 
<div id="wrap"> 
  <div id="info"> 
    <h1>A Zen-Cart SOAP example with Xajax</h1> 
  </div> 
<div id="footer"><a href="http://soap.zencart.hugo13.com/index.php?main_page=product_info&cPath=65&products_id=180" target="_blank">Online-Shop</a></div>   
  <div id="menu">
    <a href='#' onclick='xajax.call("getSoapInfo"); return false;'>getSoapInfo</a>  | 
    <a href='#' onclick='xajax.call("getCategoriesList"); return false;'>getCategoriesList</a> | 
    <a href='#' onclick='xajax.call("getProductByCategory"); return false;'>getProductByCategory</a> | <hr>
      <strong>Change SoapServer</strong>
  <input id="srv1" onchange='xajax.call("setServer", {parameters:[document.getElementById("srv1").value]}); return false;' name="soapserver" type="radio" value="http://soap.zencart.hugo13.com/soap/ZenCart.wsdl" checked>soap.zencart.hugo13.com
  soap.zencart.hugo13.com
  </div> 
  <div id="output"> 
   
  <img id="spinner" src="spinner_balken.gif" style="display: none;" /> 
<table>
  <tr valign="top">
    <td id="out1"></td>
    <td id="out2">&nbsp;</td>
    <td id="outinfo">(c)rainer langheiter, 2006 vienna</td>
    <td id="out3">&nbsp;</td>
  </tr>
</table>    
<div id="Layer1" style="position:absolute; width:92px; height:17px; z-index:1; left: 537px; top: 183px;"><img id="loadingMessage" src="spinner_balken.gif" style="display: none;" /></div>
  </div> 
  
</div> 