<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CharacterResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'=>$this->collection,
            'meta'=>[
                'total_count'=>$this->collection->count(),
                'total_height'=>$this->totalHeight($this->collection)
            ]
        ];
    }

    private function totalHeight($collection)
    {
        $total_height_cm = $collection->sum('height');
        $feet_inches = $this->cm2feet($total_height_cm);
        return ['cm'=>$total_height_cm,'feet'=>$feet_inches];


    }

    private function cm2feet(int $cm)
    {
        $inches = $cm/2.54;
        $feet = intdiv($inches, 12);
        $inches = $inches%12;
        return ['feet'=>$feet,'inches'=>$inches];

    }
}
