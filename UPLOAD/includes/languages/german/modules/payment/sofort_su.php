<?php
define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'Sofort.');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_LOGO', '<br /> <img src="https://cdn.klarna.com/1.0/shared/image/generic/badge/de_de/pay_now/descriptive/pink.svg" height="30px" alt="Sofort."/>');

define('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION', 'Einfach und direkt bezahlen mit Sofort Überweisung<br/><br/><img src="images/klarna_sofort.png" alt="Sofort."/><br/><br/><a href="https://www.klarna.com/sofort/business/mit-sofort-verkaufen/" target="_blank"><u>Registrieren Sie sich bei Sofort</u></a>, um diese Zahlungsart anbieten zu können.<br/><br/>Bereits registriert? <a href="https://www.sofort.com/payment/users/login" target="_blank"><u>Klarna Händler Login</u></a>');

define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'Sofort. Modul aktivieren');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'Aktiviert/deaktiviert das komplette Modul');

define('MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY_TITLE', 'Konfigurationsschlüssel');
define('MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY_DESC', 'Von SOFORT AG zugewiesener Konfigurationsschlüssel');

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', 'Empfohlene Zahlungsweise');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', 'Diese Zahlart als "empfohlene Zahlungsart" markieren. Auf der Bezahlseite erfolgt ein Hinweis direkt hinter der Zahlungsart.');

define('MODULE_PAYMENT_SOFORT_SU_REASON_ONE_TITLE', 'Verwendungszweck 1');
define('MODULE_PAYMENT_SOFORT_SU_REASON_ONE_DESC', 'Im Verwendungszweck 1 können folgende Optionen ausgewählt werden');

define('MODULE_PAYMENT_SOFORT_SU_REASON_TWO_TITLE', 'Verwendungszweck 2');
define('MODULE_PAYMENT_SOFORT_SU_REASON_TWO_DESC', 'Im Verwendungszweck (maximal 27 Zeichen) werden folgende Platzhalter ersetzt:<br /> {{order_id}}<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}} <br />Bitte beachten Sie: Wenn die Bestellung nach Weiterleitung erstellt wird, kann der Platzhalter {{order_id}} nicht verwendet werden!');

define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', 'Zahlungszone');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, gilt die Zahlungsmethode nur für diese Zone.<br/>Voreinstellung: kein<br/><br/>Lassen Sie diese Einstellung auf kein und stellen Sie weiter unten die Länder dezidiert ein, für die Sie Sofort anbieten wollen.');

define('MODULE_PAYMENT_SOFORT_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br />Profieinstellungen</span> ');
define('MODULE_PAYMENT_SOFORT_PROF_SETTINGS_DESC', 'Folgende Einstellungen bedürfen normalerweise keiner Anpassung und sollten bereits mit den korrekten Werten vorbelegt sein.');

define('MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID_TITLE', 'Temporärer Bestellstatus');
define('MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID_DESC', 'Bestellstatus für nicht abgeschlossene Transaktionen. Die Bestellung wurde erstellt aber die Transaktion von der SOFORT AG noch nicht bestätigt.');

define('MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID_TITLE', 'Bestellstatus bei abgebrochener Zahlung');
define('MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID_DESC', 'Bestellstatus bei Bestellungen, die während des Bezahlvorgangs abgebrochen wurden.'); 

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Bestätigter Bestellstatus');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Bestätigter Bestellstatus<br />Bestellstatus nach abgeschlossener Transaktion.'); 

define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', 'Bestellstatus, wenn kein Geld angekommen ist');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', 'Status der Bestellung falls kein Geld auf Ihrem Konto eingegangen ist. (Voraussetzung: Konto bei der Deutsche Handelsbank).'); 

define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'Geldeingang');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', 'Status für Bestellungen, wenn das Geld auf dem Konto der Deutsche Handelsbank angekommen ist.'); 

define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Teilerstattung');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', 'Status für Bestellungen, bei denen ein Teilbetrag an den Käufer zurückerstattet wurde.'); 

define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'Vollständige Erstattung');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', 'Status für Bestellungen, bei denen der vollständige Betrag an den Käufer zurückerstattet wurde.'); 

define('MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER_TITLE', 'Bestellung vor Weiterleitung erstellen:');
define('MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER_DESC', 'Voreinstellung: False<br/><br/><b>Lassen Sie diese Einstellung auf False!<br/>Es wird sonst direkt nach Auswahl der Zahlungsart Sofort bereits eine Bestellung angelegt. Das ist in der Praxis nicht empfehlenswert, da es zu sinnlosen Mehrfachbestellungen führt, falls der Kunde die Zahlung nicht abschließt.<br/>Mit der Einstellung False wird die Bestellung erst dann generiert, wenn der Bezahlvorgang wirklich abgeschlossen wurde</b><br/>');

define('MODULE_PAYMENT_SOFORT_SU_LOGO_TITLE', 'Banner oder Text bei der Auswahl der Zahlungsoptionen');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_DESC', 'Voreinstellung: Banner<br/><br/>Wenn Sie Text wählen wird zusätzlich zum Sofort Logo ein kurzer Hinweistext angezeigt.');

define('MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION_TITLE', 'Käuferschutz aktiviert');
define('MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION_DESC', 'Käuferschutz für Sofort. aktivieren');

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'Reihenfolge der Anzeige');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Reihenfolge der Anzeige. Kleinste Ziffer wird zuerst angezeigt.');

define('MODULE_PAYMENT_SOFORT_SU_COUNTRIES_TITLE', 'Länder');
define('MODULE_PAYMENT_SOFORT_SU_COUNTRIES_DESC', 'Für welche Länder wollen Sie Sofort. anbieten? Zweistellige ISO-Codes durch Komma getrennt!');

define('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://www.klarna.com/de/\',\'Kundeninformationen\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_CHECKOUT', '(Empfohlene Zahlungsweise)');

define('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'SOFORT Überweisung');

define('MODULE_PAYMENT_SOFORT_SU_CHECKOUT_TEXT', 'Einfach und direkt bezahlen');
define('MODULE_PAYMENT_SOFORT_SU_CHECKOUT_TEXT_KS', 'Einfach und direkt bezahlen');
define('MODULE_PAYMENT_SOFORT_SU_CHECKOUT_INFOLINK_KS', 'https://www.klarna.com/de/');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'Die gewählte Zahlart ist leider nicht möglich oder wurde auf Kundenwunsch abgebrochen. Bitte wählen Sie eine andere Zahlweise.');