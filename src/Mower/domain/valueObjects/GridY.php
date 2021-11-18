<?php

namespace MowersSeat\Mower\domain\valueObjects;

use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Shared\Framework\domain\valueObjects\ValueObjectInterface;

class GridY implements ValueObjectInterface
{
    protected int $value;

    /**
     * @param int $value
     * @return static
     * @throws YNotValidException
     */
    public static function create($value): self
    {
        $instance = new self();
        if(null === $value ||  $value < 0){
            throw new YNotValidException();
        }
        $instance->value = $value;
        return $instance;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}