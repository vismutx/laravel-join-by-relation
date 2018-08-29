<?php

namespace Vismut\RelationJoiner;

use Illuminate\Database\Connection;
use \Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * This trait is an entry point for all the hooks that we want to apply
 * on the Eloquent Model and Builder in order to let the magic happen.
 *
 * It also provides hasColumn and getColumnListing helper methods
 * so you can easily list or check columns in the model's table.
 *
 * @version 5.5
 *
 * @method Connection getConnection()
 * @method string getTable()
 */
trait Eloquence
{
    /**
     * Create new Eloquence query builder for the instance.
     *
     * @param  \Vismut\RelationJoiner\Builder $query
     * @return \Vismut\RelationJoiner\Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();

        $grammar = $conn->getQueryGrammar();

        return new QueryBuilder($conn, $grammar, $conn->getPostProcessor());
    }
}
