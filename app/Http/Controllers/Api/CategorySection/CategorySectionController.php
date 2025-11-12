<?php

namespace App\Http\Controllers\Api\CategorySection;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySection\CreateOrUpdateCategorySectionRequest;
use App\Http\Requests\CategorySection\FetchCategorySectionRequest;
use App\Service\CategorySection\categorySectionService;
class CategorySectionController extends Controller
{
    protected $categorySectionService;

    public function __construct(CategorySectionService $categorySectionService)
    {
        $this->categorySectionService = $categorySectionService;
    }
    public function createOrUpdateCategorySection(CreateOrUpdateCategorySectionRequest $request)
    {
        $data = $request->validated();
        $data['organization_id'] = getOrganizationId();
        $data['created_by'] = auth('employee')->user()->id;
        return $this->categorySectionService->createOrUpdateCategorySection($data)->response();
    }

    public function fetchCategorySection( )
    {
        return $this->categorySectionService->fetchCategorySection()->response();
    }


}
