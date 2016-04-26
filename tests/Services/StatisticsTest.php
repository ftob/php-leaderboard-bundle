<?php
namespace  Ftob\LeaderBoardBundle\Tests;

use Ftob\LeaderBoardBundle\Services\Statistics;

/**
 * Class StatisticsTest
 * @package Ftob\LeaderBoardBundle\Tests
 */
class StatisticsTest extends \PHPUnit_Framework_TestCase
{
    public function testMap()
    {
        $statistics = new Statistics();

        $result = $statistics->map(function($a, $b) {
            return $a + $b;
        }, [1, 2])->getResultMap();

        $this->assertEquals(3, $result);
    }

}

