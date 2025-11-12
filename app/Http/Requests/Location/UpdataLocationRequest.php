<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Validation\Rule;


class UpdataLocationRequest extends FormRequest
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
        $rules['location_id'] = 'required|exists:locations,id';
        $rules['code'] = 'required|string|min:2';
        $rules['parent_id'] = 'nullable|exists:locations,id';
        return $rules;
    }
}
