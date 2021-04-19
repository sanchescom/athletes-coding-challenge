<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AthleteResource.
 * @property int $id
 * @property string $name
 * @property string $age
 * @property Province $province
 * @property City $city
 */
class AthletesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'location' => $this->city->name . ', ' . $this->province->code,
        ];
    }
}
