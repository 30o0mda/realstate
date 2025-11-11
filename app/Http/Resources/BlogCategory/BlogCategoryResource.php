<?php

namespace App\Http\Resources\BlogCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogCategoryResource extends JsonResource
{

    public function toArray($request)
    {

        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');
        return [
            'id' => $this->id,
            'title' => $title,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'alt' => $this->alt,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
        ];
    }
}
