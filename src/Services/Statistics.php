<?php

namespace Ftob\LeaderBoardBundle\Services;

use Ftob\LeaderBoardBundle\Services\Contracts\StatisticsInterface;
use Illuminate\Support\Collection;

class Statistics implements StatisticsInterface
{
    public function setCurrentLeaders(Collection $collection)
    {
        // TODO: Implement setCurrentLeaders() method.
    }


    /**
     * @inheritdoc
     */
    public function getCurrentLeaders()
    {
        // TODO: Implement getCurrentLeaders() method.
    }

    /**
     * @inheritdoc
     * @param array $prevLeaders
     */
    public function changesInTheNumberOfPositions(array $prevLeaders)
    {
        // TODO: Implement changesInTheNumberOfPositions() method.
    }

    /**
     * @inheritdoc
     * @param $id
     * @param array $prevLeaders
     */
    public function numberOfEnhancementsInThePosition($id, array $prevLeaders)
    {
        // TODO: Implement numberOfEnhancementsInThePosition() method.
    }

    /**
     * @inheritdoc
     * @param $id
     * @param array $prevLeaders
     */
    public function numberOfSlidesInThePosition($id, array $prevLeaders)
    {
        // TODO: Implement numberOfSlidesInThePosition() method.
    }

    /**
     * @inheritdoc
     * @param $id
     * @param array $prevLeaders
     */
    public function getHistoryProfileLeader($id, array $prevLeaders)
    {
        // TODO: Implement getHistoryProfileLeader() method.
    }

    /**
     * @inheritdoc
     */
    public function getAbnormalLeaders()
    {
        // TODO: Implement getAbnormalLeaders() method.
    }


}