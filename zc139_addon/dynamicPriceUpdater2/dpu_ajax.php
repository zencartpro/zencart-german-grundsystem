<?php
// (c) D Parry (Chrome) 2009 (admin@chrome.me.uk)
// This module is free to distribute and use as long as the above copyright message is left in tact
// This module is released under the GNU/GPL licence... Really... Go look it up

require('includes/application_top.php');
require(DIR_WS_CLASSES.'dynamic_price_updater.php');


define('DPU_SHOW_CURRENCY_SYMBOLS', true); // Soll das Währungssymbol angezeigt werden?
define('UPDATER_PREFIX_TEXT', 'Your price1: '); // Hat keine Funktion mehr
define('DPU_SHOW_QUANTITY', true); // Soll die Menge hinter dem Preis angezeigt werden
define('DPU_SHOW_QUANTITY_FRAME', '&nbsp;(%s)'); // Wie soll die Menge angezeigt werden, Standardeintrag " (xx)", wobei xx für die Menge steht.
define('DPU_SHOW_SIDEBOX', false); // Soll die DPU Sidebox angezeigt werden
define('DPU_SIDEBOX_QUANTITY_FRAME', '<span class="DPUSideboxQuantity">&nbsp;x&nbsp;%s</span>'); // Wie soll das Gewicht in der Sidebox angezeigt werden. (Standard ist ' x 1'...) Setzen Sie den Eintrag auf '', um kein Gewicht anzuzeigen.
define('DPU_SIDEBOX_PRICE_FRAME', '&nbsp;(%s)'); // Wie soll der Attributpreis in der Sidebox angezeigt werden
define('DPU_SIDEBOX_TOTAL_FRAME', '<hr /><span class="DPUSideboxTotalText">Total: </span><span class="DPUSideboxTotalDisplay">%s</span>'); // Wie soll die Gesamtsumme in der Sidebox angezeigt werden.  %s ist die Preisangabe.
define('DPU_SIDEBOX_FRAME', '<span class="DPUSideBoxName">%1$s</span>%3$s%2$s<br />'); // Das Template für die Sidebox. Weitere Informationen finden Sie unten
/*
DPU_SIDEBOX_FRAME hat 3 Variablen, die Sie nutzen können
Diese sind:
%1$s - Der Attribut Name
%2$s - Die Stückzahlanzeige
%3$s - Die Anzeige des individuellen Preises

Sie können diese Variablen innerhalb des Eintrags DPU_SIDEBOX_FRAME platzieren. Möchten Sie eine der obigen Informationen nicht angezeigt bekommen, lassen Sie die Variable einfach weg.
*/


$stat = (empty($_POST['stat']) ? (empty($_GET['stat']) ? 'main' : $_GET['stat']) : $_POST['stat']);

$dpu = new DPU($db);
switch ($stat) {
	case 'main':
	default:
		$dpu->getDetails();
		break;
	case 'multi':
		$dpu->getMulti();
		break;
}