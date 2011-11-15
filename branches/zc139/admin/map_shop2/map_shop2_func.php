<?php

/**
 * @package map_shop
 * @desc map_shop generates google_map entries at http://shops.zen-cart-pro.at
 * @copyright Copyright 2006-2007 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id$
 */

$tmp = getcwd();
if(strpos($tmp, 'map_shop2')){
    chdir('../');
}
require_once('includes/application_top.php');

class mapShop2{
    var $version = '2008-04-10';
    private $localHash;
    private $oldHash;
    private $db;
    private $msConfig = array();
    public $catOpt = null;
    function __construct(){
        global $db, $smarty;
        $this->version = '2010-09-24 :: <a href="' . MAP_SHOP2_MAPSHOP . '" target="_blank">' . MAP_SHOP2_MAPSHOP . '</a>';
        $this->db = $db;
        $this->initDB;
        $this->localHash = md5(HTTP_CATALOG_SERVER . DIR_WS_CATALOG . '::' . STORE_OWNER_EMAIL_ADDRESS);
        $this->collectData();
        $this->oldHash = $this->msConfig['MAP_SHOP2_HASH'];
    }
    
    function collectData(){
        $sql = "SELECT configuration_key, configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key='MAP_SHOP2_SHOP'";
        $rows = $this->db->execute($sql);
        if (!$rows->EOF){
            $tmp = $rows->fields['configuration_value'];
            $this->msConfig = unserialize($tmp);
        } else {
        
        }
        $this->msConfig['MAP_SHOP2_STORE_NAME'] = STORE_NAME;
        $this->msConfig['MAP_SHOP2_STORE_EMAIL'] = EMAIL_FROM;
        $this->msConfig['MAP_SHOP2_STORE_NAME_ADDRESS'] = str_replace("\n", '<br>', STORE_NAME_ADDRESS);
        $this->catOpt = $this->getSel($this->msConfig['MAP_SHOP2_CATEGORY']);
        $this->msConfig['MAP_SHOP2_COUNTRY'] = zen_get_country_name(SHIPPING_ORIGIN_COUNTRY);
        $this->msConfig['MAP_SHOP2_HTML'] = HTTP_CATALOG_SERVER . DIR_WS_CATALOG;
        $this->msConfig['MAP_SHOP2_GETCOORD'] = MAP_SHOP2_GETCOORD;
        $this->msConfig['MAP_SHOP2_GOOGLEMAP'] = MAP_SHOP2_GOOGLEMAP;
        $this->msConfig['MAP_SHOP2_MAIL'] = 'hugo@xx.yy';
    }
    function getConf(){
        return $this->msConfig;
    }
    function saveData($data){
        $sql = "SELECT count(configuration_key) AS c FROM " . TABLE_CONFIGURATION . " WHERE configuration_key='MAP_SHOP2_SHOP'";
        $cc = $this->db->execute($sql);
        if($cc->fields['c']==0){
            $sql = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_group_id) VALUES ('MAP_SHOP2_SHOP', 6)";
            $this->db->execute($sql);
        }
        $data['MAP_SHOP2_HASH'] = $this->localHash;
        $tmp = mysql_escape_string(serialize($data));
        $sql = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $tmp . "' WHERE configuration_key ='MAP_SHOP2_SHOP' LIMIT 1 ;";
        $this->db->execute($sql);
        return $this->saveRemoteData();
    }

    function saveRemoteData(){
        $r = array();
        foreach ($_POST as $key => $value) {
            if(substr($key, 0, 10)=='MAP_SHOP2_'){
                $v = 'ms_' . strtolower(substr($key, 10));
                $r[$v] = $value;
            }
        }
        $r['ms_hash'] = $this->localHash;
        $r['h'] = $this->oldHash;
        $x = http_build_query($r, NULL, '&');
        $s = (serialize($r));
        
        $c = curl_init(MAP_SHOP2_SAVEREMOTE);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $x);
        curl_setopt($c, CURLOPT_RETURNTRANSFER,1);
        $page = curl_exec($c);
        curl_close($c);
        return $page;
    }
    
    function get_content($url)
    {
        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();
       
        return $string;    
    }

    function getSel($opt = 'NIX'){
        $tmp = $this->get_content(MAP_SHOP2_SEL);
        if('NIX' != $opt){
            $tmp = str_replace('<option value="' . $opt . '">', '<option value="' . $opt . '" selected>', $tmp);
        }
        return $tmp;
    }
}


function getGeoCoord($form='test'){
    $addr = $form['a'];
    $page = getCurlCoord($addr, $form['f']);
    $co2 = split('#', $page);
        
    $ret = array('lat'=>$co2[0], 'lng'=>$co2[1] );
    return json_encode($ret);
}

function displayMap($form){
    $addr = $form['a'];
    $s = $form['f'];
    $html = '<iframe id="mapframe" width="760" height="480" frameborder="2" scrolling="no" marginheight="0" marginwidth="3" ';
    $html .= 'src="' . $s . '?p=' . $addr . '" name="myIframe"></iframe>';
    return $html;

}
function getCurlCoord($address, $coord='http://demo.zen-cart-pro.at/map/getcoord.php'){
    $c = curl_init($coord);
    curl_setopt($c, CURLOPT_POST, 1);
    curl_setopt($c, CURLOPT_POSTFIELDS,'a=' . $address);
    curl_setopt($c, CURLOPT_RETURNTRANSFER,1);
    $page = curl_exec($c);
    curl_close($c);
    return $page;
}

if(isset($_POST['ac'])){
    $ac = $_POST['ac'];
} else {
    if(isset($_GET['ac'])){
        $ac = $_GET['ac'];
    } else {
        $ac = 'nix';
    }
}
switch ($ac) {
   case 'a':
        echo getGeoCoord($_POST);
     break;
   case 'd':
        $ms = new mapShop2();
        $r = $ms->saveData($_POST);
        echo 'Data saved::'.MAP_SHOP2_SAVEREMOTE . ' :: ' . $r;
     break;
   case 'm':
        echo displayMap($_POST);
     break;
   default:
        echo '';
     break;
}
