<?php
namespace Ftob\LeaderBoardBundle\Repositories;


use Ftob\LeaderBoardBundle\Criteria\Contracts\Attribute;
use Ftob\LeaderBoardBundle\Criteria\Contracts\BaseCriteria;
use Ftob\LeaderBoardBundle\Repositories\Contracts\HttpConnection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Collection;

class HttpRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  LeaderRepository */
    protected $repository;

    public function setUp()
    {
        $this->repository = new LeaderRepository(
            new HttpConnection(new Uri('http://0.0.0.0:8000/leaderboard'), false),
            new Client()
        );

    }

    public function testFindAll()
    {
        $leaders = $this->repository->findAll();

        $this->assertInstanceOf(Collection::class, $leaders);

    }

    public function testFind()
    {
        $leader = $this->repository->find(1);

        $this->assertInstanceOf(Collection::class, $leader);
    }

    public function testFindBy()
    {
        $leaders = $this->repository->findBy('score', 10000);

        $this->assertInstanceOf(Collection::class, $leaders);
    }

    public function testFindByCriteria()
    {

        $criteria = BaseCriteria::build()->equal(new Attribute('id'), 1);
        
        $leaders = $this->repository->findByCriteria($criteria);

        $this->assertInstanceOf(Collection::class, $leaders);
    }


}