<?php

namespace App\Http\Resources\Blog;

use App\Http\Resources\BlogCategory\BlogCategoryResource;
use App\Http\Resources\BlogHashtag\BlogHashtagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{

    public function toArray($request)
    {


        $title = $request->header('Accept-Language')  !== "*" ? getTranslation('title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'title');
        $description = $request->header('Accept-Language')  !== "*" ? getTranslation('description', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'description');
        $subtitle = $request->header('Accept-Language')  !== "*" ? getTranslation('subtitle', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'subtitle');
        $meta_title = $request->header('Accept-Language')  !== "*" ? getTranslation('meta_title', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'meta_title');
        $meta_description = $request->header('Accept-Language')  !== "*" ? getTranslation('meta_description', $request->header('Accept-Language'), $this) : getTranslationAndLocale($this?->translations, 'meta_description');
        return [
            'id' => $this->id,
            'title' => $title,
            'description' => $description,
            'subtitle' => $subtitle,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'image' => $this->image ? url('storage/' . $this->image) : null,
            'alt' => $this->alt,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'blog_categories' => BlogCategoryResource::collection($this->blogCategories??[]) ?? null,
            'blog_hashtags' => BlogHashtagResource::collection($this->blogHashtags??[]) ?? null,
        ];
    }
}
