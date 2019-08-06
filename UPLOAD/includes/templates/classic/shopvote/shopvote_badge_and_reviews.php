<?php
/**
 * @package Shopvote
 * shopvote supported languages: german, english, french, italian, dutch, spanish
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: shopvote_badge_and_reviews.php 2019-08-06 07:39:51Z webchills $
 */
if ($_SESSION['language']=='german') {
$SHOPVOTE_LANG = 'DE';
} else if ($_SESSION['language']=='english') {
$SHOPVOTE_LANG = 'EN';
} else if ($_SESSION['language']=='french') {
$SHOPVOTE_LANG = 'FR';
} else if ($_SESSION['language']=='italian') {
$SHOPVOTE_LANG = 'IT';
} else if ($_SESSION['language']=='dutch') {
$SHOPVOTE_LANG = 'NL';
} else if ($_SESSION['language']=='spanish') {
$SHOPVOTE_LANG = 'ES';
} else {
$SHOPVOTE_LANG = 'EN';
} ?>
<?php	if (SHOPVOTE_BADGE_TYPE == '1') { ?>
<script src="https://widgets.shopvote.de/js/badget-98x98.min.js"></script>
<script>
var myShopID = <?php echo SHOPVOTE_SHOP_ID;?>;
var myBadgetType = <?php echo SHOPVOTE_BADGE_TYPE;?>;
var mySpaceX  = <?php echo SHOPVOTE_SPACE_X;?>;
var mySpaceY = <?php echo SHOPVOTE_SPACE_Y;?>;
var myAlignH = '<?php echo SHOPVOTE_ALIGN_H;?>';
var myAlignV = '<?php echo SHOPVOTE_ALIGN_V;?>';
var myDisplayWidth = <?php echo SHOPVOTE_DISPLAY_WIDTH;?>;
var myLanguage = '<?php echo $SHOPVOTE_LANG;?>';
var mySrc = ('https:' === document.location.protocol ? 'https' : 'http');
createBadget(myShopID, myBadgetType, mySrc, mySpaceX, mySpaceY, myAlignH, myAlignV, myDisplayWidth);
</script>
<?php } else { ?>
<script src="https://widgets.shopvote.de/js/votebadge.min.js"></script>
<script>
var myShopID = <?php echo SHOPVOTE_SHOP_ID;?>;
var myBadgetType = <?php echo SHOPVOTE_BADGE_TYPE;?>;
var myLanguage = '<?php echo $SHOPVOTE_LANG;?>';
var mySrc = ('https:' === document.location.protocol ? 'https' : 'http');
createVBadge(myShopID, myBadgetType, mySrc);
</script>
<?php } ?>
<?php	if ($_GET['main_page'] == FILENAME_CHECKOUT_SUCCESS) { ?>
<div id="srt-customer-data" style="display:none;">
<span id="srt-customer-email"><?php echo $order->customer['email_address'];?></span>
<span id="srt-customer-reference"><?php echo $order_summary['order_number']; ?></span>
</div>
<script src="https://feedback.shopvote.de/srt-v4.min.js"></script>
<script type="text/javascript">
var myToken = "<?php echo SHOPVOTE_EASY_REVIEWS_TOKEN;?>";
var mySrc = ('https:' === document.location.protocol ? 'https' : 'http');
var myLanguage = '<?php echo $SHOPVOTE_LANG;?>';
loadSRT(myToken, mySrc);
</script>
<?php } ?>