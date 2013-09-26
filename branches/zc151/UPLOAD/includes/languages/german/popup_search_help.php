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
// $Id: popup_search_help.php 329 2008-06-22 20:23:24Z maleborg $
//

define('HEADING_SEARCH_HELP','Hilfe zur Suche');
define('TEXT_SEARCH_HELP','
<p>Unser Shop bietet als weiteren Service auch eine leistungsstarke Suchmaschine:<br />
  <br />
  Es gibt die Möglichkeit mehrerer Variationen: <br />
  <br />
  <strong>Die Standardsuche:</strong><br />
  Sie geben als Suchbegriff <strong>Zen Cart</strong> ein und erhalten als Ergebnis Begriffe mit entweder <strong>Zen</strong>, <strong>Cart</strong> oder <strong>Zen Cart</strong>.<br />
  <br />
  <strong>Die "UND" Suche:</strong> <br />
  Sie geben als Suchbegriff <strong>Zen AND Cart</strong> ein - Sie erhalten nur Ergebnisse, deren Begriffe nur <strong>Zen Cart</strong> - <u>also nur beide Wörter</u> - beinhalten.<br />
  <br />
  <strong>Die "ODER" Suche:</strong><br />
  Sie geben als Suchbegriff <strong>Zen OR Cart</strong> ein - das Ergebnis werden Begriffe mit <strong>nur Zen</strong> oder <strong>nur Cart</strong> sein. <br />
  <br />
  <strong>Die exakte Suche:</strong><br />
  Sie geben als Suchbegriff <strong>"Zen Cart"</strong> ein - das Ergebnis werden Begriffe <u>mit exakt dieser Schreibweise</u> sein: <strong>Zen Cart (nicht zen cart) </strong><br />
  <br />
  Es sind natürlich auch Kombinationen möglich (Zen OR Cart OR "zen cart")</p>');
define('TEXT_CLOSE_WINDOW','<span class="pseudolink">Fenster schließen</span> [x]');
