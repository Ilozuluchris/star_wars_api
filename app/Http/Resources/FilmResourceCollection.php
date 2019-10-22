<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class FilmResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $films = $this->collection;
        $sorted_films = array_values(Arr::sort($films, function ($film) {
            return $film['release_date'];
        }));
        return [
            'data' => $sorted_films,
            ];
    }
}
