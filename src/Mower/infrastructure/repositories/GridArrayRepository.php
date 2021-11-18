<?php

namespace MowersSeat\Mower\infrastructure\repositories;

use MowersSeat\Mower\domain\entities\Grid;
use MowersSeat\Mower\domain\valueObjects\GridId;

class GridArrayRepository implements GridRepositoryInterface
{
    public static array $grids = [];

    public function retrieveGrid(GridId $GridId): ?Grid
    {
        if(empty(self::$grids[$GridId->getValue()])){
            return null;
        }
        return self::$grids[$GridId->getValue()];
    }

    public function storeGrid(Grid $grid): void
    {
        self::$grids[$grid->id->getValue()] = $grid;
    }
}