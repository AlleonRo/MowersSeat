<?php

namespace MowersSeat\Mower\application\commands\moveMower;

use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Shared\Framework\command\CommandInterface;

class MoveMowerCommand implements CommandInterface
{
    public string $moves;
    public string $mowerId;
    public string $gridId;

    /**
     * MoveMowerCommand constructor.
     * @param MowerId $id
     * @param GridId $gridId
     * @param string $moves
     */
    public function __construct(MowerId $id, GridId $gridId, string $moves)
    {
        $this->mowerId = $id->getValue();
        $this->gridId = $gridId->getValue();
        $this->moves = $moves;
    }
}