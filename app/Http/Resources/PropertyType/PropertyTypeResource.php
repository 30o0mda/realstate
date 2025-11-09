<?php

namespace App\Http\Resources\PropertyType;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image ? url('storage/'.$this->image): null,
            'is_active' => boolval($this->is_active)
        ];
    }
}
