<?php
/*
      QT Pro Version 4.1
  
      pad_base.php
  
      Contribution extension to:
        osCommerce, Open Source E-Commerce Solutions
        http://www.oscommerce.com
     
      Copyright (c) 2004, 2005 Ralph Day
      Released under the GNU General Public License
  
      Based on prior works released under the GNU General Public License:
        QT Pro prior versions
          Ralph Day, October 2004
          Tom Wojcik aka TomThumb 2004/07/03 based on work by Michael Coffman aka coffman
          FREEZEHELL - 08/11/2003 freezehell@hotmail.com Copyright (c) 2003 IBWO
          Joseph Shain, January 2003
        osCommerce MS2
          Copyright (c) 2003 osCommerce
          
      Modifications made:
          11/2004 - Created
          12/2004 - Fix _draw_js_stock_array to prevent error when all attribute combinations are
                    out of stock.
  
*******************************************************************************************
  
      QT Pro Product Attributes Display Plugin
  
      pad_base.php - Base Class
  
      Class Name: pad_base
  
      This base class, although functional, is not intended to be installed and used
      directly.  It is extended by other classes to provide different display options
      for product attributes on the product information page (product_info.php).
  
  
      Methods:
  
        pad_base                            constructor
        _SetConfigurationProperties         set local properties from DB config constants
        draw                                draw the product attributes
        _draw_table_start                   draw start of the table to enclose the attributes display
        _draw_stocked_attributes            draw attributes that stock is tracked for
        _draw_nonstocked_attributes         draw attributes that stock is not tracked for
        _draw_table_end                     draw end of the table to enclose the attributes display
        _draw_js_stock_array                draw a Javascript array of in stock attribute combinations
        _build_attributes_array             build an array of the attributes for the product
        _build_attributes_combinations      build an array of the attribute combinations for the product
  
      Properties:
  
        products_id                         the product id for attribute display
        products_tax_class_id               the products tax class id
        show_out_of_stock                   show out of stock attributes flag
        mark_out_of_stock                   mark out of stock attributes flag
        out_of_stock_msgline                show out of stock message line flag
        no_add_out_of_stock                 prevent add to cart of out of stock attributes combinations
  
  
*/
  class pad_base {
    var $products_id;
    var $products_tax_class_id;
    var $show_out_of_stock;
    var $mark_out_of_stock;
    var $out_of_stock_msgline;
    var $no_add_out_of_stock;


/*
    Method: pad_base
  
    Class constructor
  
    Parameters:
  
      $products_id      integer     The product id of the product attributes are to be displayed for
  
    Returns:
  
      nothing
  
*/
    function pad_base($products_id=0) {

	global $db;
      $this->products_id  = $products_id;
      
      if ($this->products_id != 0) {
$tax_class_array = $db->Execute('SELECT products_tax_class_id, products_price /* AGF */
                                         FROM ' . TABLE_PRODUCTS . " 
                                         WHERE products_id = '" . (int)$products_id . "'");
       // $tax_class_array = zen_db_fetch_array($tax_class_query);
        $this->products_tax_class_id = $tax_class_array->fields['products_tax_class_id'];
$this->products_original_price = $tax_class_array->fields['products_price']; /* AGF */
      }
      
      $this->_SetConfigurationProperties('PRODINFO_ATTRIBUTE_');

    }


/*
    Method: _SetConfigurationProperties
  
    Set local configuration properties from osCommerce configuration DB constants
  
    Parameters:
  
      $prefix      sting     Prefix for the osCommerce DB constants
  
    Returns:
  
      nothing
  
*/
    function _SetConfigurationProperties($prefix) {

      $this->show_out_of_stock    = constant($prefix . 'SHOW_OUT_OF_STOCK');
      $this->mark_out_of_stock    = constant($prefix . 'MARK_OUT_OF_STOCK');
      $this->out_of_stock_msgline = constant($prefix . 'OUT_OF_STOCK_MSGLINE');
      $this->no_add_out_of_stock  = constant($prefix . 'NO_ADD_OUT_OF_STOCK');

    }


/*
    Method: draw
  
    Draws the product attributes.  This is the only method other than the constructor that is
    intended to be called by a user of this class.
  
    Attributes that stock is tracked for are grouped first and drawn with one dropdown list per
    attribute.  All attributes are drawn even if no stock is available for the attribute and no 
    indication is given that the attribute is out of stock.
  
    Attributes that stock is not tracked for are then drawn with one dropdown list per
    attribute.
  
    Parameters:
  
      none
  
    Returns:
  
      string:       HTML for displaying the product attributes
  
*/
    function draw() {

      $out=$this->_draw_table_start();

      $out.=$this->_draw_stocked_attributes();
      
      $out.=$this->_draw_nonstocked_attributes();
    
      $out.=$this->_draw_table_end();
      
      return $out;
      
    }


/*
    Method: _draw_table_start
  
    Draws the start of a table to wrap the product attributes display.
    Intended for class internal use only.
  
    Parameters:
  
      none
  
    Returns:
  
      string:       HTML for start of table
  
*/
    function _draw_table_start() {
      $out ='           <table border="0" cellspacing="0" cellpadding="2">';
      $out.='            <tr>';
      $out.='             <td class="main" colspan="2"><b>' . TEXT_PRODUCT_OPTIONS . '</b></td>';
      $out.='            </tr>';
      return $out;
    }


/*
    Method: _draw_stocked_attributes
  
    Draws the product attributes that stock is tracked for.
    Intended for class internal use only.
  
    Attributes that stock is tracked for are drawn with one dropdown list per attribute.
    All attributes are drawn even if no stock is available for the attribute and no 
    indication is given that the attribute is out of stock.
  
    Parameters:
  
      none
  
    Returns:
  
      string:       HTML for displaying the product attributes that stock is tracked for
  
*/
    function _draw_stocked_attributes() {
      $out = '';
    
      $attributes = $this->_build_attributes_array(true, false);
      if (sizeof($attributes)>0) {
        foreach ($attributes as $stocked) {
          $out .= '<tr><td align="right" class=main><b>' . $stocked['oname'] . ":</b></td><td class=main>" . zen_draw_pull_down_menu('id['.$stocked['oid'].']',array_values($stocked['ovals']),$stocked['default']) . "</td></tr>\n";
        }
      }
      return $out;
    }


/*
    Method: _draw_nonstocked_attributes
  
    Draws the product attributes that stock is not tracked for.
    Intended for class internal use only.
  
    Attributes that stock is not tracked for are drawn with one dropdown list per attribute.
  
    Parameters:
  
      none
  
    Returns:
  
      string:       HTML for displaying the product attributes that stock is not tracked for
  
*/
    function _draw_nonstocked_attributes() {
      $out='';
      $nonstocked_attributes = $this->_build_attributes_array(false, true);
      foreach($nonstocked_attributes as $nonstocked)
      {
        $out.='<tr><td align="right" class=main><b>'.$nonstocked['oname'].":</b></td><td class=main>".zen_draw_pull_down_menu('id['.$nonstocked['oid'].']',$nonstocked['ovals'],$nonstocked['default'])."</td></tr>\n";
      }
      return $out;
    }


/*
    Method: _draw_table_end
  
    Draws the end of a table to wrap the product attributes display.
    Intended for class internal use only.
  
    Parameters:
  
      none
  
    Returns:
  
      string:       HTML for end of table
  
*/
    function _draw_table_end() {
      return '           </table>';
    }


/*
    Method: _build_attributes_array
  
    Build an array of the attributes for the product
  
    Parameters:
  
      $build_stocked        boolean   Flag indicating if stocked attributes should be built.
      $build_nonstocked     boolean   Flag indicating if non-stocked attribute should be built.
  
    Returns:
  
      array:                Array of attributes for the product of the form:
                              'oid'       => integer: products_options_id
                              'oname'     => string:  products_options_name
                              'ovals'     => array:   option values for the option id of the form
                                             'id'    => integer:  products_options_values_id
                                             'text'  => string:   products_options_values_name
                              'default'   => integer: products_options_values_id that the product id
                                                      contains for this option id and should be the
                                                      default selection when this attribute is drawn.
                                                      Set to zero if the product id did not contain
                                                      this option. 
  
*/
    function _build_attributes_array($build_stocked, $build_nonstocked) {
      global $languages_id;
      global $currencies;
      global $cart;
      global $db;
    
      if (!($build_stocked | $build_nonstocked)) return null;
      
      if ($build_stocked && $build_nonstocked) {
        $stocked_where='';
      }
      elseif ($build_stocked) {
        $stocked_where="and popt.products_options_track_stock = '1'";
      }
      elseif ($build_nonstocked) {
        $stocked_where="and popt.products_options_track_stock = '0'";
      }
      
      $products_options_name = $db->Execute("select distinct popt.products_options_id, popt.products_options_name, popt.products_options_track_stock from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$this->products_id . "' and patrib.options_id = popt.products_options_id and popt.language_id =". (int)$_SESSION['languages_id'] ." " . $stocked_where . " order by popt.products_options_id");
      $attributes=array();
		
      while (!$products_options_name->EOF) {
        $products_options_array = array();
        $products_options = $db->Execute("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$this->products_id . "' and pa.options_id = '" . (int)$products_options_name->fields['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = ". (int)$_SESSION['languages_id'] ." order by pa.products_options_sort_order");
   
    
        while (!$products_options->EOF) {

/**** AGF - add logic to format colours ******/
$value_name = $products_options->fields['products_options_values_name'] ;

//if ( $products_options_name['products_options_name'] = 'Color' ) {
// $value_name="<span class=\"col" . $value_name . "\">" . $value_name . "</span>";
//}
$products_options_array[] = array('id' => $products_options->fields['products_options_values_id'], 'text' => $value_name);

/**** AGF - end of new logic ******/

// AGF commented out +/- amount to show actual price
if ($products_options->fields['options_values_price'] != '0') {
$products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options->fields['price_prefix'] . $currencies->display_price($products_options->fields['options_values_price'], zen_get_tax_rate($this->products_tax_class_id)) .')';
}

/// Start of Changes- display actual prices instead of +/- Actual Price Pull Down v1.2.3a
$new_price ? $original_price = $new_price : $original_price = $this->products_original_price; //// check if set special price note $this variable

$option_price = $products_options->fields['options_values_price'];
if ($products_options->fields['price_prefix'] == "-") // in case price lowers, don't add values, subtract.
{
$show_price = 0.0 + $original_price - $option_price; // force float (in case) using the 0.0;
} else {
$show_price = 0.0 + $original_price + $option_price; // force float (in case) using the 0.0;
          }
 //  if ($products_options['options_values_price'] != '0') 
{
$products_options_array[sizeof($products_options_array)-1]['text'] .= ' '; // note $this variable //HW: THIS WAS BROKEN - tax class ID was being used as the tax rate.. so a fixed 8 percent in my case.
 }
// End Of MOD 

  $products_options->MoveNext();      
        }
        if (isset($cart->contents[$this->products_id]['attributes'][$products_options_name->fields['products_options_id']]))
          $selected = $cart->contents[$this->products_id]['attributes'][$products_options_name->fields['products_options_id']];
        else 
          $selected = 0;
        $attributes[]=array('oid'=>$products_options_name->fields['products_options_id'],
                            'oname'=>$products_options_name->fields['products_options_name'],
                            'ovals'=>$products_options_array,
                            'default'=>$selected);
      $products_options_name->MoveNext();
      }
      
      return $attributes;

   
      
    }


/*
    Method: _build_attributes_combinations
  
    A recursive method for building an array enumerating the attribute combinations for the product
  
    Parameters:
  
      $attributes             array     An array of the attributes that combinations will be built for.
                                        Format is as returned by _build_attributes_array.
      $showoos                boolean   Flag indicating if non-stocked attributes should be built.
      $markoos                string    'Left' if out of stock indication is to be appended in front of the
                                        attribute combination text.  'Right' if out of stock indication is
                                        to be appended at the end of the attribute combination text.
      $combinations           array     Array of the attribute combinations is returned in this parameter.
                                        Should be set to an empty array before an external call to this method. 
                                          'comb'        => array:   array of a single attribute combination
                                                                      options_id => options_value_id
                                          'id'          => string:  options/values string for this 
                                                                    combination in the form for the
                                                                    key of the products_stock table
                                                                      opt_id-val_id,opt_id-val_id,...
                                          'text'        => string:  Text for this combination.  Values text
                                                                    is as built by _build_attributes_array
                                                                     and contains the add/subtract price for
                                                                     the option value if applicable.  Form is:
                                                                       values_text, values_text
      $selected_combination   integer   Index into the $combinations array of the combination that should
                                        be the default selection when the combination is drawn is returned in
                                        this parameter.  Determined from product id.  Should be set to zero
                                        before an external call to this method.
  
    Parameters for internal recursion use only:
  
      $oidindex               integer   Index into the $attributes array of the option to operate on.
      $comb                   array     Array containing option id/values of combination built so far
                                          products_options_id => products_options_value_id
      $id                     string    Contains string of options/values built so far
      $text                   string    Text for the options values constructed so far.
      $isselected             boolean   Flag indicating if so far all option values in this combination
                                        were indicated to be defaults in the product id.
      
  
    Returns:
  
      see $combinations and $selected_combination parameters above
      no actual function return value.
  
*/
    function _build_attributes_combinations($attributes, $showoos, $markoos, &$combinations, &$selected_combination, $oidindex=0, $comb=array(), $id="", $text='', $isselected=true) {
      global $cart;
    
      foreach ($attributes[$oidindex]['ovals'] as $attrib) {
        $newcomb = $comb;
        $newcomb[$attributes[$oidindex]['oid']] = $attrib['id'];
        $newid=$id.','.$attributes[$oidindex]['oid'].'-'.$attrib['id'];
        $newtext = $text.", ".$attrib['text'];
        if (isset($cart->contents[$this->products_id]['attributes'][$attributes[$oidindex]['oid']]))
          $newisselected = ($cart->contents[$this->products_id]['attributes'][$attributes[$oidindex]['oid']] == $attrib['id']) ? $isselected : false;
        else 
          $newisselected = false;
        if (isset($attributes[$oidindex+1])) {
          $this->_build_attributes_combinations($attributes, $showoos, $markoos, $combinations, $selected_combination, $oidindex+1, $newcomb, $newid, $newtext, $newisselected);
        }
        else {
          $is_out_of_stock=zen_check_stock(zen_get_prid($this->products_id),1,$newcomb);
          if (!$is_out_of_stock | ($showoos == true)) {
            switch ($markoos) {
              case 'Left':   $newtext=($is_out_of_stock ? TEXT_OUT_OF_STOCK.' - ' : '').substr($newtext,2);
                             break;
              case 'Right':  $newtext=substr($newtext,2).($is_out_of_stock ? ' - '.TEXT_OUT_OF_STOCK : '');
                             break;
              default:       $newtext=substr($newtext,2);
                             break;
            }
            $combinations[] = array('comb'=>$newcomb, 'id'=>substr($newid,1), 'text'=>$newtext);
            if ($newisselected) $selected_combination = sizeof($combinations)-1;
          }
        }
      }
    }


/*
    Method: _draw_js_stock_array
  
    Draw a Javascript array containing the given attribute combinations.
    Generally used to draw array of in-stock combinations for Javascript out of stock
    validation and messaging.
  
    Parameters:
  
      $combinations        array   Array of combinations to build the Javascript array for.
                                   Array must be of the form returned by _build_attributes_combinations
                                   Usually this array only contains in-stock combinations.
  
    Returns:
  
      string:                 Javacript array definition.  Excludes the "var xxx=" and terminating ";".  Form is:
                              {optval1:{optval2:{optval3:1,optval3:1}, optval2:{optval3:1}}, optval1:{optval2:{optval3:1}}}
                              For example if there are 3 options and the instock value combinations are:
                                opt1   opt2   opt3
                                  1      5      4
                                  1      5      8
                                  1     10      4
                                  3      5      8
                              The string returned would be
                                {1:{5:{4:1,8:1}, 10:{4:1}}, 3:{5:{8:1}}}
  
*/
    function _draw_js_stock_array($combinations) {
      if (!((isset($combinations)) && (is_array($combinations)) && (sizeof($combinations) > 0))){
        return '{}';
      }
      $out='';
      foreach ($combinations[0]['comb'] as $oid=>$ovid) {
        $out.='{'.$ovid.':';
        $opts[]=$oid;
      }
      $out.='1';
      
      for ($combindex=1; $combindex<sizeof($combinations); $combindex++) {
        $comb=$combinations[$combindex]['comb'];
        for ($i=0; $i<sizeof($opts)-1; $i++) {
          if ($comb[$opts[$i]]!=$combinations[$combindex-1]['comb'][$opts[$i]]) break;
        }
        $out.=str_repeat('}',sizeof($opts)-1-$i).',';
        if ($i<sizeof($opts)-1) {
          for ($j=$i; $j<sizeof($opts)-1; $j++)
            $out.=$comb[$opts[$j]].':{';
        }
        $out.=$comb[$opts[sizeof($opts)-1]].':1';
      }
      $out.=str_repeat('}',sizeof($opts));
      
      return $out;
    }

  }
?>
