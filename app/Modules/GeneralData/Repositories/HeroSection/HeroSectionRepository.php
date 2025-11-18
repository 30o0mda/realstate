<?php

namespace App\Modules\GeneralData\Repositories\HeroSection;
use App\Base\Response\DataStatus;
use App\Modules\GeneralData\Models\HeroSection\HeroSection;
use App\Modules\Organization\Models\organizationEmployee\OrganizationEmployee;
use Illuminate\Support\Facades\Hash;

class HeroSectionRepository
{



    public function create($dto)
    {
        try {
            $data = $dto->toArray();
            $data['image'] = uploadImage($data['image'], 'Hero_Section', 'public');
            $hero_section = HeroSection::create($data);
            return $hero_section;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
