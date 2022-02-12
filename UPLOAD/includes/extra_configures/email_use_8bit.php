<?php
/** 
 * used only to override the email encoding method for backward compatibility. 
 *
 * This file may NOT be required, depending on your host mailserver configuration.
 *
 * @package constants
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: email_use_8bit.php 2011-08-09 15:49:16Z hugo13 $
 */
/**
 * specify the email encoding method to be used for sending emails
 * If unspecified, the default is 7bit.
 * Possible meaningful options are: "8bit" (older style), "7bit" (preferred), and "quoted-printable".
 *
 * To use 7bit, simply delete this file, or change the following to 7bit:
 */
define('EMAIL_ENCODING_METHOD', '8bit');