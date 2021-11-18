<?php

namespace MowersSeat\Tests\apps\functional\backend\src\controllers;

use MowersSeat\backend\controllers\MowerController;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use PHPUnit\Framework\TestCase;

class MowerControllerTest extends TestCase
{
    /**
     * @throws OrientationNotValidException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public function testMowerHarvestWorks()
    {
        $input = '5 5'.PHP_EOL.'1 2 N'.PHP_EOL.'LMLMLMLMM'.PHP_EOL.'3 3 E'.PHP_EOL.'MMRMMRMRRM';
        $outputExpected = '1 3 N'.PHP_EOL.'5 1 E';
        $output = (new MowerController())->actionHarvestGrid($input);
        self::assertEquals($outputExpected, $output);
    }
}