<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Integer;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $episode_id = $this->resource['episode_id'];
        return [
           'title'=>$this->resource['title'],
           'episode_id'=> $episode_id,
           'release_date'=>$this->resource['release_date'],
            'opening_crawl'=>$this->resource['opening_crawl'],
           'comment_count'=>$this->resource['comment_count']
       ];
    }

}
