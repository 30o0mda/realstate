<?php

namespace App\Service\CategorySection;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Resources\CategorySection\CategorySectionResource;
use App\Http\Resources\Location\LocationResource;
use App\Models\CategorySection\CategorySection;
use App\Models\Location\Location;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class categorySectionService
{
    public function __construct() {}

    public function createOrUpdateCategorySection($data):DataStatus
    {
        $categorySectionData = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $categorySectionData[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
                'description' => $data['description_' . $locale] ?? null,
            ];
        }
        if ($categorySection = CategorySection::first()) {
            $categorySection->update($categorySectionData);
            return DataSuccess::make(resourceData: new CategorySectionResource($categorySection->fresh()), message: 'category section updated successfully');
        }
        $categorySection = CategorySection::create($categorySectionData);
        return DataSuccess::make(resourceData: new CategorySectionResource($categorySection), message: 'category section created successfully');
    }

    public function fetchCategorySection():DataStatus
    {
        $categorySection = CategorySection::firstOrNew();
        return DataSuccess::make(resourceData: new CategorySectionResource($categorySection), message: 'category section fetched successfully');
    }
}
