<?php

namespace App\Service\PostHome;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Resources\CategorySection\CategorySectionResource;
use App\Http\Resources\Location\LocationResource;
use App\Http\Resources\PostHome\PostHomeResource;
use App\Http\ResourcesWebsite\CategorySection\CategorySectionWebsiteResource;
use App\Http\ResourcesWebsite\PostHome\PostHomeWebsiteResource;
use App\Models\CategorySection\CategorySection;
use App\Models\Location\Location;
use App\Models\PostHome\PostHome;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PostHomeService
{
    public function __construct() {}

public function createOrUpdatePostHome($data, $organization_id = null ,$created_by = null): DataStatus
{
    $postHomeData = [];
    foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
        $postHomeData[$locale] = [
            'title' => $data['title_' . $locale] ?? null,
            'description' => $data['description_' . $locale] ?? null,
        ];
    }
    $postHomeData['organization_id'] = $organization_id;
    $postHomeData['created_by'] = $created_by;
    if ($postHome = PostHome::first()) {
        $image = uploadImage($data['image'], 'Post_Home', 'public');
        $postHomeData['image'] = $image;
        $postHome->update($postHomeData);
        return DataSuccess::make(
            resourceData: new PostHomeResource($postHome->fresh()),
            message: 'post home updated successfully'
        );
    }
    $image = uploadImage($data['image'], 'Post_Home', 'public');
    if ($image) {
        $postHomeData['image'] = $image;
    }
    $postHome = PostHome::create($postHomeData);
    return DataSuccess::make(
        resourceData: new PostHomeResource($postHome),
        message: 'post home created successfully'
    );
}



    public function fetchPostHome($view_type = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $postHome = PostHome::firstOrNew();
        if ($view_type == ViewTypeEnum::Website->value) {
            $response = new PostHomeWebsiteResource($postHome);
        } else {
            $response = new PostHomeResource($postHome);
        }
        return DataSuccess::make(resourceData: $response, message: 'post home fetched successfully');
    }
}
