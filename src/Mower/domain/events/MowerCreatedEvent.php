<?php

namespace MowersSeat\Mower\domain\events;

use MowersSeat\Shared\Framework\domain\events\DomainEvent;

class MowerCreatedEvent extends DomainEvent
{
    public string $id;

    /**
     * MowerCreatedEvent constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}