<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// | Translator:           cyaneo                                         |
// | Date of Translation:  16.08.04                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
// $Id: finished.php 2 2006-03-31 09:55:33Z rainer $
//

define('TEXT_MAIN',"<h2>Gratulation!</h2><h3>Sie haben soeben erfolgreich Ihr Zen Cart e-Commerce System installiert!</h3><p>
<h2>ERSTE SCHRITTE...</h2><p class=warning>Setzen Sie die Lese- und Schreibrechte der Dateien <strong>configure.php</strong>, welche Sie in <strong>/admin/includes/</strong> und <strong>/includes/</strong> finden, auf CHMOD 444 zur&uuml;ck bzw. aktivieren Sie auf Windows Systemen den Schreibschutz f&uuml;r diese Dateien.<br />
<br />
Bitte l&ouml;schen Sie auch den Ordner <strong>/zc_install</strong> bzw. benennen Sie diesen um, damit keine unbefugten Personen den Shop neu installieren und somit Ihre Datenbank l&ouml;schen k&ouml;nnen! Diese Meldung erscheint so lange, bis diese Vorsichtsma&szlig;namen durchgef&uuml;hrt wurden.</p>
<br /><br /><h2>KONFIGURATION</h2>Bitte besuchen Sie unsere Supportseite unter <a href=\"http://www.zen-cart.at\"><strong>Zen Cart FAQ</strong></a>. In unseren Online Foren erhalten Sie Hilfe und Tipps f&uuml;r die Installation, Konfiguration und Anpassung Ihres Zen Cart Shops.
Wenn Sie Fragen haben, ist dies die erste Anlaufstelle f&uuml;r Sie.
<h2>WICHTIGER HINWEIS</h2>Damit Sie Ihren Shop Ihren W&uuml;nschen entsprechend anpassen k&ouml;nnen, machen Sie sich bitte als Erstes mit dem <em><strong>Template System</strong></em> vertraut machen. Hilfestellung hierzu erhalten Sie im Handbuch und in unserer <a href=\"http://www.zen-cart.at\">online FAQ Sektion</a>.
<h2>ZUSÄTZLICHER HINWEIS</h2>In unserer <a href=\"http://www.zen-cart.at\">Online Dokumentation</a>, und in der '<strong>Download Sektion</strong>' erhalten Sie immer die aktuellsten Versionen der Handb&uuml;cher.<br /><br />
Wir freuen uns, dass Sie Zen Cart als Ihr e-Commerce System ausgew&auml;hlt haben!<br /><br />" .
'<a href="http://www.zen-cart.at">Besuchen Sie uns auf www.zen-cart.at</a>' . '</p>' .
'<p>Klicken Sie auf den Button <em>Shop</em>, um Ihr Shopsystem zu testen, oder auf den Button <em>Admin</em>, um Ihr Shopsystem anzupassen.</p>');

define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Abschluss');
define('STORE', 'Hier geht es zum Shop');
define('ADMIN', 'Hier geht es zum Admin Bereich');
?>
