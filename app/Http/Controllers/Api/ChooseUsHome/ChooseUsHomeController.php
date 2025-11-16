<?php

namespace App\Http\Controllers\Api\ChooseUsHome;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\CategorySection\CreateOrUpdateCategorySectionRequest;
use App\Http\Requests\CategorySection\FetchCategorySectionRequest;
use App\Http\Requests\ChooseUsHome\CreateOrUpdateChooseUsHomeRequest;
use App\Http\Requests\PostHome\CreateOrUpdatePostHomeRequest;
use App\Models\PostHome\PostHome;
use App\Service\CategorySection\categorySectionService;
use App\Service\ChooseUsHome\ChooseUsHomeService;
use App\Service\PostHome\PostHomeService;
use Illuminate\View\View;

class ChooseUsHomeController extends Controller
{
    protected $chooseUsHomeService;

    public function __construct(ChooseUsHomeService $chooseUsHomeService)
    {
        $this->chooseUsHomeService = $chooseUsHomeService;
    }
    public function createOrUpdateChooseUsHome(CreateOrUpdateChooseUsHomeRequest $request)
    {
        $data = $request->validated();
        return $this->chooseUsHomeService->createOrUpdateChooseUsHome($data,getOrganizationId(), auth('employee')->user()->id)->response();
    }

    public function fetchChooseUsHome()
    {
        return $this->chooseUsHomeService->fetchChooseUsHome(ViewTypeEnum::Dashboard->value)->response();
    }


}
