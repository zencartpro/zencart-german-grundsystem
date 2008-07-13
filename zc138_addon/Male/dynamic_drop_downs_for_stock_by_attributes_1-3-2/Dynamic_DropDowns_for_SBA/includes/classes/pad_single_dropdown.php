<?php
/*
      QT Pro Version 4.1
  
      pad_single_dropdown.php
  
      Contribution extension to:
        osCommerce, Open Source E-Commerce Solutions
        http://www.oscommerce.com
     
      Copyright (c) 2004, 2005 Ralph Day
      Released under the GNU General Public License
  
      Based on prior works released under the GNU General Public License:
        QT Pro & CPIL prior versions
          Ralph Day, October 2004
          Tom Wojcik aka TomThumb 2004/07/03 based on work by Michael Coffman aka coffman
          FREEZEHELL - 08/11/2003 freezehell@hotmail.com Copyright (c) 2003 IBWO
          Joseph Shain, January 2003
        osCommerce MS2
          Copyright (c) 2003 osCommerce
          
      Modifications made:
          11/2004 - Created
          12/2004 - Fix _draw_out_of_stock_message_js to add semicolon to end of js stock array
          03/2005 - Remove '&' for pass by reference from parameters to call of
                    _build_attributes_combinations.  Only needed on method definition and causes
                    error messages on some php versions/configurations
  
*******************************************************************************************
  
      QT Pro Product Attributes Display Plugin
  
      pad_single_dropdown.php - Display stocked product attributes as a single dropdown with entries
                                for each possible combination of attributes.
  
      Class Name: pad_single_dropdown
  
      This class generates the HTML to display product attributes.  First, product attributes that
      stock is tracked for are displayed in a single dropdown list with entries for each possible
      combination of attributes..  Then attributes that stock is not tracked for are displayed,
      each attribute in its own dropdown list.
  
      Methods overidden or added:
  
        _draw_stocked_attributes            draw attributes that stock is tracked for
        _draw_out_of_stock_message_js       draw Javascript to display out of stock message for out of
                                            stock attribute combinations
  
*/
  require_once(DIR_WS_CLASSES . 'pad_base.php');

  class pad_single_dropdown extends pad_base {


/*
    Method: _draw_stocked_attributes
  
    draw dropdown lists for attributes that stock is tracked for

  
    Parameters:
  
      none
  
    Returns:
  
      string:         HTML to display dropdown lists for attributes that stock is tracked for
  
*/
    function _draw_stocked_attributes() {
      global $languages_id;
      
      $out='';
      
      $attributes = $this->_build_attributes_array(true, false);
      if (sizeof($attributes)>0) {
        $combinations = array();
        $selected_combination = 0;
        $this->_build_attributes_combinations($attributes, $this->show_out_of_stock == 'True', $this->mark_out_of_stock, $combinations, $selected_combination);
        
        $combname='';
        foreach ($attributes as $attrib) {
          $combname.=', '.$attrib['oname'];
        }
        $combname=substr($combname,2).':';
        
        $out.="<tr>\n";
        $out.='  <td align="right" class="main"><b>'.$combname."</b></td>\n  <td class=\"main\">";
        $out.=zen_draw_pull_down_menu('attrcomb', $combinations, $combinations[$selected_combination]['id']);
        $out.="</td>\n";
        $out.="</tr>\n";
      }
      
      $out.=$this->_draw_out_of_stock_message_js($attributes);
      
      return $out;
    }


/*
    Method: _draw_out_of_stock_message_js
  
    draw Javascript to display out of stock popup message if an attempt is made to add an out of
    stock attribute combination to the cart

  
    Parameters:
  
      $attributes     array   Array of attributes for the product.  Format is as returned by
                              _build_attributes_array.
  
    Returns:
  
      string:         Javascript to display out of stock message for out of stock attribute combinations
  
*/
    function _draw_out_of_stock_message_js($attributes) {
      $out='';
      $out.="<tr><td>&nbsp;</td><td>&nbsp;\n";
  
      if (($this->show_out_of_stock == 'True') && ($this->no_add_out_of_stock == 'True')) {
        $out.="<script type=\"text/javascript\" language=\"javascript\"><!--\n";
        $combinations = array();
        $selected_combination = 0;
        $this->_build_attributes_combinations($attributes, false, 'None', $combinations, $selected_combination);
        
        $out.="  function chkstk(frm) {\n";
      
        // build javascript array of in stock combinations of the form
        // {optval1:{optval2:{optval3:1,optval3:1}, optval2:{optval3:1}}, optval1:{optval2:{optval3:1}}};
        $out.="    var stk=".$this->_draw_js_stock_array($combinations).";\n";
        $out.="    var instk=false;\n";
      
        // build javascript to extract attribute values and check stock  
        $out.="    if (frm.attrcomb.type=='select-one') {\n";
        $out.="      var attrs=frm.attrcomb.value.split(',');\n";
        $out.="    }\n";
        $out.="    else {\n";
        $out.="      for (i=0; i,frm.attrcomb.length; i++) {\n";
        $out.="        if (frm.attrcomb[i].checked) {\n";
        $out.="          var attrs=frm.attrcomb[i].value.split(',');\n";
        $out.="          break;\n";
        $out.="        }\n";
        $out.="      }\n";
        $out.="    }\n";
        $out.="    var id=Array(" . sizeof($attributes) . ");\n";
        $out.="    for (i=0; i<attrs.length; i++) {\n";
        $out.="      id[i]=attrs[i].split('-')[1];\n";
        $out.="    }\n";
        $out.='    ';
        for ($i=0; $i<sizeof($attributes); $i++) {
          $out.='if (stk';
          for ($j=0; $j<=$i; $j++) {
            $out.="[id[".$j."]]";
          }
          $out.=') ';
        }
        
        $out.="instk=true;\n";
        $out.="  return instk;\n";
        $out.="  }\n";

        if ($this->no_add_out_of_stock == 'True') {
          // js to not allow add to cart if selection is out of stock
          $out.="  function chksel() {\n";
          $out.="    var instk=chkstk(document.cart_quantity);\n";
          $out.="    if (!instk) alert('".TEXT_OUT_OF_STOCK_MESSAGE."');\n";
          $out.="    return instk;\n";
          $out.="  }\n";
          $out.="  document.cart_quantity.onsubmit=chksel;\n";
        }
        $out.="//--></script>\n";
      }
      $out.="</td></tr>\n";
      
      return $out;
    }

  }
?>
