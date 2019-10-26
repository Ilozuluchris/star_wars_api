<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'film_episode_id' => $this->film_episode_id,
                'content' => $this->content,
                'commenter_ip' => $this->commenter_ip,
                'created_at' => $this->created_at
        ];
    }
}
