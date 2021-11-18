<?php

namespace MowersSeat\Tests\src\Unit\Mower\domain\entities;

use MowersSeat\Mower\domain\entities\Grid;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;

class GridMother
{
    public static function create(): Grid
    {
        return Grid::create(GridX::create(10), GridY::create(5), GridId::create('123'));
    }

    /**
     * @return Grid
     * @throws OrientationNotValidException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public static function createWithMower(): Grid
    {
        $grid = self::create();
        $mower = MowerMother::create('asd1asd', 2, 3, 'N', $grid->x->getValue(), $grid->y->getValue());
        $grid->addMower($mower);
        $mower = MowerMother::create('dsd2', 4, 1, 'W', $grid->x->getValue(), $grid->y->getValue());
        $grid->addMower($mower);
        return $grid;
    }
}