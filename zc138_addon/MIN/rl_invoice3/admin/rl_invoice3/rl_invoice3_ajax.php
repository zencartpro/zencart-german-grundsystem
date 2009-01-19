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
$papDef = array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P');
$pap = rl_invoice3::getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));
$paper = array();
foreach ($pap as $key => $value) {
    if($value==0){
        $paper[$key] = $papDef[$key];
    } else {
        $paper[$key] = $value;
    }
}
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
    private $updateArray;
    function __construct($param) {
        $this->param = $param;
        global $db;
        $this->db = $db;
        $this->updateArray = array('RL_INVOICE3_ADDRESS1_POS', 'RL_INVOICE3_ADDRESS2_POS', 'RL_INVOICE3_DELTA',
                'RL_INVOICE3_MARGIN', 'RL_INVOICE3_PAPER', 'RL_INVOICE3_DELTA_2PAGE', 'RL_INVOICE3_ADDRESS_WIDTH',
                'RL_INVOICE3_PAPER');
                
        $this->updateArray = array(
                'RL_INVOICE3_ADDRESS1_POS' => array('X', 'Y'), 
                'RL_INVOICE3_ADDRESS2_POS' => array('X', 'Y'), 
                'RL_INVOICE3_DELTA' => array('1', '2'),
                'RL_INVOICE3_MARGIN' => array('TOP', 'RIGHT', 'BOTTOM', 'LEFT'), 
                'RL_INVOICE3_PAPER' => array('SIZE', 'UNIT', 'ORIANTATION'),
                'RL_INVOICE3_DELTA_2PAGE' => array(''),
                'RL_INVOICE3_ADDRESS_WIDTH' => array('1', '2'),
                );
                

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
        return $this->content;
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
        #rldp($this->updateArray , '$updateArray');
        #rldp($_GET, 'GET');
        #rldp($_POST, 'POST');
        
        $ret = '';
        foreach ($this->updateArray  as $key => $values) {
            if(is_array($values)){
                $sqlVal = '';
                foreach ($values as $value) {
                    if($value == ''){
                        $t = $key . $value;
                    } else {
                        $t = $key . '_' . $value;
                    }
                    if($key != 'RL_INVOICE3_PAPER'){
                        $v = round($_POST[$t] / 2, 0);
                    } else {
                        $v = $_POST[$t];
                    }
                    $sqlVal .= $v . '|';
                    #echo "$t :: $v: <br />";
                }
                $sqlVal = substr($sqlVal, 0, -1);
                $sql = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $sqlVal . "' WHERE configuration_key = '$key'";
                $t = str_replace('UPDATE configuration SET configuration_value =', '', $sql);
                $ret .= str_replace('WHERE configuration_key =', '=', $t) . '<br />';
                #echo "$sql <hr>";
                $this->db->Execute($sql);
            }
            #$sql = "UPDATE RL_INVOICE3 SET configuration_value = '" . $_POST[$value] . "' WHERE configuration_key = '$value'";
            #echo "$sql\n";
            #$this->db->Execute($sql);
        }
        return '<h1 style="color:#FF0000; background-color: #DDEE22;">Data saved</h1>' . $ret;
    }
    
    function getDefaultvalues(){
/*        
        {"RL_INVOICE3_ADDRESS1_POS":["0","30"],"RL_INVOICE3_ADDRESS2_POS":["90","36"],"RL_INVOICE3_DELTA":["20"

,"20"],"RL_INVOICE3_MARGIN":["25","10","30","20"],"RL_INVOICE3_PAPER":["A4","mm","P"],"RL_INVOICE3_DELTA_2PAGE"

:["15"],"RL_INVOICE3_ADDRESS_WIDTH":["80","60"]}
        */

        
        $resp = array();
        foreach ($this->updateArray  as $key => $values) {
            $tmp = explode('|', constant($key));
            foreach ($values as $k => $value) {
                if($key != 'RL_INVOICE3_PAPER'){ 
                    $resp[$key . '_' . $value] = $tmp[$k]*2;
                } else {
                    $resp[$key . '_' . $value] = $tmp[$k];
                }
            }
            #return json_encode($resp);  
        }
        $x[] = $resp;
        #return json_encode($x);
        return json_encode($resp);
        #echo rldp($resp, 'DEFAULT');
        
    }
    
}
$rl = new rl_invoice3_ajax($param);
echo $rl->getContent();



    class Object {
        function __construct( ) {
            $n = func_num_args( ) ;
            for ( $i = 0 ; $i < $n ; $i += 2 ) {
                $this->{func_get_arg($i)} = func_get_arg($i + 1) ;
            }
        }
    }

    $o = new Object(
        'rl_1', 'value',
        'rl_2', array('element 1', 'element 2')) ;
    ##rldp((array)$o);
    
    