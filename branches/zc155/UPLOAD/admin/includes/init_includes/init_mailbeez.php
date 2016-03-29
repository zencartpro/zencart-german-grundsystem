<?php

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}


if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('mailbeez_admin')) {
        // Add the link to MailBeez
        zen_register_admin_page('mailbeez_admin', 'BOX_MAILBEEZ_MENUE',
            'FILENAME_MAILBEEZ', '', 'tools', 'Y', 40);
    }
}

?>