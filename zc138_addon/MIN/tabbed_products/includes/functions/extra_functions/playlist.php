<?php
    class playList {
    
        public $pID;
        public $xmlFile;
        public $xml;
        
        function __construct($pID=0){
            $this->pID = $pID;
            $this->xmlFile = "/var/www/html/zc138/images/xml/" . $this->pID . '.xml';
            $this->xmlFile = "/var/www/html/zc138/embed/" . $this->pID . '.xml';
        }
      function getPlayList(){
          global $db;
          $sql = 'SELECT products_attributes.options_id, products_attributes_download.products_attributes_id, products_attributes_download.products_attributes_filename, products_attributes.attributes_image 
                    FROM (products INNER JOIN products_attributes ON products.products_id = products_attributes.products_id) INNER JOIN products_attributes_download ON products_attributes.products_attributes_id = products_attributes_download.products_attributes_id
                    WHERE products.products_id=' . $this->pID;
          $res = $db->execute($sql);
        $cont = '<br />XXXX';
        $xml = '';
        while (!$res->EOF){
            #$cont .= getJS($res->fields['products_attributes_filename']) . 'xxx<br />';
            $this->xml .= $this->writeLine('titel', 'http://edv.langheiter.com', $res->fields['products_attributes_filename'], $res->fields['attributes_image']);
            $res->MoveNext();
        }
        $this->makeXML();
        $cont = $this->getJS();
        return '<br />'.$cont;
          return $sql . '<hr>getPlayList was here'.$this->pID . '<hr>' . $cont . '<hr>' ;
      }
        
        function getJS($albumPath, $di){
         $tmp = " 
        <script type='text/javascript' src='./embed/swfobject.js'></script>
          <div id='preview'>This div will be replaced</div>
          <script type='text/javascript'>
          var s1 = new SWFObject('./embed/player.swf','ply','470','220','9','#ffffff');
          s1.addParam('allowfullscreen','true');
          s1.addParam('autostar','true');
          s1.addParam('allowscriptaccess','always');
          s1.addParam('wmode','opaque');
          s1.addParam('flashvars','file=" . HTTP_SERVER . DIR_WS_CATALOG . "mp3a.php%3Fa%3D$albumPath');  
          s1.write('preview');
        </script>  
        ";
        
        $tmp = "<script type='text/javascript' src='./embed/swfobject.js'></script>

          <div id='preview'>This div will be replaced</div>

          <script type='text/javascript'>
          var s1 = new SWFObject('./embed/player.swf','ply','470','202','9','#');
          s1.addParam('allowfullscreen','true');
          s1.addParam('allowscriptaccess','always');
          s1.addParam('autostart','true');
          s1.addParam('wmode','opaque');
          s1.addParam('flashvars','&file=" . HTTP_SERVER . DIR_WS_CATALOG . "mp3a.php%3Fa%3D$albumPath&playlist=bottom&autostart=true&shuffle=true&skin=http://www.jeroenwijering.com/upload/simple.swf');
          s1.write('preview');
        </script>"        ;
                
                
        
        return $tmp;
        }
        
        function writeLine($title, $link, $content, $thumbnail, $description=""){
            $description = $content;
            #$content = 'http://all.ar-pub.com/zc138/download/' . $content;
            $thumbnail = 'http://all.ar-pub.com/zc138/images/' . $thumbnail;
            $line = "
                    <item>    
                        <title>$title</title>
                        <link>$link</link>
                        <description>$description</description>
                        <media:credit role=\"author\">the Peach Open Movie Project</media:credit>
                        <media:content file=\"$content\" type=\"audio/mpeg\" />
                        <media:thumbnail url=\"$thumbnail\" />
                    </item>
            ";
        return $line;
        }

        function makeXML(){
            $xml = "<rss version='2.0' xmlns:media='http://search.yahoo.com/mrss/' xmlns:atom='http://www.w3.org/2005/Atom'>
                    <channel>
                        <title>Example media RSS playlist for the JW Player</title>
                        <description>Example media RSS playlist for the JW Player</description>
                        <link>http://edv.langheiter.com</link>
                        <atom:link href='http://all.ar-pub.com/zc138/test/mrss.xml' rel='self' type='application/rss+xml' />";
            $xml .= $this->xml;
            $xml .= "</channel>\n</rss>";

            $folder = "/var/www/html/zc138/images/xml/" . $this->pID . '.xml';
            $foldFile = $folder . $filename;
            #if (is_writable($this->xmlFile)){
            if (1==1){
             if (!$handle = fopen($this->xmlFile, 'w')){
                 print "Kann die Datei $filename nicht öffnen";
                 exit;
                 }

             // Schreibe $somecontent in die geöffnete Datei.
            if (!fwrite($handle, $xml)){
                 print "Kann in die Datei $filename nicht schreiben";
                 exit;
                 }
             fclose($handle);

             }else{
             print "Die Datei $filename ist nicht schreibbar";
             }
            
        }
}

class ID3List{
    public $pid;
    private $db;
    function __construct($pid){
        global $db;
        $this->db = $db;
        $this->pid = $pid;
        $id3Path = DIR_FS_CATALOG . 'getid3/getid3.php';
        if (!@include_once($id3Path )) {
            die('Cannot open '.realpath($id3Path));
        }
        // Initialize getID3 engine
        $getID3 = new getID3;
        $getID3->setOption(array(
            'option_md5_data' => $getid3_demo_mysql_md5_data,
            'encoding'        => $getid3_demo_mysql_encoding,
        ));

        
    }
    
    public function getID3List(){
        $xml = new playList($this->pid);
        $albumPath = '';
        $cont = '<h1>ID3 list</h1>';
        $sql = 'SELECT products_url FROM ' . TABLE_PRODUCTS_DESCRIPTION . ' WHERE products_id=' . $this->pid . ' AND language_id=' . $_SESSION['languages_id'];
        $res = $this->db->execute($sql);
        if($res->recordcount()==1){
            $sql = "SELECT * FROM mp3 WHERE filename LIKE '" . $res->fields['products_url'] . "%'";
            $albumPath = $res->fields['products_url'];
            $resID3 = $this->db->execute($sql);
            while (!$resID3->EOF){
                $xml->xml .= $xml->writeLine('titel', 'http://edv.langheiter.com', $resID3->fields['filename'], 'xx.jpg');
                #$xml->xml .= $xml->writeLine('titel', 'http://edv.langheiter.com', '01.mp3', 'xx.jpg');
                $cont .= $resID3->fields['title'] . ' :: ' . date('n:s', $resID3->fields['playtime_seconds']) . '<br />';
                $resID3->movenext();
            }
        }
        #$x = $xml->makeXML();
        $cont = $xml->getJS($albumPath);
        return '<br />'.$cont;
        return $cont;
    }
    
}


function getPlayList($pID){
    $PL = new playList($pID);
    $x =  $PL->getPlayList();
    return $x;
}

function getID3List($pid){
    $id3 = new ID3List($pid);
    $x = $id3->getID3List();
    return $x;
}
