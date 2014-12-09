<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\ApiGetWithSitesInfo;

use Piwik\DataTable;
use Piwik\DataTable\DataTableInterface;
use Piwik\DataTable\Map;
use Piwik\Site;

/**
 */
class DataTableDecorator extends \Piwik\Plugin
{
    public function __construct(DataTableInterface $table)
    {
        $this->dataTable = $table;
    }

    public function decorateApiGetOutput()
    {
        // we only look at DataTable\Map (when there are multiple websites)
        if ($this->dataTable instanceof Map) {
            return $this->decorateMapDataTable($this->dataTable);
        }
        return $this->decorateDataTable($this->dataTable);
    }

    /**
     * @param Map $map
     * @return DataTableInterface
     */
    protected function decorateMapDataTable(Map $map)
    {
        foreach ($map->getDataTables() as $idSite => $table) {
            if ($table instanceof DataTable\Map) {
                $this->decorateMapDataTable($table);
            } else {
                $this->decorateDataTable($table);
            }
        }
        return $map;
    }

    public function decorateDataTable(DataTable $table)
    {
        if ($table->getRowsCount() == 0) {
            return $table;
        }
        if (!($table instanceof DataTable\Simple)) {
            return $table;
        }
        /** @var Site $site */
        $site = $table->getMetadata('site');
        if (empty($site)) {
            return $table;
        }
        $newColumns = $this->getColumnsToDecorateResponse($site);
        $row = $table->getFirstRow();

        $columns = $row->getColumns();
        $columns = array_merge($newColumns, $columns);
        $row->setColumns($columns);
        return $table;
    }

    /**
     * @param $site
     * @return array
     */
    protected function getColumnsToDecorateResponse(Site $site)
    {
        return array(
            'idsite' => $site->getId(),
            'site_url' => $site->getMainUrl(),
            'site_name' => $site->getName(),
        );
    }


}
