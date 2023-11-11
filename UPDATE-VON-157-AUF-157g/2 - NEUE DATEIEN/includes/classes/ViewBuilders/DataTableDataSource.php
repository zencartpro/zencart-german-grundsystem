<?php declare(strict_types=1);
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: DataTableDataSource.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\ViewBuilders;

use Illuminate\Database\Eloquent\Builder;
use Zencart\Request\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Zencart\Traits\NotifierManager;

abstract class DataTableDataSource
{
    use NotifierManager;
    
    protected $tableDefinition;

    public function __construct(TableViewDefinition $tableViewDefinition)
    {
        $this->tableDefinition = $tableViewDefinition;
        $this->notify('NOTIFY_DATASOURCE_CONSTRUCTOR_END');
    }

    abstract protected function buildInitialQuery() : Builder;

    public function processRequest(Request $request) : Builder
    {
        $query = $this->buildInitialQuery($request);
        $this->notify('NOTIFY_DATASOURCE_PROCESSREQUEST', [], $query);
        return $query;
    }

    public function processQuery(Builder $query) : Paginator
    {
        if ($this->tableDefinition->isPaginated())
        {
            //var_dump(request()->input('page'));die('foo');
            $results = $query->paginate($this->tableDefinition->getParameter('maxRowCount'), '*', 'page', isset($_GET['page']) ? (int)$_GET['page'] :  1);
            //var_dump($results);die();
        } else {
            $results = $query->paginate(100000, '*', 'page', isset($_GET['page']) ? (int)$_GET['page'] :  1); // icwtodo @todo bit of a hack here to force the return type
        }
        return $results;
    }

    public function getTableDefinition(): TableViewDefinition
    {
        return $this->tableDefinition;
    }

    public function setTableDefinition(TableViewDefinition $tableDefinition)
    {
        $this->tableDefinition = $tableDefinition;
    }
}
