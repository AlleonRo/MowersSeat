<?php

namespace MowersSeat\Mower\domain\entities;

use MowersSeat\Mower\domain\events\MowerCreatedEvent;
use MowersSeat\Mower\domain\exceptions\MovementNotValidException;
use MowersSeat\Mower\domain\exceptions\OrientationNotValidException;
use MowersSeat\Mower\domain\exceptions\XNotValidException;
use MowersSeat\Mower\domain\exceptions\YNotValidException;
use MowersSeat\Mower\domain\valueObjects\MowerId;
use MowersSeat\Mower\domain\valueObjects\Orientation;
use MowersSeat\Mower\domain\valueObjects\PositionX;
use MowersSeat\Mower\domain\valueObjects\PositionY;
use MowersSeat\Shared\Framework\domain\entities\BaseEntity;

class Mower extends BaseEntity
{
    public MowerId $id;
    public PositionX $x;
    public PositionY $y;
    public Orientation $orientation;
    private PositionX $maxX;
    private PositionY $maxY;

    public static function create(MowerId $id, PositionX $x, PositionY $y, Orientation $orientation, PositionX $maxX, PositionY $maxY)
    {
        $instance = new self();
        $instance->x = $x;
        $instance->y = $y;
        $instance->id = $id;
        $instance->orientation = $orientation;
        $instance->maxX = $maxX;
        $instance->maxY = $maxY;
        $instance->recordEvent(new MowerCreatedEvent($id->getValue()));
        return $instance;
    }

    /**
     * @param string $move
     * @throws MovementNotValidException
     * @throws OrientationNotValidException
     * @throws XNotValidException
     * @throws YNotValidException
     */
    public function move(string $move): void
    {
        switch ($move) {
            case 'L':
            case 'R':
                $this->orientation = Movement::turn($move, $this->orientation);
                break;
            case 'M':
                if ('N' === $this->orientation->getValue()) {
                    if ($this->y->getValue() + 1 <= $this->maxY->getValue()) {
                        $this->y = PositionY::create($this->y->getValue() + 1);
                    }
                } elseif ('S' === $this->orientation->getValue()) {
                    if ($this->y->getValue() - 1 >= 0) {
                        $this->y = PositionY::create($this->y->getValue() - 1);
                    }
                } elseif ('E' === $this->orientation->getValue()) {
                    if ($this->x->getValue() + 1 <= $this->maxX->getValue()) {
                        $this->x = PositionX::create($this->x->getValue() + 1);
                    }
                } elseif ('W' === $this->orientation->getValue()) {
                    if ($this->x->getValue() - 1 >= 0) {
                        $this->x = PositionX::create($this->x->getValue() - 1);
                    }
                }
        }
    }

    public function asString(): string
    {
        return $this->x->getValue() . ' ' . $this->y->getValue() . ' ' . $this->orientation->getValue();
    }
}