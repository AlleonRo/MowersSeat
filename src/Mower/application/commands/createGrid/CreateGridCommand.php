<?php

namespace MowersSeat\Mower\application\commands\createGrid;

use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;
use MowersSeat\Shared\Framework\command\CommandInterface;

class CreateGridCommand implements CommandInterface
{
    public string $id;
    public int $x;
    public int $y;

    /**
     * CreateGridCommand constructor.
     * @param GridId $id
     * @param GridX $gridX
     * @param GridY $gridY
     */
    public function __construct(GridId $id, GridX $gridX, GridY $gridY)
    {
        $this->id = $id->getValue();
        $this->x = $gridX->getValue();
        $this->y = $gridY->getValue();
    }
}