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
           'comment_count'=>$this->getCommentCount($episode_id)
       ];
    }

    private function getCommentCount($episode_id){
        #todo
        return 0;
    }
}
