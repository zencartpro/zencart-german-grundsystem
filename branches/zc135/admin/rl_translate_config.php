<?php
/**
 * @package languageDefines
 * @copyright Copyright 2006 rainer langheiter, http://edv.langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */


  $config = array(
                'ORI'=>array(                       // source dir
                    'version'=>'ZC135en',           
                    'languageName'=>'english',  
                    'languages_id'=>'1', 
                    'absPath2LangDir'=>'/home/html/zencart-german/branches/zc135/',
                    ),
                'COMPARE'=>array(                   // dir to compare, the old language dir
                    'version'=>'ZC1302de',
                    'languageName'=>'german',  
                    'languages_id'=>'43', 
                    'absPath2LangDir'=>'/home/html/zencart-german/branches/zc135/',
                    ),
                'NEW'=>array(                       // place to write the new language files
                    'languageName'=>'german',  
                    'languages_id'=>'43', 
                    'absPath2LangDir'=>'/home/html/zencart-translate/',
                    ),
                'all'=>array(   
                    'reReadFiles'=>true,           // reread all language files
                    'truncateTable'=>true,         // empty the database table
                    'debug'=>true,                  // print debug info onto the screen
                    'testInclude'=>true,            // test, if the new generated language-file can be included without errors ==> you must turn on debug(transLog)
                    ),
                'debug'=>array(                     // debug flags for functions xy..
                    'compareFiles'=>false,
                    'root'=>false,
                    'writeKeyFile'=>false,
                    'writeLangFile'=>false,
                    'transLog'=>true,
                    'compareFiles2'=>false,
                    'translate' => true, 
                    ),
                'trans'=>array(                     // replace with translator info
                    '* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0' => "* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0\n * @translator: cyaneo/hugo13/wflohr\thttp://www.zen-cart.at\t" . date('Y-m-d'),
                    '// | Translator:           cyaneo/hugo13                                  |' => '// | Translator:           cyaneo/hugo13/wflohr                           |',
                    '// | Date of Translation:  31.03.06                                       |' => '// | Date of Translation:  '.date('Y-m-d').'                                     |',
                    ),
                'table'=>array(                                     // table struc
                    'transTable' => DB_PREFIX . 'translation',     // the tablename
                    'sql' => "CREATE TABLE " . DB_PREFIX . "translation (
                                  keyword varchar(150)  default NULL,
                                  keyvalue text  NOT NULL,
                                  languages_id int(11) NOT NULL default '0',
                                  filenamepath varchar(250)  default NULL,
                                  version varchar(50)  NOT NULL default '',
                                  keypath varchar(250)  default NULL,
                                  id int(11) NOT NULL auto_increment,
                                  PRIMARY KEY  (id),
                                  KEY keyword (keyword),
                                  KEY keypath (keypath),
                                  KEY languages_id (languages_id),
                                  KEY xxxx (keyword(50),keypath(50),languages_id)
                                ) ENGINE=MyISAM ",
                    ),
                );
  
?>
