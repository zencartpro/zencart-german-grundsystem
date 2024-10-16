<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_modules_media_manager.php 2019-04-12 18:49:16Z webchills $
 */
/**
 * require module to aggregate media clips to an array
 */
  require(DIR_WS_MODULES . zen_get_module_directory('media_manager.php'));
  if ($zv_product_has_media) {
?>


<h2 id="mediaManagerHeading"><?php echo TEXT_PRODUCT_COLLECTIONS; ?></h2>

<?php
  foreach($za_media_manager as $za_media_key => $za_media) {
?>
<div class="rowWrapper">
      <div class="mediaTitle"><?php echo $za_media['text']; ?></div>
<?php
    $zv_counter1 = 0;
    foreach($za_media_manager[$za_media_key]['clips'] as $za_clip_key => $za_clip) {
?>
      <div class="mediaTypeLink"><a href="<?php echo zen_href_link(DIR_WS_MEDIA  . $za_clip['clip_filename'], '', 'NONSSL', false, true, true); ?>" target="_blank"><?php echo '<span class="mediaClipFilename">' . $za_clip['clip_filename'] . '</span>' . (!empty($za_clip['clip_type']) ? '<span class="mediaClipType"> (' . $za_clip['clip_type'] . ')</span>' : ''); ?></a></div>

<?php
    }
?>
    </div>
<?php
   }
  }
