<?php
/**
 * export_customerdata_all_csv
 *
 * @package Export Customer Data as CSV
 * @copyright Copyright 2010, webchills www.webchills.at
 * @copyright Portions Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2009 911-need-code-help.blogspot.com
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: export_customerdata_all_csv.php 675 2010-10-27 10:46:10 webchills $
 */
  chdir('../');
require_once('includes/application_top.php');

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  //
  // execute sql query
  //
 $result = mysql_query("SELECT 
c.customers_firstname as 'Vorname',
c.customers_lastname as 'Nachname',
c.customers_email_address as 'Email',
ab.entry_company as 'Firma',
ab.entry_street_address as 'Adresszeile 1',
ab.entry_suburb as 'Adresszeile 2',
ab.entry_postcode as 'PLZ',
ab.entry_city as 'Ort',
co.countries_name as 'Land',
c.customers_telephone as 'Telefon'
FROM
" . TABLE_CUSTOMERS . " c,
" . TABLE_ADDRESS_BOOK . " ab
LEFT JOIN " . TABLE_ZONES . " z ON (ab.entry_zone_id = z.zone_id
and ab.entry_country_id = z.zone_country_id)
left join " . TABLE_COUNTRIES . " co ON ab.entry_country_id = co.countries_id
WHERE
ab.customers_id=c.customers_id
and ab.address_book_id = c.customers_default_address_id;"); // Start our query of the database
  //
  // send response headers to the browser
  // following headers instruct the browser to treat the data as a csv file called export.csv
  //
  header( 'Content-Type: text/csv' );
  header( 'Content-Disposition: attachment;filename=kundendaten.csv' );
  //
  // output header row (if atleast one row exists)
  //
  $row = mysql_fetch_assoc( $result );
  if ( $row )
  {
    echocsv( array_keys( $row ) );
  }
  //
  // output data rows (if atleast one row exists)
  //
  while ( $row )
  {
    echocsv( $row );
    $row = mysql_fetch_assoc( $result );
  }
  //
  // echocsv function
  //
  // echo the input array as csv data maintaining consistency with most CSV implementations
  // * uses double-quotes as enclosure when necessary
  // * uses double double-quotes to escape double-quotes 
  // * uses CRLF as a line separator
  //
  function echocsv( $fields )
  {
    $separator = '';
    foreach ( $fields as $field )
    {
      if ( preg_match( '/\\r|\\n|,|"/', $field ) )
      {
        $field = '"' . str_replace( '"', '""', $field ) . '"';
      }
      echo $separator . $field;
      $separator = ',';
    }
    echo "\r\n";
  }
?>
