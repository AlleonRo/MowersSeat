<?php

namespace MowersSeat\Mower\domain\valueObjects;

use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Shared\Framework\domain\valueObjects\ValueObjectInterface;

class GridX implements ValueObjectInterface
{
    protected int $value;

    /**
     * @param int|null $value
     * @return static
     * @throws XNotValidException
     */
    public static function create(int $value = null): self
    {
        $instance = new self();
        if(null === $value || $value < 0){
            throw new XNotValidException();
        }
        $instance->value = $value;
        return $instance;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}