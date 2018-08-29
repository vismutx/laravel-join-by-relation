<?php

namespace Vismut\RelationJoiner\Contracts\Relations;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

interface JoinerFactory
{
    /**
     * Create new joiner instance.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Vismut\RelationJoiner\Contracts\Relations\Joiner
     */
    public static function make($query, Model $model = null);
}
