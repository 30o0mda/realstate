<?php

namespace App\Http\Requests\BlogCategory;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Validation\Rule;


class UpdataBlogCategoryRequest extends FormRequest
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
                'nullable',
                'string',
                'min:2',
            ];
            $rules["title_ar"] = [
                'nullable',
                'string',
                'min:2',
            ];
        $rules['image'] = 'nullable';
        $rules['blog_category_id'] = 'required|exists:blog_categories,id';
        $rules['slug'] = [
            'nullable',
            Rule::unique('blog_categories', 'slug')->ignore($this->blog_category_id, 'blog_category_id'),
        ];
        $rules['alt'] = 'nullable|string';
        $rules['is_active'] = 'nullable|boolean';
        return $rules;
    }
}
