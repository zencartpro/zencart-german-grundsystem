<?php
/**
 * @package TPP
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * example: <!--%PDF%--><!--###getPDF###-->
 * first part == name of tab ( <!--%PDF%--> )
 * second part == name of called function; param: products_id  ( <!--###getPDF###--> )
 */


class rlPDF {
    private $db;
    private $pid;
    private $files;
    
    function __construct($pid = 1){
        $this->pid = $pid;
        global $db;
        $this->db = $db;
        $this->files = array();     
    }
    
    public function getPDFLink(){
        $content = '';
        
        $this->getFileFolder($this->pid);
        $this->getFileFolder($this->getProductsModel());
        
        $content = '<div id="pdf-files"><h4>klick to view</h4><ul>';

        foreach ($this->files as $key => $value) {
            $content .= '<li><a href="' . $value . '" target="_blank">' . $key . '</a></li>';
        }
        $content .= '</ul></div>';
        return $content ;
    }
    public function getProductsModel(){
        $sql = "SELECT products_model FROM " . TABLE_PRODUCTS . " WHERE products_id='" . $this->pid . "' LIMIT 1";
        $res = $this->db->Execute($sql);
        if($res->RecordCount()!=0){
            return $res->fields['products_model'];
        }
    }

    public function getFileFolder($search){
        $path = DIR_WS_IMAGES . 'PDF/';
        // check single file
        $singleFile = $path . $search . '.pdf';
        if(file_exists($singleFile)){
            $this->files[$search . '.pdf'] = $singleFile;
        }
        
        // check pid-folder
        $path = DIR_WS_IMAGES . 'PDF/' . $search . '/';
        if ($handle = @opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if($file == '.' || $file == '..') {
                    // nothing todo
                } else {
                    $this->files[$file] .=  $path  . $file;
                }
            }
            closedir($handle);
        } else {
            // nothing todo
        }
        
    }
}


function getPDF($pid = 1){
    $pdf = new rlPDF($pid);
    return $pdf->getPDFLink();
}

