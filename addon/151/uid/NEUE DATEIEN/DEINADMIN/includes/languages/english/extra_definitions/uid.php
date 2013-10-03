<?php
define('ENTRY_COMPANY_TEXT', 'Only if you want we bill the Company for your order');
define('JS_COMPANY', '* The Company Name must have at least ' . ENTRY_COMPANY_MIN_LENGTH . ' characters.\n');
define('JS_UID', '* The VAT number must have at least ' . ENTRY_TVA_INTRACOM_MIN_LENGTH . ' characters.\n');
define('ENTRY_UID', 'VAT number:');
define('ENTRY_UID_CONTROL', '&nbsp;<span class="errorText">After checking, your VAT number is not correct or does not correspond to the entered country. Leave it blank if you don\'t know it.<br>
<!-- Optional BEGIN-->For info, it must be structured like this:<br></span>
<span class="smallText">
Germany:		\'DE\' + 9 numeric characters<br>
Austria:		\'AT\' + 9 numeric and alphanumeric characters<br>
Belgium:		\'BE\' + 10 numeric characters<br>
Denmark:		\'DK\' + 8 numeric characters<br>
Spain:			\'ES\' + 9 characters<br>
Finland:		\'FI\' + 8 numeric characters<br>
France:			\'FR\' + 2 figures (informatic key) + N° SIREN (9 figures)<br>
United Kingdom:	\'GB\' + 9 numeric characters<br>
Greece:			\'EL\' + 9 numeric characters<br>
Irlande:		\'IE\' + 8 numeric and alphabetic characters<br>
Italy:			\'IT\' + 11 numeric characters<br>
Luxembourg:		\'LU\' + 8 numeric characters<br>
Netherlands:	\'NL\' + 12 alphanumeric characters, one of them a letter<br>
Portugal:		\'PT\' + 9 numeric characters<br>
Sweden:			\'SE\' + 12 numeric characters<br>
Cyprus:			\'CY\' + 8 numeric characters and 1 alphabetic character<br>
Estonia:		\'EE\' + 9 numeric characters<br>
Hungary:		\'HU\' + 8 numeric characters<br>
Latvia:			\'LV\' + 11 numeric characters<br>
Lithuania:		\'LT\' + 9 or 12 numeric characters<br>
Malta:			\'MT\' + 8 numeric characters<br>
Poland:			\'PL\' + 10 numeric characters<br>
Slovakia:		\'SK\' + 9 or 10 numeric characters<br>
Czech Republic:	\'CZ\' + 8 or 9 or 10 numeric characters<br>
Slovania:		\'SI\' + 8 numeric characters<!-- Optional END-->');
define('ENTRY_UID_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_TVA_INTRACOM_MIN_LENGTH . ' chars.</span>');
define('ENTRY_UID_NO_VERIFY', '&nbsp;<span class="errorText">Impossible to check your VAT number: leave blank</span>');
define('ENTRY_UID_SHOP', 'VAT number of the shop :');