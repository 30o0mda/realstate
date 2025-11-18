<?php
namespace App\Modules\GeneralData\DTOs\HeroSection;
class HeroSectionFilterDto
{
    public ?string $word;
    public ?bool $with_pagination;
    public ?int $per_page;

    public function __construct(
        ?string $word,
        ?bool $with_pagination,
        ?int $per_page
    ) {
        $this->fromArray(data: [
            'word' => $word,
            'with_pagination' => $with_pagination,
            'per_page' => $per_page
        ]);
    }
    public function fromArray(array $data): void
    {
        $this->word = $data['word'];
        $this->with_pagination = $data['with_pagination'];
        $this->per_page = $data['per_page'];
    }
    public function toArray(): array
    {
        return [
            'word' => $this->word,
            'with_pagination' => $this->with_pagination,
            'per_page' => $this->per_page,
        ];
    }
}
