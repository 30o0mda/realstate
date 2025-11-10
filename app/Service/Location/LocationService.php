<?php

namespace App\Service\Location;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Requests\Location\FetchAllLocationRequest;
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
        // return ApiResponseHelper::response(true, 'location created successfully', [
        //     new LocationResource($location)
        // ]);
        return DataSuccess::make(resourceData:new LocationResource($location), message:'location created successfully');
    }

    public function updataLocation($data):DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $is_active = $data['is_active'] ?? false;
        $heroSection = Location::find($data['location_id']);
        $image = $data['image'] ? $data['image']->store('property_type', 'public') : $heroSection->image;
        $heroSection->update($updata_data + [
            'image' => $image,
            'is_active' => $is_active
        ]);
        // return ApiResponseHelper::response(true, 'location updated successfully', [
        //     new LocationResource($heroSection)
        // ]);
        return DataSuccess::make(resourceData:new LocationResource($heroSection), message:'location updated successfully');
    }

    public function fetchLocation($data):DataStatus
    {
        $heroSection = Location::find($data['location_id']);
        // return ApiResponseHelper::response(true, 'location fetched successfully', [
        //     new LocationResource($heroSection)
        // ]);
        return DataSuccess::make(resourceData:new LocationResource($heroSection), message:'location fetched successfully');
    }


    public function fetchAllLocations($data):DataStatus
    {
        $parentId = $data['parent_id'] ?? null;

        $locations = Location::when(
            isset($parentId),
            function ($query) use ($parentId) {
                $query->where('parent_id', $parentId);
            },
            function ($query) {
                $query->whereNull('parent_id');
            }
        )->get();
        $data = LocationResource::collection($locations);
        // return ApiResponseHelper::response(true, 'Locations fetched successfully', [
        //     'locations' => $data
        // ]);
        return DataSuccess::make(resourceData:$data, message:'Locations fetched successfully');
    }

    public function deleteLocation($data):DataStatus
    {
        $heroSection = Location::find($data['location_id']);
        $heroSection->delete();
        // return ApiResponseHelper::response(true, 'location deleted successfully');
        return DataSuccess::make(message:'location deleted successfully');
    }
}
