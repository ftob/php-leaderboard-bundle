<?php

namespace Ftob\LeaderBoardBundle\Services;

use Ftob\LeaderBoardBundle\Criteria\Contracts\Attribute;
use Ftob\LeaderBoardBundle\Criteria\Contracts\BaseCriteria;
use Ftob\LeaderBoardBundle\Services\Contracts\LeaderServiceInterface;
use Ftob\LeaderBoardBundle\Repositories\Contracts\RepositoryInterface;
use Ftob\LeaderBoardBundle\Services\Contracts\StatisticsInterface;
use Illuminate\Support\Collection;

/**
 * Class LeaderService
 * @package Ftob\LeaderBoardBundle\Services
 */
class LeaderService implements LeaderServiceInterface
{
    /** @var StatisticsInterface  */
    protected $statistics;
    /** @var RepositoryInterface  */
    protected $repository;

    public function __construct(RepositoryInterface $repositoryInterface, StatisticsInterface $statisticInterface)
    {
        $this->statistics = $statisticInterface;
        $this->repository = $repositoryInterface;
    }

    /**
     * @inheritdoc
     * @return StatisticsInterface
     */
    public function statistics()
    {
        $this->statistics->setCurrentLeaders($this->repository()->findAll());
        return $this->statistics;
    }

    /**
     * @inheritdoc
     * @return Collection
     */
    public function getLeaders()
    {
        return $this->repository()->findAll();
    }


    public function getLeaderByPosition($position)
    {
        $leaders = $this->repository()->findBy(new Attribute('place'), $position);

        return $leaders;
    }

    /**
     * @inheritdoc
     * @param $position
     * @param $offset
     */
    public function getLeadersBetweenPosition($position, $offset)
    {
        $greater = ($position > $offset) ? $offset : $position;
        $less = ($position < $offset) ? $offset : $position;
        $criteria = BaseCriteria::build()->greater(new Attribute('place'), $greater)
            ->less(new Attribute('place'), $less);
        return $this->repository()->findByCriteria($criteria);

    }

    public function resetCache()
    {
        // TODO: Implement resetCache() method.
        return false;
    }

    public function repository()
    {
        return $this->repository;
    }


}