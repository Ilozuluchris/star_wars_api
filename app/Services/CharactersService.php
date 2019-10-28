<?php

namespace  App\Services;

use App\Http\Resources\CharacterResourceCollection;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

/**
 * Class CharactersService
 * @package App\Services
 * Contains logic for character related operations.
 */
class CharactersService extends BaseNetworkService{


    public function __construct(Client $HttpClient, FilmsService $filmsService)
    {
        $this->filmService = $filmsService;
        parent::__construct($HttpClient);
    }

    /** Get a list of characters and reformat them for better representation
     * @param int $film_episode_id Identifier for film
     * @param Collection $query_params Parameters to apply to characters list
     * @return CharacterResourceCollection Formatted character data
     */
    public function charactersByFilm(int $film_episode_id, Collection $query_params){
        $characters_in_film = $this->filmService->getFilmContents($film_episode_id)['characters'];
        $characters_details = collect($characters_in_film)->map(function ($item){
           return $this->characterDetails($item);
        });
        $characters_details = $this->applyQueryParams($characters_details, $query_params)->values();
        return new CharacterResourceCollection($characters_details);

    }

    /** Get details for a particular character
     * @param string $characterUrl Url to get character details from
     * @return array Details for character
     */
    private function characterDetails($characterUrl){
        return $this->getUrl($characterUrl);
    }


    /**  Apply query parameters to characters list
     * @param Collection $characters_list List of characters
     * @param Collection $query_params Parameters to apply
     * @return mixed List of characters with query params applied
     */
    private function applyQueryParams(Collection $characters_list, Collection $query_params)
    {
        if ($query_params->isNotEmpty()) {
            $characters_list = $this->applyFilterParam($characters_list, $query_params['filter']);
            $characters_list = $this->sortAndOrder($characters_list, $query_params);
        };
        return $characters_list;
    }


    /** Filter character list by gender.
     * Returns characters list untouched if gender is null or empty string
     * @param Collection $collection
     * @param string $gender Gender to use.
     * @return Collection|static Characters list with characters that match gender.
     */
    private function applyFilterParam(Collection $collection,string $gender){
        //todo ensure filterparams and is a valid gender is allowed if not throw an error
        if (!empty($gender)){
            $characters_filtered_by_gender = $collection->filter(function ($value) use($gender) {
                return $value['gender'] == $gender;
            });
            return $characters_filtered_by_gender;
        }
        return $collection;
    }

    /** Sort and order character list.
     * @param Collection $query_params, sort and order keys are used to run operation.
     * @param $characters_list
     * @return mixed Sorted and ordered character list
     */
    private function sortAndOrder(Collection $characters_list, $query_params)
    {
        $sort_param = $query_params['sort'];
        if(!empty($sort_param)) {
            return $this->applySort($characters_list, $query_params['order'], $sort_param);
        }
        return $characters_list;

    }

    /**
     * @param Collection $characters_details
     * @param string $order Order to sort by (asc|desc).asc(ascending order) is default
     * @param string $sort_param Field to sort collections by
     * @return Collection characters sorted by sort_param and arranged by order
     */
    private function applySort(Collection $characters_details, $order, $sort_param)
    {
        if ($order == 'desc') {
            return $characters_details->sortByDesc($sort_param);
        } else {
            return $characters_details->sortBy($sort_param);
        }
    }

}