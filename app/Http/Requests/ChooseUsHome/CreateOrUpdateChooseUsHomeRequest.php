<?php

namespace App\Http\Requests\ChooseUsHome;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateOrUpdateChooseUsHomeRequest extends FormRequest
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
        $rules['features.*.title_en'] = 'nullable|string|max:255';
        $rules['features.*.title_ar'] = 'nullable|string|max:255';
        $rules['features.*.description_en'] = 'nullable|string';
        $rules['features.*.description_ar'] = 'nullable|string';
        $rules['image'] = 'nullable';
        return $rules;
    }
}
