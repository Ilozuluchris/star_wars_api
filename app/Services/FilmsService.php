<?php

namespace App\Services;

use App\Exceptions\SwApiException;
use App\Http\Resources\{FilmResource, FilmResourceCollection};

class FilmsService extends BaseService
{
    /*** Fetch ALL FILMS
     * @return FilmResourceCollection
     * @throws SwApiException
     */

    public function allFilms():FilmResourceCollection{
        $json_content =  $this->getUrl('https://swapi.co/api/films/');
        $films =  new FilmResourceCollection(FilmResource::collection(collect($json_content['results'])));
        return $films;
    }
}