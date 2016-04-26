<?php

namespace Ftob\LeaderBoardBundle\Services\Statistics\Map;

use Illuminate\Support\Collection;

/**
 * Получение аномальных лидеров - (аномальные лидеры - это те лидеры у которых был аномальны рост очков или
 * рост в позицие был аномально быстрый - то есть повышен не натурально)
 * Class GetAbo
 * @package Ftob\LeaderBoardBundle\Services\Statistics\Map
 */
class GetAbnormalLeaders
{
    protected $result;

    /** @var  array Hidden risk - если не ожиданно появился в списке лидеров */
    protected $hidRisk = [];

    /** коэффициент аномального роста */
    const RISK_GROWTH_SCOPE = 2;

    /**
     * На самом деле тут у меня фантация играет по полной, поймать мошеника это круто
     * можно было реализовать из hidden risk некую битовую маску и по ней уже обсчитывать мошеников
     * @param Collection $leaders
     * @param []Collection $prevLeaders
     * @return []Collection
     */
    public function __invoke(Collection $leaders, array $prevLeaders)
    {
        $leaders->each(function($value) use ($prevLeaders) {
            $id = object_get($value, 'id', null);
            $score = object_get($value, 'score', null);
            // Идем по списку лидеров
            foreach ($prevLeaders as $leaders) {

                $leaders->each(function($leader) use ($id, $score){
                    // Если личдер найден
                    if ($leader->id === $id) {
                        // И он есть в  hidden risk
                        if (isset($this->hidRisk[$id])) {
                            // Удаляем его
                            unset($this->hidRisk[$id]);
                        }
                        // Если сейчас у него очков больше чем в прошлый раз
                        if ($leader->score < ($score / static::RISK_GROWTH_SCOPE)) {
                            $this->result[$id] = $leader;
                        } else {
                            $this->hidRisk[$id] = $leader;
                        }
                    }
                });
            }
            if (isset($this->hidRisk[$id])) {
                $this->result[$id] = $value;
            }
        });

        return $this->result;
    }

}