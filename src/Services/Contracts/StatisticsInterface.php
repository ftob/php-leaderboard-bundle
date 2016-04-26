<?php
namespace Ftob\LeaderBoardBundle\Services\Contracts;


use Illuminate\Support\Collection;

/**
 * Interface StatisticInterface
 * @package Ftob\LeaderBoardBundle\Services\Contracts
 */
interface StatisticsInterface
{
    /**
     * Map
     * @param callable $callback
     * @param array $parameters
     * @return mixed
     */
    public function map(callable $callback, array $parameters = []);

    /**
     * Reduce
     * @param callable $callback
     * @param array $parameters
     * @return mixed
     */
    public function reduce(callable $callback, array $parameters = []);

    /**
     * @param Collection $collection
     * @return void
     */
    public function setCurrentLeaders(Collection $collection);

    /**
     * @return Collection
     */
    public function getCurrentLeaders();


    /**
     * @param []Collection $prevLeaders
     * @return void
     */
    public function setPrevLeaders(array $prevLeaders);

    /**
     * @return []Collection
     */
    public function getPrevLeaders();

    /**
     * @return mixed
     */
    public function getResultMap();
    

//
//    /**
//     * @param $id
//     * @param []Collection $prevLeaders
//     * @return Collection
//     */
//    public function getHistoryProfileLeader($id, array $prevLeaders);
//
//    /**

//     * @return Collection
//     */
//    public function getAbnormalLeaders();

}
