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
    
    function update_all_parent_products_stock() {
      global $db;
      $products_array = $this->get_products_with_attributes();
      foreach ($products_array as $products_id) {
        $query = 'select sum(quantity) as quantity from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id = "'.(int)$products_id.'"';
        $quantity = $db->Execute($query);
        $query = 'update '.TABLE_PRODUCTS.' set  products_quantity="'.$quantity->fields['quantity'].'" where products_id="'.(int)$products_id.'"';
        $db->Execute($query);
      }
    }
    
    // returns an array of product ids which contain attributes
    function get_products_with_attributes() {
      global $db;
      if(isset($_SESSION['languages_id'])){ $language_id = (int)$_SESSION['languages_id'];} else { $language_id=1;}
      $query = 'SELECT DISTINCT attrib.products_id, description.products_name, products.products_quantity, products.products_model, products.products_image
                FROM '.TABLE_PRODUCTS_ATTRIBUTES.' attrib, '.TABLE_PRODUCTS_DESCRIPTION.' description, '.TABLE_PRODUCTS.' products
                WHERE attrib.products_id = description.products_id AND
                      attrib.products_id = products.products_id AND 
                      description.language_id='.$language_id.' 
                ORDER BY description.products_name ';
      $products = $db->Execute($query);
      while(!$products->EOF){
        $products_array[] = $products->fields['products_id'];
        $products->MoveNext();
      }
      return $products_array;
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
            $w = "(products.products_id = '$s' OR description.products_name LIKE '%$s%' OR products.products_model LIKE '%$s%') AND  " ;
        } else {
            $w = ''; 
            $s = '';
        }    
    $html = zen_draw_form('stock_update', FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK . '_ajax', 'save=1', 'post', 'NONSSL');
    $html .= zen_image_submit('button_save.gif', IMAGE_SAVE);
    $html .= '
    <table id="mainProductTable"> 
    <tr>
      <th class="thProdId">'.PWA_PRODUCT_ID.'</th>
      <th class="thProdName">'.PWA_PRODUCT_NAME.'</th>';
    if (STOCK_SHOW_IMAGE == 'true') $html .= '<th class="thProdImage">'.PWA_PRODUCT_IMAGE.'</th>';   
    $html .= '  
      <th class="thProdModel">'.PWA_PRODUCT_MODEL.'</th>            
      <th class="thProdQty">'.PWA_QUANTITY_FOR_ALL_VARIANTS.'</th>
      <th class="thProdAdd">'.PWA_ADD_QUANTITY.'</th> 
      <th class="thProdSync">'.PWA_SYNC_QUANTITY.'</th>
      </tr>
      ';
        
        
        
        $retArr = array();
        $query =    'select distinct attrib.products_id, description.products_name, products.products_quantity, products.products_model, products.products_image
                    FROM '.TABLE_PRODUCTS_ATTRIBUTES.' attrib, '.TABLE_PRODUCTS_DESCRIPTION.' description, '.TABLE_PRODUCTS.' products
                    WHERE attrib.products_id = description.products_id and
                    ' . $w . '
                    attrib.products_id = products.products_id and description.language_id='.$language_id.' order by description.products_name ';
        $products = $db->Execute($query);
        while(!$products->EOF){ 
			    $html .= '<tr>'."\n";
			    $html .= '<td colspan="7">'."\n";
			    $html .= '<div class="productGroup">'."\n";
			    $html .= '<table width="100%">'."\n";
          $html .= '<tr class="productRow">'."\n";
          $html .= '<td class="tdProdId" class="pwas">'.$products->fields['products_id'].'</td>';
          $html .= '<td class="tdProdName">'.$products->fields['products_name'].'</td>';
          if (STOCK_SHOW_IMAGE == 'true') $html .= '<td class="tdProdImage">'.zen_info_image($products->fields['products_image'], $products->fields['products_name'], "60", "60").'</td>';
          $html .= '<td class="tdProdModel">'.$products->fields['products_model'].'</td>';    
          $html .= '<td class="tdProdQty">'.$products->fields['products_quantity'].'</td>';
          $html .= '<td class="tdProdAdd"><a href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=add&amp;products_id=".$products->fields['products_id'], 'NONSSL').'">' . PWA_ADD_QUANTITY . '</a></td>';
          $html .= '<td class="tdProdSync"><a href="'.zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, "action=resync&amp;products_id=".$products->fields['products_id'], 'NONSSL').'">' . PWA_SYNC_QUANTITY . '</a></td>';
          $html .= '</tr>'."\n";
          $html .= '</table>'."\n";
          // SUB            
          $query = 'select * from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id="'.$products->fields['products_id'].'"
                    order by sort ASC;';

          $attribute_products = $db->Execute($query);
          if($attribute_products->RecordCount() > 0)
          {

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
                      if ($stock_attribute['option'] == '' && $stock_attribute['value'] == '') {
                        // delete stock attribute
                        $db->Execute("DELETE FROM " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " WHERE stock_id = " . $attribute_products->fields['stock_id'] . " LIMIT 1;");
                      } else { 
                        $attributes_output[] = '<strong>'.$stock_attribute['option'].':</strong> '.$stock_attribute['value'].'<br/>';
                      }
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
                  $html .= '</div>';
                  $html .= '</td>'."\n";
                  $html .= '</tr>'."\n";
                 

                  $attribute_products->MoveNext();
              }
              $html .= '</table>';
          }
          $products->MoveNext();   
      }
      $html .= '</table>';
      $html .= zen_image_submit('button_save.gif', IMAGE_SAVE);
      $html .= '</form>'."\n";
      return $html;
    }
    function saveAttrib(){
        global $db;
        $i = 0;
        foreach ($_POST as $key => $value) {
            $id = intval(str_replace('stockid-', '', $key));
            if($id > 0){
                $sql = "UPDATE products_with_attributes_stock SET quantity = '$value' WHERE products_with_attributes_stock.stock_id =$id LIMIT 1";
                $db->execute($sql);
                $i++;
            }
        }
        $html = print_r($_POST, true);
        $html = "$i DS SAVED";
        return $html;  
    }
              
}

?>