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
    public $wpinstall;
    private $pid;
    
    function __construct($pid = 1){
        $this->pid = $pid;
    }
    
    public function getPDFLink(){
        $content = '';
        $files = array();
        $path = DIR_WS_IMAGES . 'PDF/';
        // check single file
        $singleFile = $path . $this->pid . '.pdf';
        if(file_exists($singleFile)){
            $files[$this->pid . '.pdf'] = $singleFile;
        }
        
        // check pid-folder
        $path = DIR_WS_IMAGES . 'PDF/' . $this->pid . '/';
        if ($handle = @opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if($file == '.' || $file == '..') {
                    // nothing todo
                } else {
                    $files[$file] .=  $path  . $file;
                }
            }
            closedir($handle);
        } else {
            // nothing todo
        }
        $content = '<div id="pdf-files"><h4>klick to view</h4><ul>';
        foreach ($files as $key => $value) {
            $content .= '<li><a href="' . $value . '" target="_blank">' . $key . '</a></li>';
        }
        $content .= '</ul></div>';
        return $content ;
    }
}


function getPDF($pid = 1){
    $pdf = new rlPDF($pid);
    return $pdf->getPDFLink();
}

