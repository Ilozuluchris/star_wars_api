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
        return ['cm'=>$total_height_cm,'feet_height'=>$feet_inches];


    }

    private function cm2feet(int $cm)
    {
        $inches = $cm/2.54;
        $feet_with_decimal = $inches/12;
        $feet_int = (int) $feet_with_decimal;
        $inches_remaining = round(($feet_with_decimal - $feet_int)*12, 2); // .25
        return ['feet'=>$feet_int, 'inches'=>$inches_remaining];
    }
}
