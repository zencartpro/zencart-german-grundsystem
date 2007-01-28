<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: salemaker_info.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE','Abverkaufsmanager');
define('SUBHEADING_TITLE','Verwendungstipps f&uuml;r den Abverkaufsmanager:');
define('INFO_TEXT','<ul>
                      <li>
                        Verwenden Sie immer \'.\' als Trennzeichen f&uuml;r Dezimalstellen.
                      </li>
                      <li>
                        Tragen Sie Betr&auml;ge immer in der W&auml;hrung ein, in der Sie einen Artikel erstellt haben.
                      </li>
                      <li>
                        Im Reduzierungsfeld k&ouml;nnen Sie den Wert prozentuell oder als reduzierten Preis angeben. (Beispiel: &euro; 5.00 Erm&auml;&szlig;igung auf alle Preise, 10% Reduzierung
                        aller Preise oder alle Preise auf &euro; 25.00 reduzieren)
                      </li>
                      <li>
                        Wenn Sie einen Preisbereich angeben, wirkt sich dieser auf alle Artikel aus, die in diesen Bereich hineinfallen. (z.B.
                        alle Artikel von &euro; 50.00 bis &euro; 150.00)
                      </li>
                      <li>
                        W&auml;hlen Sie diese Aktion, wenn ein Artikel ein Sonderangebot ist <i>und</i> Subjekt dieses Abverkaufs ist:
                                                <ul>
                          <li>
                            <strong>Sonderpreis ignorieren - Aktualisiere Artikelpreis und ersetze Sonderpreis durch den Abverkaufspreis</strong><br>
                                                        die Preisreduktion wird auf den Regul&auml;rpreis des Artikels angewendet.
                            (z.B. Regul&auml;rer Preis ist &euro;  10.00, der Sonderpreis betr&auml;gt &euro;  9.50, die Abverkaufserm&auml;&szlig;igung betr&auml;gt 10%.
                                                        Der endg&uuml;ltige Preis des Artikels wird bei einem Abverkauf &euro;  9.00 betragen. Der Sonderpreis wird ignoriert.)
                          </li>
                          <li>
                            <strong>Ignoriere Abverkaufserm&auml;&szlig;igung - ein Abverkauf wird nicht wirksam, so lange ein Sonderpreis existiert</strong><br>
                            Die Abverkaufserm&auml;&szlig;igung wird sich nicht auf Sonderpreise auswirken. Der Sonderpreis wird weiterhin angezeigt als w&uuml;rde kein Abverkauf stattfinden. (z.B. Regul&auml;rer Preis ist &euro; 10.00, der Sonderpreis betr&auml;gt &euro; 9.50,
                            die Abverkaufserm&auml;&szlig;igung betr&auml;gt 10%. Der endg&uuml;ltige Preis des Artikels wird bei einem Abverkauf &euro; 9.50 betragen.
                            Der Sonderpreis wird ignoriert.)
                          </li>
                          <li>
                            <strong>Abverkaufserm&auml;&szlig;igung auf Sonderpreis anwenden - ansonsten auf Artikelpreis anwenden</strong><br>
                            Die Abverkaufserm&auml;&szlig;igung wird auf Sonderpreise anwenden. Ein vermengter Preis wird angezeigt.
                            (z.B.. Der Regul&auml;re Preis betr&auml;gt &euro; 10.00, der Sonderpreis betr&auml;gt &euro; 9.50, die Abverkaufserm&auml;&szlig;igung betr&auml;gt 10%.
                            Der endg&uuml;ltige Preis des Artikels wird bei einem Abverkauf &euro; 8.55 betragen.
                            Also eine zus&auml;tzliche Erm&auml;&szlig;igung von 10% auf den Sonderpreis.)
                          </li>
                        </ul>
                      </li>
                      <li>
                        Wenn Sie das Feld f&uuml;r das Startdatum leer lassen, startet der Abverkauf sofort.
                      </li>
                      <li>
                        Lassen Sie das Feld f&uuml;r das Enddatum leer, wenn der Zeitraum f&uuml;r den Abverkauf unbegrenzt sein soll.</li>
                      <li>
                        Die Auswahl einer Kategorie beinhaltet automatisch auch alle Unterkategorien.
                      </li>
                    </ul>');
define('TEXT_CLOSE_WINDOW','[ Fenster schlie&szlig;en ]');


?>