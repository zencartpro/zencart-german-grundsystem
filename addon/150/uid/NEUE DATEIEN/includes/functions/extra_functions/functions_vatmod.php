<?php
/**
 * functions_vat_mod.php
 * Verifying functions for VAT-Mod for Zen Cart
 *
 * @package functions
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_vatmod.php 6000 2010-08-17 02:16:51CET beez $
 */


////////////////////////////////////////////////////////////////////////////////////////////////
//
// Function		: zen_verif_tva 
// Arguments	: num_tva   VAT INTRACOM number to be checked
// Return		: true  - valid VAT number
//				: false - invalid VAT number
//
// Description : function for validating VAT INTRACOM number through the europa.eu.int server
//               The zen_verif_tva() function is converted from a script written by didou (didou@nexen.net).
//               The original script is available at http://www.nexen.net/index.php
//							 Modified by JeanLuc (February, 5th 2004)
//							 Updated by JeanLuc (July, 23th 2004)
//							 Updated by Beez & vike (December, 5th 2007)
//
// Valid VAT INTRACOM number structure:
//    Austria			AT + 9 numeric and alphanumeric characters 
//    Belgium			BE + 9 numeric characters 
//    Bulgaria			BG + 9 or 10 numeric characters
//    Cyprus 			CY + 8 numeric characters + 1 alphabetic character  
//    Czech Republic 	CZ + 8 or 9 or 10 numeric characters 
//    Denmark			DK + 8 numeric characters 
//    Estonia 			EE + 9 numeric characters 
//    Finland			FI + 8 numeric characters 
//    France			FR + 2 chiffres (informatic key) + No. SIREN (9 figures) 
//    Germany			DE + 9 numeric characters 
//    Greece			EL + 9 numeric characters 
//    Hungary 			HU + 8 numeric characters 
//    Irlande			IE + 8 numeric and alphabetic characters 
//    Italy				IT + 11 numeric characters 
//    Latvia 			LV + 11 numeric characterss 
//    Lithuania 		LT + 9 or 12 numeric characters 
//    Luxembourg		LU + 8 numeric characters 
//    Malta 			MT + 8 numeric characters 
//    Netherlands		NL + 12 alphanumeric characters, one of them a letter 
//    Poland	 		PL + 10 numeric characters 
//    Portugal 			PT + 9 numeric characters 
//    Slovakia  		SK + 9 or 10 numeric characters 
//    Spain 			ES + 9 characters 
//    Sweden 			SE + 12 numeric characters 
//    United Kingdom 	GB + 5 to 9 numeric characters 
//    Romania			RO + 2 to 9 numeric characters
//    Slovenia 			SI + 8 numeric characters
//
////////////////////////////////////////////////////////////////////////////////////////////////
function zen_verif_tva($num_tva){
$num_tva=preg_replace('/ +/', "", $num_tva);
$prefix = substr($num_tva, 0, 2);
if (array_search($prefix, zen_get_tva_intracom_array() ) === false) {
return 'false';
}

$tva = substr($num_tva, 2);	

// 070208 BEGIN

$opts = array(
  'http'=>array(
    'method'=>"POST",
    'content'=>"iso=".$prefix."&ms=".$prefix."&vat=".$tva."&BtnSubmitVat=Verify"));

$context = stream_context_create($opts);

// 070208 END

$monfd = file_get_contents('http://ec.europa.eu/taxation_customs/vies/viesquer.do', null, $context); // 170810
if ( preg_match("/invalid VAT number/i", $monfd) ) {
return 'false';
} elseif ( preg_match("/valid VAT number/i", $monfd) ){
return 'true';
} else {
$myVerif = 'no_verif';
}
return $myVerif;
}

////////////////////////////////////////////////////////////////////////////////////////////////
//
// Function	: zen_get_tva_intracom_array 
// Return		: array
//
// Description	: Array for linking the ISO code of each country of EU and the first 2 letters of the vat number
//			(for Greece or France metropolitaine , it's different)
//             
//							  by JeanLuc (July, 23th 2004)             
//
////////////////////////////////////////////////////////////////////////////////////////////////
function zen_get_tva_intracom_array() {
$intracom_array = array('AT'=>'AT',    //Austria
'BE'=>'BE',	//Belgium
'DK'=>'DK',	//Denmark
'FI'=>'FI',	//Finland
'FR'=>'FR',	//France
'FX'=>'FR',	//France metropolitaine
'DE'=>'DE',	//Germany
'GR'=>'EL',	//Greece
'IE'=>'IE',	//Irland
'IT'=>'IT',	//Italy
'LU'=>'LU',	//Luxembourg
'NL'=>'NL',	//Netherlands
'PT'=>'PT',	//Portugal
'ES'=>'ES',	//Spain
'SE'=>'SE',	//Sweden
'GB'=>'GB',	//United Kingdom
'CY'=>'CY',	//Cyprus
'EE'=>'EE',	//Estonia
'HU'=>'HU',	//Hungary
'LV'=>'LV',	//Latvia
'LT'=>'LT',	//Lithuania
'MT'=>'MT',	//Malta
'PL'=>'PL',	//Poland
'SK'=>'SK', //Slovakia
'CZ'=>'CZ',	//Czech Republic
'SI'=>'SI', //Slovania
'RO'=>'RO', //Romania
'BG'=>'BG'); //Bulgaria
return $intracom_array;
}

function get_tva_intracom_number() {
    global $db;
    $store_country_query = "select configuration_value as store_country
                      from " . TABLE_CONFIGURATION . "
                      where configuration_key = 'STORE_COUNTRY'";
    $store_country = $db->Execute($store_country_query);
    
    $tva_intracom_query = "select entry_country_id as country_id, entry_tva_intracom as tva_intracom
                      from " . TABLE_ADDRESS_BOOK . "
                      where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                      and address_book_id = '" . (int)$_SESSION['customer_default_address_id'] . "'";

    $tva_intracom = $db->Execute($tva_intracom_query);
    //$tva_intracom = $tva_intracom->fields['tva_intracom'];  
    if ($tva_intracom->fields['country_id'] === $store_country->fields['store_country']) {
        return false;
    } else {
        return true;
    }
}

?>