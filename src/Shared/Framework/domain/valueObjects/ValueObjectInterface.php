<?php


namespace TechnicalTest\Shared\Framework\domain\valueObjects;


interface ValueObjectInterface
{

    /**
     * @param string|null $value
     * @return static
     */
    public static function create(string $value = null): self;

    /** @return string|int */
    public function getValue();

}