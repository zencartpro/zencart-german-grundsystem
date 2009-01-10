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
require (DIR_WS_CLASSES . 'currencies.php');
include (DIR_WS_CLASSES . 'order.php');
require_once ('../includes/classes/class.rl_invoice3.php');
$paper = rl_invoice3::getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));
$sql = 'SELECT MAX(orders_id) as oid FROM '. TABLE_ORDERS;
$res = $db->Execute($sql);
$oID = intval($res->fields['oid']);
if($oID < 1){
    echo 'noch keine bestellung vorhanden';
    exit();
}
$pdfT = new rl_invoice3($oID, $paper['orientation'], $paper['unit'], $paper['format']); 
#$pdfT->checkInstall();

$param = zen_sanitize_string($_GET['p']);

class rl_invoice3_ajax {
    private $param;
    public $content;
    private $db;
    function __construct($param) {
        $this->param = $param;
        global $db;
        $this->db = $db;
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
        #$cont = '<link href="css/rl_invoice3_admin.css" rel="stylesheet" type="text/css" />';
        $cont .= '<h1>CheckPaths</h1><span class="adm-ok">green==good  </span><span class="adm-err">red==bad  </span><ul>';
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
        return $cont;
    }
    
    function getRestore(){
        $this->getRemove();
        $this->getInstall();
        return 'rl_invoice database restored to default values';
    }
    function getInstall(){
        global $pdfT;
        $pdfT->checkInstall();
        return 'rl_invoice3 installed !';
    }
    
    function getRemove(){
        $sql = "SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title LIKE 'PDF_INVOICE%'" ;
        $res = $this->db->Execute($sql);
        global $pdfT;
        
        while (!$res->EOF){
            $pdfT->deleteConfGroup($res->fields['configuration_group_id']);
            $res->MoveNext();
        }
        return 'rl_invoice3 database entries removed';
    }
    
    function getFormsave(){
        $updateArray = array('RL_INVOICE3_ADDRESS1_POS', 'RL_INVOICE3_ADDRESS2_POS', 'RL_INVOICE3_DELTA',
                        'RL_INVOICE3_MARGIN', 'RL_INVOICE3_PAPER', 'RL_INVOICE3_DELTA_2PAGE', 'RL_INVOICE3_ADDRESS_WIDTH',
                        'paperformat', 'oriantation');
        rldp($updateArray, '$updateArray');
        rldp($_GET, 'GET');
        rldp($_POST, 'POST');
        
        foreach ($updateArray as $value) {
            $sql = "UPDATE RL_INVOICE3 SET configuration_value = '" . $_POST[$value] . "' WHERE configuration_key = '$value'";
            #echo "$sql\n";
            $this->db->Execute($sql);
        }
        
        
        
    }
    
}
$rl = new rl_invoice3_ajax($param);
echo $rl->getContent();