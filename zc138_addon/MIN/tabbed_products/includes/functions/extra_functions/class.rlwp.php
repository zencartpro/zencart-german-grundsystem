<?php
define ('ABSPATH','/var/www/html/wordpress/');

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
    #return 'WP from FUNC';
    $wp = new rlWP();
    return $wp->getWPTag($tag);
}
