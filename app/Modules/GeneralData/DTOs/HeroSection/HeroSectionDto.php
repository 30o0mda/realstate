<?php

namespace App\Modules\GeneralData\DTOs\HeroSection;
use Illuminate\Support\Facades\Hash;

class HeroSectionDto

{
    public ?string $title_en;
    public ?string $title_ar;
    public ?string $description_en;
    public ?string $description_ar;
    public $image;
    public ?int $organization_id;
    public ?int $hero_section_id;

    public ?int $created_by;



    public function __construct(
        ?string $title_en    = null,
        ?string $title_ar = null,
        ?string $description_en = null,
        ?string $description_ar = null,
         $image = null,
        ?int $hero_section_id = null,

    ){
        $this->fromArray([
            'title_en' => $title_en,
            'title_ar' => $title_ar,
            'description_en' => $description_en,
            'description_ar' => $description_ar,
            'image' => $image,
            'hero_section_id' => $hero_section_id,


        ]);
    }

    public function fromArray($data){

        $this->title_en = $data['title_en'];
        $this->title_ar = $data['title_ar'];
        $this->description_en = $data['description_en'];
        $this->description_ar = $data['description_ar'];
        $this->image = $data['image'];
        $this->hero_section_id = $data['hero_section_id'];
        $this->organization_id = getOrganizationId();
        $this->created_by = auth('employee')->user()->id;

    }

    public function toArray(){
        return [
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'image' => $this->image,
            'organization_id' => $this->organization_id,
            'created_by' => $this->created_by
        ];
    }
}
