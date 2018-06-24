<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: display_js_link.php 2018-06-23 webchills $
 */
?>
<script type="text/javascript">
  jQuery(function($) {
  // Link Information
  var displayLink = $('<?php echo $anchor; ?>');
  if (displayLink.length != 0) {
    var displayLinkUrl = <?php
    if(empty($zcb_given)) {
                       ?>displayLink.attr('href').match(/'(.*?)'/)[1];<?php 
     } else {
                       echo '"' . $zcb_given . '";' . PHP_EOL; 
     }
     ?>
    displayLink.attr({
      'href':'#'
    }).colorbox({
      'href':displayLinkUrl,
      width: '550px',
      onComplete: function(){
        $('#cboxLoadedContent').find('a[href*="window.close"]').closest('<?php echo $closenear; ?>').hide();
      },
      onClosed: function(){

        var container = $('html'),
            scrollTo = displayLink;

        container.removeClass('no-fouc');

        container.scrollTop(
            scrollTo.offset().top - container.offset().top + container.scrollTop()
        );
      
      }

    });
  }
});
</script>
