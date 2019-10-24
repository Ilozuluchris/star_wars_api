<?php

namespace App\Services;

use App\Exceptions\SwApiException;
use App\Http\Resources\FilmResource;
use App\Http\Resources\FilmResourceCollection;


class FilmsService extends BaseService
{
    /*** Fetch ALL FILMS
     * @return FilmResourceCollection
     * @throws SwApiException
     */

    public function allFilms(){
        $json_content =  json_decode($this->getUrl('https://swapi.co/api/films/'), true);
        $films =  new FilmResourceCollection(FilmResource::collection(collect($json_content['results'])));
        return $films;
    }
}