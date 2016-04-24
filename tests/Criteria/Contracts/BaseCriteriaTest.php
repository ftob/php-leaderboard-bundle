<?php
namespace Ftob\LeaderBoardBundle\Tests\Criteria\Contracts;

use Ftob\LeaderBoardBundle\Criteria\Contracts\Attribute;
use Ftob\LeaderBoardBundle\Criteria\Contracts\BaseCriteria;
use phpDocumentor\Reflection\DocBlock\Type\Collection;

class BaseCriteriaTests extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $criteria = BaseCriteria::build();

        $this->assertInstanceOf(BaseCriteria::class, $criteria);
    }

    public function dataProvider()
    {
        return [
            [
                new Collection([
                    [
                        'test' => 1,
                        'test2' => 2
                    ]
                ])
            ]
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param $payload
     */
    public function testLess($payload)
    {
        $result = BaseCriteria::build()->less(new Attribute('test'), 2)->apply($payload);

        $this->assertArrayHasKey('test', $result->keys()->toArray());

        $this->assertCount(1, $result->toArray());
    }

    /**
     * @param $payload
     * @dataProvider dataProvider
     */
    public function testEqual($payload)
    {
        $result = BaseCriteria::build()->equal(new Attribute('test'), 1)->apply($payload);

        $this->assertArrayHasKey('test', $result->keys()->toArray());

        $this->assertCount(1, $result->toArray());
    }

    /**
     * @param $payload
     * @dataProvider dataProvider
     */
    public function greater($payload)
    {
        $result = BaseCriteria::build()->greater(new Attribute('test2'), new Attribute('test'))->apply($payload);

        $this->assertArrayHasKey('test', $result->keys()->toArray());

        $this->assertCount(1, $result->toArray());
    }
}