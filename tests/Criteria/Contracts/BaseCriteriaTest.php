<?php
namespace Ftob\LeaderBoardBundle\Tests\Criteria\Contracts;

use Ftob\LeaderBoardBundle\Criteria\Contracts\Attribute;
use Ftob\LeaderBoardBundle\Criteria\Contracts\BaseCriteria;
use Illuminate\Support\Collection;

class BaseCriteriaTest extends \PHPUnit_Framework_TestCase
{

    public function testBuild()
    {
        $criteria = BaseCriteria::build();

        $this->assertInstanceOf(BaseCriteria::class, $criteria);
    }

    public function dataProvider()
    {
        $std =  new \StdClass();
        $std->test = 1;
        $std->test2 = 2;
        return [
            [
                   [$std]
            ]
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param $payload
     */
    public function testLess($payload)
    {
        $payload = new Collection($payload);
        $result = BaseCriteria::build()->less(new Attribute('test'), 2)->apply($payload);
        $this->assertTrue(in_array('test', $result->keys()->toArray()));

        $this->assertCount(1, $result->toArray());
    }

    /**
     * @param $payload
     * @dataProvider dataProvider
     */
    public function testEqual($payload)
    {
        $payload = new Collection($payload);
        $result = BaseCriteria::build()->equal(new Attribute('test'), 1)->apply($payload);

        $this->assertTrue(in_array('test', $result->keys()->toArray()));


        $this->assertCount(1, $result->toArray());
    }

    /**
     * @param $payload
     * @dataProvider dataProvider
     */
    public function testGreater($payload)
    {
        $payload = new Collection($payload);

        $result = BaseCriteria::build()->greater(new Attribute('test2'), new Attribute('test'))->apply($payload);

        $this->assertTrue(in_array('test', $result->keys()->toArray()));


        $this->assertCount(1, $result->toArray());
    }
}