<?php
define('BOX_HEADING_SUBSCRIBE', 'Newsletter'); // sidebox title
define('BUTTON_IMAGE_SUBSCRIBE', 'button_subscribe.gif');
define('BUTTON_SUBSCRIBE_ALT', 'Abonnieren');
define('BOX_SUBSCRIBE_DEFAULT_TEXT', 'Tragen Sie Ihre E-Mail Adresse ein, um unseren Newsletter zu abonnieren.');
  
// header Subscribe Button/Box Subscribe Button
define('HEADER_SUBSCRIBE_LABEL', 'Newsletter:'); // header text before input field
define('HEADER_SUBSCRIBE_BUTTON','Abonnieren'); // button text for css buttons
define('HEADER_SUBSCRIBE_DEFAULT_TEXT', 'Ihre E-Mail Adresse'); // in input field

define('TEXT_SUBSCRIBER_DEFAULT_NAME', 'Newsletter Abonnement');

define('TEXT_NEWSONLY_SUBSCRIPTIONS_DISABLED','Zur Zeit ist ein Newsletter-Abonnement nicht möglich. Bitte entschuldigen Sie, wenn Sie diese Seite irrtümlicherweise erhalten haben. Wir würden uns freuen Sie als Kunde in unserem Shop begrüßen zu dürfen.');

define('SUBSCRIBE_DUPLICATE_CUSTOMERS_ERROR', 'Es gibt bereits einen Kunden, der diese E-Mail-Adresse verwendet. Um den Newsletter zu erhalten, bitte melden Sie sich <a href="index.php?main_page=login">hier</a> an und gehen Sie auf Ihr Konto. <a href="index.php?main_page=password_forgotten">Hier klicken</a> wenn Sie Ihr Passwort vergessen haben.');
define('SUBSCRIBE_DUPLICATE_NEWSONLY_ERROR', 'Diese E-Mail-Adresse hat bereits ein Newsletter Abonnement.  Wenn Sie die Bestätigungsmail nicht erhalten haben, senden Sie uns eine Mail an <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>, um eine neue Bestätigungsmail zu erhalten.');
define('SUBSCRIBE_DUPLICATE_NEWSONLY_ACCT', 'Diese E-Mail Adresse ist bereits in unserem Newsletter eingetragen.');
define('SUBSCRIBE_MERGED_NEWSONLY_ACCT', 'Diese E-Mail Adresse ist bereits in unserem Newsletter eingetragen. Ihr Abonnement wurde Ihrem Kundenkonto hinzugefügt. Sie können jetzt Ihr Newsletter-Abonnement von Ihrem Konto aus verwalten.');
define('SUBSCRIBE_NEWSLETTER_ONLY', 'Newsletter Abonnement:');
define('SUBSCRIBE_NEWSLETTER_ONLY2', '(Überprüfen Sie, wenn Sie zurzeit unseren Newsletter erhalten, aber kein Kundenkonto haben.)');
define('SUBSCRIBE_DUPLICATE_OTHER_ACCT', 'Diese E-Mail Adresse wird bereits von einem anderem Kunden verwendet.');
define('SUBSCRIBE_DUPLICATE_CONFIRM_ERROR', 'Diese E-Mail Adresse hat bereits ein Newsletter Abonnement.');
define('SUBSCRIBE_NONEXISTANT_EMAIL_ERROR','Diese E-Mail Adresse ist nicht registriert.');
define('SUBSCRIBE_MULTIPLE_EMAIL_ERROR','Bitte setzen Sie sich mit <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a> bzgl. Ihres Abonnements in Verbindung.');