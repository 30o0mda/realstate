<?php

namespace App\Http\Controllers\Api\PropertyType;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\PropertyType\CreatePropertyTypeRequest;
use App\Http\Requests\PropertyType\DeletePropertyTypeRequest;
use App\Http\Requests\PropertyType\FetchPropertyTypeDetailsRequest;
use App\Http\Requests\PropertyType\FetchPropertyTypeRequest;
use App\Http\Requests\PropertyType\UpdataPropertyTypeRequest;
use App\Service\PropertyType\PropertyTypeService;
use Illuminate\View\View;

class PropertyTypeController extends Controller
{

    protected $PropertyTypeService;

    public function __construct(PropertyTypeService $PropertyTypeService)
    {
        $this->PropertyTypeService = $PropertyTypeService;
    }
    public function createPropertyType(CreatePropertyTypeRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->createPropertyType($data, getOrganizationId(), auth('employee')->user()->id)->response();
    }

    public function updataPropertyType(UpdataPropertyTypeRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->updataPropertyType($data)->response();
    }

    public function fetchPropertyType(FetchPropertyTypeRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->fetchPropertyType($data, getOrganizationId(),ViewTypeEnum::Dashboard->value)->response();
    }

    public function fetchPropertyTypeDetails(FetchPropertyTypeDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->fetchPropertyTypeDetails($data, getOrganizationId(),ViewTypeEnum::Dashboard->value)->response();
    }

    public function deletePropertyType(DeletePropertyTypeRequest $request)
    {
        $data = $request->validated();
        return $this->PropertyTypeService->deletePropertyType($data)->response();
    }

}
