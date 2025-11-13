<?php

namespace App\Service\Blog;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Http\Enum\viewTypeEnum;
use App\Http\Resources\Blog\BlogResource;
use App\Http\ResourcesWebsite\Blog\BlogWebsiteResource;
use App\Models\Blog\Blog;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogService
{
    public function __construct() {}

    public function createBlog($data, $organization_id = null, $created_by = null): DataStatus
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
                'description' => $data['description_' . $locale] ?? null,
                'subtitle' => $data['subtitle_' . $locale] ?? null,
                'meta_title' => $data['meta_title_' . $locale] ?? null,
                'meta_description' => $data['meta_description_' . $locale] ?? null,
            ];
        }
        $image = uploadImage($data['image'], 'blog', 'public');
        $blog = Blog::create($create_data + [
            'image' => $image,
            'alt' => $data['alt'] ?? null,
            'slug' => $data['slug'] ?? null,
            'is_active' => $data['is_active'] ?? true,
            'organization_id' => $organization_id,
            'created_by' => $created_by,
        ]);
        if (!empty($data['blog_category_ids'])) {
            $blog->blogCategories()->sync($data['blog_category_ids']);
        }
        if (!empty($data['blog_hashtag_ids'])) {
            $blog->blogHashtags()->sync($data['blog_hashtag_ids']);
        }
        return DataSuccess::make(resourceData: new BlogResource($blog), message: 'Blog created successfully');
    }

    public function updataBlog($data): DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
                'description' => $data['description_' . $locale] ?? null,
                'subtitle' => $data['subtitle_' . $locale] ?? null,
                'meta_title' => $data['meta_title_' . $locale] ?? null,
                'meta_description' => $data['meta_description_' . $locale] ?? null,
            ];
        }
        $blog = Blog::find($data['blog_id']);
        $image = isset($data['image']) ? uploadImage($data['image'], 'blog', 'public') : $blog->image;
        $blog->update($updata_data + [
            'image' => $image,
            'alt' => $data['alt'] ?? $blog->alt,
            'slug' => $data['slug'] ?? $blog->slug,
            'is_active' => $data['is_active'] ?? $blog->is_active,
        ]);
        if (!empty($data['blog_category_ids'])) {
            $blog->blogCategories()->sync($data['blog_category_ids']);
        }
        if (!empty($data['blog_hashtag_ids'])) {
            $blog->blogHashtags()->sync($data['blog_hashtag_ids']);
        }
        return DataSuccess::make(resourceData: new BlogResource($blog), message: 'Blog updated successfully');
    }

public function fetchBlog($data, $viewType = ViewTypeEnum::Dashboard->value): DataStatus
{
    $query = Blog::query();
    if (isset($data['word'])) {
        $query->whereTranslationLike('title', '%' . $data['word'] . '%');
    }
    $query->latest();
    $query->where('organization_id', getOrganizationId());
    if (isset($data['with_pagination']) && $data['with_pagination'] == 1) {
        $per_page = $data['per_page'] ?? 10;
        $all_blog = $query->paginate($per_page);
        if ($viewType == viewTypeEnum::Website->value) {
            $response = BlogWebsiteResource::collection($all_blog)->response()->getData(true);
        } else {
            $response = BlogResource::collection($all_blog)->response()->getData(true);
        }
    } else {
        $all_blog = $query->get();
        if ($viewType == ViewTypeEnum::Website->value) {
            $response = BlogWebsiteResource::collection($all_blog);
        } else {
            $response = BlogResource::collection($all_blog);
        }
    }

    return DataSuccess::make(resourceData: $response, message: 'Blog fetched successfully');
}


    public function fetchBlogDetails($data,  $viewType=ViewTypeEnum::Dashboard->value): DataStatus
    {
        $blog = Blog::find($data['blog_id']);
        if ($viewType == ViewTypeEnum::Website->value) {
            $response = new BlogWebsiteResource($blog);
        } else {
            $response = new BlogResource($blog);
        }
        return DataSuccess::make(resourceData: $response, message: 'Blog details fetched successfully');
    }
    public function deleteBlog($data): DataStatus
    {
        $blog = Blog::find($data['blog_id']);
        $blog->delete();
        return DataSuccess::make(message: 'Blog  deleted successfully');
    }
}
