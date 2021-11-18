<?php

namespace MowersSeat\Mower\domain\entities;

use MowersSeat\Mower\domain\events\GridCreatedEvent;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Shared\Framework\domain\entities\BaseEntity;

class Grid extends BaseEntity
{
    public GridId $id;
    public GridX $x;
    public GridY $y;
    public array $mowers;

    public static function create(GridX $x, GridY $y, GridId $id): Grid
    {
        $instance = new self();
        $instance->x = $x;
        $instance->y = $y;
        $instance->id = $id;
        $instance->mowers = [];
        $instance->recordEvent(new GridCreatedEvent($id->getValue()));
        return $instance;
    }

    public function addMower(Mower $mower): void
    {
        $this->mowers[$mower->id->getValue()] = $mower;
    }

    public function getMower(MowerId $mowerId): ?Mower
    {
        return false === empty($this->mowers[$mowerId->getValue()]) ? $this->mowers[$mowerId->getValue()] : null;
    }

    public function asString() : string
    {
        $outputArray = [];
        foreach($this->mowers as $mower)
        {
            /** @var Mower $mower */
            $outputArray[] = $mower->asString();
        }

        return implode(PHP_EOL, $outputArray);
    }
}