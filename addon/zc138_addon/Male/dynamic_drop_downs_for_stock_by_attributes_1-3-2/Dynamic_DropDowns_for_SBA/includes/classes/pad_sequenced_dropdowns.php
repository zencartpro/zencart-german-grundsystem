<?php
/*
      QT Pro Version 4.1
  
      pad_sequenced_dropdowns.php
  
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
          12/2004 - Fix _draw_dropdown_sequence_js to prevent js error when all attribute combinations
                    are out of stock
          03/2005 - Remove '&' for pass by reference from parameters to call of
                    _build_attributes_combinations.  Only needed on method definition and causes
                    error messages on some php versions/configurations
  
*******************************************************************************************
  
      QT Pro Product Attributes Display Plugin
  
      pad_sequenced_dropdowns.php - Display stocked product attributes first as one dropdown for each attribute
                                    with Javascript to force user to select attributes in sequence so only
                                    in-stock combinations are seen.
  
      Class Name: pad_sequenced_dropdowns
  
      This class generates the HTML to display product attributes.  First, product attributes that
      stock is tracked for are displayed, each attribute in its own dropdown list with Javascript to
      force user to select attributes in sequence so only in-stock combinations are seen.  Then
      attributes that stock is not tracked for are displayed, each attribute in its own dropdown list.
  
      Methods overidden or added:
  
        _draw_stocked_attributes            draw attributes that stock is tracked for
        _draw_dropdown_sequence_js          draw Javascript to force the attributes to be selected in
                                            sequence
        _SetConfigurationProperties         set local properties
                                            
*/
  require_once(DIR_WS_CLASSES . 'pad_multiple_dropdowns.php');

  class pad_sequenced_dropdowns extends pad_multiple_dropdowns {


/*
    Method: _draw_stocked_attributes
  
    draw dropdown lists for attributes that stock is tracked for

  
    Parameters:
  
      none
  
    Returns:
  
      string:         HTML to display dropdown lists for attributes that stock is tracked for
  
*/
    function _draw_stocked_attributes() {
      global $db;
      
      $out='';
      
      $attributes = $this->_build_attributes_array(true, false);
      if (sizeof($attributes)<=1) {
        return parent::_draw_stocked_attributes();
      }

      // Check stock
      $s=sizeof($attributes[0]['ovals']);
      for ($a=0; $a<$s; $a++) {
        $attribute_stock = $db->Execute("select quantity from " . TABLE_PRODUCTS_STOCK . " where products_id = '" . (int)$this->products_id . "' AND quantity > 0");
        $out_of_stock=(($attribute_stock->RecordCount())==0);
   
        if ($out_of_stock) {
          unset($attributes[0]['ovals'][$a]);
        }
      }

      // Draw first option dropdown with all values
      $out.='<tr><td align="right" class="main"><b>'.$attributes[0]['oname'].":</b></td><td class=\"main\">".zen_draw_pull_down_menu('id['.$attributes[0]['oid'].']',array_merge(array(array('id'=>0, 'text'=>'First select '.$attributes[0]['oname'])), $attributes[0]['ovals']),$attributes[0]['default'], "onchange=\"i".$attributes[0]['oid']."(this.form);\"")."</td></tr>\n";

      // Draw second to next to last option dropdowns - no values, with onchange
      for($o=1; $o<sizeof($attributes)-1; $o++) {
        $out.='<tr><td align="right" class="main"><b>'.$attributes[$o]['oname'].":</b></td><td class=\"main\">".zen_draw_pull_down_menu('id['.$attributes[$o]['oid'].']',array(array('id'=>0, 'text'=>'Next select '.$attributes[$o]['oname'])), '', "onchange=\"i".$attributes[$o]['oid']."(this.form);\"")."</td></tr>\n";
      }        

      // Draw last option dropdown - no values, no onchange      
      $out.='<tr><td align="right" class="main"><b>'.$attributes[$o]['oname'].":</b></td><td class=\"main\">".zen_draw_pull_down_menu('id['.$attributes[$o]['oid'].']',array(array('id'=>0, 'text'=>'Next select '.$attributes[$o]['oname'])), '')."</td></tr>\n";
      
      $out.=$this->_draw_dropdown_sequence_js($attributes);
      
      return $out;
    }


/*
    Method: _draw_dropdown_sequence_js
  
    draw Javascript to display out of stock message for out of stock attribute combinations

  
    Parameters:
  
      $attributes     array   Array of attributes for the product.  Format is as returned by
                              _build_attributes_array.
  
    Returns:
  
      string:         Javascript to force user to select stocked dropdowns in sequence
  
*/
    function _draw_dropdown_sequence_js($attributes) {
      $out='';
      $combinations = array();
      $selected_combination = 0;
      $this->_build_attributes_combinations($attributes, false, 'None', $combinations, $selected_combination);
      
      $out.="<tr><td colspan=\"2\">&nbsp;\n";
      
      $out.="<script type=\"text/javascript\" language=\"javascript\"><!--\n";
      // build javascript array of in stock combinations of the form
      // {optval1:{optval2:{optval3:1,optval3:1}, optval2:{optval3:1}}, optval1:{optval2:{optval3:1}}};
      $out.="  var stk=".$this->_draw_js_stock_array($combinations).";\n";

      // js arrays of possible option values/text for dropdowns
      // do all but the first attribute (its dropdown never changes)
      for ($curattr=1; $curattr<sizeof($attributes); $curattr++) {
        $attr = $attributes[$curattr];
        $out.="  var txt".$attr['oid']."={";
        foreach ($attr['ovals'] as $oval) {
          $out.=$oval['id'].":'".$oval['text']."',";
        }
        $out=substr($out,0,strlen($out)-1)."};";
        $out.="\n";
      }

      // js functions to set next dropdown options when a dropdown selection is made
      // do all but last attribute (nothing needs to happen when it changes)
      for ($curattr=0; $curattr<sizeof($attributes)-1; $curattr++) {
        $attr=$attributes[$curattr];
        $out.="  function i".$attr['oid']."(frm) {\n";
        $i=key($attributes);
        for ($i=$curattr+1; $i<sizeof($attributes); $i++) {
          $out.="    frm['id[".$attributes[$i]['oid']."]'].length=1;\n";
        }
        $out.="    for (opt in stk";
        for ($i=0; $i<=$curattr; $i++) {
          $out.="[frm['id[".$attributes[$i]['oid']."]'].value]";
        }
        $out.=") {\n";
        $out.="      frm['id[".$attributes[$curattr+1]['oid']."]'].options[frm['id[".$attributes[$curattr+1]['oid']."]'].length]=new Option(txt".$attributes[$curattr+1]['oid']."[opt],opt);\n";
        $out.="    }\n";
        $out.="  }\n";
      }

      // js to initialize dropdowns to defaults if product id contains attributes (i.e. clicked through to product page from cart)
      $out.="  i" . $attributes[0]['oid'] . "(document.cart_quantity);\n";
      for($o=1; $o<sizeof($attributes)-1; $o++) {
        if ($attributes[$o]['default']!='') {
          $out.="  document.cart_quantity['id[".$attributes[$o]['oid']."]'].value=".$attributes[$o]['default'].";\n";
          $out.="  i" . $attributes[$o]['oid'] . "(document.cart_quantity);\n";
        }
        else break;
      }
      if (($o == sizeof($attributes)-1) && ($attributes[$o]['default']!='')) {
        $out.="  document.cart_quantity['id[".$attributes[$o]['oid']."]'].value=".$attributes[$o]['default'].";\n";
      }
      
      // js to not allow add to cart if selections not made
      $out.="  function chksel() {\n";
      $out.="    var ok=true;\n";
      foreach ($attributes as $attr)
        $out.="    if (this['id[".$attr['oid']."]'].value==0) ok=false;\n";
      $out.="    if (!ok) alert('".TEXT_SELECT_OPTIONS."');\n";
      $out.="    return ok;\n";
      $out.="  }\n";
      $out.="  document.cart_quantity.onsubmit=chksel;\n";
      $out.="//--></script>\n";
      $out.="\n</td></tr>\n";
      
      return $out;
    }


/*
    Method: _SetConfigurationProperties
  
    Set local configuration properties
  
    Parameters:
  
      $prefix      sting     Prefix for the osCommerce DB constants
  
    Returns:
  
      nothing
  
*/
    function _SetConfigurationProperties($prefix) {

      // These properties are not used directly by this class 
      // They are set to match how this class displays for the case of a single
      // attribute where the parent class _draw_stocked_attributes method is called
      $this->show_out_of_stock    = 'False';
      $this->mark_out_of_stock    = 'Right';
      $this->out_of_stock_msgline = 'False';
      $this->no_add_out_of_stock  = 'True';

    }

  }
?>
