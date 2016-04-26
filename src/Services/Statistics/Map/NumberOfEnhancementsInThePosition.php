<?php

namespace Ftob\LeaderBoardBundle\Services\Statistics\Map;

/**
 * На Сколько позиций повысил игрок свой рейтинг
 * Class NumberOfEnhancementsInThePosition
 * @package Ftob\LeaderBoardBundle\Services\Statistics\Map
 */
class NumberOfEnhancementsInThePosition
{
    protected $result;

    protected $maxPosition;

    protected $minPosition;

    /***
     * @param $id
     * @param array $prevLeaders
     * @return mixed
     */
    public function __invoke($id, array $prevLeaders)
    {

        foreach ($prevLeaders as $leaders) {
            $leaders->each(function($leader)  use ($id) {
                if ($leader->id === $id) {
                    // Если у игрока не было максимальной позиции
                    if (!$this->maxPosition) {
                        $this->maxPosition = $leader->place;
                    } else {
                        if ($this->maxPosition < $leader->place) {
                            return $this->maxPosition = $leader->place;
                        }
                    }
                    // Если у игрока не было минимальной позиции
                    if (!$this->minPosition) {
                        $this->minPosition = $leader->place;
                    } else {
                        if ($this->minPosition > $leader->place) {
                            return $this->maxPosition = $leader->place;
                        }
                    }
                }
            });

            return $this->maxPosition - $this->minPosition;
        }

    }
}