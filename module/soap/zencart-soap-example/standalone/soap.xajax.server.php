<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 rainer langheiter <rainer@langheiter.com>
*  All rights reserved
*  http://soap.zencart.hugo13.com :: http://edv.langheiter.com/zencartfaq/
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

error_reporting(0);
#error_reporting(E_ALL);

class SoapExample
    {

    function __construct($soapAddr = 'http://soap.zencart.hugo13.com/soap/ZenCart.wsdl')
        {
        if(isset($_SESSION['SOAPSRV'])){
            $this->soapAddr = $_SESSION['SOAPSRV'];
        } else {
                $this->soapAddr = $soapAddr;
                $_SESSION['SOAPSRV'] = $this->soapAddr;
        }
        $this->shopUrl = str_replace('soap/ZenCart.wsdl', '', $this->soapAddr);

        $this->objResponse=new xajaxResponse();
        $this->client     =new SoapClient($this->soapAddr, array('trace' => 1));
        }
    public function setServer($srv='http://soap.zencart.hugo13.com/soap/ZenCart.wsdl'){
        $content = $srv;
        $_SESSION['SOAPSRV'] = $srv;
        $this->objResponse->assign("out3", "innerHTML", $content . ' :: ' . $_SESSION['SOAPSRV']);
        $this->soapAddr = $srv;
        $this->shopUrl = str_replace('soap/ZenCart.wsdl', '', $this->soapAddr);  
        $this->shopUrl = str_replace('http://', '', $this->shopUrl);  
        $this->client     =new SoapClient($this->soapAddr, array('trace' => 1));     
        $this->getCategoriesList();
        $content = '<a href="' . $this->shopUrl .'index.php?main_page=product_info&cPath=65&products_id=180" target="_blank">Online-Shop::'.$this->shopUrl.'</a>';
        $this->objResponse->assign("footer", "innerHTML", $content);
        return $this->objResponse;
    }

    function multiply($x, $y)
        {
        $this->objResponse->assign("z", "value", $x * $y);
        return $this->objResponse;
        }

    function getSoapInfo()
        {
        $content = '<h4>'.$this->soapAddr . '</h4>';
        $content.=$this->rldp2($this->client->__getFunctions(), '__getFunctions');
        $content.=$this->rldp2($this->client->__getTypes(), '__getTypes');
        $this->objResponse->assign("out1", "innerHTML", $content);
        $this->objResponse->assign("out2", "innerHTML", '');
        $this->objResponse->assign("out3", "innerHTML", '');
        $this->objResponse->assign("outinfo", "innerHTML", '');
        return $this->objResponse;
        }

    public function getCategoriesList($languages_id = 'en')
        {
        $res=$this->client->getCategoriesList($languages_id);
        $content = '<h3>klick on a category</h3><hr>';
        foreach ($res as $key => $value)
            {
            $content .= '<span onclick=\'xajax.call("getProductByCategory", {parameters:['.$value->categories_id.']}); return false;\'>' . $value->categories_id . ' :: ' . $value->categories_name  . '</span><br />';
            }
        $this->objResponse->assign("out1", "innerHTML", $content);
        $this->objResponse->assign("out2", "innerHTML", $_SESSION['SOAPSRV']);
        $this->objResponse->assign("out3", "innerHTML", '');
        $this->objResponse->assign("outinfo", "innerHTML", '');
        return $this->objResponse;
        }

    public function getProductByCategory($catID=1,$maxDS=5,$languages_id = 'en')     
        {
        $this->getCategoriesList();
        $res = $this->client->getProducts($catID, $maxDS, $languages_id);
        $content .= '<h3>klick on a product<br />category: '.$catID.'</h3><hr>';
        foreach ($res as $key => $value)
            {
            $content .= '<span onclick=\'xajax.call("getProduct", {parameters:['.$value->products_id.']}); return false;\'>' . $value->products_id . ' :: ' . $value->products_name . '</span><br />';
            }
        $this->objResponse->assign("out2", "innerHTML", $content);
        $this->objResponse->assign("out3", "innerHTML", '');
        return $this->objResponse;
        }

    public function getProduct($prodID=26, $languages_id = 'en')     
        {
        $value = $this->client->getProduct($prodID, $languages_id);   
        $content = $this->makeProd($value);
        $this->objResponse->assign("out3", "innerHTML", $content);
        return $this->objResponse;
        }

    private function makeProd($prod){
        $tmpl = '<table width="100%" border="2">
                  <tr> 
                    <td align="right" valign="top">
                    <a href="'.$this->shopUrl.'index.php?main_page=product_info&ref=15&products_id=' . $prod->products_id . '&affiliate_banner_id=2" target="_blank"><img src="' . $prod->products_pic_medium . '" border="0" alt="' . $prod->products_name . '"><br />zum SHOP</a>
                    </td> 
                    <td></td> 
                    <td valign="top"><strong>products_model</strong>: '.$prod->products_model.'<br> 
                      <strong>products_name</strong>: '.$prod->products_name.'<br>
                      <strong>products_price_format</strong>: '. $prod->products_price_format . '<br>
                      <strong>products_description</strong>: ' . $prod->products_description . '<br>
                    <strong>products_image</strong>: ' . $prod->products_image . '<br>    </td> 
                  </tr> 
                </table>';
        return $tmpl;
    
    }
    function rldp2($call, $cname = 'NIX', $show = true)
        {
        $content='';

        if ($show)
            {
            $content='<br /><strong>' . $cname . ":</strong><pre>";

            if (!is_array($call))
                {
                $call=htmlspecialchars($call);
                }

            $content.=print_r($call, true);

            if (is_array($call))
                {
                reset($call);
                }

            $content.="</pre><hr></hr>";
            }

        return $content;
        }

    function SoapHelper()
        {
        $content=$this->rldp2($this->client->__getLastRequestHeaders(), 'getLastRequestHeaders');
        $content.=$this->rldp2($this->client->__getLastRequest(), '__getLastRequest');
        $content.=$this->rldp2($this->client->__getLastResponseHeaders(), '__getLastResponseHeaders');
        $content.=$this->rldp2($this->client->__getLastResponse(), '__getLastResponse');
        return $content;
        }

    function slow_function()
        {
        $objResponse=new xajaxResponse();
        sleep(2); //we'll do nothing for two seconds
        $objResponse->addAlert("All done");
        return $objResponse;
        }
    }

require("soap.xajax.common.php");
$xajax->processRequest();
?>
