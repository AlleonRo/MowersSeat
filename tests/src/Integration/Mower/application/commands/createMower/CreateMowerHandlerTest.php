<?php

namespace MowersSeat\Tests\Integration\Mower\application\commands\createMower;

use MowersSeat\Mower\application\commands\createGrid\CreateGridHandler;
use MowersSeat\Mower\application\commands\createMower\CreateMowerHandler;
use MowersSeat\Mower\domain\exceptions\GridIdExistsException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Tests\src\Unit\Mower\application\commands\createGrid\CreateGridCommandMother;
use MowersSeat\Tests\src\Unit\Mower\application\commands\createMower\CreateMowerCommandMother;
use PHPUnit\Framework\TestCase;

class CreateMowerHandlerTest extends TestCase
{
    /**
     * @throws GridIdExistsException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public function testCreateMower(): void
    {
        $gridRepository = new GridArrayRepository();
        $createGridHandler = new CreateGridHandler($gridRepository);
        $gridId = GridId::create('3');
        $command = CreateGridCommandMother::create($gridId, GridX::create(5), GridY::create(5));
        $createGridHandler->__invoke($command);

        $createMowerHandler = new CreateMowerHandler($gridRepository);
        $command = CreateMowerCommandMother::create(MowerId::create('1'), PositionX::create(1), PositionY::create(2), Orientation::create('N'), $gridId);
        $createMowerHandler->__invoke($command);

        self::assertNotNull($gridRepository->retrieveGrid($gridId)->mowers);
    }
}