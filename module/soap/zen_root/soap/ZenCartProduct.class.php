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
* $Id$       
***************************************************************/

class ZenCartProduct{
	/** @var int */
	public $products_id;
	
	/** @var string */
	public $products_name;

	/** @var string */
	public $products_description;

    /** @var string */
    public $products_model;
    
    /** @var string */
    public $products_pic_smal;
    
    /** @var string */
    public $products_pic_medium;
    
    /** @var string */
    public $products_pic_large;
    
    /** @var string */
    public $products_price;
    
    /** @var float */
    public $tax_rate;
    
    /** @var string */
    public $products_image;    
    
    /** @var string */
    public $products_price_format;
	
	/**
	  * saves a contact
	  * @param ZenCartProduct
	  * @return void
	  */
	public function save($prod) {
		//save contact 2 db
	}
}
?>
