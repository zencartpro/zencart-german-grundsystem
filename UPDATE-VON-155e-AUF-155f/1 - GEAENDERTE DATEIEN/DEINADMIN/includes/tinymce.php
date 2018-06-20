<?php
/**
 * @package admin
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tinymce.php 762 2018-06-11 17:32:09Z webchills $
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
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>tiny_mce/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>tiny_mce/jquery.tinymce.min.js"></script>
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
    theme: 'modern',
    entity_encoding : 'raw',
    browser_spellcheck: true,
    plugins : 'advlist,autolink,lists,link,image,charmap,print,preview,hr,anchor,pagebreak,searchreplace,wordcount,visualblocks,visualchars,code,fullscreen,insertdatetime,media,nonbreaking,save,table,contextmenu,directionality,emoticons,template,paste,textcolor',
   

    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true
});
    }
  });
});
</script>
