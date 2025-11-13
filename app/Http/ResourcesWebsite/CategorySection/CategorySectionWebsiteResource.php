<?php

namespace App\Http\ResourcesWebsite\CategorySection;

use App\Http\Resources\PropertyType\PropertyTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorySectionWebsiteResource extends JsonResource
{

    public function toArray($request)
    {
        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');
        $description = $request->header('Accept-Language')  !== "*" ? getTranslation('description', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'description');
        return [
            'id' => $this->id ?? null,
            'title' => $title ?? null,
            'description' => $description ?? null,
            'property_types' => $this->propertyTypes ? PropertyTypeResource::collection($this->propertyTypes) : []?? null,

        ];
    }
}
