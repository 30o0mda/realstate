<?php

namespace App\Http\Controllers\UserWebSite\Blog;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\DeleteBlogRequest;
use App\Http\Requests\Blog\FetchBlogDetailsRequest;
use App\Http\Requests\Blog\FetchBlogRequest;
use App\Http\Requests\Blog\UpdataBlogRequest;
use App\Models\Organization\Organization;
use App\Service\Blog\BlogService;

class BlogWebsiteController extends Controller
{

    protected $BlogService;

    public function __construct(BlogService $BlogService)
    {
        $this->BlogService = $BlogService;
    }




    public function fetchBlog(FetchBlogRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->fetchBlog($data, getOrganizationId(), ViewTypeEnum::Website->value)->response();
    }

    public function fetchBlogDetails(FetchBlogDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->fetchBlogDetails($data,  ViewTypeEnum::Website->value)->response();
    }
}
