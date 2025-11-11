<?php

namespace App\Http\Controllers\Api\HeroSection;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroSection\CreateHeroSectionRequest;
use App\Http\Requests\HeroSection\DeleteHeroSectionRequest;
use App\Http\Requests\HeroSection\FetchHeroSectionDetailsRequest;
use App\Http\Requests\HeroSection\FetchHeroSectionRequest;
use App\Http\Requests\HeroSection\UpdataHeroSectionRequest;
use App\Service\HeroSection\HeroSectionService;

class HeroSectionController extends Controller
{

    protected $HeroSectionService;

    public function __construct(HeroSectionService $HeroSectionService)
    {
        $this->HeroSectionService = $HeroSectionService;
    }
    public function createHeroSection(CreateHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->createHeroSection($data)->response();
    }

    public function updataHeroSection(UpdataHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->updataHeroSection($data)->response();
    }

    public function fetchHeroSections(FetchHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->fetchHeroSections($data)->response();
    }

    public function fetchHeroSectionDetails(FetchHeroSectionDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->fetchHeroSectionDetails($data)->response();
    }

    public function deleteHeroSection(DeleteHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->deleteHeroSection($data)->response();
    }

}
