<?php

namespace MowersSeat\Mower\application\queries\obtainGridString;

use MowersSeat\Mower\domain\exceptions\GridNotExistsException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Shared\Framework\query\QueryHandlerInterface;

class ObtainGridStringHandler implements QueryHandlerInterface
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
     * @param ObtainGridStringQuery $query
     * @return string
     * @throws GridNotExistsException
     */
    public function __invoke(ObtainGridStringQuery $query)
    {
        $gridId = GridId::create($query->gridId);

        $grid = $this->repository->retrieveGrid($gridId);
        if (null === $grid) {
            throw new GridNotExistsException();
        }

        return $grid->asString();
    }
}