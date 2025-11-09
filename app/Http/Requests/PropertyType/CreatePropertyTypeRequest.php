<?php

namespace App\Http\Requests\PropertyType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreatePropertyTypeRequest extends FormRequest
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
                'required',
                'string',
                'min:2',
                Rule::unique('property_type_translations', 'title')->where('locale', $locale),
            ];
        }
        $rules['is_active'] = 'nullable|boolean';
        $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|';

        return $rules;
    }
}
