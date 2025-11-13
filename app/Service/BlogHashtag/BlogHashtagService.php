<?php

namespace App\Service\BlogHashtag;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Resources\BlogHashtag\BlogHashtagResource;
use App\Http\Resources\HeroSection\HeroSectionResource;
use App\Http\ResourcesWebsite\BlogHashtag\BlogHashtagWebsiteResource;
use App\Models\BlogHashtag\BlogHashtag;
use App\Models\HeroSection\HeroSection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogHashtagService
{
     public function __construct()
    {
    }

        public function createBlogHashtag( $data,$organization_id=null,$created_by=null):DataStatus
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' .$locale]?? null,
            ];
        }
        $image = uploadImage($data['image'], 'blog_Hashtag','public');
        $blogHashtag = BlogHashtag::create($create_data + [
            'image' => $image,
            'alt' => $data['alt'] ?? null,
            'slug' => $data['slug']?? null,
            'is_active' => $data['is_active'] ?? true,
            'organization_id' => $organization_id,
            'created_by' => $created_by,
        ]);
        return DataSuccess::make(resourceData:new BlogHashtagResource($blogHashtag), message:'Blog hashtag created successfully');
    }

    public function updataBlogHashtag($data):DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' .$locale]?? null,
            ];
        }
        $blogHashtag = BlogHashtag::find($data['blog_hashtag_id']);
        $image = isset($data['image']) ? uploadImage($data['image'], 'blog_hashtag','public') : $blogHashtag->image;
        $blogHashtag->update($updata_data + [
            'image' => $image,
            'alt' => $data['alt'] ?? $blogHashtag->alt,
            'slug' => $data['slug']?? $blogHashtag->slug,
            'is_active' => $data['is_active'] ?? $blogHashtag->is_active,
        ]);
        return DataSuccess::make(resourceData:new BlogHashtagResource($blogHashtag), message:'Blog hashtag updated successfully');
    }

    public function fetchBlogHashtag($data,$organization_id=null,$view_type=ViewTypeEnum::Dashboard->value):DataStatus
    {
        $query = BlogHashtag::query();
        $query->where('organization_id', getOrganizationId());
        if (isset($data['word'])) {
            $query->whereTranslationLike('title',  '%' . $data['word'] . '%');
        }
        $query->latest();
        if (isset($data['with_pagination']) && $data['with_pagination'] == 1) {
            $per_page = $data['per_page'] ?? 10;
            $all_blog_hashtag = $query->paginate($per_page);
            if ($view_type == ViewTypeEnum::Website->value) {
                $response = BlogHashtagWebsiteResource::collection($all_blog_hashtag);
            } else {
                $response = BlogHashtagResource::collection($all_blog_hashtag);
            }
        } else {
            $all_blog_hashtag = $query->get();
            if ($view_type == ViewTypeEnum::Website->value) {
                $response = BlogHashtagWebsiteResource::collection($all_blog_hashtag);
            }else {
                $response = BlogHashtagResource::collection($all_blog_hashtag);
            }
        }
        return DataSuccess::make(resourceData:$response, message:'Blog hashtag fetched successfully');
    }

    public function fetchBlogHashtagDetails($data,$organization_id=null,$view_type=ViewTypeEnum::Dashboard->value):DataStatus
    {
        $blogHashtag = BlogHashtag::find($data['blog_hashtag_id']);
        if ($view_type == ViewTypeEnum::Website->value) {
            $response = new BlogHashtagWebsiteResource($blogHashtag);
        } else {
            $response = new BlogHashtagResource($blogHashtag);
        }
        return DataSuccess::make(resourceData:$response, message:'Blog hashtag details fetched successfully');
    }

    public function deleteBlogHashtag($data):DataStatus
    {
        $blogHashtag = BlogHashtag::find($data['blog_hashtag_id']);
        $blogHashtag->delete();
        return DataSuccess::make(message:'Blog hashtag deleted successfully');
    }
}
