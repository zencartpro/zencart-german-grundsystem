<?php
/**
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/
 * 
 * @version $Id$
 */
 
$show_all_errors = false;
$current_page_base = 'paypalipn';
$loaderPrefix = 'ajax';
chdir('../');
require_once ('includes/application_top.php');
define('FPDF_FONTPATH', DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/font/');
$param = zen_sanitize_string($_GET['p']);
class rl_invoice3_ajax {
    private $param;
    public $content;
    function __construct($param) {
        $this->param = $param;
        $findFunc = 'get' . ucfirst($this->param);
        if(method_exists($this, $findFunc)){    
            $this->content = $this->$findFunc();   
        } else {
            $this->content = $this->getParam();
        }
    }
    function getParam() {
        return $this->param;
    }
    function getContent() {
        return '<h3>' . $this->content . '</h3>';
    }
    public function getCheckpath(){
        $cont = '<link href="css/rl_invoice3_admin.css" rel="stylesheet" type="text/css" />';
        $cont .= '<hr><h1>CheckPaths</h1><span class="adm-ok">green==good  </span><span class="adm-err">red==bad  </span><ul>';
        include (DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/rl_invoice3_def.php'); 
        
        $defPath = DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/';
        if(file_exists($defPath)){
            $cont .= '<li>default path: <ul><li  class="adm-ok">' . DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/ </li></ul>';
        } else {
            $cont .= '<li>default path: <ul><li  class="adm-err">' . DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/ </li></ul>';
        }
        
        $tmp = explode('|', RL_INVOICE3_PDF_PATH);
        $savePath = $tmp[0];
        $cont .= '<li>Save Path: <ul>';
        if(is_writable($savePath )){                                                                 
            $cont .= '<li class="adm-ok">Save Path: ' . $savePath . ' is writeable</li>';
        } else {
            $cont .= "<li class='adm-err'>Save Path: $savePath is NOT writeable</li>";
        }
        $cont .= '</ul>';
        
        // check bgPDFLang
        $cont .= '<li>bgPDFLang<ul>';
        if(defined('RL_INVOICE3_PDF_BACKGROUND')){
            $cont .= '<li>ZenAdmin<ul>';
            $attachements = explode('|', RL_INVOICE3_PDF_BACKGROUND); 
            foreach ($attachements as $val) {
                if(file_exists($val) || file_exists($defPath . $val) ){
                    $cont .= '<li class="adm-ok">' . $val . '</li>';
                } else {
                    $cont .= '<li class="adm-err>"' . $val . '</li>';
                }
            }
            $cont .= '</ul>';
        }
        foreach ($optionsP as $key => $value) {
            if(isset($value['bgPDFLang'])){
                $cont .= '<li>' . $key . '<ul>';
                foreach ($value['bgPDFLang'] as $val) {
                    if(file_exists($val) || file_exists($defPath . $val) ){
                        $cont .= '<li class="adm-ok">' . $val . '</li>';
                    } else {
                        $cont .= '<li class="adm-err">' . $val . '</li>';
                    }
                }
                $cont .= '</ul>';
            }
        }
        $cont .= '</ul>';
        
        // check attachements
        $cont .= '<li>RL_INVOICE3_SEND_ATTACH<ul>';
        if(defined('RL_INVOICE3_SEND_ATTACH')){
            $cont .= '<li>ZenAdmin<ul>';
            $attachements = explode('|', RL_INVOICE3_SEND_ATTACH); 
            foreach ($attachements as $val) {
                if(file_exists($val) || file_exists($defPath . $val) ){
                    $cont .= '<li class="adm-ok">' . $val . '</li>';
                } else {
                    $cont .= '<li class="adm-err>"' . $val . '</li>';
                }
            }
            $cont .= '</ul>';
        }
        foreach ($optionsP as $key => $value) {
            if(isset($value['attachLang'])){
                $cont .= '<li>' . $key . '<ul>';
                foreach ($value['attachLang'] as $val) {
                    foreach ($val as $pa) {
                        if(file_exists($pa) || file_exists($defPath . $pa) ){
                            $cont .= '<li class="adm-ok">' . $pa . '</li>';
                        } else {
                            $cont .= '<li class="adm-err">' . $pa . '</li>';
                        }
                    }
                }
                $cont .= '</ul>';
            }
        }
        $cont .= '</ul>';
        
        // check Fonts
        $cont .= '<li>RL_INVOICE3_FONTS<ul>';
        
        $fontPath = FPDF_FONTPATH;
        if(file_exists($fontPath)){
            $cont .= '<li>Fontpath: <ul><li  class="adm-ok">' . $fontPath . '</li></ul>';
        } else {
            $cont .= '<li>Fontpath: <ul><li  class="adm-err">' . $fontPath . '</li></ul>';
        }

        if(defined('RL_INVOICE3_FONTS')){
            $cont .= '<li>ZenAdmin<ul>';
            $fonts = explode('|', RL_INVOICE3_FONTS); 
            foreach ($fonts as $val) {
                $x = $fontPath.$val.'.php';
                if(file_exists($fontPath . $val . '.php') ){
                    $cont .= '<li class="adm-ok">' . $val . '</li>';
                } else {
                    $cont .= '<li class="adm-err">' . $val . '</li>';
                }
            }
            $cont .= '</ul>';
        }

        $cont .= '</ul>';
        
        
        $cont .= '</ul>';
        ############
        writeRL($cont, './rl_invoice3/', 'test.html', 'w+');
        return $cont;
    }
    
    function getRestore(){
        $tmp = file_get_contents('rl_invoice3/rl_invoice3_ajax.php');
        $tmpA = file('rl_invoice3/rl_invoice3_ajax.php');
        $c = count($tmpA);
        for($i=0;$i<=$c;$i++){
            $g = strpos($tmpA[$i], '<ul>');
            if($g){
                echo $i+1 . ' :: ' . strpos($tmpA[$i], '<ul>')  . '<br>';
            }
        }
        
    }
    
}
$rl = new rl_invoice3_ajax($param);
echo $rl->getContent();