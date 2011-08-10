<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: salemaker_info.php 627 2010-08-30 15:05:14Z webchills $
 */

//  $Id: salemaker_info.php 627 2010-08-30 15:05:14Z webchills $
//

define('HEADING_TITLE','Abverkaufsmanager');
define('SUBHEADING_TITLE','Verwendungstipps für den Abverkaufsmanager:');
define('INFO_TEXT','<ul>
                      <li>
                        Verwenden Sie immer \'.\' als Trennzeichen für Dezimalstellen.
                      </li>
                      <li>
                        Tragen Sie Beträge immer in der Währung ein, in der Sie einen Artikel erstellt haben.
                      </li>
                      <li>
                        Im Reduzierungsfeld können Sie den Wert prozentuell oder als reduzierten Preis angeben. (Beispiel: &euro; 5.00 Ermäßigung auf alle Preise, 10% Reduzierung
                        aller Preise oder alle Preise auf &euro; 25.00 reduzieren)
                      </li>
                      <li>
                        Wenn Sie einen Preisbereich angeben, wirkt sich dieser auf alle Artikel aus, die in diesen Bereich hineinfallen. (z.B.
                        alle Artikel von &euro; 50.00 bis &euro; 150.00)
                      </li>
                      <li>
                        Wählen Sie diese Aktion, wenn ein Artikel ein Sonderangebot ist <i>und</i> von dem angelegten Abverkauf betroffen ist:
                                                <ul>
                          <li>
                            <strong>Sonderpreis ignorieren - Aktualisiere Artikelpreis und ersetze Sonderpreis durch den Abverkaufspreis</strong><br>
                                                        die Preisreduktion wird auf den Regulärpreis des Artikels angewendet.
                            (z.B. Regulärer Preis ist &euro;  10.00, der Sonderpreis beträgt &euro;  9.50, die Abverkaufsermäßigung beträgt 10%.
                                                        Der endgültige Preis des Artikels wird bei einem Abverkauf &euro;  9.00 betragen. Der Sonderpreis wird ignoriert.)
                          </li>
                          <li>
                            <strong>Ignoriere Abverkaufsermäßigung - ein Abverkauf wird nicht wirksam, so lange ein Sonderpreis existiert</strong><br>
                            Die Abverkaufsermäßigung wird sich nicht auf Sonderpreise auswirken. Der Sonderpreis wird weiterhin angezeigt als würde kein Abverkauf stattfinden. (z.B. Regulärer Preis ist &euro; 10.00, der Sonderpreis beträgt &euro; 9.50,
                            die Abverkaufsermäßigung beträgt 10%. Der endgültige Preis des Artikels wird bei einem Abverkauf &euro; 9.50 betragen.
                            Der Sonderpreis wird ignoriert.)
                          </li>
                          <li>
                            <strong>Abverkaufsermäßigung auf Sonderpreis anwenden - ansonsten auf Artikelpreis anwenden</strong><br>
                            Die Abverkaufsermäßigung wird auf Sonderpreise anwenden. Ein vermengter Preis wird angezeigt.
                            (z.B.. Der Reguläre Preis beträgt &euro; 10.00, der Sonderpreis beträgt &euro; 9.50, die Abverkaufsermäßigung beträgt 10%.
                            Der endgültige Preis des Artikels wird bei einem Abverkauf &euro; 8.55 betragen.
                            Also eine zusätzliche Ermäßigung von 10% auf den Sonderpreis.)
                          </li>
                        </ul>
                      </li>
                      <li>
                        Wenn Sie das Feld für das Startdatum leer lassen, startet der Abverkauf sofort.
                      </li>
                      <li>
                        Lassen Sie das Feld für das Enddatum leer, wenn der Zeitraum für den Abverkauf unbegrenzt sein soll.</li>
                      <li>
                        Die Auswahl einer Kategorie beinhaltet automatisch auch alle Unterkategorien.
                      </li>
                    </ul>');
define('TEXT_CLOSE_WINDOW','[ Fenster schließen ]');
