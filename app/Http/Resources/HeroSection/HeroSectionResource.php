<?php

namespace App\Http\Resources\HeroSection;

use Illuminate\Http\Resources\Json\JsonResource;

class HeroSectionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? url('storage/'.$this->image): null,
        ];
    }
}
