<?php

namespace App\Http\ResourcesWebsite\Location;

use App\Http\Resources\Location\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationWebsiteResource extends JsonResource
{

    public function toArray($request)
    {

        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');

        return [
            'id' => $this->id,
            'title' => $title,
            'image' => $this->image ? url('storage/'.$this->image): null,
            'parent_id' => boolval($this->parent_id),
            'code' => $this->code,
            'children' => isset($request->parent_id) ? LocationResource::collection($this->children) : []
        ];
    }
}
