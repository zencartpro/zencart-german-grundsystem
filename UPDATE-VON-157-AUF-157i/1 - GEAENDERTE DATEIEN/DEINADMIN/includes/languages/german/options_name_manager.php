<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: options_name_manager.php 2023-10-28 20:13:16Z webchills $
 */

define('HEADING_TITLE', 'Attributnamen Manager');
define('TEXT_ATTRIBUTES_CONTROLLER', 'Attributmanager');

define('TEXT_WARNING_TEXT_OPTION_NAME_RESTORED', 'Warnung: Der Optionswert TEXT ID#0 wurde in der Datenbanktabelle "' . TABLE_PRODUCTS_OPTIONS_VALUES . '" nicht gefunden. Dies könnte auf ein falsch codiertes Plugin zurückzuführen sein.<br> Der Wert wurde korrekt wiederhergestellt.');


define('TEXT_PRODUCT_OPTIONS_INFO','<strong>Hinweis: Bearbeiten Sie den Optionsnamen für zusätzliche Einstellungen</strong>');

define('TEXT_WARNING_OF_DELETE', 'Dieser Attributname wird von dem/den unten aufgeführten Artikel(n) verwendet: Er kann erst gelöscht werden, wenn alle Attributmerkmale, die mit diesem Attributnamen verbunden sind, aus diesen Artikeln entfernt wurden (dies kann mit den unten aufgeführten globalen Tools erledigt werden)');
define('TEXT_OK_TO_DELETE', 'Dieser Attributname wird von keinem Artikel verwendet - es ist sicher, ihn zu löschen.<br><strong>Warnung:</strong> Dies löscht sowohl den Attributnamen als auch alle Attributmerkmale, die mit diesem Attributnamen verbunden sind.');



define('TEXT_WARNING_DUPLICATE_OPTION_NAME','Option ID#%1$u: Doppelter Attributname hinzugefügt: "%2$s" (%3$s)');

define('TEXT_ORDER_BY','Sortiere nach');




define('TEXT_OPTION_NAME_COMMENTS','Kommentar (angezeigt beim Attributnamen)');
define('TEXT_OPTION_NAME_COMMENTS_POSITION' , 'Position für Kommentar');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_PER_ROW', 'Attribut Bilder pro Reihe');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE', 'Attribut Bild Layout Stil (nur für Checkbox/Radio Buttons)');
define('TEXT_OPTION_ATTRIBUTE_LAYOUTS_EXAMPLE', 'Beispiele zeigen');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_0', '0 - Auswahl + Text, Bilder unter den Optionen');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_1', '1 - Auswahl + Bild + Option inline');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_2', '2 - Auswahl + Option + Bild wrapped');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_3', '3 - Auswahl + Bild + Option wrapped');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_4', '4 - Bild + Option + Auswahl als Spalte');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_5', '5 - Auswahl + Bild + Option als Spalte');

define('TEXT_OPTION_NAME_ROWS', 'Zeilen');
define('TEXT_OPTION_NAME_SIZE','Anzeigegröße');
define('TEXT_OPTION_NAME_MAX','Maximale Länge');
define('TEXT_OPTION_TYPE_TEXT_ATTRIBUTE_INFO', 'Hinweis: ' . TEXT_OPTION_NAME_ROWS . ', ' . TEXT_OPTION_NAME_SIZE . ' und ' . TEXT_OPTION_NAME_MAX . ' sind nur für den Attributnamen Typ "Text".');
define('TEXT_INSERT_NEW_OPTION_NAME', 'Neuen Attributnamen hinzufügen');


define('TEXT_GLOBAL_TOOLS', 'Globale Tools');
define('TEXT_CLICK_TO_SHOW_HIDE', 'clicken zum Anzeigen/Ausblenden');
define('TEXT_WARNING_BACKUP', 'Wichtig: Erstellen Sie immer eine überprüfte Sicherungs Ihrer Datenbank, bevor Sie globale Tools verwenden.');
define('TEXT_SELECT_OPTION_TYPES_ALLOWED', 'Beachten Sie, dass Globale Tools nicht mit Attributnamen vom Typ "Text" oder "Datei" verwendet werden können.');
define('TEXT_SELECT_PRODUCT', 'Wählen Sie einen Artikel');
define('TEXT_SELECT_CATEGORY', 'Wählen Sie eine Kategorie');
define('TEXT_SELECT_OPTION', 'Wählen Sie einen Attributnamen');
define('TEXT_NAME', 'Name');


define('TEXT_INFO_OPTION_VALUES_ADD', '<strong>Hinweis:</strong> Für Artikel, die mit den <b>Hinzufügen</b> Tools aktualisiert werden (zusätzliche Attributmerkmale erhalten), wird die Sortierreihenfolge für die Attributmerkmale auf die <strong>Standardsortierreihenfolge</strong> für diesen Attributnamen zurückgesetzt.');

define('TEXT_OPTION_VALUE_ADD_ALL', 'Aktualisieren (Hinzufügen) aller verbleibenden Attributmerkmale zu ALLEN Produkten, die diesen Attributnamen verwenden');
define('TEXT_INFO_OPTION_VALUE_ADD_ALL', 'Für ALLE Artikel, die den ausgewählten Attributnamen verwenden (und denen somit mindestens ein Attributmerkmal zugewiesen ist), ALLE anderen Attributmerkmale hinzufügen, die mit dem Attributnamen verbunden sind');

define('TEXT_OPTION_VALUE_ADD_PRODUCT', 'Aktualisieren (Hinzufügen) aller verbleibenden Attributmerkmale zu EINEM Artikel, der diesen Attributnamen verwendet');
define('TEXT_INFO_OPTION_VALUE_ADD_PRODUCT', 'Für einen Artikel, der den ausgewählten Attributnamen verwendet (und dem somit mindestens ein Attributmerkmal zugewiesen ist), ALLE anderen Attributmerkmale hinzufügen, die mit dem Attributnamen verbunden sind');

define('TEXT_OPTION_VALUE_ADD_CATEGORY', 'Aktualisieren (Hinzufügen) aller verbleibenden Attributmerkmale für ALLE Artikel in einer Kategorie, die diesen Attributnamen verwenden');
define('TEXT_INFO_OPTION_VALUE_ADD_CATEGORY', 'Für Artikel in nur EINER Kategorie, die den ausgewählten Attributnamen verwenden, ALLE anderen Attributmerkmale hinzufügen, die mit dem Attributnamen verbunden sind');
define('TEXT_SHOW_CATEGORY_PATH', 'Zeige Kategorie Pfad');
define('TEXT_SHOW_CATEGORY_NAME', 'Zeige nur Kategorie Name');


define('SUCCESS_PRODUCT_OPTION_VALUE', 'Attributname "%1$s": Attributmerkmal "%2$s" hinzugefügt zu Artikel "%3$s".');
define('SUCCESS_PRODUCT_OPTIONS_VALUES_SORT_ORDER', 'Attributname "%1$s": Artikel "%2$s" Attributmerkmale aktualisiert mit Standardsortierung für Attributname "%1$s".');
define('SUCCESS_PRODUCTS_OPTIONS_VALUES', 'Attributname "%1$s": %2$u Artikel aktualisiert mit zusätzlichen Attributmerkmalen.');

define('ERROR_PRODUCTS_OPTIONS_PRODUCTS', 'Warnung: Keine passenden Artikel mit dem Attributnamen "%s" gefunden (nichts wurde aktualisiert).');
define('ERROR_PRODUCTS_OPTIONS_VALUES', 'Warnung: Alle passenden Artikel haben bereits alle Attributmerkmale für Attributname "%s" (nichts wurde aktualisiert).');


define('TEXT_COMMENT_OPTION_VALUE_DELETE_ALL', '<strong>Hinweis:</strong> Alle Attributmerkmale werden für den/die ausgewählte(n) Artikel gelöscht. Dies löscht nicht die Attributmerkmale selbst, die für diesen Attributnamen definiert wurden.');
define('TEXT_OPTION_VALUE_DELETE_ALL', 'Alle Attributmerkmale aus ALLEN Artikeln löschen, die diesen Attributnamen verwenden');
define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Für ALLE Artikel, die den ausgewählten Attributnamen verwenden, alle Attributmerkmale/Attributnamen entfernen');

define('TEXT_OPTION_VALUE_DELETE_PRODUCT', 'Alle Attributmerkmale aus EINEM Artikel mit diesem Attributnamen löschen');
define('TEXT_INFO_OPTION_VALUE_DELETE_PRODUCT', 'Für einen Artikel, der den ausgewählten Attributnamen verwendet, ALLE Attributmerkmale/Attributnamen entfernen');

define('TEXT_OPTION_VALUE_DELETE_CATEGORY', 'Alle Attributmerkmale aus EINER Kategorie von Artikel für diesen Attributnamen löschen');
define('TEXT_INFO_OPTION_VALUE_DELETE_CATEGORY', 'Für Artikel in nur EINER Kategorie, die den ausgewählten Attributnamen verwenden, ALLE Attributmerkmale/Attributnamen entfernen');


define('SUCCESS_PRODUCT_OPTION_VALUES_DELETED', 'Attributname "%1$s": alle Attributmerkmale entfernt von Artikel "%2$s".');
define('SUCCESS_PRODUCTS_OPTIONS_VALUES_DELETED', 'Attributname "%1$s": alle Attributmerkmale entfernt von %2$u Artikel(n).');


define('TEXT_OPTION_VALUE_COPY_ALL', 'Kopiere alle Attributmerkmale zu einem anderen Attributnamen');
define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Alle Attributmerkmale des ausgewählten Attributnamens werden zu einem anderen Attributnamen kopiert (hinzugefügt).');
define('TEXT_SELECT_OPTION_FROM', 'Kopiere von Attributname: ');
define('TEXT_SELECT_OPTION_TO', 'Kopiere zu Attributname: ');

define('SUCCESS_OPTION_VALUE_COPIED', 'Attributmerkmal "%6$s" ID#%5$u kopiert von Attributname "%2$s" ID#%1$u zu Attributname "%4$s" ID#%3$u.');
define('SUCCESS_OPTION_VALUES_COPIED', '%5$u Attributmerkmal(e) kopiert von Attributname "%2$s" ID#%1$u zu Attributname "%4$s" ID#%3$u.');
define('ERROR_OPTION_VALUES_COPIED', 'Fehler: Kann Attributmerkmale nicht um selben Attributnamen kopieren ("%2$s" ID#%1$u zu "%4$s" ID#%3$u)!');
define('ERROR_OPTION_VALUES_NONE', 'Fehler: Attributname "%2$s" ID#%1$u hat keine Attributmerkmale definiert (es gibt nichts zu kopieren)!');