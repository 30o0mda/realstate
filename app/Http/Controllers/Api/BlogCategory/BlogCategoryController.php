<?php

namespace App\Http\Controllers\Api\BlogCategory;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\BlogCategory\CreateBlogCategoryRequest;
use App\Http\Requests\BlogCategory\DeleteBlogCategoryRequest;
use App\Http\Requests\BlogCategory\FetchBlogCategoryDetailsRequest;
use App\Http\Requests\BlogCategory\FetchBlogCategoryRequest;
use App\Http\Requests\BlogCategory\UpdataBlogCategoryRequest;
use App\Http\Requests\HeroSection\CreateHeroSectionRequest;
use App\Http\Requests\HeroSection\DeleteHeroSectionRequest;
use App\Http\Requests\HeroSection\FetchHeroSectionRequest;
use App\Http\Requests\HeroSection\UpdataHeroSectionRequest;
use App\Service\BlogCategory\BlogCategoryService;

class BlogCategoryController extends Controller
{

    protected $BlogCategoryService;

    public function __construct(BlogCategoryService $BlogCategoryService)
    {
        $this->BlogCategoryService = $BlogCategoryService;
    }
    public function createBlogCategory(CreateBlogCategoryRequest $request)
    {
        $data = $request->validated();
        return $this->BlogCategoryService->createBlogCategory(data: $data, organization_id: getOrganizationId(), created_by: auth('employee')->user()->id)->response();
    }

    public function updataBlogCategory(UpdataBlogCategoryRequest $request)
    {
        $data = $request->validated();
        return $this->BlogCategoryService->updataBlogCategory($data)->response();
    }

    public function fetchBlogCategory(FetchBlogCategoryRequest $request)
    {
        $data = $request->validated();
        return $this->BlogCategoryService->fetchBlogCategory($data, getOrganizationId(), ViewTypeEnum::Dashboard->value)->response();
    }

    public function fetchBlogCategoryDetails(FetchBlogCategoryDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->BlogCategoryService->fetchBlogCategoryDetails($data, getOrganizationId(), ViewTypeEnum::Dashboard->value)->response();
    }

    public function deleteBlogCategory(DeleteBlogCategoryRequest $request)
    {
        $data = $request->validated();
        return $this->BlogCategoryService->deleteBlogCategory($data)->response();
    }

}
