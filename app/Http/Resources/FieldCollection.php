<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldCollection extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type->title,
            'price' => $this->pivot->price,
            'col' => $this->pivot->col,
            'options' => OptionCollection::collection($this->whenLoaded('options')),
        ];


    }
}
