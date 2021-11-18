<?php

namespace MowersSeat\Mower\application\queries\obtainGridString;

use MowersSeat\Mower\domain\valueObjects\GridId;
use MowersSeat\Shared\Framework\query\QueryInterface;

class ObtainGridStringQuery implements QueryInterface
{
    public string $gridId;

    /**
     * ObtainGridStringQuery constructor.
     * @param GridId $gridId
     */
    public function __construct(GridId $gridId)
    {
        $this->gridId = $gridId->getValue();
    }
}