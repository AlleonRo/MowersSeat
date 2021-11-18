<?php

namespace MowersSeat\backend\controllers;

use MowersSeat\Mower\application\commands\createGrid\CreateGridCommand;
use MowersSeat\Mower\application\commands\createMower\CreateMowerCommand;
use MowersSeat\Mower\application\commands\moveMower\MoveMowerCommand;
use MowersSeat\Mower\application\queries\obtainGridString\ObtainGridStringQuery;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Mower\domain\valueObjects\GridX;
use MowersSeat\Mower\domain\valueObjects\GridY;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;
use MowersSeat\Shared\Framework\command\CommandBus;
use MowersSeat\Shared\Framework\query\QueryBus;

class MowerController
{
    /**
     * @param string $content
     * @return string
     * @throws OrientationNotValidException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public function actionHarvestGrid(string $content): string
    {
        $numLine = 1;
        $mowerNumber = 1;
        $gridId = GridId::create('24');
        $contentArray = explode(PHP_EOL, $content);
        $this->createGrid($gridId, $contentArray[0]);
        while (isset($contentArray[$numLine], $contentArray[$numLine + 1])) {
            $mowerId = MowerId::create($mowerNumber);
            $this->createMower($gridId, MowerId::create($mowerNumber), $contentArray[$numLine]);
            $this->moveMower($mowerId, $gridId, $contentArray[$numLine + 1]);
            $mowerNumber++;
            $numLine += 2;
        }

        return $this->obtainGridString($gridId);
    }

    /**
     * @param string $contentArray
     * @param GridId $gridId
     * @throws XNotValidException
     * @throws YNotValidException
     */
    private function createGrid(GridId $gridId, string $contentArray): void
    {
        $gridX = explode(' ', $contentArray)[0];
        $gridY = explode(' ', $contentArray)[1];
        $createGrid = new CreateGridCommand($gridId, GridX::create($gridX), GridY::create($gridY));
        CommandBus::dispatch($createGrid);
    }

    /**
     * @param GridId $gridId
     * @param MowerId $mowerId
     * @param string $orientationString
     * @throws XNotValidException
     * @throws YNotValidException
     * @throws OrientationNotValidException
     */
    private function createMower(GridId $gridId, MowerId $mowerId, string $orientationString): void
    {
        $positionX = explode(' ', $orientationString)[0];
        $positionY = explode(' ', $orientationString)[1];
        $orientation = explode(' ', $orientationString)[2];
        $createMowerIntoGrid = new CreateMowerCommand($mowerId, PositionX::create($positionX), PositionY::create($positionY), Orientation::create($orientation), $gridId);
        CommandBus::dispatch($createMowerIntoGrid);
    }

    private function moveMower(MowerId $mowerId, GridId $gridId, string $moves)
    {
        $moveMowerCommand = new MoveMowerCommand($mowerId, $gridId, $moves);
        CommandBus::dispatch($moveMowerCommand);
    }

    private function obtainGridString(GridId $gridId): string
    {

        $gridStringQuery = new ObtainGridStringQuery($gridId);
        return QueryBus::query($gridStringQuery);
    }
}