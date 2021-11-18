<?php


namespace TechnicalTest\Shared\Framework\domain\entities;


use TechnicalTest\Shared\Framework\domain\events\DomainEvent;

abstract class BaseEntity
{
    public array $domainEvents = [];

    public function recordEvent(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}