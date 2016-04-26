<?php
namespace Ftob\LeaderBoardBundle\Services\Statistics\Map;

use Illuminate\Support\Collection;

/**
 * Кол-во изменений позиций для текущих лидеров
 * Class
 * @package Ftob\LeaderBoardBundle\Services\Statistics\Map
 */
class ChangesInTheNumberOfPositions
{
    protected $result = [];

    /**
     * @param Collection $leaders
     * @param []Collection $prevLeaders Массив ранее собраных списков
     * @return array
     */
    public function __invoke(Collection $leaders, array $prevLeaders)
    {
        $leaders->each(function($value) use ($prevLeaders){
            $id = object_get($value, 'id', null);
            $place = object_get($value, 'place', null);

            $this->result[$id] = 0;

            foreach ($prevLeaders as $leaders) {

                $leaders->each(function($value) use ($id, $place){
                    if ($value->id === $id) {
                        if ($value->place !== $place) {
                            $this->result[$id]++;
                        }
                    }
                });
            }
        });

        return $this->result;
    }
}
