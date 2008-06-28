<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2005 Joshua Dechant                                    |
// |                                                                      |   
// | Portions Copyright (c) 2004 The zen-cart developers                  |
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
// $Id: seo.php
//

define('TABLE_SEO_CACHE', DB_PREFIX . 'seo_cache');

$poLang = array();

// german
$poLang['43'] = array(
    'SEO_ENABLED' => array('SEO URLs aktivieren?', 'SEO URLs aktivieren? Generelle Einstellung zum kompletten Abschalten.'),
    'SEO_ADD_CPATH_TO_PRODUCT_URLS' => array('Kategorienummer als cPath an die Produktlinks anhaengen?', 'Kategorienummer wird als cPath angehaengt (z.B. - some-product-p-1.html?cPath=xx).'),
    'SEO_ADD_CAT_PARENT' => array('Oberkategorienamen am Anfang der Kategorielinks anzeigen?', 'Uebergeordnete Kategorie wird in Kategorielinks angezeigt (z.B. - parent-category-c-1.html).'),
    'SEO_URLS_FILTER_SHORT_WORDS' => array('Kurze Worte ausfiltern', 'Worte mit weniger oder gleich viel Buchstaben wie hier eingestellt werden aus der URL entfernt.'),
    'SEO_URLS_USE_W3C_VALID' => array('W3C valide URLs ausgeben?', 'Die ausgegebenen URLs sind W3C konform.'),
    'USE_SEO_CACHE_GLOBAL' => array('SEO Cache aktivieren?', 'Generelle Einstellung, die den Cache komplett abschaltet.'),
    'USE_SEO_CACHE_PRODUCTS' => array('Produkt Cache aktivieren?', 'Produktcache deaktivieren.'),
    'USE_SEO_CACHE_CATEGORIES' => array('Kategorie Cache aktivieren?', 'Kategoriecache deaktivieren.'),
    'USE_SEO_CACHE_MANUFACTURERS' => array('Hersteller Cache aktivieren?', 'Herstellercache deaktivieren.'),
    'USE_SEO_CACHE_ARTICLES' => array('Artikel Cache?', 'Artikelcache deaktivieren.'),
    'USE_SEO_CACHE_INFO_PAGES' => array('Infoseiten Cache aktivieren?', 'Infoseitencache deaktivieren.'),
    'USE_SEO_REDIRECT' => array('Automatische Redirects aktivieren?', 'Automatischen Redirect aktivieren. 301 Header wird fuer alte an neue URLs uebermittelt.'),
    'SEO_REWRITE_TYPE' => array('URL Rewrite Typ festlegen', 'Welches SEO URL Format soll genutzt werden.'),
    'SEO_CHAR_CONVERT_SET' => array('Umlaute umschreiben', 'Umlaute sollte man umschreiben lassen.<br><br>Das Format <b>MUSS</b> so sein: <b>zeichen1=>wunschzeichen1,zeichen2=>wunschzeichen2</b>'),
    'SEO_REMOVE_ALL_SPEC_CHARS' => array('Nicht alphanumerische Zeichen entfernen?', 'Entfernt Zeichen, die keine Buchstaben oder Ziffern sind.'),
    'SEO_URLS_CACHE_RESET' => array('SEO URLs Cache leeren', 'Setzt den SEO URL Cache zurueck'),
    'SEO_URLS_ONLY_IN' => array('Seiten eingeben, die umgeschrieben werden sollen', 'Dieses Setting erlaubt den Rewrite nur fuer die angegebenen Seiten. Wird hier alles rausgeloescht, werden alle Seiten umgeschrieben. <br><br>Das Format <b>MUSS</b> sein: <b>page1,page2,page3</b>'), 
);

// spain
$poLang['34'] = array(
    'SEO_URLS_CACHE_RESET' => array('Restablecer la caché para las direcciones SEO ', 'Esto restablecerá la caché de datos SEO'),
    'SEO_URLS_ONLY_IN' => array('Introduzca las páginas para permitir la reescritura', 'Este ajuste permitirá activar la reescritura de direcciones solo en las páginas indicadas. Si deja este ajuste en blanco, todas las páginas seran reescritas. <br /><br />El formato <strong>DEBERÁ</strong> tener la siguiente forma: <strong>pagina1,pagina2,pagina3</strong>'),
    'SEO_REMOVE_ALL_SPEC_CHARS' => array('Eliminar todos los caracteres no alfanuméricos?', 'Este ajuste eliminará todos aquellos caracteres que no sean letras o números. Esto debería ser útil para eliminar todos los caracteres especiales con 1 un solo ajuste.'),
    'SEO_CHAR_CONVERT_SET' => array('Introduzca las conversiones para los caracteres especiales.', 'Este ajuste permite convertir los carateres especiales.<br /><br />El formato <strong>DEBERÁ</strong> tener la siguiente forma: <strong>carácter=>conversión,carácter2=>conversión2</strong>'),
    'SEO_REWRITE_TYPE' => array('Elija el tipo de reescritura de direcciones', 'Elija el formato que desea para las direcciones SEO.'),
    'USE_SEO_REDIRECT' => array('Activar las redirecciones automáticas?', 'Este ajuste automáticamente enviará cabeceras del tipo 301 para redireccionarle desde las direcciones antiguas a las nuevas..'),
    'USE_SEO_CACHE_INFO_PAGES' => array('Activar la caché para las páginas de información?', 'Este ajuste permite activar el almacenamiento en caché para las páginas de información'),
    'USE_SEO_CACHE_ARTICLES' => array('Activar la caché para artículos?', 'Este ajuste permite activar el almacenamiento en caché para los artículos.'),
    'USE_SEO_CACHE_MANUFACTURERS' => array('Activar la caché para los fabricantes?', 'Este ajuste permite activar el almacenamiento en caché para los fabricantes.'),
    'USE_SEO_CACHE_CATEGORIES' => array('Activar la caché para categorías?', 'Este ajuste permite activar el almacenamiento en caché para las categorías.'),
    'USE_SEO_CACHE_GLOBAL' => array('Activar la caché SEO para almacenar las consultas?', 'Este es un ajuste global y permite desactivar completamente la caché.'),
    'USE_SEO_CACHE_PRODUCTS' => array('Activar la caché para productos?', 'Este ajuste permite activar el almacenamiento en caché para los productos.'),
    'SEO_URLS_FILTER_SHORT_WORDS' => array('Filtrar palabras cortas', 'Este ajuste permite filtrar de la dirección aquellas palabras de longitud inferior o igual al valor indicado.'),
    'SEO_URLS_USE_W3C_VALID' => array('Mostrar direcciones W3C válidas (parámetro de cadena)?', 'Este ajuste permite mostrar direcciones que cumplen con las directrices establecidas por el W3C.'),
    'SEO_ADD_CAT_PARENT' => array('Agregar la categoría padre al inicio de la dirección?', 'Este ajuste agregará el nombre de la categoría padre al inicio de la dirección de la categoría (ejemplo: categoria-padre-c-1.html).'),
    'SEO_ENABLED' => array('Activar las direcciones SEO?', 'Activar las direcciones SEO?  Este es un ajuste global y permite desactivar las direcciones SEO completamente.'),
    'SEO_ADD_CPATH_TO_PRODUCT_URLS' => array('Agregar el cPath a las direcciones de los productos?', 'Este ajuste agregará la ruta de categorías al final de la dirección del producto (ejemplo:. - nombre-producto-p-1.html?cPath=xx).'),
);
