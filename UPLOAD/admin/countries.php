<?php
/**
 * Zen Cart German Specific
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: countries.php 792 2020-07-08 20:57:51Z webchills $
 */

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

// BOF mehrsprachige Lšndernamen 1 of 9
  $languages = zen_get_languages();
// EOF mehrsprachige Lšndernamen 1 of 9
  if (zen_not_null($action)) {
    switch ($action) {
      case 'insert':
        // BOF mehrsprachige Lšndernamen 2 of 9
        //$countries_name = zen_db_prepare_input($_POST['countries_name']);
        // EOF mehrsprachige Lšndernamen 2 of 9
        $countries_iso_code_2 = strtoupper(zen_db_prepare_input($_POST['countries_iso_code_2']));
        $countries_iso_code_3 = strtoupper(zen_db_prepare_input($_POST['countries_iso_code_3']));
        $address_format_id = zen_db_prepare_input($_POST['address_format_id']);
        $status = $_POST['status'] == 'on' ? 1 : 0;

// BOF mehrsprachige Lšndernamen 3 of 9
        $db->Execute("insert into " . TABLE_COUNTRIES . "
                    (countries_iso_code_2, countries_iso_code_3, status, address_format_id)
                    values ('" . zen_db_input($countries_iso_code_2) . "',
                            '" . zen_db_input($countries_iso_code_3) . "',
                            '" . (int)$status . "',
                            '" . (int)$address_format_id . "')");

        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $countries_name_array = $_POST['countries_name'];
          $language_id = $languages[$i]['id'];
          $sql_data_array = array('countries_name' => zen_db_prepare_input($countries_name_array[$language_id]));
          $countries_id_lookup = $db->Execute("SELECT countries_id
                                        FROM " . TABLE_COUNTRIES . "
                                        WHERE countries_iso_code_2 = '" . zen_db_input($countries_iso_code_2) . "'");
          $countries_id = $countries_id_lookup->fields['countries_id'];
          $insert_sql_data = array('countries_id' => $countries_id,
                                   'language_id' => $language_id);

          $sql_data_array_merged = array_merge($sql_data_array, $insert_sql_data);
          zen_db_perform(TABLE_COUNTRIES_NAME, $sql_data_array_merged);
        }
// EOF mehrsprachige Lšndernamen 3 of 9
        zen_record_admin_activity('Country added: ' . $countries_iso_code_3, 'info');
        zen_redirect(zen_href_link(FILENAME_COUNTRIES));
        break;
      case 'save':
        $countries_id = zen_db_prepare_input($_GET['cID']);
        // BOF mehrsprachige Lšndernamen 4 of 9
        //$countries_name = zen_db_prepare_input($_POST['countries_name']);
        // EOF mehrsprachige Lšndernamen 4 of 9
        $countries_iso_code_2 = strtoupper(zen_db_prepare_input($_POST['countries_iso_code_2']));
        $countries_iso_code_3 = strtoupper(zen_db_prepare_input($_POST['countries_iso_code_3']));
        $address_format_id = zen_db_prepare_input($_POST['address_format_id']);
        $status = $_POST['status'] == 'on' ? 1 : 0;

// BOF mehrsprachige Lšndernamen 5 of 9
        $db->Execute("update " . TABLE_COUNTRIES . "
                      set countries_iso_code_2 = '" . zen_db_input($countries_iso_code_2) . "',
                          countries_iso_code_3 = '" . zen_db_input($countries_iso_code_3) . "',
                          address_format_id = '" . (int)$address_format_id . "',
                          status = " . (int)$status . "
                      where countries_id = '" . (int)$countries_id . "'");

        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $countries_name_array = $_POST['countries_name'];
          $language_id = $languages[$i]['id'];
          $sql_data_array = array('countries_name' => zen_db_prepare_input($countries_name_array[$language_id]));

          zen_db_perform(TABLE_COUNTRIES_NAME, $sql_data_array, 'update', "countries_id = '" . (int)$countries_id . "' AND language_id = '" . (int)$language_id . "'");
        }
// EOF mehrsprachige Lšndernamen 5 of 9
        zen_record_admin_activity('Country updated: ' . $countries_iso_code_3, 'info');
        zen_redirect(zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $countries_id));
        break;
      case 'deleteconfirm':        
      $countries_id = zen_db_prepare_input($_POST['cID']);
      $sql = "SELECT entry_country_id
              FROM " . TABLE_ADDRESS_BOOK . "
              WHERE entry_country_id = :countryID:
              LIMIT 1";
        $sql = $db->bindVars($sql, ':countryID:', $countries_id, 'integer');
        $result = $db->Execute($sql);
        if ($result->recordCount() == 0) {
          $db->Execute("delete from " . TABLE_COUNTRIES . "
                      WHERE countries_id = " . (int)$countries_id);
          zen_record_admin_activity('Country deleted: ' . $countries_id, 'warning');
        } else {
          $messageStack->add_session(ERROR_COUNTRY_IN_USE, 'error');
        }
        zen_redirect(zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']));
        break;
      case 'setstatus':
        $countries_id = zen_db_prepare_input($_GET['cID']);
        if (isset($_POST['current_status']) && ($_POST['current_status'] == '0' || $_POST['current_status'] == '1')) {
        $sql = "UPDATE " . TABLE_COUNTRIES . "
                SET status = " . ($_POST['current_status'] == 0 ? 1 : 0) . "
                WHERE countries_id = " . (int)$countries_id;
          $db->Execute($sql);
          zen_record_admin_activity('Country with ID number: ' . $countries_id . ' changed status to ' . ($_POST['current_status'] == 0 ? 1 : 0), 'info');
          zen_redirect(zen_href_link(FILENAME_COUNTRIES, 'cID=' . (int)$countries_id . '&page=' . $_GET['page']));
        }
        $action = '';
        break;
    }
  }
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>
    <script>
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById) {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }
    </script>
  </head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
    <div class="container-fluid">
      <h1><?php echo HEADING_TITLE; ?></h1>
      <div class="text-right"><?php echo ISO_COUNTRY_CODES_LINK; ?></div>

      <!-- body_text //-->
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
          <table class="table table-hover">
            <thead>
              <tr class="dataTableHeadingRow">
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_COUNTRY_NAME; ?></th>
                <th class="dataTableHeadingContent text-center" colspan="2"><?php echo TABLE_HEADING_COUNTRY_CODES; ?></th>
                <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_COUNTRY_STATUS; ?></th>
                <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_ACTION; ?></th>
              </tr>
            </thead>
            <tbody>
<?php
  // BOF mehrsprachige Lšndernamen 6 of 9
  $countries_query_raw = "SELECT c.countries_id, cn.countries_name, c.countries_iso_code_2, c.countries_iso_code_3, c.address_format_id, status
                          FROM " . TABLE_COUNTRIES . " c, " . TABLE_COUNTRIES_NAME . " cn
                          WHERE cn.countries_id = c.countries_id
                          AND cn.language_id = '" . (int)$_SESSION['languages_id'] . "'
                          ORDER BY cn.countries_name";
  // EOF mehrsprachige Lšndernamen 6 of 9
  $countries_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $countries_query_raw, $countries_query_numrows);
  $countries = $db->Execute($countries_query_raw);
                foreach ($countries as $country) {
                  if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $country['countries_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
                    $cInfo = new objectInfo($country);
    }

                  if (isset($cInfo) && is_object($cInfo) && ($country['countries_id'] == $cInfo->countries_id)) {
                    echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href=\'' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=edit') . '\'" role="button">' . "\n";
                  } else {
                    echo '                  <tr class="dataTableRow" onclick="document.location.href=\'' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $country['countries_id']) . '\'" role="button">' . "\n";
                  }
                  ?>
              <td class="dataTableContent"><?php echo zen_output_string_protected($country['countries_name']); ?></td>
              <td class="dataTableContent text-center"><?php echo $country['countries_iso_code_2']; ?></td>
              <td class="dataTableContent text-center"><?php echo $country['countries_iso_code_3']; ?></td>
              <td class="dataTableContent text-center">
                  <?php
                  echo zen_draw_form('setstatus', FILENAME_COUNTRIES, 'action=setstatus&cID=' . $country['countries_id'] . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '') . (isset($_GET['search']) ? '&search=' . $_GET['search'] : ''));
                  if ($country['status'] == '0') {
      $formSRC   = 'icon_red_on.gif';
      $formTITLE = IMAGE_ICON_STATUS_OFF;
    } else {
      $formSRC   = 'icon_green_on.gif';
      $formTITLE = IMAGE_ICON_STATUS_ON;
    }
?>
                    <input type="image" src="<?php echo DIR_WS_IMAGES . $formSRC; ?>" alt="<?php echo $formTITLE; ?>" />
                <input type="hidden" name="current_status" value="<?php echo $country['status']; ?>" />
                <?php echo '</form>'; ?>
              </td>
              <td class="dataTableContent text-right"><?php
                  if (isset($cInfo) && is_object($cInfo) && ($country['countries_id'] == $cInfo->countries_id)) {
                    echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                  } else {
                    echo '<a href="' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $country['countries_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                  }
                  ?>&nbsp;</td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 configurationColumnRight">
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
                $heading[] = array('text' => '<h4>' . TEXT_INFO_HEADING_NEW_COUNTRY . '</h4>');
                $contents = array('form' => zen_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=insert', 'post', 'class="form-horizontal"'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      // BOF mehrsprachige Lšndernamen 7 of 9
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME);
      for ($i=0, $n=sizeof($languages); $i<$n; $i++){
        $contents[] = array('text' => '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('countries_name[' . $languages[$i]['id'] . ']'));
      }
      // EOF mehrsprachige Lšndernamen 7of 9
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_COUNTRY_CODE_2, 'countries_iso_code_2', 'class="control-label"') . zen_draw_input_field('countries_iso_code_2', '', 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_COUNTRY_CODE_3, 'countries_iso_code_3', 'class="control-label"') . zen_draw_input_field('countries_iso_code_3', '', 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_ADDRESS_FORMAT, 'address_format_id', 'class="control-label"') . zen_draw_pull_down_menu('address_format_id', zen_get_address_formats(), '', 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_COUNTRY_STATUS, 'status', 'class="control-label"') . zen_draw_checkbox_field('status', '', true, 'class="form-control"'));
                $contents[] = array('align' => 'text-center', 'text' => '<br><button type="submit" class="btn btn-primary">' . IMAGE_INSERT . '</button> <a href="' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
      break;
    case 'edit':
                $heading[] = array('text' => '<h4>' . TEXT_INFO_HEADING_EDIT_COUNTRY . '</h4>');

                $contents = array('form' => zen_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=save', 'post', 'class="form-horizontal"'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      // BOF mehrsprachige Lšndernamen 8 of 9
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME);
      for ($i=0, $n=sizeof($languages); $i<$n; $i++){
        $contents[] = array('text' => '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('countries_name[' . $languages[$i]['id'] . ']', htmlspecialchars(zen_get_country_name($cInfo->countries_id, $languages[$i]['id']), ENT_COMPAT, CHARSET, TRUE)));
      }
      // EOF mehrsprachige Lšndernamen 8 of 9
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_COUNTRY_CODE_2, 'countries_iso_code_2', 'class="control-label"') . zen_draw_input_field('countries_iso_code_2', $cInfo->countries_iso_code_2, 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_COUNTRY_CODE_3, 'countries_iso_code_3', 'class="control-label"') . zen_draw_input_field('countries_iso_code_3', $cInfo->countries_iso_code_3, 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_ADDRESS_FORMAT, 'address_format_id', 'class="control-label"') . zen_draw_pull_down_menu('address_format_id', zen_get_address_formats(), $cInfo->address_format_id, 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_INFO_COUNTRY_STATUS, 'status', 'class="control-label"') . zen_draw_checkbox_field('status', '', $cInfo->status));
                $contents[] = array('align' => 'text-center', 'text' => '<br><button type="submit" class="btn btn-primary">' . IMAGE_UPDATE . '</button> <a href="' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
      break;
    case 'delete':
                $heading[] = array('text' => '<h4>' . TEXT_INFO_HEADING_DELETE_COUNTRY . '</h4>');
      $contents = array('form' => zen_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=deleteconfirm') . zen_draw_hidden_field('cID', $cInfo->countries_id));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . zen_output_string_protected($cInfo->countries_name) . '</b>');
                $contents[] = array('align' => 'text-center', 'text' => '<br><button type="submit" class="btn btn-danger">' . IMAGE_UPDATE . '</button> <a href="' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
                  $heading[] = array('text' => '<h4>' . zen_output_string_protected($cInfo->countries_name) . '</h4>');
                  $contents[] = array('align' => 'text-center', 'text' => '<a href="' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=edit') . '" class="btn btn-primary" role="button">' . IMAGE_EDIT . '</a> <a href="' . zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=delete') . '" class="btn btn-warning" role="button">' . IMAGE_DELETE . '</a>');
        // BOF mehrsprachige Lšndernamen 9 of 9
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME);
        for ($i=0, $n=sizeof($languages); $i<$n; $i++){
          $contents[] = array('text' => '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_output_string_protected(zen_get_country_name($cInfo->countries_id, $languages[$i]['id'])));
        }
        // EOF mehrsprachige Lšndernamen 9 of 9
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . ' ' . $cInfo->countries_iso_code_2);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . ' ' . $cInfo->countries_iso_code_3);
        $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . ' ' . $cInfo->address_format_id);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_STATUS . ' ' . ($cInfo->status == 0 ? TEXT_NO : TEXT_YES));
      }
      break;
  }

            if ((zen_not_null($heading)) && (zen_not_null($contents))) {
              $box = new box;
              echo $box->infoBox($heading, $contents);
            }
            ?>
        </div>
        <!-- body_text_eof //-->
      </div>

      <div class="row">
        <table class="table">
          <tr>
            <td><?php echo $countries_split->display_count($countries_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES); ?></td>
            <td class="text-right"><?php echo $countries_split->display_links($countries_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
          </tr>
          <?php
          if (empty($action)) {
            ?>
            <tr>
              <td colspan="2" class="text-right"><a href="<?php echo zen_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&action=new'); ?>" class="btn btn-primary" role="button"><?php echo IMAGE_NEW_COUNTRY; ?></a></td>
            </tr>
            <?php
          }
          ?>
        </table>
      </div>
    </div>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
