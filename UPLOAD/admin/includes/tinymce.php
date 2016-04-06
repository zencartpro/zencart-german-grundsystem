<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tinymce.php 760 2016-04-06 16:47:09Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

?>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>tiny_mce/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>tiny_mce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="../<?php echo DIR_WS_EDITORS ?>tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
	
tinymce.init({
    selector: "textarea",
    theme: "modern",
    language : "de",
    entity_encoding : "raw",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>

