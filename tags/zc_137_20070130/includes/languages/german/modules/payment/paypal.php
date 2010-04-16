<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id: paypal.php 5314 2006-12-21 02:23:06Z drbyte $
 */

  define('MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE', 'PayPal IPN');
  if (IS_ADMIN_FLAG === true) {
define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong><br /><font color=green>Konfigurations Hinweis:</font><br />Auf www.paypal.com, unter "Profile",<ul><li>Unter <strong>Einstellungen f&uuml;r sofortige Zahlungsbest&auml;tigung</strong> folgende URL verwenden:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . ' </li><li>unter <strong>Website-Zahlungsoptionen</strong> folgende <strong>R&uuml;ckleitungs-URL</strong> verwenden:<br />'.zen_catalog_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL',false).'</li>' . (defined('MODULE_PAYMENT_PAYPAL_STATUS') ? '' : '<li>... und danach installieren klicken ... und "edit" um die PayPal Einstellungen in ZenCart vorzunehmen.</li>') . '</ul><font color=green><hr /></font>' );
  } else {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
  }

define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'Vorname:');



?>