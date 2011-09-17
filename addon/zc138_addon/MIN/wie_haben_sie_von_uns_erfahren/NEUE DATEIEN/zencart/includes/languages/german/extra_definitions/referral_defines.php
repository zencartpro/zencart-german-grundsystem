<?php
// $Id: referral_defines.php 2010-08-13 17:35:52Z webchills $
define('ENTRY_SOURCE', 'Wie haben Sie von uns erfahren?');
define('ENTRY_SOURCE_ERROR', 'Wie haben Sie von uns erfahren fehlt. Bitte wählen Sie aus den vorgegebenen Antworten aus.');
define('ENTRY_SOURCE_OTHER', '(falls Sie "Andere" wählen, geben Sie bitte einen Freitext ein.):');
define('ENTRY_SOURCE_OTHER_ERROR', 'Bitte geben Sie an, wie Sie von uns erfahren haben.');
if (REFERRAL_REQUIRED == 'true') {
  define('ENTRY_SOURCE_TEXT', '*');
  define('ENTRY_SOURCE_OTHER_TEXT', '*');
} else {
  define('ENTRY_SOURCE_TEXT', '');
  define('ENTRY_SOURCE_OTHER_TEXT', '');
}
define('PULL_DOWN_SOURCES', 'Bitte wählen Sie aus:');
define('PULL_DOWN_OTHER', 'Andere - (bitte genauer beschreiben)');