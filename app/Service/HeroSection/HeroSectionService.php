<?php

namespace App\Service\HeroSection;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Helpers\ApiResponseHelper;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Resources\HeroSection\HeroSectionResource;
use App\Http\ResourcesWebsite\HeroSection\HeroSectionWebsiteResource;
use App\Models\HeroSection\HeroSection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HeroSectionService
{
    public function __construct() {}
    public function createHeroSection(array $data, $organization_id = null, $created_by = null): DataStatus
    {
        $create_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $create_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
                'description' => $data['description_' . $locale] ?? null,
            ];
        }

        $image = uploadImage($data['image'], 'hero_section', 'public');
        $heroSection = HeroSection::create($create_data + [
            'image' => $image,
            'organization_id' => $organization_id,
            'created_by' => $created_by,
        ]);
        return DataSuccess::make(resourceData: new HeroSectionResource($heroSection), message: 'Hero section created successfully');
    }


    public function updataHeroSection($data): DataStatus
    {
        $updata_data = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $updata_data[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
                'description' => $data['description_' . $locale] ?? null,
            ];
        }
        $heroSection = HeroSection::find($data['hero_section_id']);
        $image = isset($data['image']) ? uploadImage($data['image'], 'hero_section', 'public') : $heroSection->image;
        $heroSection->update($updata_data + [
            'image' => $image,
        ]);
        return DataSuccess::make(resourceData: new HeroSectionResource($heroSection), message: 'Hero section updated successfully');
    }
    public function fetchHeroSection($data,  $view_type = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $query = HeroSection::query();
        $query->where('organization_id', getOrganizationId());
        if (isset($data['word'])) {
            $query->whereTranslationLike('title',  '%' . $data['word'] . '%');
        }
        $query->latest();
        if (isset($data['with_pagination']) && $data['with_pagination'] == 1) {
            $per_page = $data['per_page'] ?? 10;
            $all_hero_sections = $query->paginate($per_page);
            if ($view_type == ViewTypeEnum::Website->value) {
                $response = HeroSectionWebsiteResource::collection($all_hero_sections)->response()->getData(true);
            } else {
                $response = HeroSectionResource::collection($all_hero_sections)->response()->getData(true);
            }
        } else {
            $all_hero_sections = $query->get();
            if ($view_type == ViewTypeEnum::Website->value) {
                $response = HeroSectionWebsiteResource::collection($all_hero_sections);
            } else {
                $response = HeroSectionResource::collection($all_hero_sections);
            }
        }
        return DataSuccess::make(data: $response, message: 'Hero sections fetched successfully');
    }

    public function fetchHeroSectionDetails($data, $organization_id = null, $view_type = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $heroSection = HeroSection::find($data['hero_section_id']);
        if ($view_type == ViewTypeEnum::Website->value) {
            $response = new HeroSectionWebsiteResource($heroSection);
        } else {
            $response = new HeroSectionResource($heroSection);
        }
        return DataSuccess::make(resourceData: $response, message: 'Hero section fetched successfully');
    }

    public function deleteHeroSection($data): DataStatus
    {
        $heroSection = HeroSection::find($data['hero_section_id']);
        $heroSection->delete();
        return DataSuccess::make(message: 'Hero section deleted successfully');
    }
}
