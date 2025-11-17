<?php

namespace App\Modules\Course\DTOs;


class CourseDto
{
    public ?string $title_en;
    public ?string $title_ar;
    public ?string $description_en;
    public ?string $description_ar;
    public ?string $image;
    public ?int $organization_id;
    public ?int $course_id;
    public function __construct(
        ?string $title_en    = null,
        ?string $title_ar = null,
        ?string $description_en = null,
        ?string $description_ar = null,
        ?string $image = null,
        ?int $course_id = null
    ) {
        $this->fromArray(data: [
            'title_en' => $title_en,
            'title_ar' => $title_ar,
            'description_en' => $description_en,
            'description_ar' => $description_ar,
            'image' => $image,
            'course_id' => $course_id
        ]);
    }
    public function fromArray($data): void
    {
        $this->title_en = $data['title_en'];
        $this->title_ar = $data['title_ar'];
        $this->description_en = $data['description_en'];
        $this->description_ar = $data['description_ar'];
        $this->image = $data['image'];
        $this->course_id = $data['course_id'];
    }
    public function toArray(): array
    {
        return [
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'image' => $this->image
        ];
    }
}
