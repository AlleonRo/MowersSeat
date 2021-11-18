<?php

namespace MowersSeat\Tests\src\Unit\Mower\application\commands\moveMower;

use MowersSeat\Mower\application\commands\moveMower\MoveMowerCommand;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\MowerId;

class MoveMowerCommandMother
{
    public static function create(MowerId $mowerId, GridId $gridId, string $moves): MoveMowerCommand
    {
        return new MoveMowerCommand($mowerId, $gridId, $moves);
    }
}