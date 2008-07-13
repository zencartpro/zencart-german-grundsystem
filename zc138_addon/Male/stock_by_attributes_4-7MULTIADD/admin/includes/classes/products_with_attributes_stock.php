<?php
	class products_with_attributes_stock
	{	
		function get_products_attributes($products_id, $languageId=1)
		{
			global $db;
		
			$query = '	select 
							patrib.products_attributes_id, patrib.options_values_price, patrib.price_prefix,
			 				popt.products_options_name, pval.products_options_values_name
			 			from '.TABLE_PRODUCTS_ATTRIBUTES.' as patrib, '.TABLE_PRODUCTS_OPTIONS.' as popt, '.TABLE_PRODUCTS_OPTIONS_VALUES.' as pval
			 			where
			 				patrib.products_id = "'.$products_id.'" AND patrib.options_id = popt.products_options_id
			 				AND popt.language_id = "'.$languageId.'" and popt.language_id = pval.language_id
							and patrib.options_values_id = pval.products_options_values_id';
			
			$attributes = $db->Execute($query);
			
			if($attributes->RecordCount()>0)
			{
				while(!$attributes->EOF)
				{
					$attributes_array[$attributes->fields['products_options_name']][] =
						array('id' => $attributes->fields['products_attributes_id'],
							  'text' => $attributes->fields['products_options_values_name']
							  			. ' (' . $attributes->fields['price_prefix']
										. '$'.zen_round($attributes->fields['options_values_price'],2) . ')' );
					$attributes->MoveNext();
				}
	
				return $attributes_array;
	
			}
			else
			{
				return false;
			}
		}
	
		function update_parent_products_stock($products_id)
		{
			global $db;

			$query = 'select sum(quantity) as quantity from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id = "'.(int)$products_id.'"';
			$quantity = $db->Execute($query);
			$query = 'update '.TABLE_PRODUCTS.' set  products_quantity="'.$quantity->fields['quantity'].'" where products_id="'.(int)$products_id.'"';
			$db->Execute($query);
		}
	
	
		function get_attributes_name($attribute_id, $languageId=1)
		{
			global $db;

			$query = 'select patrib.products_attributes_id, popt.products_options_name, pval.products_options_values_name
			 			from '.TABLE_PRODUCTS_ATTRIBUTES.' as patrib, '.TABLE_PRODUCTS_OPTIONS.' as popt, '.TABLE_PRODUCTS_OPTIONS_VALUES.' as pval
			 			where patrib.products_attributes_id = "'.$attribute_id.'"
							AND patrib.options_id = popt.products_options_id
			 				AND popt.language_id = "'.$languageId.'"
							and popt.language_id = pval.language_id
							and patrib.options_values_id = pval.products_options_values_id';
							
			$attributes = $db->Execute($query);
			if(!$attributes->EOF)
			{		
				$attributes_output = array('option' => $attributes->fields['products_options_name'],
										   'value' => $attributes->fields['products_options_values_name']);
				return $attributes_output;
			}
			else
			{
				return false;
			}
		}
	}

?>
