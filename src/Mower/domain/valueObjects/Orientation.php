<?php

namespace MowersSeat\Mower\domain\valueObjects;

use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Shared\Framework\domain\valueObjects\ValueObjectInterface;

class Orientation implements ValueObjectInterface
{
    protected string $value;
    public static array $validOrientations = ['N', 'S', 'E', 'W'];

    /**
     * @param string $value
     * @return static
     * @throws OrientationNotValidException
     */
    public static function create($value): self
    {
        $instance = new self();
        if(false === in_array($value, self::$validOrientations)){
            throw new OrientationNotValidException();
        }
        $instance->value = $value;
        return $instance;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}