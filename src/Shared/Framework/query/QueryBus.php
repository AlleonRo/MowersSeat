<?php

namespace MowersSeat\Shared\Framework\query;

use function get_class;

class QueryBus
{
    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public static function query(QueryInterface $query)
    {
        $key = get_class($query);
        $queryHandlerName = str_replace('Query', 'Handler', $key);

        /** @var QueryHandlerInterface $handler */
        $handler = new $queryHandlerName();
        return $handler->__invoke($query);
    }
}