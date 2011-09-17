<?php
/**
 * @version sofortüberweisung.de 3.03 - $Date: 2011-08-12 11:24:11 +0200 (Fr, 12 Aug 2011) $
 * @author Payment Network AG (integration@payment-network.com)
 * @link http://www.payment-network.com/
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
 * USA
 *
 ***********************************************************************************
 * this file contains code based on:
 * (c) 2000 - 2001 The Exchange Project
 * (c) 2001 - 2003 osCommerce, Open Source E-Commerce Solutions
 * (c) 2003 - 2011 Zen-Cart
 * Released under the GNU General Public License
 ***********************************************************************************
 *
 * $Id: sofortueberweisung_abort.php 121 2010-04-12 08:17:11Z thoma $
 * $Id: sofortueberweisung_abort.php 122 2011-08-12 11:24:11Z webchills $
 *
 */

define('NAVBAR_TITLE', 'sofortbanking');
define('HEADING_TITLE', 'sofortbanking');

define('TEXT_INFORMATION', 'The following error has been announced by sofortbanking during the process:<br /><br />
Payment via sofortbanking is unfortunately not possible or has been cancelled by the customer.<br /><br />
Please transfer the money manually to the following bank account:<br /><br />

....<br>
....<br>
....<br>
');