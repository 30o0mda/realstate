<?php

namespace App\Service\Location;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Resources\Location\LocationResource;
use App\Http\ResourcesWebsite\Location\LocationWebsiteResource;
use App\Models\Location\Location;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocationService
{
    public function __construct() {}

    public function createLocation($data,$organization_id=null, $created_by=null): DataStatus
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $parent_id = $data['parent_id'] ?? null;
        $image = uploadImage($data['image'], 'location', 'public');
        $code = $data['code'] ?? null;
        $location = Location::create($create_data + [
            'image' => $image,
            'parent_id' => $parent_id,
            'code' => $code,
            'organization_id' => $organization_id,
            'created_by' => $created_by,
        ]);
        // return ApiResponseHelper::response(true, 'location created successfully', [
        //     new LocationResource($location)
        // ]);
        return DataSuccess::make(resourceData: new LocationResource($location), message: 'location created successfully');
    }

    public function updataLocation($data): DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
            ];
        }
        $location = Location::find($data['location_id']);
        $is_active = $data['is_active'] ?? $location->is_active;
        $image = isset($data['image']) ? uploadImage($data['image'], 'location', 'public') : $location->image;
        $location->update($updata_data + [
            'image' => $image,
            'is_active' => $is_active
        ]);
        // return ApiResponseHelper::response(true, 'location updated successfully', [
        //     new LocationResource($location)
        // ]);
        return DataSuccess::make(resourceData: new LocationResource($location), message: 'location updated successfully');
    }

    public function fetchLocation($data, $viewType = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $query = Location::query();
        $query->where('organization_id', getOrganizationId());
        if (isset($data['word'])) {
            $query->whereTranslationLike('title',  '%' . $data['word'] . '%');
        }
        $query->latest();
        $query->where('organization_id', getOrganizationId());
        if (isset($data['with_pagination']) && $data['with_pagination'] == 1) {
            $per_page = $data['per_page'] ?? 10;
            $all_location = $query->paginate($per_page);
            if ($viewType == ViewTypeEnum::Website->value) {
                $response = LocationWebsiteResource::collection($all_location)->response()->getData(true);
            } else {
                $response = LocationResource::collection($all_location)->response()->getData(true);
            }
        } else {
            $all_location = $query->get();
            if ($viewType == ViewTypeEnum::Website->value) {
                $response = LocationWebsiteResource::collection($all_location);
            } else {
                $response = LocationResource::collection($all_location);
            }
        }

        return DataSuccess::make(data:$all_location, resourceData: $response, message: 'Hero sections fetched successfully');
    }


    public function fetchLocationDetails($data, $viewType = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $location = Location::find($data['location_id']);
        if ($viewType == ViewTypeEnum::Website->value) {
            $resourceData = new LocationWebsiteResource($location);
        } else {
            $resourceData = new LocationResource($location);
        }
        return DataSuccess::make(resourceData: $resourceData, message: 'Location details fetched successfully');
    }


    public function fetchAllLocations($data, $viewType = ViewTypeEnum::Dashboard->value): DataStatus
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
        if ($viewType == ViewTypeEnum::Website->value) {
            $data = LocationWebsiteResource::collection($locations);
        }else {
            $data = LocationResource::collection($locations);
        }
        return DataSuccess::make(resourceData: $data, message: 'Locations fetched successfully');
    }

    public function deleteLocation($data): DataStatus
    {
        $location = Location::find($data['location_id']);
        $location->delete();
        // return ApiResponseHelper::response(true, 'location deleted successfully');
        return DataSuccess::make(message: 'location deleted successfully');
    }
}
