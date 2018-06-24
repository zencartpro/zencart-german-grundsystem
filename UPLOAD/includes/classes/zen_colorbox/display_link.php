<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: display_link.php 2018-06-23 webchills $
 */
?>
<script type="text/javascript">
  jQuery(function($) {
  // Link Information
  var displayLink = $('<?php echo $anchor; ?>');
  if (displayLink.length != 0) {
    var displayLinkUrl = displayLink.attr('href').match(/'(.*?)'/)[1];
    displayLink.attr({
      'href':'#'
    }).colorbox({
      'href':displayLinkUrl,
      width: '550px',
      onComplete: function(){
        $('#cboxLoadedContent').find('a[href*="window.close"]').closest('<?php echo $closenear; ?>').hide();
      }
    });
  }
});
</script>