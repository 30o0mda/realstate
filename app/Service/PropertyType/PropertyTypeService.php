<?php

namespace App\Service\PropertyType;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\PropertyType\PropertyTypeResource;
use App\Models\PropertyType\PropertyType;
use Dflydev\DotAccessData\Data;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PropertyTypeService
{
    public function __construct() {}

    public function createPropertyType($data, $organization_id, $created_by): DataStatus
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        // dd($create_data);
        $image = uploadImage($data['image'], 'property_type', 'public');
        $propertyType = PropertyType::create($create_data + [
            'image' => $image,
            'organization_id' => $organization_id,
            'created_by' => $created_by,
        ]);
        return DataSuccess::make(resourceData: new PropertyTypeResource($propertyType), message: 'property type created successfully');
    }
    public function updataPropertyType($data): DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $propertyType = PropertyType::find($data['property_type_id']);
        $is_active = $data['is_active'] ?? $propertyType->is_active;
        $image = isset($data['image']) ? uploadImage($data['image'], 'property_type', 'public') : $propertyType->image;
        $propertyType->update($updata_data + [
            'image' => $image,
            'is_active' => $is_active
        ]);
        return DataSuccess::make(resourceData: new PropertyTypeResource($propertyType), message: 'property type updated successfully');
    }

    public function fetchPropertyType($data): DataStatus
    {
        $query = PropertyType::query();
        $query->where('organization_id', getOrganizationId());
        if (isset($data['word'])) {
            $query->whereTranslationLike('title',  '%' . $data['word'] . '%');
        }
        $query->latest();
        if (isset($data['with_pagination']) && $data['with_pagination'] == 1) {
            $per_page = $data['per_page'] ?? 10;
            $all_hero_sections = $query->paginate($per_page);
            $response = PropertyTypeResource::collection($all_hero_sections)->response()->getData(true);
        } else {
            $all_hero_sections = $query->get();
            $response = PropertyTypeResource::collection($all_hero_sections)->response()->getData(true);
        }
        return DataSuccess::make(data: $response, message: 'Hero sections fetched successfully');
    }


    public function fetchPropertyTypeDetails($data): DataStatus
    {
        $propertyType = PropertyType::find($data['property_type_id']);
        return DataSuccess::make(resourceData: new PropertyTypeResource($propertyType), message: 'property type fetched successfully');
    }

    public function deletePropertyType($data): DataStatus
    {
        $propertyType = PropertyType::find($data['property_type_id']);
        $propertyType->delete();
        return DataSuccess::make(message: 'property type deleted successfully');
    }
}
