<?php
/*
      QT Pro Version 4.1
  
      pad_single_radioset.php
  
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
          03/2005 - Remove '&' for pass by reference from parameters to call of
                    _build_attributes_combinations.  Only needed on method definition and causes
                    error messages on some php versions/configurations
          
*******************************************************************************************
  
      QT Pro Product Attributes Display Plugin
  
      pad_single_radioset.php - Display stocked product attributes as a single radioset with entries
                                for each possible combination of attributes.
  
      Class Name: pad_single_radioset
  
      This class generates the HTML to display product attributes.  First, product attributes that
      stock is tracked for are displayed in a single radioset with entries for each possible
      combination of attributes..  Then attributes that stock is not tracked for are displayed,
      each attribute in its own dropdown list.
  
      Methods overidden or added:
  
        _draw_stocked_attributes             draw attributes that stock is tracked for
  
*/
  require_once(DIR_WS_CLASSES . 'pad_single_dropdown.php');

  class pad_single_radioset extends pad_single_dropdown {


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
        
        foreach ($combinations as $combindex => $comb) {
          $out.="<tr>\n";
          $out.='  <td align="right" class=main><b>'.$combname."</b></td>\n  <td class=main>";
          $out.=tep_draw_radio_field('attrcomb', $combinations[$combindex]['id'], ($combindex==$selected_combination)) . $comb['text'];
          $out.="</td>\n";
          $out.="</tr>\n";
          $combname='';
        }
      }
      
      $out.=$this->_draw_out_of_stock_message_js($attributes);
      
      return $out;
    }

  }
?>
