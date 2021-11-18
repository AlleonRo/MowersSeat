<?php

namespace MowersSeat\Tests\src\Unit\Mower\domain\entities;

use MowersSeat\Mower\domain\entities\Mower;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;

class MowerMother
{
    /**
     * @param string $id
     * @param int $positionX
     * @param int $positionY
     * @param string $orientation
     * @param int $maxX
     * @param int $maxY
     * @return Mower
     * @throws OrientationNotValidException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public static function create(string $id, int $positionX, int $positionY, string $orientation, int $maxX, int $maxY): Mower
    {
        return Mower::create(MowerId::create($id), PositionX::create($positionX), PositionY::create($positionY),
            Orientation::create($orientation), PositionX::create($maxX), PositionY::create($maxY));
    }
}