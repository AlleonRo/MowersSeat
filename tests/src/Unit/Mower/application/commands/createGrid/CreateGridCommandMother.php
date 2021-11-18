<?php

namespace MowersSeat\Tests\src\Unit\Mower\application\commands\createGrid;

use MowersSeat\Mower\application\commands\createGrid\CreateGridCommand;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;

class CreateGridCommandMother
{
    public static function create(GridId $id, GridX $x, GridY $y): CreateGridCommand
    {
        return new CreateGridCommand($id, $x, $y);
    }
}