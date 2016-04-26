<?php

namespace Ftob\LeaderBoardBundle\Services\Statistics\Map;

/**
 * История пользователя
 * Class GetHistoryProfileLeader
 * @package Ftob\LeaderBoardBundle\Services\Statistics\Map
 */
class GetHistoryProfileLeader
{
    protected $result = [];

    /**
     * @param $id
     * @param array $prevLeaders
     * @return array
     */
    public function __invoke($id, array $prevLeaders)
    {
        foreach ($prevLeaders as $leaders) {
            $leaders->each(function($leader) use ($id){
                if ($leader->id === $id) {
                    $this->result[] = $leader;
                }
            });

        }

        return $this->result;
    }
}