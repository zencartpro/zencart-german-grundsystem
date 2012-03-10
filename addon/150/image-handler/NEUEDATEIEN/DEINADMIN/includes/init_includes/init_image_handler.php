<?php 

// copyright stuff

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

//=======================================
//
// SET INSTALLATION VARIABLES
//
//=======================================

    //$uninstall = 'uninstall';

    // set version
    $version = '4.0';

    // flags
    $install_incomplete = false;
    $no_template = false;

    // find current template
    $sql = "SELECT template_dir FROM ".TABLE_TEMPLATE_SELECT." LIMIT 1";
    $obj = $db->Execute($sql);
    $current_template = $obj->fields['template_dir'];

    if($current_template == '' )
    {
        $install_incomplete = true;
        $no_template = true;
    }

    // make  override directories if needed
    @mkdir(DIR_FS_CATALOG.'includes/modules/'.$current_template, 0755);
    @mkdir(DIR_FS_CATALOG.'includes/templates/'.$current_template.'/css', 0755);
    @mkdir(DIR_FS_CATALOG.'includes/templates/'.$current_template.'/jscript', 0755);
    @mkdir(DIR_FS_CATALOG.'includes/templates/'.$current_template.'/popup_image_additional', 0755);

    // new files or non-core files
    // these are deleted on uninstall
     $files = array(
            DIR_FS_CATALOG.'bmz_cache/.htaccess',
            DIR_FS_CATALOG.'images/watermark.png',
            DIR_FS_CATALOG.'images/large/watermark_LRG.png',
            DIR_FS_CATALOG.'images/medium/watermark_MED.png',
            DIR_FS_CATALOG.'includes/classes/bmz_gif_info.class.php',
            DIR_FS_CATALOG.'includes/classes/bmz_image_handler.class.php',
            DIR_FS_CATALOG.'includes/extra_configures/bmz_image_handler_conf.php',
            DIR_FS_CATALOG.'includes/extra_configures/bmz_io_conf.php',
            DIR_FS_CATALOG.'includes/functions/extra_functions/functions_bmz_image_handler.php',
            DIR_FS_CATALOG.'includes/functions/extra_functions/functions_bmz_io.php',
            DIR_FS_ADMIN.'image_handler.php',
            DIR_FS_ADMIN.'includes/ih_manager.php',
            DIR_FS_ADMIN.'includes/init_includes/init_image_handler.php',
            DIR_FS_ADMIN.'includes/auto_loaders/config.image_handler.php',
            DIR_FS_ADMIN.'images/checkpattern.gif',
            DIR_FS_ADMIN.'images/icon_image_handler.gif',
            DIR_FS_ADMIN.'images/ih-test.gif',
            DIR_FS_ADMIN.'images/ih-test.jpg',
            DIR_FS_ADMIN.'images/ih-test.png',
            DIR_FS_ADMIN.'includes/extra_configures/bmz_image_handler_conf.php',
            DIR_FS_ADMIN.'includes/extra_configures/bmz_io_conf.php',
            DIR_FS_ADMIN.'includes/extra_datafiles/image_handler.php',
            DIR_FS_ADMIN.'includes/functions/extra_functions/functions_bmz_image_handler.php',
            DIR_FS_ADMIN.'includes/functions/extra_functions/functions_bmz_io.php',
            DIR_FS_ADMIN.'includes/languages/english/extra_definitions/bmz_image_handler.php',
            DIR_FS_ADMIN.'includes/languages/english/extra_definitions/bmz_language_admin.php',
            DIR_FS_ADMIN.'includes/languages/german/extra_definitions/bmz_image_handler.php',
            DIR_FS_ADMIN.'includes/languages/german/extra_definitions/bmz_language_admin.php',
            DIR_FS_ADMIN.'includes/modules/category_product_listing.DEFAULT.php.bak',
            DIR_FS_CATALOG.'includes/modules/pages/popup_image/header_php.DEFAULT.php.bak',
            DIR_FS_CATALOG.'includes/modules/pages/popup_image_additional/header_php.DEFAULT.php.bak'
             );

    // core files with overwrite
    // these are rolled back to Zen Default on uninstalll - the .bak file is left in place
    // files arranged in array (file_to_replace,file_to_replace_with)
    // file_to_replace will be resaved as file_to_replace.bak
    $core_files = array(
            array(DIR_FS_ADMIN.'includes/modules/category_product_listing.php',DIR_FS_ADMIN.'includes/modules/category_product_listing_IH4.php'),
            array(DIR_FS_CATALOG.'includes/modules/pages/popup_image/header_php.php',DIR_FS_CATALOG.'includes/modules/pages/popup_image/header_php_IH4.php'),
            array(DIR_FS_CATALOG.'includes/modules/pages/popup_image_additional/header_php.php',DIR_FS_CATALOG.'includes/modules/pages/popup_image_additional/header_php_IH4.php'),
            );

    // core files for rollback on uninstall 
    // not used on install
    // files arranged in array (file_to_replace,file_to_replace_with)
    // file_to_replace will be resaved as file_to_replace.bak
    $rollback_files = array(
            array(DIR_FS_ADMIN.'includes/modules/category_product_listing.php',DIR_FS_ADMIN.'includes/modules/category_product_listing.DEFAULT.php.bak'),
            array(DIR_FS_CATALOG.'includes/modules/pages/popup_image/header_php.php',DIR_FS_CATALOG.'includes/modules/pages/popup_image/header_php.DEFAULT.php.bak'),
            array(DIR_FS_CATALOG.'includes/modules/pages/popup_image_additional/header_php.php',DIR_FS_CATALOG.'includes/modules/pages/popup_image_additional/header_php.DEFAULT.php.bak'),
            );



    // template files
    // these are deleted on uninstall - the .bak file is left in place
    // files arranged in array (file_to_replace,file_to_replace_with)
    // file_to_replace will be resaved as file_to_replace.bak
    $template_files = array(
            array(DIR_FS_CATALOG.'includes/modules/'.$current_template.'/additional_images.php',DIR_FS_CATALOG.'includes/modules/IH_INSTALL/additional_images.php'),
            array(DIR_FS_CATALOG.'includes/modules/'.$current_template.'/main_product_image.php',DIR_FS_CATALOG.'includes/modules/IH_INSTALL/main_product_image.php'),
            array(DIR_FS_CATALOG.'includes/templates/'.$current_template.'/css/style_imagehover.css',DIR_FS_CATALOG.'includes/templates/IH_INSTALL/css/style_imagehover.css'),
            array(DIR_FS_CATALOG.'includes/templates/'.$current_template.'/jscript/jscript_imagehover.js',DIR_FS_CATALOG.'includes/templates/IH_INSTALL/jscript/jscript_imagehover.js'),
            array(DIR_FS_CATALOG.'includes/templates/'.$current_template.'/popup_image_additional/tpl_main_page.php',DIR_FS_CATALOG.'includes/templates/IH_INSTALL/popup_image_additional/tpl_main_page.php')
            );


    // Configuration Values to create or preserve
    $menu_items_image = array(
            array('IH_RESIZE','no',1001,array('yes','no')),
            array('SMALL_IMAGE_FILETYPE','no_change',1011,array('gif','jpg','png','no_change')),
            array('SMALL_IMAGE_BACKGROUND','255:255:255',1021,false),
            array('SMALL_IMAGE_QUALITY',85,1031,false),
            array('WATERMARK_SMALL_IMAGES','no',1041,array('no','yes')),
            array('ZOOM_SMALL_IMAGES','yes',1051,array('no','yes')),
            array('ZOOM_IMAGE_SIZE','Medium',1061,array('Medium','Large')),
            array('MEDIUM_IMAGE_FILETYPE','no_change',1071,array('gif','jpg','png','no_change')),
            array('MEDIUM_IMAGE_BACKGROUND','255:255:255',1081,false),
            array('MEDIUM_IMAGE_QUALITY',85,1091,false),
            array('WATERMARK_MEDIUM_IMAGES','no',1101,array('no','yes')),
            array('LARGE_IMAGE_FILETYPE','no_change',1111,array('gif','jpg','png','no_change')),
            array('LARGE_IMAGE_BACKGROUND','255:255:255',1121,false),
            array('LARGE_IMAGE_QUALITY',85,1131,false),
            array('WATERMARK_LARGE_IMAGES','no',1141,array('no','yes')),
            array('LARGE_IMAGE_MAX_WIDTH',750,1151,false),
            array('LARGE_IMAGE_MAX_HEIGHT',550,1161,false),
            array('WATERMARK_GRAVITY','Center',1171,array('Center','NorthWest','North','NorthEast','East','SouthEast','South','SouthWest','West'))
            );


    // Legacy Configuration Values to Delete Completely
    $menu_items_delete = array(
            array('ZOOM_GRAVITY'),
            array('SMALL_IMAGE_HOTZONE'),
            array('ZOOM_MEDIUM_IMAGES'),
            array('MEDIUM_IMAGE_HOTZONE'),
            array('ADDITIONAL_IMAGE_FILETYPE'),
            array('ADDITIONAL_IMAGE_BACKGROUND'),
            array('SHOW_UPLOADED_IMAGES')
            );



//=======================================
// INSTALL CHECK
//=======================================

    // do not run installer on log in page
    if(strpos(__FILE__,'login.php'))
    {
        $install_incomplete=true;
        $_SESSION['IH_install_delayed'] = true;
        $messageStack->add_session('IH_delayed','success');

    }

    if($uninstall != 'uninstall')
    {


    foreach($files as $f)
    {
        if(!is_readable($f))
        {
        $messageStack->add('Missing or unreadable file : '.$f, 'warning');
        $install_incomplete = true;
        }
    }

    foreach($core_files as $f)
    {
        if(!is_readable($f[1]))
        {
        $messageStack->add('Missing or unreadable file : '.$f[1], 'warning');
        $install_incomplete = true;
        }
    }

    foreach($template_files as $f)
    {
        if(!is_readable($f[1]))
        {
        $messageStack->add('Missing or unreadable file : '.$f[1], 'warning');
        $install_incomplete = true;
        }
    }

    if($install_incomplete and $uninstall != 'uninstall' and $no_template)
    {
        $messageStack->add('Image Handler is having some problems finding your current template.', 'warning');
        $messageStack->add('********** Installation has been aborted. ********** ', 'warning');
    }
    elseif($install_incomplete and $uninstall != 'uninstall')
    {
        $messageStack->add('Some Image Handler files do not exist.  Perhaps you have uploaded them incorrectly? Or the permissions are set incorrectly?', 'warning');
        $messageStack->add('********** Installation has been aborted. ********** ', 'warning');
    }else{
        $messageStack->add('Image Handler files all exist in correct positions in the directory structure.', 'success');
    }

    }

//=======================================
// INSTALL
//=======================================

if($uninstall != 'uninstall' and !$install_incomplete)
{

    // ======================================================
    //
    // add items to the images menu 
    //
    // ======================================================

    /* Find Config ID of Images */
    $sql = "SELECT configuration_group_id FROM ".TABLE_CONFIGURATION_GROUP." WHERE configuration_group_title='".BOX_CONFIGURATION_IMAGES."' LIMIT 1";
    $result = $db->Execute($sql);
        $im_configuration_id = $result->fields['configuration_group_id'];


    foreach($menu_items_image as $menu_item)
    {
    xxxx_create_menu_item($menu_item[0],$menu_item[1],$menu_item[2],$im_configuration_id,$menu_item[3]);
    }

    // ======================================================
    //
    // register the IH page in admin pages for Zen 1.5 
    //
    // ======================================================

    if (defined('TABLE_ADMIN_PAGES')) 
    {

    zen_deregister_admin_pages('configImageHandler4');
    zen_register_admin_page('configImageHandler4',
        'BOX_TOOLS_IMAGE_HANDLER', 'FILENAME_IMAGE_HANDLER',
        '', 'tools', 'Y',
        14);

    }

    // ======================================================
    //
    // version
    //
    // ======================================================

    $over_item = array('IH_VERSION',$version,10000,false);
    xxxx_overwrite_create_menu_item($over_item[0],$over_item[1],$over_item[2],0,$over_item[3]);

    // ======================================================
    //
    // core files overwrite
    //
    // ======================================================

    foreach($core_files as $cf)
    {
        if(xxxx_install_replace($cf[0],$cf[1]))
        {
            $messageStack->add('CORE FILE OVERWRITE : '.$cf[0].' was overwriten. A back up copy was saved.', 'success');		
        }else{
            $messageStack->add('CORE FILE OVERWRITE : '.$cf[0].' was NOT overwriten. ', 'warning');
        }
    }

    // ======================================================
    //
    // template files create
    //
    // ======================================================

    foreach($template_files as $cf)
    {
        if(xxxx_install_replace($cf[0],$cf[1]))
        {
            $messageStack->add('TEMPLATE FILE CREATE : '.$cf[0].' was created. A back up copy of any overwriten file was saved.', 'success');
        }else{
            $messageStack->add('TEMPLATE FILE CREATE : '.$cf[0].' was NOT created. ', 'warning');
        }
    }

    // ======================================================
    //
    // delete legacy configuration options
    //
    // ======================================================

    foreach($menu_items_delete as $del)
    {
        $sql ="DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$del."'";
        $db->Execute($sql);
    }

    // ======================================================
    //
    // delete the auto-loader
    //
    // ====================================================== 
    if(file_exists(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.image_handler.php'))
    {
        if(!unlink(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'auto_loaders/config.image_handler.php'))
	{
		$messageStack->add('The auto-loader '.DIR_FS_ADMIN.'includes/auto_loaders/config.image_handler.php  has not been deleted.  For Image handler to work you must delete this file manually.','error');
	};
    }

    $messageStack->add('Image Handler has been installed', 'success');
    $_SESSION['image_handler_errors'] = false;
}
elseif($uninstall == 'uninstall')
{

// ======================================================
//
// Uninstall
//
// ====================================================== 

    // ======================================================
    //
    // remove the menu items from the images menu
    //
    // ====================================================== 

    foreach($menu_items_image as $m)
    {
        $sql ="DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$m[0]."'";
        $db->Execute($sql);
    }

    if (defined('TABLE_ADMIN_PAGES')) 
    {
        zen_deregister_admin_pages('configImageHandler4');
    }
    
    // ======================================================
    //
    // remove german config descriptions
    //
    // ====================================================== 
    
      $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'IH_RESIZE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'SMALL_IMAGE_FILETYPE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'SMALL_IMAGE_BACKGROUND'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'SMALL_IMAGE_QUALITY'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'WATERMARK_SMALL_IMAGES'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'ZOOM_SMALL_IMAGES'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'ZOOM_IMAGE_SIZE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'LARGE_IMAGE_FILETYPE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'LARGE_IMAGE_QUALITY'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'WATERMARK_LARGE_IMAGES'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'WATERMARK_GRAVITY'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'SMALL_IMAGE_HOTZONE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'SHOW_UPLOADED_IMAGES'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'ZOOM_GRAVITY'";
				$db->Execute($sql);
				 $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key = 'IMAGE_MANAGER_HANDLER'";
				$db->Execute($sql);
				 
    

    // ======================================================
    //
    // rollback corefiles to default versions
    //
    // ====================================================== 

    foreach($rollback_files as $cf)
    {
        if(xxxx_install_replace($cf[0],$cf[1]))
        {
                if($message_type=='session'){
                    $messageStack->add_session('ROLLBACK  : '.$cf[0].' was returned to default version.', 'success');
                }else{
                    $messageStack->add('ROLLBACK  : '.$cf[0].' was returned to default version.', 'success');
                }
		@unlink($cf[1]);
		
        }else{
                if($message_type=='session'){
                    $messageStack->add_session('ROLLBACK : '.$cf[0].' was NOT rolled back. ', 'warning');
                }else{
                    $messageStack->add('ROLLBACK : '.$cf[0].' was NOT rolled back. ', 'warning');
                }
        }
    }


    // delete the non-core files 
    foreach($files as $f)
    {
        if(file_exists($f))
        {
            if(unlink($f))
            {
            //$messageStack->add_session('deleted - '.$f,'success');
            }else{
                if($message_type=='session'){
                    $messageStack->add_session('not deleted - '.$f,'error');
                }else{
                    $messageStack->add('not deleted - '.$f,'error');
                }
            }
        }
    }

    // delete the template files 
    foreach($template_files as $f)
    {
        if(file_exists($f[0]))
        {
            if(unlink($f[0]))
            {
            //$messageStack->add_session('deleted - '.$f[0],'success');
            }else{
                if($message_type=='session'){
                    $messageStack->add_session('not deleted - '.$f[1],'error');
                }else{
                    $messageStack->add('not deleted - '.$f[1],'error');
                }
            }
        }

        if(file_exists($f[1])) // may not need to do this but what the heck.
        {
            if(unlink($f[1]))
            {
            //$messageStack->add_session('deleted - '.$f[1],'success');
            }else{
                if($message_type=='session'){
                    $messageStack->add_session('not deleted - '.$f[1],'error');
                }else{
                    $messageStack->add('not deleted - '.$f[1],'error');
                }
            }
        }

    }
  

	if($message_type=='session'){
		    $messageStack->add_session('Image Handler has been Uninstalled', 'success');
		    $messageStack->add_session('Image handler Creates back up versions of certain files when it is installed before overwriting them.  These files have been left in position for reference.  They may be deleted but will not effect the functioning of the shop if you leave them in place.', 'warning');
	}else{
		    $messageStack->add('Image Handler has been Uninstalled', 'success');
		    $messageStack->add('Image handler Creates back up versions of certain files when it is installed before overwriting them.  These files have been left in position for reference.  They may be deleted but will not effect the functioning of the shop if you leave them in place.', 'warning');
	}
}



//=======================================
// niccol standard install/replace function
//=======================================

    function xxxx_install_replace($path,$path_from)
    {
    global $extraXXX,$messageStack;

        // move the original
        if(file_exists($path) and file_exists($path_from))
        {
            $bPath = $path.$extraXXX.'.bak';
            if(!rename($path,$bPath)){return false;}
        }
    
        // move the from file into position
        // perhaps we need to try to return the file to its original position??
        if(file_exists($path_from))    
        {
            	if(!copy($path_from,$path)){
			return false;
		}else{
			@unlink($path_from);
		}
        }else{
            return false;
        }    
    return true;
    }

//=======================================
// niccol standard create menu item function
//=======================================

    function xxxx_create_menu_item($c_key,$default,$sort,$config_id,$values)
    {
            global $db;
            $title = $c_key.'_TITLE';


            $text = $c_key.'_TEXT';

            
            $sql = "SELECT configuration_value FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$c_key."' LIMIT 1";
            $results = $db->Execute($sql);
            
            $config_value = ($results->fields['configuration_value'] !='')?$results->fields['configuration_value']: $default;

            $sql ="DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$c_key."'";
            $db->Execute($sql);

            if($values)
            {
                foreach($values as $v)
                {
                $v_string .= "''".$v."'',";
                }
                $v_arr = substr($v_string,0,-1);
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".constant($title)."', '".$c_key."', '".$config_value."', '".constant($text)."', ".$config_id.", ".$sort.", now(), now(), NULL, 'zen_cfg_select_option(array(".$v_arr."),')";
            }else{
                // text input type
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".constant($title)."', '".$c_key."', '".$config_value."', '".constant($text)."', ".$config_id.", ".$sort.", now(), now(), NULL, NULL)";
            }
    
            $db->Execute($sql);  



            return true;

    }


//=======================================
// niccol overwrite create menu item function
//=======================================

    function xxxx_overwrite_create_menu_item($c_key,$default,$sort,$config_id,$values)
    {
            global $db;
            $title = $c_key.'_TITLE';

            $text = $c_key.'_TEXT';

            $config_value = $default;

            $sql ="DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = '".$c_key."'";
            $db->Execute($sql);

            if($values)
            {
                foreach($values as $v)
                {
                $v_string .= "''".$v."'',";
                }
                $v_arr = substr($v_string,0,-1);
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".constant($title)."', '".$c_key."', '".$config_value."', '".constant($text)."', ".$config_id.", ".$sort.", now(), now(), NULL, 'zen_cfg_select_option(array(".$v_arr."),')";
            }else{
                // text input type
                $sql = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, '".constant($title)."', '".$c_key."', '".$config_value."', '".constant($text)."', ".$config_id.", ".$sort.", now(), now(), NULL, NULL)";
            }
			
			$db->Execute($sql); 
            
//=======================================
// webchills create config description for german admin
//=======================================   
            $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Wasserzeichen', 'WATERMARK_SMALL_IMAGES', '43', 'Stellen Sie auf yes, wenn Sie mit Wasserzeichen versehene kleine Bilder anzeigen wollen.', now(), now());";
				$db->Execute($sql);
				$sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Bildgrösse ändern', 'IH_RESIZE', '43', 'Entweder No für normales Zen-Cart Verhalten oder Yes um die automatische Grössenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', now(), now());";
        $db->Execute($sql);
         $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', '43', 'Wählen Sie jpg, gif oder png. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser gif für die Transparenz oder jpg für größere Bilder. no_change bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet.', now(), now());";   
        $db->Execute($sql);
          $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', '43', 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf transparent um die Transparenz zu erhalten.', now(), now());";  
    $db->Execute($sql);
    $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', '43', 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je höher desto bessere Qualität und desto höhere Dateigröße. Voreingestellt ist 85.', now(), now());";
       $db->Execute($sql);
        $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Zoom', 'ZOOM_SMALL_IMAGES', '43', 'Stellen Sie auf yes, falls Sie den Zoom-Effekt bei Mouseover für die kleinen Bilder aktivieren wollen.', now(), now());";
      $db->Execute($sql);
       $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Kleine Bilder - Bildgröße bei Hover', 'ZOOM_IMAGE_SIZE', '43', 'Stellen Sie auf Medium wenn Sie beim Hover die Größe der mittleren Bilder haben wollen und auf Large, wenn Sie die Größe der großen Bilder verwenden wollen.', now(), now());"; 
       $db->Execute($sql);
        $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Dateityp', 'MEDIUM_IMAGE_FILETYPE', '43', 'Wählen Sie jpg, gif oder png. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser gif oder jpg für grosse Bilder. no_change bedeutet normales Zen-Cart-Verhalten und für die mittleren Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now());";
       $db->Execute($sql);
        $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Hintergrund', 'MEDIUM_IMAGE_BACKGROUND', '43', 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf transparent um die Transparenz zu erhalten.', now(), now());";
       $db->Execute($sql);
       	$sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Qualität', 'MEDIUM_IMAGE_QUALITY', '43', 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je höher desto bessere Qualität und desto höhere Dateigröße. Voreingestellt ist 85.', now(), now());";
      $db->Execute($sql);
       $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Mittlere Bilder - Wasserzeichen', 'WATERMARK_MEDIUM_IMAGES', '43', 'Stellen Sie auf yes, wenn Sie mittlere Bilder mit Wasserzeichen versehen anzeigen lassen wollen.', now(), now());";
        $db->Execute($sql);
         $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Dateityp', 'LARGE_IMAGE_FILETYPE', '43', 'Wählen Sie jpg, gif oder png. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser gif oder jpg für grosse Bilder. no_change bedeutet normales Zen-Cart-Verhalten und für die grossen Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now());";   
        $db->Execute($sql);
          $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Hintergrund', 'LARGE_IMAGE_BACKGROUND', '43', 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf transparent um die Transparenz zu erhalten.', now(), now());"; 
          $db->Execute($sql);
            $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Qualität', 'LARGE_IMAGE_QUALITY', '43', 'Geben Sie die gewünschte Bildqualität für grosse jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now());";
          $db->Execute($sql);
          	$sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Wasserzeichen', 'WATERMARK_LARGE_IMAGES', '43', 'Stellen Sie auf yes, wenn Sie grosse Bilder mit Wasserzeichen versehen anzeigen wollen.', now(), now());"; 
         $db->Execute($sql);
         $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Maximale Breite', 'LARGE_IMAGE_MAX_WIDTH', '43', 'Geben Sie eine maximale Breite für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', now(), now());";  
       $db->Execute($sql);
        $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Grosse Bilder - Maximale Höhe', 'LARGE_IMAGE_MAX_HEIGHT', '43', 'Geben Sie eine maximale Höhe für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', now(), now());";
       $db->Execute($sql);
       $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES " .  
				"('IH - Wasserzeichen - Position', 'WATERMARK_GRAVITY', '43', 'Wählen Sie die Position für das Wasserzeichen. Voreingestellt ist <strong>Center (Zentriert)</strong>.', now(), now());";
            $db->Execute($sql);  



            return true;

    }

