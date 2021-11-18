<?php

namespace MowersSeat\Mower\infrastructure\repositories;

use MowersSeat\Mower\domain\entities\Grid;
use MowersSeat\Mower\domain\valueObjects\GridId;

interface GridRepositoryInterface
{
    public function retrieveGrid(GridId $id): ?Grid;
    public function storeGrid(Grid $grid): void;
}