<?php

namespace App\Http\Controllers\Api\PostHome;

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

class PostHomeController extends Controller
{
    protected $postHomeService;

    public function __construct(PostHomeService $postHomeService)
    {
        $this->postHomeService = $postHomeService;
    }
    public function createOrUpdatePostHome(CreateOrUpdatePostHomeRequest $request)
    {
        $data = $request->validated();
        return $this->postHomeService->createOrUpdatePostHome($data,getOrganizationId(), auth('employee')->user()->id)->response();
    }

    public function fetchPostHome()
    {
        return $this->postHomeService->fetchPostHome(ViewTypeEnum::Dashboard->value)->response();
    }


}
