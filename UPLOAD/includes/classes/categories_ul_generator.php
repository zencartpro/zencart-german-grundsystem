<?php
/**

 * @package classes
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: categories_ul_generator.php 2018-06-14 15:13:16Z webchills $
 */


class zen_categories_ul_generator {
    var $root_category_id = 0,
    $max_level = 0,
    $data = array(),
    $parent_group_start_string = '<ul%s>',
    $parent_group_end_string = '</ul>',
    $child_start_string = '<li%s>',
    $child_end_string = '</li>',
    $spacer_string = '
',
    $spacer_multiplier = 1;
    
    var $document_types_list = ' (3) ';
    // acceptable format example: ' (3, 4, 9, 22, 18) '
    
    function __construct($load_from_database = true)
    {
        global $languages_id, $db;
        $this->data = array();
        $categories_query = "select c.categories_id, cd.categories_name, c.parent_id
										from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
										where c.categories_id = cd.categories_id
										and c.categories_status=1 " .
        								" and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' " .
        								" order by c.parent_id, c.sort_order, cd.categories_name";
        $categories = $db->Execute($categories_query);
        while (!$categories->EOF) {
            $this->data[$categories->fields['parent_id']][$categories->fields['categories_id']] = array('name' => $categories->fields['categories_name'], 'count' => 0);
            $categories->MoveNext();
        }
    }
    
    function buildBranch($parent_id, $level = 0, $submenu=true, $parent_link='')
    {
        $result = sprintf($this->parent_group_start_string, ($submenu==true) ? ' class="level'. ((float)$level+1) . '"' : '' ); 
        
        if (($this->data[$parent_id])) {
            foreach($this->data[$parent_id] as $category_id => $category) {
                $category_link = $parent_link . $category_id;
                if (($this->data[$category_id])) {
                    $result .= sprintf($this->child_start_string, ($submenu==true) ? ' class="submenu"' : '');
                } else {
                    $result .= sprintf($this->child_start_string, '');
                }
                $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * 1) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '">';
                $result .= $category['name'];
                $result .= '</a>';
				  
                if (($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
                    $result .= $this->buildBranch($category_id, ((float)$level+1), $submenu, $category_link . '_');
                }
                $result .= $this->child_end_string;
            }
        }
        
        $result .= $this->parent_group_end_string;
        return $result;
    }
    
    function buildTree($submenu=false)
    {
        return $this->buildBranch($this->root_category_id, '', $submenu);
    }
}
