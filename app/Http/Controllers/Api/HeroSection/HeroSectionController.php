<?php

namespace App\Http\Controllers\Api\HeroSection;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroSection\CreateHeroSectionRequest;
use App\Http\Requests\HeroSection\DeleteHeroSectionRequest;
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
        return $this->HeroSectionService->createHeroSection($data)->getData();
    }

    public function updataHeroSection(UpdataHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->updataHeroSection($data)->getData();
    }

    public function fetchHeroSection(FetchHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->fetchHeroSection($data)->getData();
    }

    public function deleteHeroSection(DeleteHeroSectionRequest $request)
    {
        $data = $request->validated();
        return $this->HeroSectionService->deleteHeroSection($data)->getData();
    }

}
