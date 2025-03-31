<?php

namespace App\Http\Resources\System\Location\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            "name_en" => $this->name_en,
            "name_mm" => $this->name_mm,
            "posts_count" => $this->posts_count,
            "active" => $this->active
        ];
    }
}
