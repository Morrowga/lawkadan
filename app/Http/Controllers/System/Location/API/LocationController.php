<?php

namespace App\Http\Controllers\System\Location\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\System\Location\API\LocationRepositoryInterface;

class LocationController extends Controller
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getLocations(Request $request)
    {
        $cities = $this->locationRepository->getLocations($request);

        return $cities;
    }
}
