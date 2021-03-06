<?php

namespace MowersSeat\Mower\domain\events;

use MowersSeat\Shared\Framework\domain\events\DomainEvent;

class GridCreatedEvent extends DomainEvent
{
    public string $id;

    /**
     * GridCreatedEvent constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}