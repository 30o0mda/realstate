<?php

namespace App\Service\BlogCategory;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Resources\BlogCategory\BlogCategoryResource;
use App\Http\Resources\HeroSection\HeroSectionResource;
use App\Http\ResourcesWebsite\BlogCategory\BlogCategoryWebsiteResource;
use App\Models\BlogCategory\BlogCategory;
use App\Models\HeroSection\HeroSection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogCategoryService
{
     public function __construct()
    {
    }

        public function createBlogCategory( $data , $organization_id=null, $created_by=null):DataStatus
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' .$locale]?? null,
            ];
        }
        $image = uploadImage($data['image'], 'blog_category', 'public');
        $blogCategory = BlogCategory::create($create_data + [
            'image' => $image,
            'alt' => $data['alt'] ?? null,
            'slug' => $data['slug']?? null,
            'is_active' => $data['is_active'] ?? true,
            'organization_id' => $organization_id,
            'created_by' => $created_by,
        ]);
        return DataSuccess::make(resourceData:new BlogCategoryResource($blogCategory), message:'Blog category created successfully');
    }

    public function updataBlogCategory($data):DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' .$locale]?? null,
            ];
        }
        $blogCategory = BlogCategory::find($data['blog_category_id']);
        $image = isset($data['image']) ? uploadImage($data['image'], 'blog_category', 'public') : $blogCategory->image;
        $blogCategory->update($updata_data + [
            'image' => $image,
            'alt' => $data['alt'] ?? $blogCategory->alt,
            'slug' => $data['slug']?? $blogCategory->slug,
            'is_active' => $data['is_active'] ?? $blogCategory->is_active,
        ]);
        return DataSuccess::make(resourceData:new BlogCategoryResource($blogCategory), message:'Blog category updated successfully');
    }

    public function fetchBlogCategory($data, $organization_id, $view_type=ViewTypeEnum::Dashboard->value):DataStatus
    {
        $query = BlogCategory::query();
        if (isset($data['word'])) {
            $query->whereTranslationLike('title',  '%' . $data['word'] . '%');
        }
        $query->latest();
        if (isset($data['with_pagination']) && $data['with_pagination'] == 1) {
            $per_page = $data['per_page'] ?? 10;
            $all_blog_category = $query->paginate($per_page);
            if ($view_type == ViewTypeEnum::Website->value) {
                $response = BlogCategoryWebsiteResource::collection($all_blog_category)->response()->getData(true);
            } else {
                $response = BlogCategoryResource::collection($all_blog_category)->response()->getData(true);
            }
        } else {
            $all_blog_category = $query->get();
            if ($view_type == ViewTypeEnum::Website->value) {
                $response = BlogCategoryWebsiteResource::collection($all_blog_category);
            }else {
                $response = BlogCategoryResource::collection($all_blog_category);
            }
        }
        return DataSuccess::make(resourceData:$response, message:'Blog category fetched successfully');
    }

    public function fetchBlogCategoryDetails($data, $organization_id, $view_type=ViewTypeEnum::Dashboard->value):DataStatus
    {
        $blogCategory = BlogCategory::find($data['blog_category_id']);
        if ($view_type == ViewTypeEnum::Website->value) {
            $response = new BlogCategoryWebsiteResource($blogCategory);
        } else {
            $response = new BlogCategoryResource($blogCategory);
        }
        return DataSuccess::make(resourceData:$response, message:'Blog category details fetched successfully');
    }
    public function deleteBlogCategory($data):DataStatus
    {
        $blogCategory = BlogCategory::find($data['blog_category_id']);
        $blogCategory->delete();
        return DataSuccess::make(message:'Blog category deleted successfully');
    }




}
