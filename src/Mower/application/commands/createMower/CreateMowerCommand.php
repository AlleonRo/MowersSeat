<?php

namespace MowersSeat\Mower\application\commands\createMower;

use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;
use MowersSeat\Shared\Framework\command\CommandInterface;

class CreateMowerCommand implements CommandInterface
{
    public string $id;
    public int $x;
    public int $y;
    public string $orientation;
    public string $gridId;

    /**
     * CreateMowerCommand constructor.
     * @param MowerId $id
     * @param PositionX $gridX
     * @param PositionY $gridY
     */
    public function __construct(MowerId $id, PositionX $gridX, PositionY $gridY, Orientation $orientation, GridId $gridId)
    {
        $this->id = $id->getValue();
        $this->x = $gridX->getValue();
        $this->y = $gridY->getValue();
        $this->orientation = $orientation->getValue();
        $this->gridId = $gridId->getValue();
    }
}