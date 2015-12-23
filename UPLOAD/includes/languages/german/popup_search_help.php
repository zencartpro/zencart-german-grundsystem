<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: popup_search_help.php 330 2015-12-23 19:28:14Z webchills $
 */

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