<?php

namespace App\Http\Controllers\Api\BlogHashtag;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogHashtag\CreateBlogHashtagRequest;
use App\Http\Requests\BlogHashtag\DeleteBlogHashtagRequest;
use App\Http\Requests\BlogHashtag\FetchBlogHashtagDetailsRequest;
use App\Http\Requests\BlogHashtag\UpdataBlogHashtagRequest;
use App\Http\Requests\BlogHashtag\FetchBlogHashtagRequest;
use App\Service\BlogHashtag\BlogHashtagService;

class BlogHashtagController extends Controller
{

    protected $BlogHashtagService;

    public function __construct(BlogHashtagService $BlogHashtagService)
    {
        $this->BlogHashtagService = $BlogHashtagService;
    }
    public function createBlogHashtag(CreateBlogHashtagRequest $request)
    {
        $data = $request->validated();
        return $this->BlogHashtagService->createBlogHashtag($data)->response();
    }

    public function updataBlogHashtag(UpdataBlogHashtagRequest $request)
    {
        $data = $request->validated();
        return $this->BlogHashtagService->updataBlogHashtag($data)->response();
    }

    public function fetchBlogHashtag(FetchBlogHashtagRequest $request)
    {
        $data = $request->validated();
        return $this->BlogHashtagService->fetchBlogHashtag($data)->response();
    }

    public function fetchBlogHashtagDetails(FetchBlogHashtagDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->BlogHashtagService->fetchBlogHashtagDetails($data)->response();
    }

    public function deleteBlogHashtag(DeleteBlogHashtagRequest $request)
    {
        $data = $request->validated();
        return $this->BlogHashtagService->deleteBlogHashtag($data)->response();
    }

}
