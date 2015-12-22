<?php
define('FILENAME_EMAIL_EXPORT', 'email_export');
define('BOX_TOOLS_EMAIL_EXPORT', 'Email Export');

// Ändern Sie hier falls gewünscht den Pfad für das Speichern der Datei am Server
if (defined('DIR_FS_LOGS')) {
  define('DIR_FS_EMAIL_EXPORT',DIR_FS_LOGS.'/');
} else {
  define('DIR_FS_EMAIL_EXPORT',DIR_FS_CATALOG.'images/uploads/');
}
