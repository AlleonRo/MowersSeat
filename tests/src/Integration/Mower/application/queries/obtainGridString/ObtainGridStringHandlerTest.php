<?php

namespace MowersSeat\Tests\Integration\Mower\application\queries\obtainGridString;

use MowersSeat\Mower\application\queries\obtainGridString\ObtainGridStringHandler;
use MowersSeat\Mower\domain\exceptions\GridNotExistsException;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\infrastructure\repositories\GridArrayRepository;
use MowersSeat\Tests\src\Unit\Mower\application\queries\obtainGridString\ObtainGridStringQueryMother;
use MowersSeat\Tests\src\Unit\Mower\domain\entities\GridMother;
use PHPUnit\Framework\TestCase;

class ObtainGridStringHandlerTest extends TestCase
{
    /**
     * @throws XNotValidException
     * @throws YNotValidException
     * @throws GridNotExistsException
     * @throws OrientationNotValidException
     */
    public function testObtainGridString(): void
    {
        $grid = GridMother::createWithMower();
        $gridRepository = new GridArrayRepository();
        $gridRepository->storeGrid($grid);
        $query = ObtainGridStringQueryMother::create($grid->id);
        $obtainGridStringHandler = new ObtainGridStringHandler($gridRepository);
        $output = $obtainGridStringHandler->__invoke($query);

        self::assertEquals('2 3 N'.PHP_EOL.'4 1 W', $output);
    }
}