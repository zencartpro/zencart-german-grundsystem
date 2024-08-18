<?php declare(strict_types=1);
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: PluginManagerDataSource.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\ViewBuilders;

use App\Models\PluginControl;
use Illuminate\Database\Eloquent\Builder;

class PluginManagerDataSource extends DataTableDataSource
{
    protected function buildInitialQuery() : Builder
    {
        return (new PluginControl())->query();
    }
}
