<?php
/** 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: products_to_categories.php 2022-04-17 08:44:14Z webchills $
 */

define('HEADING_TITLE','Artikel in mehrere Kategorien verlinken');
define('HEADING_TITLE2','Kategorien / Artikel');//used by prev_next if HEADING_TITLE not defined...so never used!

//Select Product
define('TEXT_HEADING_PRODUCT_SELECT', 'Artikel auswählen');
define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'WARNUNG: Der zuvor ausgewählte Artikel ist nicht länger in dieser Kategorie verlinkt.');//when category is set, but no product filter set (no product selected)

// Change Master Category
define('TEXT_PRODUCTS_ID_INVALID', 'WARNING: Artikel ID#%u ist ungültig/existiert nicht in der Datenbank.');
define('TEXT_INFO_MASTER_CATEGORY_CHANGE','Ein Artikel hat immer eine Hauptkategorie-ID (für die Preisgestaltung), die als die Kategorie angesehen werden kann, in der das Produkt tatsächlich <i>aufbewahrt</i> wird. Darüber hinaus kann ein Produkt in eine beliebige Anzahl anderer Kategorien <i>verknüpft</i> (kopiert) werden, wobei der Preis aufgrund der Bedingungen in diesen verknüpften Kategorien geändert werden kann.<br>Die Hauptkategorie-ID kann mithilfe dieses Hauptkategorie-Dropdowns geändert werden, das nur die <strong>aktuell verknüpften</strong> Kategorien als mögliche Alternativen anbietet.<br>Um die Hauptkategorie-ID auf eine <strong>andere</strong> Kategorie zu setzen, verknüpfen Sie ihn zunächst mit einer neuen Kategorie mithilfe der unten stehenden Tabelle und aktualisieren Sie sie. Verwenden Sie dann diese Dropdown-Liste, um die Hauptkategorie der neuen Kategorie zuzuordnen.');

// Product InfoBox
define('TEXT_INFOBOX_HEADING_SELECT_PRODUCT', 'Wähle Artikel nach ID#');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Zeige Artikel zu Kategorien Links für: ');
define('TEXT_PRODUCTS_ID', 'Artikel ID# ');
define('TEXT_PRODUCTS_NAME', 'Artikel: ');
define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Aktualisiere Kategorie Links für');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Wähle anderen Artikel nach ID#');
define('BUTTON_CATEGORY_LISTING', 'Kategorie Liste');

// Link product to multiple categories
define('TEXT_HEADING_LINKED_CATEGORIES', 'Verlinkte Kategorien');
define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>WARNUNG:</strong> eine MASTER KATEGORIE ID muss zugeordnet sein');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO', '<p>Dieser Artikel ist derzeit mit den unten ausgewählten Kategorien verknüpft (Sie können die Anzahl der angezeigten Spalten auf <a target="_blank" href="configuration.php?&amp;gID=3">dieser Seite</a> ändern).<br>Um Links hinzuzufügen/zu entfernen, aktivieren/deaktivieren Sie die Kontrollkästchen nach Bedarf und klicken Sie dann auf den ' . BUTTON_UPDATE_CATEGORY_LINKS . ' klicken.</p><p>Weitere Artikel-/Kategorie-Aktionen sind über die unten stehenden globalen Tools verfügbar.</p>');
define('TEXT_LABEL_CATEGORY_DISPLAY_ROOT', 'Zeige die Unterkategorien unter:');
define('BUTTON_SET_DEFAULT_TARGET_CATEGORY', 'Als Standard setzen');
define('BUTTON_SET_DEFAULT_TARGET_CATEGORY_TITLE', 'Setze diese ausgewählte Ziel Kategorie als Standard');
define('TEXT_LABEL_SELECT_ALL_OR_NONE', 'Alle oder Keine wählen');
define('ERROR_CATEGORY_ID_INVALID', 'Verlinkte Kategorie ID#%u ungültig (nicht hinzugefügt).');
define('SUCCESS_PRODUCT_LINKED_TO_CATEGORIES', 'Artikel Links zu mehreren Kategorien aktualisiert für: %s');
define('WARNING_PRODUCT_UNLINKED_FROM_CATEGORY', 'Der Artikel wurde aus der zuvor gewählten Kategorie entfernt "%1$s" ID#%2$u, und wird daher nun in seiner Master Kategorie angezeigt.');
define('WARNING_MAX_INPUT_VARS_LIMIT', 'WARNUNG: Es sind %1$u Unterkategorien zum Verlinken auf dieser Seite verfügbar, was mehr ist als das PHP Limit "max_input_vars" (derzeit %2$u) erlaubt. Das bedeutet, dass nicht mehr als %2$u Kategorien verlinkt werden können, solange dieses PHP Limit nicht in Ihren Servereinstellungen erhöht wird.');

// Global Tools
define('HEADER_CATEGORIES_GLOBAL_TOOLS', 'Globale Artikel/Kategorie Tools');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', '<p>Hinweis: Ein Artikel muss nicht ausgewählt werden, um diese Werkzeuge zu verwenden. Wenn Sie jedoch oben einen Artikel auswählen, werden die verfügbaren Kategorien (und ihre ID-Nummern bei Mouseover) angezeigt.</p>');

// Copy linked categories from one product to another product
define('TEXT_HEADING_COPY_LINKED_CATEGORIES', 'Kopiere verlinkte Kategorien zu einem anderen Artikel');
define('TEXT_INFO_COPY_LINKED_CATEGORIES', 'Kopieren Sie die verknüpften Kategorien des aktuell ausgewählten Artikels auf einen anderen Artikel.<br>Sie können die verknüpften Kategorien dieses Artikels zum Zielartikel <strong>hinzufügen</strong> oder die verknüpften Kategorien des Zielartikels <strong>ersetzen</strong> (löschen+hinzufügen).<br>Hinweis: Diese Aktion kopiert nicht die Hauptkategorie des Quellartikels als verknüpfte Kategorie für die Zielkategorie, sondern nur die verknüpften Kategorien.');
define('TEXT_LABEL_ENABLE_COPY_LINKS', 'Aktiviere Artikelauswahl Dropdown (zeigt <b>alle</b> Artikel)');
define('TEXT_OPTION_LINKED_CATEGORIES', 'Wählen Sie den Ziel Artikel');
define('BUTTON_COPY_LINKED_CATEGORIES_ADD', 'Kopieren-Hinzufügen verlinkter Kategorien');
define('BUTTON_COPY_LINKED_CATEGORIES_REPLACE', 'Kopieren-Ersetzen verlinkter Kategorien');
define('SUCCESS_LINKED_CATEGORIES_COPIED_TO_TARGET_PRODUCT_ADD', 'Verlinkte Kategorien (%1$u) wurden hinzugefügt:<br>VON Referenz Artikel: %2$s<br>ZU Ziel Artikel: %3$s');
define('SUCCESS_LINKED_CATEGORIES_COPIED_TO_TARGET_PRODUCT_REPLACE', 'Verlinkte Kategorien (%1$u) für Ziel Artikel: %3$s<br>wurden <em>ersetzt</em> durch die verlinkten Kategorien des Artikels: %2$s');
define('WARNING_COPY_LINKED_CATEGORIES_NO_TARGET', 'Ziel Artikel wurde nicht ausgewählt!');
define('WARNING_COPY_LINKED_CATEGORIES_NO_ADDITIONAL', 'Nichts zu tun!<br>Quell Artikel: %1$s<br>hat keine <em>zusätzlichen</em> verlinkten Kategorien zum Kopieren von<br>Ziel Artikel: %2$s');
define('ERROR_MASTER_CATEGORY_MISSING', 'FEHLER: Master Kategorie ID fehlt in Tabelle "' . TABLE_PRODUCTS_TO_CATEGORIES . '"<br>für Artikel: %s');

// Copy as linked, all products from category source to category target
define('TEXT_HEADING_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', 'Verlinke (Kopiere) Artikel von einer Kategorie in eine andere Kategorie');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', 'Beispiel: Eine Kopie von Quellkategorie ID#8 nach Zielkategorie ID#22 erstellt verknüpfte Kopien ALLER Produkte, die sich in Kategorie 8 befinden, in Kategorie 22.');
define('TEXT_LABEL_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Wähle ALLE Artikel aus der Quell Kategorie ID#: ');
define('TEXT_LABEL_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Verlinke (Kopiere) zur Ziel Kategorie ID#: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Kopiere Artikel als verlinkt');
define('WARNING_CATEGORY_SOURCE_NOT_EXIST','<strong>Quell</strong> Kategorie ID#%u ungültig (existiert nicht)');
define('WARNING_CATEGORY_TARGET_NOT_EXIST','<strong>Ziel</strong> Kategorie ID#%u ungültig (existiert nicht)');
define('WARNING_CATEGORY_IDS_DUPLICATED', 'Warnung: gleiche Kategorie IDs (#%u)');
define('WARNING_CATEGORY_NO_PRODUCTS', '<strong>Quell</strong> Kategorie ID#%u ungültig (enthält keine Artikel)');
define('WARNING_CATEGORY_SUBCATEGORIES', '<strong>Ziel</strong> Kategorie ID#%u ungültig (enthält keine Unterkategorien)');
define('SUCCESS_PRODUCT_COPIED', 'Artikel: %1$s wurde verlinkt zu Kategorie ID#%2$u<br>');
define('SUCCESS_COPY_LINKED', '%1$u Artikel verlinkt von Quell Kategorie ID#%2$u zu Ziel Kategorie ID#%3$u');
define('WARNING_COPY_FROM_IN_TO_LINKED', 'WARNUNG: Keine Artikel kopiert (alle Artikel in Kategorie ID#%1$u sind bereits verlinkt in Kategorie ID#%2$u)');

// Remove linked products in reference category from target category
define('TEXT_HEADING_REMOVE_ALL_PRODUCTS_FROM_CATEGORY_LINKED', 'Entferne verlinkte Artikel aus einer Kategorie');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', 'Beispiel: Wenn Sie die Referenzkategorie #8 und die Zielkategorie #22 verwenden, werden alle verknüpften Artikel aus der Zielkategorie #22 entfernt, die in der Referenzkategorie #8 existieren. Kein Artikel in der Zielkategorie #22 kann eine Stammkategorie-ID von #22 haben (wenn dies der Fall ist, muss er einer anderen Kategorie neu zugewiesen werden).<br><strong>Aktuelle Kategorie-ID#%u.</strong>');
define('TEXT_LABEL_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Wähle ALLE Artikel in der Referenz Kategorie: ');
define('TEXT_LABEL_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Entferne alle verlinkten Artikel aus der Ziel Kategorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Entferne verlinkte Artikel');
define('SUCCESS_REMOVED_PRODUCT', 'Artikel: %1$s wurde entfernt aus Kategorie ID#%2$u<br>');
define('SUCCESS_REMOVE_LINKED_PRODUCTS', '%u lverlinkte Artikel entfernt');
define('WARNING_REMOVE_FROM_IN_TO_LINKED', 'WARNUNG: Nichts zu tun! Keine Artikel in Ziel Kategorie ID#%1$u sind verlinkt von Referenz Kategorie ID#%2$u');
define('WARNING_PRODUCT_MASTER_CATEGORY_IN_TARGET','Artikel: ID#%1$u "%2$s" (%3$s)<br>hat dieselbe Master Kategorie ID wie die Ziel Kategorie ID#%4$u<br>');
define('WARNING_REMOVE_LINKED_PRODUCTS_MASTER_CATEGORIES_ID_CONFLICT', '<strong>WARNUNG: MASTER KATEGORIE ID KONFLIKT!</strong><br>Referenzkategorie-ID#%1$u für die Entfernung von verknüpften Artikel in der Zielkategorie-ID#%2$u.<br>Sie haben die Entfernung einiger verknüpfter Artikel aus einer Zielkategorie beantragt. Einer oder mehrere dieser Artikel haben die gleiche Stammkategorie-ID wie die Zielkategorie. Das bedeutet, dass der Artikel nicht mit der Zielkategorie "verlinkt" ist, sondern in dieser Kategorie "wohnt" und daher nicht im Rahmen dieser Anfrage zum Entfernen von <i>verlinkten</i> Artikel entfernt werden kann.<br>Wenn Sie <i>den Artikel behalten</i> möchten, müssen Sie seine Hauptkategorie-ID in eine andere Kategorie ändern (d.h. es "verschieben"), bevor Sie diesen Vorgang erneut durchführen. Dies kann auf dieser Seite oder über die Aktion "Verschieben" auf einer Kategorie-Artikel-Liste-Seite geschehen. Der erste Artikel mit einer widersprüchlichen Hauptkategorie-ID wurde bereits zur Bearbeitung ausgewählt.<br>Wenn Sie diesen Artikel <i>löschen</i> möchten, müssen Sie die Aktion "Löschen" auf der Kategorie-Artikel-Liste Seite verwenden.');

// Reset Master Categories ID for all products in a category
define('TEXT_HEADING_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', 'Zurücksetzen der Master Kategorie ID für ALLE Artikel in einer Kategorie');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', 'Beispiel: Rücksetzen von Kategorie 22 wird die Master Kategorie ID von 22 auf ALLE Artikel in Kategorie 22 anwenden.');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Zurücksetzen der Master Kategorie ID für ALLE Artikel in Kategorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Master Kategorie ID zurücksetzen');
define('SUCCESS_RESET_PRODUCTS_MASTER_CATEGORY', 'Alle Artikel in Kategorie ID#%1$d wurden zurückgesetzte auf die Master Kategorie ID#%1$d');
define('TEXT_CATEGORIES_NAME', 'Kategorie Name');
