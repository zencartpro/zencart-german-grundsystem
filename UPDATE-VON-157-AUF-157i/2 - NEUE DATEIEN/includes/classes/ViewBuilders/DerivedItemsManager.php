<?php declare(strict_types=1);
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: DerivedItemsManager.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\ViewBuilders;

use Zencart\FileSystem\FileSystem;
use Illuminate\Database\Eloquent\Model;

class DerivedItemsManager
{
    public function process(Model $tableRow, string $colName, array $columnInfo) : string
    {
        if (!isset($columnInfo['derivedItem'])) {
            return $tableRow[$colName];
        }
        $colData = $this->processDerivedItem($tableRow, $colName, $columnInfo);
        return $colData;
    }

    protected function processDerivedItem(Model $tableRow, string $colName, array $columnInfo) : string
    {
        $type = $columnInfo['derivedItem']['type'];
        switch ($type) {
            case 'local':
                $result = $this->{$columnInfo['derivedItem']['method']}($tableRow, $colName, $columnInfo);
                return $result;
                break;
            case 'closure':
                $result = $columnInfo['derivedItem']['method']($tableRow, $colName, $columnInfo);
                return $result;
                break;
        }
    }

    protected function booleanReplace(Model $tableRow, string $colName, array $columnInfo) : string
    {
        $params = $columnInfo['derivedItem']['params'];
        $listValue = $tableRow[$colName];
        $result = $params['false'];
        if ($listValue) $result = $params['true'];
        return $result;
    }

    protected function arrayReplace(Model $tableRow, string $colName, array $columnInfo) : string
    {
        $params = $columnInfo['derivedItem']['params'];
        $listValue = $tableRow[$colName];
        $result = $params[$listValue];
        return $result;
    }

    protected function getPluginFileSize(Model $tableRow, string $colName, array $columnInfo) : string
    {
        $filePath = DIR_FS_CATALOG . 'zc_plugins/' . $tableRow['unique_key'] . '/';
        $fs = new FileSystem;
        $dirSize = $fs->getDirectorySize($filePath);
        return $dirSize;
    }
}
