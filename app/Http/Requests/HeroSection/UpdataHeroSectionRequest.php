<?php

namespace App\Http\Requests\HeroSection;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Validation\Rule;


class UpdataHeroSectionRequest extends FormRequest
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
        $rules = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules["title_$locale"] = [
                'nullable',
                'string',
                'min:2',
                Rule::unique('hero_section_translations', 'title')->where('locale', $locale)->ignore($this->hero_section_id, 'hero_section_id'),
            ];
            $rules["description_$locale"] = 'nullable|string|min:2';
        }
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|';
        $rules['hero_section_id'] = 'required|exists:hero_sections,id';
        return $rules;
    }
}
