<?php
/**
 * @package TPP
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * example: <!--%WordPress%--><!--###getWPTag###-->
 * first part == name of tab ( <!--%WordPress%--> )
 * second part == name of called function; param: products_id  ( <!--###getWPTag###--> )
 */

define ('ABSPATH','/var/www/zc138/wordpress/');   // abs-path to wp
if (file_exists(ABSPATH.'wp-config.php')) {
    require_once(ABSPATH.'wp-config.php');
    $wpinstall = true;
}
 

class rlWP {
    public $wpinstall;
    private $tag;
    
    function __construct(){
        $this->wpinstall = false;
        if (file_exists(ABSPATH.'wp-config.php')) {
            $this->wpinstall = true;
            require_once(ABSPATH.'wp-config.php');
        }
    }
    
    public function getWPTag($tag = 'zen-cart'){
        $content = '';
        $this->tag = $tag;
        if($this->wpinstall == true) {
            $lastposts = get_posts('tag=' . $this->tag);
            if(empty($lastposts)){
                 $content = 'NIX gefunden';
             } else {
                 foreach ($lastposts as $post) {
                    $content .= '<div style="padding:4px; border: 1px solid green;"><h3>' . $post->post_title . '</h3><p>' . $post->post_content . '</p></div>';
                 }
             }
        } else {
            $content = 'WP nicht installiert/richtig konfiguriert';
        }
        return $content;
    }
}


function getWPTag($tag = 'zen-cart'){
    $wp = new rlWP();
    return $wp->getWPTag($tag);
}
