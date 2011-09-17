<?php
// $Id: products_with_attributes_stock.php 514 2009-02-24 16:34:18Z hugo13 $

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
        
    /**
    * @desc displays the filtered product-rows
    */
    function displayFilteredRows(){
        global $db;
        if(isset($_SESSION['languages_id'])){ $language_id = $_SESSION['languages_id'];} else { $language_id=1;}
        if(isset($_GET['search']) && $_GET['search']){
            $s = zen_db_input($_GET['search']);
            $w = "(products.products_id = '$s' OR description.products_name LIKE '$s%' OR products.products_model LIKE '$s%') AND  " ;
            $_SESSION['searchfilter'] = $s;
        } else {
            $w = ''; 
            if(!isset($_GET['search'])){
                $s = $_SESSION['searchfilter'];
                $this->search = $s;
                $w = "(products.products_id = '$s' OR description.products_name LIKE '$s%' OR products.products_model LIKE '$s%') AND  " ;
            }
        }
    
    $html = '
    <table id="mainProductTable"> 
    <tr>
      <th>'.PWA_PRODUCT_ID.'</th>
      <th>'.PWA_PRODUCT_NAME.'</th>
      <th>'.PWA_PRODUCT_MODEL.'</th>            
      <th>'.PWA_QUANTITY_FOR_ALL_VARIANTS.'</th>
      <th>'.PWA_ADD_QUANTITY.'</th> 
      <th>'.PWA_SYNC_QUANTITY.'</th>
      </tr>
      ';
        
        
        
        $retArr = array();
        $query =    'select distinct attrib.products_id, description.products_name, products.products_quantity, products.products_model
                    FROM '.TABLE_PRODUCTS_ATTRIBUTES.' attrib, '.TABLE_PRODUCTS_DESCRIPTION.' description, '.TABLE_PRODUCTS.' products
                    WHERE attrib.products_id = description.products_id and
                    ' . $w . '
                    attrib.products_id = products.products_id and description.language_id='.$language_id.' order by description.products_name ';
        $products = $db->Execute($query);
        while(!$products->EOF){
            
            $html .= '<tr class="productRow">'."\n";
            $html .= '<td class="pwas">'.$products->fields['products_id'].'</td>';
            $html .= '<td>'.$products->fields['products_name'].'</td>';
            $html .= '<td>'.$products->fields['products_model'].'</td>';    
            $html .= '<td>'.$products->fields['products_quantity'].'</td>';
            $html .= '<td><a href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=add&amp;products_id=".$products->fields['products_id'], 'NONSSL').'">' . PWA_ADD_QUANTITY . '</a></td>';
            $html .= '<td><a href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=resync&amp;products_id=".$products->fields['products_id'], 'NONSSL').'">' . PWA_SYNC_QUANTITY . '</a></td>';
            $html .= '</tr>'."\n";
            
            // SUB            
            $query = 'select * from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id="'.$products->fields['products_id'].'"';

            $attribute_products = $db->Execute($query);
            if($attribute_products->RecordCount() > 0)
            {

                $html .= '<tr>'."\n";
                $html .= '<td colspan="6">'."\n";
                $html .= '<table class="stockAttributesTable">';
                $html .= '<tr>';
                $html .= '<th class="stockAttributesHeadingStockId">'.PWA_STOCK_ID.'</th><th class="stockAttributesHeadingVariant">'.PWA_VARIANT.'</th><th class="stockAttributesHeadingQuantity">'.PWA_QUANTITY_IN_STOCK.'</th><th class="stockAttributesHeadingEdit">'.PWA_EDIT.'</th><th class="stockAttributesHeadingDelete">'.PWA_DELETE.'</th>';
                $html .= '</tr>';

                while(!$attribute_products->EOF)
                {
                    $html .= '<tr id="sid-'. $attribute_products->fields['stock_id'] .'">';
                    $html .= '<td class="stockAttributesCellStockId">'."\n";
                    $html .= $attribute_products->fields['stock_id'];
                    $html .= '</td>'."\n";
                    $html .= '<td class="stockAttributesCellVariant">'."\n";

                    $attributes_of_stock = explode(',',$attribute_products->fields['stock_attributes']);
                    $attributes_output = array();
                    foreach($attributes_of_stock as $attri_id)
                    {
                        $stock_attribute = $this->get_attributes_name($attri_id, $_SESSION['languages_id']);
                        $attributes_output[] = '<strong>'.$stock_attribute['option'].':</strong> '.$stock_attribute['value'].'<br/>';
                    }
                    sort($attributes_output);
                    $html .= implode("\n",$attributes_output);

                    $html .= '</td>'."\n";
                    $html .= '<td class="stockAttributesCellQuantity" id="stockid-'. $attribute_products->fields['stock_id'] .'">'."\n";
                    $html .= $attribute_products->fields['quantity'];
                    $html .= '</td>'."\n";
                    $html .= '<td class="stockAttributesCellDelete">'."\n";
                    $html .= '<a href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=edit&amp;products_id=".$products->fields['products_id'].'&amp;attributes='.$attribute_products->fields['stock_attributes'].'&amp;q='.$attribute_products->fields['quantity'], 'NONSSL').'">'.PWA_EDIT_QUANTITY.'</a>'; //s_mack:prefill_quantity
                    $html .= '</td>'."\n";
                    $html .= '<td class="stockAttributesCellEdit">'."\n";
                    $html .= '<a href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=delete&amp;products_id=".$products->fields['products_id'].'&amp;attributes='.$attribute_products->fields['stock_attributes'], 'NONSSL').'">'.PWA_DELETE_VARIANT.'</a>';
                    $html .= '</td>'."\n";
                    $html .= '</tr>';

                    $attribute_products->MoveNext();
                }
                $html .= '</table>';
                $html .= '</td>'."\n";
                $html .= '</tr>'."\n";
            }
            $products->MoveNext();   
        }
        $html .= '</table>';
        $html .= '</form>'."\n";
        return '<div style="border:1px solid green; width:100%;">'.$html.'</div>';
        return $html;
    }
    function saveAttrib(){
        global $db;
        $sync = array();   
        $i = 0;
        foreach ($_POST as $key => $value) {
            $id = intval(str_replace('stockid-', '', $key));
            if($id > 0){
                $sql = "UPDATE products_with_attributes_stock SET quantity = '$value' WHERE products_with_attributes_stock.stock_id =$id LIMIT 1";
                $db->execute($sql);
                $sync[$id] = $id;  
                $i++;
            }
        }
        if($i > 0){
            $sql = 'SELECT DISTINCTROW products_id FROM ' . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . ' WHERE stock_id IN (' . implode(',', $sync) . ')';
            $ret = $db->Execute($sql);
            while (!$ret->EOF){
                $this->update_parent_products_stock($ret->fields['products_id']);
                $ret->MoveNext();
            }
        }
        $html = print_r($_POST, true);
        
        $html = "$i " . CATALOG_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS;
        return $html;  
    }
        
}

?>
