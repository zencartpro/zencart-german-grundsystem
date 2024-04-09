<?php
/**
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Specific
 * Config for TinyMCE 7.0.0
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tinymce.php 2024-04-09 21:32:09Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$var = zen_get_languages();
$jsLanguageLookupArray = "var lang = new Array;\n";
foreach ($var as $key)
{
  $jsLanguageLookupArray .= "  lang[" . $key['id'] . "] = '" . $key['code'] . "';\n";
}
?>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  <?php echo $jsLanguageLookupArray ?>
  $('textarea').each(function() {
    if ($(this).attr('name') != 'message' && $(this).attr('class') != 'noEditor')
    {
      index = $(this).attr('name').match(/\d+/);
      if (index == null) index = <?php echo $_SESSION['languages_id'] ?>;
      tinymce.init(
        {
          language : lang[index],
          selector: '.editorHook',
          license_key: 'gpl',
          promotion: false,
          menubar: false,
          entity_encoding : 'raw',
          browser_spellcheck: true,
          advcode_inline: true,
    plugins : 'accordion,advlist,anchor,autolink,autoresize,autosave,charmap,code,codesample,directionality,emoticons,fullscreen,help,image,importcss,insertdatetime,link,lists,media,nonbreaking,pagebreak,preview,quickbars,save,searchreplace,table,visualblocks,visualchars,wordcount',
    toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link | image | media",
    toolbar2: "print | preview | forecolor | backcolor | emoticons | code",
    image_advtab: true
        });
    }
  });
});
</script>
