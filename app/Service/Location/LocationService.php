<?php

namespace App\Service\Location;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\Location\LocationResource;
use App\Models\Location\Location;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocationService
{
    public function __construct() {}

    public function createLocation($data)
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $parent_id = $data['parent_id'] ?? null;
        $image = $data['image']->store('location', 'public');
        $code = $data['code'] ?? null;
        $location = Location::create($create_data + [
            'image' => $image,
            'parent_id' => $parent_id,
            'code' => $code
        ]);
        return ApiResponseHelper::response(true, 'location created successfully', [
            new LocationResource($location)
        ]);
    }

    public function updataLocation($data)
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $is_active = $data['is_active'] ?? false;
        $heroSection = Location::find($data['property_type_id']);
        $image = $data['image'] ? $data['image']->store('property_type', 'public') : $heroSection->image;
        $heroSection->update($updata_data + [
            'image' => $image,
            'is_active' => $is_active
        ]);
        return ApiResponseHelper::response(true, 'location updated successfully', [
            new LocationResource($heroSection)
        ]);
    }

    public function fetchLocation($data)
    {
        $heroSection = Location::find($data['property_type_id']);
        return ApiResponseHelper::response(true, 'location fetched successfully', [
            new LocationResource($heroSection)
        ]);
    }

    public function deleteLocation($data)
    {
        $heroSection = Location::find($data['property_type_id']);
        $heroSection->delete();
        return ApiResponseHelper::response(true, 'location deleted successfully');
    }
}
