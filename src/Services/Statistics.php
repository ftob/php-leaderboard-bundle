<?php

namespace Ftob\LeaderBoardBundle\Services;

use Ftob\LeaderBoardBundle\Services\Contracts\StatisticsInterface;
use Illuminate\Support\Collection;

class Statistics implements StatisticsInterface
{
    protected $leaders;

    protected $prevLeaders = [];

    protected $resultMap;

    /**
     * @param Collection $collection
     */
    public function setCurrentLeaders(Collection $collection)
    {
        $this->leaders = $collection;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentLeaders()
    {
        return $this->leaders;
    }

    /**
     * @param callable $callback
     * @param array $parameters
     * @return $this
     */
    public function map(callable $callback, array $parameters = [])
    {
        $result = call_user_func_array($callback, $parameters);
        $this->setResultMap($result);
        return $this;
    }

    /**
     * @param callable $callback
     * @param array $parameters
     * @return mixed
     */
    public function reduce(callable $callback, array $parameters = [])
    {
        return call_user_func_array($callback, $parameters);
    }

    /**
     * @param array $prevLeaders
     */
    public function setPrevLeaders(array $prevLeaders)
    {
        $this->prevLeaders = $prevLeaders;
    }

    /**
     * @return array
     */
    public function getPrevLeaders()
    {
        return $this->prevLeaders;
    }

    /**
     * @return mixed
     */
    public function getResultMap()
    {
        return $this->resultMap;
    }

    /**
     * @param $data
     */
    protected function setResultMap($data)
    {
        $this->resultMap = $data;
    }


}