<?php

namespace App\Repositories\System\Location\API;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\System\Location\API\CityResource;
use App\Http\Resources\System\Location\API\StateResource;
use App\Interfaces\System\Location\API\LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    use ApiResponses;

    public function getLocations(Request $request)
    {
        try {

            $type = $request->query('type') ?? 'city';

            if($type == 'city')
            {
                $query = City::get();
                $data = CityResource::collection($query);
            } else {
                $query = State::with(['cities' => function ($query) {
                    $query->withCount('posts');
                }])->get();

                $data = StateResource::collection($query);
            }
            return $this->success('Cities successfully fetched.', $data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
