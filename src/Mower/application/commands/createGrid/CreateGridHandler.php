<?php

namespace MowersSeat\Mower\application\commands\createGrid;

use MowersSeat\Mower\domain\entities\Grid;
use MowersSeat\Mower\domain\exceptions\GridIdExistsException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Shared\Framework\command\CommandHandlerInterface;

class CreateGridHandler implements CommandHandlerInterface
{
    private GridArrayRepository $repository;

    /**
     * CreateGridHandler constructor.
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
     * @param CreateGridCommand $command
     * @throws XNotValidException
     * @throws YNotValidException
     * @throws GridIdExistsException
     */
    public function __invoke(CreateGridCommand $command): void
    {
        $gridId = GridId::create($command->id);
        $gridX = GridX::create($command->x);
        $gridY = GridY::create($command->y);

        $grid = $this->repository->retrieveGrid($gridId);
        if ($grid) {
            throw new GridIdExistsException();
        }
        $grid = Grid::create($gridX, $gridY, $gridId);
        $this->repository->storeGrid($grid);

        // Todo Call to event manager for publish events domains
    }
}