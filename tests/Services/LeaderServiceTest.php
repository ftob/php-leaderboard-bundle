<?php

namespace Ftob\LeaderBoardBundle\Tests\Services;

use Ftob\LeaderBoardBundle\Repositories\Contracts\HttpConnection;
use Ftob\LeaderBoardBundle\Repositories\Contracts\RepositoryInterface;
use Ftob\LeaderBoardBundle\Repositories\LeaderRepository;
use Ftob\LeaderBoardBundle\Services\Contracts\StatisticsInterface;
use Ftob\LeaderBoardBundle\Services\LeaderService;
use Ftob\LeaderBoardBundle\Services\Statistics;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Collection;

class LeaderServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var  LeaderService */
    protected $service;

    public function setUp()
    {
        $this->service = new LeaderService(
            new LeaderRepository(
                new HttpConnection(
                    new Uri('http://localhost:8000/leaderboard', false)
                ), new Client())
        , new Statistics());

    }

    public function testStatistics()
    {
        $statistics = $this->service->statistics();

        $this->assertInstanceOf(StatisticsInterface::class, $statistics);
    }

    public function testGetLeaders()
    {
        $leaders = $this->service->getLeaders();

        $this->assertInstanceOf(Collection::class, $leaders);
        $this->assertEquals(10, $leaders->count());
    }

    public function testGetLeadersByPosition()
    {
        $leaders = $this->service->getLeaderByPosition(1);

        foreach ($leaders as $leader) {
            $this->assertEquals(1, $leader->place);
        }
    }

    public function testLeadersBetweenPosition()
    {
        $leaders = $this->service->getLeadersBetweenPosition(1, 3);

        foreach ($leaders as $leader) {
            $this->assertTrue(in_array($leader->place, [1, 2, 3]));
        }
    }


    public function testRepository()
    {
        $repository = $this->service->repository();

        $this->assertInstanceOf(RepositoryInterface::class, $repository);
    }
}