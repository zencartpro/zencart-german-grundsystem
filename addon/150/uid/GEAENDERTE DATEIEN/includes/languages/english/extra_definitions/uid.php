<?php
define('ENTRY_UID', 'VAT number:');
define('ENTRY_UID_ERROR', 'VAT number of your Company must contain a minimum of ' . ENTRY_TVA_INTRACOM_MIN_LENGTH . ' characters.');
define('ENTRY_UID_TEXT', 'European companies only');
define('ENTRY_UID_CONTROL', 'The VAT number does not match server request. Please, leave it blank.<br />
<!-- Optional BEGIN-->
Here are some specs.<br>
Germany: \'DE\' + 9 numeric characters<br>
Austria: \'AT\' + 9 numeric and alphanumeric characters<br>
Belgium : \'BE\' + 9 numeric characters<br>
Denmark : \'DK\' + 8 numeric characters<br>
Spain: \'ES\' + 9 characters<br>
Finland : \'FI\' + 8 numeric characters<br>
France: \'FR\' + 2 figures (informatic key) + N° SIREN (9 figures)<br>
United Kingdom: \'GB\' + 9 numeric characters<br>
Greece: \'EL\' + 9 numeric characters<br>
Irlande : \'IE\' + 8 numeric and alphabetic characters<br>
Italy : \'IT\' + 11 numeric characters<br>
Luxembourg: \'LU\' + 8 numeric characters<br>
Netherlands: \'NL\' + 12 alphanumeric characters, one of them a letter<br>
Portugal : \'PT\' + 9 numeric characters<br>
Sweden : \'SE\' + 12 numeric characters<br>
Cyprus : \'CY\' + 8 numeric characters and 1 alphabetic character<br>
Estonia : \'EE\' + 9 numeric characters<br>
Hungary : \'HU\' + 8 numeric characters<br>
Latvia : \'LV\' + 11 numeric characters<br>
Lithuania : \'LT\' + 9 or 12 numeric characters<br>
Malta : \'MT\' + 8 numeric characters<br>
Poland : \'PL\' + 10 numeric characters<br>
Slovakia : \'SK\' + 9 or 10 numeric characters<br>
Czech Republic : \'CZ\' + 8 or 9 or 10 numeric characters<br>
Slovania : \'SI\' + 8 numeric characters<!-- Optional END-->');
define('ENTRY_UID_NO_VERIFY', 'Server is unable to check your VAT number: please, leave blank');
define('ENTRY_UID_CONTROL_COUNTRY', 'VAT number does not match the country. Please leave it blank if correct number is unknown');
define('UID_TEXT_NO_TAX', 'Tax');