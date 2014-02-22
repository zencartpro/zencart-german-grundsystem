<?php
define('NAVBAR_TITLE', 'Bestätigung');
define('HEADING_TITLE', 'Bestätigung');

define('TEXT_INFORMATION', '');
// you don't need to fill in TEXT_INFORMATION if you wish to edit the subscribe text from the Admin area
// If filled in, this text is shown below the defined page text
// Note: This uses the same defined_page for both subscriptions and confirmation

define('TEXT_INFORMATION_CONFIRM', '
  Sie müssen bitte, bevor Sie unseren Newsletter erhalten können Ihre E-Mail-Adresse bestätigen. Dafür haben wir Ihnen eine E-Mail gesendet an:   <strong>%s</strong>.
  <br />
  <br />
  Bitte überprüfen Sie Ihren E-Mail-Eingang. Sie sollten in Kürze eine Mail erhalten, in der finden Sie einen Bestätigungslink. Bitte klicken Sie auf den Link (Sie werden direkt auf unsere Seite geleitet) oder kopieren Sie den Link in Ihren Browser.
  <br />
  <br />
  Sollten Sie Probleme mit der Anmeldung haben, schicken Sie einfch eine Mail an: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .'</a>.
  ');

// greeting salutation
define('EMAIL_SUBJECT', 'Bitte bestätigen Sie das ' . STORE_NAME . ' Newsletter Abonnement');
define('EMAIL_SEPARATOR', '--------------------');
// First line of the greeting
define('EMAIL_WELCOME', 'Wir heißen Sie herzlich bei  ' . STORE_NAME . ' willkommen.');
define('EMAIL_SEPARATOR', '--------------------');

define('EMAIL_TEXT', 
  'Diese EMail wurde für den Newsletter auf unserer Seite angemeldet.' . "\n\n" . 
  'Bevor Sie den Newsletter erhalten können, müssen Sie uns Ihre E-Mail-Adresse bestätigen.' . "\n\n" . 
  'Wenn Sie keinen Newsletter wünschen, brauchen Sie nicht zu antworten.'. "\n\n");

define('EMAIL_CONFIRMATION_TEXT','Bitte klicken Sie auf den Link, um Ihr Newsletter Abonnement zu bestätigen:' . "\n\n" . '%s  '. "\n\n" );

define('EMAIL_CONTACT', 'Wenn Sie Hilfe zu unserem Service oder Onlineshop benötigen, schreiben Sie einfach an: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a>\n\n");
define('EMAIL_CLOSURE','Mit freundlichen Grüßen,' . "\n\n" . STORE_OWNER . "\nInhaber\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Diese E-Mail Adresse wurde uns von Ihnen oder einem unserer Kunden mitgeteilt. Wenn Sie kein Kundenkonto eröffnet haben, oder das Gefühl haben, die E-Mail ist falsch, dann antworten Sie nicht. Es wird kein Newsletter ohne Bestätigung versendet, und Sie werden keinen anderen erhalten. Wir freuen uns, Sie demnächst in unserem Shop begrüßen zu dürfen, und wenn Sie Fragen haben, setzen Sie sich mit uns in Verbindung.');
