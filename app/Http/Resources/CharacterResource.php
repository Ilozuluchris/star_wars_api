<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name"=> $this->resource['name'],
            "height"=> $this->resource['height'],
            "mass"=> $this->resource['mass'],
            "hair_color"=> $this->resource['hair_color'],
            "skin_color"=> $this->resource['skin_color'],
            "eye_color"=> $this->resource['eye_color'],
            "birth_year"=> $this->resource['birth_year'],
            "gender"=> $this->resource['gender']
        ];
    }


}
