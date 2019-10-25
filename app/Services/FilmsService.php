<?php

namespace App\Services;

use App\Exceptions\SwApiException;
use App\Http\Resources\{FilmResource, FilmResourceCollection};
use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\CommentEloquentRepository;
use GuzzleHttp\Client;

class FilmsService extends BaseService
{

    public function __construct(Client $HttpClient, CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($HttpClient);

    }

    /*** Fetch ALL FILMS
     * @return FilmResourceCollection
     * @throws SwApiException
     */
    public function allFilms():FilmResourceCollection{
        $json_content =  $this->getUrl('https://swapi.co/api/films/')['results'];
        $full_content = collect($json_content)->map(function($item, $key){
            $item['comment_count'] = $this->repository->countForFilm($item['episode_id']);
            return $item;
        });

        $films =  new FilmResourceCollection(FilmResource::collection($full_content));
        return $films;
    }
}