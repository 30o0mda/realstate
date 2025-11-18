<?php

namespace App\Http\Requests\HeroSection;

use Illuminate\Foundation\Http\FormRequest;

class FetchHeroSectionDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hero_section_id' => 'required|exists:hero_sections,id',
        ];
    }
}
