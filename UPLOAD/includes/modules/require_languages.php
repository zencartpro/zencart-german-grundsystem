<?php
/**
 * loads template- and page-specific language override files
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: require_languages.php 2023-10-29 15:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$languageLoader->setCurrentPage($current_page);
$languageLoader->loadLanguageForView();
