<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2011-2019 That Software Guy
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: finddupmodels.php 2021-12-27 19:16:51 webchills $
 */

require('includes/application_top.php');

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
    <!-- body //-->
    <div class="container-fluid">
    
    <?php echo "<h1>" . HEADING_TITLE . "</h1>"; ?>
    <?php show_table(1); ?>
    <?php show_table(2); ?>
    <?php
    ?>
    <!-- body_text_eof //-->
      </div>
      <!-- body_eof //-->
      <!-- footer //-->
  <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
      <!-- footer_eof //-->
    </body>
  </html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php
function show_table($call)
{
   global $db;
   if ($call == 1) {
      echo '<h4>' . DUPLICATE_HEADER . '</h4>';
   } else {
      echo '<h4>' . BLANK_HEADER . '</h4>';
   }
   echo '
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <!-- this is the heading row -->
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center" valign="top">';
   echo HEADING_PRODUCTS_ID;
   echo '
                </td>';
   echo '
                <td class="dataTableHeadingContent" align="left" valign="top">';
   echo HEADING_PRODUCTS_MODEL;
   echo '
                </td>';
   echo '
                <td class="dataTableHeadingContent" align="left" valign="top">';
   echo HEADING_PRODUCTS_NAME;
   echo '
                </td>
              </tr>
              <!-- end heading row -->';
   if ($call == 1) {
      $dups_query_raw = " SELECT p.products_id, products_model, products_name, products_type 
       FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " d  
       WHERE p.products_id = d.products_id
       AND d.language_id = '" . (int)$_SESSION['languages_id'] . "'
       AND products_model != '' 
       AND products_model
       IN (
       SELECT products_model
       FROM " . TABLE_PRODUCTS . " 
       GROUP BY products_model
       HAVING (
       count( products_model ) >1
       )
       ) ORDER BY products_model ";
   } else {
      $dups_query_raw = " SELECT p.products_id, products_model, products_name, products_type 
       FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " d  
       WHERE p.products_id = d.products_id
       AND d.language_id = '" . (int)$_SESSION['languages_id'] . "'
       AND products_model = ''";
   }
   $dups = $db->Execute($dups_query_raw);
   if ($dups->RecordCount() <= 0) {
      echo '<tr><td colspan="3" align="center">';
      if ($call == 1) {
         echo '<b>' . NO_DUPS_FOUND . '</b>';
      } else {
         echo '<b>' . NO_BLANKS_FOUND . '</b>';
      }
      echo '</td></tr>';
   } else {
      while (!$dups->EOF) {
         echo '
             <tr>
                <td class="dataTableContent" align="center">' . $dups->fields['products_id'] . '</td>';
         echo '<td class="dataTableContent">';
         echo '<a href="' . zen_href_link(FILENAME_PRODUCT, 'product_type=' . $dups->fields['products_type'] . '&action=new_product&pID=' . $dups->fields['products_id'], 'NONSSL') . '" target="_blank">';
         if ($call == 1) {
            echo $dups->fields['products_model'];
         } else {
            echo FIX_BLANK_MODEL;
         }
         echo "</a>";
         echo '</td>';
         echo '<td class="dataTableContent">' . $dups->fields['products_name'] . '</td> 
              </tr>';
         $dups->MoveNext();
      }
   }
   echo '</table>';
   echo '<br><br>';
}
?>
       </div>

</div>
