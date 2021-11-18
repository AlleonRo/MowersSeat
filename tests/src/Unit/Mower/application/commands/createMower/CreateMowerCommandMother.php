<?php

namespace MowersSeat\Tests\src\Unit\Mower\application\commands\createMower;

use MowersSeat\Mower\application\commands\createMower\CreateMowerCommand;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;

class CreateMowerCommandMother
{
    public static function create(MowerId $id, PositionX $x, PositionY $y, Orientation $orientation, GridId $gridId): CreateMowerCommand
    {
        return new CreateMowerCommand($id, $x, $y, $orientation, $gridId);
    }
}