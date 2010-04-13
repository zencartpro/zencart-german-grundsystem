<?php
/*
  $Id: backup.php,v 1.60 2003/06/29 22:50:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
  
  Converted to Zen-cart by someguy 5/2/2008
  
  modified by web28 - (c)  by www.rpa-com.de 2008/07/30
  
  v. 1.60b
 FIX:  entpackt  mit BACKUP_MYSQL_ADMIN_PLUGIN-1.3 erstellte Backupdateien
  
  */

  require('includes/application_top.php');
  include(DIR_WS_CLASSES.'zip.lib.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  
  $output_buffer='';
  function OutputHandler(&$line,$fp,$compression) {
	//global $fp,$compression;
		switch ($compression) {
			case 'no':
			case 'zip':
				fwrite($fp,$line);
			break;
			case 'gzip':
				gzwrite($fp,$line);
			break;
			case 'bzip':
				bzwrite($fp,$line);
			break;
		}
  }

  if (zen_not_null($action)) {
    switch ($action) {
      case 'forget':
        $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
        $messageStack->add_session(SUCCESS_LAST_RESTORE_CLEARED, 'success');
        zen_redirect(zen_href_link(FILENAME_BACKUP));
        break;
      case 'backupnow':
        zen_set_time_limit(0); // This could take a looong time.
		$compression=$_POST['compress'];
        $backup_file = 'db_' . DB_DATABASE . '-' . date('YmdHis');
		switch ($compression) {
			case 'zip': //Zip are stored uncompressed and compressed at the end
			case 'no':
				$backup_file.='.sql';
				$fp = fopen(DIR_FS_BACKUP . $backup_file, 'w');
			break;
			case 'gzip':
				$backup_file.='.gz';
				$fp = gzopen(DIR_FS_BACKUP . $backup_file, 'w');
			break;
			case 'bzip':
				$backup_file.='.bz2';
				$fp = bzopen(DIR_FS_BACKUP . $backup_file, 'w');
			break;
		}
       
        $schema = '# Zen Cart, The art of e-commerce' . "\n" .
                  '# http://www.zen-cart.com' . "\n" .
                  '#' . "\n" .
                  '# Database Backup For ' . STORE_NAME . "\n" .
                  '# Copyright (c) ' . date('Y') . ' ' . STORE_OWNER . "\n" .
                  '#' . "\n" .
                  '# Database: ' . DB_DATABASE . "\n" .
                  '# Database Server: ' . DB_SERVER . "\n" .
                  '#' . "\n" .
                  '# Backup Date: ' . date(PHP_DATE_TIME_FORMAT) . "\n\n";
		OutputHandler($schema,$fp,$compression);

        $tables_query = $db->Execute('show tables');
        while (!$tables_query->EOF) {
		  reset($tables_query->fields);
		  $table=each($tables_query->fields);
		  $table=$table[1];
          $schema = 'drop table if exists ' . $table . ';' . "\n" .
                    'create table ' . $table . ' (' . "\n";
          $table_list = array();
          $fields = $db->Execute("show fields from " . $table);
          while (!$fields->EOF) {
            $table_list[] = $fields->fields['Field'];
            $schema .= '  ' . $fields->fields['Field'] . ' ' . $fields->fields['Type'];
            if (strlen($fields->fields['Default']) > 0) $schema .= ' default \'' . $fields->fields['Default'] . '\'';
            if ($fields->fields['Null'] != 'YES') $schema .= ' not null';
            if (isset($fields->fields['Extra'])) $schema .= ' ' . $fields->fields['Extra'];
            $schema .= ',' . "\n";
			$fields->MoveNext();
          }
          $schema = ereg_replace(",\n$", '', $schema);

// add the keys
          $index = array();
          $keys = $db->Execute("show keys from " . $table);
          while (!$keys->EOF) {
            $kname = $keys->fields['Key_name'];			
            if (!isset($index[$kname])) {
              $index[$kname] = array('unique' => !$keys->fields['Non_unique'],
                                     'fulltext' => ($keys->fields['Index_type'] == 'FULLTEXT' ? '1' : '0'),
                                     'columns' => array(),
									 'subpart' => array()
									 );
            }
            $index[$kname]['columns'][] = $keys->fields['Column_name'].($keys->fields['Sub_part']!=null?'('.$keys->fields['Sub_part'].')':'');
			$keys->MoveNext();
          }
		  
          while (list($kname, $info) = each($index)) {
            $schema .= ',' . "\n";
            $columns = implode($info['columns'], ', ');			
            if ($kname == 'PRIMARY') {
              $schema .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ( $info['fulltext'] == '1' ) {
              $schema .= '  FULLTEXT ' . $kname . ' (' . $columns . ')';
            } elseif ($info['unique']) {
              $schema .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
              $schema .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
          }

         $schema .= "\n" . ');' . "\n";
		 OutputHandler($schema,$fp,$compression);
// dump the data
          if ( ($table != TABLE_SESSIONS ) && ($table != TABLE_WHOS_ONLINE) && ($table != TABLE_ADMIN_ACTIVITY_LOG) ) {
            $rows = $db->Execute("select " . implode(',', $table_list) . " from " . $table);
			$rowcount=$rows->RecordCount();
			$skip_insert=false;
            while (!$rows->EOF) {
			$schema='';
			 if(!$skip_insert) {
              $schema = 'insert into ' . $table . ' (' . implode(', ', $table_list) . ') values ';
			  $skip_insert=true;
			 }

			  $schema .= '(';

              reset($table_list);
              while (list(,$i) = each($table_list)) {
                if (!isset($rows->fields[$i])) {
                  $schema .= 'NULL, ';
                } elseif (zen_not_null($rows->fields[$i])) {
                  $row = addslashes($rows->fields[$i]); //Should this use prepare_input?
                  $row = ereg_replace("\n#", "\n".'\#', $row);

                  $schema .= '\'' . $row . '\', ';
                } else {
                  $schema .= '\'\', ';
                }
              }

              $schema = ereg_replace(', $', '', $schema) . ')';
			  if ($rows->cursor+1 === $rowcount) {$schema.=";\n\n";} else {$schema.=',';};
			  $rows->MoveNext();
			  OutputHandler($schema,$fp,$compression);
          }
          }
		  $tables_query->MoveNext();
        }
		
		switch ($compression) {
			case 'no':
				fclose($fp);
			break;
			case 'gzip':
				gzclose($fp);
			break;
			case 'zip':
				fclose($fp);
				$fp = fopen(DIR_FS_BACKUP . $backup_file ,'r');
				$zipfile = new zipfile();
				$zipfile -> addFile(fread($fp,filesize(DIR_FS_BACKUP . $backup_file)), $backup_file);
				fclose($fp);
				$fp = fopen(DIR_FS_BACKUP . substr($backup_file, 0, -4).'.zip' ,'w');
				fwrite($fp,$zipfile -> file());
				fclose($fp);
				unlink(DIR_FS_BACKUP . $backup_file);
				$backup_file=DIR_FS_BACKUP . substr($backup_file, 0, -4).'.zip';
			break;
			case 'bzip':
				bzclose($fp);
			break;
		}

        if (isset($_POST['download']) && ($_POST['download'] == 'download' || $_POST['download'] == 'both')) {
          header('Content-type: application/x-octet-stream');
          header('Content-disposition: attachment; filename=' . $backup_file);

          readfile(DIR_FS_BACKUP . $backup_file);
		  
		  if ($_POST['download'] == 'download') {
	          unlink(DIR_FS_BACKUP . $backup_file);
		  }

          exit;
        } else {

          $messageStack->add_session(SUCCESS_DATABASE_SAVED, 'success');
        }

        zen_redirect(zen_href_link(FILENAME_BACKUP));
        break;
      case 'restorenow':
      case 'restorelocalnow':
        zen_set_time_limit(0);		
        if ($action == 'restorenow') {
			//Restore from server file 
            $restore_file = DIR_FS_BACKUP . $_GET['file'];			
            $extension = substr($_GET['file'], -3);
		} elseif ($action == 'restorelocalnow') {
			//Restore from upload
		    $sql_file = new upload('sql_file');
			$sql_file->parse();
		  	  $restore_file = $sql_file->tmp_filename;
			  $extension = substr($sql_file->filename, -3);
		}
		
          if (file_exists($restore_file)) {
            if ( ($extension == 'sql') || $extension == 'txt' || ($extension == '.gz') || ($extension == 'zip') || ($extension == 'bz2') ) {
              switch ($extension) {
                case 'sql':
                case 'txt':
	                $fd = fopen($restore_file, 'rb');
	                $restore_query = fread($fd, filesize($restore_from));
	                fclose($fd);
                  break;
                case '.gz':
					if (@function_exists('gzread')) {
						$GetSize = fopen($restore_file, "rb"); //Get files uncompressed size http://uk.php.net/gzread
				        fseek($GetSize, -4, SEEK_END);
				        $buf = fread($GetSize, 4);
				        $GZFileSize = end(unpack("V", $buf));
				        fclose($GetSize);
		                $fd = gzopen($restore_file, 'rb');
		                $restore_query = gzread($fd, $GZFileSize);
		                gzclose($fd);
					} else {
						$messageStack->add_session(ERROR_DECOMPRESSOR_NOT_AVAILABLE, 'error');
					}
                  break;
                case 'zip':
                    include_once(DIR_WS_CLASSES.'unzip.lib.php');					
                    $zip_handle = new SimpleUnzip();
                    $zip_handle->ReadFile($restore_file);					
                    if ($zip_handle->Count() > 0 && $zip_handle->GetError(0) == 0) {
	                    $restore_query = $zip_handle->GetData(0);
					} else {
						$messageStack->add_session(ERROR_DECOMPRESSOR_NOT_AVAILABLE, 'error');						
					}
                    $zip_handle = ''; //Get rid of zip handle
				  break;
				case 'bz2':
					if (@function_exists('bzread')) {
		                $fd = bzopen($restore_file, 'r');
						$restore_query = '';
						while (!feof($fd)) {
						  $restore_query .= bzread($fd, 4096);
						}
						bzclose($fd);
					} else {
						$messageStack->add_session(ERROR_DECOMPRESSOR_NOT_AVAILABLE, 'error');
					}
				  break;
				case 'default':
				 $messageStack->add_session(ERROR_UNKNOWN_FILE_TYPE, 'error');
              }
			}
		}
        
		// FIX:  entpackt  mit BACKUP_MYSQL_ADMIN_PLUGIN-1.3 erstellte Backupdateien   		
		$firstline= ltrim(substr($restore_query, 0, strpos($restore_query, "\n")));
		if ($firstline[0] != '#' && $extension != 'sql' && isset($restore_query)) {
			$version= false;
			while (strpos($restore_file, ".")) {
				$restore_file= ltrim(substr($restore_file, 0, strpos($restore_file, ".")));
			}
			$restore_file.= '.sql';
			$dateihandle = fopen($restore_file,"w");
			fwrite($dateihandle, $restore_query);
			fclose($dateihandle);
			$restore_file= substr($restore_file, strrpos($restore_file, "/")+1);
			$messageStack->add_session(TEXT_BACKUP_UNCOMPRESSED. $restore_file, 'info');
			unset($restore_query);
		} else {$version=true;}
		// FIX ende
		
        if (isset($restore_query)) {
		  
		  $sql_array = array();
          $sql_length = strlen($restore_query);
          $pos = strpos($restore_query, ';');
          for ($i=$pos; $i<$sql_length; $i++) {
            if ($restore_query[0] == '#'){
              $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));			  
              $sql_length = strlen($restore_query);
              $i = strpos($restore_query, ';')-1;
              continue;
            }
            if ($restore_query[($i+1)] == "\n") {
              for ($j=($i+2); $j<$sql_length; $j++) {
                if (trim($restore_query[$j]) != '') {
                  $next = substr($restore_query, $j, 6);
                  if ($next[0] == '#'){
// find out where the break position is so we can remove this line (#comment line)
                    for ($k=$j; $k<$sql_length; $k++) {
                      if ($restore_query[$k] == "\n") break;
                    }
                    $query = substr($restore_query, 0, $i+1);
                    $restore_query = substr($restore_query, $k);
// join the query before the comment appeared, with the rest of the dump
                    $restore_query = $query . $restore_query;
                    $sql_length = strlen($restore_query);
                    $i = strpos($restore_query, ';')-1;
                    continue 2;
                  }
                  break;
                }
              }
			  
              if ($next == '') { // get the last insert query
                $next = 'insert';
              }
              if ( (eregi('create', $next)) || (eregi('insert', $next)) || (eregi('drop t', $next)) ) {
                $next = '';
                $sql_array[] = substr($restore_query, 0, $i);
                $restore_query = ltrim(substr($restore_query, $i+1));
                $sql_length = strlen($restore_query);
                $i = strpos($restore_query, ';')-1;
              }
            }
          }

          //zen_db_query("drop table if exists address_book, address_format, banners, banners_history, categories, categories_description, configuration, configuration_group, counter, counter_history, countries, currencies, customers, customers_basket, customers_basket_attributes, customers_info, languages, manufacturers, manufacturers_info, orders, orders_products, orders_status, orders_status_history, orders_products_attributes, orders_products_download, products, products_attributes, products_attributes_download, prodcts_description, products_options, products_options_values, products_options_values_to_products_options, products_to_categories, reviews, reviews_description, sessions, specials, tax_class, tax_rates, geo_zones, whos_online, zones, zones_to_geo_zones");
		
          for ($i=0, $n=sizeof($sql_array); $i<$n; $i++) {
            $db->Execute($sql_array[$i]);
          }
		  
          zen_session_close();

		  //$db->Execute("truncate table " . TABLE_WHOS_ONLINE)
		  //$db->Execute("truncate table " . TABLE_SESSIONS)

          $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
          $db->Execute("insert into " . TABLE_CONFIGURATION . " values (null, 'Last Database Restore', 'DB_LAST_RESTORE', '" . $restore_file . "', 'Last database restore file', '6', '', '', now(), '', '')");

          if (isset($remove_raw) && ($remove_raw == true)) {
            unlink($restore_from);
          }

          $messageStack->add_session(SUCCESS_DATABASE_RESTORED, 'success');
        } else {
		  //$messageStack->add_session(ERROR_RESTORE_FAILES, 'error');
          if ($version== true) {$messageStack->add_session(ERROR_RESTORE_FAILES, 'error'); }       
		}
		
        zen_redirect(zen_href_link(FILENAME_BACKUP));
        break;
      case 'download':
        $extension = substr($_GET['file'], -3);

        if ( ($extension == 'zip') || ($extension == '.gz') || ($extension == 'sql') || ($extension == 'bz2') ) {
          if ($fp = fopen(DIR_FS_BACKUP . $_GET['file'], 'rb')) {
            $buffer = fread($fp, filesize(DIR_FS_BACKUP . $_GET['file']));
            fclose($fp);

            header('Content-type: application/x-octet-stream');
            header('Content-disposition: attachment; filename=' . $_GET['file']);

            echo $buffer;

            exit;
          }
        } else {
          $messageStack->add(ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
        }
        break;
      case 'deleteconfirm':
        if (strstr($_GET['file'], '..')) zen_redirect(zen_href_link(FILENAME_BACKUP));

        zen_remove(DIR_FS_BACKUP . '/' . $_GET['file']);

        if (!$zen_remove_error) {
          $messageStack->add_session(SUCCESS_BACKUP_DELETED, 'success');

         // zen_redirect(zen_href_link(FILENAME_BACKUP));
        }
        break;
    }
  }

// check if the backup directory exists
  $dir_ok = false;
  if (is_dir(DIR_FS_BACKUP)) {
    if (is_writeable(DIR_FS_BACKUP)) {
      $dir_ok = true;
    } else {
      $messageStack->add(ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE, 'error');
    }
  } else {
    $messageStack->add(ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TITLE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FILE_DATE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_FILE_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  if ($dir_ok == true) {
    $dir = dir(DIR_FS_BACKUP);
    $contents = array();
    while ($file = $dir->read()) {
      if (!is_dir(DIR_FS_BACKUP . $file) && (preg_match('/^db_(.+)(sql|zip|gz|bz2)$/', $file) > 0)) {
        $contents[] = $file;
      }
    }
    sort($contents);

    for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
      $entry = $contents[$i];
      $check = 0;

      if ((!isset($_GET['file']) || (isset($_GET['file']) && ($_GET['file'] == $entry))) && !isset($buInfo) && ($action != 'backup') && ($action != 'restorelocal')) {
        $file_array['file'] = $entry;
        $file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry));
        $file_array['size'] = number_format(filesize(DIR_FS_BACKUP . $entry)) . ' bytes';
        switch (substr($entry, -3)) {
          case 'zip': $file_array['compression'] = 'ZIP'; break;
          case '.gz': $file_array['compression'] = 'GZIP'; break;
          case 'bz2': $file_array['compression'] = 'BZIP2'; break;
         default: $file_array['compression'] = TEXT_NO_EXTENSION; break;
        }
        $buInfo = new objectInfo($file_array);
      }

      if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        $onclick_link = 'file=' . $buInfo->file . '&action=restore';
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        $onclick_link = 'file=' . $entry;
      }
?>
                <td class="dataTableContent" onclick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP, $onclick_link); ?>'"><?php echo '<a href="' . zen_href_link(FILENAME_BACKUP, 'action=download&file=' . $entry) . '">' . zen_image(DIR_WS_ICONS . 'file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td>
                <td class="dataTableContent" align="center" onclick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP, $onclick_link); ?>'"><?php echo date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry)); ?></td>
                <td class="dataTableContent" align="right" onclick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP, $onclick_link); ?>'"><?php echo number_format(filesize(DIR_FS_BACKUP . $entry)); ?> bytes</td>
                <td class="dataTableContent" align="right"><?php if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_BACKUP, 'file=' . $entry) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
    $dir->close();
  }
?>
              <tr>
                <td class="smallText" colspan="3"><?php echo TEXT_BACKUP_DIRECTORY . ' ' . DIR_FS_BACKUP; ?></td>
                <td align="right" class="smallText"><?php if ( ($action != 'backup') && (isset($dir)) ) echo '<a href="' . zen_href_link(FILENAME_BACKUP, 'action=backup') . '">' . zen_image_button('button_backup.gif', IMAGE_BACKUP) . '</a>'; if ( ($action != 'restorelocal') && isset($dir) ) echo '&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP, 'action=restorelocal') . '">' . zen_image_button('button_restore.gif', IMAGE_RESTORE) . '</a>'; ?></td>
              </tr>
<?php
  if (defined('DB_LAST_RESTORE')) {
?>
              <tr>
                <td class="smallText" colspan="4"><?php echo TEXT_LAST_RESTORATION . ' ' . DB_LAST_RESTORE . ' <a href="' . zen_href_link(FILENAME_BACKUP, 'action=forget') . '">' . TEXT_FORGET . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'backup':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_BACKUP . '</b>');

      $contents = array('form' => zen_draw_form('backup', FILENAME_BACKUP, 'action=backupnow'));
      $contents[] = array('text' => TEXT_INFO_NEW_BACKUP);

      $contents[] = array('text' => '<br>' . zen_draw_radio_field('compress', 'no', (@function_exists('gzencode')?false:true)) . ' ' . TEXT_INFO_USE_NO_COMPRESSION);
      if (@function_exists('gzencode')) $contents[] = array('text' => '' . zen_draw_radio_field('compress', 'gzip',true) . ' ' . TEXT_INFO_USE_GZIP);
      if (@function_exists('bzcompress')) $contents[] = array('text' => '' . zen_draw_radio_field('compress', 'bzip') . ' ' . TEXT_INFO_USE_BZIP);
      $contents[] = array('text' => zen_draw_radio_field('compress', 'zip') . ' ' . TEXT_INFO_USE_ZIP);

      if ($dir_ok == true) {
        $contents[] = array('text' => '<br>' . zen_draw_radio_field('download', 'save' , true) . ' ' . TEXT_INFO_SAVE_ONLY . '');
        $contents[] = array('text' => zen_draw_radio_field('download', 'both') . ' ' . TEXT_INFO_DOWNLOAD_AND_SAVE . '*');
        $contents[] = array('text' => zen_draw_radio_field('download', 'download') . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br><br>*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      } else {
        $contents[] = array('text' => '<br>' . zen_draw_radio_field('download', 'yes', true) . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br><br>*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      }

      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_backup.gif', IMAGE_BACKUP) . '&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restore':
      $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

      $contents[] = array('text' => zen_break_string(sprintf(TEXT_INFO_RESTORE, DIR_FS_BACKUP . (($buInfo->compression != TEXT_NO_EXTENSION) ? substr($buInfo->file, 0, strrpos($buInfo->file, '.')) : $buInfo->file), ($buInfo->compression != TEXT_NO_EXTENSION) ? TEXT_INFO_UNPACK : ''), 35, ' '));
      $contents[] = array('align' => 'center', 'text' => '<br><a href="' . zen_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=restorenow') . '">' . zen_image_button('button_restore.gif', IMAGE_RESTORE) . '</a>&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restorelocal':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_RESTORE_LOCAL . '</b>');

      $contents = array('form' => zen_draw_form('restore', FILENAME_BACKUP, 'action=restorelocalnow', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br><br>' . TEXT_INFO_BEST_THROUGH_HTTPS);
      $contents[] = array('text' => '<br>' . zen_draw_file_field('sql_file'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL_RAW_FILE);
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_restore.gif', IMAGE_RESTORE) . '&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

      $contents = array('form' => zen_draw_form('delete', FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $buInfo->file . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($buInfo) && is_object($buInfo)) {
        $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=restore') . '">' . zen_image_button('button_restore.gif', IMAGE_RESTORE) . '</a> <a href="' . zen_href_link(FILENAME_BACKUP, 'file=' . $buInfo->file . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE . ' ' . $buInfo->date);
        $contents[] = array('text' => TEXT_INFO_SIZE . ' ' . $buInfo->size);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COMPRESSION . ' ' . $buInfo->compression);
      }
      break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
