<!-- Facebook Like Button BEGIN -->
<?php if (FACEBOOK_LIKE_BUTTON_METHOD == 'iframe') { ?>
<?php
  switch(FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE) {
    case 'standard':
      if (FACEBOOK_LIKE_BUTTON_SHOW_FACES == 'true') {
        $height = 80;
      } else {
        $height = 35;
      }
      break;
    case 'button_count':
      $height = 20;
      break;
    case 'box_count':
      $height = 65;
      break;  
  }

  if ($og_url == '') {
    $fb_exclude_params = array('action', 'notify', 'main_page', 'zenid');
    $og_url = zen_href_link($_GET['main_page'], zen_get_all_get_params($fb_exclude_params));    
  }

  $iframe_url = urlencode($og_url) . '&layout=' . FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE . '&show_faces=' . FACEBOOK_LIKE_BUTTON_SHOW_FACES . '&width=' . FACEBOOK_LIKE_BUTTON_WIDTH . '&height=' . $height . '&action=' . FACEBOOK_LIKE_BUTTON_ACTION . '&font=' . FACEBOOK_LIKE_BUTTON_FONT . '&colorscheme=' . FACEBOOK_LIKE_BUTTON_COLOR_SCHEME; 
?>
<iframe src="http://www.facebook.com/widgets/like.php?href=<?php echo $iframe_url; ?>"
 scrolling="no" frameborder="0"
 style="<?php echo (FACEBOOK_LIKE_BUTTON_ALIGNMENT == 'left') ? 'float: left; ' : (FACEBOOK_LIKE_BUTTON_ALIGNMENT == 'right') ? 'float: right ' : ''; ?>border: none; overflow: hidden; width: <?php echo FACEBOOK_LIKE_BUTTON_WIDTH; ?>px; height: <?php echo $height; ?>px;" allowTransparency="true"></iframe>
<?php } elseif (FACEBOOK_LIKE_BUTTON_METHOD == 'XBFML') { ?> 
<div id="fb-root"></div>
<script><!--//
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "<?php echo FACEBOOK_LANGUAGE_CONNECTOR; ?>#xfbml=1&appId=<?php echo FACEBOOK_OPEN_GRAPH_APPID; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//--></script>
<fb:like href="<?php echo $og_url; ?>" layout="<?php echo FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE; ?>" show_faces="<?php echo FACEBOOK_LIKE_BUTTON_SHOW_FACES; ?>" width="<?php echo FACEBOOK_LIKE_BUTTON_WIDTH; ?>" action="<?php echo FACEBOOK_LIKE_BUTTON_ACTION; ?>" font="<?php FACEBOOK_LIKE_BUTTON_FONT; ?>" send="<?php echo FACEBOOK_LIKE_BUTTON_SEND; ?>" colorscheme="<?php echo FACEBOOK_LIKE_BUTTON_COLOR_SCHEME; ?>"<?php echo (FACEBOOK_LIKE_BUTTON_ALIGNMENT == 'left') ? ' style="float: left;"' : (FACEBOOK_LIKE_BUTTON_ALIGNMENT == 'right') ? ' style="float: right;"' : ''; ?>></fb:like>
<?php } elseif (FACEBOOK_LIKE_BUTTON_METHOD == 'HTML5') { ?>
<div id="fb-root"></div>
<script><!--//
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo FACEBOOK_OPEN_GRAPH_APPID; ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//--></script>
<div class="fb-like" data-href="<?php echo $og_url; ?>" data-send="<?php echo FACEBOOK_LIKE_BUTTON_SEND; ?>" data-layout="<?php echo FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE; ?>" data-width="<?php echo FACEBOOK_LIKE_BUTTON_WIDTH; ?>" data-show-faces="<?php echo FACEBOOK_LIKE_BUTTON_SHOW_FACES; ?>" data-action="<?php echo FACEBOOK_LIKE_BUTTON_ACTION; ?>" data-colorscheme="<?php echo FACEBOOK_LIKE_BUTTON_COLOR_SCHEME; ?>" data-font="<?php FACEBOOK_LIKE_BUTTON_FONT; ?>"<?php echo (FACEBOOK_LIKE_BUTTON_ALIGNMENT == 'left') ? ' style="float: left;"' : (FACEBOOK_LIKE_BUTTON_ALIGNMENT == 'right') ? ' style="float: right;"' : ''; ?>></div>
<?php } ?>
<!-- Facebook Like Button END -->