<?php

namespace Vismut\RelationJoiner;

use Vismut\RelationJoiner\Contracts\Relations\JoinerFactory;

/**
 * @method $this leftJoin($table, $one, $operator, $two)
 */
class Builder extends \Illuminate\Database\Eloquent\Builder
{
    /**
     * Joiner factory instance.
     *
     * @var \Vismut\RelationJoiner\Contracts\Relations\JoinerFactory
     */
    protected static $joinerFactory;

    /**
     * Relations joiner instance.
     *
     * @var \Vismut\RelationJoiner\Contracts\Relations\Joiner
     */
    protected $joiner;

    /**
     * Join related tables.
     *
     * @param  array|string $relations
     * @param  string $type
     * @return $this
     */
    public function joinRelations($relations, $type = 'inner')
    {
        if (is_null($this->joiner)) {
            $this->joiner = static::$joinerFactory->make($this);
        }

        if (!is_array($relations)) {
            list($relations, $type) = [func_get_args(), 'inner'];
        }

        foreach ($relations as $relation) {
            $this->joiner->join($relation, $type);
        }

        return $this;
    }

    /**
     * Left join related tables.
     *
     * @param  array|string $relations
     * @return $this
     */
    public function leftJoinRelations($relations)
    {
        $relations = is_array($relations) ? $relations : func_get_args();

        return $this->joinRelations($relations, 'left');
    }

    /**
     * Right join related tables.
     *
     * @param  array|string $relations
     * @return $this
     */
    public function rightJoinRelations($relations)
    {
        $relations = is_array($relations) ? $relations : func_get_args();

        return $this->joinRelations($relations, 'right');
    }

    /**
     * Set the relations joiner factory instance.
     *
     * @param \Vismut\RelationJoiner\Contracts\Relations\JoinerFactory $factory
     */
    public static function setJoinerFactory(JoinerFactory $factory)
    {
        static::$joinerFactory = $factory;
    }
}
