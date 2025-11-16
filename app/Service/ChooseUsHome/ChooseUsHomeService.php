<?php

namespace App\Service\ChooseUsHome;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Http\Enum\ViewTypeEnum;
use App\Http\Resources\ChooseUsHome\ChooseUsHomeResource;
use App\Http\ResourcesWebsite\ChooseUsHome\ChooseUsHomeWebsiteResource;
use App\Models\ChooseUsFeature\ChooseUsFeature;
use App\Models\ChooseUsHome\ChooseUsHome;
use App\Models\PostHome\PostHome;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ChooseUsHomeService
{
    public function __construct() {}

    public function createOrUpdateChooseUsHome($data, $organization_id = null, $created_by = null): DataStatus
    {
        $chooseUsHomeData = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $chooseUsHomeData[$locale] = [
                'title' => $data['title_' . $locale] ?? null,
                'description' => $data['description_' . $locale] ?? null,
            ];
        }
        $chooseUsHomeData['organization_id'] = $organization_id;
        $chooseUsHomeData['created_by'] = $created_by;
       if(isset($data['image']) && !empty($data['image'])){
        $data['image'] = uploadImage($data['image'], 'Choose_Us_Home', 'public');


       }
        if ($chooseUsHome = ChooseUsHome::first()) {
            $chooseUsHome->update($chooseUsHomeData);
        } else {
            $chooseUsHome = ChooseUsHome::create($chooseUsHomeData);
        }
        if (!empty($data['features']) && is_array($data['features'])) {
            $chooseUsHome->features()->delete();
            foreach ($data['features'] as $featureData) {
                $features = [];
                foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
                    $features[$locale] = [
                        'title' => $featureData['title_' . $locale] ?? null,
                        'description' => $featureData['description_' . $locale] ?? null,
                    ];
                }
                $features['organization_id'] = $organization_id;
                $features['created_by'] = $created_by;
                $features['choose_us_home_id'] = $chooseUsHome->id;
                $feature = ChooseUsFeature::create($features);

            }
        }
        return DataSuccess::make(
            resourceData: new ChooseUsHomeResource($chooseUsHome->fresh()),
            message: $chooseUsHome->wasRecentlyCreated ? 'choose us home created successfully' : 'choose us home updated successfully'
        );
    }




    public function fetchChooseUsHome($view_type = ViewTypeEnum::Dashboard->value): DataStatus
    {
        $chooseUsHome = PostHome::firstOrNew();
        if ($view_type == ViewTypeEnum::Website->value) {
            $response = new ChooseUsHomeWebsiteResource($chooseUsHome);
        } else {
            $response = new ChooseUsHomeResource($chooseUsHome);
        }
        return DataSuccess::make(resourceData: $response, message: 'Choose us home fetched successfully');
    }
}
