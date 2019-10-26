<?php

namespace  App\Services;

use App\Http\Resources\CharacterResourceCollection;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CharactersService extends BaseNetworkService{


    public function __construct(Client $HttpClient, FilmsService $filmsService)
    {
        $this->filmService = $filmsService;
        parent::__construct($HttpClient);
    }

    public function charactersByFilm(int $film_episode_id, Collection $query_params){
        $characters_in_film = $this->filmService->getFilmContents($film_episode_id)['characters'];
        $characters_details = collect($characters_in_film)->map(function ($item, $key){
           return $this->characterDetails($item);
        });
        $characters_details = $this->applyQueryParams($characters_details, $query_params)->values();
        return new CharacterResourceCollection($characters_details);

    }

    private function characterDetails($characterUrl){
        return $this->getUrl($characterUrl);
    }


    /**
     * @param Collection $query_params
     * @param $characters_details
     * @return mixed
     */
    private function applyQueryParams(Collection $characters_details, Collection $query_params)
    {
        if ($query_params->isNotEmpty()) {
            $characters_details = $this->applyFilterParam($characters_details, $query_params['filter']);
            $characters_details = $this->sortAndOrder($characters_details, $query_params);
        };
        return $characters_details;
    }



    private function applyFilterParam(Collection $collection, $gender){
        //todo ensure filterparams and is a valid gender is allowed if not throw an error
        if (!empty($gender)){
            $characters_filtered_by_gender = $collection->filter(function ($value) use($gender) {
                return $value['gender'] == $gender;
            });
            return $characters_filtered_by_gender;
        }
        return $collection;
    }

    /**
     * @param Collection $query_params
     * @param $characters_details
     * @return mixed
     */
    private function sortAndOrder(Collection $characters_details,$query_params)
    {
        $sort_param = $query_params['sort'];
        if(!empty($sort_param)) {
            return $this->applySortOrder($characters_details, $query_params['order'], $sort_param);
        }
        return $characters_details;

    }


    private function applySortOrder(Collection $characters_details, $order, $sort_param)
    {
        if ($order == 'desc') {
            return $characters_details->sortByDesc($sort_param);
        } else {
            return $characters_details->sortBy($sort_param);
        }
    }

}