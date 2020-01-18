<?php
/**
 * @package admin
 * Zen Cart German Specific
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: manufacturers.php 790 2020-01-18 08:15:51Z webchills $
 */
require('includes/application_top.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');
$languages = zen_get_languages();
if (zen_not_null($action)) {
  switch ($action) {
    case 'insert':
    case 'save':
      if (isset($_GET['mID'])) {
        $manufacturers_id = zen_db_prepare_input($_GET['mID']);
      }
      $manufacturers_name = zen_db_prepare_input($_POST['manufacturers_name']);

      $sql_data_array = array('manufacturers_name' => $manufacturers_name);

      if ($action == 'insert') {
        $insert_sql_data = array('date_added' => 'now()');

        $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

        zen_db_perform(TABLE_MANUFACTURERS, $sql_data_array);
        $manufacturers_id = zen_db_insert_id();
      } elseif ($action == 'save') {
        $update_sql_data = array('last_modified' => 'now()');

        $sql_data_array = array_merge($sql_data_array, $update_sql_data);

        zen_db_perform(TABLE_MANUFACTURERS, $sql_data_array, 'update', "manufacturers_id = " . (int)$manufacturers_id);
      }


      if ($_POST['manufacturers_image_manual'] != '') {
        // add image manually
        $manufacturers_image_name = zen_db_input($_POST['img_dir'] . $_POST['manufacturers_image_manual']);
        $db->Execute("UPDATE " . TABLE_MANUFACTURERS . "
                      SET manufacturers_image = '" . $manufacturers_image_name . "'
                      WHERE manufacturers_id = " . (int)$manufacturers_id);
      } else {
        $manufacturers_image = new upload('manufacturers_image');
        $manufacturers_image->set_extensions(array('jpg', 'jpeg', 'gif', 'png', 'webp', 'flv', 'webm', 'ogg'));
        $manufacturers_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['img_dir']);
        if ($manufacturers_image->parse() && $manufacturers_image->save()) {
          if ($manufacturers_image->filename != 'none') {
            $db_filename = zen_limit_image_filename($manufacturers_image->filename, TABLE_MANUFACTURERS, 'manufacturers_image');
            $db->Execute("UPDATE " . TABLE_MANUFACTURERS . "
                          SET manufacturers_image = '" . zen_db_input($_POST['img_dir'] . $db_filename) . "'
                          WHERE manufacturers_id = " . (int)$manufacturers_id);
          } else {
              // remove image from database if 'none'
            $db->Execute("UPDATE " . TABLE_MANUFACTURERS . "
                          SET manufacturers_image = ''
                          WHERE manufacturers_id = " . (int)$manufacturers_id);
          }
        }
      }

      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $manufacturers_url_array = $_POST['manufacturers_url'];
        $language_id = $languages[$i]['id'];

        $sql_data_array = array('manufacturers_url' => zen_db_prepare_input($manufacturers_url_array[$language_id]));

        if ($action == 'insert') {
          $insert_sql_data = array(
            'manufacturers_id' => $manufacturers_id,
            'languages_id' => $language_id);

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          zen_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array);
        } elseif ($action == 'save') {
          zen_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array, 'update', "manufacturers_id = " . (int)$manufacturers_id . " and languages_id = " . (int)$language_id);
        }
      }

      zen_redirect(zen_href_link(FILENAME_MANUFACTURERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'mID=' . $manufacturers_id));
      break;
    case 'deleteconfirm':
      $manufacturers_id = zen_db_prepare_input($_POST['mID']);

      if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {
        $manufacturer = $db->Execute("SELECT manufacturers_image
                                      FROM " . TABLE_MANUFACTURERS . "
                                      WHERE manufacturers_id = " . (int)$manufacturers_id);

        $image_location = DIR_FS_CATALOG_IMAGES . $manufacturer->fields['manufacturers_image'];

        if (file_exists($image_location)) {
          @unlink($image_location);
        }
      }

      $db->Execute("DELETE FROM " . TABLE_MANUFACTURERS . "
                    WHERE manufacturers_id = " . (int)$manufacturers_id);
      $db->Execute("DELETE FROM " . TABLE_MANUFACTURERS_INFO . "
                    WHERE manufacturers_id = " . (int)$manufacturers_id);
      $db->Execute ("DELETE FROM " . TABLE_MANUFACTURERS_META . " 
                    WHERE manufacturers_id = " . (int)$manufacturers_id);


      if (isset($_POST['delete_products']) && ($_POST['delete_products'] == 'on')) {
        $products = $db->Execute("SELECT products_id
                                  FROM " . TABLE_PRODUCTS . "
                                  WHERE manufacturers_id = " . (int)$manufacturers_id);

        foreach ($products as $product) {
          zen_remove_product($product['products_id']);
        }
      } else {
        $db->Execute("UPDATE " . TABLE_PRODUCTS . "
                      SET manufacturers_id = 0
                      WHERE manufacturers_id = " . (int)$manufacturers_id);
      }

      zen_redirect(zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page']));
      
      break;
  

      case 'update_manufacturer_meta_tags': 
        $manufacturers_id = (int)$_POST['manufacturer_id'];
        $languages = zen_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $language_id = (int)$languages[$i]['id'];
          $metatags_title = zen_db_prepare_input($_POST['metatags_title'][$language_id]);
          $metatags_keywords = zen_db_prepare_input($_POST['metatags_keywords'][$language_id]);
          $metatags_description = zen_db_prepare_input($_POST['metatags_description'][$language_id]);
          if ( zen_not_null ($metatags_title) || zen_not_null ($metatags_keywords) || zen_not_null ($metatags_description) ) {
            $sql_data_array = array('metatags_title' => $metatags_title,
                                    'metatags_keywords' => $metatags_keywords,
                                    'metatags_description' => $metatags_description);
            $check = $db->Execute("SELECT * FROM " . TABLE_MANUFACTURERS_META . " WHERE manufacturers_id = $manufacturers_id AND language_id = $language_id LIMIT 1");
            if ($check->EOF) {
              $sql_data_array['manufacturers_id'] = $manufacturers_id;
              $sql_data_array['language_id'] = $language_id;
              zen_db_perform (TABLE_MANUFACTURERS_META, $sql_data_array);
              
            } else {
              zen_db_perform (TABLE_MANUFACTURERS_META, $sql_data_array, 'update', "manufacturers_id = $manufacturers_id AND language_id = $language_id LIMIT 1");
              
            }
          } else {
            $db->Execute ("DELETE FROM " . TABLE_MANUFACTURERS_META . " WHERE manufacturers_id = $manufacturers_id AND language_id = $language_id LIMIT 1");
            
          }
        }
        zen_redirect (zen_href_link (FILENAME_MANUFACTURERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'mID=' . $manufacturers_id));
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
    <div class="container-fluid">
      <!-- body //-->
      <h1><?php echo HEADING_TITLE; ?></h1>
      <div class="row">
        <!-- body_text //-->
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
          <table class="table table-hover">
            <thead>
              <tr class="dataTableHeadingRow">
                <th class="dataTableHeadingContent">&nbsp;</th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_MANUFACTURERS; ?></th>
                <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $manufacturers_query_raw = "select manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified
                                            from " . TABLE_MANUFACTURERS . "
                                            order by manufacturers_name";

// reset page when page is unknown
                if ((empty($_GET['page']) || $_GET['page'] == '1') && !empty($_GET['mID'])) {
                  $check_page = $db->Execute($manufacturers_query_raw);
                  $check_count = 1;
                  if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS) {
                    foreach ($check_page as $item) {
                      if ($item['manufacturers_id'] == $_GET['mID']) {
                        break;
                      }
                      $check_count++;
                    }
                    $_GET['page'] = round((($check_count / MAX_DISPLAY_SEARCH_RESULTS) + (fmod_round($check_count, MAX_DISPLAY_SEARCH_RESULTS) != 0 ? .5 : 0)), 0);
                  } else {
                    $_GET['page'] = 1;
                  }
                }

                $manufacturers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $manufacturers_query_raw, $manufacturers_query_numrows);
                $manufacturers = $db->Execute($manufacturers_query_raw);
                foreach ($manufacturers as $manufacturer) {
                  if ((!isset($_GET['mID']) || (isset($_GET['mID']) && ($_GET['mID'] == $manufacturer['manufacturers_id']))) && !isset($mInfo) && (substr($action, 0, 3) != 'new')) {
                    $manufacturer_products = $db->Execute("SELECT COUNT(*) AS products_count
                                                           FROM " . TABLE_PRODUCTS . "
                                                           WHERE manufacturers_id = " . (int)$manufacturer['manufacturers_id']);

                    $mInfo_array = array_merge($manufacturer, $manufacturer_products->fields);
                    $mInfo = new objectInfo($mInfo_array);
                  }

                  if (isset($mInfo) && is_object($mInfo) && ($manufacturer['manufacturers_id'] == $mInfo->manufacturers_id)) {
                    echo '              <tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href=\'' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturer['manufacturers_id'] . '&action=edit') . '\'" role="button">' . "\n";
                  } else {
                    echo '              <tr class="dataTableRow" onclick="document.location.href=\'' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturer['manufacturers_id'] . '&action=edit') . '\'" role="button">' . "\n";
                  }
                  ?>
              <td class="dataTableContent"><?php echo $manufacturer['manufacturers_id']; ?></td>
              <td class="dataTableContent"><?php echo $manufacturer['manufacturers_name']; ?></td>
              <td class="dataTableContent" align="right">
                  <?php echo '<a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturer['manufacturers_id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>'; ?>
                  <?php echo '<a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturer['manufacturers_id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>'; ?>
                  <?php

    if (zen_get_manufacturer_metatags_keywords ($manufacturers->fields['manufacturers_id'], $_SESSION['languages_id']) != '' || zen_get_manufacturer_metatags_description ($manufacturers->fields['manufacturers_id'], $_SESSION['languages_id']) != '' || zen_get_manufacturer_metatags_title ($manufacturers->fields['manufacturers_id'], $_SESSION['languages_id']) != '') {
      $metatags_icon = zen_image(DIR_WS_IMAGES . 'icon_edit_metatags_on.gif', ICON_METATAGS_ON);
      
    } else {
      $metatags_icon = zen_image(DIR_WS_IMAGES . 'icon_edit_metatags_off.gif', ICON_METATAGS_OFF);
      
    }
    echo '<a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $manufacturers->fields['manufacturers_id'] . '&action=edit_manufacturer_meta_tags') . '">' . $metatags_icon . '</a>';

?>

				  <?php
                  if (isset($mInfo) && is_object($mInfo) && ($manufacturer['manufacturers_id'] == $mInfo->manufacturers_id)) {
                    echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                  } else {
                    echo '<a href="' . zen_href_link(FILENAME_MANUFACTURERS, zen_get_all_get_params(array('mID')) . 'mID=' . $manufacturer['manufacturers_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
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

    case 'edit_manufacturer_meta_tags': {
      $manufacturers_id = (int)zen_db_prepare_input($_GET['mID']);
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_EDIT_MANUFACTURER_META_TAGS . '</strong>');
      $contents = array('form' => zen_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'action=update_manufacturer_meta_tags&mID=' . $manufacturers_id, 'post', 'enctype="multipart/form-data"') . zen_draw_hidden_field('manufacturer_id', $manufacturers_id ));
      $contents[] = array('text' => TEXT_EDIT_MANUFACTURER_META_TAGS_INTRO . ' - <strong>' . $manufacturers_id  . ' ' . $mInfo->manufacturers_name . '</strong>');

      $languages = zen_get_languages();

      $manufacturer_inputs_string_metatags_title = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {    
        $manufacturer_inputs_string_metatags_title .= '<br />' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('metatags_title[' . $languages[$i]['id'] . ']', zen_get_manufacturer_metatags_title($manufacturers_id , $languages[$i]['id']), zen_set_field_length(TABLE_MANUFACTURERS_META, 'metatags_title'));
        
      }
      $contents[] = array('text' => '<br />' . TEXT_EDIT_MANUFACTURER_META_TAGS_TITLE . $manufacturer_inputs_string_metatags_title);

      $manufacturer_inputs_string_metatags_keywords = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $manufacturer_inputs_string_metatags_keywords .= '<br />' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;';
        $manufacturer_inputs_string_metatags_keywords .= zen_draw_textarea_field('metatags_keywords[' . $languages[$i]['id'] . ']', 'soft', '100%', '20', zen_get_manufacturer_metatags_keywords($manufacturers_id , $languages[$i]['id']));
      }
      $contents[] = array('text' => '<br />' . TEXT_EDIT_MANUFACTURER_META_TAGS_KEYWORDS . $manufacturer_inputs_string_metatags_keywords);

      $manufacturer_inputs_string_metatags_description = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $manufacturer_inputs_string_metatags_description .= '<br />' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' ;
        $manufacturer_inputs_string_metatags_description .= zen_draw_textarea_field('metatags_description[' . $languages[$i]['id'] . ']', 'soft', '100%', '20', zen_get_manufacturer_metatags_description($manufacturers_id , $languages[$i]['id']));
      }
      $contents[] = array('text' => '<br />' . TEXT_EDIT_MANUFACTURERS_META_TAGS_DESCRIPTION.$manufacturer_inputs_string_metatags_description);

      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_MANUFACTURERS, '&mID=' . $manufacturers_id ) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    }

              case 'new':
                $heading[] = array('text' => '<h4>' . TEXT_HEADING_NEW_MANUFACTURER . '</h4>');

                $contents = array('form' => zen_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'action=insert', 'post', 'enctype="multipart/form-data" class="form-horizontal"'));
                $contents[] = array('text' => TEXT_NEW_INTRO);
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_MANUFACTURERS_NAME, 'manufacturers_name', 'class="control-label"') . zen_draw_input_field('manufacturers_name', '', zen_set_field_length(TABLE_MANUFACTURERS, 'manufacturers_name') . 'class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_MANUFACTURERS_IMAGE, 'manufacturers_image', 'class="control-label"') . zen_draw_file_field('manufacturers_image'));
                $dir_info = zen_build_subdirectories_array(DIR_FS_CATALOG_IMAGES);
                $default_directory = 'manufacturers/';

                $contents[] = array('text' => '<BR />' . zen_draw_label(TEXT_PRODUCTS_IMAGE_DIR, 'img_dir', 'class="control-label"') . zen_draw_pull_down_menu('img_dir', $dir_info, $default_directory, 'class="form-control"'));

                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_MANUFACTURERS_IMAGE_MANUAL, 'manufacturers_image_manual', 'class="control-label"') . zen_draw_input_field('manufacturers_image_manual', '', 'class="form-control"'));

                $manufacturer_inputs_string = '';
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                  $manufacturer_inputs_string .= '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('manufacturers_url[' . $languages[$i]['id'] . ']', '', zen_set_field_length(TABLE_MANUFACTURERS_INFO, 'manufacturers_url') . 'class="form-control"');
                }

                $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_URL . $manufacturer_inputs_string);
                $contents[] = array('align' => 'text-center', 'text' => '<br><button type="submit" class="btn btn-primary">' . IMAGE_SAVE . '</button> <a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $_GET['mID']) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
                break;
              case 'edit':
                $heading[] = array('text' => '<h4>' . TEXT_HEADING_EDIT_MANUFACTURER . '</h4>');

                $contents = array('form' => zen_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=save', 'post', 'enctype="multipart/form-data" class="form-horizontal"'));
                $contents[] = array('text' => TEXT_EDIT_INTRO);
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_MANUFACTURERS_NAME, 'manufacturers_name', 'class="control-label"') . zen_draw_input_field('manufacturers_name', htmlspecialchars($mInfo->manufacturers_name, ENT_COMPAT, CHARSET, TRUE), zen_set_field_length(TABLE_MANUFACTURERS, 'manufacturers_name') . ' class="form-control"'));
                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_MANUFACTURERS_IMAGE, 'manufacturers_image', 'class="control-label"') . zen_draw_file_field('manufacturers_image') . '<br>' . $mInfo->manufacturers_image);
                $dir_info = zen_build_subdirectories_array(DIR_FS_CATALOG_IMAGES);
                $default_directory = substr($mInfo->manufacturers_image, 0, strpos($mInfo->manufacturers_image, '/') + 1);

                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_PRODUCTS_IMAGE_DIR, 'img_dir', 'class="control-label"') . zen_draw_pull_down_menu('img_dir', $dir_info, $default_directory, 'class="form-control"'));

                $contents[] = array('text' => '<br>' . zen_draw_label(TEXT_MANUFACTURERS_IMAGE_MANUAL, 'manufacturers_image_manual', 'class="control-label"') . zen_draw_input_field('manufacturers_image_manual', '', 'class="form-control"'));

                $contents[] = array('text' => '<br>' . zen_info_image($mInfo->manufacturers_image, $mInfo->manufacturers_name));
                $manufacturer_inputs_string = '';
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                  $manufacturer_inputs_string .= '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('manufacturers_url[' . $languages[$i]['id'] . ']', zen_get_manufacturer_url($mInfo->manufacturers_id, $languages[$i]['id']), zen_set_field_length(TABLE_MANUFACTURERS_INFO, 'manufacturers_url') . 'class="form-control"');
                }

                $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_URL . $manufacturer_inputs_string);
                $contents[] = array('align' => 'text-center', 'text' => '<br><button type="submit" class="btn btn-primary">' . IMAGE_SAVE . '</button> <a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
                break;
              case 'delete':
                $heading[] = array('text' => '<h4>' . TEXT_HEADING_DELETE_MANUFACTURER . '</h4>');

                $contents = array('form' => zen_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&action=deleteconfirm') . zen_draw_hidden_field('mID', $mInfo->manufacturers_id));
                $contents[] = array('text' => TEXT_DELETE_INTRO);
                $contents[] = array('text' => '<br><b>' . $mInfo->manufacturers_name . '</b>');
                $contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_image', '', true) . ' ' . TEXT_DELETE_IMAGE);

                if ($mInfo->products_count > 0) {
                  $contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_products') . ' ' . TEXT_DELETE_PRODUCTS);
                  $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $mInfo->products_count));
                }

                $contents[] = array('align' => 'text-center', 'text' => '<br><button type="submit" class="btn btn-danger">' . IMAGE_DELETE . '</button> <a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
                break;
              default:
                if (isset($mInfo) && is_object($mInfo)) {
                  $heading[] = array('text' => '<h4>' . $mInfo->manufacturers_name . '</h4>');

                  $contents[] = array('align' => 'text-center', 'text' => '<a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=edit') . '" class="btn btn-primary" role="button">' . IMAGE_EDIT . '</a> <a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=delete') . '" class="btn btn-warning" role="button">' . IMAGE_DELETE . '</a>');
                  $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . zen_date_short($mInfo->date_added));
                  if (zen_not_null($mInfo->last_modified)) {
                    $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . zen_date_short($mInfo->last_modified));
                  }
                  $contents[] = array('text' => '<br>' . zen_info_image($mInfo->manufacturers_image, $mInfo->manufacturers_name));
                  $contents[] = array('text' => '<br>' . TEXT_PRODUCTS . ' ' . $mInfo->products_count);
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
        <?php
        if (empty($action)) {
          ?>
          <div class="row text-right"><?php echo '<a href="' . zen_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&mID=' . $mInfo->manufacturers_id . '&action=new') . '" class="btn btn-primary">' . IMAGE_INSERT . '</a>'; ?></div>
          <?php
        }
        ?>
        <div class="row">
          <table class="table">
            <tr>
              <td><?php echo $manufacturers_split->display_count($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS); ?></td>
              <td class="text-right"><?php echo $manufacturers_split->display_links($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
            </tr>
          </table>
        </div>
      <!-- body_eof //-->
    </div>
    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
