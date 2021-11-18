<?php

namespace MowersSeat\Mower\application\commands\createMower;

use MowersSeat\Mower\domain\entities\Mower;
use MowersSeat\Mower\domain\exceptions\GridNotExistsException;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Shared\Framework\command\CommandHandlerInterface;

class CreateMowerHandler implements CommandHandlerInterface
{
    private GridArrayRepository $repository;

    /**
     * CreateMowerIntoGridHandler constructor.
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
     * @param CreateMowerCommand $command
     * @throws GridNotExistsException
     * @throws XNotValidException
     * @throws YNotValidException
     * @throws OrientationNotValidException
     */
    public function __invoke(CreateMowerCommand $command)
    {
        $gridId = GridId::create($command->gridId);

        $grid = $this->repository->retrieveGrid($gridId);
        if (null === $grid) {
            throw new GridNotExistsException();
        }

        $mower = Mower::create(MowerId::create($command->id), PositionX::create($command->x), PositionY::create($command->y),
            Orientation::create($command->orientation), PositionX::create($grid->x->getValue()),
            PositionY::create($grid->y->getValue()));
        $grid->addMower($mower);
        $this->repository->storeGrid($grid);
        // Todo Call to event manager for publish events domains
    }
}