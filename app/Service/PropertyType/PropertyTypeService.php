<?php

namespace App\Service\PropertyType;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\PropertyType\PropertyTypeResource;
use App\Models\PropertyType\PropertyType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PropertyTypeService
{
    public function __construct() {}

    public function createPropertyType($data)
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $is_active = $data['is_active'] ?? false;
        // dd($create_data);
        $image = $data['image']->store('property_type', 'public');
        $heroSection = PropertyType::create($create_data + [
            'image' => $image,
            'is_active' => $is_active
        ]);
        return ApiResponseHelper::response(true, 'property type created successfully', [
            new PropertyTypeResource($heroSection)
        ]);
    }

    public function updataPropertyType($data)
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $is_active = $data['is_active'] ?? false;
        $heroSection = PropertyType::find($data['property_type_id']);
        $image = $data['image'] ? $data['image']->store('property_type', 'public') : $heroSection->image;
        $heroSection->update($updata_data + [
            'image' => $image,
            'is_active' => $is_active
        ]);
        return ApiResponseHelper::response(true, 'property type updated successfully', [
            new PropertyTypeResource($heroSection)
        ]);
    }

    public function fetchPropertyType($data)
    {
        $heroSection = PropertyType::find($data['property_type_id']);
        return ApiResponseHelper::response(true, 'property type fetched successfully', [
            new PropertyTypeResource($heroSection)
        ]);
    }

    public function deletePropertyType($data)
    {
        $heroSection = PropertyType::find($data['property_type_id']);
        $heroSection->delete();
        return ApiResponseHelper::response(true, 'property type deleted successfully');
    }
}
