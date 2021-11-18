<?php

namespace MowersSeat\Mower\domain\valueObjects;

use MowersSeat\Shared\Framework\domain\valueObjects\ValueObjectInterface;

class MowerId implements ValueObjectInterface
{
    protected string $value;

    /**
     * @param string $value
     * @return static
     */
    public static function create($value): self
    {
        $instance = new self();
        $instance->value = $value;
        return $instance;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}