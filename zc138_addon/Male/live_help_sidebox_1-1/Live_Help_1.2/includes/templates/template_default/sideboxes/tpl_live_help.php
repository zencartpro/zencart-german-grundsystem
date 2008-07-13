<?php
//
// +----------------------------------------------------------------------+
// | Live Help 1.1 for Zen Cart                                           |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 Bao Bao E-commerce                                |
// |                                                                      |
// | http://www.buybaobao.com                                             |
// |                                                                      |
// | Portions Copyright (c) 2006 Bao Bao E-commerce                       |
// +----------------------------------------------------------------------+
//
  $content = "";

  $content .= '<div class="centeredContent" style="margin-top: 10px; margin-bottom: 10px;">';

  if (LIVE_HELP_SKYPE == 'Enable') {
	$content .= '<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>';
	$content .= '<a href="skype:' . LIVE_HELP_SKYPE_USERNAME . '?' . LIVE_HELP_SKYPE_STYLE . '"><img src="http://mystatus.skype.com/smallclassic/' . LIVE_HELP_SKYPE_USERNAME . '" style="border: none;" width="114" height="20" alt="' . BOX_SKYPE_TITLE  . '" /></a><br /><br />';
  }

  if (LIVE_HELP_YAHOO == 'Enable') {
		$content .= '<a href="http://edit.yahoo.com/config/send_webmesg?.target='. LIVE_HELP_YAHOO_USERNAME . '&.src=pg"><img border=0 src="http://opi.yahoo.com/online?u=' . LIVE_HELP_YAHOO_USERNAME . '&m=g&t=' . LIVE_HELP_YAHOO_STYLE . '&l=' . BOX_YAHOO_LANGUAGE . '" alt="' . BOX_YAHOO_TITLE  . '" /></a><br /><br />';
  }

  if (LIVE_HELP_QQ == 'Enable') {
		$content .= '<a href="http://wpa.qq.com/msgrd?v=1&uin=' . LIVE_HELP_QQ_USERNAME . '&site=nbPDA&menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:' . LIVE_HELP_QQ_USERNAME . ':' . LIVE_HELP_QQ_STYLE . '"  border="0" alt="' . BOX_QQ_TITLE  . '" /></a><br /><br />';
  }

  if (LIVE_HELP_WANGWANG == 'Enable') {
		$content .= '<script type="text/javascript">document.write(\'<a href="http://amos1.taobao.com/msg.ww?v=2&uid=\'+encodeURIComponent(\'' . LIVE_HELP_WANGWANG_USERNAME . '\')+\'&s=1" target="_blank"><img src="http://amos1.taobao.com/online.ww?v=2&uid=\'+encodeURIComponent(\'' . LIVE_HELP_WANGWANG_USERNAME . '\')+\'&s=1" border="0" alt="' . BOX_WANGWANG_TITLE  . '" /></a>\')</script><br /><br />';
  }

  $content .= '</div>';
?>