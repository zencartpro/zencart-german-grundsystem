<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: products_to_categories.php 2909 2006-01-29 21:29:35Z ajeh $
//

define('HEADING_TITLE', 'Artikel - Mehrfachkategorie Link Manager ...');
    'Der Artikel zu Kategorie Verlinker wurde entwickelt um schnell einen Artikel mit ein oder mehreren anderen Kategorien verlinken zu k&ouml;nnen.<br />Es k&ouml;nnen auch alle Artikel einer Kategorie mit einer anderen Kategorie verlinkt werden. Selbstverst&auml;ndlich k&ouml;nnen bestehende Links mit dieses Tool wieder gel&ouml;scht werden. (siehe Information n&auml;chster Punkt)');
    'Zur Preisberechnung muss jeder Artikel einer Hauptkategorie zugewiesen sein, unabh&auml;ngig davon mit wievielen anderen Kategorien dieser verlinkt ist. Verwenden Sie dazu das Dropdown Feld "Hauptkategorie".<br />
Der Artikel ist aktuell folgenden Kategorien zugewiesen (siehe Checkbox). Einfach Checkbox neben Kategorienamen selektieren bzw. deselektiern um Verlinkung hinzu zuf&uuml;gen bzw. zu l&ouml;schen.<br />
Zum Speichern den Button ' . BUTTON_UPDATE_CATEGORY_LINKS . ' dr&uuml;cken.<br />'
    );

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiere ALLE Artikel einer Kategorie als VERLINKTE Artikel in eine andere ...</strong><br />z.B. 8 und 22 bedeutet das ALLE Artikel in Kategorie 8 zu Kategorie 22 verlinkt werden');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Entferne ALLE VERLINKTEN Artikel einer Kategorie ...</strong><br />z.B. Bei 8 und 22 werden ALLE Artikel-Links zu Kategorie 22 in Kategorie 8 entfernt');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>ALLE Artikel in der selektierten Kategorie sollen diese als Hauptkategorie verwenden ...</strong><br />z.B: Kategorie 22 zur&uuml;cksetzen bedeutet, dass ALLE Produkte in Kategorie 22, diese als HauptKategorie-ID verwenden');



?>