<?php

namespace App\Services;

use App\Exceptions\SwApiException;
use App\Http\Resources\{FilmResource, FilmResourceCollection};
use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\CommentEloquentRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class FilmsService extends BaseNetworkService
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
        $films = $this->serializeFilmsData($json_content);
        return new FilmResourceCollection($films);

    }

    public function getFilmContents(int $film_episode_id){
        $json_content = $this->getUrl('https://swapi.co/api/films/'.$film_episode_id);
        return $json_content;
    }

    /**
     * @param $json_content
     *
     */
    private function addCommentCount($json_content)
    {
        $full_content = collect($json_content)->map(function ($item, $key) {
            $item['comment_count'] = $this->repository->countForFilm($item['episode_id']);
            return $item;
        });
        return $full_content;
    }

    /**
     * @param $json_content
     * @return mixed
     */
    private function serializeFilmsData($json_content)
    {
        $full_content = $this->addCommentCount($json_content);
        $sorted_films = $full_content->sortBy('release_date')->values();
        return $sorted_films;
    }
}