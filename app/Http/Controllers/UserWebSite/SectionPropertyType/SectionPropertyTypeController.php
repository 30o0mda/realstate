<?php

namespace App\Http\Controllers\UserWebSite\SectionPropertyType;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionPropertyType\AttachPropertyTypeToSectionRequest;
use App\Service\SectionPropertyType\SectionPropertyTypeService;
class SectionPropertyTypeController extends Controller
{
    protected $sectionPropertyTypeService;

    public function __construct(SectionPropertyTypeService $sectionPropertyTypeService)
    {
        $this->sectionPropertyTypeService = $sectionPropertyTypeService;
    }
    public function attachCategorySectionPropertyType(AttachPropertyTypeToSectionRequest $request)
    {
        $data = $request->validated();
        return $this->sectionPropertyTypeService->attachCategorySectionPropertyType($data)->response();
    }


}
