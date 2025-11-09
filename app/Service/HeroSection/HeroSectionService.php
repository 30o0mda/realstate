<?php

namespace App\Service\HeroSection;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\HeroSection\HeroSectionResource;
use App\Models\HeroSection\HeroSection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HeroSectionService
{
     public function __construct()
    {
    }

        public function createHeroSection( $data)
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' .$locale]?? null,
                'description' => $data['description_' .$locale] ?? null,
            ];
        }
        // dd($create_data);
        $image = $data['image']->store('hero_section', 'public');
        $heroSection = HeroSection::create($create_data + [
            'image' => $image
        ]);
        return ApiResponseHelper::response(true, 'Hero section created successfully', [
            new HeroSectionResource($heroSection)
        ]);
    }

    public function updataHeroSection($data)
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' .$locale]?? null,
                'description' => $data['description_' .$locale] ?? null,
            ];
        }
        $heroSection = HeroSection::find($data['hero_section_id']);
        $image = $data['image'] ? $data['image']->store('hero_section', 'public') : $heroSection->image;
        $heroSection->update($updata_data + [
            'image' => $image,
        ]);
        return ApiResponseHelper::response(true, 'Hero section updated successfully', [
            new HeroSectionResource($heroSection)
        ]);
    }

    public function fetchHeroSection($data)
    {
        $heroSection = HeroSection::find($data['hero_section_id']);
        return ApiResponseHelper::response(true, 'Hero section fetched successfully', [
            new HeroSectionResource($heroSection)
        ]);
    }

    public function deleteHeroSection($data)
    {
        $heroSection = HeroSection::find($data['hero_section_id']);
        $heroSection->delete();
        return ApiResponseHelper::response(true, 'Hero section deleted successfully');
    }
}
