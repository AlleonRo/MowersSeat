<?php


namespace TechnicalTest\User\domain\events;


use TechnicalTest\Shared\Framework\domain\events\DomainEvent;

class UserCreatedEvent extends DomainEvent
{
    public string $id;

    /**
     * UserCreatedEvent constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }


}