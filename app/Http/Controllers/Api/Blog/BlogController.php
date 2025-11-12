<?php

namespace App\Http\Controllers\Api\Blog;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\DeleteBlogRequest;
use App\Http\Requests\Blog\FetchBlogDetailsRequest;
use App\Http\Requests\Blog\FetchBlogRequest;
use App\Http\Requests\Blog\UpdataBlogRequest;
use App\Models\Organization\Organization;
use App\Service\Blog\BlogService;

class BlogController extends Controller
{

    protected $BlogService;

    public function __construct(BlogService $BlogService)
    {
        $this->BlogService = $BlogService;
    }
    public function createBlog(CreateBlogRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->createBlog($data, getOrganizationId(), auth('employee')->user()->id)->response();
    }

    public function updataBlog(UpdataBlogRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->updataBlog($data)->response();
    }

    public function fetchBlog(FetchBlogRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->fetchBlog($data)->response();
    }

    public function fetchBlogDetails(FetchBlogDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->fetchBlogDetails($data)->response();
    }

    public function deleteBlog(DeleteBlogRequest $request)
    {
        $data = $request->validated();
        return $this->BlogService->deleteBlog($data)->response();
    }

}
