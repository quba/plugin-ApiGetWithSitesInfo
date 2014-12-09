<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\ApiGetWithSitesInfo\tests\System;

use Piwik\Plugins\ApiGetWithSitesInfo\tests\fixtures\SimpleFixtureTrackFewVisits;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

/**
 * @group ApiGetWithSitesInfo
 * @group ApiGetDecoratedTest
 * @group Plugins
 */
class ApiGetDecoratedTest extends SystemTestCase
{
    /**
     * @var SimpleFixtureTrackFewVisits
     */
    public static $fixture = null; // initialized below class definition

    public static function getOutputPrefix()
    {
        return '';
    }

    public static function getPathToTestDirectory()
    {
        return dirname(__FILE__);
    }

    /**
     * @dataProvider getApiForTesting
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

    public function getApiForTesting()
    {
        $api = array('API.get');

        $apiToTest = array();
        $apiToTest[] = array($api,
            array(
                'idSite' => 1,
                'date' => self::$fixture->dateTime,
                'periods' => array('day'),
                'testSuffix' => '_oneSite',
                'otherRequestParameters' => array(
                    'showColumns' => 'nb_visits,nb_actions,site_name,site_url,idsite,revenue'
                )
            ));
        $apiToTest[] = array($api,
            array(
                'idSite' => 'all',
                'date' => self::$fixture->dateTime,
                'periods' => array('day'),
                'testSuffix' => '_allSites',
                'otherRequestParameters' => array(
                    'showColumns' => 'site_name,site_url,idsite,nb_visits,nb_actions,revenue'
                )
            ));

        return $apiToTest;
    }

}

ApiGetDecoratedTest::$fixture = new SimpleFixtureTrackFewVisits();