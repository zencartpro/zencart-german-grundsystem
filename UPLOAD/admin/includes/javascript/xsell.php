<?php
// -----
// Part of the "Cross Sell Advanced" plugin for Zen Carts v1.5.7 and later.
//
?>
<script>
jQuery(document).ready(function() {
    jQuery('.xsell-main-delete').on('click', function(e) {
        var product_id = jQuery(this).data('pid');
        var product_name = jQuery(this).closest('tr.dataTableRow').find('td.xsell-pname');
        if (confirm(product_name[0].innerHTML+'\n\n'+'<?php echo TEXT_JS_MAIN_DELETE_CONFIRM; ?>')) {
            jQuery('#main_delete').val(product_id);
            jQuery('#delete-form').submit();
        }
        return false;
    });
});
</script>