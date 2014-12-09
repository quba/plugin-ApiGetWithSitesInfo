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

/**
 */
class ApiGetWithSitesInfo extends \Piwik\Plugin
{
    function getListHooksRegistered()
    {
        return array(
            'API.API.get.end' => 'decorateApiOutput',
        );
    }

    public function decorateApiOutput(DataTableInterface $dataTable)
    {
        $decorator = new DataTableDecorator($dataTable);
        $decorator->decorateApiGetOutput();
    }
}
