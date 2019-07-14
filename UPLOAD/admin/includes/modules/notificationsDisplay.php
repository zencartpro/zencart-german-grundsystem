<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: notificationsDisplay.php 1 2019-04-15 16:49:16Z webchills $
*/

if (! count($availableNotifications)) {
    return;
}
foreach ($availableNotifications as $nKey => $aNotification) {
    if (isset($aNotification['banner-group'])) {
?>
        <div class="row alert alert-dismissible notification-alert" role="alert" data-notification="<?php echo $nKey; ?>">
<?php if ($aNotification['can-forget']) { ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<?php } ?>
            <script><!--//<![CDATA[
                var loc = 'https://pan.zen-cart.com/display/group/' + '<?php echo $aNotification['banner-group']; ?>'
                var rd = Math.floor(Math.random() * 99999999999);
                document.write("<scr" + "ipt src='" + loc);
                document.write('?rd=' + rd);
                document.write("'></scr" + "ipt>");
                //]]>--></script>
        </div>
<?php
        }
        if (isset($aNotification['banner-html'])) {
?>
        <div class="row alert alert-dismissible notification-alert" role="alert" data-notification="<?php echo $nKey; ?>">
            <?php if ($aNotification['can-forget']) { ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php } ?>
        <?php echo $aNotification['banner-html']; ?>
        </div>
<?php
        }
    }
?>
<script>
    $('.notification-alert').on('close.bs.alert', function () {
            zcJS.ajax({
                url: "ajax.php?act=ajaxAdminNotifications&method=forget",
                data: {'key': $(this).data('notification'), 'admin_id': <?php echo $_SESSION['admin_id']; ?>}
            }).done(function( response ) {
            });
     })
</script>
