<?php

namespace App\Http\Resources\PropertyType;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyTypeResource extends JsonResource
{

    public function toArray($request)
    {
        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');

        return [
            'id' => $this->id,
            'title' => $title,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'is_active' => boolval($this->is_active)
        ];
    }
}
