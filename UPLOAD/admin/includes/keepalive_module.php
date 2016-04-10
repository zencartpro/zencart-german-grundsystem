<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright (c) 2011 Eric Hynds
 * Adapted from concepts shared at http://www.erichynds.com/jquery/a-new-and-improved-jquery-idle-timeout-plugin/
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: keealive_module.php 2 2016-04-09 11:13:51Z webchills $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

?>
<!--  BOF: Keepalive for Session -->
<!-- timeout warning alert -->
<div id="keepalivetimer" title="Your session is about to expire!" style="display: none">
    <p class="ui-state-error-text">
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
        <?php echo TEXT_KEEPALIVE_MESSAGE_YOU_WILL_LOG_OFF; ?> <span id="keepalivetimer-countdown" style="font-weight:bold"></span> <?php echo TEXT_KEEPALIVE_MESSAGE_MINUTES?>.
    </p>

    <p><?php echo TEXT_KEEPALIVE_MESSAGE_ASK_CONTINUE;?></p>
</div>
<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/jquery-ui.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
  if (typeof jQuery == "undefined") {//no jquery yet
    document.write('<scr'+'ipt type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">');
    document.write('</scr' + 'ipt>');
  }
</script>
<script type="text/javascript">
  if (!jQuery.ui) {
    document.write('<scr'+'ipt type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js">');
    document.write('</scr' + 'ipt>');
  }
</script>
<script src="includes/javascript/jquery.idletimer.js<?php echo '?t='.time();?>" type="text/javascript"></script>
<script src="includes/javascript/jquery.idletimeout.js<?php echo '?t='.time();?>" type="text/javascript"></script>
<style type="text/css">
  a.ui-dialog-titlebar-close {display:none;}
  .ui-widget-overlay { background: green; opacity: .40;filter:Alpha(Opacity=40); }
</style>
<script type="text/javascript">
//setup the dialog
$("#keepalivetimer").dialog({
  autoOpen: false,
  modal: true,
  width: 430,
  height: 250,
  closeOnEscape: false,
  draggable: false,
  resizable: false,
  position: "top",
  buttons: {
    '<?php echo TEXT_KEEPALIVE_BUTTON_YES;?>': function(){
      $(this).dialog('close');
    },
    '<?php echo TEXT_KEEPALIVE_BUTTON_NO;?>': function(){
      $.idleTimeout.options.onLogoffClick.call(this);
    }
  }
});

// start the idle timer monitor
var $countdown = $("#keepalivetimer-countdown");
$.idleTimeout('#keepalivetimer', 'div.ui-dialog-buttonpane button:first', {
  idleAfter: 600, // 600 user is considered idle after 10 minutes of no movement in this browser window/tab
  warningLength: <?php echo SESSION_TIMEOUT_ADMIN-70; ?>, // countdown timer width remaining session time minus polling time (last keepalive call) + 10secs buffer
  pollingInterval: 60, //60  check for server connection every minute; if it fails or user is logged out, keepalive scripts will abort
  keepAliveURL: 'keepalive.php', serverResponseEquals: 'OK',
  titleMessage: '<?php echo TEXT_KEEPALIVE_WARNING_PREFIX;?>',
  onTimeout: function(){
    document.title = '<?php echo TEXT_KEEPALIVE_EXPIRED_PREFIX;?>';
    $(this).html('<?php echo TEXT_KEEPALIVE_SESSION_EXPIRED_MESSAGE;?>');
    $(this).dialog("option", "title", '<?php echo TEXT_KEEPALIVE_SESSION_EXPIRED_HEADER;?>');
    $(this).dialog("option", "minWidth", "450");
    $(this).dialog("option", "buttons", {'<?php echo TEXT_KEEPALIVE_BUTTON_CLOSE;?>': function(){$(this).dialog('close');},'<?php echo TEXT_KEEPALIVE_BUTTON_LOGIN;?>': function(){window.location.reload();}});
    //$(this).dialog("option", "buttons", {'<?php echo TEXT_KEEPALIVE_BUTTON_LOGIN;?>': function(){window.location.reload();}    });
  },
  onAbort: function(){
    // TODO: another modal dialog would be more friendly
    alert('<?php echo TEXT_KEEPALIVE_SERVER_UNREACHABLE_MESSAGE1;?>');
  },
  onIdle: function(){
    $(this).dialog("open");
  },
  onLogoffClick: function(){
    window.location = "logoff.php";
  },
  onCountdown: function(counter){
    var sec = counter % 60;
    var min = Math.floor(counter/60);
    if (sec < 0) {
      sec = 59;
      min = min - 1;
    }
    if (sec<=9) { sec = "0" + sec; }
    var time = (min<=9 ? "0" + min : min) + ":" + sec;
    $countdown.html(time);
  }
});
</script>
<!--  EOF: Keepalive for Session -->
