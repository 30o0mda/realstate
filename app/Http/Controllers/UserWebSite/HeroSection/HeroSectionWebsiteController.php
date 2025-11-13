<?php

namespace App\Http\Controllers\UserWebSite\HeroSection;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Requests\HeroSection\CreateHeroSectionRequest;
use App\Http\Requests\HeroSection\DeleteHeroSectionRequest;
use App\Http\Requests\HeroSection\FetchHeroSectionDetailsRequest;
use App\Http\Requests\HeroSection\FetchHeroSectionRequest;
use App\Http\Requests\HeroSection\UpdataHeroSectionRequest;
use App\Service\HeroSection\HeroSectionService;

class HeroSectionWebsiteController extends Controller
{

    protected $HeroSectionService;

    public function __construct(HeroSectionService $HeroSectionService)
    {
        $this->HeroSectionService = $HeroSectionService;
    }




    public function fetchHeroSection(FetchHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->fetchHeroSection($data, getOrganizationId(),ViewTypeEnum::Website->value)->response();
    }

    public function fetchHeroSectionDetails(FetchHeroSectionDetailsRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->fetchHeroSectionDetails($data, getOrganizationId(), ViewTypeEnum::Website->value)->response();
    }
}
