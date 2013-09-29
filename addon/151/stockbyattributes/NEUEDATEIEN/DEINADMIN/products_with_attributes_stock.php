<?php
/**
 * @package admin
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: products_with_attributes_stock.php 2013-06-06 19:37:14Z hugo13/webchills $
 */

require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
require(DIR_WS_CLASSES . 'products_with_attributes_stock.php');


$stock = new products_with_attributes_stock;

if(isset($_SESSION['languages_id'])){ $language_id = $_SESSION['languages_id'];} else { $language_id=1;}

if(isset($_GET['action']))
{
	$action = $_GET['action'];
}
else
{
	$action = '';
}

switch($action)
{
	case 'add':
		if(isset($_GET['products_id']) and is_numeric((int)$_GET['products_id']))
		{
			$products_id = (int)$_GET['products_id'];
		}
		if(isset($_POST['products_id']) and is_numeric((int)$_POST['products_id']))
		{
			$products_id = (int)$_POST['products_id'];
		}

		if(isset($products_id))
		{

			if(zen_products_id_valid($products_id))
			{

				$product_name = zen_get_products_name($products_id);
				$product_attributes = $stock->get_products_attributes($products_id, $language_id);

  			$hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
			}
			else
			{

				zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, zen_get_all_get_params(array('action')), 'NONSSL'));
			}
		}
		else
		{

			$query = 'SELECT DISTINCT
                        attrib.products_id, description.products_name
                      FROM 
                        '.TABLE_PRODUCTS_ATTRIBUTES.' attrib, '.TABLE_PRODUCTS_DESCRIPTION.' description
                      WHERE 
                        attrib.products_id = description.products_id and description.language_id='.$language_id.' order by description.products_name';

			$products = $db->execute($query);
			while(!$products->EOF)
			{
				$products_array_list[] = array(
				'id' => $products->fields['products_id'],
				'text' => $products->fields['products_name']
				);
				$products->MoveNext();
			}
		}
		break;
	case 'edit':
		$hidden_form = '';
		if(isset($_GET['products_id']) and is_numeric((int)$_GET['products_id']))
		{
			$products_id = $_GET['products_id'];
		}

		if(isset($_GET['attributes']))
		{
			$attributes = $_GET['attributes'];
		}

		if(isset($products_id) and isset($attributes))
		{
			$attributes = explode(',',$attributes);
			foreach($attributes as $attribute_id){
				$hidden_form .= zen_draw_hidden_field('attributes[]',$attribute_id)."\n";
				$attributes_list[] = $stock->get_attributes_name($attribute_id, $language_id);
			}
			$hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
		}
		else
		{
			zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, zen_get_all_get_params(array('action')), 'NONSSL'));
		}

		break;

	case 'confirm':
		if(isset($_POST['products_id']) and is_numeric((int)$_POST['products_id']))
		{

			if(!isset($_POST['quantity']) || !is_numeric($_POST['quantity']))
			{
				zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, zen_get_all_get_params(array('action')), 'NONSSL'));
			}
			
			$products_id = $_POST['products_id'];
			$product_name = zen_get_products_name($products_id);
			if(is_numeric($_POST['quantity']))
			{
				$quantity = $_POST['quantity'];
			}

			$attributes = $_POST['attributes'];
	
			foreach($attributes as $attribute_id)
			{
				$hidden_form .= zen_draw_hidden_field('attributes[]',$attribute_id)."\n";
				$attributes_list[] = $stock->get_attributes_name($attribute_id, $_SESSION['languages_id']);
			}
			$hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
			$hidden_form .= zen_draw_hidden_field('quantity',$quantity)."\n";
			$s_mack_noconfirm .="products_id=" . $products_id . "&"; //s_mack:noconfirm
			$s_mack_noconfirm .="quantity=" . $quantity . "&"; //s_mack:noconfirm

			if(sizeof($attributes) > 1)
			{
				sort($attributes);
				$stock_attributes = implode(',',$attributes);
			}
			else
			{
				$stock_attributes = $attributes[0];
			}
			$s_mack_noconfirm .='attributes=' . $stock_attributes . '&'; //kuroi: to pass string not array

			$query = 'select * from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id = '.$products_id.' and stock_attributes="'.$stock_attributes.'"';
			$stock_check = $db->Execute($query);

			if(!$stock_check->EOF)
			{
				$hidden_form .= zen_draw_hidden_field('add_edit','edit');
				$hidden_form .= zen_draw_hidden_field('stock_id',$stock_check->fields['stock_id']);
				$s_mack_noconfirm .="stock_id=" . $stock_check->fields['stock_id'] . "&"; //s_mack:noconfirm
				$s_mack_noconfirm .="add_edit=edit&"; //s_mack:noconfirm
				$add_edit = 'edit';
			}
			else
			{
				$hidden_form .= zen_draw_hidden_field('add_edit','add')."\n";
				$s_mack_noconfirm .="add_edit=add&"; //s_mack:noconfirm
			}

		}
		else
		{
			zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, zen_get_all_get_params(array('action')), 'NONSSL'));
		}
		zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, $s_mack_noconfirm . "action=execute", 'NONSSL')); //s_mack:noconfirm
		break;
	case 'execute':
		$attributes = $_POST['attributes'];
		if ($_GET['attributes']) { $attributes = $_GET['attributes']; } //s_mack:noconfirm

		$products_id = $_POST['products_id'];
		if ($_GET['products_id']) { $products_id = $_GET['products_id']; } //s_mack:noconfirm

		
		$quantity = $_GET['quantity']; //s_mack:noconfirm
		if ($_GET['quantity']) { $quantity = $_GET['quantity']; } //s_mack:noconfirm
		if(!is_numeric((int)$quantity)) //s_mack:noconfirm
		{
			zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, zen_get_all_get_params(array('action')), 'NONSSL'));
		}

		/*
		michael mcinally <mcinallym@picassofish.com>
		heavily modified version to allow inserting "ALL" attributes at once
		also should probably run this SQL command as well:
		ALTER TABLE `products_with_attributes_stock` ADD UNIQUE `products_id_stock_attributes` (`products_id`, `stock_attributes`);
		*/
		if(($_POST['add_edit'] == 'add') || ($_GET['add_edit'] == 'add')) //s_mack:noconfirm
		{
			if (preg_match("/\|/", $attributes)) {

				$arrTemp = preg_split("/\,/", $attributes);
				$arrMain = array();
				$intCount = 0;
				for ($i = 0;$i < sizeof($arrTemp);$i++) {
          $arrTemp1 = preg_split("/\|/", $arrTemp[$i]);
          $arrMain[] = $arrTemp1;
					if ($intCount) {
						$intCount = $intCount * sizeof($arrTemp1);
					} else {
						$intCount = sizeof($arrTemp1);
					}
				}
				$intVars = sizeof($arrMain);
				$arrNew = array();
				if ($intVars >= 1) {
					eval('
					for ($i = 0;$i < sizeof($arrMain[0]);$i++) {
						if ($intVars >= 2) {
							for ($j = 0;$j < sizeof($arrMain[1]);$j++) {
								if ($intVars >= 3) {
									for ($k = 0;$k < sizeof($arrMain[2]);$k++) {
										if ($intVars >= 4) {
											for ($l = 0;$l < sizeof($arrMain[3]);$l++) {
												if ($intVars >= 5) {
													for ($m = 0;$m < sizeof($arrMain[4]);$m++) {
														if ($intVars >= 6) {
															for ($n = 0;$n < sizeof($arrMain[5]);$n++) {
																$arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l], $arrMain[4][$m], $arrMain[5][$n]);
															}
														} else {
															$arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l], $arrMain[4][$m]);
														}
													}
												} else {
													$arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l]);
												}
											}
										} else {
											$arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k]);
										}
									}
								} else {
									$arrNew[] = array($arrMain[0][$i], $arrMain[1][$j]);
								}
							}
						} else {
							$arrNew[] = array($arrMain[0][$i]);
						}
					}
					');
				}
				for ($i = 0;$i < sizeof($arrNew);$i++) {
					$strAttributes = implode(",", $arrNew[$i]);
					$query = 'insert into `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` (`products_id`,`stock_attributes`,`quantity`) values ('.$products_id.',"'.$strAttributes.'",'.$quantity.') ON DUPLICATE KEY UPDATE `stock_attributes` = "'.$strAttributes.'", `quantity` = '.$quantity;
					$db->Execute($query);
				}
			} else {
			$query = 'insert into `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` (`products_id`,`stock_attributes`,`quantity`) values ('.$products_id.',"'.$attributes.'",'.$quantity.')';
				$db->Execute($query);
			}
		}
		elseif(($_POST['add_edit'] == 'edit') || ($_GET['add_edit'] == 'edit')) //s_mack:noconfirm
		{
			$stock_id = $_POST['stock_id']; //s_mack:noconfirm
			if ($_GET['stock_id']) { $stock_id = $_GET['stock_id']; } //s_mack:noconfirm
			if(!is_numeric((int)$stock_id)) //s_mack:noconfirm
			{
				zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, zen_get_all_get_params(array('action')), 'NONSSL'));
			}

			$query = 'update `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` set quantity='.$quantity.' where stock_id='.$stock_id.' limit 1';
				$db->Execute($query);
		}
		

		$stock->update_parent_products_stock($products_id);
		$messageStack->add_session('Artikel erfolgreich aktualisiert', 'success');
		zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));

		break;
	case 'delete':
		if(!isset($_POST['confirm']))
		{
			// do nothing
		}
		else
		{
			// delete it
			if($_POST['confirm'] == TEXT_YES){
				$query = 'delete from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id="'.$_POST['products_id'].'" and stock_attributes="'.$_POST['attributes'].'" limit 1';
				$db->Execute($query);
				$stock->update_parent_products_stock((int)$_POST['products_id']);
				$messageStack->add_session('Artikelvariante erfolgreich gelöscht', 'failure');
				zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));
			} else {
				zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));
			}
		}
		break;

	case 'resync':
		if(is_numeric((int)$_GET['products_id'])){

			$stock->update_parent_products_stock((int)$_GET['products_id']);
			$messageStack->add_session('Menge erfolgreich aktualisiert', 'success');
			zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));

		} else {
			zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));
		}
		break;
  case 'resync_all':
    $stock->update_all_parent_products_stock();
    $messageStack->add_session('Mengen der übergeordneten Artikel erfolgreich aktualisiert', 'success');
    zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));    
  break;
  case 'auto_sort':
    // get all attributes
    $sql = $db->Execute("SELECT stock_id, stock_attributes FROM " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " ORDER BY stock_id ASC;");
    $count = 0;
    while (!$sql->EOF) {
      // get main attribute only for sort
      $attributes = explode(',', $sql->fields['stock_attributes']);
      $main_attribute_id = $attributes[0];
      // get the sort order
      $sort_query = "SELECT pa.products_attributes_id, pov.products_options_values_sort_order as sort 
                     FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                     LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov on (pov.products_options_values_id = pa.options_values_id)
                     WHERE pa.products_attributes_id = " . $main_attribute_id . "
                     LIMIT 1;";
      $sort = $db->Execute($sort_query); 
      $sort = $sort->fields['sort'];
      // update sort in db
      $db->Execute("UPDATE " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " set sort = '" . $sort . "' WHERE stock_id = '" . $sql->fields['stock_id'] . "' LIMIT 1;");
      $count++;
      $sql->MoveNext();
    }
    $messageStack->add_session($count . ' Lagerbestandattribute aktualisiert mit Sortierung nach dem ersten Attribut', 'success');
    zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));                   
  break;
	default:
		// Show a list of the products

		break;
}


?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/products_with_attributes_stock_ajax.css" media="all" id="hoverJS">
<script language="javascript" type="text/javascript" src="../ajax/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../ajax/jquery.form.js"></script>
<script language="javascript" type="text/javascript" src="../ajax/products_with_attributes_stock_ajax.js"></script>
<script language="javascript" type="text/javascript" src="includes/menu.js"></script>
<script language="javascript" type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript">
<!--
function init()
{
	cssjsmenu('navbar');
	if (document.getElementById)
	{
		var kill = document.getElementById('hoverJS');
		kill.disabled = true;
	}
}
// -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php
require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<div style="padding: 20px;">
<div class="pageHeading"><?php echo PWA_WELCOME ?></div>
<!-- body_text_eof //-->
<!-- body_eof //-->
<?php

switch($action)
{
	case 'add':


		if(isset($products_id))
		{

			echo zen_draw_form('final_refund_exchange', FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'action=confirm', 'post', '', true)."\n";
			echo $hidden_form;

			echo '<p><strong>'.$product_name.'</strong></p>'."\n";

			foreach($product_attributes as $option_name => $options)
			{
// MULTI
				$arrValues = array();
				if (is_array($options)) {
					if (sizeof($options) > 0) {
						foreach ($options as $k => $a) {
							$arrValues[] = $a['id'];
						}
					}
				}
				
				array_unshift($options, array('id' => implode("|", $arrValues), 'text' => 'All'));
				echo '<p><strong>'.$option_name.': </strong>';
				echo zen_draw_pull_down_menu('attributes[]',$options).'</p>'."\n";

			}

			echo '<p><strong>' . PWA_QUANTITY . '</strong>'.zen_draw_input_field('quantity').'</p>'."\n";

		}
		else
		{

			echo zen_draw_form('final_refund_exchange', FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'action=add', 'post', '', true)."\n";
			echo zen_draw_pull_down_menu('products_id',$products_array_list)."\n";
		}

?>
	<p><input type="submit" value="<?php echo PWA_SUBMIT ?>"></p>
	</form>
<?php
break;
	case 'edit':

		echo zen_draw_form('final_refund_exchange', FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'action=confirm', 'post', '', true)."\n";
		echo '<h3>'.zen_get_products_name($products_id).'</h3>';

		foreach($attributes_list as $attributes)
		{
			echo '<p><strong>'.$attributes['option'].': </strong>'.$attributes['value'].'</p>';
		}

		echo $hidden_form;
		echo '<p><strong>Menge: </strong>'.zen_draw_input_field('quantity', $_GET['q']).'</p>'."\n"; //s_mack:prefill_quantity
?>
	<p><input type="submit" value="<?php echo PWA_SUBMIT ?>"></p>
	</form>
<?php
break;
	case 'delete':
		if(!isset($_POST['confirm']))
		{

			echo zen_draw_form('final_refund_exchange', FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'action=delete', 'post', '', true)."\n";
			echo PWA_DELETE_VARIANT_CONFIRMATION;
			foreach($_GET as $key=>$value)
			{
				echo zen_draw_hidden_field($key,$value);
			}
?>
 	<p><input type="submit" value="<?php echo TEXT_YES ?>" name="confirm"> * <input type="submit" value="<?php echo TEXT_NO ?>" name="confirm"></p>
 	</form>
<?php  
		}
		break;
	case 'confirm':

		echo '<h3>Bestätige '.$product_name.'</h3>';

		foreach($attributes_list as $attributes)
		{
			echo '<p><strong>'.$attributes['option'].': </strong>'.$attributes['value'].'</p>';
		}

		echo '<p><strong>Menge</strong>'.$quantity.'</p>';
		echo zen_draw_form('final_refund_exchange', FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'action=execute', 'post', '', true)."\n";
		echo $hidden_form;
?>
	<p><input type="submit" value="<?php echo PWA_SUBMIT ?>"></p>
	</form>

<?php 	
break;
	default:
    echo '<div id="hugo1" style="background-color: green; padding: 2px 10px;"></div>';    
    echo '<form method="get" action="' . zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL') . '" id="pwas-search" name="pwas-search">Suchbegriff:  <input id="pwas-filter" type="text" name="search"/><input type="submit" value="Suchen" id="pwas-search-button" name="pwas-search-button"/></form><span style="margin-right:10px;">&nbsp;</span>';
    echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL') . '">Zurücksetzen</a><span style="margin-right:10px;">&nbsp;</span><a href="' . zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'action=auto_sort', 'NONSSL') . '">Sortieren</a>';
    echo '<span id="loading" style="display: none;"><img src="../images/ajax-loader2.gif" alt="" /> Loading...</span><hr />';
    echo '<a class="forward" style="float:right;" href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=resync_all", 'NONSSL').'"><strong>Alle Mengen synchronisieren</strong></a><br class="clearBoth" /><hr />';
    echo '<div id="pwa-table"';
    echo $stock->displayFilteredRows();
    echo '</div>';
break;
}
?>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>