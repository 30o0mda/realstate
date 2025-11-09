<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateLocationRequest extends FormRequest
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
                Rule::unique('location_translations', 'title')->where('locale', $locale),
            ];
        }
        $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|';
        $rules['parent_id'] = 'nullable|exists:locations,id';
        $rules['code'] = 'required|string|min:2';
        return $rules;
    }
}
