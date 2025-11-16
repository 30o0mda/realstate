<?php

namespace App\Http\Resources\ChooseUsFeature;

use App\Http\Resources\ChooseUsHome\ChooseUsHomeResource;
use App\Http\Resources\PropertyType\PropertyTypeResource;
use App\Models\ChooseUsHome\ChooseUsHome;
use Illuminate\Http\Resources\Json\JsonResource;

class ChooseUsFeatureResource extends JsonResource
{

    public function toArray($request)
    {
        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');
        $description = $request->header('Accept-Language')  !== "*" ? getTranslation('description', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'description');
        return [
            'id' => $this->id ?? null,
            'title' => $title ?? null,
            'description' => $description ?? null,
        ];
    }
}
