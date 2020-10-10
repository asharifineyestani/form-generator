<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionCollection extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTitle(),
            'price' => $this->price,
            'alt' => $this->getTitle(),
            'src' => $this->media_path,
        ];
    }

    public function getTitle()
    {
        $str = $this->title;
        $str .= ' (';
        $str .=  $this->price;
        $str .=  ')';

        return $str;
    }
}
