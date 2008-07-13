<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 *
 * Reworked again to change/add more features by yellow1912
 * Pay me a visit at RubikIntegration.com
 *
 */
 class request_restock extends yclass {
		
	function add_new_cross_products($product_string, $method, $main_id){
		global $messageStack;
		// clean up the array
		$product_array = array_filter(explode(trim(XSELL_PRODUCT_INPUT_SEPARATOR), strtoupper($product_string)));
		$product_array = array_unique($product_array);

		// re-index it
		$product_array = array_values($product_array);
		// sanitize for database query
		$product_array = zen_db_prepare_input($product_array);
		
		if ($method == 1)
			if(count($product_array)>0){
				$main_id = zen_db_prepare_input(strtoupper($main_id));
				if(empty($main_id))
					$messageStack->add(CROSS_SELL_NO_MAIN_FOUND, 'error');
				else
					foreach ($product_array as $id => $pid)
						$this->add_new_cross_product($main_id, $pid);
			}
			else
				$messageStack->add(sprintf(CROSS_SELL_NO_INPUT_FOUND,1), 'warning');
		else
			if (count($product_array)>1){
				foreach ($product_array as $id => $pid)
					foreach ($product_array as $id2 => $pid2)
						if ($pid2 != $pid)
							$this->add_new_cross_product($pid, $pid2);
				}
			else
				// Add error msg to stack
				$messageStack->add(sprintf(CROSS_SELL_NO_INPUT_FOUND,2), 'warning');	
	}
	
	function add_new_cross_product($products_id, $pid) {
	  global $db, $messageStack;
		// Make sure the 2 products exist
		if (XSELL_FORM_INPUT_TYPE == "model"){
			// For some reason the union query does not work in mysql 4.1 so we have to select 1 by 1
			$first_cross_product = $db->Execute("SELECT products_id FROM " . TABLE_PRODUCTS . " WHERE products_model = '$products_id' LIMIT 1");
			$second_cross_product = $db->Execute("SELECT products_id FROM ". TABLE_PRODUCTS . " WHERE products_model = '$pid' LIMIT 1");
			}
		else{
			$first_cross_product = $db->Execute("SELECT products_id FROM " . TABLE_PRODUCTS . " WHERE products_id = '$products_id' LIMIT 1");
			$second_cross_product = $db->Execute("SELECT products_id FROM ". TABLE_PRODUCTS . " WHERE products_id = '$pid' LIMIT 1");
			}
			// We should get back 2 products_id
		if ($first_cross_product->RecordCount() != 1)
			$messageStack->add(sprintf(CROSS_SELL_PRODUCT_NOT_FOUND, $products_id), 'error');
		elseif ($second_cross_product->RecordCount() != 1)
			$messageStack->add(sprintf(CROSS_SELL_PRODUCT_NOT_FOUND, $pid), 'error');
		else{
			$first_record = $first_cross_product->fields['products_id'];
			$second_record = $second_cross_product->fields['products_id'];
			if($first_record == $second_record)
				$messageStack->add(sprintf(CROSS_SELL_PRODUCT_DUPLICATE, $pid, $products_id), 'error');
			else{
				$check_xsell = $db->Execute("select count(products_id) as records from " . TABLE_PRODUCTS_XSELL . " where products_id = '" . $first_record . "' and xsell_id = '" . $second_record . "'");
				if ($check_xsell->fields['records'] > 0) {
					$messageStack->add(sprintf(CROSS_SELL_ALREADY_ADDED, $pid, $products_id), 'error');
				} 
				else {
					$insert_array = array('products_id'	=>	$first_record,
										'xsell_id'		=>	$second_record,
										'sort_order'	=>	'1'
										);
					zen_db_perform(TABLE_PRODUCTS_XSELL, $insert_array);
					$messageStack->add(sprintf(CROSS_SELL_ADDED, $pid, $products_id), 'success');
				}
			}
		}		
	}
	
	function update_cross_product($xsell_array){
		global $db, $messageStack;
		// clean it 
		$xsell_array = zen_db_prepare_input($xsell_array);
		// Take care of the sort thing first, shall we?
		$sorted_product_array = array();
		$deleted_product_array = array();
		foreach ($xsell_array as $xsell){
			if((int)$xsell['delete'] == 1)
				$deleted_product_array[] = $xsell['id'];
			else
				if($xsell['old_sort_order'] != $xsell['new_sort_order'] && $xsell['new_sort_order'] >= 0){
					$db->Execute('UPDATE '.TABLE_PRODUCTS_XSELL.' SET sort_order = '.$xsell['new_sort_order'].' WHERE ID = '.$xsell['id'].' LIMIT 1');
					if (XSELL_FORM_INPUT_TYPE == "model")
						$sorted_product_array[] =  $xsell['product_model'];
					else
						$sorted_product_array[] =  $xsell['product_id'];
				}
		}
		if(count($sorted_product_array) > 0)
			$messageStack->add(sprintf(CROSS_SELL_SORT_ORDER_UPDATED, implode(',',$sorted_product_array)), 'success');
		else
			$messageStack->add(CROSS_SELL_SORT_ORDER_NOT_UPDATED, 'warning');
			
		if(count($deleted_product_array) > 0){
			$db->Execute('DELETE FROM '.TABLE_PRODUCTS_XSELL.' WHERE ID IN ('.implode(',',$deleted_product_array).')');
			$messageStack->add(sprintf(CROSS_SELL_PRODUCT_DELETED, mysql_affected_rows($db->link)), 'success');
		}
		else
			$messageStack->add(CROSS_SELL_PRODUCT_NOT_DELETED, 'warning');
	}
	
	function search_cross_product($pid) {
		$pid = zen_db_prepare_input($pid);
		global $db, $messageStack;
		$result = array('product_lookup' => null,
						'xsell_items' => null,
						'product_check' => null,
						);
		if (XSELL_FORM_INPUT_TYPE == "model")
			$result['product_lookup'] = $db->Execute("select p.products_id from " . TABLE_PRODUCTS . " p " . 
									 "where p.products_model = '$pid' LIMIT 1");
		else
			$result['product_lookup'] = $db->Execute("select p.products_id from " . TABLE_PRODUCTS . " p " . 
									 "where p.products_id = '$pid' LIMIT 1");
			
									 
		if ($result['product_lookup']->RecordCount() > 0) {
			$result['product_check'] = $db->Execute(  "select p.products_id, p.products_model, pd.products_name, count(p.products_id) as xsells from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_XSELL . " px ".
												"where p.products_id = '" . $result['product_lookup']->fields['products_id'] . "' and pd.products_id = p.products_id and px.products_id = p.products_id group by p.products_id LIMIT 1");

			$result['xsell_items'] = $db->Execute("select p.products_id, p.products_model, pd.products_name, px.ID, px.sort_order from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_XSELL . " px " . 
											"where px.products_id = '" . $result['product_lookup']->fields['products_id'] . "' and p.products_id = px.xsell_id and  pd.products_id = p.products_id group by p.products_id");
											
		}
		else
			$messageStack->add(sprintf(CROSS_SELL_PRODUCT_NOT_FOUND, $pid), 'warning');
		
		return $result;		
	}

	function delete_cross_product($pid){
		global $db,$messageStack;
		$pid = zen_db_prepare_input($pid);
		$db->Execute('delete from '.TABLE_PRODUCTS_XSELL." where products_id= '$pid'");
		$messageStack->add(sprintf(CROSS_SELL_CLEANED_UP,mysql_affected_rows($db->link)),'success');
	}
	
	function list_all_cross_products(){
		global $db;
		return $db->Execute( "select p.products_id, p.products_model, pd.products_name, count(p.products_id) as xsells from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_XSELL . " px " . 
										"where p.products_id = pd.products_id and p.products_id = px.products_id group by p.products_id");
	}
	
	function clean_up_cross_sell(){
		global $db, $messageStack;
		$db->Execute('DELETE FROM '.TABLE_PRODUCTS_XSELL.' WHERE products_id NOT IN (SELECT products_id FROM '.TABLE_PRODUCTS.' WHERE 1=1)');
		$messageStack->add(sprintf(CROSS_SELL_CLEANED_UP,mysql_affected_rows($db->link)),'success');
	}
 }
?>