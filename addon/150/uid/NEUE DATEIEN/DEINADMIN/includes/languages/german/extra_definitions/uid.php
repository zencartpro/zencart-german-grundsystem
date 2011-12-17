<?php
define('ENTRY_COMPANY_TEXT', 'Nur wenn die Rechnung auf die Firma lauten soll');
define('JS_COMPANY', '* Der Firmenname muss mindestens ' . ENTRY_COMPANY_MIN_LENGTH . ' Zeichen haben.\n');
define('JS_TVA_INTRACOM', '* Die UID muss mindestens ' . ENTRY_TVA_INTRACOM_MIN_LENGTH . ' Zeichen haben.\n');
define('ENTRY_TVA_INTRACOM', 'UID:');
define('ENTRY_CONTROL_TVA_INTRACOM', '&nbsp;<span class="errorText">Ihre UID ist nicht korrekt oder passt nicht zum angegebenen Land. Wenn Sie die UID nicht wissen, dann lassen Sie das Feld bitte leer.<br />
<!-- Optional BEGIN-->Eine UID ist folgendermassen aufgebaut:<br></span>
<span class="smallText">
Deutschland:		\'DE\' + 9 numeric characters<br>
Österreich:		\'AT\' + 9 numeric and alphanumeric characters<br>
Belgien:		\'BE\' + 10 numeric characters<br>
Dänemark:		\'DK\' + 8 numeric characters<br>
Spanien:			\'ES\' + 9 characters<br>
Finnland:		\'FI\' + 8 numeric characters<br>
Frankreich:			\'FR\' + 2 figures (informatic key) + N° SIREN (9 figures)<br>
Grossbritannien:	\'GB\' + 9 numeric characters<br>
Griechenland:			\'EL\' + 9 numeric characters<br>
Irland:		\'IE\' + 8 numeric and alphabetic characters<br>
Italien:			\'IT\' + 11 numeric characters<br>
Luxembourg:		\'LU\' + 8 numeric characters<br>
Niederlande:	\'NL\' + 12 alphanumeric characters, one of them a letter<br>
Portugal:		\'PT\' + 9 numeric characters<br>
Schweden:			\'SE\' + 12 numeric characters<br>
Zypern:			\'CY\' + 8 numeric characters and 1 alphabetic character<br>
Estland:		\'EE\' + 9 numeric characters<br>
Ungarn:		\'HU\' + 8 numeric characters<br>
Lettland:			\'LV\' + 11 numeric characters<br>
Liauen:		\'LT\' + 9 or 12 numeric characters<br>
Malta:			\'MT\' + 8 numeric characters<br>
Polen:			\'PL\' + 10 numeric characters<br>
Slowakei:		\'SK\' + 9 or 10 numeric characters<br>
Tschechien:	\'CZ\' + 8 or 9 or 10 numeric characters<br>
Slowenien:		\'SI\' + 8 numeric characters<!-- Optional END-->');
define('ENTRY_TVA_INTRACOM_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_TVA_INTRACOM_MIN_LENGTH . ' Zeichen.</span>');
define('ENTRY_NO_VERIF_TVA_INTRACOM', '&nbsp;<span class="errorText">UID Nummer konnte nicht geprüft werden, bitte leer lassen</span>');
define('ENTRY_SHOP_INTRACOM', 'UID des Shops:');