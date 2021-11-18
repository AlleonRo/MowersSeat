<?php

namespace MowersSeat\Tests\src\Unit\Mower\application\queries\obtainGridString;

use MowersSeat\Mower\application\queries\obtainGridString\ObtainGridStringQuery;
use MowersSeat\Mower\domain\valueObjects\GridId;

class ObtainGridStringQueryMother
{
    public static function create(GridId $gridId): ObtainGridStringQuery
    {
        return new ObtainGridStringQuery($gridId);
    }
}