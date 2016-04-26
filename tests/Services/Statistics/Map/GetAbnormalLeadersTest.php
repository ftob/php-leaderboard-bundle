<?php

namespace Ftob\LeaderBoardBundle\Services\Statistics\Map;

use Ftob\LeaderBoardBundle\Repositories\Contracts\HttpConnection;
use Ftob\LeaderBoardBundle\Repositories\LeaderRepository;
use Ftob\LeaderBoardBundle\Services\LeaderService;
use Ftob\LeaderBoardBundle\Services\Statistics;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Collection;

/**
 * Получение аномальных лидеров - (аномальные лидеры - это те лидеры у которых был аномальны рост очков или
 * рост в позицие был аномально быстрый - то есть повышен не натурально)
 * Class GetAbo
 */
class GetAbnormalLeadersTest extends \PHPUnit_Framework_TestCase
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

    public function testExecute()
    {

        $data = json_decode(json_encode([
            [
                'place' => 1,
                'id' => 123456,
                'score' => 212312313123,
                'name' => 'TestName',
                'avatar' => 'TestAvatar.jpg',

            ],
            [
                "place" => 2,
                "score" => 1000000,
                "id" => 2,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 3,
                "score" => 1000000,
                "id" => 3,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 4,
                "score" => 1000000,
                "id" => 4,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 5,
                "score" => 1000000,
                "id" => 5,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 6,
                "score" => 1000000,
                "id" => 6,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 7,
                "score" => 1000000,
                "id" => 7,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 8,
                "score" => 1000000,
                "id" => 8,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 9,
                "score" => 1000000,
                "id" => 9,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 10,
                "score" => 100012310,
                "id" => 1,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ]
        ]));

        $preLeaders = [
            new Collection($data)
        ];

        $result = $this->service->statistics()->map(new GetAbnormalLeaders(), [
            $this->service->getLeaders(),
            $preLeaders
        ])->getResultMap();



        $this->assertArrayHasKey(1, $result);
        $this->assertArrayHasKey(123456, $result);

    }
}

