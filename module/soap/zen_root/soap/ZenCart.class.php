<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 rainer langheiter <rainer@langheiter.com>
*  All rights reserved
*  http://edv.langheiter.com  http://soap.zencart.hugo13.com
*
*  This script is part of the ZenCart project. The ZenCart project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
* 
*  $Id$       
* 
*  @desc the primary SOAP-class; you have also to change the wsdl-file; see soap.wsdl.change.php
* 
***************************************************************/
class ZenCart
{
    /**
    * so .......
     * @param int $products_id Input string
     * @return void
     * @internal soaprequires WrappedString LoginObject
     */
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    private function getLL($language_code='en'){
        $sql = "SELECT languages_id FROM " . TABLE_LANGUAGES . " WHERE code='$language_code'";
        $res = $this->db->execute($sql);
        if($res->recordCount()==0){
            return 1;
        } else {
            return $res->fields['languages_id'];
        }
    }
    
    private function getImageArray($products_image){
        $img['extension'] = substr($products_image, strrpos($products_image, '.'));
        $img['base'] = str_replace($img['extension'], '', $products_image);
        $img['smal'] = $products_image;
        $img['medium'] = $img['base'] . IMAGE_SUFFIX_MEDIUM . $img['extension'];
        $img['large'] = $img['base'] . IMAGE_SUFFIX_LARGE . $img['extension'];

        if (!file_exists(DIR_WS_IMAGES . 'medium/' . $img['medium'])) {
          $img['medium'] = DIR_WS_IMAGES . $products_image;
        } else {
          $img['medium'] = DIR_WS_IMAGES . 'medium/' . $img['medium'];
        }
        if (!file_exists(DIR_WS_IMAGES . 'large/' . $img['large'])) {
          if (!file_exists(DIR_WS_IMAGES . 'medium/' . $img['medium'])) {
            $img['large'] = DIR_WS_IMAGES . $products_image;
          } else {
            $img['large'] = DIR_WS_IMAGES . 'medium/' . $img['medium'];
          }
        } else {
          $img['large'] = DIR_WS_IMAGES . 'large/' . $img['large'];
        }   
        return $img; 
    }
    /**
     * @param int $products_id Input string
    * @param string $languages_id Input string  
     * @return ZenCartProduct returnstring
     * @internal soaprequires WrappedString LoginObject
     */
    public function getProduct($products_id, $languages='en'){
        
        $productX = new ZenCartProduct();
        
        $languages_id = $this->getLL($languages);
        $sql = "SELECT products.products_id, products_description.products_name, products_description.products_description, products.products_model, products.products_image, products.products_tax_class_id, tax_rates.tax_rate, products.products_price
                FROM (tax_rates INNER JOIN tax_class ON tax_rates.tax_class_id = tax_class.tax_class_id) INNER JOIN (products INNER JOIN products_description ON products.products_id = products_description.products_id) ON tax_class.tax_class_id = products.products_tax_class_id
                WHERE (((products.products_id)='$products_id') AND ((products_description.language_id)='$languages_id'))";
        $res = $this->db->execute($sql);
        $rc = $res->recordCount();
        if($rc < 1) {
            $productX->products_description = "!! NO RECORD FOUND FOR ID: <strong>$products_id</strong> !!";
        } else {
            foreach ($res->fields as $key => $value) {
                $productX->$key = $value;
            }
            
            $pp = HTTP_SERVER . DIR_WS_CATALOG ;
            
            
            $img = $this->getImageArray($productX->products_image);
            
            $productX->products_pic_smal = $pp . $img['smal'];
            $productX->products_pic_medium = $pp . $img['medium'];
            $productX->products_pic_large = $pp . $img['large'];
            $productX->products_price_format = htmlentities(zen_get_products_display_price($products_id));
            $productX->products_price_format .= '  SId:'.session_id();
        }
        return $productX;
    }
    /**
    * so .......
     * @param string $categories_id Input string
     * @param int $max_ds Input string
     * @param string $languages_id Input string  
     * @return ZenCartProduct[] returnstring
     * @internal soaprequires 
     */
    public function getProducts($categories_id, $max_ds, $languages='en'){
        $languages_id = $this->getLL($languages);
        $p = new products();
        $pla = array();
        $c = split(',', $categories_id);
        foreach ($c as $key => $value) {
            $plaT = zen_get_categories_products_list($value); // id-list
        }
        if($max_ds<1){
            $max_ds=1;
        }
        if(is_array($plaT)){
            foreach ($plaT as $key => $value) {
                $pla[$value] = $value;
                if(count($pla)>$max_ds){
                    break;
                }
            }
        }
        foreach ($pla as $key => $value) {
            $ret[] = $this->getProduct($value, $languages);
        }
        return ($ret);
    }
    
    /**
    * so .......
    * @param string $languages_id Input string  
     * @return ZenCartCategoriesList[] returnstring
     * @internal soaprequires 
     */
    public function getCategoriesList($languages='en'){
        $languages_id = $this->getLL($languages);
        $product = new ZenCartProduct();
        $sql = "SELECT categories.categories_id, categories_description.categories_name
                    FROM categories INNER JOIN categories_description ON categories.categories_id = categories_description.categories_id
                    WHERE (((categories_description.language_id)='$languages_id') AND categories_status=1)
                    ORDER BY categories_description.categories_name";
        $res = $this->db->execute($sql);
        while (!$res->EOF){
            $x = new ZenCartCategoriesList();
            $t = $res->fields;
            foreach ($t as $key => $value) {
                $x->$key = htmlentities($value);
            }
            $l[]=$x;
            $res->moveNext();
        }
        return $l;
    }
    /**
    * so .......
    * @param string $languages Input string  
     * @return string returnstring
     * @internal soaprequires 
     */
    public function getCategoriesListJSON ($languages='en'){
        #$x = new ZenCartCategoriesListJSON();
        return json_encode($this->getCategoriesList($languages));
    }
    
    /**
    * so .......
    * @param string $dataArray Input string  
     * @return int $error
     * @internal soaprequires 
     */
    public function saveGoogleMap($serialData){
        $dataArr = unserialize($serialData);
        
        $sql = "UPDATE `google` SET `name` = 'FiloSoFischX' WHERE `google`.`id` =19 LIMIT 1";
        $sql = "REPLACE INTO google (lat , lng , name , owner , link , address , nick , email , chdate , description, categories, country, town, serveraddress )
                    VALUES (:lat, :lng, :name, :owner, :link, :address, :nick, :email, NOW(), :description, :categories, :country, :town, :serveraddress)";
        foreach ($dataArr as $key => $value) {
            $sql = $this->db->bindVars($sql, ':'.$key, htmlentities($value), 'string');  
        }
        $ret = $this->db->execute($sql);
        return $sql;
    }
    
    /**
    * so .......
    * @param string $dataArray Input string  
     * @return int $error
     * @internal soaprequires 
     */
     public function intoShoppingCart($serialData){
     
     }
}
?>
