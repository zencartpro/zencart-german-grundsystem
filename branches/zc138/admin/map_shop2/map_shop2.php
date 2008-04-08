<?php

/**
 * @package map_shop
 * @desc map_shop generates google_map entries at http://shops.zen-cart.at
 * @copyright Copyright 2006-2007 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id$
 */

chdir('../');
require_once('includes/application_top.php');
require_once('map_shop2_func.php');

require(DIR_WS_INCLUDES . 'header.php');

#rldp($_POST, 'POST');
/**
 * init smarty environment
 */
$smarty = setSmarty ();

/**
 * header stuff
 */
$smarty->assign('path', '../');
$smarty -> display('header.tpl.html');

$ms = new mapShop2();

/**
 * main-part == MS
 */

 $showResult = 'NO';
 $res = 'first';
 if(isset($_POST['Submit'])){
    $res = $_POST['Submit'];
    $ms->catOpt = $ms->getSel($_POST['MAP_SHOP2_CATEGORY']);      
    $smarty->assign('conf', $_POST);    
 }
 switch ($res) {
    case 'first':
        $smarty->assign('conf', $ms->getConf());       
        $smarty -> assign('work', '');   
        break;
    case MAP_SHOP2_BTN_UPDATE:
        $ms->saveData($_POST);
        $smarty -> assign('work', 'ich bin am datenübertragen');   
        $showResult = 'YES';
        $smarty->assign('showResult', $showResult);

      break;
    case MAP_SHOP2_BTN_GOOGLE:
        echo 'GOOGLE';
      break;
 }
 
$smarty->assign('catOpt', $ms->catOpt);
$smarty -> assign('version', $ms->version);
$smarty -> display('map_shop2.tpl.html');


/**
 * footer stuff
 */
require(DIR_WS_INCLUDES . 'footer.php');



?>
