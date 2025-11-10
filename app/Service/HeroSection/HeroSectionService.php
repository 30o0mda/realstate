<?php

namespace App\Service\HeroSection;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\HeroSection\HeroSectionResource;
use App\Models\HeroSection\HeroSection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HeroSectionService
{
     public function __construct()
    {
    }

        public function createHeroSection( $data):DataStatus
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
        return DataSuccess::make(resourceData:new HeroSectionResource($heroSection), message:'Hero section created successfully');
    }

    public function updataHeroSection($data):DataStatus
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
            return DataSuccess::make(resourceData:new HeroSectionResource($heroSection), message:'Hero section updated successfully');

    }

    public function fetchHeroSection($data):DataStatus
    {
        $heroSection = HeroSection::find($data['hero_section_id']);
        return DataSuccess::make(resourceData:new HeroSectionResource($heroSection), message:'Hero section fetched successfully');
    }

    public function deleteHeroSection($data):DataStatus
    {
        $heroSection = HeroSection::find($data['hero_section_id']);
        $heroSection->delete();
        return DataSuccess::make(message:'Hero section deleted successfully');
    }
}
