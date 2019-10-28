<?php

namespace App\Services;

use App\Exceptions\SwapiGetException;
use App\Http\Resources\{FilmResource, FilmResourceCollection};
use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\CommentEloquentRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class FilmsService extends BaseNetworkService
{

    public function __construct(Client $HttpClient, CommentRepositoryInterface $repository)
    {
        $this->comment_repository = $repository;
        parent::__construct($HttpClient);

    }

    /*** Fetch all films
     * @return FilmResourceCollection
     */
    public function allFilms(){
        $json_content =  $this->getUrl('https://swapi.co/api/films/')['results'];
        $films = $this->prepareFilmsData($json_content);
        return new FilmResourceCollection($films);

    }

    /** Get content for film
     * @param int $film_episode_id identifier for film
     * @return array
     */
    public function getFilmContents(int $film_episode_id){
        $json_content = $this->getUrl('https://swapi.co/api/films/'.$film_episode_id);
        return $json_content;
    }

    /** Add comment count to films
     * @param $json_content
     * @return static
     */
    private function addCommentCount($json_content)
    {
        $full_content = collect($json_content)->map(function ($item) {
            $item['comment_count'] = $this->comment_repository->countForFilm($item['episode_id']);
            return $item;
        });
        return $full_content;
    }

    /** Prepare film data for display
     * @param $json_content
     * @return mixed
     */
    private function prepareFilmsData($json_content)
    {
        $full_content = $this->addCommentCount($json_content);
        $sorted_films = $this->sortFilms($full_content);
        return $sorted_films;
    }

    /** Sort Films by release date.
     * @param $full_content
     * @return mixed
     */
    private function sortFilms($full_content)
    {
        return $full_content->sortBy('release_date')->values();
    }
}