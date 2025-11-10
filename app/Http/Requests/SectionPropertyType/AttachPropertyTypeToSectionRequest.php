<?php

namespace App\Http\Requests\SectionPropertyType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AttachPropertyTypeToSectionRequest extends FormRequest
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
            'category_section_id' => 'required|exists:category_sections,id',
            'property_type_ids' => 'required|array',
            'property_type_ids.*' => 'exists:property_types,id',
        ];
    }
}
