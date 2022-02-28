<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: rl_invoice3_ajax.php 2022-02-28 17:34:17Z webchills $
 */
 
$show_all_errors = false;
require_once ('includes/application_top.php');
require (DIR_WS_CLASSES . 'currencies.php');
include (DIR_WS_CLASSES . 'order.php');
require_once ('../includes/classes/class.rl_invoice3.php');
require_once ('../includes/languages/german/extra_definitions/rl_invoice3.php');
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

    
    function getFormsave(){
        
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
                   
                }
                $sqlVal = substr($sqlVal, 0, -1);
                $sql = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $sqlVal . "' WHERE configuration_key = '$key'";
                $t = str_replace('UPDATE configuration SET configuration_value =', '', $sql);
                $ret .= str_replace('WHERE configuration_key =', '=', $t) . '<br />';
               
                $this->db->Execute($sql);
            }
           
        }
        return '<h1 style="color:#FF0000; background-color: #DDEE22;">Data saved</h1>' . $ret;
    }
    
    function getDefaultvalues(){
        
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
            
        }
        $x[] = $resp;
        
        return json_encode($resp);       
        
    }
    
}
$rl = new rl_invoice3_ajax($param);
echo $rl->getContent();


    class InvoiceAjax {
        function __construct( ) {
            $n = func_num_args( ) ;
            for ( $i = 0 ; $i < $n ; $i += 2 ) {
                $this->{func_get_arg($i)} = func_get_arg($i + 1) ;
            }
        }
    }

    $o = new InvoiceAjax(
        'rl_1', 'value',
        'rl_2', array('element 1', 'element 2')) ;
    