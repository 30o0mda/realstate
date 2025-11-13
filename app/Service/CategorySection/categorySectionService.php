<?php

namespace App\Service\CategorySection;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Resources\CategorySection\CategorySectionResource;
use App\Http\Resources\Location\LocationResource;
use App\Http\ResourcesWebsite\CategorySection\CategorySectionWebsiteResource;
use App\Models\CategorySection\CategorySection;
use App\Models\Location\Location;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class categorySectionService
{
    public function __construct() {}

public function createOrUpdateCategorySection($data): DataStatus
{
    $categorySectionData = [];

    foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
        $categorySectionData[$locale] = [
            'title' => $data['title_' . $locale] ?? null,
            'description' => $data['description_' . $locale] ?? null,
        ];
    }
    $propertyTypeIds = $data['property_type_ids'] ?? [];
    $categorySectionData += [
        'organization_id' => $data['organization_id'],
        'created_by' => $data['created_by'],
    ];
    if ($categorySection = CategorySection::first()) {
        $categorySection->update($categorySectionData);
        $categorySection->propertyTypes()->sync($propertyTypeIds);
        return DataSuccess::make(
            resourceData: new CategorySectionResource($categorySection->fresh()),
            message: 'category section updated successfully'
        );
    }
    $categorySection = CategorySection::create($categorySectionData);
    if (!empty($propertyTypeIds)) {
        $categorySection->propertyTypes()->sync($propertyTypeIds);
    }
    return DataSuccess::make(
        resourceData: new CategorySectionResource($categorySection),
        message: 'category section created successfully'
    );
}


    public function fetchCategorySection($view_type = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $categorySection = CategorySection::firstOrNew();
        if ($view_type == ViewTypeEnum::Website->value) {
            $response = new CategorySectionWebsiteResource($categorySection);
        } else {
            $response = new CategorySectionResource($categorySection);
        }
        return DataSuccess::make(resourceData: $response, message: 'category section fetched successfully');
    }
}
