<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: email_export.php 2024-01-30 20:01:17Z webchills $
 */

require('includes/application_top.php');

// change destination here for path when using "save to file on server"
if (!defined('DIR_FS_EMAIL_EXPORT')) define('DIR_FS_EMAIL_EXPORT',DIR_FS_CATALOG.'images/uploads/');

  $query_name = '';

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
//if ($action == 'save') die(print_r($_POST, true));
  $NL="
"; // NOTE: The line break above is INTENTIONAL!

  $available_export_formats[0]=array('id' => '0', 'text' => 'CSV');
  $available_export_formats[1]=array('id' => '1', 'text' => 'TXT');
  $available_export_formats[2]=array('id' => '2', 'text' => 'HTML');
  $available_export_formats[3]=array('id' => '3', 'text' => 'XML');
  $save_to_file_checked=(isset($_POST['savetofile']) && zen_not_null($_POST['savetofile']) ? $_POST['savetofile'] : 0 );
  $post_format = (isset($_POST['format']) && zen_not_null($_POST['format']) ? $_POST['format'] : 1 );
  $format = $available_export_formats[$post_format]['text'];
  $file = (isset($_POST['filename']) ? $_POST['filename'] : 'email_addresses.txt');
  if (!preg_match('/.*\.(csv|txt|html?|xml)$/', $file)) $file .= '.txt';

  if ($action != '') {
    switch ($action) {
      case 'save':
      global $db;

  if ($format =='CSV') {
    $FIELDSTART = '"';
    $FIELDEND = '"';
    $FIELDSEPARATOR = ',';
    $LINESTART = '';
    $LINEBREAK = "\n";
  }
  if ($format =='TXT') {
    $FIELDSTART = '';
    $FIELDEND = '';
    $FIELDSEPARATOR = "\t";
    $LINESTART = '';
    $LINEBREAK = "\n";
  }
  if ($format =='HTML') {
    $FIELDSTART = '<td>';
    $FIELDEND = '</td>';
    $FIELDSEPARATOR = "";
    $LINESTART = "<tr>";
    $LINEBREAK = "</tr>".$NL;
  }

  if (isset($_POST['audience_selected'])) {
    $query_name=$_POST['audience_selected'];
    if (is_array($_POST['audience_selected']))  $query_name=$_POST['audience_selected']['text'];
  }
  if ($query_name == '') {
    $messageStack->add('Please select an option', 'error');
    break;
  }
/**
 * CUSTOMIZATION STEP 1:
 * 1. You must edit (or add to) the queries in the query_builder table if you want to add more fields to the extracted data.
 *    Look up your query_name (since this matches the pulldown in your admin), and update the query_string with the correct updated SQL query.
 *    Once the query in query_builder has been updated and tested, the following section of code will automatically
 *    bring in the right data for use in later steps.
 */
      $audience_select = get_audience_sql_query($query_name, 'newsletters');
      if (empty($audience_select['query_string'])) {
         $messageStack->add_session("No such query.", 'error');
         zen_redirect(zen_href_link(FILENAME_EMAIL_EXPORT));
      }
      $query_string = $audience_select['query_string'];
      $audience = $db->Execute($query_string);
      $records = $audience->RecordCount();
      if ($records==0) {
        $messageStack->add_session("No Records Found.", 'error');
      } else { //process records
        $i=0;

        // make a <table> tag if HTML output
        if ($format == "HTML") {
          $exporter_output .= '<table border="1">'.$NL;
        }

/**
 * CUSTOMIZATION STEP 2:
 * 2. You must add your field name to this list.
 *    Notice how head heading here involves two lines: FIELDSTART, then the heading, then FIELDEND, followed by line for the FIELDSEPARATOR if it's not the last field being output.
 *    Be sure to follow the same pattern.
 *    Best to only use letters/numbers and underscores. No other punctuation.
 */

        // add column headers if CSV or HTML format
          if ($format == "CSV" || $format == "HTML") {
            $exporter_output .=  $LINESTART;
            $exporter_output .=  $FIELDSTART . "customers_email_address".$FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . "customers_firstname".$FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . "customers_lastname".$FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . "company_name".$FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . "customers_telephone".$FIELDEND;
            $exporter_output .=  $LINEBREAK;
          }
          // headers - XML
          if ($format == "XML") {
            $exporter_output .=  '<?xml version="1.0" encoding="' . CHARSET . '"?>'."\n";
          }

        // output real data
        while (!$audience->EOF) {
          $i++;

/**
 * CUSTOMIZATION STEP 3:
 * 3. Add the new field to the output.
 *    The field's data is represented as: $audience->fields['FIELD_NAME_HERE'], as seen in the existing fields below.
 *    Be sure to add it for both the XML format and the non-XML format, for consistency.  Again, follow the pattern.
 */
          if ($format=="XML") {
            $exporter_output .=  "<address_book>\n";
            $exporter_output .=  "  <contact>\n";
            $exporter_output .=  "    <firstname>" . $audience->fields['customers_firstname'] . "</firstname>\n";
            $exporter_output .=  "    <lastname>" .$audience->fields['customers_lastname'] . "</lastname>\n";
            $exporter_output .=  "    <email_address>" . $audience->fields['customers_email_address'] . "</email_address>\n";
            $exporter_output .=  "    <company>" .$audience->fields['entry_company'] . "</company>\n";
            $exporter_output .=  "    <telephone>" .$audience->fields['customers_telephone'] . "</telephone>\n";
            $exporter_output .=  "  </contact>\n";
          } else {  // output non-XML data-format
            $exporter_output .=  $LINESTART;
            $exporter_output .=  $FIELDSTART . $audience->fields['customers_email_address'] . $FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . $audience->fields['customers_firstname'] . $FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . $audience->fields['customers_lastname'] . $FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . $audience->fields['entry_company'] . $FIELDEND;
            $exporter_output .=  $FIELDSEPARATOR;
            $exporter_output .=  $FIELDSTART . $audience->fields['customers_telephone'] . $FIELDEND;
            $exporter_output .=  $LINEBREAK;
          }


        $audience->MoveNext();
        }

        if ($format == "HTML") {
          $exporter_output .=  $NL."</table>";
        }
        if ($format == "XML") {
          $exporter_output .=  "</address_book>\n";
        }


    // theoretically, $i should == $records at this point.

      // status message
      $messageStack->add($records . " Processed.", 'success');

      // begin streaming file contents
      if ($save_to_file_checked != 1) { // not saving to a file, so do regular output
        if ($format == "CSV" || $format =="TXT" || $format=="XML") {
          if ($format == "CSV" || $format =="TXT") {
            $content_type = 'text/x-csv';
          } elseif ($format == "XML") {
            $content_type = 'text/xml; charset='.CHARSET;
          }
          if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) {
            header('Content-Type: application/octetstream');
//            header('Content-Type: '.$content_type);
//              header('Content-Disposition: inline; filename="' . $file . '"');
            header('Content-Disposition: attachment; filename=' . $file);
            header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: must_revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
            header("Cache-control: private");
          } else {
            header('Content-Type: application/x-octet-stream');
//            header('Content-Type: '.$content_type);
            header('Content-Disposition: attachment; filename=' . $file);
            header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Pragma: no-cache");
          }
          echo $exporter_output;
          exit;
        } else {
          echo $exporter_output;
          exit;
        }
      } else { //write to file
        //open output file for writing
        $f=fopen(DIR_FS_EMAIL_EXPORT.$file,'w');
        fwrite($f,$exporter_output);
        fclose($f);
        unset($f);
      } // endif $save_to_file
    } //end if $records for processing not 0

    zen_redirect(zen_href_link(FILENAME_EMAIL_EXPORT));
    break;

    }  //end switch / case

  }  //endif $action

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>

    
  </head>
<body>
      <!-- header //-->
      <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
      <!-- header_eof //-->
      <div class="container-fluid">
        <!-- body //-->
        <h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
 <div class="row"><?php echo TEXT_INSTRUCTIONS; ?>
 	<br><br><?php echo zen_draw_form('export', FILENAME_EMAIL_EXPORT, 'action=save','post');//, 'onsubmit="return check_form(export);"'); ?>
        <?php echo TEXT_EMAIL_EXPORT_FORMAT; ?><br>
<?php echo zen_draw_pull_down_menu('format', $available_export_formats, $format); ?>
<br><br>
<?php echo TEXT_PLEASE_SELECT_AUDIENCE; ?><br>
<?php echo zen_draw_pull_down_menu('audience_selected', get_audiences_list('newsletters'), $query_name)?>
<br><br>
<?php echo TEXT_EMAIL_EXPORT_FILENAME; ?><br>
<?php echo zen_draw_input_field('filename', htmlspecialchars($file, ENT_COMPAT, CHARSET, TRUE), ' size="60"'); ?>
<br><br>
<?php echo TEXT_EMAIL_EXPORT_SAVETOFILE; ?><br>
<?php echo zen_draw_checkbox_field('savetofile', '1', $save_to_file_checked);
      echo TEXT_EMAIL_EXPORT_DEST . ' ' .DIR_FS_EMAIL_EXPORT; ?>
    </div>
    <br><br>
    <div class="row">
           <div class="form-group">
          <div class="col-sm-12 text-left"><button type="submit" class="btn btn-primary"><?php echo IMAGE_EXPORT; ?></button> <a href="<?php echo zen_href_link(FILENAME_EMAIL_EXPORT) ?>" class="btn btn-default" role="button"><?php echo IMAGE_CANCEL; ?></a></div>
        </div>
          
    </form>
 <!-- body_text_eof //-->
</div>
<!-- body_eof //-->
<?php require DIR_WS_INCLUDES . 'footer.php'; ?>
</body>
</html>
<?php require DIR_WS_INCLUDES . 'application_bottom.php'; ?>