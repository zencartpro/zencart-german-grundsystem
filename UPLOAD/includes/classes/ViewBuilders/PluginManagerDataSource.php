<?php declare(strict_types=1);
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: PluginManagerDataSource.php 2025-10-30 14:27:24Z webchills $
 */

namespace Zencart\ViewBuilders;

use App\Models\PluginControl;
use Illuminate\Database\Eloquent\Builder;
use Zencart\PluginSupport\PluginStatus;

/**
 * @since ZC v1.5.8
 */
class PluginManagerDataSource extends DataTableDataSource
{
    /**
     * @since ZC v1.5.8
     */
    protected function buildInitialQuery(): Builder
    {
        $statusSort = [
            PluginStatus::ENABLED, // enabled
            PluginStatus::DISABLED, // disabled
            PluginStatus::NOT_INSTALLED, // not installed
        ];
        return PluginControl::query()
            ->orderByRaw(
                "FIELD(status, " . implode(',', $statusSort) . ")"
            )
            ->orderBy('name')
            ->orderBy('unique_key');
    }
}
