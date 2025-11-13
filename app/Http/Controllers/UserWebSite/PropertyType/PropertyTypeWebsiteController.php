<?php

namespace App\Http\Controllers\UserWebSite\PropertyType;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\PropertyType\CreatePropertyTypeRequest;
use App\Http\Requests\PropertyType\DeletePropertyTypeRequest;
use App\Http\Requests\PropertyType\FetchPropertyTypeDetailsRequest;
use App\Http\Requests\PropertyType\FetchPropertyTypeRequest;
use App\Http\Requests\PropertyType\UpdataPropertyTypeRequest;
use App\Service\PropertyType\PropertyTypeService;

class PropertyTypeWebsiteController extends Controller
{

    protected $PropertyTypeService;

    public function __construct(PropertyTypeService $PropertyTypeService)
    {
        $this->PropertyTypeService = $PropertyTypeService;
    }


    public function fetchPropertyType(FetchPropertyTypeRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->fetchPropertyType($data, getOrganizationId(),ViewTypeEnum::Website->value)->response();
    }

    public function fetchPropertyTypeDetails(FetchPropertyTypeDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->fetchPropertyTypeDetails($data, getOrganizationId(),ViewTypeEnum::Website->value)->response();
    }


}
