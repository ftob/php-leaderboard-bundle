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
     * @param Collection $collection
     * @return void
     */
    public function setCurrentLeaders(Collection $collection);

    /**
     * @return Collection
     */
    public function getCurrentLeaders();

    /**
     * Кол-во изменений позиций для текущих лидеров
     * @param []Collection $prevLeaders
     * @return Collection
     */
    public function changesInTheNumberOfPositions(array $prevLeaders);

    /**
     * На Сколько позиций повысил игрок свой рейтинг
     * @param $id
     * @param []Collection $prevLeaders
     * @return int
     */
    public function numberOfEnhancementsInThePosition($id, array $prevLeaders);

    /**
     * На Сколько позиций понизил игрок свой рейтинг
     * @param $id
     * @param []Collection $prevLeaders
     * @return mixed
     */
    public function numberOfSlidesInThePosition($id, array $prevLeaders);

    /**
     * @param $id
     * @param []Collection $prevLeaders
     * @return Collection
     */
    public function getHistoryProfileLeader($id, array $prevLeaders);

    /**
     * Получение аномальных лидеров - (аномальные лидеры - это те лидеры у которых был аномальны рост очков или
     * рост в позицие был аномально быстрыйы - то есть повышен не натурально)
     * @return Collection
     */
    public function getAbnormalLeaders();

}
