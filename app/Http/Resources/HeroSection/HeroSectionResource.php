<?php

namespace App\Http\Resources\HeroSection;

use Illuminate\Http\Resources\Json\JsonResource;

class HeroSectionResource extends JsonResource
{

    public function toArray($request)
    {

        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');
        $description = $request->header('Accept-Language')  !== "*" ? getTranslation('description', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'description');
        return [
            'id' => $this->id,
            'title' => $title,
            'description' => $description,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'organization_id' => $this->organization_id,
            'created_by' => $this->created_by,
        ];
    }
}
