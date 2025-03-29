<?php

namespace App\Interfaces\System\Location\API;

use Illuminate\Http\Request;

interface LocationRepositoryInterface
{
    public function getLocations(Request $request);
}
