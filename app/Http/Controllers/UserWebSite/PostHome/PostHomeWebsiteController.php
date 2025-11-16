<?php

namespace App\Http\Controllers\UserWebSite\PostHome;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\CategorySection\CreateOrUpdateCategorySectionRequest;
use App\Http\Requests\CategorySection\FetchCategorySectionRequest;
use App\Http\Requests\PostHome\CreateOrUpdatePostHomeRequest;
use App\Models\PostHome\PostHome;
use App\Service\CategorySection\categorySectionService;
use App\Service\PostHome\PostHomeService;
use Illuminate\View\View;

class PostHomeWebsiteController extends Controller
{
    protected $postHomeService;

    public function __construct(PostHomeService $postHomeService)
    {
        $this->postHomeService = $postHomeService;
    }

    public function fetchPostHome()
    {
        return $this->postHomeService->fetchPostHome(ViewTypeEnum::Website->value)->response();
    }


}
