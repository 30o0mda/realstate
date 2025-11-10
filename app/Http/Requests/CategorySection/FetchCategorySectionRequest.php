<?php

namespace App\Http\Requests\CategorySection;

use Illuminate\Foundation\Http\FormRequest;

class FetchCategorySectionRequest extends FormRequest
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
        ];
    }
}
