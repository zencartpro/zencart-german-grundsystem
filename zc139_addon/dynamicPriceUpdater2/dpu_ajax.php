<?php
// (c) D Parry (Chrome) 2009 (admin@chrome.me.uk)
// This module is free to distribute and use as long as the above copyright message is left in tact
// This module is released under the GNU/GPL licence... Really... Go look it up

require('includes/application_top.php');
require(DIR_WS_CLASSES.'dynamic_price_updater.php');


define('DPU_SHOW_CURRENCY_SYMBOLS', true);
define('UPDATER_PREFIX_TEXT', 'Your price1: ');
define('DPU_SHOW_QUANTITY', true);
define('DPU_SHOW_QUANTITY_FRAME', '&nbsp;(%s)');
define('DPU_SHOW_SIDEBOX', false); // if the sidebox is not displayed this can be set to false to minimise network traffic
define('DPU_SIDEBOX_QUANTITY_FRAME', '<span class="DPUSideboxQuantity">&nbsp;x&nbsp;%s</span>'); // how the weight is displayed in the sidebox.  Default is ' x 1'... set to '' for no display... %s is the quantity itself
define('DPU_SIDEBOX_PRICE_FRAME', '&nbsp;(%s)'); // how the attribute price is displayed
define('DPU_SIDEBOX_TOTAL_FRAME', '<hr /><span class="DPUSideboxTotalText">Total: </span><span class="DPUSideboxTotalDisplay">%s</span>'); // this is how the total should be displayed.  %s is the price itself as displayed in the
define('DPU_SIDEBOX_FRAME', '<span class="DPUSideBoxName">%1$s</span>%3$s%2$s<br />'); // the template for the sidebox display.  Instructions below
/*
DPU_SIDEBOX_FRAME has 3 variables you can use... They are:
%1$s - The attribute name
%2$s - The quantity display
%3$s - The individual price display

You can position these anywahere around the DPU_SIDEBOX_FRAME string or even remove them to prevent them from displaying
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