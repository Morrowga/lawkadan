<?php

namespace App\Http\Resources\System\Location\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\System\Location\API\CityResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name_mm" => $this->name_mm,
            "name_en" => $this->name_en,
            "flat" => $this->flag,
            "is_hot" => $this->is_hot,
            "active" => $this->active,
            "cities" => CityResource::collection($this->cities)
        ];
    }
}
