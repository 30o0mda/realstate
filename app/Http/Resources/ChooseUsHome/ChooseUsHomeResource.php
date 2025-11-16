<?php

namespace App\Http\Resources\ChooseUsHome;

use App\Http\Resources\ChooseUsFeature\ChooseUsFeatureResource;
use App\Http\Resources\PropertyType\PropertyTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChooseUsHomeResource extends JsonResource
{

    public function toArray($request)
    {
        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');
        $description = $request->header('Accept-Language')  !== "*" ? getTranslation('description', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'description');
        return [
            'id' => $this->id ?? null,
            'title' => $title ?? null,
            'description' => $description ?? null,
            'image' => $this->image ? url('storage/'.$this->image): null,
            'organization_id' => $this->organization_id ?? null,
            'created_by' => $this->created_by ?? null,
            'features' => $this->features ? ChooseUsFeatureResource::collection($this->features) : [],
        ];
    }
}
