<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image ? url('storage/'.$this->image): null,
            'parent_id' => boolval($this->parent_id),
            'code' => $this->code
        ];
    }
}
