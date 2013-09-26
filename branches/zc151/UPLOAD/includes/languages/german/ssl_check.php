<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: ssl_check.php 293 2008-05-28 21:10:40Z maleborg $
//

define('NAVBAR_TITLE','Sicherheitsprüfung');
define('HEADING_TITLE','Sicherheitsprüfung');

define('TEXT_INFORMATION','Wir haben festgestellt, dass Sie eine andere SSL Sitzungs ID verwenden als von unsere Seite benutzt wird.');
define('TEXT_INFORMATION_2','Bitte melden Sie sich zu Ihrer Sicherheit noch einmal an und setzten anschließend Ihren Einkauf wie gewohnt fort.');
define('TEXT_INFORMATION_3','Einige Browser, wie z.B.  Konqueror 3.1, können die notwendige, gesicherte SSL Sitzungs-ID nicht automatisch generieren. Sollten Sie so einen Browser verwenden, empfehlen wir Ihnen einen kompatiblen Browser zu verwenden. Für den Fall, dass Sie keinen weiteren Browser installiert haben, können Sie sich über diese Links einen aktuellen Browser downloaden: <a href="http://www.microsoft.com/downloads/details.aspx?FamilyID=1e1550cb-5e5d-48f5-b02b-20b602228de6&DisplayLang=de" target="_blank">Microsoft Internet Explorer 6 SP 1 deutsch</a>, <a href="http://www.netscape.de/" target="_blank">Netscape</a>, or <a href="http://www.mozilla.org/releases/" target="_blank">Mozilla</a>.');
define('TEXT_INFORMATION_4','Wir haben diese Sicherheitsmaßnahme zu Ihren Vorteil gewählt. Sollten wir Ihnen damit Unbequemlichkeiten verursacht haben, so bitten wir Sie um Entschuldigung.');
define('TEXT_INFORMATION_5','Wenn Sie Fragen haben, kontaktieren Sie bitte den Shopbetreiber.');

define('BOX_INFORMATION_HEADING','Datenschutz und Sicherheit');
define('BOX_INFORMATION','Das System verifiziert die von Ihrem Browser bei jeder Anfrage an den Server automatisch generierten Sicherheits-IDs.<br /><br />Diese Verifizierung prüft, ob alle Anfragen auch wirklich von Ihrem Browser stammen und nicht missbräuchlich verwendet werden.');
