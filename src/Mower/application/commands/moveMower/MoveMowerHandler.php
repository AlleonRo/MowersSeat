<?php

namespace MowersSeat\Mower\application\commands\moveMower;

use MowersSeat\Mower\domain\exceptions\GridNotExistsException;
use MowersSeat\Mower\domain\exceptions\MovementNotValidException;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Shared\Framework\command\CommandHandlerInterface;

class MoveMowerHandler implements CommandHandlerInterface
{
    private GridArrayRepository $repository;

    /**
     * MoveMowerHandler constructor.
     * @param GridArrayRepository|null $repository
     */
    public function __construct(GridArrayRepository $repository = null)
    {
        $this->repository = new GridArrayRepository();
        if (null !== $repository) {
            $this->repository = $repository;
        }
    }

    /**
     * @param MoveMowerCommand $command
     * @throws GridNotExistsException
     * @throws OrientationNotValidException
     * @throws XNotValidException
     * @throws YNotValidException
     * @throws MovementNotValidException
     */
    public function __invoke(MoveMowerCommand $command): void
    {
        $gridId = GridId::create($command->gridId);
        $grid = $this->repository->retrieveGrid($gridId);
        if (null === $grid) {
            throw new GridNotExistsException();
        }

        $mower = $grid->getMower(MowerId::create($command->mowerId));
        $movesArray = mb_str_split($command->moves, 1);
        foreach($movesArray as $move){
            $mower->move($move);
        }
        $grid->addMower($mower);
        $this->repository->storeGrid($grid);
        // Todo Call to event manager for publish events domains
    }
}