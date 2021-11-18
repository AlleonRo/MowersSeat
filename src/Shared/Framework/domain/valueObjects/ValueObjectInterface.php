<?php

namespace MowersSeat\Shared\Framework\domain\valueObjects;

interface ValueObjectInterface
{
    /**
     * @param int|string $value
     * @return static
     */
    public static function create($value): self;

    /** @return string|int */
    public function getValue();
}