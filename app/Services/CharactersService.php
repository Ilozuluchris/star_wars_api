<?php

namespace  App\Services;

use App\Http\Resources\CharacterResourceCollection;
use GuzzleHttp\Client;

class CharactersService extends BaseNetworkService{


    public function __construct(Client $HttpClient, FilmsService $filmsService)
    {
        $this->filmService = $filmsService;
        parent::__construct($HttpClient);
    }

    public function charactersByFilm(int $film_episode_id){
        $characters_in_film = $this->filmService->getFilmContents($film_episode_id)['characters'];
        $characters_details = collect($characters_in_film)->map(function ($item, $key){
           return $this->characterDetails($item);
        });
        return new CharacterResourceCollection($characters_details);

    }

    private function characterDetails($characterUrl){
        return $this->getUrl($characterUrl);
    }
}