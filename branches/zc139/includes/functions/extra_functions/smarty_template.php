<?php
/**
* @desc 
* $Id$
*/

// Smarty Library Dateien laden
#require(DIR_FS_CATALOG . 'smarty/Smarty.class.php');
require(DIR_FS_CATALOG . 'smarty/libs/Smarty.class.php'); 

// ein guter Platz um Applikations spezifische Libraries zu laden
// require('guestbook/guestbook.lib.php');

class rl1SmartyTemplate extends Smarty
    {
    function __construct($template = DIR_WS_TEMPLATE)
        {
        // Konstruktor. Diese Werte werden f&uuml;r jede Instanz automatisch gesetzt
        parent::__construct();
        
        $this->template = $template;
        #$this->Smarty();
        
        $path              =DIR_FS_CATALOG . $template;

        $this->template_dir=$path . 'smarty_templates/';
        $this->compile_dir =$path . 'smarty_templates_c/';
        $this->config_dir  =$path . 'smarty_configs/';
        $this->cache_dir   =$path . 'smarty_cache/';
        if(!file_exists($this->template_dir)){
            mkdir($this->template_dir);
        }
        if(!file_exists($this->compile_dir)){
            mkdir($this->compile_dir);
        }
        if(!file_exists($this->config_dir)){
            mkdir($this->config_dir);
        }
        if(!file_exists($this->cache_dir)){
            mkdir($this->cache_dir);
        }

        $this->caching     =true;
        $this->assign('tplpath', $template);
        }
    function checkTemplate($tmplName){
        global $template;
        $tmp = DIR_FS_CATALOG . $this->template . 'smarty_templates/' . $tmplName;  
        if (file_exists($tmp)){
            return $tmp;
        } else {
            $tmp = DIR_FS_CATALOG . DIR_WS_TEMPLATES . 'template_default/smarty_templates/' . $tmplName;
            echo $tmplName;
            return $tmp;
        }
    }
    function rlDisplay($template=NULL, $cache=false, $cache_id=NULL , $compile_id=NULL){
        $tmp = $this->caching;
        $this->caching = $cache; 
        $this->display($template, $cache_id, $compile_id);
        $this->caching = $tmp; 
    }
    function rlFetch($template=NULL, $cache=false, $cache_id=NULL , $compile_id=NULL){
        $tmp = $this->caching;
        $this->caching = $cache; 
        $tmp = $this->fetch($template, $cache_id, $compile_id);
        $this->caching = $tmp; 
        return $tmp;
    }
}

function insert_rightMenu($p1='P1'){
    global $smarty;
    return  $smarty->rlFetch('rightmenu.tpl.html');
}

function insert_PrevNext(){
    global $smarty;
    return  $smarty->rlFetch('products_next_previous.tpl.html');
}

?>