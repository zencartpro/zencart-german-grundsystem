<?php
// (c) D Parry (Chrome) 2009 (admin@chrome.me.uk)
// This module is free to distribute and use as long as the above copyright message is left in tact
class DPU {
	/**
	* Current Zen Cart database object
	*
	* @var object
	*/
	var $_db;
	/**
	* Local copy of the POST array
	*
	* @var array
	*/
	var $_post = array();
	/**
	* Local instantiation of the shopping cart
	*
	* @var object
	*/
	var $_shoppingCart;
	/**
	* The type of message being sent (error or success)
	*
	* @var string
	*/
	var $_responseType = 'success';
	/**
	* Array of lines to be sent back.  The key of the array provides the attribute to identify it at the client side
	* The array value is the text to be inserted into the node
	*
	* @var array
	*/
	var $_responseText = array();

	/**
	* Constructor
	*
	* @param obj The Zen Cart database class
	* @return DPU
	*/
	function __construct(&$db) {
		$this->_db =& $db;
		$this->_post =& $_POST;

		// grab the shopping cart class and instantiate it
		require_once(DIR_WS_CLASSES.'shopping_cart.php');
		$this->_shoppingCart = new shoppingCart();
	}

	/**
	* PHP4 constructor
	*
	* @param obj ZC DB object
	* @return DPU
	*/
	function DPU(&$db) {
		$this->__construct($db);
	}

	/**
	* Wrapper to call all methods to generate the output
	*
	* @return void
	*/
	function getDetails() {
		$this->insertProduct();
		$this->_shoppingCart->calculate();
        if (DPU_SHOW_SIDEBOX)   $this->getSideboxContent();

		$this->prepareOutput();
		$this->dumpOutput();
	}

	/**
	* Wrapper to call all methods relating to returning multiple prices for category pages etc.
	*
	* @return void
	*/
	function getMulti() {
		$this->insertProducts();
	}

	/**
	* Prepares the shoppingCart contents for transmission
	*
	* @return void
	*/
	function prepareOutput() {
		global $currencies;
		$this->_responseText['priceTotal'] = UPDATER_PREFIX_TEXT;
		$product_check = $this->_db->Execute("select products_tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . (int)$this->_post['products_id'] . "'" . " limit 1");
		if (false == DPU_SHOW_CURRENCY_SYMBOLS) {
			$this->_responseText['priceTotal'] .= number_format($this->_shoppingCart->total, 2);
		} else {
            #$this->_responseText['priceTotal'] .= $currencies->display_price($this->_shoppingCart->total, $product_check->fields['products_tax_class_id']);
			$this->_responseText['priceTotal'] .= $currencies->display_price($this->_shoppingCart->total, 0);
            
		}

		$this->_responseText['weight'] = (string)$this->_shoppingCart->weight;
		if (DPU_SHOW_QUANTITY) {
			$this->_responseText['quantity'] = sprintf(DPU_SHOW_QUANTITY_FRAME, $this->_shoppingCart->contents[$this->_post['products_id']]['qty']);
		}
	}

	/**
	* Inserts multiple non-attributed products into the shopping cart
	*
	* @return void
	*/
	function insertProducts() {
		foreach ($this->_post['products_id'] as $id => $qty) {
			$this->_shoppingCart->contents[] = array($id);
			$this->_shoppingCart->contents[$id] = array('qty' => (float)$qty);
		}

		var_dump($this->_shoppingCart);
		die();
	}

	/**
	* Inserts the product into the shoppingCart content array
	*
	* @returns void
	*/
	function insertProduct() {
      	$this->_shoppingCart->contents[$this->_post['products_id']] = array('qty' => (float)$this->_post['cart_quantity']);
      	$attributes = array();

      	foreach ($this->_post as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $k => $v) {
					$attributes[$k] = $v;
				}
			}
      	}

      	if (is_array($attributes)) {
        	reset($attributes);
        	while (list($option, $value) = each($attributes)) {
          		//CLR 020606 check if input was from text box.  If so, store additional attribute information
          		//CLR 020708 check if text input is blank, if so do not add to attribute lists
          		//CLR 030228 add htmlspecialchars processing.  This handles quotes and other special chars in the user input.
          		$attr_value = NULL;
          		$blank_value = FALSE;
          		if (strstr($option, TEXT_PREFIX)) {
            		if (trim($value) == NULL) {
              			$blank_value = TRUE;
            		} else {
              			$option = substr($option, strlen(TEXT_PREFIX));
				    	$attr_value = stripslashes($value);
				    	$value = PRODUCTS_OPTIONS_VALUES_TEXT_ID;
				      	$this->_shoppingCart->contents[$this->_post['products_id']]['attributes_values'][$option] = $attr_value;
            		}
          		}

          		if (!$blank_value) {
            		if (is_array($value) ) {
              			reset($value);
              			while (list($opt, $val) = each($value)) {
                			$this->_shoppingCart->contents[$this->_post['products_id']]['attributes'][$option.'_chk'.$val] = $val;
              			}
            		} else {
              			$this->_shoppingCart->contents[$this->_post['products_id']]['attributes'][$option] = $value;
            		}
          		}
	        }
	    }

    	// $this->_shoppingCart->cleanup();
	}
    
    /**
    * Prepares the output for the Updater's sidebox display
    * 
    */
    function getSideboxContent() {
        global $currencies;
        
        $product_check = $this->_db->Execute("select products_tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . (int)$this->_post['products_id'] . "'" . " limit 1");
        $product_query = "select products_id, products_price, products_tax_class_id, products_weight,
                          products_priced_by_attribute, product_is_always_free_shipping, products_discount_type, products_discount_type_from,
                          products_virtual, products_model
                          from " . TABLE_PRODUCTS . "
                          where products_id = '" . (int)$this->_post['products_id'] . "'";

        $product = $this->_db->Execute($product_query);
        $prid = $product->fields['products_id'];
        $products_tax = zen_get_tax_rate($product->fields['products_tax_class_id']);
        $products_price = $product->fields['products_price'];
        $qty = $this->_post['cart_quantity'];
        $out = array();
        $global_total;
        reset($this->_shoppingCart->contents[$this->_post['products_id']]['attributes']);
        while (list($option, $value) = each($this->_shoppingCart->contents[$this->_post['products_id']]['attributes'])) {
            $adjust_downloads ++;

            $attribute_price_query = "select *
                                      from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                      where products_id = '" . (int)$prid . "'
                                      and options_id = '" . (int)$option . "'
                                      and options_values_id = '" . (int)$value . "'";

            $attribute_price = $this->_db->Execute($attribute_price_query);
            
            $sql = "SELECT
                    `products_options_values_name`
                FROM
                    ".TABLE_PRODUCTS_OPTIONS_VALUES."
                WHERE
                    `products_options_values_id` = $value";
            $data = $this->_db->Execute($sql);
            $name = $data->fields['products_options_values_name'];

            $new_attributes_price = 0;
            $discount_type_id = '';
            $sale_maker_discount = '';
            $total = 0;

            if ($attribute_price->fields['product_attribute_is_free'] == '1' and zen_get_products_price_is_free((int)$prid)) {
                // no charge for attribute
            } else {
                // + or blank adds
                if ($attribute_price->fields['price_prefix'] == '-') {
                    // appears to confuse products priced by attributes
                    if ($product->fields['product_is_always_free_shipping'] == '1' or $product->fields['products_virtual'] == '1') {
                        $shipping_attributes_price = zen_get_discount_calc($product->fields['products_id'], $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
                        $this->free_shipping_price -= $qty * zen_add_tax( ($shipping_attributes_price), $products_tax);
                    }
                    if ($attribute_price->fields['attributes_discounted'] == '1') {
                        // calculate proper discount for attributes
                        $new_attributes_price = zen_get_discount_calc($product->fields['products_id'], $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
                        $total -= $qty * zen_add_tax( ($new_attributes_price), $products_tax);
                    } else {
                        $total -= $qty * zen_add_tax($attribute_price->fields['options_values_price'], $products_tax);
                    }
                    $total = '-'.$total;
                } else {
                    // appears to confuse products priced by attributes
                    if ($product->fields['product_is_always_free_shipping'] == '1' or $product->fields['products_virtual'] == '1') {
                        $shipping_attributes_price = zen_get_discount_calc($product->fields['products_id'], $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
                        $this->free_shipping_price += $qty * zen_add_tax( ($shipping_attributes_price), $products_tax);
                    }
                    if ($attribute_price->fields['attributes_discounted'] == '1') {
                        // calculate proper discount for attributes
                        $new_attributes_price = zen_get_discount_calc($product->fields['products_id'], $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
                        $total += $qty * zen_add_tax( ($new_attributes_price), $products_tax);
                        // echo $product->fields['products_id'].' - '.$attribute_price->fields['products_attributes_id'].' - '. $attribute_price->fields['options_values_price'].' - '.$qty."\n";
                    } else {
                        $total += $qty * zen_add_tax($attribute_price->fields['options_values_price'], $products_tax);
                    }
                }
            }
            $global_total += $total;
            $qty2 = sprintf(DPU_SIDEBOX_QUANTITY_FRAME, $this->_post['cart_quantity']);
            $total = sprintf(DPU_SIDEBOX_PRICE_FRAME, $currencies->display_price($total, $product_check->fields['products_tax_class_id']));
            $out[] = sprintf(DPU_SIDEBOX_FRAME, $name, $total, $qty2);
        }
        
        $out[] = sprintf(DPU_SIDEBOX_TOTAL_FRAME, $currencies->display_price($this->_shoppingCart->total, $product_check->fields['products_tax_class_id']));
        
        $qty2 = sprintf(DPU_SIDEBOX_QUANTITY_FRAME, $this->_post['cart_quantity']);
        $total = sprintf(DPU_SIDEBOX_PRICE_FRAME, $currencies->display_price($this->_shoppingCart->total-$global_total, $product_check->fields['products_tax_class_id']));
        array_unshift($out, sprintf(DPU_SIDEBOX_FRAME, 'Base price', $total, $qty2));
        
        $this->_responseText['sideboxContent'] = implode('', $out);
    }

	/**
	* Performs an error dump
	*
	* @param mixed $errorMsg
	*/
	function throwError($errorMsg) {
		$this->_responseType = 'error';
		$this->_responseText[] = $errorMsg;

		$this->dumpOutput();
	}

	/**
	* Formats the response and flushes with the appropriate headers
	* This should be called last as it issues an exit
	*
	* @return void
	*/
	function dumpOutput() {
		// output the header for XML
		header ("content-type: text/xml");
		// set the XML file DOCTYPE
		echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
		// set the responseType
		echo '<root>'."\n".'<responseType>'.$this->_responseType.'</responseType>'."\n";
		// now loop through the responseText nodes
		foreach ($this->_responseText as $key => $val) {
			echo '<responseText'.(!is_numeric($key) && !empty($key) ? ' type="'.$key.'"' : '').'><![CDATA['.$val.']]></responseText>'."\n";
		}

		die('</root>');
	}
}