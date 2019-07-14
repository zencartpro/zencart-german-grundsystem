<?php
/**
 * @package MailBeez
 * @copyright 2010 MailBeez
 * @copyright Portions Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: mailbeez.php 2010-08-21 kuroi $
 */
 
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 MailBeez
	
	inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/ 
 
 
define('TABLE_MAILBEEZ_TRACKING', DB_PREFIX . 'mailbeez_tracking');
define('TABLE_MAILBEEZ_BLOCK', DB_PREFIX . 'mailbeez_block');
define('FILENAME_HIVE', 'mailhive.php'); // with .php extension!