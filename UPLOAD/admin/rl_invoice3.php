<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: rl_invoice3.php 2021-01-04 15:58:17Z webchills $
 */
 
require ('includes/application_top.php');
require (DIR_WS_CLASSES . 'currencies.php');
include (DIR_WS_CLASSES . 'order.php');
require_once (DIR_FS_CATALOG . DIR_WS_CLASSES . 'class.rl_invoice3.php');
require_once ('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions/rl_invoice3.php');

$paper = rl_invoice3::getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));
$pdfT = new rl_invoice3($_GET['oID'], $paper['orientation'], $paper['unit'], $paper['format']);       
$pdfT->createPdfFile();  