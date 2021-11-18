<?php

namespace MowersSeat\Mower\domain\entities;

use MowersSeat\Mower\domain\exceptions\MovementNotValidException;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\valueObjects\Orientation;

class Movement
{
    private static array $leftMoves = ['N' => 'W', 'W' => 'S', 'S' => 'E', 'E' => 'N'];
    private static array $rightMoves = ['N' => 'E', 'E' => 'S', 'S' => 'W', 'W' => 'N'];

    /**
     * @param string $move
     * @param Orientation $orientation
     * @return Orientation
     * @throws MovementNotValidException
     * @throws OrientationNotValidException
     */
    public static function turn(string $move, Orientation $orientation): Orientation
    {
        switch ($move)
        {
            case 'L':
                return Orientation::create(self::$leftMoves[$orientation->getValue()]);
            case 'R':
                return Orientation::create(self::$rightMoves[$orientation->getValue()]);
            default:
                throw new MovementNotValidException();
        }
    }
}