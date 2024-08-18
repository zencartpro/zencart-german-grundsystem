<?php
/**
 * @package  Instant Search Plugin for Zen Cart German
 * @author   marco-pm
 * @version  4.0.3
 * @see      https://github.com/marco-pm/zencart_instantsearch
 * @license  GNU Public License V2.0
 * modified for Zen Cart German
 * 2024-04-05 webchills
 */

use Zencart\PluginSupport\ScriptedInstaller as ScriptedInstallBase;

class ScriptedInstaller extends ScriptedInstallBase
{
    /**
     * Configuration group title.
     *
     * @var string
     */
    protected const CONFIGURATION_GROUP_TITLE = 'Instant Search';

    /**
     * Upgrade the plugin to the new version.
     *
     * @param string $oldVersion
     * @return bool
     */
    public function doUpgrade(string $oldVersion = ''): bool
    {
        if ($oldVersion === '') {
            return false;
        }

        $sql = $this->dbConn->Execute("
            SELECT
                configuration_group_id
            FROM
                " . TABLE_CONFIGURATION_GROUP . "
            WHERE
                configuration_group_title = '" . self::CONFIGURATION_GROUP_TITLE . "'
            LIMIT
                1
        ");
        if ($sql->RecordCount() === 0) {
            $errorMsg = 'Instant Search plugin is not installed properly. Uninstall and re-install the plugin.';
            $this->errorContainer->addError(1, $errorMsg, true, $errorMsg);
            return false;
        }

        $configurationGroupId = (int)$sql->fields['configuration_group_id'];

        $this->createIndexes();

        $this->createConfigurationSettings($configurationGroupId);

        $this->restorePreviousConfigurationValues($configurationGroupId, $oldVersion);

        return true;
    }

    /**
     * Install the plugin for the first time.
     *
     * @return bool
     */
    public function doInstall(): bool
    {
        $this->createIndexes();

        // Add configuration group, if not already present
        $sql = $this->dbConn->Execute("
            SELECT
                configuration_group_id
            FROM
                " . TABLE_CONFIGURATION_GROUP . "
            WHERE
                configuration_group_title = '" . self::CONFIGURATION_GROUP_TITLE . "'
            LIMIT
                1
        ");
        if ($sql->RecordCount() === 0) {
            $this->dbConn->Execute("
                INSERT INTO
                    " . TABLE_CONFIGURATION_GROUP . " (
                        configuration_group_title,
                        configuration_group_description,
                        language_id,
                        sort_order,
                        visible
                    )
                VALUES
                    (
                        '" . self::CONFIGURATION_GROUP_TITLE . "',
                        '" . self::CONFIGURATION_GROUP_TITLE . "',
                        43,
                        1,
                        1
                    )
            ");
            $configurationGroupId = (int)($this->dbConn->Insert_ID());
            $this->executeInstallerSql("
                UPDATE
                    " . TABLE_CONFIGURATION_GROUP . "
                SET
                    sort_order = $configurationGroupId
                WHERE
                    configuration_group_id = $configurationGroupId
            ");
        } else {
            $configurationGroupId = (int)($sql->fields['configuration_group_id']);
        }

        // Register admin page
        zen_deregister_admin_pages(['configInstantSearch']);
        zen_register_admin_page('configInstantSearch', 'BOX_CONFIGURATION_INSTANT_SEARCH_OPTIONS', 'FILENAME_CONFIGURATION', "gID=$configurationGroupId", 'configuration', 'Y');

        $this->createConfigurationSettings($configurationGroupId);

        return true;
    }

    /**
     * Uninstall the plugin.
     *
     * @return bool
     */
    public function doUninstall(): bool
    {
        // Deregister admin pae
        zen_deregister_admin_pages(['configInstantSearch']);

        // Remove configuration settings
        $sql = "
            DELETE FROM
                " . TABLE_CONFIGURATION . "
            WHERE
                configuration_key LIKE 'INSTANT_SEARCH_%'
                AND configuration_key != 'INSTANT_SEARCH_ENGINE'
        ";
        $this->executeInstallerSql($sql);
        
         // Remove configuration_language definitions
        $sql = "
            DELETE FROM
                " . TABLE_CONFIGURATION_LANGUAGE . "
            WHERE
                configuration_key LIKE 'INSTANT_SEARCH_%'
                AND configuration_key != 'INSTANT_SEARCH_ENGINE'
        ";
        $this->executeInstallerSql($sql);

        // Remove configuration group
        $sql = "
            DELETE FROM
                " . TABLE_CONFIGURATION_GROUP . "
            WHERE
                configuration_group_title = '" . self::CONFIGURATION_GROUP_TITLE . "'
        ";
        $this->executeInstallerSql($sql);

        // Remove FULLTEXT indexes from products_description table
        $index = $this->dbConn->Execute("
            SHOW INDEX
            FROM
                " . TABLE_PRODUCTS_DESCRIPTION . "
            WHERE
                key_name = 'idx_products_name'
                AND column_name = 'products_name'
                AND index_type = 'FULLTEXT'
        ");
        if (!$index->EOF) {
            $this->executeInstallerSql("
                DROP INDEX idx_products_name
                ON " . TABLE_PRODUCTS_DESCRIPTION
            );
        }

        $index = $this->dbConn->Execute("
            SHOW INDEX
            FROM
                " . TABLE_PRODUCTS_DESCRIPTION . "
            WHERE
                key_name = 'idx_products_description'
                AND column_name = 'products_description'
                AND index_type = 'FULLTEXT'
        ");
        if (!$index->EOF) {
            $this->executeInstallerSql("
                DROP INDEX idx_products_description
                ON " . TABLE_PRODUCTS_DESCRIPTION
            );
        }

        $this->executeInstallerSql("ALTER TABLE " . TABLE_PRODUCTS_DESCRIPTION . " ENGINE = MyISAM");

        return true;
    }

    /**
     * Add FULLTEXT indexes on products_description table, if not already present
     *
     * @return void
     */
    protected function createIndexes(): void
    {
        $this->executeInstallerSql("ALTER TABLE " . TABLE_PRODUCTS_DESCRIPTION . " ENGINE = InnoDB");

        $index = $this->dbConn->Execute("
            SHOW INDEX
            FROM
                " . TABLE_PRODUCTS_DESCRIPTION . "
            WHERE
                column_name = 'products_name'
                AND index_type = 'FULLTEXT'
        ");
        if ($index->EOF) {
            $this->executeInstallerSql("
                CREATE FULLTEXT INDEX idx_products_name
                ON " . TABLE_PRODUCTS_DESCRIPTION . "(products_name)
            ");
        }

        $index = $this->dbConn->Execute("
            SHOW INDEX
            FROM
                " . TABLE_PRODUCTS_DESCRIPTION . "
            WHERE
                column_name = 'products_description'
                AND index_type = 'FULLTEXT'
        ");
        if ($index->EOF) {
            $this->executeInstallerSql("
                CREATE FULLTEXT INDEX idx_products_description
                ON " . TABLE_PRODUCTS_DESCRIPTION . "(products_description)
            ");
        }

        $this->executeInstallerSql("OPTIMIZE TABLE " . TABLE_PRODUCTS_DESCRIPTION);
    }


    /**
     * Install admin settings.
     *
     * @param int $configurationGroupId
     * @return void
     */
    protected function createConfigurationSettings(int $configurationGroupId): void
    {
        // Remove any previous configuration settings
        $sql = "
            DELETE FROM
                " . TABLE_CONFIGURATION . "
            WHERE
                configuration_key LIKE 'INSTANT_SEARCH_%'
                AND configuration_key != 'INSTANT_SEARCH_ENGINE'
        ";
        $this->executeInstallerSql($sql);
        
        // Remove any previous configuration_language definitions
        $sql = "
            DELETE FROM
                " . TABLE_CONFIGURATION_LANGUAGE . "
            WHERE
                configuration_key LIKE 'INSTANT_SEARCH_%'
                AND configuration_key != 'INSTANT_SEARCH_ENGINE'
        ";
        $this->executeInstallerSql($sql);

        // Insert configuration settings with default values
        $sql = "
            INSERT INTO " . TABLE_CONFIGURATION . "
                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, date_added, sort_order, use_function, set_function, val_function)
            VALUES
                ('Product Fields to Search and Order', 'INSTANT_SEARCH_PRODUCT_FIELDS_LIST', 'model-exact,name-description,model-broad,meta-keywords,category,manufacturer', 'List of product fields to search, separated by a comma. You can exclude a field from the search by not including it in the list.<br>The list also determines the order in which fields are searched, and therefore the position in the results. E.g. putting <code>model-exact</code> before <code>name-description</code> will show products where the model is equal to the search query first, and then products that have name or description that contains the search query.<br><br>List of fields:<ul><li><b>name-description</b> (product name and description) OR <b>name</b> (product name only, don\\'t search in descriptions) – only ONE of the two</li><li><b>model-exact</b> (product model - exact match, the query contains only and exactly the model)</li><li><b>model-broad</b> (product model - broad match, the query contains also the model or part of it)</li><li><b>meta-keywords</b> (product keywords meta tag)</li><li><b>category</b> (product category, used only in dropdown)</li><li><b>manufacturer</b> (product manufacturer, used only in dropdown)</li></ul>Default: <code>model-exact,name-description,model-broad,meta-keywords,category,manufacturer</code><br>', $configurationGroupId, now(), 200, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_FIELDS_LIST_VALIDATE\",\"id\":\"FILTER_CALLBACK\",\"options\":{\"options\":[\"\\\\\\\\Zencart\\\\\\\\Plugins\\\\\\\\Admin\\\\\\\\InstantSearch\\\\\\\\InstantSearchConfigurationValidation\",\"validateFieldsList\"]}}'),
                ('[MySQL] Include Related Products in the Results (Query Expansion)', 'INSTANT_SEARCH_MYSQL_USE_QUERY_EXPANSION', 'true', 'Show also products with related name and/or description (Query Expansion function of MySQL Full-Text Search).<br><br>Example: one product has name <em>Logitech Wired Keyboard</em> and another product has name <em>Microsoft Keyboard and Mouse, wireless set</em>. The user searches for <em>logitech</em>. Without query expansion, only the first product will be shown. With query expansion, the second product will also be shown because it contains the word <em>keyboard</em>, which is present in the matched product (and could therefore be relevant to the user).<br><br>Note: this option is not equivalent to a typo-tolerance or synonym support feature (e.g. <em>Did you mean...?</em>).<br>', $configurationGroupId, now(), 300, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Enable','INSTANT_SEARCH_DROPDOWN_ENABLED', 'true', 'When the user types into an input search box, display a dropdown with autocomplete search results.', $configurationGroupId, now(), 400, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Search Delay', 'INSTANT_SEARCH_DROPDOWN_INPUT_WAIT_TIME', '50', 'Delay the execution of the instant search by this time period (in milliseconds), after a character is entered, to prevent unnecessary queries to the database while the user is typing.', $configurationGroupId, now(), 500, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Dropdown - Maximum Number of Products', 'INSTANT_SEARCH_DROPDOWN_MAX_PRODUCTS', '5', 'Maximum number of products displayed in the dropdown.', $configurationGroupId, now(), 600, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Dropdown - Minimum Length of Search Query', 'INSTANT_SEARCH_DROPDOWN_MIN_WORDSEARCH_LENGTH', '3', 'Minimum number of characters requested for the dropdown to be displayed.', $configurationGroupId, now(), 700, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Dropdown - Maximum Length of Search Query', 'INSTANT_SEARCH_DROPDOWN_MAX_WORDSEARCH_LENGTH', '100', 'Maximum number of characters allowed for the dropdown to be displayed.', $configurationGroupId, now(), 800, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Dropdown - Display Images', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_IMAGE', 'true', 'Display the product/category/manufacturer\'s image.', $configurationGroupId, now(), 900, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Display Product Price', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_PRODUCT_PRICE', 'true', 'Display the product\'s price.', $configurationGroupId, now(), 1000, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Display Product Model', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_PRODUCT_MODEL', 'false', 'Display the product\'s model.', $configurationGroupId, now(), 1100, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Maximum Number of Categories', 'INSTANT_SEARCH_DROPDOWN_MAX_CATEGORIES', '2', 'Maximum number of categories (matched by name) displayed in the dropdown. Set to 0 if you don\'t want to include categories in the results.', $configurationGroupId, now(), 1190, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Dropdown - Display Category Count', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_CATEGORIES_COUNT', 'true', 'Display the number of products for the matched categories.', $configurationGroupId, now(), 1200, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Maximum Number of Manufacturers', 'INSTANT_SEARCH_DROPDOWN_MAX_MANUFACTURERS', '2', 'Maximum number of manufacturers (matched by name) displayed in the dropdown. Set to 0 if you don\'t want to include manufacturers in the results.', $configurationGroupId, now(), 1290, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Dropdown - Display Manufacturer Count', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_MANUFACTURERS_COUNT', 'true', 'Display the number of products for the matched manufacturers.', $configurationGroupId, now(), 1300, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Dropdown - Image Width', 'INSTANT_SEARCH_DROPDOWN_IMAGE_WIDTH', '100', 'Width of the product/category/manufacturer\'s image.', $configurationGroupId, now(), 1400, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_IMG_SIZE_VALIDATE\",\"id\":\"FILTER_VALIDATE_REGEXP\",\"options\":{\"options\":{\"regexp\":\"/^\\\\\\\d+!?$/\"}}}'),
                ('Dropdown - Image Height', 'INSTANT_SEARCH_DROPDOWN_IMAGE_HEIGHT', '100', 'Height of the product/category/manufacturer\'s image.', $configurationGroupId, now(), 1500, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_IMG_SIZE_VALIDATE\",\"id\":\"FILTER_VALIDATE_REGEXP\",\"options\":{\"options\":{\"regexp\":\"/^\\\\\\\d+!?$/\"}}}'),
                ('Dropdown - Highlight Search Terms in Bold', 'INSTANT_SEARCH_DROPDOWN_HIGHLIGHT_TEXT', 'autocomplete', '<strong>none</strong>: no highlight<br><strong>query</strong>: highlight the user search terms<br><strong>autocomplete</strong>: highlight the autocompleted text', $configurationGroupId, now(), 1600, NULL, 'zen_cfg_select_option(array(\'none\', \'query\', \'autocomplete\'),', NULL),
                ('Dropdown - Input Box Selector', 'INSTANT_SEARCH_DROPDOWN_INPUT_BOX_SELECTOR', 'input[name=\"keyword\"]', 'CSS selector of the search input box(es). You might need to change it if you\'re using a custom template and the results dropdown is not showing. Default: <code>input[name=\"keyword\"]</code>', $configurationGroupId, now(), 1700, NULL, NULL, '{\"error\":\"ERROR\",\"id\":\"FILTER_SANITIZE_URL\",\"options\":{\"options\":{}}}'),
                ('Dropdown - Add Entry to Search Log', 'INSTANT_SEARCH_DROPDOWN_ADD_LOG_ENTRY', 'false', 'Add the searched terms to the Search Log report (if <em>Search Log</em> plugin is installed).', $configurationGroupId, now(), 1800, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Listing Page - Enable', 'INSTANT_SEARCH_PAGE_ENABLED', 'true', 'When the user submits a search form (excluding the advanced search form), display the search results on a product listing page with infinite scroll.<br>This does not replace the (formerly advanced) search and results page.', $configurationGroupId, now(), 1900, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL),
                ('Listing Page - Number of Results per Ajax Call', 'INSTANT_SEARCH_PAGE_RESULTS_PER_PAGE', '10', 'Number of products displayed every time a new \"batch\" of search results is loaded while scrolling the page.', $configurationGroupId, now(), 2000, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_INT_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0}}}'),
                ('Listing Page - Maximum Number of Results', 'INSTANT_SEARCH_PAGE_RESULTS_PER_SCREEN', '250', 'Maximum number of search results for the listing page.<br>Maximum allowed value: 250', $configurationGroupId, now(), 2100, NULL, NULL, '{\"error\":\"TEXT_INSTANT_SEARCH_CONFIGURATION_MAX_RESULTS_PAGE_VALIDATE\",\"id\":\"FILTER_VALIDATE_INT\",\"options\":{\"options\":{\"min_range\":0,\"max_range\":250}}}'),
                ('Listing Page - Add Entry to Search Log', 'INSTANT_SEARCH_PAGE_ADD_LOG_ENTRY', 'true', 'Add the searched terms to the Search Log report (if <em>Search Log</em> plugin is installed).', $configurationGroupId, now(), 2200, NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),', NULL)
        ";
        $this->executeInstallerSql($sql);
        // Insert configuration_language translations for Zen Cart German
        $sql = "
            REPLACE INTO " . TABLE_CONFIGURATION_LANGUAGE . "
                (configuration_title, configuration_key, configuration_description, configuration_language_id)
            VALUES
             ('Artikelfelder für Suche und Reihenfolge', 'INSTANT_SEARCH_PRODUCT_FIELDS_LIST', 'Liste der zu durchsuchenden Artikelfelder, getrennt durch ein Komma. Sie können ein Feld von der Suche ausschließen, indem Sie es nicht in die Liste aufnehmen.<br>Die Liste bestimmt auch die Reihenfolge, in der die Felder durchsucht werden, und damit die Position in den Ergebnissen. Wenn Sie z.B. <code>model-exact</code> vor <code>name-description</code> setzen, werden zuerst die Artikel angezeigt, deren Artikelnummer mit der Suchanfrage übereinstimmt, und dann die Artikel, deren Name oder Beschreibung die Suchanfrage enthält. <br><br>Liste der Felder: <ul><li><b>name-description</b> (Artikelname und Beschreibung) ODER <b>name</b> (nur Artikelname, nicht in Beschreibungen suchen) - nur EINES von beiden</li><li><b>model-exact</b> (Artikelnummer - exakte Übereinstimmung, die Abfrage enthält nur und genau die Artikelnummer)</li><li><b>model-broad</b> (Artikelnummer - breite Übereinstimmung, die Abfrage enthält auch die Artikelnummer oder einen Teil davon)</li><li><b>meta-keywords</b> (Meta Tag Keywords des Artikels)</li><li><b>category</b> (Artikelkategorie, wird nur im Dropdown verwendet)</li><li><b>manufacturer</b> (Artikelhersteller, wird nur im Dropdown verwendet)</li></ul>Voreinstellung: <code>model-exact,name-description,model-broad,meta-keywords,category,manufacturer</code><br>', 43),
             ('[MySQL] Verwandte Artikel in die Ergebnisse einbeziehen (Query Expansion)', 'INSTANT_SEARCH_MYSQL_USE_QUERY_EXPANSION', 'Wollen Sie auch Artikel mit verwandtem Namen und/oder Beschreibung anzeigen? (Query Expansion Funktion der MySQL Volltextsuche).<br><br>Beispiel: ein Artikel hat den Namen <em>Logitech Wired Keyboard</em> und ein anderer hat den Namen <em>Microsoft Keyboard and Mouse, wireless set</em>. Der Besucher sucht nach <em>Logitech</em>. Ohne Sucherweiterung wird nur das erste Produkt angezeigt. Mit Abfrageerweiterung wird auch das zweite Produkt angezeigt, da es das Wort <em>Tastatur</em> enthält, das in dem übereinstimmenden Artikel vorkommt (und daher für den Besucher relevant sein könnte).<br><br>Hinweis: Diese Option ist nicht gleichbedeutend mit einer Tippfehler-Toleranz oder einer Synonym-Unterstützung (z.B. <em>Meinten Sie...?</em>).<br>', 43),
             ('Dropdown - Aktivieren', 'INSTANT_SEARCH_DROPDOWN_ENABLED', 'Wollen Sie das Sofortsuche Dropdown im Suchfeld aktivieren?', 43),
             ('Dropdown - Verzögerung', 'INSTANT_SEARCH_DROPDOWN_INPUT_WAIT_TIME', 'Verzögert die Ausführung der Sofortsuche um diese Zeitspanne (in Millisekunden), nachdem ein Zeichen eingegeben wurde, um unnötige Abfragen an die Datenbank zu vermeiden, während der Benutzer tippt.', 43),
             ('Dropdown - Maximale Artikelanzahl', 'INSTANT_SEARCH_DROPDOWN_MAX_PRODUCTS', 'Wieviele Suchergebnisse sollen maximal im Dropdown angezeigt werden?', 43),
             ('Dropdown - Minimale Zeichenanzahl für Suchbegriff', 'INSTANT_SEARCH_DROPDOWN_MIN_WORDSEARCH_LENGTH', 'Wieviele Zeichen müssen mindestens eingetippt werden, damit das Sofortsuche Dropdown erscheint?', 43),
             ('Dropdown - Maximale Zeichenanzahl für Suchbegriff', 'INSTANT_SEARCH_DROPDOWN_MAX_WORDSEARCH_LENGTH', 'Wievele Zeichen dürfen maximal ins Suchfeld eingegeben werden, damit das Sofortsuche Dropdown erscheint?', 43),
             ('Dropdown - Bilder anzeigen', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_IMAGE', 'Sollen die entsprechenden Artikel/Hersteller/Kategorie Bilder im Dropdown angezeigt werden?', 43),
             ('Dropdown - Artikelpreis anzeigen', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_PRODUCT_PRICE', 'Soll der Artikelpreis im Dropdown angezeigt werden?', 43),
             ('Dropdown - Artikelnummer anzeigen', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_PRODUCT_MODEL', 'Soll die Artikelnummer im Dropdown angezeigt werden?', 43),
             ('Dropdown - Maximale Kategorieanzahl', 'INSTANT_SEARCH_DROPDOWN_MAX_CATEGORIES', 'Maximale Anzahl der in der Dropdown-Liste angezeigten Kategorien (nach Namen). Setzen Sie diesen Wert auf 0, wenn Sie keine Kategorien in die Ergebnisse aufnehmen möchten.', 43),
             ('Dropdown - Kategoriezähler anzeigen', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_CATEGORIES_COUNT', 'Soll die Anzahl der Artikel für die gefundenen Kategorien angezeigt werden?', 43),
             ('Dropdown - Maximale Herstelleranzahl', 'INSTANT_SEARCH_DROPDOWN_MAX_MANUFACTURERS', 'Maximale Anzahl der in der Dropdown-Liste angezeigten Hersteller (nach Namen). Setzen Sie diesen Wert auf 0, wenn Sie keine Hersteller in die Ergebnisse aufnehmen möchten.', 43),
             ('Dropdown - Herstellerzähler anzeigen', 'INSTANT_SEARCH_DROPDOWN_DISPLAY_MANUFACTURERS_COUNT', 'Soll die Anzahl der Artikel für die gefundenen Hersteller angezeigt werden?', 43),
             ('Dropdown - Bild Breite', 'INSTANT_SEARCH_DROPDOWN_IMAGE_WIDTH', 'Breite der Artikel/Hersteller/Kategorie Bilder in Pixel', 43),
             ('Dropdown - Bild Höhe', 'INSTANT_SEARCH_DROPDOWN_IMAGE_HEIGHT', 'Höhe der Artikel/Hersteller/Kategorie Bilder in Pixel', 43),
             ('Dropdown - Suchbegriff fett hervorheben', 'INSTANT_SEARCH_DROPDOWN_HIGHLIGHT_TEXT', '<strong>none</strong>: keine Hervorhebung<br><strong>query</strong>: Suchbegriffe hervorheben<br><strong>autocomplete</strong>: autovervollständigten Text hervorheben', 43),
             ('Dropdown - CSS Selector für das Eingabefeld', 'INSTANT_SEARCH_DROPDOWN_INPUT_BOX_SELECTOR', 'CSS Selector für das Suchfeld/die Suchfelder im Shop. Dieser Wert muss normalerweise nicht geändert werden, es sei denn Sie verwenden ein spezielles Template und das Ergebnis Dropdown erscheint nicht.<br>Voreinstellung: <code>input[name=\"keyword\"]</code>', 43),
             ('Dropdown - Eintrag ins Suchprotokoll', 'INSTANT_SEARCH_DROPDOWN_ADD_LOG_ENTRY', 'Falls Sie das Modul Suchprotokoll installiert haben, sollen dann die Eingaben ins Suchfeld im Suchprotokoll aufgenommen werden?', 43),
             ('Ergebnisseite - Aktivieren', 'INSTANT_SEARCH_PAGE_ENABLED', 'Wenn der Besucher ein Suchformular absendet (mit Ausnahme der normalen erweiterten Suche), sollen die Suchergebnisse dann auf der von diesem Modul mitgelieferten Artikellistenseite mit unendlichem Scrollen angezeigt werden?<br>Dies ersetzt nicht die normale Such- und Ergebnisseite.', 43),
             ('Ergebnisseite - Anzahl der Ergebnisse pro Ajax Call', 'INSTANT_SEARCH_PAGE_RESULTS_PER_PAGE', 'Wieviele Suchergebnisse sollen maximal auf der Ergebnisseite beim Scrollen nach unten angezeigt werden?', 43),
             ('Ergebnisseite - Maximale Anzahl', 'INSTANT_SEARCH_PAGE_RESULTS_PER_SCREEN', 'Wievele Suchergebnisse sollen insgesamt maximal auf der Ergebnisseite angezeigt werden?<br>Maximal möglich sind 250.', 43),
             ('Ergebnisseite - Eintrag ins Suchprotokoll', 'INSTANT_SEARCH_PAGE_ADD_LOG_ENTRY', 'Falls Sie das Modul Suchprotokoll installiert haben, sollen dann die Ergebnisse der Ergebnisseite im Suchprotokoll aufgenommen werden?', 43) 
        ";
        $this->executeInstallerSql($sql);
    }

    /**
     * Restore admin settings values from the previous installed plugin version.
     *
     * @param int $configurationGroupId
     * @param string $oldPluginVersion
     * @return void
     */
    public function restorePreviousConfigurationValues(int $configurationGroupId, string $oldPluginVersion = ''): void
    {
        if (strpos($oldPluginVersion, 'v2') === 0 || strpos($oldPluginVersion, 'v3') === 0) {
            // some old settings have different names than v4's
            if (strpos($oldPluginVersion, 'v2') === 0) {
                $oldSettingNames = [
                    'INSTANT_SEARCH_DROPDOWN_MAX_PRODUCTS'                => 'INSTANT_SEARCH_MAX_NUMBER_OF_RESULTS',
                    'INSTANT_SEARCH_DROPDOWN_MIN_WORDSEARCH_LENGTH'       => 'INSTANT_SEARCH_MIN_WORDSEARCH_LENGTH',
                    'INSTANT_SEARCH_DROPDOWN_MAX_WORDSEARCH_LENGTH'       => 'INSTANT_SEARCH_MAX_WORDSEARCH_LENGTH',
                    'INSTANT_SEARCH_DROPDOWN_DISPLAY_IMAGE'               => 'INSTANT_SEARCH_DISPLAY_IMAGE',
                    'INSTANT_SEARCH_DROPDOWN_DISPLAY_PRODUCT_PRICE'       => 'INSTANT_SEARCH_DISPLAY_PRODUCT_PRICE',
                    'INSTANT_SEARCH_DROPDOWN_DISPLAY_PRODUCT_MODEL'       => 'INSTANT_SEARCH_DISPLAY_PRODUCT_MODEL',
                    'INSTANT_SEARCH_DROPDOWN_DISPLAY_CATEGORIES_COUNT'    => 'INSTANT_SEARCH_DISPLAY_CATEGORIES_COUNT',
                    'INSTANT_SEARCH_DROPDOWN_DISPLAY_MANUFACTURERS_COUNT' => 'INSTANT_SEARCH_DISPLAY_MANUFACTURERS_COUNT',
                ];
            } else {
                $oldSettingNames = [
                    'INSTANT_SEARCH_PRODUCT_FIELDS_LIST'       => 'INSTANT_SEARCH_DROPDOWN_FIELDS_LIST',
                    'INSTANT_SEARCH_MYSQL_USE_QUERY_EXPANSION' => 'INSTANT_SEARCH_DROPDOWN_USE_QUERY_EXPANSION',
                ];
            }

            foreach ($oldSettingNames as $k => $oldSettingName) {
                if (defined($oldSettingName)) {
                    $sql = "
                        UPDATE
                            " . TABLE_CONFIGURATION . "
                        SET
                            configuration_value = :value
                        WHERE
                            configuration_key = :key
                    ";
                    $sql = $this->dbConn->bindVars($sql, ':value', constant($oldSettingName), 'string');
                    $sql = $this->dbConn->bindVars($sql, ':key', $k, 'string');
                    $this->executeInstallerSql($sql);
                }
            }

            // Keep the dropdown wait time setting if it was changed from the v2 default, otherwise leave the
            // "new" v4 value
            if (defined('INSTANT_SEARCH_INPUT_WAIT_TIME') && INSTANT_SEARCH_INPUT_WAIT_TIME !== '150') {
                $sql = "
                    UPDATE
                        " . TABLE_CONFIGURATION . "
                    SET
                        configuration_value = :value
                    WHERE
                        configuration_key = 'INSTANT_SEARCH_DROPDOWN_INPUT_WAIT_TIME'
                ";
                $sql = $this->dbConn->bindVars($sql, ':value', INSTANT_SEARCH_INPUT_WAIT_TIME, 'string');
                $this->executeInstallerSql($sql);
            }
        } else {
            $confSettings = $this->dbConn->Execute("
                SELECT
                    configuration_key
                FROM
                    " . TABLE_CONFIGURATION . "
                WHERE
                    configuration_group_id = $configurationGroupId
            ");
            foreach ($confSettings as $confSetting) {
                if (defined($confSetting['configuration_key'])) {
                    $sql = "
                        UPDATE
                            " . TABLE_CONFIGURATION . "
                        SET
                            configuration_value = :value
                        WHERE
                            configuration_key = :key
                    ";
                    $sql = $this->dbConn->bindVars($sql, ':value', constant($confSetting['configuration_key']), 'string');
                    $sql = $this->dbConn->bindVars($sql, ':key', $confSetting['configuration_key'], 'string');
                    $this->executeInstallerSql($sql);
                }
            }
        }
    }
}
