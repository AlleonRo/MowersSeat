<?php

namespace MowersSeat\Mower\domain\valueObjects;

use MowersSeat\Shared\Framework\domain\valueObjects\ValueObjectInterface;

class GridX implements ValueObjectInterface
{
    protected int $value;

    public static function create(string $value = null): self
    {
        $instance = new self();
        if ($value) {
            $instance->value = $value;
            return $instance;
        }
        $instance->value = 10;
        return $instance;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}