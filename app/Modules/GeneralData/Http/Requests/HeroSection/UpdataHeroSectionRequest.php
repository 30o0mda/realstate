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
        $rules["title_en"] = [
            'required',
            'string',
            'min:2',
        ];
        $rules["title_ar"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["description_en"] = 'nullable|string|min:2';
        $rules["description_ar"] = 'nullable|string|min:2';
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|';
        $rules['hero_section_id'] = 'required|exists:hero_sections,id';
        return $rules;
    }
}
