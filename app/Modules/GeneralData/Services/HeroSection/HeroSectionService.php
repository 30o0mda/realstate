<?php

namespace App\Modules\GeneralData\Services\HeroSection;
use App\Base\Response\DataFailed;
use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Modules\GeneralData\Http\Resources\HeroSection\HeroSectionResource;
use App\Modules\GeneralData\Repositories\HeroSection\HeroSectionRepository;
use App\Modules\Organization\Http\Resources\Auth\LoginOrganizationEmployeeResource;
use App\Modules\Organization\Http\Resources\OrganizationEmployeeResource;
use App\Modules\Organization\Repositories\OrganizationEmployeeRepository;

use function Symfony\Component\String\s;

class HeroSectionService
{






    public function __construct(protected HeroSectionRepository $heroSectionRepository) {}

    public function createHeroSection($dto): DataStatus
    {
        $hero_section = $this->heroSectionRepository->create($dto);
        $resourceData = new HeroSectionResource($hero_section);
        return new DataSuccess(data:$resourceData,status: true, message: 'Organization employee created successfully');
    }


}
