<?php

namespace App\Http\Controllers\UserWebSite\Location;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\Location\CreateLocationRequest;
use App\Http\Requests\Location\DeleteLocationRequest;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Requests\Location\FetchLocationDetailsRequest;
use App\Http\Requests\Location\FetchLocationRequest;
use App\Http\Requests\Location\UpdataLocationRequest;
use App\Service\Location\LocationService;

class LocationWebsiteController extends Controller
{

    protected $LocationService;

    public function __construct(LocationService $LocationService)
    {
        $this->LocationService = $LocationService;
    }




    public function fetchLocation(FetchLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->fetchLocation($data, getOrganizationId(), ViewTypeEnum::Website->value)->response();
    }

    public function fetchLocationDetails(FetchLocationDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->fetchLocationDetails($data, getOrganizationId(), ViewTypeEnum::Website->value)->response();
    }

    public function fetchAllLocations(FetchAllLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->fetchAllLocations($data, getOrganizationId(), ViewTypeEnum::Website->value)->response();
    }

}
