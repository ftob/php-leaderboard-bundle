<?php

namespace Ftob\LeaderBoardBundle\Services\Contracts;

use Ftob\LeaderBoardBundle\Repositories\Contracts\RepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Interface LeaderServiceInterface
 * @package Ftob\LeaderBoardBundle\Criteria\Contracts
 */
interface LeaderServiceInterface
{
    /**
     * @return StatisticInterface
     */
    public function statistics();

    /**
     * @return Collection
     */
    public function getLeaders();

    /**
     * @param $position
     * @return Collection
     */
    public function getLeaderByPosition($position);

    /**
     * @param $position
     * @param $offset
     * @return Collection
     */
    public function getLeadersBetweenPosition($position, $offset);

    /**
     * @return bool
     */
    public function resetCache();

    /**
     * @return RepositoryInterface
     */
    public function repository();
}