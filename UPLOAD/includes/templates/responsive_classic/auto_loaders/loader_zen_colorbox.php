<?php
if (ZEN_COLORBOX_STATUS == 'true') {
$loaders[] = array(
    'conditions' => array(
        'pages' => array('document_general_info','document_product_info','page','product_free_shipping_info','product_info','product_music_info','product_reviews','product_reviews_write') 
    ),
    'jscript_files' => array(
        
        'auto_loaders/zen_colorbox.php' => 3, 
    ),
    'css_files' => array(
        'zen_colorbox.css' => 1,)
);
}
