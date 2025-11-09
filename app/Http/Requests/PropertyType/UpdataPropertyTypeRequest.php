<?php

namespace App\Http\Requests\PropertyType;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Validation\Rule;


class UpdataPropertyTypeRequest extends FormRequest
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
                Rule::unique('property_type_translations', 'title')->where('locale', $locale)->ignore($this->property_type_id, 'property_type_id'),
            ];
        }
        $rules['is_active'] = 'nullable|boolean';
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|';
        $rules['property_type_id'] = 'required|exists:property_types,id';
        return $rules;
    }
}
