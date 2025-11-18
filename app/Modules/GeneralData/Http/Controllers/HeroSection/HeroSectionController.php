<?php

namespace App\Modules\GeneralData\Http\Controllers\HeroSection;
use App\Http\Controllers\Controller;
use App\Modules\GeneralData\DTOs\HeroSection\HeroSectionDto;
use App\Modules\GeneralData\Http\Requests\HeroSection\CreateHeroSectionRequest;
use App\Modules\GeneralData\Services\HeroSection\HeroSectionService;
class HeroSectionController extends Controller
{

    protected $CourseService;
    public function __construct(protected HeroSectionService $heroSectionService) {}
    public function createHeroSection(CreateHeroSectionRequest $request)
    {
        $dto = new HeroSectionDto(
            title_en: $request->title_en,
            title_ar: $request->title_ar,
            description_en: $request->description_en,
            description_ar: $request->description_ar,
            image: $request->image,
        );
        return $this->heroSectionService->createHeroSection($dto)->response();
    }

}
