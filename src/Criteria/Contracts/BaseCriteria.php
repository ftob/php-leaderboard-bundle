<?php
namespace Ftob\LeaderBoardBundle\Criteria\Contracts;

use Ftob\LeaderBoardBundle\Exceptions\CriteriaParametersException;
use Illuminate\Support\Collection;

/**
 * Class BaseCriteria
 * @package Ftob\LeaderBoardBundle\Criteria\Contracts
 */
class BaseCriteria implements CriteriaInterface
{
    const LESS = 'less';

    const EQUAL = 'equal';

    const GREATER = 'greater';

    protected $criteria = [];


    protected function init()
    {
        // Initial function
    }

    private function __construct()
    {
        $this->init();
    }

    public static function build()
    {
        return new static();
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function apply(Collection $collection)
    {
        if(!($collection->isEmpty()) && !(empty($this->criteria))) {
            foreach ($this->criteria as $key => $parameters) {
                // Парамментры могут быть пустыми
                if(empty($parameters)) {
                    continue;
                }
                // Фильтруем значение
                $collection = $collection->filter(function($value) use ($key, $parameters) {
                    foreach ($parameters as $a => $b) {
                        // Получем опреатор в зависимости от ключа
                        $exp = $this->getSign($key);

                        if ($a instanceof Attribute) {
                            if ($b instanceof Attribute) {
                                return eval('$value->{$a} ' .  $exp . ' $value->{$b}');
                            } else {
                                return eval('$value->{$a} ' .  $exp . ' $b');
                            }
                        } else {
                            if ($b instanceof Attribute) {
                                return eval('$value->{$b}' . $exp . '$a');
                            } else {
                                // В любом случае должен быть хотя бы один атрибут
                                throw new CriteriaParametersException('One of parameters must be Attribute');
                            }
                        }

                    }
                    return false;
                });
            }
        }

        return $collection;
    }


    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @param $key
     */
    protected function addCondition($attributeOrValue, $attributeOrValue, $key)
    {
        $this->criteria[$key][] = [$attributeOrValue => $attributeOrValue];
    }

    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @return $this
     */
    public function equal($attributeOrValue, $attributeOrValue)
    {
        $this->addCondition($attributeOrValue, $attributeOrValue, self::EQUAL);
        return $this;
    }

    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @return $this
     */
    public function less($attributeOrValue, $attributeOrValue)
    {
        $this->addCondition($attributeOrValue, $attributeOrValue, self::LESS);
        return $this;
    }

    /**
     * @param $attributeOrValue
     * @param $attributeOrValue
     * @return $this
     */
    public function greater($attributeOrValue, $attributeOrValue)
    {
        $this->addCondition($attributeOrValue, $attributeOrValue, self::GREATER);
        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getSign($key)
    {
        $sign = [
            static::EQUAL => '===',
            static::LESS => '<',
            static::GREATER => '>'
        ];
        if (array_key_exists($key, $sign)) {
            return $sign[$key];
        }

        throw new CriteriaParametersException('Sign not found - ' . $key);
    }

}