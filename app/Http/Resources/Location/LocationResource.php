<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'is_active' => boolval($this->is_active),
            'organization_id' => $this->organization_id,
            'created_by' => $this->created_by,
            'children' => isset($request->parent_id) ? LocationResource::collection($this->children) : []
        ];
    }
}
