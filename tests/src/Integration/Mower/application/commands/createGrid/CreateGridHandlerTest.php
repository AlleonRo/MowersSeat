<?php

namespace MowersSeat\Tests\Integration\Mower\application\commands\createGrid;

use MowersSeat\Mower\application\commands\createGrid\CreateGridHandler;
use MowersSeat\Mower\domain\exceptions\GridIdExistsException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Tests\src\Unit\Mower\application\commands\createGrid\CreateGridCommandMother;
use PHPUnit\Framework\TestCase;

class CreateGridHandlerTest extends TestCase
{
    /**
     * @throws GridIdExistsException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public function testCreateGrid(): void
    {
        $gridRepository = new GridArrayRepository();
        $createGridHandler = new CreateGridHandler($gridRepository);
        $gridId = GridId::create('2');
        $command = CreateGridCommandMother::create($gridId, GridX::create(5), GridY::create(5));
        $createGridHandler->__invoke($command);
        self::assertNotNull($gridRepository->retrieveGrid($gridId));
    }
}