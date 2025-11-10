<?php

namespace App\Http\Controllers\Api\Location;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Location\CreateLocationRequest;
use App\Http\Requests\Location\DeleteLocationRequest;
use App\Http\Requests\Location\FetchAllLocationRequest;
use App\Http\Requests\Location\FetchLocationRequest;
use App\Http\Requests\Location\UpdataLocationRequest;
use App\Service\Location\LocationService;

class LocationController extends Controller
{

    protected $LocationService;

    public function __construct(LocationService $LocationService)
    {
        $this->LocationService = $LocationService;
    }
    public function createLocation(CreateLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->createLocation($data)->response();
    }

    public function updataLocation(UpdataLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->updataLocation($data)->response();
    }

    public function fetchLocation(FetchLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->fetchLocation($data)->response();
    }

    public function fetchAllLocations(FetchAllLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->fetchAllLocations($data)->response();
    }

    public function deleteLocation(DeleteLocationRequest $request)
    {
        $data = $request->validated();
        return $this->LocationService->deleteLocation($data)->response();
    }
}
